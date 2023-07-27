<div>
    <div class="mt-3 flex items-center justify-between px-4 sm:px-5">
        <h2 class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
            Route History <i class="fa-regular fa-hand-pointer"></i>
        </h2>
    </div>

    <div class="mt-5 grid grid-cols-1 gap-4 px-4 sm:grid-cols-2 sm:px-5">
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-info to-info-focus p-3.5">
            <p class="text-xs uppercase text-sky-100">Total Routes</p>
            <div class="flex items-end justify-between space-x-2 space-x-reverse">
                <p class="mt-4 text-2xl font-medium text-white">{{ count($routeSummary) ?? 0 }}</p>
            </div>
            <div class="mask is-reuleaux-triangle absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
        <div class="relative flex flex-col overflow-hidden rounded-lg bg-gradient-to-br from-pink-500 to-rose-500 p-3.5">
            <p class="text-xs uppercase text-pink-100">Total Journeys</p>
            <div class="flex items-end justify-between space-x-2 space-x-reverse">
                <p class="mt-4 text-2xl font-medium text-white">{{ $totalVoyages }}</p>
            </div>
            <div class="mask is-hexagon-2 absolute top-0 right-0 -m-3 h-16 w-16 bg-white/20"></div>
        </div>
    </div>

    <div class="is-scrollbar-hidden mt-2 min-w-full overflow-x-auto max-h-[calc(80vh-20rem)]">
        <table class="relative items-center w-full bg-white border-collapse rounded-lg text-blueGray-700 ">
            <thead class="thead-light ">
            <tr>
                <th class="sticky top-0 px-6 bg-white text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                    Shipping Route
                </th>
                <th class="sticky top-0 px-6 bg-white text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                    Journeys
                </th>
                <th class="sticky top-0 px-6 bg-white text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                    Percentage
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($routeSummary as $key => $summary)
                <tr>
                    <th wire:click="setCardData('{{ $key }}')" class="border-t-0 px-6 cursor-pointer align-middle border-l-0 border-r-0 text-xs whitespace-wrap p-4 text-left">
                        {{ $key ?? '-' }}
                    </th>
                    <td class="border-t-0 px-6 align-middle font-semibold border-l-0 border-r-0 text-xs whitespace-nowrap p-4 ">
                        {{ array_sum($summary[2]) ?? '-' }}
                    </td>
                    <td class="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                        <div class="flex items-center">
                            <span class="mr-2">{{ round(((array_sum($summary[2]) ?? '-') / $totalVoyages * 100),0) }}%</span>
                            <div class="relative w-full">
                                <div class="overflow-hidden h-2 text-xs flex rounded bg-red-200">
                                    <div style="width: {{ round(((array_sum($summary[2]) ?? '-') / $totalVoyages * 100),0) }}%" class="shadow-none flex flex-col text-center whitespace-nowrap text-white justify-center bg-red-500"></div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="my-3 flex items-center justify-between px-4">
        <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
            Route Details
        </h2>
    </div>
    <div class="grid grid-cols-2 gap-3 px-4">
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <div class="flex justify-between space-x-1 space-x-reverse">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    {{ $routeAverage ?? 'Select Route' }}
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" stroke-width="1.5"
                     class="h-5 w-5 text-primary dark:text-accent" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
            </div>
            <p class="mt-1 text-xs+">Route Average Days</p>
        </div>
        <div class="rounded-lg bg-slate-100 p-3 dark:bg-navy-600">
            <div class="flex justify-between">
                <p class="text-xl font-semibold text-slate-700 dark:text-navy-100">
                    {{ $carriersUsed ?? 'Select Route' }}
                </p>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success"
                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                </svg>
            </div>
            <p class="mt-1 text-xs+">Total Carriers</p>
        </div>
    </div>
    <div class="mt-3 ">
        <div class="ax-transparent-gridline pr-2">
            <div id="routeChart"></div>
        </div>
    </div>
    <h2 class="font-medium text-center justify-center tracking-wide text-slate-700 dark:text-navy-100">
        {{ $routeName ?? '' }}
    </h2>

    <script type="module">

        const routeChart = {
            colors: ["#0EA5E9", "#F000B9", "#0000ff"],
            series: [
                {
                    name: "Carrier",
                    data: [],
                },
                {
                    name: "Average TEU",
                    data: [],
                },
            ],
            chart: {
                height: 250,
                type: "area",
                toolbar: {
                    show: false,
                },
            },
            dataLabels: {
                enabled: false,
            },
            plotOptions: {
                bar: {
                    borderRadius: 5,
                    barHeight: "90%",
                    columnWidth: "40%",
                },
            },
            legend: {
                show: false,
            },
            xaxis: {
                categories: [],
                labels: {
                    show: false,
                },
                axisBorder: {
                    show: false,
                },
                axisTicks: {
                    show: false,
                },
                tooltip: {
                    enabled: false,
                },
            },
            grid: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: -8,
                },
            },
            yaxis: {
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
            noData: {
                text: 'Select Route'
            }
        }

        const routeDataChart = new ApexCharts(document.querySelector("#routeChart"), routeChart);

        routeDataChart.render();

        document.addEventListener("updateRouteChart", function(event){

            var data = JSON.parse(event.detail);

            var labels = Object.values(data[0]);

            var journeyValues = [];

            var journeyCountValues = [];

            var teuValues = [];

            function roundToTwo(num) {
                return +(Math.round(num + "e+2")  + "e-2");
            }

            Object.values(data[1]).forEach(function(val){
                journeyValues.push(roundToTwo(val));
            });

            Object.values(data[2]).forEach(function(val){
                journeyCountValues.push(roundToTwo(val));
            });

            Object.values(data[3]).forEach(function(val){
                teuValues.push(roundToTwo(val));
            });

            routeDataChart.updateOptions({
                series: [
                    {
                        name: "Average Days",
                        data: journeyValues,
                    },
                    {
                        name: "Journeys",
                        data: journeyCountValues,
                    },
                    {
                        name: "Total TEU",
                        data: teuValues,
                    },
                ],
                xaxis: {
                    categories: labels,
                }
            });
        });
    </script>
</div>
