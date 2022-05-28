<style>
    .highcharts-credits{
        display: none;
    }
</style>

<div class="box ">
    <div class=" box-header with-border">
        <h4 class="box-title text-info">Fund ...</h4>
        <ul class="box-controls pull-right">

            <li><a class="box-btn-slide" href="#"></a></li>

        </ul>
    </div>
    <div class="box-body">
        <div id="g6" style="height: 400px;"></div>
    </div>
    <!-- /.box-body -->
</div>




<script>
    $(function () {


        var colors = ['#e2431e', '#e7711b','#f1ca3a','#6f9654','#1c91c0','#43459d','#a61d4c','#66aa00'];



      

        Highcharts.chart('g6', {
            chart: {
                type: 'column',
                options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -25,
                    depth: 50,
                    viewDistance: 50
                }
            },
            title: {
                text: ''
            },
            subtitle: {
                text: ''
            },

            xAxis: {
                categories: ['Apples', 'Oranges', 'Pears', 'Grapes', 'Bananas'],
                labels: {
                    skew3d: true,
                    style: {
                        fontSize: '16px'
                    }
                }
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Number of fruits',
                    skew3d: true
                }
            },

            tooltip: {
                headerFormat: '<b>{point.key}</b><br>',
                pointFormat: '<span style="color:{series.color}">\u25CF</span> {series.name}: {point.y} / {point.stackTotal}'
            },

            plotOptions: {
                column: {
                    stacking: 'normal',
                    depth: 40
                }
            },

            series: [{
                name: 'Target',
                color:colors[2],
                data: [5, 3, 4, 7, 2],
                stack: 'targer'
            },{
                name: 'Achieved',
                color:colors[5],
                data: [3, 0, 4, 4, 3],
                stack: 'achieved'
            }]
        });

    });
</script>
