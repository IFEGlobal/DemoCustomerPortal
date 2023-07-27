<div>
    <div x-effect="if($store.global.isSearchbarActive) isShowPopper = false" x-data="usePopper({ placement: 'bottom-end', offset: 12 })" @click.outside="if(isShowPopper) isShowPopper = false" class="flex w-full">
        <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="btn relative h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
            <img class="h-5.5 w-5.5 object-cover object-center" src="<?php echo e(URL::to('/icons/notification.svg')); ?>" alt="image" />
            <div wire:poll.30s class="absolute inline-flex items-center justify-center w-5 h-5 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-1 -right-1 dark:border-gray-900"><?php echo e($notifications->count()); ?></div>
        </button>
        <div :class="isShowPopper && 'show'" class="popper-root" style="position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-98px, 66px);">
            <div x-data="{ activeTab: 'tabAll' }"
                 class="popper-box mx-4 mt-1 flex max-h-[calc(100vh-6rem)] w-[calc(100vw-2rem)] flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark sm:m-0 sm:w-80">
                <div class="rounded-t-lg bg-slate-100 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                    <div class="flex items-center justify-between px-4 pt-2">
                        <div class="flex items-center space-x-2">
                            <h3 class="font-medium text-slate-700 dark:text-navy-100">
                                Notifications
                            </h3>
                            <div class="badge h-5 rounded-full bg-primary/10 px-1.5 text-primary dark:bg-accent-light/15 dark:text-accent-light">
                                <?php echo e($notifications->count()); ?>

                            </div>
                        </div>

                        <a href="/profile" class="btn -mr-1.5 h-7 w-7 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </a>
                    </div>

                    <div class="is-scrollbar-hidden flex shrink-0 overflow-x-auto px-1">
                        <button x-tooltip.interactive.content="'#AllNotifications'" @click="activeTab = 'tabAll'" :class="activeTab === 'tabAll' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none border-b-2 text-xs+ px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/notification.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#ArrivalNotifications'" @click="activeTab = 'tabArrivals'" :class="activeTab === 'tabArrivals' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/transit-time-icon.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#UpdateNotifications'" @click="activeTab = 'tabUpdates'" :class="activeTab === 'tabUpdates' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/warning.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#ShipmentNotifications'" @click="activeTab = 'tabShipments'" :class="activeTab === 'tabShipments' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/cargoship-icon-1.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#ContainerNotifications'" @click="activeTab = 'tabContainers'" :class="activeTab === 'tabContainers' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/container-teu.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#ContainerDeliveryNotification'" @click="activeTab = 'tabDeliveries'" :class="activeTab === 'tabDeliveries' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-5 w-5 object-cover object-center" src="<?php echo e(URL::to('/icons/truck.svg')); ?>" alt="image" />
                        </button>
                        <button x-tooltip.interactive.content="'#DocumentNotification'" @click="activeTab = 'tabDocuments'" :class="activeTab === 'tabDocuments' ?'border-primary dark:border-accent text-primary dark:text-accent-light' :'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'" class="btn shrink-0 rounded-none text-xs+ border-b-2 px-3.5 py-2.5">
                            <img class="h-4 w-4 object-cover object-center" src="<?php echo e(URL::to('/icons/paper.svg')); ?>" alt="image" />
                        </button>

                        <template id="AllNotifications">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/notification.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">All Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="ArrivalNotifications">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/transit-time-icon.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Arrival Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread arrival notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="UpdateNotifications">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/warning.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Update Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread updates notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="ShipmentNotifications">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/cargoship-icon-1.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Shipment Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread shipment notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="ContainerNotifications">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/container-teu.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Container Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread container notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="ContainerDeliveryNotification">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/truck.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Delivery Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread delivery notifications</p>
                                </div>
                            </div>
                        </template>

                        <template id="DocumentNotification">
                            <div class="flex space-x-3 rounded-lg bg-slate-150 p-3 dark:bg-navy-500">
                                <div class="avatar">
                                    <img class="rounded-full" src="<?php echo e(URL::to('/icons/paper.svg')); ?>" alt="image"/>
                                </div>
                                <div>
                                    <p class="font-medium text-slate-700 dark:text-navy-100">Document Notifications</p>
                                    <p class="text-xs text-slate-500 dark:text-navy-200">All unread documents notifications</p>
                                </div>
                            </div>
                        </template>

                    </div>
                </div>

                <div class="tab-content flex flex-col overflow-hidden">
                    <div x-show="activeTab === 'tabAll'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php if(auth()->user()->notificationSettings()->doesntExist()): ?>
                            <div class="flex items-center space-x-3">
                                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-secondary/10 dark:bg-secondary-light/15">
                                    <img class="h-5 w-5 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/warning.svg')); ?>" alt="image" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        No Settings Found
                                    </p>
                                    <div class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        Please configure notification settings
                                    </div>
                                </div>
                            </div>
                        <?php elseif($notifications->count() < 1): ?>
                            <div class="flex items-center space-x-3">
                                <div
                                    class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-secondary/10 dark:bg-secondary-light/15">
                                    <img class="h-5 w-5 rounded-lg object-cover object-center" src="<?php echo e(URL::to('/icons/chat.svg')); ?>" alt="image" />
                                </div>
                                <div>
                                    <p class="font-medium text-slate-600 dark:text-navy-100">
                                        No New Notifications
                                    </p>
                                    <div class="mt-1 text-xs text-slate-400 line-clamp-1 dark:text-navy-300">
                                        There doesn't seem to be any notifications here
                                    </div>
                                </div>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                    <div x-show="activeTab === 'tabArrivals'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Arrival Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div x-show="activeTab === 'tabUpdates'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Update Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div x-show="activeTab === 'tabShipments'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Shipment Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div x-show="activeTab === 'tabContainers'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Container Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div x-show="activeTab === 'tabDeliveries'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Delivery Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <div x-show="activeTab === 'tabDocuments'"
                         x-transition:enter="transition-all duration-300 easy-in-out"
                         x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                         x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                         class="is-scrollbar-hidden space-y-4 overflow-y-auto px-4 py-4">
                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($notification->data[0]['type'] == 'Document Notification'): ?>
                                <div class="flex items-center space-x-4">
                                    <a href="<?php echo e("https://logisticsmartportal.com/".$notification->data[0]['route'] ?? '#'); ?>" class="flex-1 cursor-pointer min-w-0">
                                        <p class="text-xs+ text-gray-500 dark:text-gray-400">
                                            <span class="flex">
                                                <img class="w-6 h-6 mr-2" src="<?php echo e(URL::to($notification->data[0]['icon']) ?? null); ?>" alt="icon"> <?php echo e($notification->data[0]['message'] ?? 'No Message'); ?>

                                                : <?php echo e($notification->created_at->diffForHumans()); ?>

                                            </span>
                                        </p>
                                    </a>
                                    <div wire:click="markNotificationAsRead('<?php echo e($notification->id); ?>')" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <img x-tooltip="'Mark as read'" class="w-5 h-5" src="<?php echo e(URL::to('/icons/validation.svg')); ?>" alt="icon">
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
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire/user/notification-component.blade.php ENDPATH**/ ?>