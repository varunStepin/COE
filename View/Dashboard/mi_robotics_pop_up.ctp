<div class="modal-header bg-success-gradient   font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
       <?php echo ucwords(implode(' ',preg_split('/(?=[A-Z])/',$title))); ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php
            if($type=='CapacityBuilding'){?>
            <table class="table table-striped example_long table-bordered table-hover" >
                 <thead class="bg-primary-gradient text-white">
                <tr>
                    <th>Sl no.</th>
                    <th>Program Name </th>
                    <th>Date </th>
                    <th>Program Details</th>
                    <th>Program Type</th>

                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $key=>$data){?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $data['MiPrograms']['program_name'] ?></td>
                        <td class="text-nowrap"><?= ($data['MiPrograms']['program_date']!='0000-00-00') ? date('d-m-Y', strtotime($data['MiPrograms']['program_date'])) : "" ?></td>
                        <td><?= $data['MiPrograms']['program_details'] ?></td>
                        <td><?= $data['MiPrograms']['program_type'] ?></td>
                    </tr>
                <?php }?>

                </tbody>
            </table>
            <?php }
            else if($type=='InternationalConferences'){?>
                <table class="table table-striped example_long table-responsive table-bordered table-hover" >
                     <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Conference Name </th>
                        <th>Date </th>
                        <th>Conference Details</th>
                        <th>Workshops</th>
                        <th>Paper Presentations</th>
                        <th>Next Year Plan</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['MiInternationalConferences']['conference_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['MiInternationalConferences']['conference_date']!='0000-00-00') ? date('d-m-Y', strtotime($data['MiInternationalConferences']['conference_date'])) : "" ?></td>
                            <td><?= $data['MiInternationalConferences']['conference_details'] ?></td>
                            <td><?= $data['MiInternationalConferences']['workshops'] ?></td>
                            <td><?= $data['MiInternationalConferences']['paper_presentations'] ?></td>
                            <td><?= $data['MiInternationalConferences']['plan_for_next_year_conference'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='StartupConferences'){?>
                <table class="table table-striped example_long table-responsive table-bordered table-hover" >
                     <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Conference Name </th>
                        <th>Date </th>
                        <th>Conference Details</th>
                        <th>Workshops</th>
                        <th>Paper Presentations</th>
                        <th>Next Year Plan</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['MiStartupConferences']['conference_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['MiStartupConferences']['conference_date']!='0000-00-00') ? date('d-m-Y', strtotime($data['MiStartupConferences']['conference_date'])) : "" ?></td>
                            <td><?= $data['MiStartupConferences']['conference_details'] ?></td>
                            <td><?= $data['MiStartupConferences']['workshops'] ?></td>
                            <td><?= $data['MiStartupConferences']['paper_presentations'] ?></td>
                            <td><?= $data['MiStartupConferences']['plan_for_next_year_conference'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='GovtOfficialTraining'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                     <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>Organization Name </th>
                        <th>Organization Details </th>
                        <th>Department</th>
                        <th>Mobile</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['MiOfficials']['name'] ?></td>
                            <td><?= $data['MiOfficials']['organization_name'] ?></td>
                            <td><?= $data['MiOfficials']['organization_details'] ?></td>
                            <td><?= $data['MiOfficials']['department'] ?></td>
                            <td><?= $data['MiOfficials']['mobile'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='StudentEnrollment'){?>
                <table class="table table-striped example_long table-responsive table-bordered table-hover" >
                     <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>City</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Branch</th>
                        <th>Collage Detail</th>
                        <th>Student Type</th>
                        <th>Thesis Detail</th>
                        <th>Thesis Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['MiStudentEnrollment']['name'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['city'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['mobile'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['email'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['branch'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['clg_details'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['student_type'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['thesis_details'] ?></td>
                            <td><?= $data['MiStudentEnrollment']['thesis_status'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }

            else if($type=='Patent'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                     <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name </th>
                        <th>Patent Id</th>
                        <th>Complete Details</th>
                        <th>Belongs To</th>
                        <th>Status</th>
                        <th>Mobile</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['MiPatent']['name'] ?></td>
                            <td><?= $data['MiPatent']['patent_id'] ?></td>
                            <td><?= $data['MiPatent']['complete_details'] ?></td>
                            <td><?= $data['MiPatent']['belongs_to'] ?></td>
                            <td><?= $data['MiPatent']['status'] ?></td>
                            <td><?= $data['MiPatent']['mobile'] ?></td>
                            <td><?= $data['MiPatent']['email'] ?></td>

                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }


            ?>


        </div>
    </div>

</div>
<div class="modal-footer modal-footer-uniform">
    <!--<button type="button" class="btn btn-bold btn-pure btn-info  float-right" onclick="upcoming_birthday();">Upcoming</button>-->
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
</div>
<script>
    $(function () {
        'use strict'

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
</script>
