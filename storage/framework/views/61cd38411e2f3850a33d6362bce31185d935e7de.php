<div class="main-sidebar">
    <div
        class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800">
        <!-- Application Logo -->
        <div class="flex pt-4">
            <a href="/dashboard">
                <img class="h-9 w-10 transition-transform duration-500 ease-in-out hover:rotate-[360deg]" src="<?php echo e(asset('/logos/SmartLogisticsPortal_final_icon-01.png')); ?>" alt="logo" />
            </a>
        </div>

        <!-- Main Sections Links -->
        <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6">
            <!-- Dashboard -->
            <a href="<?php echo e(route('dashboard')); ?>"
               class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'dashboard' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
                x-tooltip.placement.right="'Dashboards'">
                <img src="<?php echo e(URL::to('/icons/dashboard.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
            </a>

            <!-- Analytics -->
            <a href="<?php echo e(route('analytics')); ?>"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'analytics' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
                x-tooltip.placement.right="'Analytics'">
                <img src="<?php echo e(URL::to('/icons/pie-chart.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
            </a>

            <!-- Shipments -->
            <a href="<?php echo e(route('shipments')); ?>"
               class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'shipments' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
               x-tooltip.placement.right="'Shipments'">
                <img src="<?php echo e(URL::to('/icons/cargo-ship-icon.svg')); ?>" class="flex-shrink-0 w-7 h-7" aria-hidden="true">
            </a>

            <!-- Transport -->
            <a href="<?php echo e(route('deliveries')); ?>"
               class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'deliveries' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
               x-tooltip.placement.right="'Deliveries'">
                <img src="<?php echo e(URL::to('/icons/delivery-truck.svg')); ?>" class="flex-shrink-0 w-7 h-7" aria-hidden="true">
            </a>








            <!-- Documents -->
            <a href="<?php echo e(route('documents')); ?>"
               class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'documents' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
               x-tooltip.placement.right="'Documents'">
                <img src="<?php echo e(URL::to('/icons/paper.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
            </a>

            <!-- Documents -->
            <a href="<?php echo e(route('invoices')); ?>"
               class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 <?php echo e($routePrefix === 'invoices' ? 'text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-navy-600 bg-primary/10 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25'); ?>"
               x-tooltip.placement.right="'Invoicing'">
                <img src="<?php echo e(URL::to('/icons/invoice.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
            </a>
        </div>

        <!-- Bottom Links -->
        <div class="flex flex-col items-center space-y-3 py-3">
            <!-- Settings -->
            <a href="<?php echo e(route('profile')); ?>"
                class="flex h-11 w-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-opacity="0.3" fill="currentColor"
                        d="M2 12.947v-1.771c0-1.047.85-1.913 1.899-1.913 1.81 0 2.549-1.288 1.64-2.868a1.919 1.919 0 0 1 .699-2.607l1.729-.996c.79-.474 1.81-.192 2.279.603l.11.192c.9 1.58 2.379 1.58 3.288 0l.11-.192c.47-.795 1.49-1.077 2.279-.603l1.73.996a1.92 1.92 0 0 1 .699 2.607c-.91 1.58-.17 2.868 1.639 2.868 1.04 0 1.899.856 1.899 1.912v1.772c0 1.047-.85 1.912-1.9 1.912-1.808 0-2.548 1.288-1.638 2.869.52.915.21 2.083-.7 2.606l-1.729.997c-.79.473-1.81.191-2.279-.604l-.11-.191c-.9-1.58-2.379-1.58-3.288 0l-.11.19c-.47.796-1.49 1.078-2.279.605l-1.73-.997a1.919 1.919 0 0 1-.699-2.606c.91-1.58.17-2.869-1.639-2.869A1.911 1.911 0 0 1 2 12.947Z" />
                    <path fill="currentColor"
                        d="M11.995 15.332c1.794 0 3.248-1.464 3.248-3.27 0-1.807-1.454-3.272-3.248-3.272-1.794 0-3.248 1.465-3.248 3.271 0 1.807 1.454 3.271 3.248 3.271Z" />
                </svg>
            </a>

            <!-- Profile -->
            <div x-data="usePopper({ placement: 'right-end', offset: 12 })" @click.outside="if(isShowPopper) isShowPopper = false" class="flex">
                <button @click="isShowPopper = !isShowPopper" x-ref="popperRef" class="avatar h-12 w-12">
                    <img class="rounded-full" src="<?php echo e(auth()->user()->getAvatar()); ?>" alt="avatar" />
                    <span
                        class="absolute right-0 h-3.5 w-3.5 rounded-full border-2 border-white bg-success dark:border-navy-700"></span>
                </button>
                <div :class="isShowPopper && 'show'" class="popper-root fixed" x-ref="popperRoot">
                    <div
                        class="popper-box w-64 rounded-lg border border-slate-150 bg-white shadow-soft dark:border-navy-600 dark:bg-navy-700">
                        <div class="flex items-center space-x-4 rounded-t-lg bg-slate-100 py-5 px-4 dark:bg-navy-800">
                            <div class="avatar h-14 w-14">
                                <img class="rounded-full" src="<?php echo e(auth()->user()->getAvatar()); ?>" alt="avatar" />
                            </div>
                            <div>
                                <div class="text-base font-medium text-slate-700 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                    <?php echo e(auth()->user()->name); ?>

                                </div>
                                <div class="text-xs text-slate-400 dark:text-navy-300">
                                    <?php echo e(auth()->user()->email); ?>

                                </div>
                            </div>
                        </div>
























































































































                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/components/app-partials/main-sidebar.blade.php ENDPATH**/ ?>