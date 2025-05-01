<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!--  <div class="min-h-screen flex items-center justify-center bg-gray-50"> -->
        <div class="w-full max-w-md p-8 bg-white rounded shadow-lg text-center">
            <div class="flex justify-center mb-4">
                <div class="bg-purple-600 text-white rounded-full p-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M5.121 17.804A9.004 9.004 0 0112 15c2.21 0 4.209.804 5.879 2.138M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-purple-700 mb-4">Have an account?</h2>

            <form method="POST" action="<?php echo e(route('login')); ?>">
                <?php echo csrf_field(); ?>

                <div class="mb-4">
                    <input id="email" name="email" type="email" placeholder="Username"
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
                           value="<?php echo e(old('email')); ?>" required autofocus>
                </div>

                <div class="mb-4">
                    <input id="password" name="password" type="password" placeholder="Password"
                           class="w-full px-4 py-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-purple-600"
                           required>
                </div>

                <div class="flex items-center justify-between text-sm text-purple-600 mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember"
                               class="form-checkbox text-purple-600 focus:ring-purple-500">
                        <span class="ml-2">Remember Me</span>
                    </label>
                    <a href="<?php echo e(route('password.request')); ?>" class="hover:underline">Forgot Password</a>
                </div>

                <button type="submit"
                        class="w-full bg-purple-700 text-white py-2 rounded hover:bg-purple-800 transition">
                    Get Started
                </button>
            </form>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\hassaka\resources\views/auth/login.blade.php ENDPATH**/ ?>