<template x-if="toast.type==='debug'">
    <img src="<?php echo e(URL::to('/icons/debugging.svg')); ?>" class="h-6 w-6">
</template>

<template x-if="toast.type==='info'">
    <img src="<?php echo e(URL::to('/icons/info.svg')); ?>" class="h-6 w-6">
</template>

<template x-if="toast.type==='success'">
    <img src="<?php echo e(URL::to('/icons/checked.svg')); ?>" class="h-6 w-6">
</template>

<template x-if="toast.type==='warning'">
    <img src="<?php echo e(URL::to('/icons/warning.svg')); ?>" class="h-6 w-6">
</template>

<template x-if="toast.type==='danger'">
    <img src="<?php echo e(URL::to('/icons/danger-icon.svg')); ?>" class="h-6 w-6">
</template>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/vendor/tall-toasts/includes/icon.blade.php ENDPATH**/ ?>