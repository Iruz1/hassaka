<x-app-layout>
    <x-slot name="header">
        <div class="row justify-content-between mb-4">
            <div class="col-md-6">
                <h2>Kalender Jadwal Project</h2>
            </div>
            <div class="col-md-6 text-end">
                <a href="{{ route('project.index') }}" class="btn btn-secondary">Lihat Tabel</a>
            </div>
        </div>
    </x-slot>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <div id='calendar'></div>
            </div>
        </div>
    </div>
</x-app-layout>

@push('styles')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
@endpush

@push('scripts')
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach($projects as $project)
                    {
                        title: '{{ $project->project_name }}',
                        start: '{{ \Carbon\Carbon::parse($project->date)->format('Y-m-d') }}',
                        description: '{{ $project->description }}',
                        location: '{{ $project->location }}'
                    },
                    @endforeach
                ],
                eventContent: function(arg) {
                    let element = document.createElement('div');
                    element.innerHTML = `
                        <div class="fc-event-title">${arg.event.title}</div>
                        <div class="fc-event-location small">${arg.event.extendedProps.location}</div>
                    `;
                    return { domNodes: [element] };
                },
                eventDidMount: function(info) {
                    $(info.el).tooltip({
                        title: `<strong>${info.event.title}</strong><br>
                                <strong>Lokasi:</strong> ${info.event.extendedProps.location}<br>
                                <strong>Deskripsi:</strong> ${info.event.extendedProps.description}`,
                        html: true,
                        placement: 'top',
                        container: 'body'
                    });
                }
            });
            calendar.render();
        });
    </script>
@endpush
