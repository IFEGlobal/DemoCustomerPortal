<div>
    <div>
        <div class="rounded-lg bg-white px-2.5 py-2 dark:bg-navy-600">
            <div class="flex items-center justify-center space-x-1">
                <p>
                    <span class="text-lg font-medium items-center text-xs text-center text-slate-700 dark:text-navy-100">Test Organisation</span>
                </p>
            </div>
        </div>
        <h2 class="text-xs+ font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 mt-2">
            Account Resources
        </h2>
        <div class="rounded-lg bg-white dark:bg-transparent px-2.5 py-2 dark:bg-navy-600">
            <div class="swiper mt-3 px-3" x-init="$nextTick(() => new Swiper($el, { slidesPerView: 'auto', spaceBetween: 16 }))">
                <div class="swiper-wrapper">
                    <div class="swiper-slide relative flex h-auto w-auto flex-col overflow-hidden rounded-xl bg-gray-200 dark:gb-gray-800 p-3">
                        <div class="grow text-center">
                            <img src="<?php echo e(URL::to('/icons/right-side-user.svg')); ?>" class="flex-shrink-0 w-6 h-6" aria-hidden="true">
                        </div>
                        <div class="text-white dark:text-gray-800">
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-800">
                                Accountant Manager
                            </p>
                            <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                Test Staff Member
                            </p>
                        </div>
                        <div
                            class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="rounded-lg bg-slate-150 px-2.5 py-2 dark:bg-navy-600 mt-2">
        <div class="flex items-center justify-between space-x-1">
            <p>
                <span class="text-lg font-medium text-slate-700 dark:text-navy-100">Global Credit Limit</span>
            </p>
            <img src="<?php echo e(URL::to('/icons/credit-card.svg')); ?>" class="flex-shrink-0 w-4.5 h-4.5" aria-hidden="true">
        </div>
        <p class="mt-0.5 text-tiny+ uppercase">
            100,000.00 GBP
        </p>
        <div class="progress mt-3 h-1.5 bg-success/15 dark:bg-success/25">
            <div class="relative overflow-hidden rounded-full bg-success"
                 style="width:25%"></div>
        </div>
        <div class="mt-1.5 flex items-center justify-between text-xs text-slate-400 dark:text-navy-300">
            <p class="mt-0.5 text-tiny+ uppercase">Current Balance</p>
            <span>25,000.00 GBP</span>
        </div>
    </div>
    <div class="text-gray-600 mt-2">
        <div class="mx-auto container flex">
            <div class="flex flex-col space-y-8 w-full w-full">
                <!-- card -->
                <div class="bg-gradient-to-tl from-gray-900 to-gray-800 text-white h-48 w-full p-6 rounded-xl shadow-md">
                    <div class="h-full flex flex-col justify-between">
                        <div class="flex items-start justify-between space-x-4">
                            <div class=" text-xs font-semibold tracking-tigh">
                                Test Organisation
                            </div>
                            <div class="inline-flex flex-col items-center justify-center">
                                <img class="h-5" src="<?php echo e(URL::to('/logos/SmartLogisticsPortal_final_logo-02.png')); ?>" alt="image" />
                                <div class="font-semibold text-xs text-white">
                                    Credit
                                </div>
                            </div>
                        </div>
                        <div class="inline-block w-12 h-8 bg-gradient-to-tl from-yellow-200 to-yellow-100 rounded-md shadow-inner overflow-hidden">
                            <div class="relative w-full h-full grid grid-cols-2 gap-1">
                                <div class="absolute border border-gray-900 rounded w-4 h-6 left-4 top-1"></div>
                                <div class="border-b border-r border-gray-900 rounded-br"></div>
                                <div class="border-b border-l border-gray-900 rounded-bl"></div>
                                <div class=""></div>
                                <div class=""></div>
                                <div class="border-t border-r border-gray-900 rounded-tr"></div>
                                <div class="border-t border-l border-gray-900 rounded-tl"></div>
                            </div>
                        </div>
                        <div class="">
                            <div class="text-xs font-semibold tracking-tight">
                                balance
                            </div>
                            <div class="text-2xl font-semibold">
                                £75,000.00
                            </div>
                            <div class="text-xs font-semibold">
                                Credit Utilization 25%
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php /**PATH /var/www/html/DemoCustomerPortal/resources/views/livewire/right-side-bar/organisation-details-component.blade.php ENDPATH**/ ?>