<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2>Detail Project</h2>
     <?php $__env->endSlot(); ?>

    <div class="container mt-4">
        <div class="card">
            <div class="card-header">
                <h2>Detail Project</h2>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Tanggal:</div>
                    <div class="col-md-10">
                        <?php echo e($project->date ? \Carbon\Carbon::parse($project->date)->format('d M Y') : 'Tanggal tidak tersedia'); ?>

                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Nama Project:</div>
                    <div class="col-md-10"><?php echo e($project->project_name); ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Lokasi:</div>
                    <div class="col-md-10"><?php echo e($project->location); ?></div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Deskripsi:</div>
                    <div class="col-md-10"><?php echo e($project->description); ?></div>
                </div>

                <!-- Tambahan untuk log audit -->
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Dibuat Oleh:</div>
                    <div class="col-md-10">
                        <?php echo e($project->createdBy->name ?? 'Admin'); ?>

                        <span class="text-muted">
                            (<?php echo e($project->created_at ? \Carbon\Carbon::parse($project->created_at)->format('d M Y H:i') : 'Waktu tidak tersedia'); ?>)
                        </span>
                    </div>
                </div>

                <?php if($project->updated_by): ?>
                <div class="row mb-3">
                    <div class="col-md-2 fw-bold">Terakhir Diubah Oleh:</div>
                    <div class="col-md-10">
                        <?php echo e($project->updatedBy->name ?? 'Admin'); ?>

                        <span class="text-muted">
                            (<?php echo e($project->updated_at ? \Carbon\Carbon::parse($project->updated_at)->format('d M Y H:i') : 'Waktu tidak tersedia'); ?>)
                        </span>
                    </div>
                </div>
                <?php endif; ?>

                <div class="mt-4">
                    <a href="<?php echo e(route('project.edit', $project->id)); ?>" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit
                    </a>
                    <a href="<?php echo e(route('project.index')); ?>" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\hassaka\resources\views/project/show.blade.php ENDPATH**/ ?>