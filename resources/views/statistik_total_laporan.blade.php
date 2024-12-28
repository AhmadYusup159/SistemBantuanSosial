@include('template_admin.header')
@include('template_admin.sidebar')

<main class="col-md-9 col-lg-10 content py-4 d-flex flex-column">
    <figure class="highcharts-figure">
        <div id="container"></div>
        <p class="highcharts-description">
            Grafik ini menunjukkan jumlah laporan yang dibuat berdasarkan tahun.
        </p>
        <p class="highcharts-description">
            Total keseluruhan laporan yang masuk: <strong>{{ $totalReports }}</strong>
        </p>
    </figure>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const reportsByYear = @json($reportsByYear);

            const categories = reportsByYear.map(report => report.year);
            const data = reportsByYear.map(report => report.count);

            Highcharts.chart('container', {
                chart: {
                    type: 'pie',
                },
                title: {
                    text: 'Jumlah Laporan Per Tahun'
                },
                subtitle: {
                    text: 'Sistem Monitoring'
                },
                xAxis: {
                    title: {
                        text: 'Tahun'
                    },
                    categories: categories
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Laporan'
                    }
                },
                tooltip: {
                    shared: true,
                    valueSuffix: ' laporan'
                },
                series: [{
                    name: 'Laporan',
                    data: data,
                    color: '#007bff'
                }]
            });
        });
    </script>
</main>

@include('template_admin.footer')
