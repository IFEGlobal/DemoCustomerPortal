<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
{{--        <div class="flex items-center justify-center h-screen">--}}
{{--            <div class="flex flex-col items-center justify-center max-w-lg">--}}
{{--                <div class="mb-4">--}}
{{--                    <h1 class="text-5xl font-extrabold text-blue-600">Notice</h1>--}}
{{--                </div>--}}
{{--                <h3 class="mb-3 text-2xl font-bold text-center text-gray-700">--}}
{{--                    Temporarily down for maintenance--}}
{{--                </h3>--}}
{{--                <p class="text-sm text-center text-gray-600">--}}
{{--                    We are undertaking server maintenance from Friday 7th of July 2023 @ 17:00 until Monday 10th July 2023 @ 09:00--}}
{{--                </p>--}}

{{--                <p class="text-sm text-center text-gray-600 mt-2">--}}
{{--                    You will still be able to access your portal, however, data will not be refreshed until maintenance has been completed.--}}
{{--                </p>--}}

{{--                <p class="text-sm text-center text-gray-600 mt-2">--}}
{{--                    We apologise for any inconvenience caused--}}
{{--                </p>--}}

{{--                <h3 class="mb-3 text-2xl mt-3 font-bold text-center text-gray-700">--}}
{{--                    We’ll be back soon!--}}
{{--                </h3>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">Live Dashboard</h2>

                    <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                        <button x-tooltip.placement.bottom="'Go To Calendar'" wire:click="goToCalendar()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                            <img src="/icons/schedule.svg" class="h-4 w-4 hover:animate-pulse">
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
                            <div wire:click="goToShipments" class="flex items-start rounded-xl cursor-pointer bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/transportation.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['AllShipments'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">All Shipments</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a href="#LiveShipments" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/live-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['LiveShipments'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Live Shipments Inc Dlv</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/average.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['AverageShipmentsMonthly'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Shipments Monthly</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="goToContainers" class="flex items-start cursor-pointer rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/container-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold"> {{ $stats['TotalContainers'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">All Containers</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a href="#LiveContainers" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/live-icon.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['LiveContainers'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Live Containers</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/shipping.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['TotalCarriersUsed'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Carriers Used</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a href="#LiveDeliveries" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/truck.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['TotalLiveDeliveries'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Live Deliveries</p>
                                </div>
                            </a>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <a href="#LiveDocuments" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="{{ URL::to('/icons/paper.svg') }}" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $stats['LiveDocuments'] ?? 0}}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Live Documents</p>
                                </div>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-span-12 lg:col-span-3">
                <div class="w-full py-4 bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                    <div class="flex justify-center">
                        <div class="relative">
                            <img src="{{ auth()->user()->getAvatar() }}" class="rounded-full h-10 w-10">
                        </div>
                    </div>
                    <div class="flex flex-col text-center mt-2 mb-1">
                        <span class="text-lg font-medium">Welcome, {{ auth()->user()->name }}</span>
                    </div>
                    <div class="px-10 mb-2 text-center">
                        <span class="bg-gray-100 h-5 p-1 px-3 rounded text-xs cursor-pointer hover:shadow hover:bg-gray-200">Login {{ \Carbon\Carbon::parse(auth()->user()->last_login_at)?->format('D d M') ?? '-' }} at {{ \Carbon\Carbon::parse(auth()->user()->last_login_at)?->format('h:i A') ?? 'First Login' }}</span>
                    </div>
                    <div class="flex items-center justify-center mt-2">
                        <button type="button" wire:click="$emit('switch')" class="text-white bg-blue-700 hover:bg-blue-900 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-xs px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 mr-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M7.5 21L3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                            </svg>
                            {{ $currentForwarder ?? 'No Forwarder'}}
                        </button>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="button" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white text-xs bg-red-500 hover:bg-red-600 hover:text-white border border-gray-200 font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-gray-600 dark:bg-gray-800 dark:border-gray-700 dark:text-white dark:hover:bg-gray-700 mr-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-1">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                                </svg>
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @if(in_array('CARN001', auth()->user()->access()->pluck('client_code')->toArray()))
                <div id="TimeCritical" class="card col-span-12 lg:col-span-12 p-4">
                    <div class="flex flex-wrap mb-4">
                        <div class="flex items-center">
                            <img src="{{ URL::to('/icons/live-icon.svg') }}" class="w-10 h-10 ml-1 mr-2">
                            <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Time Critical</span>
                        </div>
                    </div>
                    <livewire:dashboard.time-critical-datatable />
                </div>
            @endif


            <div id="LiveShipments" class="card col-span-12 lg:col-span-12 p-4">
                <div class="flex flex-wrap mb-4">
                    <div class="flex items-center">
                        <img src="{{ URL::to('/icons/live-icon.svg') }}" class="w-10 h-10 ml-1 mr-2">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Shipments</span>
                    </div>
                </div>
                <livewire:dashboard.live-shipments-datatable />
            </div>

            <div id="LiveContainers" class="card col-span-12 lg:col-span-12 p-4">
                <div class="flex flex-wrap mb-4">
                    <div class="flex items-center">
                        <img src="{{ URL::to('/icons/live-icon.svg') }}" class="w-10 h-10 ml-1 mr-2">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Containers</span>
                    </div>
                </div>
                <livewire:dashboard.live-containers-datatable />
            </div>

            <div id="LiveDeliveries" class="card col-span-12 lg:col-span-12 p-4">
                <div class="flex flex-wrap mb-4">
                    <div class="flex items-center">
                        <img src="{{ URL::to('/icons/live-icon.svg') }}" class="w-10 h-10 ml-1 mr-2">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Deliveries</span>
                    </div>
                </div>
                <livewire:dashboard.live-deliveries-datatable />
            </div>

            <div id="LiveDocuments" class="card col-span-12 lg:col-span-12 p-4">
                <div class="flex flex-wrap mb-4">
                    <div class="flex items-center">
                        <img src="{{ URL::to('/icons/live-icon.svg') }}" class="w-10 h-10 ml-1 mr-2">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Documents</span>
                    </div>
                </div>
                <livewire:dashboard.live-documents-datatable />
            </div>

        </div>
    </main>
</div>
