<div>
    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 w-full">

            <div class="lg:flex lg:items-center lg:justify-between col-span-12">
                <div class="min-w-0 flex-1">
                    <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">Viewing Delivery For {{ $record->container->container_no }}</h2>
                </div>
            </div>

            <div class="flex flex-wrap max-w-screen px-2 col-span-12">
                <div class="w-full sm:w-full md:w-2/6 lg:w-2/6 xl:w-2/6 mb-4">
                    <div class="grid grid-rows-1 grid-flow-col gap-4 w-full">
                        <div class="relative group">
                            <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                            <div class="relative block overflow-hidden rounded-lg bg-white p-8">
                                <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>
                                <div class="justify-between sm:flex">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-900">
                                            Delivery Details
                                        </h3>
                                        <p class="mt-1 text-xs font-medium text-gray-600">{{ $record->container->container_no }}</p>
                                    </div>

                                    <div class="ml-3 hidden flex-shrink-0 sm:block">
                                        <img alt="details" src="https://img.freepik.com/free-vector/bike-paths-network-abstract-concept-illustration_335657-3742.jpg?w=826&t=st=1668500761~exp=1668501361~hmac=f91269462ee0fa3c444556e323e846f5731b032f5327eedee2000380268cd866" class="h-16 w-16 rounded-lg object-cover shadow-sm"/>
                                    </div>
                                </div>

                                <div class="flex items-center justify-center rounded-xl">
                                    <div class="mt-4 sm:pr-8">
                                        <div class="min-w-32 bg-white min-h-48 p-3 mb-4 font-medium">
                                            <p class="mt-1 text-xs font-medium text-gray-600 mb-2 text-center">Arriving at discharge</p>
                                            <div class="w-32 flex-none rounded-t lg:rounded-t-none lg:rounded-l text-center shadow-lg ">
                                                <div class="block rounded-t overflow-hidden  text-center ">
                                                    <div class="bg-blue-500 text-white py-1">
                                                        {{ $record->shipment->port_arrival_date?->format('M') ??  $record->shipment->estimated_arrival?->format('M') ?? "-"}}
                                                    </div>
                                                    <div class="pt-1 border-l border-r border-white bg-white">
                                                        <span class="text-5xl font-bold leading-tight">
                                                            {{ $record->shipment->port_arrival_date?->format('d') ??  $record->shipment->estimated_arrival?->format('d') ?? "-"}}
                                                        </span>
                                                    </div>
                                                    <div class="border-l border-r border-b rounded-b-lg text-center border-white bg-white -pt-2 -mb-1">
                                                        <span class="text-sm">
                                                            {{ $record->shipment->port_arrival_date?->format('D') ??  $record->shipment->estimated_arrival?->format('D') ?? "-"}}
                                                        </span>
                                                    </div>
                                                    <div class="pb-2 border-l border-r border-b rounded-b-lg text-center border-white bg-white">
                                                        <span class="text-xs leading-normal">
                                                            {{ $record->shipment->port_arrival_date?->format('h:i A') ??  $record->shipment->estimated_arrival?->format('h:i A') ?? "-"}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4 sm:pr-8">
                                        <div class="min-w-32 bg-white min-h-48 p-3 mb-4 font-medium">
                                            <p class="mt-1 text-xs font-medium text-gray-600 mb-2 text-center">Delivery Date</p>
                                            <div class="w-32 flex-none rounded-t lg:rounded-t-none lg:rounded-l text-center shadow-lg ">
                                                <div class="block rounded-t overflow-hidden  text-center ">
                                                    <div class="bg-red-500 text-white py-1">
                                                        {{ $record->arrival_estimated_delivery?->format('M') ?? "-"}}
                                                    </div>
                                                    <div class="pt-1 border-l border-r border-white bg-white">
                                                        <span class="text-5xl font-bold leading-tight">
                                                            {{ $record->arrival_estimated_delivery?->format('d') ?? "-"}}
                                                        </span>
                                                    </div>
                                                    <div class="border-l border-r border-b rounded-b-lg text-center border-white bg-white -pt-2 -mb-1">
                                                        <span class="text-sm">
                                                            {{ $record->arrival_estimated_delivery?->format('D') ?? "-"}}
                                                        </span>
                                                    </div>
                                                    <div class="pb-2 border-l border-r border-b rounded-b-lg text-center border-white bg-white">
                                                        <span class="text-xs leading-normal">
                                                            {{ $record->arrival_estimated_delivery?->format('h:i A') ?? "-"}}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <dl class="flex">
                                    <div class="card-body">
                                        <div class="grid grid-flow-col gap-4 text-center">
                                            <div class="flex flex-col p-2 items-center bg-neutral rounded-box text-neutral-content">
                                                <span class="countdown font-mono text-5xl days">
                                                  <span id="days" class="days" style="--value:0;"></span>
                                                </span>
                                                days
                                            </div>
                                            <div class="flex flex-col p-2 items-center bg-neutral rounded-box text-neutral-content">
                                                <span class="countdown font-mono text-5xl">
                                                  <span id="hours" class="hours" style="--value:0;">></span>
                                                </span>
                                                hours
                                            </div>
                                            <div class="flex flex-col p-2 items-center bg-neutral rounded-box text-neutral-content">
                                                <span class="countdown font-mono text-5xl">
                                                  <span id="minutes" class="minutes" style="--value:0;"></span>
                                                </span>
                                                min
                                            </div>
                                            <div class="flex flex-col p-2 items-center bg-neutral rounded-box text-neutral-content">
                                                <span class="countdown font-mono text-5xl">
                                                  <span id="seconds" class="seconds" style="--value:0;"></span>
                                                </span>
                                                sec
                                            </div>
                                        </div>
                                    </div>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full sm:w-full md:w-4/6 lg:w-4/6 xl:w-4/6 mb-4 px-2">
                    <div class="flex flex-col">
                        <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                <img src="/icons/hashtag-icon.svg" class="h-10 w-10">
                            </div>

                            <a class="ml-4 cursor-pointer" href="{{ route('shipment', $record->shipment->id) }}">
                                <h2 class="font-semibold">Reference Number</h2>
                                <p class="mt-2 text-sm text-blue-500 font-bold underline">{{ $record->shipment->PO_number ?? $record->shipment->shipment_ref ?? '-' }}</p>
                            </a>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 mb-4">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/container-icon.svg" class="h-10 w-10">
                                </div>

                                <a class="ml-4" href="{{ route('container', $record->container->id) }}">
                                    <h2 class="font-semibold">Container Number</h2>
                                    <p class="mt-2 text-sm text-blue-500 font-bold underline">{{ $record->container->container_no ??'-' }}</p>
                                </a>
                            </div>
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/hashtag-icon.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Booking Number</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->transport_booking_ref ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-4">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/boxes.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Goods/Products</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->goods_description ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/cargo-ship-icon.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Number of Containers</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->number_of_containers ?? '-' }} Container/s</p>
                                </div>
                            </div>

                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/pallet.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Pack Type</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->outer_packs_package_type ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/e-learning.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Quantity</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->pack_quantity ?? '-' }} Units</p>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2">
                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/building.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Collection From</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->pick_up_address ?? '-' }}</p>
                                </div>
                            </div>

                            <div class="flex items-start rounded-xl bg-white p-4 shadow-lg">
                                <div class="flex h-12 w-12 items-center justify-center rounded-full">
                                    <img src="/icons/home-address.svg" class="h-10 w-10">
                                </div>

                                <div class="ml-4">
                                    <h2 class="font-semibold">Delivery To</h2>
                                    <p class="mt-2 text-sm text-gray-500">{{ $record->transportBooking->delivery_address ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full px-2 col-span-12">
                <div class="relative group">
                    <div class="absolute -inset-0.5 bg-gradient-to-r from-red-600 to-blue-600 rounded-lg blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200 animate-tilt"></div>
                    <div class="w-full">
                        <div class="relative block overflow-hidden rounded-lg bg-white p-8">
                            <span class="absolute inset-x-0 bottom-0 h-2 bg-gradient-to-r from-green-300 via-blue-500 to-purple-600"></span>
                            <div class="justify-between sm:flex">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">
                                        Proposed Delivery Route
                                    </h3>
                                    <p class="mt-1 text-xs font-medium text-gray-600">{{ $record->container->container_no }}</p>
                                </div>

                                <div class="ml-3 hidden flex-shrink-0 sm:block">
                                    <img alt="details" src="https://img.freepik.com/free-vector/bike-paths-network-abstract-concept-illustration_335657-3742.jpg?w=826&t=st=1668500761~exp=1668501361~hmac=f91269462ee0fa3c444556e323e846f5731b032f5327eedee2000380268cd866" class="h-16 w-16 rounded-lg object-cover shadow-sm"/>
                                </div>
                            </div>

                            <div>
                                <div id="map" wire:ignore style="width:100%; height:645px"></div>
                                <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBneA21w2YFnKAkKmkmzqsXuU66P5kynkQ"></script>
                                <script>
                                    var directionsService = new google.maps.DirectionsService();
                                     var directionsDisplay = new google.maps.DirectionsRenderer();

                                     var map = new google.maps.Map(document.getElementById('map'), {
                                       zoom:7,
                                       mapTypeId: google.maps.MapTypeId.ROADMAP
                                     });

                                     directionsDisplay.setMap(map);
                                     directionsDisplay.setPanel(document.getElementById('panel'));

                                     var Delivery = {!! json_encode($record) !!};

                                     var Collection = Delivery['transport_booking']['pick_up_address'];
                                     var Deliver = Delivery['transport_booking']['delivery_address'];

                                     var request = {
                                       origin: Collection,
                                       destination: Deliver,
                                       travelMode: google.maps.DirectionsTravelMode.DRIVING
                                     };

                                     console.log(request);

                                     directionsService.route(request, function(response, status) {
                                       if (status == google.maps.DirectionsStatus.OK) {
                                         directionsDisplay.setDirections(response);
                                       }
                                     });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Set the date we're counting down to
                var countDownDate = new Date("{{ $record->arrival_estimated_delivery }}").getTime();

                var x = setInterval(function() {

                    var now = new Date().getTime();

                    var distance = countDownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    const getdayselement = document.getElementById('days')
                    const gethourselement = document.getElementById('hours')
                    const getminutesselement = document.getElementById('minutes')
                    const getsecondsselement = document.getElementById('seconds')


                    getdayselement.setAttribute('style', "--value:" + days);
                    gethourselement.setAttribute('style', "--value:" + hours);
                    getminutesselement.setAttribute('style', "--value:" + minutes);
                    getsecondsselement.setAttribute('style', "--value:" + seconds);

                }, 1000);
            </script>
        </div>
    </main>
</div>
