<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Paper
      </h1>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="breadcrumb-item"><a href="#">Research Projects</a></li>
        <li class="breadcrumb-item active">Paper</li>
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
						<?php echo $this->Form->create('DsReportPublished',array("class"=>"form-horizontal","type"=>"file",'onsubmit'=>"return addCsrfToken()"),array("url"=>array("controller"=>"Home","action"=>"researchPaper")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
                        echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"value"=>"insert"));?>

						
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Authors <span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("authors",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Authors"))?>
								<?php echo $this->Form->input("id",array("type"=>"hidden","label"=>false,'class'=>"form-control","value" => $this->request->data['Announcement']['id']));?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Title<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("title",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Title"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Stage<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("stage",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Stage"))?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Draft<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("draft",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Draft"))?>
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Baseline<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("baseline",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Baseline"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Review<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("review",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Review"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Publication<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php echo $this->Form->input("publication",array("type"=>"text","class"=>"form-control","required","label"=>false,"placeholder"=>"Publication"))?>
								
							</div>
						</div>
						<div class="form-group row">
							<label for="example-text-input" class="col-sm-4 col-form-label">Year<span class="text-danger">*</span></label>
							<div class="col-sm-8">
								<?php 
									echo $this->Form->input("year",array("type"=>"select","label"=>false,"options"=>$years_list,"class"=>"form-control",'empty'=>'Select','required','default'=>Date('Y')));?>
								
								
							</div>
						</div>
						<div class="form-group row">
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
                                if(empty($this->request->data['Announcement']['id']))
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
							<th>Authors  </th>
							<th>Title</th>
							<th>Stage</th>
							<th>Draft</th>
							<th>Baseline</th>
							<th>Review</th>
							<th>Publication</th>
							<th>Year</th>
							<th>Month</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($research_paper_list)) {

								foreach ($research_paper_list as $list) {
									$research_paper_id = $list['DsReportPublished']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['DsReportPublished']['authors'];?></td>
							<td><?php echo $list['DsReportPublished']['title'];?></td>
							
							<td><?php echo $list['DsReportPublished']['stage'];?></td>
							<td><?php echo $list['DsReportPublished']['draft'];?></td>
							<td><?php echo $list['DsReportPublished']['baseline'];?></td>
							<td><?php echo $list['DsReportPublished']['review'];?></td>
							<td><?php echo $list['DsReportPublished']['publication'];?></td>
							<td><?php echo $list['DsReportPublished']['year'];?></td>
							<td><?php echo $list['DsReportPublished']['month'];?></td>
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $research_paper_id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $research_paper_id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>

								
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
<?php echo $this->Form->create('DsReportPublished',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"researchPaper")));
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

    $('.researchPaper').addClass('active').parents('li').addClass('active');
</script>
