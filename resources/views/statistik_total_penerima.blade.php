@include('template_admin.header')
@include('template_admin.sidebar')

<main class="col-md-9 col-lg-10 content py-4 d-flex flex-column">
    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Grafik ini menunjukkan total penerima per tahun berdasarkan program.
        </p>
    </figure>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chartData = @json($chartData);

            const allYears = [...new Set(chartData.flatMap(item => item.data.map(d => d.year)))];
            const seriesData = chartData.map(item => ({
                name: item.name,
                data: allYears.map(year => {
                    const found = item.data.find(d => d.year === year);
                    return found ? found.total_recipients : 0;
                })
            }));

            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Total Penerima Per Tahun Berdasarkan Program'
                },
                subtitle: {
                    text: 'Sistem Monitoring - Statistik Penerima'
                },
                xAxis: {
                    categories: allYears,
                    crosshair: true,
                    title: {
                        text: 'Tahun'
                    },
                    accessibility: {
                        description: 'Tahun'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total Penerima'
                    }
                },
                tooltip: {
                    headerFormat: '<b>{series.name}</b><br>',
                    pointFormat: 'Tahun: {point.category}, Total Penerima: <b>{point.y}</b>'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: seriesData,
                credits: {
                    enabled: false
                }
            });
        });
    </script>
</main>

@include('template_admin.footer')
