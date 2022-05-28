<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Startup Conference
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
              <li class="breadcrumb-item active">Startup Conference</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Conference' ,array("controller"=>"MachineIntelligence","action"=>"startupConferenceAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

                    ?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped  table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Conference Name </th>
							<th>Conference Date</th>
							<th>Conference Details</th>
							<th>Workshops Details</th>
							<th>Paper Presentations</th>
							<th>Plan for Next Year Conference</th>
                           <!-- <th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($conference_list)) {

								foreach ($conference_list as $list) {
                                    $program_id = $list['MiStartupConferences']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MiStartupConferences']['phase'];?></td>
							<td><?php echo $list['MiStartupConferences']['conference_name'];?></td>
							<td><?php echo ($list['MiStartupConferences']['conference_date']!='0000-00-00') ? date('d-m-Y',strtotime($list['MiStartupConferences']['conference_date'])) : '';?></td>
							<td><?php echo $list['MiStartupConferences']['conference_details'];?></td>
							<td><?php echo $list['MiStartupConferences']['workshops'];?></td>
							<td><?php echo $list['MiStartupConferences']['paper_presentations'];?></td>
							<td><?php echo $list['MiStartupConferences']['plan_for_next_year_conference'];?></td>
                            <!--<td><?php /*echo $list['MiStartupConferences']['month'].' - '.$list['MiStartupConferences']['year'];*/?></td>-->
                            <td>
                                <?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"MachineIntelligence","action"=>"startupConferenceAdd",$program_id), array("escape"=>false)); ?>
							    <?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"MachineIntelligence","action"=>"startupConference",$program_id), array("escape"=>false)); ?></td>
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

    $('.StartUpConference').addClass('active').parents('li').addClass('active');
</script>
