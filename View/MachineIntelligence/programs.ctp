<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Programs
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
              <li class="breadcrumb-item active">Programs</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Programs' ,array("controller"=>"MachineIntelligence","action"=>"programsAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

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
							<th>Program Name </th>
							<th>Program Date</th>
							<th>Program Details</th>
							<th>Program Type</th>
                           <!-- <th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($program_list)) {

								foreach ($program_list as $list) {
                                    $program_id = $list['MiPrograms']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MiPrograms']['phase'];?></td>
							<td><?php echo $list['MiPrograms']['program_name'];?></td>
							<td><?php echo ($list['MiPrograms']['program_date']!='0000-00-00') ? date('d-m-Y',strtotime($list['MiPrograms']['program_date'])) : '';?></td>
							<td><?php echo $list['MiPrograms']['program_details'];?></td>
							<td><?php echo $list['MiPrograms']['program_type'];?></td>

                           <!-- <td><?php /*echo $list['MiPrograms']['month'].' - '.$list['MiPrograms']['year'];*/?></td>-->
                            <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"MachineIntelligence","action"=>"programsAdd",$program_id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"MachineIntelligence","action"=>"programs",$program_id), array("escape"=>false)); ?>	</td>
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

    $('.Programs').addClass('active').parents('li').addClass('active');
</script>
