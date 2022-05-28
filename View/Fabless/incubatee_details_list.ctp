<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Cohort/Selectee Details
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
              <li class="breadcrumb-item"><a href="#">Fabless</a></li>
              <li class="breadcrumb-item active"> Cohort/Selectee Details List</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">	
		<div class="col-lg-12 col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('<span> Add Cohort   </span>',array("controller"=>"Fabless","action"=>"incubateeDetails"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							<th>Cohort Type</th>
							<th>Sub Type</th>
							<th>Status</th>
							<th>Cohort Company Name</th>
							<th>Contact Person</th>
							<th>Email</th>
							<th>Mobile</th>
							<th>Website</th>
							<th>City/State</th>
							<th>Notes</th>
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
									$id = $list['IncubateeDetail']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['IncubateeDetail']['phase'];?></td>
							<td><?php echo $list['IncubateeDetail']['incubatee_type'];?></td>
							<td><?php echo $list['IncubateeDetail']['sub_type'];?></td>
							<td><?php echo $list['IncubateeDetail']['status'];?></td>
							<td><?php echo $list['IncubateeDetail']['company_name'];?></td>
							<td><?php echo $list['IncubateeDetail']['contact_person'];?></td>
							<td><?php echo $list['IncubateeDetail']['email'];?></td>
							<td><?php echo $list['IncubateeDetail']['mobile'];?></td>
							<td><?php echo $list['IncubateeDetail']['website'];?></td>
							<td><?php echo $list['IncubateeDetail']['city_state'];?></td>
							<td><?php echo $list['IncubateeDetail']['address'];?></td>
							<!--<td><?php /*echo $list['IncubateeDetail']['year'];*/?></td>
							<td><?php /*echo $list['IncubateeDetail']['month'];*/?></td>-->
							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
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

<script>
    $('.incubateeDetailsList').addClass('active').parents('li').addClass('active');
</script>

<?php echo $this->Form->create('IncubateeDetail',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"incubateeDetailsList")));
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
