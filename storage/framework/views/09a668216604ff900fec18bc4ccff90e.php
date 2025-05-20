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
        <h2 class="font-semibold text-xl text-gray-800 dark:text-blue-500 leading-tight">
            <?php echo e(__('Data Insight')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="mb-4">
                        <form method="GET" class="row g-3">
                            <div class="col-md-3">
                                <select name="platform" class="form-select">
                                    <option value="">All Platforms</option>
                                    <option value="tiktok" <?php echo e(request('platform') == 'tiktok' ? 'selected' : ''); ?>>TikTok</option>
                                    <option value="instagram" <?php echo e(request('platform') == 'instagram' ? 'selected' : ''); ?>>Instagram</option>
                                </select>
                            </div>



                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Filter</button>
                                <a href="<?php echo e(route('insights.export.form')); ?>" class="btn btn-success">Export Excel</a>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('fetch-data')): ?>
                                <a href="<?php echo e(route('insights.fetch')); ?>" class="btn btn-info">Fetch New Data</a>
                                <?php endif; ?>
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

                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $insights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $insight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(strtoupper($insight->platform)); ?></td>
                                    <td><?php echo e($insight->post_id); ?></td>
                                    <td><?php echo e($insight->date->format('Y-m-d')); ?></td>
                                    <td><?php echo e(number_format($insight->likes)); ?></td>
                                    <td><?php echo e(number_format($insight->comments)); ?></td>
                                    <td><?php echo e(number_format($insight->shares)); ?></td>
                                    <td><?php echo e(number_format($insight->views)); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <?php echo e($insights->links()); ?>

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
<?php /**PATH C:\laragon\www\hassaka\resources\views/insights/index.blade.php ENDPATH**/ ?>