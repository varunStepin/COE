<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Workshop Participants
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><i class="fa fa-dashboard"></i>
				<?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?>
			</li>
			<li class="breadcrumb-item"><a href="#"> Workshop</a></li>
			<li class="breadcrumb-item active">Workshop Participants</li>
		</ol>
	</section>

	<section class="content pt-0">
		<div class="row">
			<div class="col-lg-12 col-12">
				<div class="p-5 box my-10">
					<div>
						<a href="<?php echo $this->webroot .'excel_dounload/sample_participants.xls'; ?>" target="_blank"
							class="btn btn-sm btn-outline-danger pull-right">Excel Download <i
								class="fa fa-download"></i> </a>
						<a href="javascript:void(0)" class="btn btn-sm btn-outline-success pull-right mr-5"
							id="bulkUpload">Excel Upload <i class="fa fa-upload"></i> </a>

						<div style="display: none">
							<?php
                              echo $this->Form->create('Participant',array("url"=>array("controller"=>"CyberSecurity","action"=>"importParticipant"),"class"=>"form-horizontal",'id'=>'excel_import_form',"type"=>"file",'onsubmit'=>"return addCsrfToken()"));
                              echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));

                              echo $this->Form->input('redirect_to',array("type"=>"hidden","label"=>false,'required',"value"=>"workshopParticipantsList"));
                              echo $this->Form->input('program_type',array("type"=>"hidden","label"=>false,"value"=>"ManageCyberSecurity"));

                              echo $this->Form->input('program_id',array("type"=>"hidden","label"=>false,'required',"id"=>"excel_program_id"));
                              echo $this->Form->input('file',array("type"=>"file",'id'=>'excel_file',"class"=>"form-control doc_type","label"=>false));
                              echo $this->Form->end();
                              ?>
						</div>

					</div>

				</div>
				<?php echo $this->Form->create('ParticipantsDetail',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"CyberSecurity","action"=>"workshopParticipants")));
                  echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                  echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));
                  ?>
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<?php echo $this->Session->flash(); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-md-3">
								<?php echo $this->Form->input("program_id",array("type"=>"select","class"=>"form-control","empty"=>"Select Program","options"=>$programs,"required","label"=>false,"id"=>"ProgramName"))?>
							</div>
							<div class="col-sm-6 col-md-9">
								<div class="pull-right">
									<input type="button" class="btn btn-sm btn-primary waves-effect waves-light"
										value="Add Row" onclick="addRow('dataTable1')" />
									<input type="button" class="btn btn-sm btn-danger waves-effect waves-light mr-1"
										value="Delete Row" onclick="deleteRow('dataTable1')" />
									<?php echo $this->Html->link('<span> Participants List  </span>',array("controller"=>"CyberSecurity","action"=>"workshopParticipantsList"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
								</div>
							</div>
						</div>
						<div class="row mt-2">
							<div class="col-sm-12 col-md-12">
								<table width="100%" class="table" cellspacing="0" id="dataTable1">
									<tbody>
										<tr class="sub_all">
											<td><input type="checkbox" name="chk" /></td>
											<td><?php echo $this->Form->input("ParticipantsDetail.participant_name.",array("type"=>"text","name"=>"participant_name[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Participant Name"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.gender.",array("type"=>"select","options"=>array('Male'=>'Male','Female'=>'Female'),"name"=>"gender[]","class"=>"form-control","required","label"=>false,"empty"=>"Gender"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.designation.",array("type"=>"text","name"=>"designation[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Designation"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.contact_no.",array("type"=>"text","name"=>"contact_no[]","class"=>"form-control isNumber","required",'minlength'=>'10','maxlength'=>'10',"label"=>false,"placeholder"=>"Phone number"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.email.",array("type"=>"email","name"=>"email[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Email Id"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.location.",array("type"=>"text","name"=>"location[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Location"))?>
											</td>
											<!---------- new fields 21-07-2022 ----------->
											<td><?php echo $this->Form->input("ParticipantsDetail.organization_name.",array("type"=>"text","name"=>"organization_name[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Organization Name"))?>
											</td>
											<td><?php echo $this->Form->input("ParticipantsDetail.address.",array("type"=>"text","name"=>"address[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Address"))?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="box-footer ">
						<div class="pull-right" align="right">
							<?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn btn-sm btn-warning waves-effect waves-light","label"=>false)); ?>
							<?php echo $this->Form->button("Save",array("type"=>"submit","class"=>"btn btn-sm btn-success waves-effect waves-light","label"=>false)); ?>
						</div>
					</div>
				</div>
				<?php echo $this->Form->end(); ?>
			</div>
		</div>
	</section>
</div>

<script>
	function addRow(tableID) {

		var table = document.getElementById(tableID);

		var rowCount = table.rows.length;
		var row = table.insertRow(rowCount);
		row.className = "sub_all";

		var colCount = table.rows[0].cells.length;

		for (var i = 0; i < colCount; i++) {

			var newcell = row.insertCell(i);

			newcell.innerHTML = table.rows[0].cells[i].innerHTML;
			//alert(newcell.childNodes);
			switch (newcell.childNodes[0].type) {
				case "text":
					newcell.childNodes[0].value = "";
					break;
				case "checkbox":
					newcell.childNodes[0].checked = false;
					break;
				case "select-one":
					newcell.childNodes[0].selectedIndex = 0;
					break;
			}
		}
	}

	function deleteRow(tableID) {
		try {
			var table = document.getElementById(tableID);
			var rowCount = table.rows.length;

			for (var i = 0; i < rowCount; i++) {
				var row = table.rows[i];
				var chkbox = row.cells[0].childNodes[0];
				if (null != chkbox && true == chkbox.checked) {
					if (rowCount <= 1) {
						alert("Cannot delete all the rows.");
						break;
					}
					table.deleteRow(i);
					rowCount--;
					i--;
				}


			}
		} catch (e) {
			alert(e);
		}
	}

</script>

<script>
	$('#bulkUpload').on('click', function () {
		let program = $('#ProgramName').val();
		$('.error_ale').remove();
		if (program == '') {
			$('#ProgramName').focus().after('<span class="text-danger error_ale">Select Program type !!!</span>');
		} else {
			$('#excel_program_id').val(program);
			$('#excel_file').click();
		}
	});

	$('#ProgramName').on('change', function () {
		$('.error_ale').remove();
	});


	$('#excel_file').on('change', function () {
		$('#excel_import_form').submit();
	});

</script>
<script>
	$('.workshopParticipants').attr('class', 'active').parents('li').addClass('active');

</script>
