<div>
    <div>
        <h6 class="text-lg font-bold dark:text-white">Current Active Sessions ({{ $currentSessions->count() ?? 0 }})</h6>

        <ul class="grid grid-cols-1 xl:grid-cols-3 gap-y-10 gap-x-6 items-start p-8">
            @foreach($currentSessions as $session)
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-cover bg-center h-16 p-4 flex justify-end items-center" style="background-image: url(https://mosscm.com/wp-content/uploads/2017/11/news-dallas-skyline.jpg)">
                        <p class="uppercase tracking-widest text-sm text-white bg-black py-1 px-2 rounded opacity-75 shadow-lg">{{ $session->location_city.' ,' ?? null}} {{ $session->location_country.' ,' ?? null }} {{ $session->location_post_zip_code ?? null}}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-2 p-4 text-gray-700 flex justify-between">
                            <div>
                                <p class="text-sm text-gray-900 mb-3">Logged In {{ $session->log_in->diffForHumans() }}</p>
                                <p class="text-sm text-gray-900 mb-3">{{ $session->log_in->format('D d M y') }}</p>
                            </div>
                        </div>
                        <div class="col-span-1 p-4 text-gray-700 flex justify-between">
                            <div class="leading-loose flex-inline text-sm">
                                <div class="flex items-center">
                                    <i class="mr-2 wi wi-horizon-alt text-yellow-500"></i>
                                    <p><span class="text-xs+">From: {{ $session->log_in?->format('H:i') ?? null}}</span> </p>
                                </div>
                                <div class="flex items-center">
                                    <i class="mr-2 wi wi-horizon text-purple-400"></i>
                                    <p><span class="text-xs+">Until: {{ $session->log_out?->format('H:i') ?? null}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center p-4 border-t border-gray-300 text-gray-600">
                        <div class="flex items-center">
                            <i class="mr-2 wi wi-hot"></i>
                            <p><span class="text-gray-900 font-bold">IP Address</span></p>
                        </div>
                        <div class="flex items-center">
                            <i class="mr-2 wi wi-rain"></i>
                            <p><span class="text-gray-900 font-bold">{{ $session->ip_address }}</span></p>
                        </div>
                    </div>
                </div>
{{--            <li class="relative flex flex-col sm:flex-row xl:flex-col items-start w-full">--}}
{{--                <div class="order-1 sm:ml-6 xl:ml-0">--}}
{{--                    <h3 class="mb-1 text-slate-900 font-semibold dark:text-slate-200">--}}
{{--                        @if($session->session_login_uuid == session()->get('session_login_uuid'))--}}
{{--                            <span class="mb-1 block text-sm leading-6 text-green-500">--}}
{{--                                Current Sessions IP: {{ $session->ip_address }}--}}
{{--                            </span>--}}
{{--                        @else--}}
{{--                            <span class="mb-1 block text-sm leading-6 text-indigo-500">--}}
{{--                                Active Sessions IP: {{ $session->ip_address }}--}}
{{--                            </span>--}}
{{--                        @endif--}}
{{--                       {{ $session->location_city ?? 'Unknown City'}} , {{ $session->location_post_zip_code ?? 'Unknown Post/Zip Code'}}--}}
{{--                    </h3>--}}
{{--                    <div class="prose prose-slate prose-sm text-slate-600 dark:prose-dark">--}}
{{--                        <p>--}}
{{--                            {{ $session->location_region ?? 'Unknown Region'}} , {{ $session->location_country ?? 'Unknown Country'}}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                    <div class="prose prose-slate prose-sm text-slate-600 dark:prose-dark">--}}
{{--                        <p>--}}
{{--                            Logged In {{ $session->log_in->diffForHumans() }} on {{ $session->log_in->format('d M y H:i:s') }}--}}
{{--                        </p>--}}
{{--                    </div>--}}
{{--                </div>--}}
                @if($session->location_latitude !== null && $session->location_longitude !== null)
                    <div wire:ignore id="{{ 'map'.$session->id }}" class="center-block border rounded-lg " style="width: 100%; height: 210px; z-index: 0"></div>
{{--                    <script>--}}
{{--                        var currentSessions = {{ Js::from($currentSessions) }};--}}

{{--                        currentSessions.forEach(function ($item) {--}}

{{--                            setTimeout(function () {--}}
{{--                                window.dispatchEvent(new Event("resize"));--}}
{{--                            }, 500);--}}

{{--                            var map = L.map('map'+$item['id']).setView([$item['location_latitude'], $item['location_longitude']], 9);--}}

{{--                            L.tileLayer('https://{s}.basemaps.cartocdn.com/rastertiles/voyager/{z}/{x}/{y}{r}.png', {--}}
{{--                                subdomains: 'abcd',--}}
{{--                                minZoom: 3,--}}
{{--                                maxZoom: 19,--}}
{{--                            }).addTo(map);--}}

{{--                            const locationIcon = L.icon({--}}
{{--                                iconSize: [20, 20],--}}
{{--                                iconUrl: '{{ URL::asset('/icons/pulse-dot.gif') }}',--}}
{{--                            });--}}

{{--                            var marker = new L.marker([$item['location_latitude'], $item['location_longitude']], {icon: locationIcon}).addTo(map);--}}

{{--                            var circle  = L.circle([$item['location_latitude'], $item['location_longitude']], 10000, {--}}
{{--                                color: '#FBF7F7',--}}
{{--                                fillColor: '#FAC6BF',--}}
{{--                                fillOpacity: 0.5--}}
{{--                            }).addTo(map);--}}

{{--                            map.attributionControl.setPrefix('');--}}
{{--                        })--}}
{{--                    </script>--}}
{{--                @else--}}
{{--                    <div class="center-block border rounded-lg text-center justify-center" style="width: 100%; height: 210px; z-index: 0">--}}
{{--                        <p class="items-center justify-center">--}}
{{--                            No Location Estimates--}}
{{--                        </p>--}}
{{--                    </div>--}}
                @endif
            </li>
            @endforeach
            @if(count($currentSessions) > 1)
                <div class="w-full max-w-sm p-4 bg-white border border-gray-200 rounded-lg shadow sm:p-6 md:p-8 dark:bg-gray-800 dark:border-gray-700">
                    <form class="space-y-6" action="#">
                        <h5 class="text-xl font-medium text-gray-900 dark:text-white">Sign out of all devices</h5>
                        <p class="text-xs font-medium text-gray-900 dark:text-white">
                            Please enter your password to sign out of all devices which are current showing as active.
                        </p>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your password</label>
                            <input wire:model="password" type="password" name="password" id="password" placeholder="**********" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                        </div>
                        <button wire:click="killSession" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Logout all devices</button>
                    </form>
                </div>
                @endif
        </ul>
    </div>

    <div>
        <h6 class="text-lg font-bold dark:text-white">Login Activity ({{ $activity->count() ?? 0 }})</h6>

        <div class="p-5 grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-3 xl:grid-cols-3 gap-5">
            @foreach($activity as $past)
                <div class="bg-white shadow-xl rounded-lg overflow-hidden">
                    <div class="bg-cover bg-center h-16 p-4 flex justify-end items-center" style="background-image: url(https://mosscm.com/wp-content/uploads/2017/11/news-dallas-skyline.jpg)">
                        <p class="uppercase tracking-widest text-sm text-white bg-black py-1 px-2 rounded opacity-75 shadow-lg">{{ $past->location_city.' ,' ?? null}} {{ $past->location_country.' ,' ?? null }} {{ $past->location_post_zip_code ?? null}}</p>
                    </div>
                    <div class="grid grid-cols-3 gap-2">
                        <div class="col-span-2 p-4 text-gray-700 flex justify-between">
                            <div>
                                <p class="text-sm text-gray-900 mb-3">Logged In {{ $past->log_in->diffForHumans() }}</p>
                                <p class="text-sm text-gray-900 mb-3">{{ $past->log_in->format('D d M y') }}</p>
                            </div>
                        </div>
                        <div class="col-span-1 p-4 text-gray-700 flex justify-between">
                            <div class="leading-loose flex-inline text-sm">
                                <div class="flex items-center">
                                    <i class="mr-2 wi wi-horizon-alt text-yellow-500"></i>
                                    <p><span class="text-xs+">From: {{ $past->log_in?->format('H:i') ?? null}}</span> </p>
                                </div>
                                <div class="flex items-center">
                                    <i class="mr-2 wi wi-horizon text-purple-400"></i>
                                    <p><span class="text-xs+">Until: {{ $past->log_out?->format('H:i') ?? null}}</span></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center p-4 border-t border-gray-300 text-gray-600">
                        <div class="flex items-center">
                            <i class="mr-2 wi wi-hot"></i>
                            <p><span class="text-gray-900 font-bold">IP Address</span></p>
                        </div>
                        <div class="flex items-center">
                            <i class="mr-2 wi wi-rain"></i>
                            <p><span class="text-gray-900 font-bold">{{ $past->ip_address }}</span></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div>
            {{ $activity->links() }}
        </div>
    </div>
</div>
