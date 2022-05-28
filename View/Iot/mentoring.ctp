<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Mentoring
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
			<li class="breadcrumb-item active">Mentoring</li>
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
								<?php echo $this->Form->create('IotMentoring', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Iot", "action" => "mentoring")));
								echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded",));
								echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
									echo $this->Form->input('image', array("type" => "hidden", "label" => false)); ?>
								
								<div class="form-group ">
							        <label for="example-text-input" class=" col-form-label">Phase<span class="text-danger">*</span></label>
							        <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
						        </div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Date of Mentoring <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("date", array("type" => "text",  "label" => false, "id" => "datepicker", "class" => "form-control", 'placeholder' => 'EX: DD-MM-YYYY', 'required')); ?>
									<?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control")); ?>
								</div>
								<div class="form-group ">
									<label for="example-text-input" class="col-form-label">Duration <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("time", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Hour:Minutes")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Official Email of the
										Mentee<span class="text-danger">*</span></label>
									<?php echo $this->Form->input("email", array("type" => "email", "class" => "form-control", "required", "label" => false, "placeholder" => "Official Email of the Mentee")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Topic<span class="text-danger">*</span></label>
									<?php echo $this->Form->input("topic", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Topic")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Name/Email of the
										Mentor<span class="text-danger">*</span></label>
									<?php echo $this->Form->input("name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Name/Email of the Mentor")) ?>
								</div>

								<div class="form-group">
									<label>Image of the session</label>
									<?php echo $this->Form->input("image_file", array("type" => "file","class" => "form-control image_type", "label" => false)); ?>
									<?php if ($this->request->data['IotMentoring']['image'] != '') {
										echo '<a class="text-danger" target="_blank" href="' . $this->webroot . $this->request->data['IotMentoring']['image'] . '">Uploaded</a>';
									} ?>
								</div>

								<div class="box-footer">
									<div class="clearfix pull-right">
										<?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
										<?php
										if (empty($this->request->data['IotMentoring']['id'])) {
											echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
										} else {
											echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
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
							<table class="table example_long table-striped table-bordered table-hover">
								<thead style="font-size:15px; font-weight:bold;">
									<tr class="bg-info">
										<th>#</th>
										<th>Phase</th>
										<th>Date</th>
										<th>Duration </th>
										<th>Email of the Mentee</th>
										<th>Topic</th>
										<th>Mentor Name/Email</th>
										<th>Image</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($manage_list)) {

										foreach ($manage_list as $manage) {
											$id = $manage['IotMentoring']['id'];
									?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $manage['IotMentoring']['phase']; ?></td>
												<td><?php $date1 = $manage['IotMentoring']['date'];
													echo ($date1) ? date('d-m-Y', strtotime($date1)) : '';
													?></td>
												<td><?php echo $manage['IotMentoring']['time']; ?></td>
												<td><?php echo $manage['IotMentoring']['email']; ?></td>
												<td><?php echo $manage['IotMentoring']['topic']; ?></td>
												<td><?php echo $manage['IotMentoring']['name']; ?></td>
												<td><?php if ($manage['IotMentoring']['image'] != '') {
														echo '<a class="text-danger" target="_blank" href="' . $this->webroot . $manage['IotMentoring']['image'] . '">Uploaded <i style="font-size:12px;" class="glyphicon glyphicon-eye"></a>';
													} ?>
												</td>
												<td>
													<a href="#" onclick="addIdToForm(<?php echo $id ?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
													<a href="#" onclick="addIdToForm(<?php echo $id ?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
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
<?php echo $this->Form->create('IotMentoring', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Iot", "action" => "occupancy")));
echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftokenEdit', "label" => false, 'required', 'value' => ' '));
echo $this->Form->input('id', array("type" => "hidden", "label" => false, 'required', "id" => "fieldId"));
echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "id" => "actionType"));
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
</script>
<script>
	$('.IotMentoring').addClass('active').parents('li').addClass('active')
</script>
