<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
          Companies
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Fabless</a></li>
        <li class="breadcrumb-item active">Companies</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Company' ,array("controller"=>"Fabless","action"=>"companiesAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

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
							<th>Type</th>
							<th>Product</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Website</th>
                            <th>Address</th>
                            <th>Status</th>
                            <!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($companies_list)) {

								foreach ($companies_list as $list) {
                                    $companies_id = $list['Companies']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['Companies']['phase'];?></td>
							<td><?php echo $list['Companies']['name'];?></td>
							<td><?php echo $list['Companies']['company_type'];?></td>
							<td><?php echo $list['Companies']['product'];?></td>
							<td><?php echo $list['Companies']['email'];?></td>
							<td><?php echo $list['Companies']['mobile'];?></td>
							<td><?php echo $list['Companies']['website'];?></td>
                            <td><?php echo $list['Companies']['address'];?></td>
                            <td><?php echo $list['Companies']['status'];?></td>
                            <!--<td><?php /*echo $list['Companies']['month'].' - '.$list['Companies']['year'];*/?></td>-->
                            <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"Fabless","action"=>"companiesAdd",$companies_id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"Fabless","action"=>"companies",$companies_id), array("escape"=>false)); ?>	</td>
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

    $('.companies').addClass('active').parents('li').addClass('active');
</script>
