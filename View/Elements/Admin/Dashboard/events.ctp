<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Events</h4>
    </div>
    <div class="box-body">
        <div id="ds_events" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {


        drillDownData = [];

        var events_array=<?= json_encode($events_array) ?>;

        $.each(events_array,function(index, value){

            $.each(events_array[index],function(index1, value1){

                year=[];
                $.each(events_array[index]['Events']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Events']
                    );
                    drillDownData.push({
                        id: index+'-YearWise-Events',
                        name: index+'-YearWise-Events',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(events_array[index]['Events'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index]);
                        drillDownData.push({
                            id: index+'-'+index2+'- Events',
                            name: index+'-'+index2+'- Events',
                            data: month,
                            keys: ['name', 'y', 'shName']
                        });
                    });
                });

                achieveYear=[];
                $.each(events_array[index]['Events']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Events']
                    );
                    drillDownData.push( {
                        id: index+'-YearWise-Events',
                        name: index+'-YearWise-Events',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(events_array[index]['Events'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        drillDownData.push({
                            id: index+'-'+index2+'-Events',
                            name: index+'-'+index2+'-Events',
                            data: month,
                            keys: ['name', 'y', 'shName','year']
                        });
                    });
                });
            });
        });

        var colors1 = [ '#068b9c', '#427104'];


        Highcharts.chart('ds_events', {
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
                    min: 0,
                    title: {
                        text: 'No. of Events'
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
                name: 'Events',
                data: [
                    ['MasterClass',events_array['MasterClass']['Events']['count'],'MasterClass-YearWise-Events',colors1[1]],
                    ['AiPathshala',events_array['AiPathshala']['Events']['count'],'AiPathshala-YearWise-Events',colors1[1]],
                    ['TechMentoring',events_array['TechMentoring']['Events']['count'],'TechMentoring-YearWise-Events',colors1[1]],
                    ['Hackathon',events_array['Hackathon']['Events']['count'],'Hackathon-YearWise-Events',colors1[1]],
					['InvestorConnect',events_array['InvestorConnect']['Events']['count'],'InvestorConnect-YearWise-Events',colors1[1]],
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
