<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Data Insights
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <select name="platform" class="form-select">
                                    <option value="">All Platforms</option>
                                    <option value="tiktok" {{ request('platform') == 'tiktok' ? 'selected' : '' }}>TikTok</option>
                                    <option value="instagram" {{ request('platform') == 'instagram' ? 'selected' : '' }}>Instagram</option>
                                </select>
                            </div>

                            <div class="col-md-3">
                                <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}">
                            </div>

                            <div class="col-md-3">
                                <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}">
                            </div>

                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="{{ route('insights.export.form') }}" class="btn btn-success">Export Excel</a>
                                @can('fetch-data')
                                <a href="{{ route('insights.fetch') }}" class="btn btn-info">Fetch New Data</a>
                                @endcan
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Platform</th>
                                    <th>Post ID</th>
                                    <th>Tanggal</th>
                                    <th>Likes</th>
                                    <th>Comments</th>
                                    <th>Shares</th>
                                    <th>Views</th>
                                    <th>Reach</th>
                                    <th>Engagement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($insights as $insight)
                                <tr>
                                    <td>{{ strtoupper($insight->platform) }}</td>
                                    <td>{{ $insight->post_id }}</td>
                                    <td>{{ $insight->date->format('Y-m-d') }}</td>
                                    <td>{{ number_format($insight->likes) }}</td>
                                    <td>{{ number_format($insight->comments) }}</td>
                                    <td>{{ number_format($insight->shares) }}</td>
                                    <td>{{ number_format($insight->views) }}</td>
                                    <td>{{ number_format($insight->reach) }}</td>
                                    <td>{{ number_format($insight->engagement) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $insights->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
