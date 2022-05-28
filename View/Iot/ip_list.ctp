<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
          <h1>
              Intellectual Property
          </h1>
          <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
              <li class="breadcrumb-item active">Intellectual Property</li>
          </ol>
      </section>

    <!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-12">         
				<div class="box">
					<div class="box-header with-border">
						<?php echo $this->Html->link('Add Intellectual Property' ,array("controller"=>"Iot","action"=>"ip"), array("class"=>"btn btn-info btn-sm pull-right","escape"=>false)); ?>
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
							<th>Startup Name</th>
							<th>Filling  Date</th>
                         <!--   <th>Examination  Date</th>-->
							<th>Grant Date</th>
							<th>Geography</th>
                            <th>appl/patent no</th>

                            <th>Title</th>
                            <th>Incubation Start</th>
                           <!-- <th>Month - Year</th>-->
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=1;
							if (!empty($data_list)) {
								foreach ($data_list as $list) {
									$id = $list['IotIntellectualProperty']['id'];
						?>
						<tr>
							<td><?php echo $i++;?></td>
              <td><?php echo $list['IotIntellectualProperty']['phase'];?></td>
							<td><?php echo $list['IotStartUp']['start_up_name'];?></td>
                            <td><?php $date_filling = $list['IotIntellectualProperty']['date_of_filling'];
                                echo ($date_filling) ? date('d-m-Y',strtotime($date_filling)) : '';
                            ?></td>
                           <!-- <td><?php /*echo $list['IotIntellectualProperty']['date_of_examination'];*/?></td>-->
                            <td><?php $date_grant = $list['IotIntellectualProperty']['date_of_grant'];
                                echo ($date_grant) ? date('d-m-Y',strtotime($date_grant)) : '';
                                ?></td>
                            <td><?php echo $list['IotIntellectualProperty']['geography'];?></td>
                            <td><?php echo $list['IotIntellectualProperty']['appl_patent_no'];?></td>
                            <td><?php echo $list['IotIntellectualProperty']['title'];?></td>
                            <td><?php echo ($list['IotIntellectualProperty']['is_incubation_start'])?"Yes":"No";?></td>

                           <!-- <td><?php /*echo $list['IotIntellectualProperty']['month'].'-'.$list['IotIntellectualProperty']['year'];*/?></td>-->


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

<?php echo $this->Form->create('IotIntellectualProperty',array("url"=>array("controller" => "Iot", "action" => "ip"),"id"=>"EditDeleteForm"));
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
        $('#fieldId').val(id)
        $('#actionType').val(type)
        $('#EditDeleteForm').submit();


    }
    $('.intellectualProperty').addClass('active').parents('li').addClass('active');





</script>
