<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Mi & Robotics</h4>
    </div>
    <div class="box-body">
        <div id="research_project" style="height: 400px;"></div>
    </div>
    <!-- /.box-body -->
</div>




<script>
    $(function () {
      var colors1 = ['#fb6f92', '#DA07FB'];

        var mi_array=<?= json_encode($mi_array) ?>;


        researchDrillDown = [];

        $.each(mi_array,function(index, value){
            $.each(mi_array[index],function(index1, value1){

                year=[];
                $.each(mi_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    researchDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });


                });

                achieveYear=[];
                $.each(mi_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    researchDrillDown.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[];
                    $.each(mi_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        researchDrillDown.push({
                            id: index+'-'+index2+'-Achieved',
                            name: index+'-'+index2+'-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });



        Highcharts.chart('research_project', {
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
                        text: 'No of Programs/Conferences/Trainings',
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
            series: [
                {
                name: 'Target',
                data: [
                    ['CapacityBuilding',mi_array['CapacityBuilding']['Target']['count'],'CapacityBuilding-YearWise-Target',colors1[0]],
                    ['InternationalConferences',mi_array['InternationalConferences']['Target']['count'],'InternationalConferences-YearWise-Target',colors1[0]],
                    ['StartupConferences',mi_array['StartupConferences']['Target']['count'],'StartupConferences-YearWise-Target',colors1[0]],
                    ['GovtOfficialTraining',mi_array['GovtOfficialTraining']['Target']['count'],'GovtOfficialTraining-YearWise-Target',colors1[0]],
                    ['StudentEnrollment',mi_array['StudentEnrollment']['Target']['count'],'StudentEnrollment-YearWise-Target',colors1[0]],
                    ['Patent',mi_array['Patent']['Target']['count'],'Patent-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
                },
                {
                name: 'Achieved',
                data: [
                    ['CapacityBuilding',mi_array['CapacityBuilding']['Achieve']['count'],'CapacityBuilding-YearWise-Achieved',colors1[1]],
                    ['InternationalConferences',mi_array['InternationalConferences']['Achieve']['count'],'InternationalConferences-YearWise-Achieved',colors1[1]],
                    ['StartupConferences',mi_array['StartupConferences']['Achieve']['count'],'StartupConferences-YearWise-Achieved',colors1[1]],
                    ['GovtOfficialTraining',mi_array['GovtOfficialTraining']['Achieve']['count'],'GovtOfficialTraining-YearWise-Achieved',colors1[1]],
                    ['StudentEnrollment',mi_array['StudentEnrollment']['Achieve']['count'],'StudentEnrollment-YearWise-Achieved',colors1[1]],
                    ['Patent',mi_array['Patent']['Achieve']['count'],'Patent-YearWise-Achieved',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series:researchDrillDown
            }
        });

    });
</script>
