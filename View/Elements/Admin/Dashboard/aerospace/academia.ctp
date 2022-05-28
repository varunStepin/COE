<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Academia </h4>
    </div>
    <div class="box-body">
        <div id="academia" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {

        var colors1 = ['#4bcbb7', '#d9d133'];

        drillDownData = [];

        var academia_array=<?= json_encode($academia_array) ?>;
        $.each(academia_array,function(index, value){

            $.each(academia_array[index],function(index1, value1){

                year=[];
                $.each(academia_array[index]['Target']['Year'],function(index2, value2){
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
                $.each(academia_array[index]['Achieve']['Year'],function(index2, value2){
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
                    $.each(academia_array[index]['Achieve'][index2],function(index5, value5){
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

        Highcharts.chart('academia', {
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
                    text: 'No. of Embedded Courses/ Hackathons'
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
                    ['Embedded Course',academia_array['EmbeddedCourse']['Target']['count'],'EmbeddedCourse-YearWise-Target',colors1[0]],
                    ['Training in process',academia_array['TrainingProcess']['Target']['count'],'TrainingProcess-YearWise-Target',colors1[0]],
                    ['Boot Camp',academia_array['BootCamp']['Target']['count'],'BootCamp-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Embedded Course',academia_array['EmbeddedCourse']['Achieve']['count'],'EmbeddedCourse-YearWise-Achieved',colors1[1]],
                    ['Training in process',academia_array['TrainingProcess']['Achieve']['count'],'TrainingProcess-YearWise-Achieved',colors1[1]],
                    ['Boot Camp',academia_array['BootCamp']['Achieve']['count'],'BootCamp-YearWise-Achieved',colors1[1]],
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
