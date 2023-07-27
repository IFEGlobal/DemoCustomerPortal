<?php
    $theme = $component->getTheme();
?>

<?php if($theme === 'tailwind'): ?>
    <div class="rounded-md shadow-sm">
        <select
            wire:model.stop="<?php echo e($component->getTableName()); ?>.filters.<?php echo e($filter->getKey()); ?>"
            wire:key="<?php echo e($component->getTableName()); ?>-filter-<?php echo e($filter->getKey()); ?>"
            id="<?php echo e($component->getTableName()); ?>-filter-<?php echo e($filter->getKey()); ?>"
            class="block w-full border-gray-300 rounded-md shadow-sm transition duration-150 ease-in-out focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 dark:bg-gray-800 dark:text-white dark:border-gray-600"
        >
            <?php $__currentLoopData = $filter->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if(is_iterable($value)): ?>
                    <optgroup label="<?php echo e($key); ?>">
                        <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($optionKey); ?>"><?php echo e($optionValue); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php else: ?>
                    <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
<?php elseif($theme === 'bootstrap-4' || $theme === 'bootstrap-5'): ?>
    <select
        wire:model.stop="<?php echo e($component->getTableName()); ?>.filters.<?php echo e($filter->getKey()); ?>"
        wire:key="<?php echo e($component->getTableName()); ?>-filter-<?php echo e($filter->getKey()); ?>"
        id="<?php echo e($component->getTableName()); ?>-filter-<?php echo e($filter->getKey()); ?>"
        class="<?php echo e($theme === 'bootstrap-4' ? 'form-control' : 'form-select'); ?>"
    >
        <?php $__currentLoopData = $filter->getOptions(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if(is_iterable($value)): ?>
                <optgroup label="<?php echo e($key); ?>">
                    <?php $__currentLoopData = $value; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionKey => $optionValue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($optionKey); ?>"><?php echo e($optionValue); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </optgroup>
            <?php else: ?>
                <option value="<?php echo e($key); ?>"><?php echo e($value); ?></option>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
<?php endif; ?>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/vendor/livewire-tables/components/tools/filters/select.blade.php ENDPATH**/ ?>