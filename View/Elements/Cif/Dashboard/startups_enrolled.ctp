<div class="box ">
    <div class=" box-header with-border">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="box-title text-info">Startups Enrolled</h4>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div id="Startup" style="height: 400px;"></div>

    </div>
</div>
<script>
    $(function() {
        Highcharts.chart('Startup', {
            chart: {
                type: 'column'
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
                    text: 'Total No. Of Startups'
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
                                $(this).loadModalData('Startups Enrolled', this.name);
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
                name: "Total Count in <?= $year ?>",
                colorByPoint: true,
                data: [{
                        name: "Target",
                        y: parseFloat('<?= $graphCounts['StartupsTarget']['count'] ?>'),
                        color:'#ff751a'
                    },
                    {
                        name: "Startups",
                        y: parseFloat('<?= $graphCounts['Startup']['count'] ?>'),
                        color:'#8c1aff'
                    }
                ]
            }],
        });
    });
</script>