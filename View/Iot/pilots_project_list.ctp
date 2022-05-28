<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Pilots              project              executed
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
              <li class="breadcrumb-item active">Pilots   project executed</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Pilots Project' ,array("controller"=>"Iot","action"=>"pilotsProject"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
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
							<th>Name of Startup</th>
							<th>Start Date</th>
                            <th>End/continuing Date</th>
							<th>Impact Expected </th>
						
                            <th>Industry Category </th>
                            	<th>Description </th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['IotPilotsProject']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>

                            <td><?php echo $list['IotStartUp']['start_up_name'];?></td>
                            <td><?php $date_start = $list['IotPilotsProject']['date_of_started'];
                                echo ($date_start) ? date('d-m-Y',strtotime($date_start)) : '';
                                ?></td>
                            <td><?php $date_end = $list['IotPilotsProject']['date_of_end'];
                                echo ($date_end) ? date('d-m-Y',strtotime($date_end)) : '';
                                ?></td>
                            <td><?php echo $list['IotPilotsProject']['impact_expected'];?></td>
                            <td><?php echo $list['IotPilotsProject']['industry_category'];?></td>
                             <td><?php echo $list['IotPilotsProject']['details']?></td>

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

<?php echo $this->Form->create('IotPilotsProject',array("url"=>array("controller" => "Iot", "action" => "pilotsProject"),"id"=>"EditDeleteForm"));
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
    $('.pilotsProjectList').addClass('active').parents('li').addClass('active');





</script>
