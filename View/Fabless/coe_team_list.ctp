<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          COE Team Details
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Fabless</a></li>
        <li class="breadcrumb-item active"> COE Team Details </li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Team Details' ,array("controller"=>"Fabless","action"=>"coeTeam"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

                    ?>
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
							<th>Gender</th>
							<th>Date of Birth</th>
							<th>Date of Join</th>

							<th>Designation</th>
                            <th>Qualification</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Address</th>
                            <th>City Name</th>

							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($companies_list)) {

								foreach ($companies_list as $list) {
                                    $companies_id = $list['FablessCoeTeam']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['FablessCoeTeam']['phase'];?></td>
							<td><?php echo $list['FablessCoeTeam']['name'];?></td>
							<td><?php echo $list['FablessCoeTeam']['gender'];?></td>
							<td><?php echo $list['FablessCoeTeam']['dob'];?></td>
							<td><?php echo $list['FablessCoeTeam']['doj'];?></td>
							<td><?php echo $list['FablessCoeTeam']['designation'];?></td>
							<td><?php echo $list['FablessCoeTeam']['qualification'];?></td>
                            <td><?php echo $list['FablessCoeTeam']['mobile'];?></td>
                            <td><?php echo $list['FablessCoeTeam']['email'];?></td>
                            <td><?php echo $list['FablessCoeTeam']['address']?></td>
                            <td><?php echo $list['FablessCoeTeam']['city']?></td>
                            <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"Fabless","action"=>"coeTeam",$companies_id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"Fabless","action"=>"coeTeamList",$companies_id), array("escape"=>false)); ?>	</td>
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

    $('.coeTeam').addClass('active').parents('li').addClass('active');
</script>
