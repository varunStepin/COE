<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
         Investor Connect
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Events</a></li>
        <li class="breadcrumb-item active">Investor Connect</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-5 col-12">
              <div class="p-5 box my-10">
                    <div>
                        <a href="<?php echo $this->webroot .'excel_dounload/ds_ai_investor_connect.xls'; ?>" target="_blank" class="btn btn-sm btn-outline-danger pull-right">Excel Download <i class="fa fa-download"></i> </a>
                        <a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5" id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

                        <div style="display: none;">
                            <?php
                            echo $this->Form->create('DsInvestorConnect',array("url"=>array("controller"=>"DsAndAi","action"=>"investorConnectImport"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                            echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                            echo $this->Form->end();
                            ?>
                        </div>
                    </div>
              </div>
              
			  <div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('DsInvestorConnect',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"DsAndAi","action"=>"investorConnect")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));

                        echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['DsInvestorConnect']['id']));?>

                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Phase <span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>

                            </div>
                        </div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("date",array("type"=>"text","autocomplete"=>"off", "id"=>"datepicker", "label"=>false,'class'=>"form-control ",'required','placeholder'=>'DD-MM-YYYY')); ?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Investor Name<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("investor_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Investor Name"))?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Startups participated<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("startup",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Startups"))?>
							</div>
						</div>
                        <div class="form-group row displayNone">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Month-Year<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php
                                echo $this->Form->input("month",array("type"=>"text","value"=>"Jan-2020","label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'MMM-YYYY','required'));?>
                            </div>
                        </div>
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['DsInvestorConnect']['id'])) {
                                    echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                }
                                else {
                                    echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
                                }
                                ?>

                            </div>
                        </div>
						<?php echo $this->Form->end(); ?>
					</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->			
		</div>	

		<div class="col-lg-7 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Date</th>
							<th>Investor Name</th>
							<th>Startups Participated</th>
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($table_list)) {
							    foreach ($table_list as $list) {
									$id = $list['DsInvestorConnect']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td class="text-nowrap"><?php echo $list['DsInvestorConnect']['phase'];?></td>
							<td class="text-nowrap"><?php echo $list['DsInvestorConnect']['date'];?></td>
							<td><?php echo $list['DsInvestorConnect']['investor_name'];?></td>
							<td><?php echo $list['DsInvestorConnect']['startup'];?></td>
							<!--<td><?php /*echo $list['DsInvestorConnect']['month'] .'-'.  $list['DsInvestorConnect']['year'];*/?></td>-->
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
							</td>
						</tr>
						<?php   }

                            } ?>
					</tbody>
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->   
		</div>
	  </div>
		

      <!-- /.row -->
      
    </section>
    <!-- /.content -->
  </div>
<?php echo $this->Form->create('DsInvestorConnect',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"DsAndAi","action"=>"investorConnect")));
		echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
		echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
		echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
		echo $this->Form->end();
		?>
<script>
   function addIdToForm(id,type){

       $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
       if(type=='delete'){
           if(confirm('Are you sure you want to delete?')===false)
               return;
       }
       $('#fieldId').val(id)
       $('#actionType').val(type)
       $('#EditDeleteForm').submit();


   }
</script>
<script>

    $('#bulkUpload').on('click',function () {
        $('#excel_file').click();
    });

    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
    
    $('.InvestorConnect').addClass('active').parents('li').addClass('active')
</script>
