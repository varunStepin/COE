<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Patents
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Machine Intelligence</a></li>
        <li class="breadcrumb-item active"> Patents</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Patents' ,array("controller"=>"MachineIntelligence","action"=>"patentsAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,)); ?>
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
                            <th>Id </th>
                            <th>Belongs To </th>
                            <th>Complete Details </th>
							<th>Team Work Details</th>
							<th>Status</th>
                           <!-- <th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($dataList)) {

								foreach ($dataList as $list) {
                                    $id = $list['MiPatent']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MiPatent']['phase'];?></td>
							<td><?php echo $list['MiPatent']['name'];?></td>
                            <td><?php echo $list['MiPatent']['patent_id'];?></td>
                            <td><?php echo $list['MiPatent']['belongs_to'];?></td>
							<td><?php echo $list['MiPatent']['complete_details'];?></td>
							<td><?php echo $list['MiPatent']['team_work_details'];?></td>
                            <td><?php echo $list['MiPatent']['status'];?></td>
                           <!-- <td><?php /*echo $list['MiPatent']['month'].' - '.$list['MiPatent']['year'];*/?></td>-->
                            <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"MachineIntelligence","action"=>"patentsAdd",$id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"MachineIntelligence","action"=>"patents",$id), array("escape"=>false)); ?>	</td>
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

    $('.patents').addClass('active').parents('li').addClass('active');
</script>
