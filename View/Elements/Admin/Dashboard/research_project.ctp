<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Research Projects</h4>
    </div>
    <div class="box-body">
        <div id="research_project" style="height: 400px;"></div>
    </div>
    <!-- /.box-body -->
</div>




<script>
    $(function () {
        var colors1 = ['#36b0ea','#a61d4c'];

        var research_array=<?= json_encode($research_array) ?>;


        researchDrillDown = [];

        $.each(research_array,function(index, value){
            $.each(research_array[index],function(index1, value1){

                year=[];
                $.each(research_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    researchDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                /*    month=[]
                    $.each(research_array[index]['Target'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index]);
                        researchDrillDown.push({
                            id: index+'-'+index2+'-Target',
                            name: index+'-'+index2+'-Target',
                            data: month,
                            keys: ['name', 'y', 'shName']
                        });
                    });*/
                });

                achieveYear=[];
                $.each(research_array[index]['Achieve']['Year'],function(index2, value2){
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
                    $.each(research_array[index]['Achieve'][index2],function(index5, value5){
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
                    text: 'No of Reports Published'
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
                    ['ReportPublished',research_array['ReportPublished']['Target']['count'],'ReportPublished-YearWise-Target',colors1[0]],
                    ['ReportProcess',research_array['ReportProcess']['Target']['count'],'ReportProcess-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['ReportPublished',research_array['ReportPublished']['Achieve']['count'],'ReportPublished-YearWise-Achieved',colors1[1]],
                    ['ReportProcess',research_array['ReportProcess']['Achieve']['count'],'ReportProcess-YearWise-Achieved',colors1[1]],
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
