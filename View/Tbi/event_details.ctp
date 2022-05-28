<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h2>
			<?= $details['TbiTitle'] ?>
		</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">TBI</a></li>
			<li class="breadcrumb-item active">Event Details</li>
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
								<?php echo $this->Form->create('TbiEventParticipant', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => $details['Controller'], "action" => "eventDetails")));
								echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
								echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
								?>

								<div class="form-group ">
									<label for="example-text-input" class="col-form-label">Name of the Event <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("tbi_event_id", array("type" => "select","options"=> $event_name_array, "class" => "form-control eventId", "required", "label" => false, "empty" => "Event Name")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Name of Participant <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("participant_name", array("type" => "text", "class" => "form-control ev_name", "required", "label" => false, "placeholder" => "Participant's name")) ?>

								</div>
								<div class="form-group ">
									<label for="example-text-input" class="col-form-label">Gender <span class="text-danger">*</span></label><br/>
									<?php echo $this->Form->radio("gender", array("Male" => "Male", "Female" => "Female", "Others" => "Others"), array('legend' => false, "required", "class" => "radio-inline ev_gender")) ?>

								</div>
                                <div class="form-group ">
									<label for="example-text-input" class=" col-form-label">Contact Number <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("contact_number", array("type" => "phone", "class" => "form-control ev_number", "maxlength" => 10,"required", "label" => false, "placeholder" => "Contact Number")) ?>

								</div>
                                <div class="form-group ">
									<label for="example-text-input" class=" col-form-label">E-mail <span class="text-danger">*</span></label>
									<?php echo $this->Form->input("email", array("type" => "email", "class" => "form-control ev_email", "required", "label" => false, "placeholder" => "E-mail id")) ?>

								</div>
								<div class="box-footer">
									<div class="clearfix pull-right">
                                        <?php echo $this->Form->button("Reset", array("type" => "reset", "class" => "_cancel btn btn-danger btn-sm", "label" => false)); ?>
                                        <?php
                                            if (empty($this->request->data['TbiEventParticipant']['id'])) {
                                                echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-success btn-sm", "label" => false));
                                            } else {
                                                echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-success btn-sm", "label" => false));
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
										<th>Event Name</th>
										<th>Participant's Name</th>
										<th>Gender</th>
                                        <th>Conatct Number</th>
                                        <th>E-mail</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									if (!empty($manage_list)) {

										foreach ($manage_list as $manage) {
											$id = $manage['TbiEventParticipant']['id'];
									?>
											<tr>
												<td><?php echo $i++; ?></td>
												<td><?php echo $manage['TbiEvent']['event_name'] ?></td>
												<td><?php echo $manage['TbiEventParticipant']['participant_name']; ?></td>
												<td><?php echo $manage['TbiEventParticipant']['gender']; ?></td>
                                                <td><?php echo $manage['TbiEventParticipant']['contact_number']; ?></td>
                                                <td><?php echo $manage['TbiEventParticipant']['email']; ?></td>
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
<?php echo $this->Form->create('TbiEventParticipant', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => $details['Controller'], "action" => "eventDetails")));
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
	// $('.eventId').on('change',function(){
	// 		let id= $(this).val()
	// 		// let details=JSON.parse('<?php //echo json_encode($StartUpsDetails);?>')
	// 		// console.log(details)
	// 		// $('.ev_name').val(details[id]['event_name'])
	// 		// $('.st_type').val(details[id]['startup_type'])
	// });
</script>
<script>
	var conrtoller='.<?=  $details['Controller'] ?>eventDetails'
	$(conrtoller).addClass('active').parents('li').addClass('active')
</script>
