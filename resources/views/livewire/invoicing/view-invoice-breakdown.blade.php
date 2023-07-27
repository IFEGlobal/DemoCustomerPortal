<div>
    <div href="#" class="mb-4 group block w-full mx-auto rounded-lg p-6 bg-white ring-1 ring-slate-900/5 shadow-lg space-y-3 hover:bg-sky-500 hover:ring-sky-500">
        <div class="flex items-center space-x-3">
            <img src="{{ URL::to('/icons/debit-card.svg') }}" class="h-4 w-4 items-center mr-2">
            <h3 class="text-slate-900 group-hover:text-white text-sm font-semibold">Online Payments</h3>
        </div>
        <p class="text-slate-500 group-hover:text-white text-sm">Online payments are to be implemented in future releases of the Logistic Smart Portal</p>

        <p class="text-slate-500 group-hover:text-white text-sm">This feature is currently disabled until full implementation</p>
    </div>

    @if($breakdown !== null)
        @foreach($breakdown as $line)
            <article class="overflow-hidden bg-blue-100 dark:bg-gray-800 rounded-lg shadow-lg mb-2">
                <header class="flex items-center justify-between leading-tight p-2 md:p-4">
                    <h3 class="text-md font-bold text-gray-900">
                        <div class="no-underline text-black">
                            {{ $line->description ?? ''}}
                        </div>
                    </h3>
                    @if(($line->sell_transaction_type == 'INV') && ($line->sell_fully_paid_date == null))
                        <button type="button" class="items-center justify-center text-white bg-[#4285F4] hover:bg-red-500 font-medium rounded-lg text-sm px-5 py-1.5 text-center inline-flex items-center mr-2 mb-2" disabled>
                            <img src="{{ URL::to('/icons/debit-card.svg') }}" class="h-4 w-4 items-center mr-2">
                            £{{ number_format((float)$line->sell_local_amount, 2, '.', '') }}
                        </button>
                    @else
                        <span class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                            Paid
                        </span>
                    @endif
                </header>

                <p class="hidden font-semibold text-sm sm:block">
                    <span class="inline-flex">
                        @if(($line->sell_transaction_type == 'INV') && ($line->sell_fully_paid_date == null))
                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                @if(!is_null($line->sell_posted_due_date))
                                    @if(\Carbon\Carbon::parse($line->sell_posted_due_date) < now())
                                        <span class="bg-red-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                            Overdue: {{ Carbon\Carbon::parse($line->sell_posted_due_date)->format('D d M y') }}
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">
                                            Due: {{ Carbon\Carbon::parse($line->sell_posted_due_date)->format('D d M y') }}
                                        </span>
                                    @endif
                                @endif
                            </span>
                        @else
                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">
                                Paid: {{ Carbon\Carbon::parse($line->sell_fully_paid_date)->format('D d M y') }}
                            </span>
                        @endif
                    </span>
                </p>
            </article>
        @endforeach

    @endif
</div>
