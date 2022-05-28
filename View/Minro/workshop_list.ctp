<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Minro
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">Minro</a></li>
              <li class="breadcrumb-item active">Workshops</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Workshops' ,array("controller"=>"Minro","action"=>"workshop"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
					</div>
            <!-- /.box-header -->
            <div class="box-body">
				<div class="row">
					<div class="col-sm-12 col-md-12">
						<?php echo $this->Session->flash(); ?>
					</div>
				</div>
				<div class="table-responsive">
                    <table class="table example_long table-striped table-bordered table-hover" >
					<thead>
						<tr class="bg-info">
							<th>#</th>
							<th>Phase</th>
							<th>Title</th>
							<th>Date</th>
							<th>Resource Person</th>
							<th>Location</th>
							<th>No. Registered</th>
							<th>No. Attended</th>
							<!--<th>Month-Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['MinroWorkshop']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
							<td><?php echo $list['MinroWorkshop']['phase'];?></td>
							<td><?php echo $list['MinroWorkshop']['title'];?></td>
							<td class="text-nowrap"><?php echo date('d-m-Y',strtotime($list['MinroWorkshop']['date']));?></td>
							<td><?php echo $list['MinroWorkshop']['resource_person'];?></td>
							<td><?php echo $list['MinroWorkshop']['location'];?></td>
							<td><?php echo $list['MinroWorkshop']['no_registered'];?></td>
							<td><?php echo $list['MinroWorkshop']['no_attended'];?></td>
                            <!--<td><?php /*echo $list['MinroWorkshop']['month'].'-'.$list['MinroWorkshop']['year'];*/?></td>-->

							<td>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>

							</td>
						</tr>
						<?php   }  } ?>
					</tbody>
				</table>
				</div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<?php
echo $this->Form->create('MinroWorkshop',array("url"=>array("controller" => "Minro", "action" => "workshop"),"id"=>"EditDeleteForm"));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('actionType',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
echo $this->Form->end();
?>
<script>
    function addIdToForm(id,type){

        $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        if(type=='delete'){
            if(confirm('Are you sure you want to delete?')===false)
                return;
        }
        $('#fieldId').val(id);
        $('#actionType').val(type);
        $('#EditDeleteForm').submit();


    }
    $('.MinroWorkshop').addClass('active').parents('li').addClass('active');





</script>
