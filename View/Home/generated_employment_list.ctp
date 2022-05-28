<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Employment Generation List
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">Employment Generation List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('<span> Add Employee </span>',array("controller"=>"Home","action"=>"generatedEmployment"),array("escape"=>false,"class"=>'btn btn-info btn-sm pull-right'));?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover" >
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Name of startup</th>
                                        <th>Current No. of employee</th>
                                        <th>No. of internships</th>
                                        <th>Incubation Date</th>
                                        <th>Names of main /full time employees</th>
                                        <!--<th>Month-Year</th>-->
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            $i=1;
                                            if (!empty($employee_list)) {
                                            
                                            	foreach ($employee_list as $list) {
                                            		$id = $list['GeneratedEmployment']['id'];
                                            ?>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $list['IotStartUp']['start_up_name'];?><br><?php echo $list['GeneratedEmployment']['last_name'];?></td>
                                        <td><?php echo $list['GeneratedEmployment']['mobile_no'];?></td>
                                        <td><?php echo $list['GeneratedEmployment']['place'];?></td>
                                        <td><?php echo $list['GeneratedEmployment']['email_id'];?> </td>
                                        <td><?php echo $list['GeneratedEmployment']['other_details']; ?></td>

                                       <!-- <td><?php /*echo $list['GeneratedEmployment']['month']."-".$list['GeneratedEmployment']['year'];*/?></td>-->
                                        <td>
                                            <a href="#" onclick="addIdToForm(<?php echo $id?>,'delete')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a>
                                            <a href="#" onclick="addIdToForm(<?php echo $id?>,'edit')"><i style="font-size:12px;" class="glyphicon glyphicon-edit"></i></i></a>
                                        </td>
                                    </tr>
                                 <?php } } ?>
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
<?php echo $this->Form->create('GeneratedEmployment',array("url"=>array("controller"=>"Home","action"=>"generatedEmployment"),"id"=>"EditDeleteForm"));
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

    $('.generatedEmployment').addClass('active').parents('li').addClass('active');
</script>
