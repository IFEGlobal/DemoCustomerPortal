<div>
    <div class="flex items-center p-4 bg-white rounded-lg shadow-xl mx-auto max-w-sm relative m-10">
        <span class="text-xs font-bold uppercase px-2 mt-2 mr-2 text-green-900 bg-green-400 border rounded-full absolute top-0 right-0">New</span>
        <span class="text-xs font-semibold uppercase m-1 py-1 mr-3 text-gray-500 absolute bottom-0 right-0"><?php echo e(now()->format('h:i:s')); ?></span>

        <div class="h-12 w-12 rounded-full"><?php echo $__env->make('tall-toasts::includes.icon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?></div>

        <div class="ml-5">
            <h4 class="text-md font-semibold leading-tight text-gray-900"  x-html="toast.title" x-show="toast.title !== undefined"></h4>
            <p class="text-sm text-gray-600"  x-show="toast.message !== undefined" x-html="toast.message"></p>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/vendor/tall-toasts/includes/content.blade.php ENDPATH**/ ?>