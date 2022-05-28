<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Capacity Building Student Details
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Cyber Security</a></li>
        <li class="breadcrumb-item active">Manage Capacity Building Student Details</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-12 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<div class="box-header with-border">
					<?php echo $this->Html->link('<span>View Capacity Building Student Details List  </span>',array("controller"=>"Home","action"=>"manageCapacityStudentDetailsList"),array("escape"=>false,"class"=>'btn btn-primary pull-right'));?>
				</div>
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
							
							
						</div>
					</div>
					<?php echo $this->Form->create('ManageCapacityStudentDetail',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"manageCapacityStudentDetails")));
							echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
							echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert")); ?>
					<div class="row">
						<div class="col-sm-6 col-md-4">
							<input type="button" class="btn btn-primary waves-effect waves-light" value="Add Row" onclick="addRow('dataTable1')" />
							<input type="button" class="btn btn-danger waves-effect waves-light" value="Delete Row" onclick="deleteRow('dataTable1')" />
						</div>
						<div class="col-sm-2 col-md-3">
						<?php
						echo $this->Form->input("manage_capacity_building_id",array("type"=>"select","class"=>"form-control","empty"=>"Select Trainer name","options"=>$capacitybuilding,"required","label"=>false))?>
						</div>
						<div class="col-sm-4 col-md-4" align="right">
							<?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn btn-warning waves-effect waves-light","label"=>false)); ?>
							<?php echo $this->Form->button("Save",array("type"=>"submit","class"=>"btn btn-success waves-effect waves-light","label"=>false)); ?>
						</div>	
					</div>	
					<div class="row">
						<div class="col-sm-12 col-md-12">
						<table  cellspacing="0" id="dataTable1">
						 <tbody>
						  <tr class="sub_all">
							<td><input type="checkbox" name="chk" /></td>
							<td><?php echo $this->Form->input("ManageCapacityStudentDetail.student_name.",array("type"=>"text","name"=>"student_name[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Student Name"))?></td>
                              <td><?php echo $this->Form->input("ManageCapacityStudentDetail.gender.",array("type"=>"select","name"=>"gender[]","class"=>"form-control","required","label"=>false,"empty"=>"Gender","options"=>["Male"=>"Male","Female"=>"Female"]))?></td>


                              <td><?php echo $this->Form->input("ManageCapacityStudentDetail.branch.",array("type"=>"select","options"=>array('CS'=>'CS','IS'=>'IS','EC'=>'EC','MECH'=>'MECH','CV'=>'CV'),'empty'=>'Select Branch',"name"=>"branch[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Branch"))?></td>
							<td><?php echo $this->Form->input("ManageCapacityStudentDetail.qualification.",array("type"=>"select","options"=>array('BE'=>'BE','MBA'=>'MBA','DIPLOMA'=>'DIPLOMA','PUC'=>'PUC'),'empty'=>'Select Qualification',"name"=>"qualification[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Qualification"))?></td>
							<td><?php echo $this->Form->input("ManageCapacityStudentDetail.contact_number.",array("type"=>"text","name"=>"contact_number[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Contact number"))?></td>
							<td><?php echo $this->Form->input("ManageCapacityStudentDetail.year.",array("type"=>"select","name"=>"year[]","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?></td>
							<td><?php echo $this->Form->input("ManageCapacityStudentDetail.month.",array("type"=>"select","name"=>"month[]","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?></td>
						  </tr>
						 </tbody>
						</table>
					<!-- /.col -->
						</div>
					</div>	
					<?php echo $this->Form->end(); ?>
			<!-- /.row -->
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
