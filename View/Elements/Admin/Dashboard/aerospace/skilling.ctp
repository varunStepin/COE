<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Skilling </h4>
    </div>
    <div class="box-body">
        <div id="skilling" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {

        var colors1 = ['#9981ff', '#6ab331'];

        drillDownData = [];

        var skilling_array=<?= json_encode($skilling_array) ?>;
        $.each(skilling_array,function(index, value){

            $.each(skilling_array[index],function(index1, value1){

                year=[];
                $.each(skilling_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    drillDownData.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear=[];
                $.each(skilling_array[index]['Achieve']['Year'],function(index2, value2){
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
                    $.each(skilling_array[index]['Achieve'][index2],function(index5, value5){
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

        Highcharts.chart('skilling', {
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
                    text: 'No. of courses conducted'
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
                    ['Defense Skilling',skilling_array['DefenseSkilling']['Target']['count'],'DefenseSkilling-YearWise-Target',colors1[0]],
                    ['Defense Course',skilling_array['DefenseCourse']['Target']['count'],'DefenseCourse-YearWise-Target',colors1[0]],

                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Defense Skilling',skilling_array['DefenseSkilling']['Achieve']['count'],'DefenseSkilling-YearWise-Achieved',colors1[1]],
                    ['Defense Course',skilling_array['DefenseCourse']['Achieve']['count'],'DefenseCourse-YearWise-Achieved',colors1[1]],
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
