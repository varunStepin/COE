<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Update Problem Statement
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Excellence by C-Camp</a></li>
        <li class="breadcrumb-item active">Manage Update Problem Statement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-12 col-12">
			<!-- Basic Forms -->
            <?php echo $this->Form->create('ManageProblemStatementDetail',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"MachineIntelligence","action"=>"updateProblemStatement")));
            echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
            echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert")); ?>
			  <div class="box">

				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<div class="pull-right">
                                <?php echo $this->Html->link('<span>Add Problem Statement</span>',array("controller"=>"Home","action"=>"problemStatement"),array("escape"=>false,"class"=>'btn btn-sm btn-info waves-effect waves-light'));?>
                                <?php echo $this->Html->link('<span>Update Problem Statement list</span>',array("controller"=>"Home","action"=>"updatedProblemStatementList"),array("escape"=>false,"class"=>'btn btn-sm btn-info waves-effect waves-light'));?>
                            </div>
						</div>
					</div>
					<div class="row mt-2">
						<div class="col-sm-12 col-md-12 table-responsive" >
							<table width="100%" class="table table-hover"  cellspacing="0" id="dataTable1" border="1">
							 <thead style="background-color: #7db7ea;">
							  <tr>
								<th rowspan="3"><strong>SL No</strong></th>
								<th rowspan="3"><strong>Problem Statement</strong></th>
								<th colspan="4" ><strong>Update</strong></th>
							  </tr>
							  <tr>
								<th >Immersion Program</th>
								<th >Curated </th>
								<th >Grand challenges</th>
								<th >Call for Grand Challenge</th>
							  </tr>
							  <tr style="background-color: none;">
								<th><input type="checkbox" id="checkAll"></th>
								<th><input type="checkbox" id="checkAll1"></th>
								<th><input type="checkbox" id="checkAll2"></th>
								<th><input type="checkbox" id="checkAll3"></th>
							  </tr>
							 </thead>
							 <tbody>
							 <?php 
							if(count($list) > 0)
							{
								$i=1;
								foreach($list as $lt) {
								$id = $lt['ManageProblemStatement']['id'];
								?>
									<tr>
										<td><?php echo $i++; ?></td>
										<td><?php echo $lt['ManageProblemStatement']['details']; ?></td>
										<td><input type="checkbox" class="check" value="Immersion Program" name="<?php echo $id; ?>[]"></td>
										<td><input type="checkbox" class="check1" value="Curated" name="<?php echo $id; ?>[]"></td>
										<td><input type="checkbox" class="check2" value="Grand Challenges" name="<?php echo $id; ?>[]"></td>
										<td><input type="checkbox" class="check3" value="Call For Grand Challenge" name="<?php echo $id; ?>[]"></td>
									</tr>
							<?php } } else { ?>
								<tr><td colspan="6">No Records Found.</td></tr>
							<?php } ?>
							 </tbody>
							</table>
						<!-- /.col -->
						</div>
					</div>

			<!-- /.row -->
				</div>
				
				
				
                  <div class="box-footer ">
				  
				  <div class="row">
						<div class="col-sm-12 col-md-12">
							 <div class="pull-right" align="right">
							  <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn btn-sm btn-warning waves-effect waves-light","label"=>false)); ?>
							  <?php echo $this->Form->button("Save",array("type"=>"submit","class"=>"btn btn-sm btn-success waves-effect waves-light","label"=>false)); ?>
							</div>
						</div>
					</div>
                      
                  </div>
		<!-- /.box-body -->

	</div>
            <?php echo $this->Form->end(); ?>
	<!-- /.box -->
		</div>


	  </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  
  <style>
	table, th, td {
	  text-align:center;
	}
  </style>
  
  
<script>
	$("#checkAll").click(function () {
		$(".check").prop('checked', $(this).prop('checked'));
	});
	
	$("#checkAll1").click(function () {
		$(".check1").prop('checked', $(this).prop('checked'));
	});
	
	$("#checkAll2").click(function () {
		$(".check2").prop('checked', $(this).prop('checked'));
	});
	
	$("#checkAll3").click(function () {
		$(".check3").prop('checked', $(this).prop('checked'));
	});
</script>


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
    $('#bulkUpload').on('click',function () {
        let program = $('#ProgramName').val();
        $('.error_ale').remove();
        if(program == ''){
            $('#ProgramName').focus().after('<span class="text-danger error_ale">Select Program type !!!</span>');
        }else{
            $('#excel_program_id').val(program);
            $('#excel_file').click();
        }
    });

    $('#ProgramName').on('change',function () {
        $('.error_ale').remove();
    });


    $('#excel_file').on('change',function () {
        $('#excel_import_form').submit();
    });
</script>
<script>

    $('.updateProblemStatement').addClass('active').parents('li').addClass('active');
</script>
