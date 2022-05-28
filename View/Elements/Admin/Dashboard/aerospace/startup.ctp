<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Startup Facilitation </h4>
    </div>
    <div class="box-body">
        <div id="startup_facilitation" style="height: 400px;"></div>
    </div>
</div>
<script>
    $(function () {

       var startup_array = <?= json_encode($StartupFacilitation) ?>;
       graph_data = [];
       colors = ['#ce6a96', '#50b8dd', '#8add67', '#7f79dd', '#ddbc00', '#dd5144'];
       i=0;
        $.each(startup_array, function (index, value) {
            graph_data.push(
                [index, parseInt(value['count']),value['id'],colors[i++]]
            );
            if(i>5){
                i==0;
            }
        });

        //console.log(graph_data);
        Highcharts.chart('startup_facilitation', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: 35,
                    depth: 50,
                    viewDistance: 150
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
                    text: 'No. of startups felicitated'
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
                                $(this).loadModalData('StartupFacilitation',this.stName,'All');
                            }
                        }
                    }
                }
            },
            series: [{
                name: 'Startup Facilitation Companies',
                data: graph_data,
                keys: ['name','y','stName','color'],
            }]

        });

    });
</script>
