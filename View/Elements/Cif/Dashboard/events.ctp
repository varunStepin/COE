<style>
    .highcharts-credits {
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="box-title text-info">Events</h4>
            </div>
            <!-- <div class="col-lg-4">
                <?php //echo $this->Form->input("year", array("type" => "select", "class" => "form-control select2 yearWise pull-right", "options" => $years, "label" => false, "empty" => "Year")) 
                ?>
            </div> -->
        </div>
    </div>
    <div class="box-body">
        <div id="cif_events_graph" style="height: 400px;"></div>

    </div>
</div>
<script>
    $(function() {
        let year = '<?= $eventYear ?>';
        Highcharts.chart('cif_events_graph', {
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
                    text: 'Total No. Of Events'
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
                                $(this).loadModalData('Events', this.name, '<?= $eventYear ?>');
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
                        y: parseFloat('<?= $graphCounts['EventsTarget']['count'] ?>'),
                        color: '#0abcdf'
                    },
                    {
                        name: "Conference",
                        y: parseFloat('<?= $graphCounts['Events']['Conference'] ?>'),
                        color: '#0066ff'
                    },
                    {
                        name: "Round Table",
                        y: parseFloat('<?= $graphCounts['Events']['RoundTable'] ?>'),
                        color: '#009933'
                    },
                    {
                        name: "Hackathon",
                        y: parseFloat('<?= $graphCounts['Events']['Hackathon'] ?>'),
                        color: '#333399'
                    },
                ]
            }],
        });
    });
</script>