<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">IOT</h4>
    </div>
    <div class="box-body">
        <div id="research_project" style="height: 400px;"></div>
    </div>
    <!-- /.box-body -->
</div>
<style>
    .highcharts-credits{
        display: none !important;
    }
</style>



<script>
    $(function () {
          var colors1 = ['#346fc7', '#6e2ba5'];

        var iot_array=<?= json_encode($iot_array) ?>;


        researchDrillDown = [];

        $.each(iot_array,function(index, value){
            $.each(iot_array[index],function(index1, value1){

                year=[];
                $.each(iot_array[index]['Target']['Year'],function(index2, value2){
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
                $.each(iot_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    researchDrillDown.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(iot_array[index]['Achieve'][index2],function(index5, value5){
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
                    beta: -20,
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
                    text: 'No of Startups/Employment Generated/Intellectual properties'
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
                    ['IotStartUp',iot_array['IotStartUp']['Target']['count'],'IotStartUp-YearWise-Target',colors1[0]],
                    ['GeneratedEmployment',iot_array['GeneratedEmployment']['Target']['count'],'GeneratedEmployment-YearWise-Target',colors1[0]],
                    ['IotIntellectualProperty',iot_array['IotIntellectualProperty']['Target']['count'],'IotIntellectualProperty-YearWise-Target',colors1[0]],
                    ['IotStartupsRisedFund',iot_array['IotStartupsRisedFund']['Target']['count'],'IotStartupsRisedFund-YearWise-Target',colors1[0]],
                    ['IotEventWorkshop',iot_array['IotEventWorkshop']['Target']['count'],'IotEventWorkshop-YearWise-Target',colors1[0]],
                    ['IotIndustryConnected',iot_array['IotIndustryConnected']['Target']['count'],'IotIndustryConnected-YearWise-Target',colors1[0]],
                    ['IotAcademiaConnected',iot_array['IotAcademiaConnected']['Target']['count'],'IotAcademiaConnected-YearWise-Target',colors1[0]],
                    ['IotDelegation',iot_array['IotDelegation']['Target']['count'],'IotDelegation-YearWise-Target',colors1[0]],
                    ['IotPilotsProject',iot_array['IotPilotsProject']['Target']['count'],'IotPilotsProject-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
                },
                {
                name: 'Achieved',
                data: [
                    ['IotStartUp',iot_array['IotStartUp']['Achieve']['count'],'IotStartUp-YearWise-Achieved',colors1[1]],
                    ['GeneratedEmployment',iot_array['GeneratedEmployment']['Achieve']['count'],'GeneratedEmployment-YearWise-Achieved',colors1[1]],
                    ['IotIntellectualProperty',iot_array['IotIntellectualProperty']['Achieve']['count'],'IotIntellectualProperty-YearWise-Achieved',colors1[1]],
                    ['IotStartupsRisedFund',iot_array['IotStartupsRisedFund']['Achieve']['count'],'IotStartupsRisedFund-YearWise-Achieved',colors1[1]],
                    ['IotEventWorkshop',iot_array['IotEventWorkshop']['Achieve']['count'],'IotEventWorkshop-YearWise-Achieved',colors1[1]],
                    ['IotIndustryConnected',iot_array['IotIndustryConnected']['Achieve']['count'],'IotIndustryConnected-YearWise-Achieved',colors1[1]],
                    ['IotAcademiaConnected',iot_array['IotAcademiaConnected']['Achieve']['count'],'IotAcademiaConnected-YearWise-Achieved',colors1[1]],
                    ['IotDelegation',iot_array['IotDelegation']['Achieve']['count'],'IotDelegation-YearWise-Achieved',colors1[1]],
                    ['IotPilotsProject',iot_array['IotPilotsProject']['Achieve']['count'],'IotPilotsProject-YearWise-Achieved',colors1[1]],
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
