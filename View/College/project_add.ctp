<?php  echo $this->Html->script('check_file_type');?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
           Project
        </h1>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="breadcrumb-item active">Project</li>
            <li class="breadcrumb-item active">Project Add</li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12 col-12">

                        <?php
                        echo $this->Form->create('ProjectDetail',array("type" => "file","id"=>"projectForm"),array("url"=>array("controller"=>"College","action"=>"projectAdd", 'onsubmit'=>"return addCsrfToken()")));
                        echo $this->Form->input('csrf_token',array("type"=>"hidden",'id'=>'csrftoken',"label"=>false,'required',"class"=>"form-control rounded",'value'=>' '));  ?>
                        <div class="box">
                            <div class="box-header with-border">
								<div class="row">
									<div class="col-lg-1 col-md-1">
										<h4 class="box-title">Project</h4>
									</div>
									<div class="col-lg-2 col-md-3">
										<?php  //echo $this->Form->input("academic_year_id",array("type"=>"select","label"=>false,"options"=>$academic_years,"id"=>"academic_year_id","class"=>"form-control",'empty'=>'Select Academic Year')); ?>
									</div>
									<div class="col-lg-3 col-md-3">
										<!--<div class="pull-left error" style="display:none" > <span style="color:red">&nbsp; * Choose Academic Year</span></div>-->
									</div>
									<div class="col-lg-6 col-md-5">
										<div class="pull-right">
										<?php echo $this->Html->link('Project List',array("controller"=>"College","action"=>"projectList"),array("class"=>"btn btn-info btn-sm")); ?>
										</div>
									</div>
								</div>
                            </div>
                            <div class="box-body">
                                <div id="payroll_component_box"></div>
                                <div class="row" id="route_mapping_box" >
                                    <div class="col-lg-12">
                                        <table class="table table-bordered table-hover" id="dataTable1">
                                            <thead>
                                            <tr>
                                                <th>Project </th>
                                                <th width="20%">Sector</th>
                                                <th>Document</th>
                                                <th>Video</th>
                                                <th>Details</th>
                                               <!-- <th width="20%">
                                                    <button type="button" class="addmore btn btn-sm btn-success active waves-effect waves-light" onclick="addRow('dataTable1',<?php /*echo $project_count */?>)" ><i class="fa fa-plus"></i></button>
                                                    <button type="button" class="addmore btn btn-sm btn-danger active waves-effect waves-light" onclick="deleteRow('dataTable1')"><i class="fa fa-minus"></i></button>
                                                </th>-->
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><?php echo $this->Form->input('project_name.',array("type"=>"text","class"=>"form-control","placeholder"=>"Project Title","label"=>false)); ?></td>
                                                <td><?php echo $this->Form->input('sector_id.',array("type"=>"select","class"=>"form-control ","options"=>$sectors,"empty"=>"Select Sector","label"=>false)); ?></td>
                                                <td><?php echo $this->Form->input('project_document.',array("type"=>"file","class"=>"form-control doc_type","label"=>false)); ?></td>
                                                <td><?php echo $this->Form->input('project_video.',array("type"=>"file","id"=>"file1","class"=>"form-control video_type","label"=>false)); ?></td>
                                                <td ><?php echo $this->Form->input('details.',array("type"=>"text","class"=>"form-control","placeholder"=>"Project Description","rows"=>"2","label"=>false,)); ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="clearfix pull-right">
                                    <?php
                                    echo $this->Form->button("Cancel",array("type"=>"reset","class"=>"btn cancel btn-sm","label"=>false)).' ';
                                    echo $this->Form->button("Submit",array("type"=>"submit","class"=>"_update btn btn-danger btn-sm","label"=>false));
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end();?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

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
        $('#csrftoken').val("<?php echo $this->Session->read('CSRFTOKEN') ?>");
        var form =document.getElementById('projectForm');
        var url = $('#projectForm').attr('action');
        var academic_year_id = $('#academic_year_id').val();


            var file = document.getElementById('file1').files[0];
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
            window.location.href=window.location;

        }
        else{
            _("status").innerHTML ="Upload Failed";
        }

    }

    function errorHandler(event) {
        _("status").innerHTML = "Upload Failed";
    }

    function abortHandler(event) {
        _("status").innerHTML = "Upload Aborted";
    }

    addRow('dataTable1',<?php echo $project_count ?>);
    function addRow(tableID,project_count) {
        var table = document.getElementById(tableID);
        var rowCount = table.rows.length;
        if(rowCount+project_count>15){
           // alert('you Cannot Add more then 15 Projects')
            return;
        }
        tot_rows=15-parseInt((rowCount+project_count));
       // alert(tot_rows)
        for(j=0;j<=tot_rows;j++) {
            var rowCount = table.rows.length;
            var row = table.insertRow(rowCount);
            var colCount = table.rows[1].cells.length;
            for (var i = 0; i < colCount; i++) {
                var newcell = row.insertCell(i);
                if (i == 4) {
                    newcell.colSpan = 2;
                }
                newcell.innerHTML = table.rows[1].cells[i].innerHTML;
                switch (newcell.childNodes[0].type) {
                    case "text":
                        newcell.childNodes[0].value = "";
                        break;
                    case "checkbox":
                        newcell.childNodes[0].checked = false;
                        newcell.childNodes[0].id = i;
                    case "select-one":
                        newcell.childNodes[0].selectedIndex = 0;
                        break;
                }
            }
        }
    }
    /*function deleteRow(tableID) {
        try {
            var table = document.getElementById(tableID);
            var rowCount = table.rows.length;
            if (rowCount <= 2) {
                alert("Cannot delete all the rows.");
                return
            }
            table.deleteRow(rowCount-1);
            rowCount--;



            for (var i = 0; i < rowCount; i++) {
                var row = table.rows[i];
                var chkbox = row.cells[0].childNodes[0];
                if (null != chkbox && true == chkbox.checked) {
                    if (rowCount <= 1) {
                        alert("Cannot delete all the rows.");
                        break;
                    }
                    table.deleteRow(i);
                    rowCount--;
                    i--;
                }


            }
        } catch (e) {
            alert(e);
        }
    }*/
</script>
