<?= $this->element('cssJs/data_tables'); ?>
<?php  echo $this->Html->script('check_file_type');?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Project List
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Project</li>
            <li class="breadcrumb-item active">Project List</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-12">
                        <div class="box">
                            <div class="box-header with-border">
                                <h4 class="box-title">Project List</h4>
                                <div class="pull-right">
                                    <?php echo $this->Html->link('Project',array("controller"=>"College","action"=>"projectAdd"),array("class"=>"btn btn-info btn-sm")); ?>
                                </div>
                            </div>
                            <div class="box-body">
                                <div id="payroll_component_box"></div>
                                <div class="row" id="route_mapping_box" >
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table id="example_long" class="table example_long table-bordered table-hover table-striped" >
                                                <thead class="bg-info">
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Project Id</th>
                                                    <th>Project </th>
                                                    <th>Sector </th>
                                                    <th width="5%">Academic Year </th>
                                                    <th>Document</th>
                                                    <th>Video</th>
                                                    <th>Details</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $i=0;
                                                foreach($project_list as $item){
                                                    $id=$item['ProjectDetail']['id'];
                                                    ?>
													 <textarea id="academic_year<?php echo $id ?>" hidden><?php echo $item['AcademicYear']['id']; ?></textarea>
                                                    <textarea id="project_sector<?php echo $id ?>" hidden><?php echo $item['Sector']['id']; ?></textarea>
                                                    <textarea id="project_details_description<?php echo $id ?>" hidden><?php echo $item['ProjectDetail']['details']; ?></textarea>
                                                    <textarea id="project_document<?php echo $id ?>" hidden><?php echo $item['ProjectDetail']['project_document']; ?></textarea>
                                                    <textarea id="project_video<?php echo $id ?>" hidden><?php echo $item['ProjectDetail']['project_video']; ?></textarea>
                                                    <tr>
                                                        <td><?php echo ++$i; ?></td>
                                                        <td id="project_id<?php echo $id ?>"><?php echo $item['ProjectDetail']['project_id']; ?></td>
                                                        <td id="project_name<?php echo $id ?>"><?php echo $item['ProjectDetail']['project_name']; ?></td>
                                                        <td ><?php echo $item['Sector']['sector']; ?></td>
                                                        <td ><?php echo $item['AcademicYear']['academic_year']; ?></td>
                                                        <td>
                                                            <?php  if ($item['ProjectDetail']['project_document'] && file_exists ( WWW_ROOT."/files/Project/Document/".$item['ProjectDetail']['project_document'])){ ?>
                                                                <a href="<?php echo $this->webroot.'files/Project/Document/'.$item['ProjectDetail']['project_document']?>" target="_blank"><i  class="ti-eye" data-toggle="tooltip" data-original-title="View"></i> </a>
                                                            <?php  } ?>
                                                        </td>
                                                        <td>
                                                            <?php  if ($item['ProjectDetail']['project_video'] && file_exists ( WWW_ROOT."/files/Project/Video/".$item['ProjectDetail']['project_video'])){ ?>
                                                                <a href="<?php echo $this->webroot.'files/Project/Video/'.$item['ProjectDetail']['project_video']?>" target="_blank"><i  class="ti-eye" data-toggle="tooltip" data-original-title="View"></i> </a>
                                                            <?php  } ?>
                                                        </td>
                                                        <td width="20%">
                                                            <a  data-toggle="tooltip" data-original-title="<?php echo $item['ProjectDetail']['details']; ?> "><span ></span><?php echo  substr($item['ProjectDetail']['details'], 0, 50); echo strlen($item['ProjectDetail']['details'])>51 ? "  ...":""; ?> </a> </td>
                                                        <td class="text-nowrap">
                                                            <?php if(empty($item['AssignJudge']['id'])){ ?>
                                                                <a onclick="projectEdit(<?php echo $id ?>)" ><i  class="ti-pencil " data-toggle="tooltip" data-original-title="Edit"></i></a>
                                                               <!-- <a href="#" onclick="addIdToForm(<?php // echo $id?>,'delete','<?php// echo $item['ProjectDetail']['project_document']; ?>','<?php // echo $item['ProjectDetail']['project_video']; ?>')"><i style="font-size:12px;" class="glyphicon glyphicon-trash"></i></a> -->
                                                            <?php } ?>
                                                        </td>
                                                    </tr>
                                                <?php   }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<div class="modal fade" id="projectEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header  bg-info">
                <h5 class="modal-title" id="exampleModalCenterTitle">Project Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
            echo $this->Form->create('ProjectDetail',array("url"=>array("controller"=>"College","action"=>"projectEdit"),'id'=>'projectForm','enctype'=>'multipart/form-data', 'onsubmit'=>"return addCsrfToken()"));
            echo $this->Form->input('id',array("type"=>"hidden",'id'=>'id',"class"=>"form-control","label"=>false));
            echo $this->Form->input('project_id',array("type"=>"hidden",'id'=>'projectId',"class"=>"form-control","label"=>false));
            echo $this->Form->input('old_project_document',array("type"=>"hidden",'id'=>'old_document',"class"=>"form-control","label"=>false));
            echo $this->Form->input('old_project_video',array("type"=>"hidden",'id'=>'old_video',"class"=>"form-control","label"=>false));
            echo $this->Form->input('academic_year_id',array("type"=>"hidden",'id'=>'academic_year_id',"class"=>"form-control","label"=>false));
            echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));
            ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10" >
                        <div class="form-group">
                            <label for="example_input_full_name">Project </label>
                            <?php echo $this->Form->input('project_name',array("type"=>"text",'id'=>'projectTitle',"class"=>"form-control","required","placeholder"=>"Project Title","label"=>false)); ?>
                        </div>
                     <!--   <div class="form-group">
                            <label for="example_input_full_name">Academic Year </label>
							<?php /*// echo $this->Form->input("academic_year_id",array("type"=>"select","label"=>false,"options"=>$academic_years,"required","id"=>"academic_year_id","class"=>"form-control",'empty'=>'Select Academic Year')); */?>
						</div>-->
						<div class="form-group">
                            <label for="example_input_full_name">Sector </label>
							<?php  echo $this->Form->input("sector_id",array("type"=>"select","label"=>false,"options"=>$sectors,"required","id"=>"project_sector","class"=>"form-control",'empty'=>'Select Sector ')); ?>
						</div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="to_time">Document</label>
                                <?php echo $this->Form->input('project_document',array("type"=>"file","class"=>"form-control doc_type","label"=>false));  ?>

                            </div>
                        </div>
                        <div class="bootstrap-timepicker">
                            <div class="form-group">
                                <label for="to_time">Video</label>
                                <?php echo $this->Form->input('project_video',array("type"=>"file","class"=>"form-control video_type","label"=>false)); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="example_input_full_name">Reason</label>
                            <?php echo $this->Form->input('details',array("type"=>"text",'id'=>'projectDetails',"class"=>"form-control","placeholder"=>"Project Description","rows"=>"2","label"=>false)); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer  pull-right">
                <div class="clearfix">
                    <?php echo $this->Form->button("Update",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false)); ?>
                </div>
            </div>
            <?php echo $this->Form->end(); ?>
        </div>
    </div>
</div>

<?php
echo $this->Form->create('ProjectDetail',array("url"=>array("controller"=>"College","action"=>"projectDelete"),"id"=>"EditDeleteForm"));
echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftokenEdit',"label"=>false,'required','value'=>' '));
echo $this->Form->input('id',array("type"=>"hidden","label"=>false,'required',"id"=>"fieldId"));
echo $this->Form->input('type',array("type"=>"hidden","label"=>false,'required',"id"=>"actionType"));
echo $this->Form->input('project_document',array("type"=>"hidden","label"=>false,'required',"id"=>"projectDocument"));
echo $this->Form->input('project_video',array("type"=>"hidden","label"=>false,'required',"id"=>"projectVideo"));
echo $this->Form->end();
?>
<script>
    function projectEdit(id) {
        $('#id').val(id);
        $('#projectId').val($('#project_id'+id).html());
        $('#projectTitle').val($('#project_name'+id).html());
        $('#old_document').val($('#project_document'+id).html());
        $('#old_video').val($('#project_video'+id).html());
        $('#projectDetails').val($('#project_details_description'+id).html());
        $('#academic_year_id').val($('#academic_year'+id).html());
		$('#project_sector').val($('#project_sector'+id).html());
        $('#projectEditModal').modal({show:true});
    }
</script>
<div class="modal modal-fill fade  " data-backdrop="false" id="modal-fill" tabindex="-1" style="display: '';  padding-right: 17px;">
    <div class="modal-dialog">



        <progress id="progressBar" value="0" max="100" style="width:300px;"></progress>
        <h3 style="color:white;" id="status"></h3>
        <p id="loaded_n_total"></p>


    </div>
</div>
<script>
    function _(el) {
        return document.getElementById(el);
    }
    $('#projectForm').submit(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.
        //alert('hai')
        var form =document.getElementById('projectForm');
        var url = $('#projectForm').attr('action');



      //  var file = document.getElementById('file1').files[0];
        // alert(file.name+" | "+file.size+" | "+file.type);
        var formData = new FormData(form);
        //formdata.append("file1", file);
        // console.log(formData)
        $('#modal-fill').modal({show:true});
        var ajax = new XMLHttpRequest();
        ajax.upload.addEventListener("progress", progressHandler, false);
        ajax.addEventListener("load", completeHandler, false);
        ajax.addEventListener("error", errorHandler, false);
        ajax.addEventListener("abort", abortHandler, false);
        ajax.open("POST", url);
        ajax.send(formData);
    });

    function progressHandler(event) {
        _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
        var percent = (event.loaded / event.total) * 100;
        _("progressBar").value = Math.round(percent);
        _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
    }

    function completeHandler(event) {
        _("progressBar").value = 0; //wil clear progress bar after successful upload
        if(event.target.responseText=="success"){
            _("status").innerHTML ="Projects saved Successfully";
            location.reload();

        }
        else{
            _("status").innerHTML ="Invalid Form Data";
        }
    }

    function errorHandler(event) {
        _("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event) {
        _("status").innerHTML = "Upload Aborted";
    }



</script>
<script>
    function addIdToForm(id,type,doc,video){
        $('#csrftokenEdit').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        if(type=='delete'){
            if(confirm('Are you sure you want to delete?')===false)
                return;
        }
        $('#fieldId').val(id);
        $('#actionType').val(type);
        $('#projectDocument').val(doc);
        $('#projectVideo').val(video);
        $('#EditDeleteForm').submit();
    }
</script>
