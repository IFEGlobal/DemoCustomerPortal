<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">Favorites Dashboard</h2>

                    <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                        <button x-tooltip.placement.bottom="'Go To Live Dashboard'" wire:click="goToLiveDashboard()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/live-icon.svg" class="h-4 w-4 hover:animate-pulse">
                        </button>
                        <button x-tooltip.placement.bottom="'Go To Calendar'" wire:click="goToCalendar()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/schedule.svg" class="h-4 w-4 hover:animate-pulse">
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
                            <a wire:click="changeTable(1);" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/cargoship-icon-1.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $totalShipments ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Shipments in favorites</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="changeTable(2);" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/container-icon.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $totalContainers ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Containers in favorites</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="changeTable(3);" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/truck.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $totalDeliveries ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Deliveries in favorites</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="changeTable(4);" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/paper.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $totalDocuments ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Documents in favorites</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="removeSuggested('Shipments');"class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/remove-database.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $shipmentToRemove ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Remove arrived shipments</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="removeSuggested('Containers');" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/remove-database.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $containersToRemove ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Remove arrived containers</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="removeSuggested('Deliveries');" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/remove-database.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $deliveriesToRemove ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Remove Delivered</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a wire:click="removeSuggested('Documents');"class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-ful">
                                    <img src="/icons/remove-database.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $oldDocuments ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Remove 6+ old documents</p>
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
                            You Can <strong>Click</strong> on any card to load your favorites table.
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You Can also <strong>Click</strong> a remove card to delete all old data.
                        </p>
                    </div>
                    <div class="mt-4">
                        <p class="font-medium text-gray-900 text-xl text-center text-blue-800 underline">You've Loaded {{ $category ?? '...' }}</p>
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

            @if($category == "Shipments")
                <div id="LiveShipments" class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mt-2 ml-1 mb-4 col-span-12">
                    <div class="flex flex-wrap mb-4">
                        <div class="flex items-center">
                            <img src="{{ URL::to('/icons/star.svg') }}" class="w-5 h-5 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Shipments</span>
                        </div>
                    </div>
                    <livewire:my-space.favorite-shipments-datatable />
                </div>
            @elseif($category == "Containers")
                <div id="LiveShipments" class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mt-2 ml-1 mb-4 col-span-12">
                    <div class="flex flex-wrap mb-4">
                        <div class="flex items-center">
                            <img src="{{ URL::to('/icons/star.svg') }}" class="w-5 h-5 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Container</span>
                        </div>
                    </div>
                    <livewire:my-space.favorite-containers-datatable />
                </div>
            @elseif($category == "Deliveries")
                <div id="LiveShipments" class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mt-2 ml-1 mb-4 col-span-12">
                    <div class="flex flex-wrap mb-4">
                        <div class="flex items-center">
                            <img src="{{ URL::to('/icons/star.svg') }}" class="w-5 h-5 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Deliveries</span>
                        </div>
                    </div>
                    <livewire:my-space.favorite-deliveries-datatable />
                </div>
            @elseif($category == "Documents")
                <div id="LiveShipments" class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mt-2 ml-1 mb-4 col-span-12">
                    <div class="flex flex-wrap mb-4">
                        <div class="flex items-center">
                            <img src="{{ URL::to('/icons/star.svg') }}" class="w-5 h-5 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Documents</span>
                        </div>
                    </div>
                    <livewire:my-space.favorite-documents-datatable />
                </div>
            @endif
</div>
