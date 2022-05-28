<!-- Content Wrapper. Contains page content -->
<?= $this->element('cssJs/data_tables'); ?>
<?= $this->element('cssJs/advance_elements'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            White Paper List
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-dashboard"></i><?php echo $this->Html->link('<span>Home  </span>',array("controller"=>"Admin","action"=>"dashboard"),array("escape"=>false));?></li>
            <li class="breadcrumb-item"><a href="#">IOT by NASSCOM</a></li>
            <li class="breadcrumb-item active">White Paper List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12 col-12">
                <!-- Basic Forms -->
                <div class="box">
                    <div class="box-header with-border">
                        <?php echo $this->Html->link('<span> Add White Paper </span>',array("controller"=>"Home","action"=>"whitePaper"),array("escape"=>false,"class"=>'btn btn-primary pull-right'));?>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table example_long table-striped table-bordered table-hover" >
                                <thead style="font-size:15px; font-weight:bold;">
                                    <tr class="bg-info">
                                        <th>#</th>
                                        <th>Title of Paper</th>
                                        <th>Topic of the Paper</th>
                                        <th>Author Name</th>
                                        <th>Author Mail Id</th>
                                        <th>Paper Published Status</th>
                                        <th>published Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php 
                                            $i=1;
                                            if (!empty($paper_list)) {
                                            
                                            	foreach ($paper_list as $list) {
                                            		$id = $list['WhitePaper']['id'];
                                            ?>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo $list['WhitePaper']['title_of_the_paper'];?></td>
                                        <td><?php echo $list['WhitePaper']['paper_topic'];?></td>
                                        <td><?php echo $list['WhitePaper']['author_name'];?></td>
                                        <td><?php echo $list['WhitePaper']['author_mail_id']; ?></td>
                                        <td><?php echo $list['WhitePaper']['published_status'];?></td>
                                        <td><?php echo date('d-m-Y',strtotime($list['WhitePaper']['published_date']));?></td>
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
<?php echo $this->Form->create('WhitePaper',array("url"=>array("controller"=>"Home","action"=>"whitePaper"),"id"=>"EditDeleteForm"));
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

    $('.whitePaper').addClass('active').parents('li').addClass('active');
</script>
