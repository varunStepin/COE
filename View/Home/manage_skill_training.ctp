<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Academia/Skill Training Program
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Aerospace and Defence</a></li>
        <li class="breadcrumb-item active">Academia/Skill Training Program</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-5 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<!--<div class="box-header with-border">
					<button class="btn btn-primary pull-right">View Notice List</button>
				</div>-->
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('ManageSkill',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"manageSkillTraining")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">No. of Institutions <span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("no_of_institutes",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"No. of Programs conducted"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['ManageSkill']['id']));?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Training Program Name<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("training_program_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Program Name"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Duration<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("duration",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Duration"))?>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("date",array("type"=>"text","class"=>"form-control", "id"=>"datepicker","required","label"=>false,"placeholder"=>"date"))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Venue<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("venue",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Venue"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Year<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php 
									echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Month<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php 
										echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?>
							</div>
						</div>
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['ManageSkill']['id']))
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

		<div class="col-lg-7 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>No. of Institutions</th>
							<th>Training Program Name</th>
							<th>Duration</th>
							<th>Date</th>
							<th>Venue</th>
							<th>Year</th>
							<th>Month</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($manage_training_list)) {

								foreach ($manage_training_list as $list) {
									$id = $list['ManageSkill']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['ManageSkill']['no_of_institutes'];?></td>
							<td><?php echo $list['ManageSkill']['training_program_name'];?></td>
							<td><?php echo $list['ManageSkill']['duration'];?></td>
							<td><?php echo $list['ManageSkill']['date'];?></td>
							<td><?php echo $list['ManageSkill']['venue'];?></td>
							<td><?php echo $list['ManageSkill']['year'];?></td>
							<td><?php echo $list['ManageSkill']['month'];?></td>
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
<?php echo $this->Form->create('ManageSkill',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"manageSkillTraining")));
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

    $('.manageSkillTraining').addClass('active').parents('li').addClass('active');
</script>
