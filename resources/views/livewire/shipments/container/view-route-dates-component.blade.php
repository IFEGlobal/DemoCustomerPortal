<div>
    <div class="flex flex-wrap px-2 mb-2 border-b ">
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-2 px-2">
            <div class="text-center">
                <span class="block mb-2 text-xs font-semibold leading-4 tracking-widest text-center text-red-500 uppercase dark:text-gray-400">
                    Journey Departure
                </span>
            </div>
            <div class="relative group mb-4">
                <div class="flex items-start rounded-xl items-center justify-center p-4 dark:bg-gray-800">
                    <div class="grid grid-cols-3 gap-5">
                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-red-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Scheduled
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($scheduled['Departure']) && $scheduled['Departure'] != 'Pending' && $scheduled['Departure'] != 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($scheduled['Departure'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($scheduled['Departure'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($scheduled['Departure'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            Pending..
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-blue-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Planned
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($planned['Departure']) && $planned['Departure'] != 'Pending' && $actual['Departure'] !== 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            Pending..
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-green-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Actual
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($actual['Departure']) && $planned['Departure'] != 'Pending' && $actual['Departure'] !== 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($actual['Departure'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($actual['Departure'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($actual['Departure'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @elseif(isset($planned['Departure']) && $planned['Departure'] != 'Pending' && $planned['Departure'] != 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Departure'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            Pending..
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-2 px-2">
            <div class="text-center">
                <span class="block mb-2 text-xs font-semibold leading-4 tracking-widest text-center text-green-500 uppercase dark:text-gray-400">
                    Journey Arrival
                </span>
            </div>
            <div class="relative group">
                <div class="flex items-start rounded-xl items-center justify-center p-4 dark:bg-gray-800">
                    <div class="grid grid-cols-3 gap-5">
                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-red-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Scheduled
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($scheduled['Arrival']) && $scheduled['Arrival'] != 'Pending' && $scheduled['Arrival'] != 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($scheduled['Arrival'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($scheduled['Arrival'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($scheduled['Arrival'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            No Date Found
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-blue-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Planned
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($planned['Arrival']) && $planned['Arrival'] != 'Pending' && $planned['Arrival'] != 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($planned['Arrival'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Arrival'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($planned['Arrival'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            Pending..
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="body flex justify-center items-center">
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-green-500 text-white">
                                    <p class="text-xs font-semibold text-white uppercase tracking-wide text-center p-1">
                                        Actual
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    @if(isset($actual['Arrival']) && $actual['Arrival'] != 'Pending' && $actual['Arrival'] != 'Unknown')
                                        <p class="text-sm text-gray-400 text-center pt-3 px-4 leading-none">
                                            {{ \Carbon\Carbon::parse($actual['Arrival'])?->format('D') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-md text-black text-center mt-2 pb-2 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($actual['Arrival'])?->format('d M') ?? "-"}}
                                        </p>
                                        <p class="font-bold text-xs text-black text-center pb-3 px-4 leading-none" >
                                            {{ \Carbon\Carbon::parse($actual['Arrival'])?->format('h:i A') ?? "-"}}
                                        </p>
                                    @else
                                        <p class="text-sm text-gray-400 text-center p-6 px-4 leading-none">
                                            Pending..
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
