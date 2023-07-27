<div>
    <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 mb-2">
        This Week <?php echo e(now()->startOfWeek()->format('D d')); ?> to <?php echo e(now()->endOfWeek()->format('D d')); ?>

    </h2>
    <div class="grid grid-cols-2 gap-3">
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <a wire:click="GoToShipments()" class="flex justify-between cursor-pointer space-x-1">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    <?php echo e($Shipments->count()); ?>

                </p>

                <img src="<?php echo e(URL::to('/icons/cargo-ship-icon.svg')); ?>" class="flex-shrink-0 w-5 h-5" aria-hidden="true">
            </a>
            <p class="mt-1 text-xs+">Shipments</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <a wire:click="GoToContainers()" class="flex cursor-pointer justify-between">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    <?php echo e($Containers->count()); ?>

                </p>

                <img src="<?php echo e(URL::to('/icons/fcl-container-icon.svg')); ?>" class="flex-shrink-0 w-5 h-5" aria-hidden="true">
            </a>
            <p class="mt-1 text-xs+">Containers</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <a wire:click="GoToDeliveries()" class="flex cursor-pointer justify-between">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    <?php echo e($Deliveries->count()); ?>

                </p>

                <img src="<?php echo e(URL::to('/icons/truck.svg')); ?>" class="flex-shrink-0 w-5 h-5" aria-hidden="true">
            </a>
            <p class="mt-1 text-xs+">Deliveries</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <a wire:click="GoToInvoices()" class="flex cursor-pointer justify-between">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    <?php echo e($Documents->count()); ?>

                </p>

                <img src="<?php echo e(URL::to('/icons/paper.svg')); ?>" class="flex-shrink-0 w-5 h-5" aria-hidden="true">
            </a>
            <p class="mt-1 text-xs+">Documents</p>
        </div>
    </div>

    <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6 mt-3">
        <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
            <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                    <div class="avatar h-10 w-10">
                        <img class="rounded-full" src="<?php echo e(URL::to('/icons/cargoship-icon-1.svg')); ?>" alt="avatar"/>
                    </div>
                    <div>
                        <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                           <?php echo e($Shipments->count() ?? 0); ?> Shipments Arriving
                        </p>
                        <p class="text-xs text-slate-500 dark:text-navy-300">
                            <?php echo e(now()->startOfWeek()->format('D d')); ?> to <?php echo e(now()->endOfWeek()->format('D d')); ?>

                        </p>
                    </div>
                </div>
                <button @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
            </div>
            <div x-collapse x-show="expanded">
                <?php if($Shipments->count() > 0): ?>
                    <?php $__currentLoopData = $Shipments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shipment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                            <a wire:click="OpenShipment(<?php echo e($shipment->id); ?>)" class="flex cursor-pointer items-center space-x-3">
                                <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/cargoship-icon-1.svg')); ?>" alt="image" />
                                <div>
                                    <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                        <?php echo e($shipment->shipment_ref); ?>

                                    </p>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                        <?php if($shipment->estimated_arrival > now()): ?>
                                            Arriving
                                        <?php else: ?>
                                            Arrived
                                        <?php endif; ?>
                                        <?php echo e($shipment->estimated_arrival?->format('D d M y H:i:s') ?? '-'); ?>

                                    </p>
                                </div>
                            </a>

                            <div class="mt-4">
                                <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">
                                    <?php if(is_int($shipment->getRemainingDaysAttribute())): ?>
                                        <?php if($shipment->trackingSliderAttribute() < 100): ?>
                                            <div class="rounded-full bg-primary dark:bg-accent" style="width: <?php echo e($shipment->trackingSliderAttribute()); ?>%"></div>
                                        <?php else: ?>
                                            <div class="rounded-full bg-primary dark:bg-accent" style="width: 100%"></div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                        <div class="flex cursor-pointer items-center space-x-3">
                            <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/cargoship-icon-1.svg')); ?>" alt="image" />
                            <div>
                                <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                    No Shipments
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    There doesn't seem to be any shipments arriving this week
                                </p>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="progress h-1.5 bg-slate-150 dark:bg-navy-500">

                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6 mt-3">
        <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
            <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                    <div class="avatar h-10 w-10">
                        <img class="rounded-full" src="<?php echo e(URL::to('/icons/truck.svg')); ?>" alt="avatar"/>
                    </div>
                    <div>
                        <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                            <?php echo e($Deliveries->count() ?? 0); ?> Deliveries
                        </p>
                        <p class="text-xs text-slate-500 dark:text-navy-300">
                            <?php echo e(now()->startOfWeek()->format('D d')); ?> to <?php echo e(now()->endOfWeek()->format('D d')); ?>

                        </p>
                    </div>
                </div>
                <button @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
            </div>
            <div x-collapse x-show="expanded">
                <?php if($Deliveries->count() > 0): ?>
                    <?php $__currentLoopData = $Deliveries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $delivery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                            <a wire:click="OpenDelivery(<?php echo e($delivery->id); ?>)" class="flex cursor-pointer items-center space-x-3">
                                <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/truck.svg')); ?>" alt="image" />
                                <div>
                                    <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                        <?php echo e($delivery->container->container_no); ?>

                                    </p>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                        Delivering On <?php echo e($delivery->arrival_estimated_delivery?->format('D d M y H:i:s') ?? '-'); ?>

                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                        <div class="flex cursor-pointer items-center space-x-3">
                            <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/truck.svg')); ?>" alt="image" />
                            <div>
                                <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                    No Deliveries
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    There doesn't seem to be any deliveries arriving this week
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6 mt-3">
        <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
            <div class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                    <div class="avatar h-10 w-10">
                        <img class="rounded-full" src="<?php echo e(URL::to('/icons/paper.svg')); ?>" alt="avatar"/>
                    </div>
                    <div>
                        <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                            <?php echo e($Documents->count() ?? 0); ?> Documents
                        </p>
                        <p class="text-xs text-slate-500 dark:text-navy-300">
                            <?php echo e(now()->startOfWeek()->format('D d')); ?> to <?php echo e(now()->endOfWeek()->format('D d')); ?>

                        </p>
                    </div>
                </div>
                <button @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                    <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                </button>
            </div>
            <div x-collapse x-show="expanded">
                <?php if($Documents->count() > 0): ?>
                    <?php $__currentLoopData = $Documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                            <a wire:click="OpenDocument(<?php echo e($document->id); ?>)" class="flex cursor-pointer items-center space-x-3">
                                <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/paper.svg')); ?>" alt="image" />
                                <div>
                                    <p class="font-medium text-xs+ leading-snug text-slate-700 dark:text-navy-100">
                                        <?php echo e($document->file_name); ?>

                                    </p>
                                    <p class="text-xs text-slate-400 dark:text-navy-300">
                                        Created On <?php echo e($document->saved_date?->format('D d M y H:i:s') ?? '-'); ?>

                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    <div class="m-1 rounded-lg border border-slate-150 p-3 dark:border-navy-600">
                        <div class="flex cursor-pointer items-center space-x-3">
                            <img class="h-10 w-10 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/paper.svg')); ?>" alt="image" />
                            <div>
                                <p class="font-medium leading-snug text-slate-700 dark:text-navy-100">
                                    No Documents
                                </p>
                                <p class="text-xs text-slate-400 dark:text-navy-300">
                                    There doesn't seem to be any new documents this week
                                </p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire/right-side-bar/whats-happening-today.blade.php ENDPATH**/ ?>