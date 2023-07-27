<div>
    <div class="overflow-hidden mb-4">
        <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2 px-4">
            <header class="px-5 py-4 bg-white rounded-lg flex items-center dark:bg-gray-800">
                <h2 class="font-semibold text-gray-800 dark:text-white">Shipment Arrivals and Departures</h2>
            </header>
        </div>
        <div class="box-border max-full mx-4 sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">
            <article class="break-inside rounded-xl mb-4 flex flex-col bg-clip-border">
                <article class="break-inside rounded-xl mb-4 flex flex-col bg-clip-border">
                    <div class="overflow-hidden">
                        <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                            <header class="p-4 rounded-lg border-b flex items-center">
                                <h2 class="font-semibold text-sm text-gray-800 dark:text-white">Click Filtering Is Enabled On This Chart</h2>
                            </header>
                        </div>
                        <canvas class="p-8 rounded-lg bg-white dark:bg-gray-800 w-full" id="MonthlyBarChart"></canvas>
                    </div>
                </article>

                <article class="rounded-xl dark:bg-slate-800 mb-4 flex flex-col bg-clip-border">
                    <div class="sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">

                        <div class="rounded-lg overflow-hidden">
                            <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                                <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                    <h2 class="font-semibold text-gray-800">Carrier By Arrival</h2>
                                </header>
                            </div>
                            <canvas class="bg-white dark:bg:gray-800 w-full p-2" style="height: 392px; width: 392px;" id="ArrPieChart"></canvas>
                        </div>

                        <div class="rounded-lg overflow-hidden">
                            <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                                <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                    <h2 class="font-semibold text-gray-800">Carrier by Departure</h2>
                                </header>
                            </div>
                            <canvas class="bg-white dark:bg:gray-800 w-full p-2" style="height: 392px; width: 392px;" id="DeptPieChart"></canvas>
                        </div>
                    </div>
                </article>

            </article>
        </div>

        <div class="overflow-hidden">
            <div class="box-border max-full mx-4 sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">
                <article class="break-inside rounded-xl dark:bg-slate-800 mb-4 flex flex-col bg-clip-border">
                    <article class="rounded-xl dark:bg-slate-800 mb-4 flex flex-col bg-clip-border">
                        <div class="sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">
                            <div class="rounded-lg overflow-hidden">
                                <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                                    <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                        <h2 class="font-semibold text-gray-800">TEU By Carrier Arrival</h2>
                                    </header>
                                </div>
                                <canvas class="bg-white dark:bg:gray-800 w-full p-2" style="height: 392px; width: 392px;" id="TEUChartArr"></canvas>
                            </div>

                            <div class="rounded-lg overflow-hidden">
                                <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                                    <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                        <h2 class="font-semibold text-gray-800">TEU By Carrier Departure</h2>
                                    </header>
                                </div>
                                <canvas class="bg-white dark:bg:gray-800 p-2 items-center justify-center" style="height: 392px; width: 250px;"id="TEUChartDept"></canvas>
                            </div>
                        </div>
                    </article>

                    <article class="break-inside rounded-xl dark:bg-slate-800 mb-4 flex flex-col bg-clip-border">
                        <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                            <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                <h2 class="font-semibold text-gray-800">TEU By Carrier Departure</h2>
                            </header>
                        </div>
                        <canvas class="bg-white dark:bg:gray-800 p-3 items-center justify-center" id="TEULineChart"></canvas>
                    </article>

                </article>
            </div>
        </div>

        <div class="overflow-hidden">
            <div class="box-border max-full mx-4 sm:columns-1 md:columns-1 lg:columns-1 xl:columns-1">
                <article class="break-inside rounded-xl mb-4 flex flex-col bg-clip-border">
                    <div class="rounded-lg overflow-hidden">
                        <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                            <header class="px-5 py-4 bg-white rounded-lg border-b flex items-center">
                                <h2 class="font-semibold text-gray-800">By Shipment Analytics</h2>
                            </header>
                        </div>
                        <div class="rounded-lg">
                            <div class="flex flex-col col-span-full xl:col-span-8 rounded-lg mb-2">
                                <header class="p-4 rounded-lg border-b flex items-center">
                                    <h2 class="font-semibold text-sm text-gray-800 dark:text-white">Click Filtering Is Enabled On This Table</h2>
                                </header>
                            </div>
                            <livewire:analytics.shipment-analytics-datatable/>
                        </div>
                    </div>
                </article>
            </div>
        </div>
        <div class="overflow-hidden">
            <livewire:analytics.per-shipment-analytics-card/>
        </div>
    </div>

    <!-- Required chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Chart line -->
    <script>
        function dynamicColors() {
            var r = Math.floor(Math.random() * 255);
            var g = Math.floor(Math.random() * 255);
            var b = Math.floor(Math.random() * 255);
            return "rgba(" + r + "," + g + "," + b + ", 1)";
        }
        function poolColors(a) {
            var pool = [];

            for(i = 0; i < a; i++) {
                pool.push(dynamicColors());
            }
            return pool;
        }

        const dataset  = {!! json_encode(array_values($MonthlyShipmentsChart['Graphs'])) !!};

        const dataMonthlyChart = {
            datasets: [
                {
                    label: 'Departures by month',
                    backgroundColor: "hsl(4, 84%, 46%)",
                    borderColor: "hsl(252, 82.9%, 67.8%)",
                    data: dataset,
                    parsing: {
                       xAxisKey: 'Month',
                       yAxisKey: 'DepartureTotal',
                    }
                },
                {
                    label: 'Arrivals by month',
                    backgroundColor: "hsl(134, 61%, 50%)",
                    borderColor: "hsl(252, 82.9%, 67.8%)",
                    data: dataset,
                    parsing: {
                       xAxisKey: 'Month',
                       yAxisKey: 'ArrivalTotal',
                    }
                },
            ],
        };

        const configMonthlyChart = {
            type: "bar",
            data: dataMonthlyChart,
            options: {},
        };

        var MonthlyChart = new Chart(
            document.getElementById("MonthlyBarChart"),
            configMonthlyChart
        );

        //Pie Charts
            const DeptPieChart = {
                labels: dataset[dataset.length-1][0],
                datasets: [{
                    data: dataset[dataset.length-1][1],
                    backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                    borderWidth: 1,
                }]
            };

            const DeptPieChartConfig = {
                type: 'pie',
                data: DeptPieChart,
                options: {
                    responsive: true,
                }
            };

            const DeptPieChartRender = new Chart(
                document.getElementById('DeptPieChart'),
                DeptPieChartConfig
            );

            const ArrPieChart = {
                labels: dataset[dataset.length-1][0],
                datasets: [{
                    data: dataset[dataset.length-1][1],
                    backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                    borderWidth: 1,
                }]
            };

            const ArrPieChartConfig = {
                type: 'pie',
                data: ArrPieChart,
                options: {
                    responsive: true,
                },
            };

            const ArrPieChartRender = new Chart(
                document.getElementById('ArrPieChart'),
                ArrPieChartConfig
            );


        // TEU Chart Dept
        const TEUChart = {
            datasets: [{
                data: dataset[dataset.length-1][2],
                backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                borderWidth: 1,
              }]
            };

        const TEUChartConfig = {
                type: 'doughnut',
                data: TEUChart,
                options: {
                 responsive: true,
                     title: {
                      display: true,
                      responsive: true,
                    },
                }
            };

        const TEUChartRender = new Chart(
            document.getElementById('TEUChartDept'),
            TEUChartConfig
        );

        // TEU Chart Arr
        const TEUChartArr = {
            labels: dataset[dataset.length-1][2],
            datasets: [{
                data: dataset[dataset.length-1][2],
                backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                borderWidth: 1,
              }]
            };

        const TEUChartArrConfig = {
                type: 'doughnut',
                data: TEUChartArr,
                options: {
                 responsive: true,
                     title: {
                      display: true,
                      responsive: true,
                    }
                }
            };

        const TEUChartArrRender = new Chart(
            document.getElementById('TEUChartArr'),
            TEUChartArrConfig
        );

        //TUE Line Chart
        const dataTEULineChart = {
            datasets: [
                {
                    label: 'Total TEU by departure',
                    backgroundColor: "hsl(4, 84%, 46%)",
                    borderColor: "hsl(4, 84%, 46%)",
                    data: dataset,
                    parsing: {
                       xAxisKey: 'Month',
                       yAxisKey: 'DeparturesTEUTotal',
                    }
                },
                {
                    label: 'Total TEU by Arrival',
                    backgroundColor: "hsl(252, 82.9%, 67.8%)",
                    borderColor: "hsl(252, 82.9%, 67.8%)",
                    data: dataset,
                    parsing: {
                       xAxisKey: 'Month',
                       yAxisKey: 'ArrivalsTEUTotal',
                    }
                },
            ],
        };

        const configTUELineChart = {
            type: "line",
            data: dataTEULineChart,
            options: {
                bezierCurve: false,
            },
        };

        var TEULineChart = new Chart(
            document.getElementById("TEULineChart"),
            configTUELineChart
        );

        function monthlyChartHandler(click)
        {
            const points = MonthlyChart.getElementsAtEventForMode(click, 'nearest', {interect: true}, true);

            if(points.length){
                ArrPieChart.labels = dataset[points[0].index].Arrivals.Carriers;
                ArrPieChartRender.data.datasets[0].data = dataset[points[0].index].Arrivals.Values;
                ArrPieChartRender.update();

                DeptPieChart.labels = dataset[points[0].index].Departures.Carriers;
                DeptPieChartRender.data.datasets[0].data = dataset[points[0].index].Departures.Values;
                DeptPieChartRender.update();

                TEUChart.labels = dataset[points[0].index].Departures.TEUCarriers;
                TEUChartRender.data.datasets[0].data = dataset[points[0].index].Departures.TEU;
                TEUChartRender.update();

                TEUChartArr.labels = dataset[points[0].index].Arrivals.TEUCarriers;
                TEUChartArrRender.data.datasets[0].data = dataset[points[0].index].Arrivals.TEU;
                TEUChartArrRender.update();
            }

        }

        MonthlyChart.canvas.onclick = monthlyChartHandler;
    </script>
</div>
