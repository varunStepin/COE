<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">COE </h4>
        <ul class="box-controls pull-right">

            <li><a class="box-btn-slide" href="#"></a></li>

        </ul>
    </div>
    <div class="box-body">
        <div id="main_chart" style="height: 400px;"></div>
    </div>
    <!-- /.box-body -->
</div>




<script>
    $(function () {


        var colors = ['#e2431e', '#e7711b','#f1ca3a','#6f9654','#1c91c0','#43459d','#a61d4c','#66aa00'];





        Highcharts.chart('main_chart', {
            chart: {
                type: 'cylinder',
                options3d: {
                    enabled: true,
                    alpha: 15,
                    beta: -5,
                    depth: 50,
                    viewDistance: 100
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['Data science and  AI','Aerospace & Defense', 'Cyber Security',
                    'Animation, Visual Effects, Gaming &  Comics',
                     'KTECH Centre',
                    'IoT', 'ML & Robotics', 'Fabless',]
            },
            colors:colors,
            series: [{
                type: 'column',

                colorByPoint: true,
                data: [129.9, 71.5, 106.4, 29.2, 144.0, 176.0, 135.6, 148.5],
                showInLegend: false
            }],

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

                                       if(this.category=="Data science and  AI"){
                                           openDrillDown();
                                       }


                                }
                            }
                        }

                    }
            },



        });


    });
</script>
