<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Problem Statement
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Excellence by C-Camp</a></li>
        <li class="breadcrumb-item active">Manage Problem Statement</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-lg-12 col-12">
			<!-- Basic Forms -->
            <?php echo $this->Form->create('ManageProblemStatement',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"problemStatement")));
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
						<div class="col-sm-6 col-md-8">
							<div class="pull-right">
                                <input type="button" class="btn btn-sm btn-primary waves-effect waves-light" value="Add Row" onclick="addRow('dataTable1')" />
                                <input type="button" class="btn btn-sm btn-danger waves-effect waves-light mr-1" value="Delete Row" onclick="deleteRow('dataTable1')" />
                                <?php echo $this->Html->link('<span>Update Problem Statement</span>',array("controller"=>"Home","action"=>"updateProblemStatement"),array("escape"=>false,"class"=>'btn btn-sm btn-info waves-effect waves-light'));?>
                                <?php echo $this->Html->link('<span>Problem Statement List</span>',array("controller"=>"Home","action"=>"problemStatementList"),array("escape"=>false,"class"=>'btn btn-sm btn-info waves-effect waves-light'));?>
                            </div>
						</div>
                        <div class="col-sm-6 col-md-4">

                        </div>
					</div>
					<div class="row mt-2">
						<div class="col-sm-6 col-md-8">
							<table width="100%" class="table"  cellspacing="0" id="dataTable1">
							 <tbody>
							  <tr class="sub_all">
								<td><input type="checkbox" name="chk" /></td>
								<td><?php echo $this->Form->input("phase.",array("type"=>"select","options"=>AppController::getPhase(),"id"=>"PhaseName","empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?></td>
								<td><?php echo $this->Form->input("details.",array("type"=>"text","name"=>"details[]","class"=>"form-control","required","label"=>false,"placeholder"=>"Details"))?></td>
								<td> <?php echo $this->Form->input("types.",array("type"=>"select","class"=>"form-control","id"=>"ProgramName","options"=>array("New Problem"=>"New Problem"),"required","label"=>false))?></td>
							  </tr>
							 </tbody>
							</table>
						<!-- /.col -->
						</div>
					</div>

			<!-- /.row -->
				</div>



                  <div class="box-footer ">

				  <div class="row">
						<div class="col-sm-6 col-md-8">
							 <div class="pull-right" align="right">
							  <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn btn-sm btn-warning waves-effect waves-light","label"=>false)); ?>
							  <?php echo $this->Form->button("Save",array("type"=>"submit","class"=>"btn btn-sm btn-success waves-effect waves-light","label"=>false)); ?>
							</div>
						</div>
                        <div class="col-sm-6 col-md-4">

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

    $('.problemStatement').addClass('active').parents('li').addClass('active');
</script>
