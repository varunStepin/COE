<?= $this->element('cssJs/charts'); ?>
<div class="content-wrapper">
    <section class="content drillDown">
        <div class="row mt-15">
            <div class="col-12 mb-20">
                 </div>
            <div class="col-12">
                <div class="box ">
                    <div class=" box-header with-border">
                        <h4 class="box-title text-info">Aerospace & Defence</h4>
                        <div class="pull-right">
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
        var colors1 = ['#33AFFF', '#FF5733'];

        var training_array=<?= json_encode($final_array) ?>;



        researchDrillDown = [];

        $.each(training_array,function(index, value){
            $.each(training_array[index],function(index1, value1){

                year=[];
                $.each(training_array[index]['Target']['Year'],function(index2, value2){
                    year.push(
                        [index2, value2, index+'-'+index2+'-Target']
                    );
                    researchDrillDown.push({
                        id: index+'-YearWise-Target',
                        name: index+'-YearWise-Target',
                        data: year,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(training_array[index]['Target'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index]);
                        researchDrillDown.push({
                            id: index+'-'+index2+'-Target',
                            name: index+'-'+index2+'-Target',
                            data: month,
                            keys: ['name', 'y', 'shName']
                        });
                    });
                });

                achieveYear=[];
                $.each(training_array[index]['Achieve']['Year'],function(index2, value2){
                    achieveYear.push(
                        [index2, value2, index+'-'+index2+'-Achieve']
                    );
                    researchDrillDown.push( {
                        id: index+'-YearWise-Achieve',
                        name: index+'-YearWise-Achieve',
                        data: achieveYear,
                        keys: ['name', 'y', 'drilldown']
                    });

                    month=[]
                    $.each(training_array[index]['Achieve'][index2],function(index5, value5){
                        month.push([index5, parseInt(value5), index,index2]);
                        researchDrillDown.push({
                            id: index+'-'+index2+'-Achieve',
                            name: index+'-'+index2+'-Achieve',
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
                /*options3d: {
                    enabled: true,
                    alpha: 5,
                    beta: -25,
                    depth: 50,
                    viewDistance: 50
                },*/
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
                                if(this.y >0 && this.year!='' && this.year>0){
                                    $(this).loadModalData(this.shName,this.year,this.name);
                                }
                            }
                        }
                    }
                },
            },
            series: [{
                name: 'Target',
                data: [
                    ['Training Program For Engineers',training_array['Training Program For Engineers']['Target']['count'],'Training Program For Engineers-YearWise-Target',colors1[1]],
                    ['Skill Training',training_array['Skill Training']['Target']['count'],'Skill Training-YearWise-Target',colors1[1]],
                    ['Training Program For Professionals',training_array['Training Program For Professionals']['Target']['count'],'Training Program For Professionals-YearWise-Target',colors1[1]],
                    ['Research Institute',training_array['Research Institute']['Target']['count'],'Research Institute-YearWise-Target',colors1[1]],
                    ['Research Industry',training_array['Research Industry']['Target']['count'],'Research Industry-YearWise-Target',colors1[1]],
                    ['Aerospace & Defense',training_array['Aerospace & Defense']['Target']['count'],'Aerospace & Defense-YearWise-Target',colors1[1]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[1]
            }, {
                name: 'Achieve',
                data: [
                    ['Training Program For Engineers',training_array['Training Program For Engineers']['Achieve']['count'],'Training Program For Engineers-YearWise-Achieve',colors1[0]],
                    ['Skill Training',training_array['Skill Training']['Achieve']['count'],'Skill Training-YearWise-Achieve',colors1[0]],
                    ['Training Program For Professionals',training_array['Training Program For Professionals']['Achieve']['count'],'Training Program For Professionals-YearWise-Achieve',colors1[0]],
                    ['Research Institute',training_array['Research Institute']['Achieve']['count'],'Research Institute-YearWise-Achieve',colors1[0]],
                    ['Research Industry',training_array['Research Industry']['Achieve']['count'],'Research Industry-YearWise-Achieve',colors1[0]],
                    ['Aerospace & Defense',training_array['Aerospace & Defense']['Achieve']['count'],'Aerospace & Defense-YearWise-Achieve',colors1[0]],
                ],
                keys: ['name', 'y', 'drilldown','color'],
                color:colors1[0]
            }],
            drilldown: {
                allowPointDrilldown: false,
                series:researchDrillDown
            }
        });

    });
</script>
<script>
    $(function(){
       'use strict';
       $.fn.loadModalData=function(type,year,month){ //alert(type);
           $('#chartDetailModalContent').load('aerospaceDashboard/'+encodeURIComponent(type)+'/'+year+'/'+month,function(){
               $('#chartDetailModal').modal({show:true});
           });
       }
    });
</script>
