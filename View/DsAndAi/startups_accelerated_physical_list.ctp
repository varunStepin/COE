<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Start-ups Accelerated Physical
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Innovators Accelerated</a></li>
              <li class="breadcrumb-item active">Start-ups Accelerated Physical</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Start Ups' ,array("controller"=> "DsAndAi", "action" => "startupsAcceleratedPhysical"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
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
<!--
							<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['DsAiPhyAccStartup']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['phase'];?></td>
							<td><?php echo $list['DsAiPhyAccStartup']['start_up_name'];?></td>

                            <td><?php echo $list['DsAiPhyAccStartup']['date_of_incubation'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['date_of_graduation'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['founder_name'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['founder_email'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['mobile'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['url'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['no_employees'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['no_employees_women'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['no_women_cofounder'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['founder_education'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['founders_total_man_year'];?></td>
                            <td><?php echo $list['DsAiPhyAccStartup']['status_at_start'];?></td>
                          <!--  <td><?php /*echo $list['DsAiPhyAccStartup']['month'].'-'.$list['DsAiPhyAccStartup']['year'];*/?></td>-->


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

<?php echo $this->Form->create('DsAiPhyAccStartup',array("url"=>array("controller" => "DsAndAi", "action" => "startupsAcceleratedPhysical"),"id"=>"EditDeleteForm"));
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
    $('.startupsAcceleratedPhysical').addClass('active').parents('li').addClass('active')





</script>
