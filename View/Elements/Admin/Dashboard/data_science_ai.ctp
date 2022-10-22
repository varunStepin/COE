<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Data Science and Artificial Intelligence </h4>
    </div>
    <div class="box-body">
        <div id="data_science_ai" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {


        drillDownData = [];

        var artificial_array=<?= json_encode($artificial_array) ?>;

        $.each(artificial_array,function(index, value){

            $.each(artificial_array[index],function(index1, value1){

                year=[];
                $.each(artificial_array[index]['Target']['Year'],function(index2, value2){
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
                $.each(artificial_array[index]['Achieve']['Year'],function(index2, value2){
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
                    $.each(artificial_array[index]['Achieve'][index2],function(index5, value5){
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

        var colors1 = [ '#068b9c', '#427104'];


        Highcharts.chart('data_science_ai', {
            chart: {
                type: 'column',
               options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -25,
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
                    text: 'Resources Trained In Data Science & Artificial Intelligence'
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
                    ['Student Trained',artificial_array['StudentTrained']['Target']['count'],'StudentTrained-YearWise-Target',colors1[0]],
                    ['Faculty Trained',artificial_array['FacultyTrained']['Target']['count'],'FacultyTrained-YearWise-Target',colors1[0]],
                    ['Professional Trained',artificial_array['ProfessionalTrained']['Target']['count'],'ProfessionalTrained-YearWise-Target',colors1[0]],

                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Student Trained',artificial_array['StudentTrained']['Achieve']['count'],'StudentTrained-YearWise-Achieved',colors1[1]],
                    ['Faculty Trained',artificial_array['FacultyTrained']['Achieve']['count'],'FacultyTrained-YearWise-Achieved',colors1[1]],
                    ['Professional Trained',artificial_array['ProfessionalTrained']['Achieve']['count'],'ProfessionalTrained-YearWise-Achieved',colors1[1]],

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
