<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Innovators Accelerated </h4>
    </div>
    <div class="box-body">
        <div id="Innovators_accelerated" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {


        drillDownData = [];

        var final_array=<?= json_encode($final_array) ?>;
        $.each(final_array,function(index, value){

            $.each(final_array[index],function(index1, value1){

                year=[];
                $.each(final_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    drillDownData.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]

                });

                achieveYear=[];
                $.each(final_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    drillDownData.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(final_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        drillDownData.push({
                            id: index+'-'+index2+'-Achieved',
                            name: index+'-'+index2+'-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });

        var colors1 = ['#5e066d', '#697302'];
        var colors2 = ['#bccb6a', '#5ba8e7', '#7077f1', '#4bd3a7', '#a690e7', '#d662c0', '#d57692', '#bccb6a'];

        Highcharts.chart('Innovators_accelerated', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: 25,
                    depth: 50,
                    viewDistance: 50
                },
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'No. of Mentors/Investors/Market Researches'
                }
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true
                    },

                    cursor: 'pointer',

                    point: {
                        events: {
                            click: function () {
                                if(this.y >0 && this.year!='' && this.year>0){
                                    $(this).loadModalData(this.shName,this.year,this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Target',
                data: [
                    ['Startup Physical',final_array['DsAiPhyAccStartup']['Target']['count'],'DsAiPhyAccStartup-YearWise-Target',colors1[0]],
                    ['Startup Virtual',final_array['DsAiVirtualAccStartup']['Target']['count'],'DsAiVirtualAccStartup-YearWise-Target',colors1[0]],

                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Startup Physical',final_array['DsAiPhyAccStartup']['Achieve']['count'],'DsAiPhyAccStartup-YearWise-Achieved',colors1[1]],
                    ['Startup Virtual',final_array['DsAiVirtualAccStartup']['Achieve']['count'],'DsAiVirtualAccStartup-YearWise-Achieved',colors1[1]],

                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series: drillDownData
            }
        });

    });
</script>
