<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Enterprise Solutions</h4>
    </div>
    <div class="box-body">
        <div id="enterprise_solutions" style="height: 400px;"></div>
    </div>
</div>




<script>
    $(function () {
        var colors1 = [ '#063a98','#a96705'];

        var enterprise_array=<?= json_encode($social_array) ?>;


        enterpriseDrillDown = [];

        $.each(enterprise_array,function(index, value){
            $.each(enterprise_array[index],function(index1, value1){

                year=[];
                $.each(enterprise_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    enterpriseDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    // $.each(enterprise_array[index]['Target'][index2],function(index5, value5){
                    //     month.push([index5, parseInt(value5), index]);
                    //     enterpriseDrillDown.push({
                    //         id: index+'-'+index2+'-Target',
                    //         name: index+'-'+index2+'-Target',
                    //         data: month,
                    //         keys: ['name', 'y', 'shName']
                    //     });
                    // });
                });

                achieveYear=[];
                $.each(enterprise_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    enterpriseDrillDown.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(enterprise_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        enterpriseDrillDown.push({
                            id: index+'-'+index2+'-Achieved',
                            name: index+'-'+index2+'-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });




        Highcharts.chart('enterprise_solutions', {
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
                    text: 'No of Enterprise Solutions Adopted'
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
                    ['Enterprise Solutions Adopted',enterprise_array['EnterpriseSolutionsAdopted']['Target']['count'],'EnterpriseSolutionsAdopted-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Enterprise Solutions Adopted',enterprise_array['EnterpriseSolutionsAdopted']['Achieve']['count'],'EnterpriseSolutionsAdopted-YearWise-Achieved',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series:enterpriseDrillDown
            }
        });

    });
</script>
