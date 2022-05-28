<div class="box ">
    <div class=" box-header with-border">
        <div class="row">
            <div class="col-lg-8">
                <h4 class="box-title text-info">Fund Raised By Startups</h4>
            </div>
        </div>
    </div>
    <div class="box-body">
        <div id="StartupRaisedFund" style="height: 400px;"></div>

    </div>
</div>
<script>
    $(function() {
        
        var fundDetails=JSON.parse('<?= json_encode($graphCounts['StartupRaisedFund'])?>');
        let colours = [
            '#0099cc','#0086b3','#cc66ff','#ff8000'
        ]
        var finalFundDetails = [];
        let colourIndex = 0;

        finalFundDetails.push({
            name: "Target",
            y: parseFloat('<?= $graphCounts['StartupsTargetToRaiseFund']['count'] ?>'),
            color:'#A52A2A'
        })
        $.each(fundDetails, function(index, value) {
            if(colourIndex > 3)
                colourIndex=0;
            colourIndex++;

            finalFundDetails.push({
                'name':fundDetails[index].name,
                'y':parseFloat(fundDetails[index].y),
                'color':colours[colourIndex],
                'startup_id':fundDetails[index].startup_id,
            })
        });
        console.log(finalFundDetails);
        
        //console.log(fundDetails);

        Highcharts.chart('StartupRaisedFund', {
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
                    text: 'Total Funding Raised in INR(Cr)'
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
                                $(this).loadModalData('Fund Raised By Startup', this.name,this.startup_id);
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
                        name: "Total Fund Raised in <?= $year ?>",
                        colorByPoint: true,
                        data: finalFundDetails
                    }],
        });
    });
</script>