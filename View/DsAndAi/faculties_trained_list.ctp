<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Faculties trained
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Data science &amp; AI</a></li>
              <li class="breadcrumb-item active">Faculties trained</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Faculties' ,array("controller"=> "DsAndAi", "action" => "facultiesTrained"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
					</div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<?php echo $this->Session->flash(); ?>
					</div>
				</div>
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead>
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							<th>Faculty Name</th>
                            <th>Gender</th>
							<th>College Name</th>
                            <th>Branch</th>
							<th>Contact Number</th>
                            <th>Email</th>
							<th>City</th>
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['DsAiTrainedFaculty']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['phase'];?></td>
							<td><?php echo $list['DsAiTrainedFaculty']['name'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['gender'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['collage_name'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['branch'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['contact_number'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['email'];?></td>
                            <td><?php echo $list['DsAiTrainedFaculty']['city'];?></td>
                            <!--<td><?php /*echo $list['DsAiTrainedFaculty']['month'].'-'.$list['DsAiTrainedFaculty']['year'];*/?></td>-->


							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
                            </td>
						</tr>
						<?php   }  } ?>
					</tbody>
				</table>
				</div>              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->          
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php echo $this->Form->create('DsAiTrainedFaculty',array("url"=>array("controller" => "DsAndAi", "action" => "facultiesTrained"),"id"=>"EditDeleteForm"));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('actionType',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
echo $this->Form->end();
?>
<script>
    function addIdToForm(id,type){

        $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        if(type=='delete'){
            if(confirm('Are you sure you want to delete?')===false)
                return;
        }
        $('#fieldId').val(id)
        $('#actionType').val(type)
        $('#EditDeleteForm').submit();


    }
    $('.facultiesTrainedList').addClass('active').parents('li').addClass('active');





</script>
