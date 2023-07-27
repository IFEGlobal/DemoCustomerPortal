<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight dark:text-white">Data Service Logs</h2>
                </div>
            </div>

            <div class="col-span-12 lg:col-span-3">
                <div class="mb-4">
                    <label for="default-search" class="mb-2 text-xs font-medium text-gray-900 sr-only dark:text-white">Search</label>
                    <div class="relative mb-4">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input wire:model="search" id="default-search" class="block w-full p-4 pl-10 text-xs text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Reference" required>
                    </div>
                </div>

                <h6 class="text-sm font-bold leading-7 text-gray-900 sm:truncate ml-1 sm:text-sm sm:tracking-tight dark:text-white">Filter By Date</h6>

                <div class="flex flex-col container max-w-md mt-2 mx-auto w-full items-center justify-center bg-white dark:bg-gray-800 rounded-lg shadow">
                    <ul class="flex flex-col divide-y w-full">
                        @foreach($eventDates as $date)
                            <li class="flex flex-row">
                            <div class="select-none cursor-pointer hover:bg-gray-50 flex flex-1 items-center p-4">
                                <div class="flex flex-col w-10 h-10 justify-center items-center mr-4">
                                    <a href="#" class="block relative">
                                        <img alt="icon" src="{{ URL::to('icons/api.svg') }}" class="mx-auto object-cover rounded-full h-10 w-10" />
                                    </a>
                                </div>
                                <div class="flex-1 pl-1">
                                    <div class="font-medium dark:text-white">{{ \Carbon\Carbon::parse($date->first()->event_sent)?->format('D d M Y')}}</div>
                                    <div class="text-gray-600 dark:text-gray-200 text-sm">{{ count($date) ?? 0 }} Pakets Sent</div>
                                </div>
                                <div class="flex flex-row justify-center">
                                    <div class="text-gray-600 dark:text-gray-200 text-xs">Filter</div>
                                    <button wire:click="setDate('{{ \Carbon\Carbon::parse($date->first()->event_sent)?->format('Y-m-d')}}')" value="{{ \Carbon\Carbon::parse($date->first()->event_sent)?->format('D d M Y')}}" class="w-10 text-right flex justify-end">
                                        <svg width="20" fill="currentColor" height="20" class="hover:text-gray-800 dark:hover:text-white dark:text-gray-200 text-gray-500" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1363 877l-742 742q-19 19-45 19t-45-19l-166-166q-19-19-19-45t19-45l531-531-531-531q-19-19-19-45t19-45l166-166q19-19 45-19t45 19l742 742q19 19 19 45t-19 45z"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <button type="button" wire:click="clearDate" class="m-3 text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-xs px-4 py-1.5 text-center mt-4">Clear Date</button>
            </div>

            <div class="col-span-12 lg:col-span-9">
                <div class="mb-4">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-full">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Service
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Event ID
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Event Type
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Event Sent
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Server Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Response
                                </th>
                                <th scope="col" class="px-6 py-3">

                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($events as $event)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        {{ $event->outbound_service->service_name }}
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $event->id }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $event->event_type ??null }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($event->event_sent !==null)
                                            {{ \Carbon\Carbon::parse($event->event_sent)->format('D d M y H:i:s') }}
                                        @else
                                            Event Not Sent
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($event->response_status == 200)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $event->response_status ?? null }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $event->response_status ?? null }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-wrap">
                                        @if($event->response_status == 200)
                                            <span class="bg-green-100 text-green-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">{{ $event->response_string ?? null }}</span>
                                        @else
                                            <span class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">{{ $event->response_string ?? null }}</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <button wire:click="previewJson('{{ $event->id }}')" class="text-white bg-red-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-xs px-4 py-1.5 text-center ">Preview Event Data</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $events->links() }}
                @if($json !== null)
                    <div class="max-w-full mb-4 p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <img src="{{ URL::to('/icons/json-file.svg') }}" class="h-10 w-10 mb-2 justify-items-start" />
                        <button wire:click="closePreview()" class="items-end justify-end text-white bg-red-500 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-xs px-4 py-1.5 text-center mb-">Close</button>
                        <pre>{{ $json }}</pre>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
