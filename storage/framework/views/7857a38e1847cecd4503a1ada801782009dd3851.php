<div>
    <div x-effect="if($store.global.isSearchbarActive) isShowPopper = false" x-data="usePopper({ placement: 'bottom-end', offset: 12 })" @click.outside="if(isShowPopper) isShowPopper = false" class="flex w-full">
        <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="btn relative h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
            <img class="h-5 w-5 object-cover object-center" src="<?php echo e(URL::to('/icons/files.svg')); ?>" alt="image" />
        </button>
        <div :class="isShowPopper && 'show'" class="popper-root" style="position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate(-98px, 66px);">
            <div class="popper-box mx-4 mt-1 flex max-h-[calc(100vh-6rem)] w-[calc(100vw-2rem)] flex-col rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-800 dark:bg-navy-700 dark:shadow-soft-dark sm:m-0 sm:w-80">
                <div class="rounded-t-lg bg-slate-100 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                    <div class="flex items-center justify-between px-4 pt-2">
                        <div class="flex items-center space-x-2 p-2">
                            <h3 class="font-medium text-slate-700 dark:text-navy-100">
                                <span class="inline-flex">
                                    <img class="w-5 h-5 mr-2" src="/icons/files.svg"> Portal Documentation
                                </span>
                            </h3>
                        </div>
                    </div>
                </div>

                <div class="tab-content flex flex-col overflow-hidden">
                    <div class="is-scrollbar-hidden overflow-y-auto">
                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700 p-1">
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-5 h-5 ml-1" src="<?php echo e(URL::to('/icons/api.svg')); ?>">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-gray-900 truncate dark:text-white">
                                            API Documentation
                                        </p>
                                        <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                            How to configure and use our API.
                                        </p>
                                    </div>
                                    <a a href="/APIDocumentation" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <svg x-tooltip="'Open Documentation'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-600 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-4 h-4 ml-1" src="<?php echo e(URL::to('/icons/e-learning.svg')); ?>" >
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-gray-900 truncate dark:text-white">
                                            Data Service Documentation
                                        </p>
                                        <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                            Setting up event API services.
                                        </p>
                                    </div>
                                    <a href="/DataServiceDocumentation" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <svg x-tooltip="'Open Documentation'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-600 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                            <li class="py-3 sm:py-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex-shrink-0">
                                        <img class="w-4 h-4 ml-1" src="/icons/order-now.svg">
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-xs font-medium text-gray-900 truncate dark:text-white">
                                            Portal Documentation
                                        </p>
                                        <p class="text-xs text-gray-500 truncate dark:text-gray-400">
                                            Using Your Portal
                                        </p>
                                    </div>
                                    <a href="/PortalDocumentation" class="inline-flex cursor-pointer items-center text-xs+ text-gray-900 dark:text-white">
                                        <svg x-tooltip="'Open Documentation'" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 text-blue-600 mr-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 3.75H6A2.25 2.25 0 003.75 6v1.5M16.5 3.75H18A2.25 2.25 0 0120.25 6v1.5m0 9V18A2.25 2.25 0 0118 20.25h-1.5m-9 0H6A2.25 2.25 0 013.75 18v-1.5M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire/documentation/document-navigation.blade.php ENDPATH**/ ?>