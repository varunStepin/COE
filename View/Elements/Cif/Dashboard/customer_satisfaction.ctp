<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Customer Satisfaction </h4>
    </div>
    <div class="box-body">
        <div id="customer_satisfaction_graph" style="height: 400px;"></div>
    </div>
</div>
<script>
      $(function() {
        
        var customerSatisfactionData=JSON.parse('<?= json_encode($graphCounts['CustomerSatisfaction'])?>');
        let colours = [
            '#66ccff','#336699','#669999','#993366'
        ]
        var finalcustomerSatisfactionData = [];
        let colourIndex = 0;
        
        finalcustomerSatisfactionData.push({
            'name': 'Target',
            'y': parseFloat('<?= $graphCounts['CustomerSatisfactionTarget']['count'] ?>'),
            'color': '#00cc44'
        })
        $.each(customerSatisfactionData, function(index, value) {
            if(colourIndex > 3)
                colourIndex=0;
            colourIndex++;

            finalcustomerSatisfactionData.push({
                'name':customerSatisfactionData[index].date,
                'y':parseFloat(customerSatisfactionData[index].percentage),
                'color':colours[colourIndex],
                'id':customerSatisfactionData[index].date,
            })
        });
        console.log(finalcustomerSatisfactionData);
        
        //console.log(fundDetails);

        Highcharts.chart('customer_satisfaction_graph', {
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
                    text: 'Customer Satisfaction in %'
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
                                $(this).loadModalData('Customer Satisfaction', this.name,this.id);
                            }
                        }
                    }
                },
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.f}% </b><br/>'
            },
            series: [{
                name: "Customer Satisfaction in <?= $year ?>",
                colorByPoint: true,
                data: finalcustomerSatisfactionData
            }],
        });
    });
</script>
