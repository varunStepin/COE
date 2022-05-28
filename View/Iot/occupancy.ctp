<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Occupancy
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
			<li class="breadcrumb-item active">Occupancy</li>
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
								<?php echo $this->Form->create('IotOccupancy', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Iot", "action" => "occupancy")));
								echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
								echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert")); ?>

                                <div class="form-group ">
							        <label for="example-text-input" class=" col-form-label">Phase<span class="text-danger">*</span></label>
							        <?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
						        </div>

								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Month Year<span class="text-danger">*</span></label>
									<?php echo $this->Form->input("month_year", array("type" => "text",  "label" => false, "id" => "monthPicker", "class" => "form-control", 'placeholder' => 'EX: MM-YYYY', 'required')); ?>
									<?php echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control")); ?>
								</div>
								<div class="form-group ">
									<label for="example-text-input" class="col-form-label">Seats Occupied <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("seats_occupaid", array("type" => "text", "class" => "form-control isNumber", "required", "label" => false, "placeholder" => "Seats Occupied ")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Available Seats<span class="text-danger">*</span></label>
									<?php echo $this->Form->input("seats_available", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Available Seats")) ?>

								</div>
								<div class="box-footer">
									<div class="clearfix pull-right">
										<?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
										<?php
										if (empty($this->request->data['IotOccupancy']['id'])) {
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
										<th>Year-Month</th>
										<th>Seats Occupied </th>
										<th>Available Seats</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($manage_list)) {

										foreach ($manage_list as $manage) {
											$id = $manage['IotOccupancy']['id'];
									?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $manage['IotOccupancy']['phase']; ?></td>
												<td><?php echo $manage['IotOccupancy']['month'].' - '.$manage['IotOccupancy']['year']; ?></td>
												<td><?php echo $manage['IotOccupancy']['seats_occupaid']; ?></td>
												<td><?php echo $manage['IotOccupancy']['seats_available']; ?></td>


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
<?php echo $this->Form->create('IotOccupancy', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Iot", "action" => "occupancy")));
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
	$('.IotOccupancy').addClass('active').parents('li').addClass('active')
</script>
