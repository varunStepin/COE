<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
	<section class="content-header">
		<h1>
			Number Of New Products
		</h1>
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="breadcrumb-item"><a href="#">Ktech</a></li>
			<li class="breadcrumb-item active">Number Of New Products</li>
		</ol>
	</section>

	<section class="content">
		<div class="row">
			<div class="col-lg-5 col-12">
				<div class="box">
					<div class="box-body">
						<div class="row">
							<div class="col-sm-12 col-md-12">
								<?php echo $this->Session->flash(); ?>
							</div>
						</div>
						<div class="row">
							<div class="col-12">
								<?php echo $this->Form->create('KtechNoOfNewProducts',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Ktech","action"=>"noOfNewProducts")));
                                echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                                echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Phase<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("phase",array("type"=>"select","options"=>AppController::getPhase(),"empty"=>"Select Phase","class"=>"form-control","required","label"=>false))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Name Of Startup<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("name_of_the_startup",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Name of startup"))?>
										<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['KtechNoOfNewProducts']['id']));?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Startup Name<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("startup_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Name Of Startup"))?>
		
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Product Name<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("product_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Product Name"))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Product
										Description<span class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("product_description",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Product Description"))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Founder Name<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("founder_name",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Founder Name"))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Technology Used<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("technology_used",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Technology Used"))?>
									</div>
								</div>
								<div class="form-group row">
									<label for="example-text-input" class="col-sm-4 col-form-label">Sector<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php echo $this->Form->input("sector",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Sector"))?>
									</div>
								</div>
								<div class="form-group row displayNone">
									<label for="example-text-input" class="col-sm-4 col-form-label">Month-Year<span
											class="text-danger">*</span></label>
									<div class="col-sm-8">
										<?php
                                        echo $this->Form->input("month",array("type"=>"text","value"=>date('F-Y'),"label"=>false,"id"=>"monthPicker","class"=>"form-control",'placeholder'=>'MMM-YYYY','required'));?>
									</div>
								</div>
								<div class="box-footer">
									<div class="clearfix pull-right">
										<?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
										<?php
                                        if(empty($this->request->data['KtechNoOfNewProducts']['id'])) {
                                            echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                        }
                                        else {
                                            echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
                                        }
                                        ?>
									</div>
								</div>
								<?php echo $this->Form->end(); ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-lg-7 col-12">
				<div class="box">
					<div class="box-body">
						<div class="table-responsive">
							<table class="table example_long table-striped table-bordered table-hover">
								<thead style="font-size:15px; font-weight:bold;">
									<tr class="bg-info">
										<th>#</th>
										<th>Phase</th>
										<th>Name of Startup</th>
										<th>Startup Name</th>
										<th>Founder Name</th>
										<th>Product Name</th>
										<th>Technology Used</th>
										<th>Sector</th>
										<th>Product Description</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
                                $i=1;
                                if (!empty($table_list)) {
                                    foreach ($table_list as $list) {
                                        $id = $list['KtechNoOfNewProducts']['id'];
                                        ?>
									<tr>
										<td><?php echo $i++;?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['phase'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['name_of_the_startup'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['startup_name'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['founder_name'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['product_name'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['technology_used'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['sector'];?></td>
										<td><?php echo $list['KtechNoOfNewProducts']['product_description'];?></td>
										<!--<td><?php /*echo $list['KtechFundRaisedStartup']['month'] .'-'. $list['KtechFundRaisedStartup']['year'];*/?></td>-->
										<td>
											<a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i
													style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
											<a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i
													style="font-size:12px;" class="glyphicon glyphicon-edit"></i></a>
										</td>
									</tr>
									<?php   }}  ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php echo $this->Form->create('KtechNoOfNewProducts',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Ktech","action"=>"noOfNewProjects")));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
echo $this->Form->end();
?>
<script>
	function addIdToForm(id, type) {

		$('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
		if (type == 'delete') {
			if (confirm('Are you sure you want to delete?') === false)
				return;
		}
		$('#fieldId').val(id);
		$('#actionType').val(type);
		$('#EditDeleteForm').submit();


	}

</script>
<script>
	$('.noOfNewProducts').addClass('active').parents('li').addClass('active')

</script>
