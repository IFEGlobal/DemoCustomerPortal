<div>
    <?php if($record): ?>
    <style>
        #map {
            z-index: 1;
        }
    </style>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Viewing Container <?php echo e($record->container_no); ?></h2>

                    <div class="inline-flex mt-2">
                        <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                            <button x-tooltip.placement.bottom="'Go To Live Dashboard'" wire:click="goTo('/dashboard')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/live-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                            <button x-tooltip.placement.bottom="'Go To Calendar'" wire:click="goTo('/calendar')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/schedule.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                            <button x-tooltip.placement.bottom="'Go To Priorities'" wire:click="goTo('/space/priorities')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-r-md hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/danger.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                        </div>

                        <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                            <button  x-tooltip.placement.bottom="'Go To Shipments'" wire:click="goTo('/shipments/shipments')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/cargo-ship-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                            <button x-tooltip.placement.bottom="'Go To Containers'" wire:click="goTo('/shipments/containers')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-r-md hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700" >
                                <img src="/icons/container-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center px-2 mb-5 col-span-12">
                <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="<?php echo e(URL::to('/icons/container-icon.svg')); ?>" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->container_no); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">
                                        <?php if($record->shipment->vessel !== null): ?>
                                            Loaded On <?php echo e($record->shipment->vessel); ?>

                                        <?php else: ?>
                                            Awaiting Transport Data
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <?php if($record->container_mode !== null): ?>
                                    <?php if($record->container_mode == 'FCL'): ?>
                                        <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                            <?php if($record->container_mode == 'FCL'): ?>
                                                <img src="<?php echo e(URL::to('/icons/fcl-container-icon.svg')); ?>" width="80">
                                            <?php elseif($record->container_mode == 'LCL'): ?>
                                                <img src="<?php echo e(URL::to('/icons/lcl-container-icon.svg')); ?>" width="80">
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->container_mode.' Shipment' ?? 'No Type Found'); ?></h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">
                                        <?php if($record->container_mode !== null): ?>
                                            <?php if($record->container_mode == 'FCL'): ?>
                                                Full Container Load
                                            <?php elseif($record->container_mode == 'LCL'): ?>
                                                Lesser Container Load
                                            <?php else: ?>
                                                No Transport Type Found
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/container-size-icon.svg" width="80">
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->container_type.' Container' ?? 'No Type Found'); ?></h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white"> Container Type</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a href="<?php echo e(route('shipment', ['id' => $record->shipment->id])); ?>" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <?php if($record->shipment->shipmentDataStatusAttribute() == 'Active'): ?>
                                        <img src="/icons/live-icon.svg" width="80">
                                    <?php else: ?>
                                        <img src="/icons/archive-icon.svg" width="80">
                                    <?php endif; ?>
                                </div>
                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->shipment->shipmentDataStatusAttribute()); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white"><?php echo e($record->shipment->shipment_ref); ?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap px-2 col-span-12">
                <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4 px-2">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.container.view-route-dates-component', ['containerId' => $record->id])->html();
} elseif ($_instance->childHasBeenRendered('l3399304224-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l3399304224-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3399304224-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3399304224-0');
} else {
    $response = \Livewire\Livewire::mount('shipments.container.view-route-dates-component', ['containerId' => $record->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l3399304224-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
                <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4 px-2">
                    <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.container.view-carbon-emissions-component', ['record' => $record, 'Co2Data' => $Co2Data])->html();
} elseif ($_instance->childHasBeenRendered('l3399304224-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l3399304224-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3399304224-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3399304224-1');
} else {
    $response = \Livewire\Livewire::mount('shipments.container.view-carbon-emissions-component', ['record' => $record, 'Co2Data' => $Co2Data]);
    $html = $response->html();
    $_instance->logRenderedChild('l3399304224-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                </div>
            </div>

            <div class="mt-2 col-span-12">
                <div class="flex flex-wrap px-2">
                    <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                        <section class="flex items-center bg-transparent font-poppins dark:bg-gray-900 ">
                            <div class="justify-center flex-1 max-w-3xl px-4 mx-auto text-left h-screen overflow-y-auto">
                                <div class="mb-10 text-center">
                                <span
                                    class="block mb-4 text-xs font-semibold leading-4 tracking-widest text-center text-blue-500 uppercase dark:text-gray-400">
                                    Container Tracking Milestones
                                </span>
                                </div>
                                <?php if(isset($tracking['Milestones'])): ?>
                                    <?php $__currentLoopData = $tracking['Milestones']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($milestone['DataSource'] !== 'ais'): ?>
                                        <div class="p-4 mb-2 rounded-md bg-white dark:bg-gray-800">
                                            <div class="flex items-center justify-between">
                                                <div class="inline-block mb-2 text-xs font-semibold text-blue-500 uppercase hover:text-blue-600 dark:text-gray-400">
                                                    <?php echo e($milestone['EventDescription'] ?? 'No Description Available'); ?>

                                                </div>
                                                <span class="mb-2 text-xs font-bold text-gray-500 dark:text-gray-400">
                                                    <?php if($milestone['TransportMode'] == 'Vessel'): ?><img src="/icons/cargo-ship-icon.svg" class="w-7 h-7 ml-1"><?php endif; ?>
                                                    <?php if($milestone['TransportMode'] == 'Truck'): ?><img src="/icons/container-on-truck-icon.svg" class="w-8 h-8 ml-1"><?php endif; ?>
                                                    <?php if($milestone['TransportMode'] == 'Rail'): ?><img src="/icons/container-on-truck-icon.scg" class="w-8 h-8 ml-1"><?php endif; ?>
                                                    <?php if($milestone['TransportMode'] == 'Air'): ?><img src="/icons//airfreight-icon.svg" class="w-8 h-8 ml-1"><?php endif; ?>
                                                    <?php if($milestone['TransportMode'] == 'Road'): ?><img src="/icons/road-freight-icon.svg" class="w-8 h-8 ml-1"><?php endif; ?>
                                                </span>
                                            </div>
                                            <h2 class="mb-4 text-md font-semibold text-gray-600 dark:text-gray-300">
                                                <?php echo e(Carbon\Carbon::parse($milestone['EventDateTime'])?->format('D d M y h:i A') ?? "-"); ?>

                                            </h2>
                                            <div class="flex flex-wrap items-center ">
                                                <div class="flex items-center mb-2 mr-4 text-sm text-gray-500 md:mb-0 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-100">
                                                    <div class="flex items-center mb-2 mr-4 text-sm text-gray-500 md:mb-0 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-100">
                                                        <?php if($milestone['IsEstimate'] == true): ?>
                                                            <span class="bg-red-100 text-red-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">Estimate</span>
                                                        <?php else: ?>
                                                            <span class="bg-green-100 text-green-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">Actual</span>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php echo e($milestone['LocationName'] ?? $milestone['LocationCountry'] ?? 'Awaiting Data'); ?> <?php echo e($milestone['LocationCountry'] ?? 'Awaiting Data'); ?>

                                                </div>
                                                <span class="flex items-center text-sm text-gray-400 md:ml-auto dark:text-gray-400 ">
                                                <?php echo e($milestone['Vessel'] ?? ''); ?>

                                                </span>
                                            </div>
                                        </div>
                                        <?php if(isset($Co2Data['legs'])): ?>
                                            <?php $__currentLoopData = $Co2Data['legs']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $co2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($co2['to']['locode'] == $milestone['LocationUnlocode']): ?>
                                                    <div x-data="{expandedItem:null}" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6 mb-2">
                                                    <div x-data="accordionItem('item-1')" class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                                        <div class="flex items-center justify-between bg-slate-150 px-2 py-2 dark:bg-navy-500 sm:px-4">
                                                            <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                                <img src="/icons/carbon-neutral.svg" class="w-7 h-7 ml-1">
                                                                <div>
                                                                    <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                                        <?php echo e($co2['from']['city'] ?? ''); ?> <?php echo e($co2['from']['country'] ?? ''); ?> <strong> to </strong> <?php echo e($co2['to']['city'] ?? ''); ?> <?php echo e($co2['to']['country'] ?? ''); ?>

                                                                    </p>
                                                                    <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                        Mode of transport <?php echo e(strtoupper($co2['mode']) ?? '-'); ?> : <?php echo e($co2['parameters']['details']['vessel']['name'] ?? '-'); ?>

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <button @click="expanded = !expanded" class="btn -mr-1.5 h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                                                <i :class="expanded && '-rotate-180'" class="fas fa-chevron-down text-sm transition-transform"></i>
                                                            </button>
                                                        </div>
                                                        <div x-collapse x-show="expanded">
                                                            <div class="overflow-x-auto shadow-md sm:rounded-b-lg">
                                                                <div class="inline-block min-w-full align-middle">
                                                                    <div class="overflow-hidden ">
                                                                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                                                            <thead class="bg-gray-100 dark:bg-gray-700">
                                                                            <tr>
                                                                                <th scope="col" class="py-2 px-4 text-xs+ text-left text-gray-700 dark:text-gray-400">
                                                                                    Container
                                                                                </th>
                                                                                <th scope="col" class="py-2 px-4 text-xs+ text-left text-gray-700 dark:text-gray-400">
                                                                                    Weight
                                                                                </th>
                                                                                <th scope="col" class="py-2 px-4 text-xs+ text-left text-gray-700 dark:text-gray-400">
                                                                                    TEU
                                                                                </th>
                                                                                <th scope="col" class="py-2 px-4 text-xs+ text-left text-gray-700 dark:text-gray-400">
                                                                                    Distance
                                                                                </th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                                                            <?php $__currentLoopData = $co2['properties']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $container): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <?php if(isset($container['id']) && $container['id'] == $this->record->container_no): ?>
                                                                                <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                                                                    <td class="py-2 px-4 text-xs+ text-gray-900 whitespace-nowrap dark:text-white"><?php echo e($container['id'] ?? '-'); ?></td>
                                                                                    <td class="py-2 px-4 text-xs+ text-gray-500 whitespace-nowrap dark:text-white"><?php echo e(round($record->gross_weight, 2) ?? '-'); ?> kg's</td>
                                                                                    <td class="py-2 px-4 text-xs+ text-gray-900 whitespace-nowrap dark:text-white"><?php echo e($container['sizeTypeCode'] ?? '-'); ?></td>
                                                                                    <td class="py-2 px-4 text-xs+ text-gray-900 whitespace-nowrap dark:text-white"><?php echo e(round(($co2['properties']['distance'] / 1000),2) ?? 0); ?> km's</td>
                                                                                </tr>
                                                                                <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                            </tbody>
                                                                        </table>
                                                                        <?php $__currentLoopData = $co2['properties']['orders']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $container): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <?php if(isset($container['id']) && $container['id'] == $this->record->container_no): ?>
                                                                                <div class="relative group mb-2">
                                                                                    <div class="flex items-start rounded-xl items-center justify-center dark:bg-gray-800">
                                                                                        <div class="grid grid-cols-3 gap-5 mt-2">
                                                                                            <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                                                                <img src="/icons/oil-tank.svg" class="w-7 h-7 ml-1">
                                                                                                <div>
                                                                                                    <p class="text-slate-700 dark:text-navy-100">
                                                                                                        WTT
                                                                                                    </p>
                                                                                                    <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                                                        89.45 Kgs
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                                                                <img src="/icons/hands.svg" class="w-7 h-7 ml-1">
                                                                                                <div>
                                                                                                    <p class="text-slate-700 dark:text-navy-100">
                                                                                                        TTW
                                                                                                    </p>
                                                                                                    <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                                                        1452.52 Kgs
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>

                                                                                            <div class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                                                                                <img src="/icons/carbon-neutral.svg" class="w-7 h-7 ml-1">
                                                                                                <div>
                                                                                                    <p class="text-slate-700 dark:text-navy-100">
                                                                                                        WTW
                                                                                                    </p>
                                                                                                    <p class="text-xs text-slate-500 dark:text-navy-300">
                                                                                                        1541.97 Kgs
                                                                                                    </p>
                                                                                                </div>
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <div class="p-4 mb-6 rounded-md bg-white dark:bg-gray-800">
                                        <div class="flex items-center justify-center">
                                            <div class="inline-block mb-2 text-xs font-semibold text-red-500 uppercase hover:text-red-600 dark:text-gray-400">
                                                No Container Tracking Available
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if($record->containerDelivery()->exists()): ?>
                                    <div class="p-4 mb-6 rounded-md bg-white dark:bg-gray-800">
                                        <div class="flex items-center justify-between">
                                            <div class="inline-block mb-2 text-xs font-semibold text-blue-500 uppercase hover:text-blue-600 dark:text-gray-400">
                                                Delivery
                                            </div>
                                            <span class="mb-2 text-xs font-bold text-gray-500 dark:text-gray-400"><?php echo e($record->containerDelivery->arrival_estimated_delivery?->format('D d M y h:i A') ?? "-"); ?></span>
                                        </div>
                                        <h2 class="mb-4 text-xl font-semibold text-gray-600 dark:text-gray-300">
                                            Out For Delivery
                                        </h2>
                                        <div class="flex flex-wrap items-center ">
                                            <div class="flex items-center mb-2 mr-4 text-sm text-gray-500 md:mb-0 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-100">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-red-500">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                                                </svg>
                                                <?php echo e($record->containerDelivery->transportBooking->delivery_address); ?>

                                            </div>
                                            <div class="flex items-center mb-2 mr-4 text-sm text-gray-500 md:mb-0 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-100">
                                                <img src="/icons/container-on-truck-icon.svg" class="w-8 h-8 ml-1">
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    </div>

                    <div class="w-full sm:w-full md:w-2/3 lg:w-2/3 xl:w-2/3 mb-4 px-2">
                        <div wire:ignore id="map" class="rounded" style="height: 100%; width: 100%;"></div>
                    </div>
                    <script>
                        setTimeout(function () {
                            window.dispatchEvent(new Event("resize"));
                        }, 500);

                        var currentPosition = <?php echo e(Js::from($position)); ?>;

                        var map = L.map('map').setView([51.5072, 0.1276], 3);

                        L.tileLayer('https://basemap.nationalmap.gov/arcgis/rest/services/USGSImageryTopo/MapServer/tile/{z}/{y}/{x}', {
                            minZoom: 3,
                            maxZoom: 19,
                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                        }).addTo(map);

                        map.attributionControl.setPrefix('');

                        const locationIcon = L.icon({
                            iconUrl: '<?php echo e(URL::asset('/icons/pin.png')); ?>',
                            iconSize: [20, 20]
                        });

                        const shipIcon = L.icon({
                            iconSize: [20, 20],
                            iconUrl: '<?php echo e(URL::asset('/icons/pulse-dot.gif')); ?>',
                        });

                        var locations = <?php echo e(Js::from($locations)); ?>;


                        for (var i = 0; i < locations.length; i++) {
                            marker = new L.marker([locations[i][1], locations[i][2]], {icon: locationIcon}).bindPopup(locations[i][0]).addTo(map);
                        }


                        marker = new L.marker([currentPosition[0],currentPosition[1],], {icon: shipIcon})
                            .bindPopup(
                                "Vessel: "+currentPosition['vessel_name']+
                                "<br/>" +
                                "IMO: "+currentPosition['vessel_imo']+
                                "<br/>" +
                                "Speed : "+currentPosition['speed']+
                                "<br/>" +
                                "Draft : "+currentPosition['draft']
                            ).addTo(map);

                        var pointList = [<?php echo e(Js::from($polyline)); ?>];

                        var polyline = new L.Polyline(pointList, {
                            color: 'white',
                            weight: 2,
                            opacity: 0.5,
                            smoothFactor: 1
                        });

                        polyline.addTo(map);

                        map.setView(currentPosition, 0);
                    </script>
                </div>

                <?php if($record->containerDelivery()->exists()): ?>
                    <div class="w-full mb-4 px-2 bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mt-10">
                        <div class="flex items-center">
                            <img src="<?php echo e(URL::to('/icons/truck.svg')); ?>" class="w-10 h-10 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Deliveries</span>
                        </div>
                        <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.container.view-deliveries-datatable', ['containerId' => $record->id])->html();
} elseif ($_instance->childHasBeenRendered('l3399304224-2')) {
    $componentId = $_instance->getRenderedChildComponentId('l3399304224-2');
    $componentTag = $_instance->getRenderedChildComponentTagName('l3399304224-2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l3399304224-2');
} else {
    $response = \Livewire\Livewire::mount('shipments.container.view-deliveries-datatable', ['containerId' => $record->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l3399304224-2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>
    <?php else: ?>
        <div class="lg:px-24 lg:py-24 md:py-20 md:px-44 px-4 py-24 items-center flex justify-center flex-col-reverse lg:flex-row md:gap-28 gap-16">
            <div class="xl:pt-24 w-full xl:w-1/2 relative pb-12 lg:pb-0">
                <div class="relative">
                    <div class="absolute">
                        <div class="">
                            <h1 class="my-2 text-gray-800 font-bold text-2xl">
                                Opps !! The container you're looking for is no longer available
                            </h1>
                            <p class="my-2 text-gray-800">This container has been removed from the portal/system. Sorry for the inconvenience caused</p>
                            <button wire:click="goTo(/shipments/containers)" class="sm:w-full lg:w-auto my-2 border rounded md py-4 px-8 text-center bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Go to Containers</button>
                        </div>
                    </div>
                    <div>
                        <img src="https://i.ibb.co/G9DC8S0/404-2.png" />
                    </div>
                </div>
            </div>
            <div>
                <img src="https://i.ibb.co/ck1SGFJ/Group.png" />
            </div>
        </div>
    <?php endif; ?>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire/shipments/view-container.blade.php ENDPATH**/ ?>