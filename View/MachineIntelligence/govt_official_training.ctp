<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Govt Official Training
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
        <li class="breadcrumb-item active"> Govt Official Training</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Officials' ,array("controller"=>"MachineIntelligence","action"=>"govtOfficialTrainingAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,)); ?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Name </th>
                            <th>Gender </th>
                            <th>Mobile </th>
                            <th>Email </th>
                            <th>City </th>

							<th>Organization</th>
							<th>Org Details</th>
							<th>Department</th>
							<th>Training Date</th>
							<th>Training Details</th>

                           <!-- <th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($dataList)) {

								foreach ($dataList as $list) {
                                    $id = $list['MiOfficials']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MiOfficials']['phase'];?></td>
							<td><?php echo $list['MiOfficials']['name'];?></td>
                            <td><?php echo $list['MiOfficials']['gender'];?></td>
                            <td><?php echo $list['MiOfficials']['mobile'];?></td>
                            <td><?php echo $list['MiOfficials']['email'];?></td>
							<td><?php echo $list['MiOfficials']['city'];?></td>
							<td><?php echo $list['MiOfficials']['organization_name'];?></td>
                            <td><?php echo $list['MiOfficials']['organization_details'];?></td>
							<td><?php echo $list['MiOfficials']['department'];?></td>
                            <td><?php echo $list['MiOfficials']['date'];?></td>
                            <td><?php echo $list['MiOfficials']['training_details'];?></td>
                           <!-- <td><?php /*echo $list['MiOfficials']['month'].' - '.$list['MiOfficials']['year'];*/?></td>-->
                            <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"MachineIntelligence","action"=>"govtOfficialTrainingAdd",$id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"MachineIntelligence","action"=>"govtOfficialTraining",$id), array("escape"=>false)); ?>	</td>
						</tr>
						<?php   }

                            } ?>
					</tbody>
				</table>
				</div>
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

    $('.govtOfficialTraining').addClass('active').parents('li').addClass('active');
</script>
