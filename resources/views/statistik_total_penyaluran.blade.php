@include('template_admin.header')
@include('template_admin.sidebar')
<main class="col-md-9 col-lg-10 content py-4 d-flex flex-column">

    <figure class="highcharts-figure">
        <h2>Grafik Penyaluran Bantuan Per Wilayah</h2>
        <div id="regionChart"></div>
    </figure>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const distributionData = @json($distributionByRegion);
            const regions = distributionData.map(data => `${data.province} - ${data.district}`);
            const totals = distributionData.map(data => data.total_distributions);

            Highcharts.chart('regionChart', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: 'Penyaluran Bantuan Per Wilayah'
                },
                xAxis: {
                    categories: regions,
                    title: {
                        text: 'Wilayah'
                    }
                },
                yAxis: {
                    title: {
                        text: 'Jumlah Penyaluran'
                    }
                },
                series: [{
                    name: 'Penyaluran',
                    data: totals
                }]
            });
        });
    </script>
</main>

@include('template_admin.footer')
