<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Viewing Invoice {{ $invoice_number }}</h2>

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
                            <button  x-tooltip.placement.bottom="'Go To Invoices'" wire:click="goTo('/invoices')" type="button" class="hover:scale-125 inline-flex items-center px-4 py-2 text-sm font-medium text-gray-900 bg-transparent border-t border-b border-gray-200 rounded-lg hover:bg-blue-400 hover:text-white focus:z-10 focus:ring-2 focus:ring-gray-500 focus:bg-gray-900 focus:text-white dark:border-white dark:text-white dark:hover:text-white dark:hover:bg-gray-700 dark:focus:bg-gray-700">
                                <img src="/icons/invoice.svg" class="h-4 w-4 hover:animate-pulse">
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="w-full px-2  col-span-12">
                <div class="flex flex-wrap w-full">
                    <div class="my-1 px-1 w-full md:w-1/3 lg:my-4 lg:px-4 lg:w-1/3">
                        <article class="overflow-hidden bg-white dark:bg-gray-800 rounded-lg shadow-lg">
                            <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                                <h3 class="text-md font-bold text-gray-900">
                                    <div class="no-underline text-black">
                                        Invoice Reference: {{ $invoice_number }}
                                    </div>
                                </h3>
                                @if($outstandingAmount > 0.00)
                                <button wire:click="PayInvoice('{{$outstandingAmount}}')" type="button" class="text-white bg-indigo-500 hover:bg-green-500 font-medium rounded-lg text-sm px-5 py-1.5 text-center inline-flex items-center mr-2 mb-2">
                                    <img src="{{ URL::to('/icons/debit-card.svg') }}" class="h-4 w-4 items-center mr-2">
                                    £{{ $outstandingAmount }}
                                </button>
                                @else
                                    <span class="bg-blue-100 text-blue-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">
                                         Paid
                                    </span>
                                @endif
                            </header>
                            <p class="hidden font-semibold text-sm sm:block">
                                 <span class="inline-flex">
                                     <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                         @if($outstandingAmount > 0.00)
                                             Outstanding
                                         @else
                                             Paid
                                         @endif
                                     </span>
                                 </span>
                            </p>
                        </article>

                        <article class="overflow-hidden p-2 mt-4">
                            <header class="flex leading-tight">
                                <h3 class="text-xs font-bold text-gray-900">
                                    <div class="text-black">
                                        Invoice Charge Lines
                                    </div>
                                </h3>
                            </header>

                            <div class="p-5 text-xs font-light">
                                <p class="mb-2 text-gray-500 dark:text-gray-400">Below are the individual charges for fulfillment of services as reflected in your invoice adjacent</p>
                                <p class="text-gray-500 dark:text-gray-400">
                                    You can choose to pay the entire invoice by clicking the pay in the top card button or alternatively pay a portion of the invoice by clicking the pay button on a charge line.
                                </p>
                            </div>
                        </article>

                        @if($invoice_number !== null)
                            <livewire:invoicing.view-invoice-breakdown :invoice_number="$invoice_number"/>
                        @else
                            <article class="overflow-hidden items-center justify-center dark:bg-gray-800 mt-2">
                                <div class="py-4">
                                    <div class="bg-red-600 text-sm text-white py-2 px-6 rounded hover:bg-red-700 transition-colors duration-300">Cannot Load Breakdown</div>
                                </div>
                            </article>
                        @endif
                    </div>

                    <div class="my-1 px-1 w-full md:w-2/3 lg:my-4 lg:px-4 lg:w-2/3">
                        <article class="overflow-hidden">
                            @if($extention == 'pdf')
                                <div class="p-4 mb-4 text-sm text-blue-700 bg-blue-100 rounded-lg dark:bg-gray-800 dark:text-blue-400 mb-4" role="alert">
                                    <span class="font-medium">Stream Notification:</span> This document is currently streaming below.
                                </div>
                            @else
                                <div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-gray-800 dark:text-red-400" role="alert">
                                    <span class="font-medium">Stream Notification:</span> This document cannot be streamed as this is not a PDF Document
                                </div>
                            @endif
                            @if($extention == 'pdf')
                                <iframe class="w-full h-screen" src="https://logisticsmartportal.com/streamFile/{{ $document->id }}"></iframe>
                            @endif
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
