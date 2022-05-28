<!-- $('.input-daterange').datepicker({
    orientation: "bottom auto"
}); -->

<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- <style>
		.fileUpload {
			position: relative;
			overflow: hidden;
			margin: 10px;
		}
		.fileUpload input.upload {
			position: absolute;
			top: 0;
			right: 0;
			margin: 0;
			padding: 0;
			font-size: 20px;
			cursor: pointer;
			opacity: 0;
			filter: alpha(opacity=0);
		}
	</style> -->
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h2>
			<?= $details['TbiTitle'] ?>
		</h2>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">TBI</a></li>
			<li class="breadcrumb-item active">Innovations Commercialized</li>
		</ol>
	</section>
	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="offset-md-2 col-md-8">
				<div class="box box-info" style="background-color:#fff">
					<div class="box-header with-border"><b>Innovations Commercialized</b>
					</div>
					<?php echo $this->Form->create('TbiStartup', array("class" => "form-horizontal", "type" => "file", 'onsubmit' => "return addCsrfToken()"), array("url" => array("controller" => $details['Controller'], "action" => "innovationCommercialized")));
					echo $this->Form->input('csrf_token', array("type" => "hidden", 'id' => 'csrftoken', "label" => false, 'required', "class" => "form-control rounded", 'value' => ' '));
					echo $this->Form->input('type', array("type" => "hidden", "label" => false, 'required', "value" => "insert"));
					?>
					<div class="box-body">
						<div class="row">
							<div class="col-12">
								
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Non commercialized Startups<span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php if (empty($this->request->data['TbiStartup']['id'])) {
												echo $this->Form->input("id", array("type" => "select", "options" => $unselectedStartUps, "class" => "form-control startUpId", "required", "label" => false, "empty" => "Startup Name"));
											} else {
												echo $this->Form->input('id', array("type" => "hidden", "label" => false,));
												echo $this->Form->input("startup_name", array("type" => "text", "readonly", "class" => "form-control st_type", "required", "label" => false, "placeholder" => "Type of Startup"));
											}
											?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Details of team members<span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php echo $this->Form->input("details", array("type" => "textarea", "readonly", "rows" => 4, "class" => "form-control st_details", "required", "label" => false, "placeholder" => "Details")) ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Type of Startup <span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php echo $this->Form->input("startup_type", array("type" => "text", "readonly", "class" => "form-control st_type", "required", "label" => false, "placeholder" => "Type of Startup")) ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Current Status of Project <span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php echo $this->Form->input("status", array("type" => "text", "class" => "form-control st_status", "required", "label" => false, "placeholder" => "Status of Project")) ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Incubation Start date <span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php echo $this->Form->input("innovation_date", array("type" => "text", "id" => "datepicker", "class" => "form-control st_date", "required", "label" => false, "placeholder" => "Incubation start date")) ?>
										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="row">
										<div class="col-md-6">
											<label for="example-text-input" class="control-label">Outcome after Incubation <span class="text-danger">*</span></label>
										</div>
										<div class="col-md-6">
											<?php echo $this->Form->input("outcome", array("type" => "text", "class" => "form-control st_outcome", "required", "label" => false, "placeholder" => "Outcome of Startup")) ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="box-footer">
						<div class="clearfix pull-right mb-10">
							<?php
							if (empty($this->request->data['TbiStartup']['id'])) {
								echo $this->Form->button("Save", array("type" => "submit", "class" => "_save btn btn-danger btn-sm", "label" => false));
							} else {
								echo $this->Form->button("Update", array("type" => "submit", "class" => "_update btn btn-danger btn-sm", "label" => false));
							}
							?>
						</div>
					</div>
					<?php echo $this->Form->end(); ?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">&nbsp;</div>
			<div class="col-md-6"><?php echo $this->Session->flash(); ?></div>
			<div class="col-md-4">&nbsp;</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12">
					<div class="box">
						<div class="box-body">
							<div class="table-responsive">
								<table class="table example_long table-striped table-bordered table-hover">
									<thead style="font-size:15px; font-weight:bold;">
										<tr class="bg-info">
											<th>#</th>
											
											<th>Startup Name</th>
											<th>Details</th>
											<th>Startup Type</th>
											<th>Current Status</th>
											<th>Incubation Start Date</th>
											<th>Outcome</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$i = 1;
										if (!empty($manage_list)) {

											foreach ($manage_list as $manage) {
												$id = $manage['TbiStartup']['id'];
										?>
												<tr>
													<td><?php echo $i++; ?></td>
												
													<td><?php echo $manage['TbiStartup']['startup_name'] ?></td>
													<td><?php echo $manage['TbiStartup']['details']; ?></td>
													<td><?php echo $manage['TbiStartup']['startup_type']; ?></td>
													<td><?php echo $manage['TbiStartup']['status']; ?></td>
													<td><?php echo $manage['TbiStartup']['innovation_date'] ?></td>
													<td><?php echo $manage['TbiStartup']['outcome']; ?></td>
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
					</div>
				</div>
			</div>
		</div>
		</secton>
</div>
<?php echo $this->Form->create('TbiStartup', array("id" => "EditDeleteForm", "type" => "file",), array("url" => array("controller" => $details['Controller'], "action" => "innovationCommercialized")));
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
	$('.startUpId').on('change', function() {
		let id = $(this).val();
		let details = JSON.parse('<?php echo json_encode($StartUpsDetails); ?>')
		$('.st_details').val(details[id]['details']); //.replace(/\s/g, ' ')
		$('.st_type').val(details[id]['startup_type'])
	});
</script>
<script>
	var conrtoller = '.<?= $details['Controller'] ?>InnovationCommercialized'
	$(conrtoller).addClass('active').parents('li').addClass('active')
</script>