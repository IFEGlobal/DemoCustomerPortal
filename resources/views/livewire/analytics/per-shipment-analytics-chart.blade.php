<div>
    <div class="flex-grow rounded-xl mb-4">
        <header class="p-4 rounded-lg border-b flex items-center">
            <h2 class="font-semibold text-sm text-gray-800 dark:text-white">Click Filtering Is Enabled On This Chart</h2>
        </header>
        <canvas id="shipmentGraph" class="p-3" width="800" height="400"></canvas>
    </div>
    <div class="box-border max-full mx-4 sm:columns-1 md:columns-2 lg:columns-2 xl:columns-2">
        <article class="break-inside rounded-xl dark:bg-slate-800 mb-4 flex flex-col bg-clip-border">
            <header class="p-4 rounded-lg border-b flex items-center">
                <h2 class="font-semibold text-sm text-gray-800 dark:text-white">TEU By Carrier</h2>
            </header>
            <canvas id="drillDownCarrier" class="p-4" width="395" height="395"></canvas>
        </article>
        <article class="break-inside rounded-xl mb-4 flex flex-col bg-clip-border">
            <header class="p-4 rounded-lg border-b flex items-center">
                <h2 class="font-semibold text-sm text-gray-800 dark:text-white">TEU By Shipment</h2>
            </header>
            <canvas id="drillDownShipment" class="p-4" width="395" height="395"></canvas>
        </article>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        window.addEventListener('refreshComponent', event => {
            function dynamicColors() {
                var r = Math.floor(Math.random() * 255);
                var g = Math.floor(Math.random() * 255);
                var b = Math.floor(Math.random() * 255);
                return "rgba(" + r + "," + g + "," + b + ", 0.8)";
            }
            function poolColors(a) {
                var pool = [];

                for(i = 0; i < a; i++) {
                    pool.push(dynamicColors());
                }
                return pool;
            }

            const shipmentDataset = Object.values(event.detail);

            Chart.defaults.font.family = '"Inter", sans-serif';
            Chart.defaults.font.weight = '500';
            Chart.defaults.color = 'rgb(148, 163, 184)';
            Chart.defaults.scale.grid.color = 'rgb(241, 245, 249)';
            Chart.defaults.plugins.tooltip.titleColor = 'rgb(30, 41, 59)';
            Chart.defaults.plugins.tooltip.bodyColor = 'rgb(30, 41, 59)';
            Chart.defaults.plugins.tooltip.backgroundColor = '#FFF';
            Chart.defaults.plugins.tooltip.borderWidth = 1;
            Chart.defaults.plugins.tooltip.borderColor = 'rgb(226, 232, 240)';
            Chart.defaults.plugins.tooltip.displayColors = false;
            Chart.defaults.plugins.tooltip.mode = 'nearest';
            Chart.defaults.plugins.tooltip.intersect = false;
            Chart.defaults.plugins.tooltip.position = 'nearest';
            Chart.defaults.plugins.tooltip.caretSize = 0;
            Chart.defaults.plugins.tooltip.caretPadding = 20;
            Chart.defaults.plugins.tooltip.cornerRadius = 4;
            Chart.defaults.plugins.tooltip.padding = 8;

            const dataMonthlyChart = {
            datasets: [
                {
                    label: 'Transit by departure',
                    fill: true,
                    backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                    borderColor: poolColors(dataset[dataset.length-1][1].length),
                    borderWidth: 2,
                    tension: 0,
                    pointRadius: 0,
                    pointHoverRadius: 3,
                    pointBackgroundColor: 'rgb(99, 102, 241)',
                    data: shipmentDataset[0],
                    parsing: {
                       xAxisKey: 'Month',
                       yAxisKey: 'Days',
                    }
                },
            ],
        };

        const configMonthlyChart = {
            type: "bar",
            data: dataMonthlyChart,
            options: {},
        };

         var chartStatus = Chart.getChart("shipmentGraph");

         if(chartStatus != undefined) {
           chartStatus.destroy();
         }

        var MonthlyShipmentChart = new Chart(
            document.getElementById("shipmentGraph"),
            configMonthlyChart
        );

        function shipmentChartHandler(click)
        {
            const points = MonthlyShipmentChart.getElementsAtEventForMode(click, 'nearest', {interect: true}, true);

            if(points.length)
            {
                var perShipmentFilterValue = shipmentDataset[0][points[0].index].Carriers[0];

                var dataLabels = [];
                var dataDays = [];
                var dataLabel = [];

                perShipmentFilterValue.forEach(carrier => {dataLabels.push(carrier.Carrier), dataDays.push(carrier.Days), dataLabel.push(carrier.Shipment)});

                const shipmentDaysArr = {
                    labels: dataLabels,
                    title: dataLabel,
                    datasets: [{
                        data: dataDays,
                        backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                        borderWidth: 1,
                      }],
                    };

                const shipmentDaysArrConfig = {
                        type: 'doughnut',
                        data: shipmentDaysArr,
                        options: {
                         responsive: false,
                        }
                    };

                var chartStatus2 = Chart.getChart("drillDownCarrier");

                if(chartStatus2 != undefined) {
                    chartStatus2.destroy();
                }

                const shipmentDaysArrRender = new Chart(
                    document.getElementById('drillDownCarrier'),
                    shipmentDaysArrConfig
                );

                // By Shipment
                const daysByShipment = {
                    labels: dataLabel,
                    title: dataLabel,
                    datasets: [{
                        data: dataDays,
                        backgroundColor: poolColors(dataset[dataset.length-1][1].length),
                        borderWidth: 1,
                      }],
                    };

                const daysByShipmentConfig = {
                        type: 'pie',
                        data: daysByShipment,
                        options: {
                         responsive: false,
                        }
                    };

                var chartStatus3 = Chart.getChart("drillDownShipment");

                if(chartStatus3 != undefined) {
                    chartStatus3.destroy();
                }

                const shipmentDaysShipmentRender = new Chart(
                    document.getElementById('drillDownShipment'),
                    daysByShipmentConfig
                );

            }
        }

        MonthlyShipmentChart.canvas.onclick = shipmentChartHandler;
    })
    </script>
</div>
