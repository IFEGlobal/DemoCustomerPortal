<!doctype html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <meta charset="UTF-8">

    <link rel="icon" type="image/png" href="<?php echo e(asset('/logos/SmartLogisticsPortal_final_icon-01.png')); ?>" />

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo e(config('app.name')); ?> <?php if(isset($title)): ?>
            - <?php echo e($title); ?>

        <?php endif; ?>
    </title>

    <!-- CSS & JS Assets -->
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/daisyui@2.47.0/dist/full.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet" type="text/css" />

    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
    </script>

    <?php if(isset($head)): ?>
        <?php echo e($head); ?>

    <?php endif; ?>

</head>

<body x-data x-bind="$store.global.documentBody"
    class="<?php if(isset($isSidebarOpen)): ?> <?php echo e($isSidebarOpen === 'true' ? 'is-sidebar-open' : ''); ?> <?php endif; ?> <?php if(isset($isHeaderBlur)): ?> <?php echo e($isHeaderBlur === 'true' ? 'is-header-blur' : ''); ?> <?php endif; ?> <?php if(isset($hasMinSidebar)): ?> <?php echo e($hasMinSidebar === 'true' ? 'has-min-sidebar' : ''); ?> <?php endif; ?> <?php if(isset($headerSticky)): ?> <?php echo e($headerSticky === 'false' ? 'is-header-not-sticky' : ''); ?> <?php endif; ?>">

    <!-- App preloader-->
    <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.app-preloader','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-preloader'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>

    <!-- Page Wrapper -->
    <div id="root" class="min-h-100vh flex grow bg-slate-50 dark:bg-navy-900" x-cloak>

        <?php echo e($slot); ?>


    </div>

    <!--
  This is a place for Alpine.js Teleport feature
  @see https://alpinejs.dev/directives/teleport
-->
    <div id="x-teleport-target"></div>

    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>

    <?php if(isset($script)): ?>
        <?php echo e($script); ?>

    <?php endif; ?>

</body>

</html>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/components/base-layout.blade.php ENDPATH**/ ?>