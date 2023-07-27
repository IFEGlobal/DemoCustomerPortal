<div>
    <div class="min-w-full mt-4 grid grid-cols-12 gap-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 sm:gap-5 lg:mt-6 lg:gap-6 mb-10">
        <div class="col-span-12 lg:col-span-8 min-width-full">
            <div class="flex items-center justify-between space-x-2 space-x-reverse">
                <h2 class="text-base font-medium tracking-wide text-slate-800 line-clamp-1 dark:text-navy-100">
                    Shipment Overview <i class="fa-regular fa-hand-pointer"></i>
                </h2>
            </div>

            <div class="flex">
                <div class="ax-transparent-gridline grid w-full grid-cols-1 w-full ml-2">
                    <div id="ShipmentsChart" width="100%" height="255px"></div>
                </div>
            </div>
        </div>

        <div class="col-span-12 lg:col-span-4">
            <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 sm:gap-5 lg:grid-cols-2">
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between space-x-1 space-x-reverse">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            {{ $arrivals }}
                        </p>
                        <img src="/icons/due-to-arrive-icon.svg" class="h-8 w-8">
                    </div>
                    <p class="mt-1 text-xs+">Arrivals</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            {{ $departures }}
                        </p>
                        <img src="/icons/ship-port-arrival-icon.svg" class="h-8 w-8">
                    </div>
                    <p class="mt-1 text-xs+">Departures</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            {{ $arrivalTEU }}
                        </p>
                        <img src="/icons/container-teu.svg" class="h-8 w-8">
                    </div>
                    <p class="mt-1 text-xs+">Total Arrival TEU </p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            {{ $departureTEU }}
                        </p>
                        <img src="/icons/container-teu.svg" class="h-8 w-8">
                    </div>
                    <p class="mt-1 text-xs+">Total Departure TEU</p>
                </div>
                <div class="rounded-lg bg-slate-150 p-4 dark:bg-navy-700">
                    <div class="flex justify-between space-x-1 space-x-reverse">
                        <p class="text-xs+ font-semibold text-slate-700 dark:text-navy-100">
                            Chart including a <i class="fa-regular fa-hand-pointer"></i> will filter other charts
                        </p>
                        <img class="rounded-full h-8 w-8" src="/icons/robot.gif" alt="avatar">
                    </div>
                    <p class="mt-1 text-xs+">Tips Bot</p>
                </div>
                <a wire:click="ClearFilter" class="rounded-lg bg-white cursor-pointer p-4 dark:bg-green-700">
                    <div class="flex justify-between">
                        <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                            Clear
                        </p>
                        <img src="/icons/cleaning.svg" class="h-8 w-8">
                    </div>
                    <p class="mt-1 text-xs+">Clear Applied Filters</p>
                </a>
            </div>
        </div>

        <div class="col-span-12 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:col-span-4 lg:grid-cols-1 lg:gap-4 xl:col-span-4">
            <div class="card pb-5">
                <div class="my-3 flex h-8 items-center justify-between px-4 sm:px-5">
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        TEU on Departure {{ $currentMonth ?? '' }}
                    </h2>
                </div>

                <div id="teuByDeparture" width="100%"></div>

                <div class="mx-auto mt-3 max-w-xs px-4 text-center text-xs+ sm:px-5">
                    <p>TEU analytics calculated based on month selection</p>
                </div>
            </div>
            <div class="card pb-5">
                <div class="my-3 flex h-8 items-center justify-between px-4 sm:px-5">
                    <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        TEU on Arrival {{ $currentMonth ?? '' }}
                    </h2>
                </div>

                <div id="teuByArrival" width="100%"></div>

                <div class="mx-auto mt-3 max-w-xs px-4 text-center text-xs+ sm:px-5">
                    <p>TEU analytics calculated based on month selection</p>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-4">
            <div class="card px-4 pb-5 sm:px-5">
                <div class="flex items-center justify-between py-3">
                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Transit By Carrier Departure
                    </h2>
                    @if($currentMonth == null)
                        Last 24 Months
                    @else
                        Filtered: <strong>{{ $currentMonth }}</strong>
                    @endif
                </div>
                <div>
                    <p>
                        <span class="text-3xl text-slate-700 dark:text-navy-100">{{ $teuCarrierCount }}</span>
                        <span class="text-xs text-success">Carriers used in {{ $teuCarrierJourneys }} transits</span>
                    </p>
                    <p class="text-xs+"></p>
                </div>
                <div class="is-scrollbar-hidden mt-1 min-w-full overflow-x-auto">
                    <table class="w-full font-inter">
                        <tbody>
                        @foreach($totalCarrierTransit as $key => $carrier)
                            <tr>
                                <td class="whitespace-nowrap py-2">
                                    <div class="flex items-center space-x-2 space-x-reverse">
                                        <div
                                            class="h-1.5 w-1.5 mr-2  rounded-full border-2 border-primary dark:border-accent">
                                        </div>
                                        <p class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            {{ \Illuminate\Support\Str::limit($key, 35, '...') }}
                                        </p>
                                    </div>
                                </td>
                                <td class="whitespace-nowrap py-2 text-right">
                                    <p class="font-medium text-slate-700 dark:text-navy-100">
                                        {{ $carrier }}
                                    </p>
                                </td>
                                <td class="whitespace-nowrap py-2 text-right text-green-600 text-xs+">
                                    @if(count($totalCarrierTransit) < 2)
                                        100%
                                    @else
                                        {{ round(($carrier / array_sum($totalCarrierTransit) * 100),2) ?? 0 }}%
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex items-center justify-between mt-4">
                <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                    Shipments {{ $currentMonth ?? '' }}
                </h2>
            </div>
            <livewire:analytics.shipment-analytics-table/>
        </div>
        <div class="card col-span-12 lg:col-span-4 xl:col-span-4">
            <livewire:analytics.route-analytics/>
        </div>
    </div>

    <script type="module">

        const data = {!! json_encode($data['Graphs']) !!};

        var labels = Object.keys(data);

        var arrivalData = [];

        var departureData = []

        var loopData = Object.values(JSON.parse(JSON.stringify(data)));

        loopData.forEach(function(val){

            if(typeof val['DepartureTotal'] !== "undefined")
            {
                departureData.push(val['DepartureTotal']);
            }

            if(typeof val['ArrivalTotal'] !== "undefined")
            {
                arrivalData.push(val['ArrivalTotal']);
            }
        });

        const options = {
            colors: ["#4C4EE7", "#0EA5E9"],
            series: [
                {
                    name: "Arrivals",
                    data: arrivalData,
                },
                {
                    name: "Departures",
                    data: departureData,
                },
            ],
            xaxis: {
                type: "category",
                categories: labels.slice(0,-1),
            },

            chart: {
                height: 255,
                type: "bar",
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                events: {
                    dataPointSelection: (event, chartContext, config) => {
                        console.log(config.w.config.xaxis.categories[config.dataPointIndex])
                        Livewire.emit('setMonth', config.w.config.xaxis.categories[config.dataPointIndex]);
                    }
                }
            },
            dataLabels: {
                enabled: false,
            },
            plotOptions: {
                bar: {
                    borderRadius: 4,
                    barHeight: "90%",
                    columnWidth: "35%",
                },
            },
            legend: {
                show: false,
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: -10,
                },
            },
            yaxis: {
                show: false,
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                labels: {
                    show: false,
                },
            },
            responsive: [
                {
                    breakpoint: 1280,
                    options: {
                        plotOptions: {
                            bar: {
                                columnWidth: "55%",
                            },
                        },
                    },
                },
            ],
        }

        const shipmentsChart = new ApexCharts(document.querySelector("#ShipmentsChart"), options);

        shipmentsChart.render();

        var teuByDeparture = {
            colors: ["#4ade80", "#f43f5e", "#a855f7", "#a855f9", "#FF5733", "#3377FF", "#FF33FC", "#03C8B9", "#AF6875","#64494E","#82B9DA","#525CC4","#8E97F3","#F38EB6"],
            series: [],
            chart: {
                height: 350,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 10,
                        size: "35%",
                    },
                    track: {
                        margin: 10,
                    },
                    dataLabels: {
                        name: {
                            fontSize: "22px",
                        },
                        value: {
                            fontSize: "16px",
                        },
                        total: {
                            show: true,
                            label: "Total TEU",
                            formatter: function (w) {
                                return w.config.series.reduce((s, v) => s + v);
                            },
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: -20,
                    bottom: -20,
                    right: 0,
                    left: 0,
                },
            },
            stroke: {
                lineCap: "round",
            },
            labels: [],
            noData: {
                text: 'Select Month'
            }
        }

        var teuByDepartureChart = new ApexCharts(document.querySelector("#teuByDeparture"), teuByDeparture);

        teuByDepartureChart.render()

        document.addEventListener("updateDepartureTEU", function(event)
        {
            var data = JSON.parse(event.detail);

            var labels = Object.keys(data)

            var values = Object.values(data)

            teuByDepartureChart.updateOptions({
                labels: labels,
                series: values
            });
        });

        var teuByArrival = {
            colors: ["#4ade80", "#f43f5e", "#a855f7", "#a855f9", "#FF5733", "#3377FF", "#FF33FC", "#03C8B9", "#AF6875","#64494E","#82B9DA","#525CC4","#8E97F3","#F38EB6"],
            series: [],
            chart: {
                height: 350,
                type: "radialBar",
            },
            plotOptions: {
                radialBar: {
                    hollow: {
                        margin: 10,
                        size: "35%",
                    },
                    track: {
                        margin: 10,
                    },
                    dataLabels: {
                        name: {
                            fontSize: "22px",
                        },
                        value: {
                            fontSize: "16px",
                        },
                        total: {
                            show: true,
                            label: "Total TEU",
                            formatter: function (w) {
                                return w.config.series.reduce((s, v) => s + v);
                            },
                        },
                    },
                },
            },
            grid: {
                padding: {
                    top: -20,
                    bottom: -20,
                    right: 0,
                    left: 0,
                },
            },
            stroke: {
                lineCap: "round",
            },
            labels: [],
            noData: {
                text: 'Select Month'
            }
        }

        var teuByArrivalChart = new ApexCharts(document.querySelector("#teuByArrival"), teuByArrival);

        teuByArrivalChart.render()

        document.addEventListener("updateArrivalTEU", function(event){

            var data = JSON.parse(event.detail);

            var labels = Object.keys(data)

            var values = Object.values(data)

            teuByArrivalChart.updateOptions({
                labels: labels,
                series: values
            });
        });


    </script>
</div>

