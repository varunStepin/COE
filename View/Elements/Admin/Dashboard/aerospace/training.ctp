<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Training </h4>
    </div>
    <div class="box-body">
        <div id="training" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {
        var colors1 = ['#FF5733','#33AFFF'];

        drillDownData = [];

        var training_array=<?= json_encode($training_array) ?>;
        $.each(training_array,function(index, value){

            $.each(training_array[index],function(index1, value1){

                year=[];
                $.each(training_array[index]['Target']['Year'],function(index2, value2){
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
                $.each(training_array[index]['Achieve']['Year'],function(index2, value2){
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
                    $.each(training_array[index]['Achieve'][index2],function(index5, value5){
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



        Highcharts.chart('training', {
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
                    text: 'No. of Internship/Project based courses'
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
                    ['Internship / Foundation Course',training_array['Internship']['Target']['count'],'Internship-YearWise-Target',colors1[0]],
                    ['Advance / Project Based Course',training_array['AdvanceCourse']['Target']['count'],'AdvanceCourse-YearWise-Target',colors1[0]],
                    ['Orientation / Awareness Course',training_array['OrientationCourse']['Target']['count'],'OrientationCourse-YearWise-Target',colors1[0]],
                    ['Starter Course',training_array['StarterCourse']['Target']['count'],'StarterCourse-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Internship / Foundation Course',training_array['Internship']['Achieve']['count'],'Internship-YearWise-Achieved',colors1[1]],
                    ['Advance / Project Based Course',training_array['AdvanceCourse']['Achieve']['count'],'AdvanceCourse-YearWise-Achieved',colors1[1]],
                    ['Orientation / Awareness Course',training_array['OrientationCourse']['Achieve']['count'],'OrientationCourse-YearWise-Achieved',colors1[1]],
                    ['Starter Course',training_array['StarterCourse']['Achieve']['count'],'StarterCourse-YearWise-Achieved',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series: drillDownData
            }
        });

       // console.log(drillDownData);
    });
</script>
