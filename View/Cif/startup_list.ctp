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
              <li class="breadcrumb-item"><a href="#">Cif</a></li>
              <li class="breadcrumb-item active">Start-ups enrolled</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Start Ups' ,array("controller"=>"Cif","action"=>"startups"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
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
              <th>Year</th>
							<th>Startup Name</th>
              <th>Incubation Date</th>
							<th>Graduation Date</th>
							<th>Founder</th>
              <th>Email</th>
              <th>url</th>
              <th># of emp</th>
              <th># of women emp</th>
              <th>Is woman founder</th>
              <th>Contact Number</th>              
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['CifStartup']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
              <td><?php echo $list['CifStartup']['phase']; ?></td>
              <td><?php echo $list['CifStartup']['year']; ?></td>
							<td><?php echo $list['CifStartup']['startup_name']; ?></td>
              <td><?php echo date('d-m-Y',strtotime($list['CifStartup']['incubation_date'])); ?></td>
              <td><?php echo date('d-m-Y',strtotime($list['CifStartup']['graduation_date'])); ?></td>
              <td><?php echo $list['CifStartup']['founder_name']; ?></td>
              <td><?php echo $list['CifStartup']['founder_email']; ?></td>
              <td><?php echo $list['CifStartup']['url']; ?></td>
              <td><?php echo $list['CifStartup']['no_employees']; ?></td>
              <td><?php echo $list['CifStartup']['no_employees_women']; ?></td>
              <td><?php echo($list['CifStartup']['is_women_founder'])?"Yes":"No";?></td>
              <td><?php echo $list['CifStartup']['mobile']; ?></td>
                           
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

<?php echo $this->Form->create('CifStartup',array("url"=>array("controller" => "Cif", "action" => "startups"),"id"=>"EditDeleteForm"));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
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
    $('.startups').addClass('active').parents('li').addClass('active');
</script>
