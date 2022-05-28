<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Start-ups enrolled
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
              <li class="breadcrumb-item active">Start-ups enrolled</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Start Ups' ,array("controller"=>"Iot","action"=>"startUp"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
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
							<th>Startup Name</th>
							<th>vertical</th>
                            <th>Incubation Date</th>
							<th>Graduation Date</th>
							<th>Founder</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>url</th>
                            <th># of emp</th>
                            <th># of women emp</th>
                            <th># of women co-founder</th>
                            <th>Founder Education</th>
                            <th>Founders Total Man Year</th>
                            <th>Status</th>

							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['IotStartUp']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
                            <td><?php echo $list['IotStartUp']['phase'];?></td>
							<td><?php echo $list['IotStartUp']['start_up_name'];?></td>
                            <td><?php echo $list['IotStartUp']['vertical'];?></td>
                            <td><?php $date1 = $list['IotStartUp']['date_of_incubation'];
                                echo ($date1) ? date('d-m-Y',strtotime($date1)) : '';
                                ?></td>
                            <td><?php $date1 = $list['IotStartUp']['date_of_graduation'];
                                echo ($date1) ? date('d-m-Y',strtotime($date1)) : '';
                                ?></td>
                            <td><?php echo $list['IotStartUp']['founder_name'];?></td>
                            <td><?php echo $list['IotStartUp']['founder_email'];?></td>
                            <td><?php echo $list['IotStartUp']['mobile'];?></td>
                            <td><?php echo $list['IotStartUp']['url'];?></td>
                            <td><?php echo $list['IotStartUp']['no_employees'];?></td>
                            <td><?php echo $list['IotStartUp']['no_employees_women'];?></td>
                            <td><?php echo $list['IotStartUp']['no_women_cofounder'];?></td>
                            <td><?php echo $list['IotStartUp']['founder_education'];?></td>
                            <td><?php echo $list['IotStartUp']['founders_total_man_year'];?></td>
                            <td><?php echo $list['IotStartUp']['status_at_start'];?></td>
                            <!--<td><?php /*echo $list['IotStartUp']['month'].'-'.$list['IotStartUp']['year'];*/?></td>-->


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

<?php echo $this->Form->create('IotStartUp',array("url"=>array("controller" => "Iot", "action" => "startUp"),"id"=>"EditDeleteForm"));
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
    $('.Start-ups').addClass('active').parents('li').addClass('active');





</script>
