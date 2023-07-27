<div>
    <?php if($record): ?>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Viewing Shipment <?php echo e($record->shipment_ref); ?></h2>

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
                            <button  x-tooltip.placement.bottom="'Go To Shipments'" wire:click="goTo('/shipments/shipments')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/cargo-ship-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                        </div>

                        <?php if(isset($record->timeCritical->completion_date)): ?>
                            <div class="inline-flex mt-2 mr-10" role="group">
                                <?php if($record->timeCritical->KPI == 'Awaiting Completion'): ?>
                                    <span class="bg-orange-100 text-orange-800 text-lg font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-900">
                                            Awaiting Completion
                                    </span>
                                <?php elseif($record->timeCritical->KPI == 'Not Met'): ?>
                                    <span class="bg-red-100 text-red-800 text-lg font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-red-200 dark:text-red-900">
                                        Not Met
                                    </span>
                                <?php elseif($record->timeCritical->KPI == 'Satisfied'): ?>
                                    <span class="bg-orange-100 text-orange-800 text-lg font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-orange-200 dark:text-orange-900">
                                        Satisfied
                                    </span>
                                <?php elseif($record->timeCritical->KPI == 'Excellent'): ?>
                                    <span class="bg-green-100 text-green-800 text-lg font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-green-200 dark:text-green-900">
                                        Excellent
                                    </span>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center px-2 mb-10 col-span-12">
                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/arrived.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->estimated_arrival?->format('d M Y H:i') ?? "Awating Arrival Date"); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Estimated arrival
                                        <?php if( $record->estimated_arrival !== null): ?>
                                            <?php if( $record->estimated_arrival > now() ): ?>
                                                in <?php echo e($record->estimated_arrival->diffInDays(now())); ?> days from now</p>
                                            <?php endif; ?>
                                       <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <?php if($record->transport_mode == "AIR"): ?>
                                        <img src="/icons/airfreight-icon.svg" width="80">
                                    <?php elseif($record->transport_mode == "COU"): ?>
                                        <img src="/icons/boxes.svg" width="80">
                                    <?php elseif($record->transport_mode == "ROA"): ?>
                                        <img src="/icons/truck.svg" width="80">
                                    <?php else: ?>
                                        <img src="/icons/ship-port-arrival-icon.svg" width="80">
                                    <?php endif; ?>
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->port_arrival_date?->format('d M Y H:i') ?? $record->estimated_arrival?->format('d M Y H:i') ?? "Awating Port Date"); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Date scheduled to arrive at port</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if($record->cleared_date !== null): ?>
                    <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/cleared-date-icon.svg" width="80">
                                    </div>

                                    <div class="ml-4">
                                        <h2 class="font-semibold"><?php echo e($record->cleared_date?->format('d-M-Y H:i') ?? '-'); ?> </h2>
                                        <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Date goods were cleared</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/transit-time-icon.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->transitTimeAttribute() ?? 0); ?> Calendar Days</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Transit days from origin to destination</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/import-export-icon.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->getDirectionAttribute() ?? '-'); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Transit type based on direction</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($courierTracking !== null): ?>
                    <div wire:click="goTo('<?php echo e($courierTracking); ?>')" class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2 cursor-pointer">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/link.svg" width="80">
                                    </div>

                                    <div class="ml-4">
                                        <h2 class="font-semibold">Track Shipment</h2>
                                        <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">External Link to <?php echo e($this->record->courier); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>



                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <?php if($record->shipmentDataStatusAttribute() == 'Active'): ?>
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/live-icon.svg" width="80">
                                    </div>
                                <?php else: ?>
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/archive-icon.svg" width="80">
                                    </div>
                                <?php endif; ?>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->shipmentDataStatusAttribute()); ?> </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Removed from live around <?php echo e($record->port_arrival_date?->addDays(14)->format('d M Y') ??  $record->estimated_arrival?->format('d M Y')); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php if(isset($record->timeCritical->comments)): ?>
                    <div class="w-full px-2">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/chat.svg" width="80">
                                    </div>

                                    <div class="ml-4">
                                        <h2 class="font-semibold">Time Critical Comments</h2>
                                        <p class="mt-2 text-sm font-semibold text-gray-800n ti-text-wrap dark:text-white"><?php echo e($this->record->timeCritical->comments ?? null); ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>

            <?php if($record->estimated_departure < now()): ?>
                <div class="inline-block w-full mt-4 mb-12 col-span-12">
                    <div class="mx-auto">
                        <div class="w-full h-1 flex items-center justify-between">
                            <div class="h-1 flex items-center">
                                <div class="h-6 w-6 flex items-center justify-center">
                                    <img src="<?php echo e(URL::to('/icons/location.svg')); ?>" class ="h-6 w-6">
                                </div>
                            </div>
                            <?php if(is_int($record->getRemainingDaysAttribute())): ?>
                                <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                                    <div class="bg-blue-800 h-3 rounded-full" style="width: <?php echo e($this->record->trackingSliderAttribute()); ?>%">
                                        <div class="flex justify-end">
                                            <?php if($record->trackingSliderAttribute() < 100): ?>
                                                <div x-tooltip.interactive.content="'#vesselContent'">
                                                <template id="vesselContent">
                                                    <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                                        <div class="avatar">
                                                            <?php if($record->transport_mode == "AIR"): ?>
                                                                <img class="rounded-full" src="/icons/airfreight-icon.svg" width="80">
                                                            <?php elseif($record->transport_mode == "COU"): ?>
                                                                <img class="rounded-full" src="/icons/boxes.svg" width="80">
                                                            <?php elseif($record->transport_mode == "ROA"): ?>
                                                                <img class="rounded-full" src="/icons/truck.svg" width="80">
                                                            <?php else: ?>
                                                                <img class="rounded-full" src="/icons/due-to-depart-icon.svg" alt="image"/>
                                                            <?php endif; ?>
                                                        </div>
                                                        <div>
                                                            <p class="font-medium text-slate-700 dark:text-navy-100"><?php echo e($record->vessel ?? 'Awaiting Transport'); ?></p>
                                                            <p class="text-xs text-slate-500 dark:text-navy-200"><?php echo e($record->voyage ?? ''); ?></p>
                                                        </div>
                                                    </div>
                                                </template>
                                                    <div class="-mt-1 rounded-full shadow flex p-1 text-xs rounded-full bg-white items-center justify-center ">
                                                        <?php if($record->transport_mode == "AIR"): ?>
                                                            <img class ="h-4 w-4" src="/icons/airfreight-icon.svg" width="80">
                                                        <?php elseif($record->transport_mode == "COU"): ?>
                                                            <img class ="h-4 w-4" src="/icons/boxes.svg" width="80">
                                                        <?php elseif($record->transport_mode == "ROA"): ?>
                                                            <img class ="h-4 w-4" src="/icons/truck.svg" width="80">
                                                        <?php else: ?>
                                                            <img class ="h-4 w-4" src="/icons/due-to-depart-icon.svg" alt="image"/>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="flex justify-end ml-1">
                                <div class="h-6 w-6 flex items-center justify-center">
                                    <?php if($record->trackingSliderAttribute() == 100): ?>
                                        <div class="rounded-full shadow flex p-0.5 rounded-full bg-green-300 items-center justify-center">
                                            <img src="<?php echo e(URL::to('/icons/arrived.svg')); ?>" class ="h-6 w-6">
                                        </div>
                                    <?php else: ?>
                                        <img src="<?php echo e(URL::to('/icons/location.svg')); ?>" class ="h-6 w-6">
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <div class="w-full flex items-center justify-between mt-4">
                            <div class="flex items-center">
                                <div class="flex items-center justify-center">
                                    <div class="inline-block w-84 text-sm font-light bg-white rounded-lg border border-gray-200 shadow-sm transition-opacity duration-300 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div class="py-2 px-3 bg-gray-100 rounded-t-lg border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                            <h3 class="font-semibold text-gray-900 dark:text-white"><?php echo e($record->loading_port_name ?? 'Awaiting Port'); ?> </h3>
                                        </div>
                                        <div class="py-2 px-3 font-semibold text-xs text-center text-black dark:text-white">
                                            <p><?php if($record->estimated_departure > now()): ?> Estimated Departure <?php else: ?> Departure <?php endif; ?> : <?php echo e($record->estimated_departure?->format('d M Y') ?? 'Awaiting ETD Date'); ?> </p>
                                            <?php if($record->estimated_departure > now() && $record->estimated_departure !== null): ?>
                                                <p> <?php echo e($record->estimated_departure->diffInDays(now())); ?> days to go </p>
                                            <?php elseif($record->estimated_departure !== null): ?>
                                                <p><?php echo e($record->estimated_departure->diffInDays(now())); ?> days ago </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-full flex justify-end">
                                <div class="flex items-center justify-center">
                                    <div class="inline-block w-84 text-sm font-light bg-white rounded-lg border border-gray-200 shadow-sm transition-opacity duration-300 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div class="py-2 px-3 bg-gray-100 rounded-t-lg border-b border-gray-200 dark:border-gray-600 dark:bg-gray-700">
                                            <h3 class="font-semibold text-gray-900 text-center dark:text-white"><?php echo e($record->disc_port_name ?? 'Awaiting Port'); ?></h3>
                                        </div>
                                        <div class="py-2 px-3 font-semibold text-xs text-center text-black dark:text-white">
                                            <p><?php if($record->estimated_arrival > now()): ?>Estimated Arrival <?php else: ?> Arrival <?php endif; ?> : <?php echo e($record->estimated_arrival?->format('d M Y') ?? 'Awaiting ETA Date'); ?> </p>
                                            <?php if($record->estimated_arrival !== null): ?>
                                                <?php if($record->estimated_arrival > now()): ?>
                                                    <p> <?php echo e($record->estimated_arrival->diffInDays(now())); ?> days to go </p>
                                                <?php elseif($record->estimated_arrival !== null): ?>
                                                    <p> <?php echo e($record->estimated_arrival->diffInDays(now())); ?> days ago </p>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php endif; ?>

            <div class="flex flex-wrap items-center justify-center px-2 mt-4 mb-10 col-span-12">
                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="<?php echo e(URL::to("/icons/consignee-icon.svg")); ?>" class="w-10 h-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->consignee_name ?? '-'); ?></h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Shipment Consignee</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="<?php echo e(URL::to("/icons/consignor-icon.svg")); ?>" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->consignor_name ?? '-'); ?></h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Shipment Consignor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-full sm:w-full md:w-1/3 lg:w-1/3 xl:w-1/3 mb-4 px-2">
                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="<?php echo e(URL::to("/icons/hashtag-icon.svg")); ?>" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"><?php echo e($record->PO_number ?? '-'); ?></h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-800 dark:text-white">Purchase Order Numbers</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap items-center justify-center px-2 mb-10 col-span-12">

                <?php if($record->containers()->count()): ?>
                    <div class="relative flex-grow w-full h-full bg-white shadow-lg rounded-xl dark:bg-gray-800 p-4 ml-1 mb-10 z-auto">
                        <div class="flex flex-wrap mb-4">
                            <div class="flex items-center">
                                <img src="<?php echo e(URL::to('/icons/link.svg')); ?>" class="w-8 h-8 ml-1 mr-2">
                                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Linked Containers</span>
                            </div>
                        </div>
                        <div class="relative">
                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.view-shipment-container-datatable', ['shipmentId' => $record->id])->html();
} elseif ($_instance->childHasBeenRendered('l2566935845-0')) {
    $componentId = $_instance->getRenderedChildComponentId('l2566935845-0');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2566935845-0');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2566935845-0');
} else {
    $response = \Livewire\Livewire::mount('shipments.view-shipment-container-datatable', ['shipmentId' => $record->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l2566935845-0', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($record->containerDeliveries()->count()): ?>
                        <div class="w-full h-full bg-white shadow-lg rounded-xl dark:bg-gray-800 p-4 ml-1 mb-10">
                            <div class="flex flex-wrap mb-4">
                                <div class="flex items-center">
                                    <img src="<?php echo e(URL::to('/icons/link.svg')); ?>" class="w-8 h-8 ml-1 mr-2">
                                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Linked Deliveries</span>
                                </div>
                            </div>
                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.view-shipment-deliveries-datatable', ['shipmentId' => $record->id])->html();
} elseif ($_instance->childHasBeenRendered('l2566935845-1')) {
    $componentId = $_instance->getRenderedChildComponentId('l2566935845-1');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2566935845-1');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2566935845-1');
} else {
    $response = \Livewire\Livewire::mount('shipments.view-shipment-deliveries-datatable', ['shipmentId' => $record->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l2566935845-1', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        </div>
                    <?php endif; ?>

                    <?php if($record->documents()->count()): ?>
                        <div class="w-full h-full bg-white shadow-lg rounded-xl dark:bg-gray-800 p-4 ml-1 mb-10">
                            <div class="flex flex-wrap mb-4">
                                <div class="flex items-center">
                                    <img src="<?php echo e(URL::to('/icons/link.svg')); ?>" class="w-8 h-8 ml-1 mr-2">
                                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Linked Documents</span>
                                </div>
                            </div>
                            <?php
if (! isset($_instance)) {
    $html = \Livewire\Livewire::mount('shipments.view-shipment-documents-datatable', ['shipmentId' => $record->id])->html();
} elseif ($_instance->childHasBeenRendered('l2566935845-2')) {
    $componentId = $_instance->getRenderedChildComponentId('l2566935845-2');
    $componentTag = $_instance->getRenderedChildComponentTagName('l2566935845-2');
    $html = \Livewire\Livewire::dummyMount($componentId, $componentTag);
    $_instance->preserveRenderedChild('l2566935845-2');
} else {
    $response = \Livewire\Livewire::mount('shipments.view-shipment-documents-datatable', ['shipmentId' => $record->id]);
    $html = $response->html();
    $_instance->logRenderedChild('l2566935845-2', $response->id(), \Livewire\Livewire::getRootElementTagName($html));
}
echo $html;
?>
                        </div>
                    <?php endif; ?>
            </div>

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
                                    Opps !! The shipment you're looking for is no longer available
                                </h1>
                                <p class="my-2 text-gray-800">This shipment has been removed from the portal/system. Sorry for the inconvenience caused</p>
                                <button wire:click="goTo(/shipments/shipments)" class="sm:w-full lg:w-auto my-2 border rounded md py-4 px-8 text-center bg-indigo-600 text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-700 focus:ring-opacity-50">Go to Dashboard</button>
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
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire//shipments/view-shipment.blade.php ENDPATH**/ ?>