<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Societal Solutions</h4>
    </div>
    <div class="box-body">
        <div id="societal_solutions" style="height: 400px;"></div>
    </div>
</div>




<script>
    $(function () {
        var colors1 = [ '#063a98','#a96705'];

        var social_array=<?= json_encode($social_array) ?>;


        socialDrillDown = [];

        $.each(social_array,function(index, value){
            $.each(social_array[index],function(index1, value1){

                year=[];
                $.each(social_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    socialDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    // $.each(social_array[index]['Target'][index2],function(index5, value5){
                    //     month.push([index5, parseInt(value5), index]);
                    //     socialDrillDown.push({
                    //         id: index+'-'+index2+'-Target',
                    //         name: index+'-'+index2+'-Target',
                    //         data: month,
                    //         keys: ['name', 'y', 'shName']
                    //     });
                    // });
                });

                achieveYear=[];
                $.each(social_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieved']
                    );
                    socialDrillDown.push( {
                        id: index+'-YearWise-Achieved',
                        name: index+'-YearWise-Achieved',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(social_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        socialDrillDown.push({
                            id: index+'-'+index2+'-Achieved',
                            name: index+'-'+index2+'-Achieved',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });




        Highcharts.chart('societal_solutions', {
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
                    text: 'No of Solutions Supported/Dept Liasoning'
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
                    ['Solutions Supported',social_array['SolutionSupport']['Target']['count'],'SolutionSupport-YearWise-Target',colors1[0]],
                    ['Dept Liasoning',social_array['DeptLicense']['Target']['count'],'DeptLicense-YearWise-Target',colors1[0]],
                    ['Enterprise Solutions Adopted',social_array['EnterpriseSolutionsAdopted']['Target']['count'],'EnterpriseSolutionsAdopted-YearWise-Target',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }, {
                name: 'Achieved',
                data: [
                    ['Solutions Supported',social_array['SolutionSupport']['Achieve']['count'],'SolutionSupport-YearWise-Achieved',colors1[1]],
                    ['Dept Liasoning',social_array['DeptLicense']['Achieve']['count'],'DeptLicense-YearWise-Achieved',colors1[1]],
                    ['Enterprise Solutions Adopted',social_array['EnterpriseSolutionsAdopted']['Achieve']['count'],'EnterpriseSolutionsAdopted-YearWise-Achieved',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series:socialDrillDown
            }
        });

    });
</script>
