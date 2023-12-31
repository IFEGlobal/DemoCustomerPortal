<?php foreach ((['component']) as $__key => $__value) {
    $__consumeVariable = is_string($__key) ? $__key : $__value;
    $$__consumeVariable = is_string($__key) ? $__env->getConsumableComponentData($__key, $__value) : $__env->getConsumableComponentData($__value);
} ?>
<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag; ?>
<?php foreach($attributes->onlyProps(['rows']) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $attributes = $attributes->exceptProps(['rows']); ?>
<?php foreach (array_filter((['rows']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
} ?>
<?php $__defined_vars = get_defined_vars(); ?>
<?php foreach ($attributes as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
} ?>
<?php unset($__defined_vars); ?>

<?php if($component->bulkActionsAreEnabled() && $component->hasBulkActions() && $component->hasSelected()): ?>
    <?php
        $table = $component->getTableName();
        $theme = $component->getTheme();
        $colspan = $component->getColspanCount();
        $selected = $component->getSelectedCount();
        $selectAll = $component->selectAllIsEnabled();
        $simplePagination = ($component->paginationMethod == "simple") ? true : false;
    ?>

    <?php if($theme === 'tailwind'): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-tables::components.table.tr.plain','data' => ['wire:key' => 'bulk-select-message-'.e($table).'','class' => 'bg-indigo-50 dark:bg-gray-900 dark:text-white']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-tables::table.tr.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'bulk-select-message-'.e($table).'','class' => 'bg-indigo-50 dark:bg-gray-900 dark:text-white']); ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-tables::components.table.td.plain','data' => ['colspan' => $colspan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-tables::table.td.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colspan)]); ?>
                <?php if($selectAll): ?>
                    <div wire:key="all-selected-<?php echo e($table); ?>">
                        <span>
                            <?php echo app('translator')->get('You are currently selecting all'); ?>
                            <?php if(!$simplePagination): ?> <strong><?php echo e(number_format($rows->total())); ?></strong> <?php endif; ?>
                            <?php echo app('translator')->get('rows'); ?>.
                        </span>

                        <button
                            wire:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            <?php echo app('translator')->get('Deselect All'); ?>
                        </button>
                    </div>
                <?php else: ?>
                    <div wire:key="some-selected-<?php echo e($table); ?>">
                        <span>
                            <?php echo app('translator')->get('You have selected'); ?>
                            <strong><?php echo e($selected); ?></strong>
                            <?php echo app('translator')->get('rows, do you want to select all'); ?>
                            <?php if(!$simplePagination): ?> <strong><?php echo e(number_format($rows->total())); ?></strong> <?php endif; ?>
                        </span>

                        <button
                            wire:click="setAllSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            <?php echo app('translator')->get('Select All'); ?>
                        </button>

                        <button
                            wire:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="ml-1 text-blue-600 underline text-gray-700 text-sm leading-5 font-medium focus:outline-none focus:text-gray-800 focus:underline transition duration-150 ease-in-out dark:text-white dark:hover:text-gray-400"
                        >
                            <?php echo app('translator')->get('Deselect All'); ?>
                        </button>
                    </div>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php elseif($theme === 'bootstrap-4' || $theme === 'bootstrap-5'): ?>
        <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-tables::components.table.tr.plain','data' => ['wire:key' => 'bulk-select-message-'.e($table).'']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-tables::table.tr.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['wire:key' => 'bulk-select-message-'.e($table).'']); ?>
            <?php if (isset($component)) { $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4 = $component; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'livewire-tables::components.table.td.plain','data' => ['colspan' => $colspan]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('livewire-tables::table.td.plain'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(Illuminate\View\AnonymousComponent::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes(['colspan' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colspan)]); ?>
                <?php if($selectAll): ?>
                    <div wire:key="all-selected-<?php echo e($table); ?>">
                        <span>
                            <?php echo app('translator')->get('You are currently selecting all'); ?>
                            <?php if(!$simplePagination): ?> <strong><?php echo e(number_format($rows->total())); ?></strong> <?php endif; ?>
                            <?php echo app('translator')->get('rows'); ?>.
                        </span>

                        <button
                            wire:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            <?php echo app('translator')->get('Deselect All'); ?>
                        </button>
                    </div>
                <?php else: ?>
                    <div wire:key="some-selected-<?php echo e($table); ?>">
                        <span>
                            <?php echo app('translator')->get('You have selected'); ?>
                            <strong><?php echo e($selected); ?></strong>
                            <?php echo app('translator')->get('rows, do you want to select all'); ?>
                            <?php if(!$simplePagination): ?> <strong><?php echo e(number_format($rows->total())); ?></strong> <?php endif; ?>
                        </span>

                        <button
                            wire:click="setAllSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            <?php echo app('translator')->get('Select All'); ?>
                        </button>

                        <button
                            wire:click="clearSelected"
                            wire:loading.attr="disabled"
                            type="button"
                            class="btn btn-primary btn-sm"
                        >
                            <?php echo app('translator')->get('Deselect All'); ?>
                        </button>
                    </div>
                <?php endif; ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4)): ?>
<?php $component = $__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4; ?>
<?php unset($__componentOriginalc254754b9d5db91d5165876f9d051922ca0066f4); ?>
<?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/vendor/livewire-tables/components/table/tr/bulk-actions.blade.php ENDPATH**/ ?>