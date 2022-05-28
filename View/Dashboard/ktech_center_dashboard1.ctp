<?= $this->element('cssJs/charts'); ?>
<div class="content-wrapper">
    <section class="content drillDown">
		<div class="row">
			<div class="col-md-12" align="center">
				<button type="button" class="btn btn-info">K-tech COE by C-Camp</button>
			</div>
        </div>
        <div class="row mt-15">
            <div class="col-12 mb-20"></div>
            <div class="col-12">
                <div class="box ">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">K-tech COE by C-Camp</h4>
                        <div class="pull-right">
                            <?php echo $this->Html->link('<span> Finance Dashboard <i class="fa fa-arrow-right"></i></span>',array("controller"=>"Dashboard","action"=>"financeDashboard","ktechCenterFund"),array('class'=>'btn btn-primary ml-10 pull-right btn-sm',"escape"=>false));?>
                            <?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>',array("controller"=>"Admin","action"=>"dashboard"),array('class'=>'btn btn-info pull-right btn-sm',"escape"=>false));?>
                        </div>
                    </div>
                    <div class="box-body">
                        <div id="research_project" style="height: 400px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--model pop Up-->
    <div class="modal center-modal fade" id="chartDetailModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="chartDetailModalContent">

            </div>
        </div>
    </div>
</div>


<script>
    $(function () {
        var colors1 = ['#993300','#07FB67'];

        var final_array=<?= json_encode($final_array,true) ?>;





        var seriesData=[]; var c=0;var drillDownData=[];
        $.each(final_array,function(index,value){  //Target Or Achieve
            if(index=='Target')
                var colour=colors1[0];
            else
                var colour=colors1[1];

            var yearData=[];
            $.each(final_array[index]['Year'],function(index1,value1){ //Year Wise Count of Target & Achieve

                yearData.push([index1,value1,index1+'-'+index,colour]);
                c++;

                var monthData=[];
                $.each(final_array[index][index1],function(month,count) { //Year Wise Months inside

                    monthData.push([month,parseInt(count),parseInt(index1),index])
                });
                drillDownData.push({
                    id: index1+'-'+index,
                    name: index1+'-'+index,
                    data: monthData,
                    keys: ['name', 'y', 'shName','type']
                });
            });
            seriesData.push({
                name:index,
                data:yearData,
                keys: ['name', 'y', 'drilldown','color'],
                color:colour
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
                    text: 'Values'
                }
            },
            credits: {
                enabled: false
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
                                if(this.shName!='' && this.shName>0 && this.type=='Achieved'){
                                    $(this).loadModalData(this.shName,this.name);
                                }
                            }
                        }
                    }
                }
            },
            series: seriesData,
            drilldown: {
                allowPointDrilldown: false,
                series:drillDownData
            }
        });

    });
</script>
<script>
    $(function(){
       'use strict';
       $.fn.loadModalData=function(year,month){  //alert(type);
           $('#chartDetailModalContent').load('ktechCenterDashboard/'+year+'/'+month,function(){
               $('#chartDetailModal').modal({show:true});
           });
       }
    });
</script>
