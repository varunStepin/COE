<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Gender Diversity Programes</h4>
    </div>
    <div class="box-body">
        <div id="gender_diversity_graph" style="height: 400px;"></div>
    </div>
</div>
<script>
      $(function() {
        
        var genderDiversityData=JSON.parse('<?= json_encode($graphCounts['GenderDiversityPrograms'])?>');
        let colours = [
            '#00cc44','#996600','#0099cc','#993366'
        ]
        var finalGenderSeries = [];
        let colourIndex = 0;
        finalGenderSeries.push({
            name: "Target",
            y: parseFloat('<?= $graphCounts['GenderDiversityTarget']['count'] ?>'),
            color:'#0086b3'
        })
        $.each(genderDiversityData, function(index, value) {
            if(colourIndex > 3)
                colourIndex=0;
            colourIndex++;

            finalGenderSeries.push({
                'name':genderDiversityData[index].CifGenderDiversity.event_name,
                'y':parseFloat(genderDiversityData[index].CifGenderDiversity.percentage_woman_participants),
                'color':colours[colourIndex],
                'id':genderDiversityData[index].CifGenderDiversity.id,
            })
        });
        console.log(finalGenderSeries);
        
        //console.log(fundDetails);

        Highcharts.chart('gender_diversity_graph', {
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
                    text: 'Percentage of Women Participants'
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
                        format: '{point.y} %'
                    },
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function() { 
                                $(this).loadModalData('Gender Diversity', this.name,this.id);
                            }
                        }
                    }
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f} %</b><br/>'
            },
            series: [{
                name: "Total % of Seats occupied by Women <?= $year ?>",
                colorByPoint: true,
                data: finalGenderSeries
            },
            ],
        });
    });
</script>
