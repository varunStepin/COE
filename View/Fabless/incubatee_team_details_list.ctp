<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Incubatee Team Details List 
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
              <li class="breadcrumb-item"><a href="#">Fabless</a></li>
              <li class="breadcrumb-item active"> Incubatee Team Details List</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">	
		<div class="col-lg-12 col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('<span> Add Incubatee Team Details  </span>',array("controller"=>"Fabless","action"=>"incubateeTeamDetails"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
							<th>Team Member Name</th>
							<th>Gender</th>
							<th>Designation</th>
							<th>Qualification</th>
							<th>Email</th>
							<th>Contact Person</th>
							<th>Address</th>
							<th>City Name</th>
							<th>Date of Joining</th>
							<th>Date of Birth</th>
							<!--<th>Month</th>
							<th>Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

						<?php 
							$i=1;
							if (!empty($manage_list)) {

								foreach ($manage_list as $list) {
									$id = $list['IncubateeTeamDetail']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['IncubateeTeamDetail']['team_member_name'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['gender'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['designation'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['qualification'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['email'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['contact_person'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['address'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['city_name'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['date_of_joining'];?></td>
							<td><?php echo $list['IncubateeTeamDetail']['date_of_birth'];?></td>
							<!--<td><?php /*echo $list['IncubateeTeamDetail']['year'];*/?></td>
							<td><?php /*echo $list['IncubateeTeamDetail']['month'];*/?></td>-->
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
    $('.incubateeTeamDetailsList').addClass('active').parents('li').addClass('active');
</script>

<?php echo $this->Form->create('IncubateeTeamDetail',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Fabless","action"=>"incubateeTeamDetailsList")));
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
