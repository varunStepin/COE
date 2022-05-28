<?= $this->element('cssJs/charts'); ?>
<style>.highcharts-credits{display: none}</style>
<div class="content-wrapper">
    <section class="content drillDown">
		<div class="row">
			<div class="col-md-12" align="center">
				<button type="button" class="btn btn-info">K-tech COE in A&D <?= $this->Session->read('Phase') ?></button>
			</div>
        </div>
        <div class="row mt-15">
            <div class="col-12 mb-20">
                <?php echo $this->Html->link('<span> Finance Dashboard <i class="fa fa-arrow-right"></i></span>',array("controller"=>"Dashboard","action"=>"financeDashboard","aerospaceFund"),array('class'=>'btn btn-primary ml-10 pull-right btn-sm',"escape"=>false));?>
                <?php echo $this->Html->link('<span><i class="fa fa-arrow-left"></i> Dashboard</span>',array("controller"=>"Admin","action"=>"dashboard"),array('class'=>'btn btn-info pull-right btn-sm',"escape"=>false));?>


            </div>
            <div class="col-6">
                <?php echo $this->element('Admin/Dashboard/aerospace/training'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Admin/Dashboard/aerospace/academia'); ?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Admin/Dashboard/aerospace/skilling');?>
            </div>
            <div class="col-6">
                <?php echo $this->element('Admin/Dashboard/aerospace/startup');?>
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
    $(function(){
        'use strict';
        $.fn.loadModalData=function(type,year,month){
            $('#chartDetailModalContent').load('aerospaceDashboard/'+type+'/'+year+'/'+month,function(){
                $('#chartDetailModal').modal({show:true});
            });
        }
    });
</script>
