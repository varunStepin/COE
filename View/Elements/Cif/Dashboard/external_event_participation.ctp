<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Participation in external events </h4>
    </div>
    <div class="box-body">
        <div id="external_event_graph" style="height: 400px;"></div>
    </div>
</div>
<script>
      $(function() {
        
        var externalEventParticipantData=JSON.parse('<?= json_encode($graphCounts['ExternalEventParticipant'])?>');
        let colours = [
            '#ff661a','#ff99ff','#0099cc','#993366'
        ]
        var finalExternalEventParticipant = [];
        let colourIndex = 0;
        finalExternalEventParticipant.push({
            'name' : 'Target',
            'y': parseFloat('<?= $graphCounts['ExternalEventParticipantTarget']['count'] ?>'),
        })
        $.each(externalEventParticipantData, function(index, value) {
            if(colourIndex > 3)
                colourIndex=0;
            colourIndex++;

            finalExternalEventParticipant.push({
                'name':externalEventParticipantData[index].CifExternalEvent.event_name,
                'y':parseFloat(externalEventParticipantData[index][0].count),
                'color':colours[colourIndex],
                'id':externalEventParticipantData[index].CifExternalEvent.id,
            })
        });
        console.log(finalExternalEventParticipant);
        
        //console.log(fundDetails);

        Highcharts.chart('external_event_graph', {
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
                    text: 'External Event Participants'
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
                                $(this).loadModalData('External Event Participants', this.name,this.id);
                            }
                        }
                    }
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f} </b><br/>'
            },
            series: [{
                name: "Total no of External Event Participants of year <?= $year ?>",
                colorByPoint: true,
                data: finalExternalEventParticipant
            }],
        });
    });
</script>
