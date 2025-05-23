<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Laravel')); ?></title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo e(asset('css/app.css')); ?>" rel="stylesheet">
        <style>
            :root {
                --primary-blue: #1e88e5;
                --dark-blue: #1565c0;
                --light-blue: #e3f2fd;
                --white: #ffffff;
            }

            .bg-blue {
                background-color: var(--primary-blue);
            }

            .bg-light-blue {
                background-color: var(--light-blue);
            }

            .text-blue {
                color: var(--primary-blue);
            }

            .bg-white {
                background-color: var(--white);
            }

            .border-blue {
                border-color: var(--primary-blue);
            }

            .min-h-screen {
                background-color: var(--light-blue);
            }

            .shadow {
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            }
        </style>

        <!-- Scripts -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen">
            <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <!-- Page Heading -->
            <?php if(isset($header)): ?>
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        <h2 class="text-blue font-semibold text-xl">
                            <?php echo e($header); ?>

                        </h2>
                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <main class="bg-light-blue">
                <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-b border-blue">
                        <?php echo e($slot); ?>

                    </div>
                </div>
            </main>
        </div>
    </body>
</html>
<?php /**PATH C:\laragon\www\hassaka\resources\views/layouts/app.blade.php ENDPATH**/ ?>