const data = window.data['Graphs'];

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

var options = {
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
                breakpoint: 850,
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

var shipmentsChart = new ApexCharts(document.querySelector("#ShipmentsChart"), options);

shipmentsChart.render();



