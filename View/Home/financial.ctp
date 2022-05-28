<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       <?= $title ?>
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#"> <?= $title ?></a></li>
        <li class="breadcrumb-item active">Financial Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-4 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('Financial',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>$action)));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

                        <div class="form-group ">
                            <label for="example-text-input" class=" col-form-label">Phase<span class="text-danger">*</span></label>

                            <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>

                        </div>
						<div class="form-group ">
							<label for="example-text-input" class="col-form-label">Fund Received (INR) <span class="text-danger">*</span></label>

								<?php echo $this->Form->input("approved_amount",array("type"=>"text","class"=>"form-control isDecimalNumber approved","required","label"=>false,"placeholder"=>"Fund Received (INR)"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Financial']['id']));?>

						</div>

						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Amount Utilized (INR)<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("amount_utilized",array("type"=>"text","class"=>"form-control isDecimalNumber utilized","required","label"=>false,"placeholder"=>"Amount Utilized (INR)"))?>

						</div>
						
						<div class="form-group ">
							<label for="example-text-input" class=" col-form-label">Funding Year<span class="text-danger">*</span></label>

								<?php echo $this->Form->input("financial_year_id",array("type"=>"select","empty"=>"Select Funding Year","options"=>$financialYear,"required","class"=>"form-control","label"=>false,"placeholder"=>"Funding Year"))?>

						</div>
						
						<div class="form-group ">
                            <?php
                                $doc_req = 'required';
                                if($this->request->data['Financial']['upload_uc'] !='') $doc_req = '';
                            ?>
							<label for="example-text-input" class=" col-form-label">Upload Utilization Certificate<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("upload_uc",array("type"=>"file",$doc_req,"class"=>"form-control","label"=>false));
                                 echo $this->Form->input('upload_uc_old',array("type"=>"hidden","label"=>false,"value"=>$this->request->data['Financial']['upload_uc']));?>
                            <span class="text-danger"><?= $this->request->data['Financial']['upload_uc'] ?></span>
						</div>
						
						<div class="form-group ">
                            <?php
                                $doc_req = 'required';
                                if($this->request->data['Financial']['upload_bs'] !='') $doc_req = '';
                            ?>
							<label for="example-text-input" class=" col-form-label">Upload Bank Statement<span class="text-danger">*</span></label>
								<?php echo $this->Form->input("upload_bs",array("type"=>"file",$doc_req,"class"=>"form-control","label"=>false));
								 echo $this->Form->input('upload_bs_old',array("type"=>"hidden","label"=>false,"value"=>$this->request->data['Financial']['upload_bs']));?>
                            <span class="text-danger"><?= $this->request->data['Financial']['upload_bs'] ?></span>
						</div>
                        <div class="form-group ">
                            <label for="example-text-input" class="col-form-label">Opening Balance (INR) <span class="text-danger">*</span></label>
                            <?php echo $this->Form->input("opening_balance",array("type"=>"text","class"=>"form-control isDecimalNumber approved","required","label"=>false,"placeholder"=>"Opening Balance (INR)"))?>

                        </div>
                        <div class="form-group ">
                            <label for="example-text-input" class="col-form-label">Expenses Type <span class="text-danger">*</span></label>
                            <?php echo $this->Form->input("expenses_type", array("type" => "select", "empty" => "Select Expense Type", "options" => array('CAPEX' => 'CAPEX', 'OPEX' => 'OPEX'), "required", "class" => "form-control", "label" => false)) ?>

                        </div>
                        <div class="form-group ">
                            <label for="example-text-input" class="col-form-label">Remarks </label>
                            <?php echo $this->Form->input("remarks",array("type"=>"textarea",""=>3,"class"=>"form-control","required","label"=>false,"placeholder"=>"Remarks"))?>

                        </div>
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['Financial']['id']))
                                {
                                    echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                }
                                else
                                {
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

		<div class="col-lg-8 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							<th>Fund Received</th>
							<th>Amount Utilized</th>
							<th>Amount Remaining</th>
							<th>Funding Year</th>
							<th>Uploaded UC</th>
							<th>Uploaded BS</th>
                            <th>Opening Bal</th>
							<th>Expenses Type</th>
							<th>Remarks</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $manage) {
									$id = $manage['Financial']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
                            <td><?php echo $manage['Financial']['phase'];?></td>
							<td><?php echo $manage['Financial']['approved_amount'];?></td>
							<td><?php echo $manage['Financial']['amount_utilized'];?></td>
                            <td><?= $manage['Financial']['approved_amount']-$manage['Financial']['amount_utilized'] ?></td>
							<td><?php echo $manage['FinancialYear']['year'];?></td>
							<td><?php if($manage['Financial']['upload_uc']!=""){?>
                                    <a href="<?php echo $this->webroot; ?>upload_uc/<?php echo $manage['Financial']['upload_uc'];?>" target="_blank">View</a>
                                <?php } ?>
                            </td>
                            <td><?php if($manage['Financial']['upload_bs']!=""){?>
                                    <a href="<?php echo $this->webroot; ?>upload_bs/<?php echo $manage['Financial']['upload_bs'];?>" target="_blank">View</a>
                                <?php } ?>
                            </td>
                            <td><?php echo $manage['Financial']['opening_balance'];?></td>
                            <td><?php echo $manage['Financial']['expenses_type'];?></td>
                            <td><?php echo $manage['Financial']['remarks'];?></td>
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
<?php echo $this->Form->create('Financial',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>$action)));
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


    $(elementTitle).addClass('active').parents('li').addClass('active')
</script>
