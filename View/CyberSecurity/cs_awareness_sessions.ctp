<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Awareness Sessions For Government Departments
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i
					class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?>
			</li>
			<li class="breadcrumb-item"><a href="#">Cyber Security</a></li>
			<li class="breadcrumb-item active">Awareness Sessions For Government Departments</li>
		</ol>
	</section>

	<div class="p-10 mr-20">
		<?php echo $this->Html->link('<span> Add Participants </span>',array("controller"=>"CyberSecurity","action"=>"csAwarenessSessionParticipants"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
	</div>
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
								<?php 
                                echo $this->Form->create('CsAwarenessSession',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"CyberSecurity","action"=>"csAwarenessSessions")));
                                echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Phase<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
									</div>
								</div>

								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Department Name<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("department_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Department Name"))?>
										<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['CsAwarenessSession']['id']));?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Session Title<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("session_title",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Session Title"))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Trainer Name<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
                                        <?php echo $this->Form->input("trainer_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Trainer name"))?>
									</div>
								</div>

								<div class="form-group row displayNone">
									<label for="example-text-input" class="col-sm-4 col-form-label">Month-Year<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php 
									echo $this->Form->input("month",array("type"=>"text","value"=>date('F-Y'),"label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'MM-YYYY','required'));?>
									</div>
								</div>

								<div class="box-footer">
									<div class="clearfix pull-right">
										<?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
										<?php
                                if(empty($this->request->data['CsAwarenessSession']['id']))
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
							<table class="table example_long table-striped table-bordered table-hover">
								<thead style="font-size:15px; font-weight:bold;">
									<tr class="bg-info">
										<th>#</th>
										<th>Phase</th>
										<th>Department Name</th>
										<th>Trainer Names</th>
										<th>Session Title</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php 
							$i=1;
							if (!empty($table_list)) {

								foreach ($table_list as $list) {
									$id = $list['CsAwarenessSession']['id'];
						?>
									<tr>
										<td><?php echo $i++;?></td>
										<td><?php echo $list['CsAwarenessSession']['phase'];?></td>
										<td><?php echo $list['CsAwarenessSession']['department_name'];?></td>
										<td><?php echo $list['CsAwarenessSession']['trainer_name'];?></td>
										
										<td><?php echo $list['CsAwarenessSession']['session_title'];?></td>
										
										<td>
											<a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i
													style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
											<a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i
													style="font-size:12px;"
													class="glyphicon glyphicon-edit"></i></i></a>
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
<?php echo $this->Form->create('CsAwarenessSession',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"CyberSecurity","action"=>"csAwarenessSessions")));
		echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
		echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
		echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
		echo $this->Form->end();
		?>
<script>
	function addIdToForm(id, type) {
		$('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
		if (type == 'delete') {
			if (confirm('Are you sure you want to delete?') === false)
				return;
		}
		$('#fieldId').val(id)
		$('#actionType').val(type)
		$('#EditDeleteForm').submit();
	}

	$('.awarenessSessions').attr('class', 'active').parents('li').addClass('active')

</script>
