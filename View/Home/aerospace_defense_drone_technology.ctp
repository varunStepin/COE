<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Aerospace Defense Academia-Drone Technologies
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
        <li class="breadcrumb-item"><a href="#">Aerospace and Defence</a></li>
        <li class="breadcrumb-item active">Drone Technologies</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">		  
        <div class="col-lg-5 col-12">
			<!-- Basic Forms -->
			  <div class="box">
				<!--<div class="box-header with-border">
					<button class="btn btn-primary pull-right">View Notice List</button>
				</div>-->
				<!-- /.box-header -->
				<div class="box-body">
					<div class="row">
						<div class="col-sm-12 col-md-12">
							<?php echo $this->Session->flash(); ?>
						</div>
					</div>
				  <div class="row">
					<div class="col-12">
						<?php echo $this->Form->create('AerospaceDefenseDroneTechnology',array("class"=>"form-horizontal",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"aerospaceDefenseDroneTechnology")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Embedded Course<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['ManageAerospaceDefenseAcademia']['id']));?>
								<?php echo $this->Form->input("embedded_course",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Embedded Course"))?>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Duration<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("duration",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Duration"))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Start Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("start_date",array("type"=>"text","class"=>"form-control datepicker","required","label"=>false))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">End Date<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("end_date",array("type"=>"text","class"=>"form-control datepicker","required","label"=>false))?>
								
							</div>
						</div>
                        <div class="form-group row">
                            <label for="example-text-input" class="col-sm-4 col-form-label">Phase<span class="text-danger">*</span></label>
                            <div class="col-sm-8">
                                <?php echo $this->Form->input("phase",array("type"=>"select","options"=>['Phase 1'=>'Phase 1','Phase 2'=>'Phase 2'],"empty"=>"Select","class"=>"form-control","required","label"=>false,"placeholder"=>"Venue"))?>

                            </div>
                        </div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Institute<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("institute",array("type"=>"text","class"=>"form-control","placeholder"=>'Institute Name',"required","label"=>false))?>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Resource Person<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("resource_person",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Resource Person"))?>
								
							</div>
						</div>
						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Other Details<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("details",array("type"=>"textarea","class"=>"form-control","required","rows"=>3,"label"=>false,"placeholder"=>"Other Details"))?>
								
							</div>
						</div>
						
						<div class="form-group row displayNone">
							<label for="example-text-input" class="col-sm-4 col-form-label">Year<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php 
									echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
							</div>
						</div>
						<div class="form-group row displayNone">
							<label for="example-text-input" class="col-sm-4 col-form-label">Month<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php 
										echo $this->Form->input("month",array("type"=>"select","label"=>false,"options"=>$month_data,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('F')));?>
							</div>
						</div>
						
                        <div class="box-footer">
                            <div class="clearfix pull-right">
                                <?php echo $this->Form->button("Reset",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)); ?>
                                <?php
                                if(empty($this->request->data['AerospaceDefenseDroneTechnology']['id']))
                                {
                                    echo $this->Form->button("Save",array("type"=>"submit","class"=>"_save btn btn-danger btn-sm","label"=>false));
                                }
                                else
                                {
                                    echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
                                }
                                ?>

                            </div>
                        </div>
						<?php echo $this->Form->end(); ?>
					</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->
		</div>
		<!-- /.box-body -->
	</div>
	<!-- /.box -->			
		</div>	

		<div class="col-lg-7 col-12">
			<div class="box">
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Embedded Course</th>
							<th>Duration</th>
							<th>Start Date</th>
							<th>End Date</th>
							<th>Institute</th>
                            <th>Phase</th>
							
							<th>Resource Person</th>
							<th>Other Details</th>
							<!--<th>Year</th>
							<th>Month</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $list) {
									$id = $list['AerospaceDefenseDroneTechnology']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['embedded_course'];?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['duration'];?></td>
							<td><?php echo date('d M Y',strtotime($list['AerospaceDefenseDroneTechnology']['start_date']));?></td>
							<td><?php echo date('d M Y',strtotime($list['AerospaceDefenseDroneTechnology']['end_date']));?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['institute'];?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['phase'];?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['resource_person'];?></td>
							<td><?php echo $list['AerospaceDefenseDroneTechnology']['details'];?></td>
							<!--<td><?php /*echo $list['AerospaceDefenseEmbeddedCourse']['year'];*/?></td>
							<td><?php /*echo $list['AerospaceDefenseEmbeddedCourse']['month'];*/?></td>-->
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
							</td>
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
<?php echo $this->Form->create('AerospaceDefenseDroneTechnology',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"aerospaceDefenseDroneTechnology")));
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
</script>
<script>
    $( function() {
		$( ".datepicker" ).datepicker({ dateFormat: 'dd-mm-yy' });    
	});
  
</script>
<script>
    $('.aerospaceDefenseDroneTechnology').addClass('active').parents('li').addClass('active')
</script>
