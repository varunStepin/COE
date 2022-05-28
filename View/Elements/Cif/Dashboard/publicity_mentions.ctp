<div class="box ">
    <div class=" box-header with-border">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="box-title text-info">Publicity Mentions</h4>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div id="PublicityMentions" style="height: 400px;"></div>

    </div>
</div>
<script>
    $(function() {
        // Create the chart
        let year = '<?= $eventYear ?>';
        Highcharts.chart('PublicityMentions', {
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
                    text: 'Total No. Of Publicity Mentions'
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
                                $(this).loadModalData('Publicity Mentions', this.name);
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
                        y: parseFloat('<?= $graphCounts['PublicityMentionsTarget']['count'] ?>'),
                        color:'#993366'
                    },
                    {
                        name: "Online Platform",
                        y: parseFloat('<?= $graphCounts['PublicityMentions']['OnlinePlatform'] ?>'),
                        color:'#3399ff'
                    },
                    {
                        name: "News Paper",
                        y: parseFloat('<?= $graphCounts['PublicityMentions']['NewsPaper'] ?>'),
                        color:'#ff751a'
                    },
                ]
            }],
        });
    });
</script>