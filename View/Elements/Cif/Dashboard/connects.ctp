<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Connect Programmes</h4>
    </div>
    <div class="box-body">
        <div id="cif_connect_graph" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function() {
        Highcharts.chart('cif_connect_graph', {
            chart: {
                type: 'column',
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total No. Of Connects in '+$('#year').val()
                },
                allowDecimals: false

            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    pointWidth: 50,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y}'
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() {
                                $(this).loadModalData('Connects', this.name);
                            }
                        }
                    }
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}</b><br/>'
            },
            series: [{
                name: "Total in <?= $year ?>",
                colorByPoint: true,
                data: [{
                        name: "Target",
                        y: parseFloat('<?= $graphCounts['ConnectTarget']['count'] ?>'),
                        color: '#993366'
                    },
                    {
                        name: "Connects",
                        y: parseFloat('<?= $graphCounts['Connects']['count'] ?>'),
                        color: '#0066ff'
                    },
                  
                ]
            }],
        });
    });
</script>
