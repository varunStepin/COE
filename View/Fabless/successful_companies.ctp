<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Successful Companies
      </h1>
      <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="breadcrumb-item"><a href="#">Fabless</a></li>
        <li class="breadcrumb-item active">Successful Companies</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">


		<div class="col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('Add Successful Company' ,array("controller"=>"Fabless","action"=>"successfulCompaniesAdd"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false,));

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
            
              <!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php
							$i=1;
							if (!empty($successful_companies_list)) {

								foreach ($successful_companies_list as $list) {
                                    $successful_companies_id = $list['SuccessfulCompany']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['SuccessfulCompany']['phase'];?></td>
							<td><?php echo $list['SuccessfulCompany']['name'];?></td>
							<td><?php echo $list['SuccessfulCompany']['company_type'];?></td>
							<td><?php echo $list['SuccessfulCompany']['product'];?></td>
							<td><?php echo $list['SuccessfulCompany']['email'];?></td>
							<td><?php echo $list['SuccessfulCompany']['mobile'];?></td>
							<td><?php echo $list['SuccessfulCompany']['website'];?></td>
              <td><?php echo $list['SuccessfulCompany']['address'];?></td>
             
              <!--<td><?php /*echo $list['Companies']['month'].' - '.$list['Companies']['year'];*/?></td>-->
              <td><?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-edit"></i>' ,array("controller"=>"Fabless","action"=>"successfulCompaniesAdd",$successful_companies_id), array("escape"=>false)); ?>
							<?php echo $this->Html->link('<i style="font-size:12px;" class="glyphicon glyphicon-trash"></i>' ,array("controller"=>"Fabless","action"=>"successfulCompanies",$successful_companies_id), array("escape"=>false)); ?>	</td>
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

    $('.successfulCompanies').addClass('active').parents('li').addClass('active');
</script>
