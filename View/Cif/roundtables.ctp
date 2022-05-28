<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Event
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
			<li class="breadcrumb-item"><a href="#">CIF</a></li>
			<li class="breadcrumb-item active">Events</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-lg-5 col-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<?php echo $this->Session->flash(); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<?php echo $this->Form->create('CifRoundtable', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => "Cif", "action" => "roundtables")));
								echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
								echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
								echo $this->Form->input("id", array("type" => "hidden", "label" => false, 'class' => "form-control", "value" => $this->request->data['CifRoundtable']['id'])); ?>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Phase <span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php
										  echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Year <span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php
										echo $this->Form->input("year", array("type" => "select", "label" => false, "options" => $years_list, "class" => "form-control", 'empty' => 'Select', 'required', 'default' => Date('Y'))); ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Event Type<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php $options = ["Conference" => "Conference", "Round Table" => "Round Table", "Hackathon" => "Hackathon"];
										echo $this->Form->input("event_type", array("type" => "select", "class" => "form-control", "required", "label" => false, "placeholder" => "Startups", "options" => $options, 'empty' => 'Select')) ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Event Name<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("name", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Event Name")) ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Date<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("date", array("type" => "text", "autocomplete" => "off", "id" => "datepicker", "label" => false, 'class' => "form-control ", 'required', 'placeholder' => 'DD-MM-YYYY')); ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Speakers<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("speaker", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "Speakers")) ?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Total No of Participants<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("no_participant", array("type" => "text", "class" => "form-control", "required", "label" => false, "placeholder" => "No of Participants")) ?>
									</div>
								</div>
								<div class="form-group row displayNone">
									<label for="example-text-input" class="col-sm-4 col-form-label">Month-Year<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("month", array("type" => "text", "value" => "Jan-2020", "label" => false, "id" => "monthPicker", "class" => "form-control", 'placeholder' => 'MMM-YYYY', 'required')); ?>
									</div>
								</div>
								<div class="box-footer">
									<div class="clearfix pull-right">
										<?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "btn cancel btn-sm", "label" => false)); ?>
										<?php
										if (empty($this->request->data['CifRoundtable']['id'])) {
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
										<th>Year</th>
										<th>Event Type</th>
										<th>Event Name</th>
										<th>Date</th>
										<th>Speakers</th>
										<th>Total No of Participants</th>
										<!--<th>Month-Year</th>-->
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$i = 1;
									if (!empty($table_list)) {
										foreach ($table_list as $list) {
											$id = $list['CifRoundtable']['id'];
									?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $list['CifRoundtable']['phase']; ?></td>
												<td><?php echo $list['CifRoundtable']['year']; ?></td>
												<td><?php echo $list['CifRoundtable']['event_type']; ?></td>
												<td><?php echo $list['CifRoundtable']['name']; ?></td>
												<td class="text-nowrap"><?php echo date('d-m-Y', strtotime($list['CifRoundtable']['date'])); ?></td>
												<td><?php echo $list['CifRoundtable']['speaker']; ?></td>
												<td><?php echo $list['CifRoundtable']['no_participant']; ?></td>
												<!--<td><?php /*echo $list['DsHackathon']['month'] .'-'.  $list['DsHackathon']['year'];*/ ?></td>-->
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
<?php echo $this->Form->create('CifRoundtable', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => "Cif", "action" => "roundtables")));
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
	$('.roundtables').addClass('active').parents('li').addClass('active')
</script>