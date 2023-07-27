<div>
    <div class="flex flex-wrap px-2 mb-10 ">
        <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4 px-2">
            <div class="text-center">
                <span class="block mb-4 text-xs font-semibold leading-4 tracking-widest text-center text-red-500 uppercase dark:text-gray-400">
                    Carbon Emissions (Shipment)
                </span>
            </div>
            <div class="relative group mb-4">
                <div class="flex items-start rounded-xl items-center justify-center dark:bg-gray-800">
                    <div class="grid grid-cols-3 gap-5 mt-2">
                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-indigo-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/oil-tank.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-indigo-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        WTT
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Well to Tank
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($Co2Data['co2e']['wtt']))
                                            {{ round(($Co2Data['co2e']['wtt']/1000),2) ?? '-' }}
                                        @else
                                            Pending..
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-pink-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/hands.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-pink-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        TTW
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Tank to Wheel
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($Co2Data['co2e']['ttw']))
                                            {{ round(($Co2Data['co2e']['ttw'] / 1000),2) ?? '-'}}
                                        @else
                                            Pending..
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-green-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/carbon-neutral.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-green-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        WTW
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Total CO2 Output
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($Co2Data['co2e']['total']))
                                            {{ round(($Co2Data['co2e']['total'] / 1000),2) ?? '=' }}
                                        @else
                                            Pending...
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="w-full sm:w-full md:w-1/2 lg:w-1/2 xl:w-1/2 mb-4 px-2">
            <div class="text-center">
                <span class="block mb-4 text-xs font-semibold leading-4 tracking-widest text-center text-green-600 uppercase dark:text-gray-400">
                    Carbon Emissions (Apportioned Co2)
                </span>
            </div>
            <div class="relative group mb-4">
                <div class="flex items-start rounded-xl items-center justify-center dark:bg-gray-800">
                    <div class="grid grid-cols-3 gap-5 mt-2">
                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-indigo-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/oil-tank.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-indigo-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        WTT
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Well to Tank
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($apportionedData['ApportionedCO2EWellToTank']))
                                            {{ $apportionedData['ApportionedCO2EWellToTank'] }}
                                        @else
                                            Pending...
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-pink-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/hands.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-pink-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        TTW
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Tank to Wheel
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($apportionedData['ApportionedCO2ETankToWheel']))
                                            {{ $apportionedData['ApportionedCO2ETankToWheel']  ?? '-'}}
                                        @else
                                            Pending...
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="relative flex justify-center items-center">
                            <div class=" text-white flex items-center absolute rounded-full py-2 px-2 bg-green-200 shadow-xl -left-3 -top-4">
                                <img src="/icons/carbon-neutral.svg" class="h-5 w-5">
                            </div>
                            <div class="flex-col justify-center items-center rounded-lg bg-white overflow-hidden h-full w-24 shadow-md">
                                <div class="bg-green-500 text-white">
                                    <p class="text-xs+ font-semibold text-white uppercase tracking-wide text-center p-1">
                                        WTW
                                    </p>
                                </div>
                                <div class="flex-col justify-center items-center">
                                    <p class="text-xs+ text-gray-400 text-center pt-1 px-4 leading-none">
                                        Total CO2 Output
                                    </p>
                                    <p class="text-xs+ font-bold text-black text-center mt-2 pb-2 px-4 leading-none" >
                                        @if(isset($apportionedData['ApportionedCO2ETotal']))
                                            {{ $apportionedData['ApportionedCO2ETotal']  ?? '-'}}
                                        @else
                                            Pending...
                                        @endif
                                    </p>
                                    <p class="text-xs+ text-black text-center pb-3 px-4 leading-none" >
                                        Kilograms
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
