<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Mentor Details List
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><i class="fa fa-dashboard"></i> <?php echo $this->Html->link('<span>Home</span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
              <li class="breadcrumb-item"><a href="#">Fabless</a></li>
              <li class="breadcrumb-item active"> Mentor Details List</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
     
      <div class="row">	
		<div class="col-lg-12 col-12">
			<div class="box">
                <div class="box-header with-border">
                    <?php echo $this->Html->link('<span> Add Mentor Details  </span>',array("controller"=>"Fabless","action"=>"mentorDetails"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
                </div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead style="font-size:15px; font-weight:bold;">
						<tr class="bg-info">
							<th>#</th>
                            <th>Phase</th>
							<th>Mentor Group</th>
							<th>Mentor Interests</th>
							<th>Status</th>
							<th>Mentor Company Name</th>
							<th>Mentor Name</th>
                            <th>Gender</th>
							<th>Email</th>
							<th>Address</th>
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
									$id = $list['MentorDetail']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MentorDetail']['phase'];?></td>
							<td><?php echo $list['MentorDetail']['mentor_group'];?></td>
							<td><?php echo $list['MentorDetail']['mentor_interests'];?></td>
							<td><?php echo $list['MentorDetail']['status'];?></td>
							<td><?php echo $list['MentorDetail']['mentor_company_name'];?></td>
							<td><?php echo $list['MentorDetail']['mentor_name'];?></td>
                            <td><?php echo $list['MentorDetail']['gender'];?></td>
							<td><?php echo $list['MentorDetail']['email'];?></td>
							<td><?php echo $list['MentorDetail']['address'];?></td>
							<!--<td><?php /*echo $list['MentorDetail']['year'];*/?></td>
							<td><?php /*echo $list['MentorDetail']['month'];*/?></td>-->
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
    $('.mentorDetailsList').addClass('active').parents('li').addClass('active');
</script>

<?php echo $this->Form->create('MentorDetail',array("id"=>"EditDeleteForm","type"=>"file",),array("url"=>array("controller"=>"Home","action"=>"mentorDetails")));
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
