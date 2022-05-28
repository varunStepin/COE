<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Student Enrollment
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
        <li class="breadcrumb-item active">  Student Enrollment</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Students' ,array("controller"=>"MachineIntelligence","action"=>"studentEnrollmentAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,)); ?>
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
							<th>Branch</th>
							<th>Clg Details</th>
							<th>Student Type</th>
							<th>Thesis Details</th>
              <th>Thesis Status </th>
              <!-- <th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($dataList)) {

								foreach ($dataList as $list) {
                                    $id = $list['MiStudentEnrollment']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MiStudentEnrollment']['phase'];?></td>
							<td><?php echo $list['MiStudentEnrollment']['name'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['gender'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['mobile'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['email'];?></td>
							<td><?php echo $list['MiStudentEnrollment']['city'];?></td>
							<td><?php echo $list['MiStudentEnrollment']['branch'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['clg_details'];?></td>
							<td><?php echo $list['MiStudentEnrollment']['student_type'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['thesis_details'];?></td>
              <td><?php echo $list['MiStudentEnrollment']['thesis_status'];?></td>
              <!--<td><?php /*echo $list['MiStudentEnrollment']['month'].' - '.$list['MiStudentEnrollment']['year'];*/?></td>-->
              <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"MachineIntelligence","action"=>"studentEnrollmentAdd",$id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"MachineIntelligence","action"=>"studentEnrollment",$id), array("escape"=>false)); ?>	</td>
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

    $('.studentEnrollment').addClass('active').parents('li').addClass('active');
</script>
