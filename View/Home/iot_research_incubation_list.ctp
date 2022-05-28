<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            IOT Research Incubated List
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">IOT Research Incubated List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('<span> Add Iot Research Incubation </span>',array("controller"=>"Home","action"=>"iotResearchIncubation"),array("escape"=>false,"class"=>'btn btn-primary pull-right'));?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover" >
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Startup</th>
                                        <th>Target Year</th>
                                        <th>Target</th>
                                        <th>Team Detail</th>
                                        <th>Project Handeled Type</th>
                                        <th>Current Status</th>
                                        <th>Incubation Start Date</th>
                                        <th>Incubation Outcome</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            $i=1;
                                            if (!empty($iot_research_list)) {
                                            
                                            	foreach ($iot_research_list as $list) {
                                            		$id = $list['IotResearchIncubation']['id'];
                                            ?>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $list['IotResearchIncubation']['name_of_the_startup'];?></td>
                                        <td><?php echo $list['IotResearchIncubation']['target_year'];?></td>
                                        <td><?php echo $list['IotResearchIncubation']['target'];?></td>
                                        <td><a  data-toggle="tooltip" data-original-title="<?php echo $list['IotResearchIncubation']['detail_of_team']; ?> "><span ></span><?php echo  substr($list['IotResearchIncubation']['detail_of_team'], 0, 20); echo strlen($list['IotResearchIncubation']['detail_of_team'])>21 ? "  ...":""; ?> </a></td>
                                        <td><?php echo $list['IotResearchIncubation']['type_project_handled'];?></td>
                                        <td><?php echo $list['IotResearchIncubation']['current_status'];?></td>
                                        <td><?php echo date('d-m-Y',strtotime($list['IotResearchIncubation']['incubation_start_date']));?></td>
                                        <td><?php echo $list['IotResearchIncubation']['incubation_outcome'];?></td>
                                        <td><?php echo $list['IotResearchIncubation']['year'];?></td>
                                        <td><?php echo $list['IotResearchIncubation']['month'];?></td>
                                        <td>
                                            <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                            <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
                                        </td>
                                    </tr>
                                    <?php } 
                                        }
                                        ?>
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
<?php echo $this->Form->create('IotResearchIncubation',array("url"=>array("controller"=>"Home","action"=>"iotResearchIncubation"),"id"=>"EditDeleteForm"));
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
</script>
<script>

    $('.iotResearchIncubation').addClass('active').parents('li').addClass('active');
</script>
