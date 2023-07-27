<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">
            @foreach($organisations as $organisation)
                <div class="flex flex-wrap px-2 w-full mb-10">
                    <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="w-full m-auto">
                                    <img src="https://image.freepik.com/free-vector/app-development-illustration_52683-47931.jpg" alt=""class="rounded-t-2xl shadow-2xl lg:w-full 2xl:w-full 2xl:h-44 object-cover"/>
                                    <div class="bg-white shadow-1xl rounded-b-3xl dark:bg-black">
                                        <h2 class="text-center text-gray-800 text-2xl font-bold pt-6 dark:text-white">{{ $organisation['organisation_name'] }}</h2>
                                        <div class="w-5/6 m-auto items-center justify-center p-3">
                                            <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                Consignee
                                                            </p>
                                                        </div>
                                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                            @if($organisation['is_consignee'] === 1)
                                                                <svg class="w-6 h-6 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                            @else
                                                                <svg class="w-6 h-6 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                Consignor
                                                            </p>
                                                        </div>
                                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                            @if($organisation['is_consignor'] === 1)
                                                                <svg class="w-6 h-6 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                            @else
                                                                <svg class="w-6 h-6 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                Forwarder
                                                            </p>
                                                        </div>
                                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                            @if($organisation['is_forwarder'] === 1)
                                                                <svg class="w-6 h-6 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                            @else
                                                                <svg class="w-6 h-6 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                                <li class="py-3 sm:py-4">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                Shipping Line
                                                            </p>
                                                        </div>
                                                        <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                            @if($organisation['is_shipping_line'] === 1)
                                                                <svg class="w-6 h-6 mr-1.5 text-green-500 dark:text-green-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                                                            @else
                                                                <svg class="w-6 h-6 mr-1.5 text-gray-400 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path></svg>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4 px-2">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="p-2 w-full bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-between items-center mb-2">
                                        <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Registered Addresses</h5>
                                    </div>
                                    <div class="overflow-y-auto h-96 ">
                                        @if(count($organisation['organisation_addresses']) > 0)
                                            <table class="w-full text-sm max-h-96 overflow-y text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400 sticky top-0">
                                                <tr>
                                                    <th scope="col" class="py-3 px-6">
                                                        Contact
                                                    </th>
                                                    <th scope="col" class="py-3 px-6">
                                                        City
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody class="max-h-96 overflow-auto divide-y">
                                                @foreach($organisation['organisation_addresses'] as $address)
                                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                                        <th scope="row" class="flex items-center py-4 px-6 text-gray-900 whitespace-nowrap dark:text-white">
        {{--                                                    <x-eos-maps-home-work-o @class('w-6 h-6 text-green-500')/>--}}
                                                            <div class="pl-3">
                                                                <div class="text-base font-semibold">{{ $address['address_1'] ?? '-'}}</div>
                                                                <div class="font-normal text-gray-500">{{ $address['email'] ?? '-'}}</div>
                                                                <div class="font-normal text-gray-500">{{ $address['contact_number'] ?? '-'}}</div>
                                                            </div>
                                                        </th>
                                                        <td class="py-4 px-6">
                                                            {{ $address['city'] ?? '-'}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                @else
                                                    <div class="p-6 text-center items-center justify-center">
                                                        <svg aria-hidden="true" class="mx-auto mb-4 w-14 h-14 text-gray-400 dark:text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">No active addresses have been found!</h3>
                                                    </div>
                                                @endif
                                                </tbody>
                                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full sm:w-full md:w-1/4 lg:w-1/4 xl:w-1/4 mb-4 px-2">
                        <div class="relative group mb-2">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="p-4 w-full max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-between items-center mb-1">
                                        <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Credit Limit</h5>
                                    </div>
                                    <div class="flow-root">
                                        <div class="mt-2 mb-2">
                                            <p class="text-gray-600 font-bold text-red-600">{{ $organisation['ar_global_credit_limit'] ?? '-' }} GBP</p>
                                            <div class="bg-gray-400 w-full h-3 rounded-lg mt-2 overflow-hidden">
                                                <div class="bg-red-500 h-full rounded-lg shadow-md" style="width: {{ $organisation['width'] }}%;"></div>
                                            </div>
                                        </div>
                                        <h3 class="text-xs uppercase font-bold">Outstanding Value</h3>
                                        <h3 class="text-xs uppercase font-bold mt-1 text-red-600">{{ number_format((float)$organisation['outstandingBalance'], 2, '.', '') ?? 0.00 }} GBP</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative">
                                <div class="p-4 w-full max-w-md bg-white rounded-lg border shadow-md sm:p-8 dark:bg-gray-800 dark:border-gray-700">
                                    <div class="flex justify-between items-center mb-3">
                                        <h5 class="text-lg font-bold leading-none text-gray-900 dark:text-white">Account Resources</h5>
                                    </div>
                                    <div class="flow-root">
                                        <ul role="list" class="divide-y divide-gray-200 dark:divide-gray-700">
                                            @foreach($organisation['staff_assignments'] as $staff)
                                                @if($staff['system_listed_name'] !== null)
                                                    <li class="p-3 sm:pb-4">
                                                        <div class="flex items-center space-x-4">
                                                            <div class="flex-shrink-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                                </svg>
                                                            </div>
                                                            <div class="flex-1 min-w-0">
                                                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                                                    @if($staff['role'] == "CAR")
                                                                        Cartage Coordinator
                                                                    @elseif($staff['role'] == "ACT")
                                                                        Account Manager
                                                                    @elseif($staff['role'] == "CRE")
                                                                        Credit Controller
                                                                    @elseif($staff['role'] == "CON")
                                                                        Controller
                                                                    @endif
                                                                </p>
                                                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                                                    {{ $staff['system_listed_name'] ?? '-'}}
                                                                </p>
                                                            </div>
                                                            <button class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    </li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </main>
</div>
