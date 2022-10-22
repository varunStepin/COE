<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5 class="box-title text-white">
        <?php echo $title;  ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <!--/********************** First Graph **********************/-->
            <?php if ($type == 'Internship' || $type == 'AdvanceCourse' || $type == 'OrientationCourse' || $type == 'StarterCourse') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Program Name</th>
                            <th>Attendee Name</th>
                            <!-- <th>Date</th> -->
                            <th>Email</th>
                            <th>Mobile Number</th>
                            <!-- <th>Duration</th> -->


                            <!-- <th>Phase</th> -->
                            <th>Venue</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) {
                            $model_1 = array_keys($list)[0];
                            $model_2 = array_keys($list)[1];
                        ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= ($type != 'StarterCourse')?$list[$model_1]['internship_program_name']:$list[$model_1]['starter_program_name']
                                ?>
                                </td>
                                <td><?= $list[$model_2]['attendee_name'] ?></td>
                                <!-- <td><?= date('d M Y', strtotime($list[$model_1]['start_date'])) . ' - ' . date('d M Y', strtotime($list[$model_1]['end_date'])) ?></td> -->
                                <td><?= $list[$model_2]['email_id'] ?></td>
                                <td><?= $list[$model_2]['contact_number'] ?></td>

                                <td><?= $list[$model_1]['venue'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }

            /********************** Second Graph **********************/
            else if ($type == 'EmbeddedCourse') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Course Name</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th><th>Phase</th> -->
                            <th>Institute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseEmbeddedCourse']['embedded_course'] ?></td>
                                <td><?= $list['ManageEmbeddedCourseAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageEmbeddedCourseAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageEmbeddedCourseAttendee']['contact_number'] ?></td>
                                <!-- <td><?= $list['AerospaceDefenseEmbeddedCourse']['duration'] ?></td> -->
                                <!-- <td><?= date('d M Y', strtotime($list['AerospaceDefenseEmbeddedCourse']['start_date'])) ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseEmbeddedCourse']['end_date'])) ?></td>
                        <td><?= $list['AerospaceDefenseEmbeddedCourse']['phase'] ?></td> -->
                                <td><?= $list['AerospaceDefenseEmbeddedCourse']['institute'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if ($type == 'TrainingProcess') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Training Name</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th><th>Phase</th> -->
                            <th>Institute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseTrainingProcess']['training_name'] ?></td>
                                <td><?= $list['ManageTrainingProcessAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageTrainingProcessAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageTrainingProcessAttendee']['contact_number'] ?></td>
                                <!-- <td><?= $list['AerospaceDefenseTrainingProcess']['duration'] ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseTrainingProcess']['start_date'])) ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseTrainingProcess']['end_date'])) ?></td>
                        <td><?= $list['AerospaceDefenseTrainingProcess']['phase'] ?></td> -->
                                <td><?= $list['AerospaceDefenseTrainingProcess']['institute'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if ($type == 'BootCamp') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Boot Camp</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th><th>Phase</th> -->
                            <th>Institute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseBootcamp']['bootcamp'] ?></td>
                                <td><?= $list['ManageBootcampAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageBootcampAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageBootcampAttendee']['contact_number'] ?></td>
                                <!-- <td><?= $list['AerospaceDefenseBootcamp']['duration'] ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseBootcamp']['start_date'])) ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseBootcamp']['end_date'])) ?></td>
                        <td><?= $list['AerospaceDefenseBootcamp']['phase'] ?></td> -->
                                <td><?= $list['AerospaceDefenseBootcamp']['institute'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if ($type == 'DroneTechnology') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Embedded Course</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Duration</th>
                        <th>Start Date</th>
                        <th>End Date</th><th>Phase</th> -->
                            <th>Institute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseDroneTechnology']['embedded_course'] ?></td>
                                <td><?= $list['ManageDroneTechnologyAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageDroneTechnologyAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageDroneTechnologyAttendee']['contact_number'] ?></td>

                                <td><?= $list['ManageDroneTechnologyAttendee']['institute_name'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>

            <?php } else if ($type == 'ValueStreamCourse') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Embedded Course</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <!-- <th>Duration</th>
                        <th>Start Date</th>
                        <th>End Date</th><th>Phase</th> -->
                            <th>Institute</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseValueStreamCourse']['embedded_course'] ?></td>
                                <td><?= $list['ManageValueStreamCourseAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageValueStreamCourseAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageValueStreamCourseAttendee']['contact_number'] ?></td>

                                <td><?= $list['ManageValueStreamCourseAttendee']['institute_name'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }

            /********************** Third Graph **********************/
            else if ($type == 'DefenseSkilling') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Skill Name</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Institute</th>
                            <!-- <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th><th>Phase</th>
                    <th>Resource Person</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseSkilling']['skill_name'] ?></td>
                                <td><?= $list['ManageSkillingAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageSkillingAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageSkillingAttendee']['contact_number'] ?></td>
                                <td><?= $list['ManageSkillingAttendee']['institute_name'] ?></td>
                                <!-- <td><?= $list['AerospaceDefenseSkilling']['duration'] ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseSkilling']['start_date'])) ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseSkilling']['end_date'])) ?></td>
                        <td><?= $list['AerospaceDefenseSkilling']['phase'] ?></td>
                        <td><?= $list['AerospaceDefenseSkilling']['resource_person'] ?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } else if ($type == 'DefenseCourse') { ?>
                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Course Name</th>
                            <th>Attendee Name</th>
                            <th>Email</th>
                            <th>Mobile No.</th>
                            <th>Institute</th>
                            <!-- <th>Duration</th>
                    <th>Start Date</th>
                    <th>End Date</th><th>Phase</th>
                    <th>Resource Person</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['AerospaceDefenseCourse']['course_name'] ?></td>
                                <td><?= $list['ManageCourseAttendee']['attendee_name'] ?></td>
                                <td><?= $list['ManageCourseAttendee']['email_id'] ?></td>
                                <td><?= $list['ManageCourseAttendee']['contact_number'] ?></td>
                                <td><?= $list['ManageCourseAttendee']['institute_name'] ?></td>
                                <!-- <td><?= $list['AerospaceDefenseCourse']['duration'] ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseCourse']['start_date'])) ?></td>
                        <td><?= date('d M Y', strtotime($list['AerospaceDefenseCourse']['end_date'])) ?></td>
                        <td><?= $list['AerospaceDefenseCourse']['phase'] ?></td>
                        <td><?= $list['AerospaceDefenseCourse']['resource_person'] ?></td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }

            /********************** Fourth Graph **********************/
            else if ($type == 'StartupFacilitation') { ?>

                <!-- <div class="row">
                    <div class="col-md-4">
                        <p><b>Company Name :</b></p>
                    </div>
                    <div class="col-md-8">
                        <?/*= $list_data['ManageStartupFacilitation']['company_name'] */ ?>
                    </div>
                    <div class="col-md-4">
                        <p><b>Company Details :</b></p>
                    </div>
                    <div class="col-md-8">
                        <?/*= $list_data['ManageStartupFacilitation']['details'] */ ?>
                    </div>
                </div>-->

                <table class="table table-striped example_long table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>Sl no.</th>
                            <th>Company Name</th>
                            <th>Phase</th>
                            <th>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($list_data as $key => $list) { ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= $list['ManageStartupFacilitation']['company_name'] ?></td>
                                <td><?= $list['ManageStartupFacilitation']['phase'] ?></td>
                                <td><?= $list['ManageStartupFacilitation']['details'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php }

            ?>
        </div>
    </div>

</div>
<div class="modal-footer modal-footer-uniform">
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
</div>
<script>
    $(function() {
        'use strict';

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
</script>