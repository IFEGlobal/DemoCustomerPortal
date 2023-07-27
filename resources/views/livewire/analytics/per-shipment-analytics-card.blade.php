<div>
    @if($record !== null)
        <div class="px-5 py-1 bg-white rounded-lg mb-4 w-1/2">
            <div class="flex flex-wrap">
                <div class="flex items-center py-2">
                    <div class="mr-5">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-800 mr-2">{{ $transitTime ?? '-' }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Transit Days</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-200 mr-5" aria-hidden="true"></div>
                </div>

                <div class="flex items-center py-2">
                    <div class="mr-5">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-800 mr-2">{{ $routeAvg ?? '-' }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Your Route Avg</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-200 mr-5" aria-hidden="true"></div>
                </div>

                <div class="flex items-center py-2">
                    <div class="mr-5">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-800 mr-2">{{ $routeOccurances ?? '-' }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Route Occurrences</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-200 mr-5" aria-hidden="true"></div>
                </div>

                <div class="flex items-center py-2">
                    <div class="mr-5">
                        <div class="flex items-center">
                            <div class="text-3xl font-bold text-gray-800 mr-2">{{ $teu ?? '-' }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Shipment TEU</div>
                    </div>
                    <div class="hidden md:block w-px h-8 bg-gray-200 mr-5" aria-hidden="true"></div>
                </div>
                <!-- Visit Duration-->
                <div class="flex items-center">
                    <div>
                        <div class="flex items-center">
                            <div class="text-xl font-bold text-gray-800 mr-2">{{ $record->shipmentDataStatusAttribute() }}</div>
                        </div>
                        <div class="text-sm text-gray-500">Shipment Status</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-col w-full justify-center antialiased text-gray-600">
            <div class="inline-block px-5 py-4 border-b mt-4 mb-4 items-center w-1/2">
                <div class="mx-auto">
                    <div class="w-full h-1 flex items-center justify-between">
                        <div class="h-1 flex items-center">
                            <div class="h-6 w-6 flex items-center justify-center">
                                <img src="{{ URL::to('/icons/location.svg') }}" class ="h-6 w-6">
                            </div>
                        </div>
                        @if(is_int($record->getRemainingDaysAttribute()))
                            <div class="w-full bg-gray-200 rounded-full h-3 dark:bg-gray-700">
                                <div class="bg-blue-800 h-3 rounded-full" style="width: {{ $this->record->trackingSliderAttribute() }}%">
                                    <div class="flex justify-end">
                                        @if($record->trackingSliderAttribute() < 100)
                                            <div class="tooltip" data-tip={{ $record->vessel ?? 'Awaiting Vessel' }} : {{ $record->voyage ?? '' }}">
                                            <div class="-mt-1 rounded-full shadow flex p-1 text-xs rounded-full bg-white items-center justify-center ">
                                                <img src="{{ URL::to('/icons/due-to-depart-icon.svg') }}" class ="h-4 w-4">
                                            </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                    </div>
                    @endif
                    <div class="flex justify-end">
                        <div class="h-6 w-6 flex items-center justify-center">
                            @if($record->trackingSliderAttribute() == 100)
                                <img src="{{ URL::to('/icons/arrived.svg') }}" class ="h-6 w-6">
                            @else
                                <img src="{{ URL::to('/icons/location.svg') }}" class ="ml-3 h-6 w-6">
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-border max-full mx-4 sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">
            @livewire('analytics.per-shipment-analytics-chart', ['perShipmentDataset' => $perShipmentDataset])
        </div>
    @endif
</div>
