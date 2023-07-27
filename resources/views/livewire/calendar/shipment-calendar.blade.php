<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">Calendar Dashboard</h2>

                    <div class="inline-flex rounded-md shadow-sm mt-2" role="group">
                        <button x-tooltip.placement.bottom="'Go To Live Dashboard'" wire:click="goToLiveDashboard()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/live-icon.svg" class="h-4 w-4 hover:animate-pulse">
                        </button>
                        <button x-tooltip.placement.bottom="'Go To Favorites'" wire:click="goToFavorites()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/star.svg" class="h-4 w-4 hover:animate-pulse">
                        </button>
                        <button x-tooltip.placement.bottom="'Go To Priorities'" wire:click="goToPriorities()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-r-md hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/danger.svg" class="h-4 w-4 hover:animate-pulse">
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-9">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4">

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('ShipmentsThisWeek','Shipment','Shipments Arriving This Week')" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="{{ URL::to('/icons/due-to-arrive-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $Arrivals ?? 0 }} Shipment Arrivals </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfWeek(0)->format('d M')}} to {{ now()->endOfWeek(6)->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('DeparturesThisWeek','Shipment','Shipments Departing This Week')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/due-to-depart-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $Departures ?? 0 }} Shipment Departures </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfWeek(0)->format('d M')}} to {{ now()->endOfWeek(6)->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('ClearancesThisWeek','Shipment','Shipments Clearing This Week')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/validation.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $Clearances ?? 0 }} Shipment Clearances </h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfWeek(0)->format('d M')}} to {{ now()->endOfWeek(6)->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('DeliveriesThisWeek','Deliveries','Containers Delivering This Week')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/container-delivery-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $Deliveries ?? 0 }} Container Deliveries </h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfWeek(0)->format('d M')}} to {{ now()->endOfWeek(6)->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('ShipmentsThisMonth','Shipment','Shipments Arriving This Month')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="{{ URL::to('/icons/due-to-arrive-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $ArrivalsThisMonth ?? 0 }} Shipment Arrivals </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfMonth()->format('d M')}} to {{ now()->endOfMonth()->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('DeparturesThisMonth','Shipment','Shipments Departing This Month')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/due-to-depart-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $DeparturesThisMonth ?? 0 }} Shipment Departures </h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfMonth()->format('d M')}} to {{ now()->endOfMonth()->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('ClearancesThisMonth','Shipment','Shipments Clearing This Month')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/validation.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $ClearancesThisMonth ?? 0 }} Shipment Clearances </h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfMonth()->format('d M')}} to {{ now()->endOfMonth()->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="ExportCard('DeliveriesThisMonth','Deliveries','Containers Delivering This Month')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="{{ URL::to('/icons/container-delivery-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $DeliveriesThisMonth ?? 0 }} Container Deliveries </h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">From {{now()->startOfMonth()->format('d M')}} to {{ now()->endOfMonth()->format('d M Y') }}</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-span-12 lg:col-span-3">
                <div class="card bg-white h-full p-4 dark:bg-gray-800 shadow-lg">
                    <div class="flex items-center space-x-3">
                        <div class="flex">
                            <div class="avatar">
                                <img class="rounded-full" src="/icons/robot.gif" alt="avatar">
                            </div>
                        </div>
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">Tips Bot</p>
                            <p class="text-xs text-indigo-400">Here to help</p>
                        </div>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You Can <strong>Click</strong> on any card to download detailed data from calendar.
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You can also <strong>Click</strong> on the calendar go to the shipment or delivery.
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-3">
                @if (session()->has('message'))
                    <div class="alert flex overflow-hidden rounded-lg bg-warning/10 text-warning dark:bg-warning/15">
                        <div class="flex flex-1 items-center space-x-3 p-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <div class="flex-1">{{ session('message') }}</div>
                        </div>
                        <div class="w-1.5 bg-warning"></div>
                    </div>
                @endif
            </div>

            <div class="col-span-12 block p-6 max-w-full bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800">
                <livewire:calendar.appointment-calendar before-calendar-view="calendar/before"/>
            </div>

        </div>
    </main>
</div>
