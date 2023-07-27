<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">All Documents</h2>

                    <div class="inline-flex mt-2">
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

                        <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                            <button  x-tooltip.placement.bottom="'Go To Shipments'" wire:click="goToContainers()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-l-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/cargo-ship-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                            <button x-tooltip.placement.bottom="'Go To Containers'" wire:click="goToCalendar()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/container-icon.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                            <button x-tooltip.placement.bottom="'Go To Deliveries'" wire:click="goToDeliveries()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-r-md hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700" >
                                <img src="/icons/truck.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                        </div>
                    </div>


                    <div class="inline-flex rounded-md bg-white dark:bg-gray-800 shadow-sm mt-2 mr-10" role="group">
                            <button  x-tooltip.placement.bottom="'Go To Invoices'" wire:click="goToInvoices()" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/invoice.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                    </div>

                </div>
            </div>

            <div class="col-span-12 lg:col-span-9">
                <div class="grid grid-cols-2 gap-3 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4">

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'clearFilters')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/paper.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $AllDocuments ?? 0 }}</h2>
                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">All documents</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'updated', '2')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                    <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                        <img src="/icons/7-days.svg" width="80">
                                    </div>

                                    <div class="ml-4">
                                        <h2 class="font-semibold">{{ $DocumentsThisWeek ?? 0 }}</h2>
                                        <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Received {{ now()->startOfWeek()->format('d') }} - {{ now()->endOfWeek()->format('d') }} of {{ now()->format('M y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'received', '2')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/month.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $DocumentsThisMonth ?? 0 }}</h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Received {{ now()->startOfMonth()->format('d') }} - {{ now()->endOfMonth()->format('d') }} of {{ now()->format('M y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'document', '0')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/invoice.svg" class="w-8 h-8">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $TotalInvoices ?? 0 }} </h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Invoices</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'document', '1')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/sku.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $TotalHouseBills ?? 0 }}</h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">House Bills</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'document', '2')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/checklist.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $TotalPackingLists ?? 0 }}</h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Packing and Clearance</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'document', '3')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/notice.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $TotalArrivalNotices ?? 0 }}</h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Arrival Notices</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="relative group">
                        <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                        <div class="relative">
                            <div wire:click="$emitTo('documents.full-documents-datatable', 'setFilter', 'document', '4')" class="flex cursor-pointer items-start rounded-xl bg-white p-4 shadow-lg dark:bg-gray-800">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-white">
                                    <img src="/icons/notice.svg" width="80">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">{{ $OtherDocuments ?? 0 }}</h2>

                                    <p class="mt-2 text-sm font-semibold text-gray-500 dark:text-white">Other Documents</p>
                                </div>
                            </div>
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
                            You Can <strong>Click</strong> on any card to filter the documents table.
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You Can <strong>Search</strong> the table using <strong>Search</strong>.
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You Can <strong>Filter</strong> the table using <strong>Filters</strong>.
                        </p>
                    </div>
                    <div class="mt-2">
                        <p class="text-xs+ text-center text-gray-500">
                            You Can <strong>Add</strong> columns in the table using <strong>Columns</strong>.
                        </p>
                    </div>
                </div>
            </div>

            <div class="w-full h-full bg-white shadow-lg rounded-xl overflow-hidden dark:bg-gray-800 p-4 mb-1 col-span-12">
                <div class="flex flex-wrap mb-4 p-2">
                    <div class="flex items-center">
                        <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">My Documents</span>
                    </div>
                </div>
                <livewire:documents.full-documents-datatable />
            </div>
        </div>
    </main>
</div>
