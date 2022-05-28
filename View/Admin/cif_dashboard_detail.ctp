<div class="modal-header bg-info  font-size-30">
    <h5 class="box-title ">
        <?= $queryString['type'] . ' Details Of Year ' . $queryString['year'] ?>
    </h5>
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">
        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php if ($queryString['type'] == 'Events') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Event Type</th>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Speakers</th>
                            <th>Total No of Participants</th>
                            <th>View Participants</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $list) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $list['CifRoundtable']['year']; ?></td>
                                <td><?php echo $list['CifRoundtable']['event_type']; ?></td>
                                <td><?php echo $list['CifRoundtable']['name']; ?></td>
                                <td class="text-nowrap"><?php echo date('d-m-Y', strtotime($list['CifRoundtable']['date'])); ?></td>
                                <td><?php echo $list['CifRoundtable']['speaker']; ?></td>
                                <td><?php echo $list['CifRoundtable']['no_participant']; ?></td>
                                  <td><a href="#" onclick="loadParticipant(<?php echo $list['CifRoundtable']['id']; ?>,'CifRoundtableParticipant')"><span>View Participants</span></a></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php }  ?>

            <?php if ($queryString['type'] == 'Publicity Mentions') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Media Type</th>
                            <th>Media Name</th>
                            <th>Published Date</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $manage) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $manage['CifPublicityMention']['year']; ?></td>
                                <td><?php echo $manage['CifPublicityMention']['media_type']; ?></td>
                                <td><?php echo $manage['CifPublicityMention']['media_name']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($manage['CifPublicityMention']['published_date'])); ?></td>
                                <td><?php if ($manage['CifPublicityMention']['image'] != "") { ?>
                                        <a href="<?php echo $this->webroot; ?>cif_publicity_mention/<?php echo $manage['CifPublicityMention']['image']; ?>" target="_blank">View</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($queryString['type'] == 'Startups Enrolled') { ?>
            <div class="table-responsive">
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Startup Name</th>
                            <th>Incubation Date</th>
                            <th>Graduation Date</th>
                            <th>Founder</th>
                            <th>Email</th>
                            <th>url</th>
                            <th># of emp</th>
                            <th># of women emp</th>
                            <th>Is woman founder</th>
                            <th>Contact Number</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $list) {  ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $list['CifStartup']['year']; ?></td>
                                <td><?php echo $list['CifStartup']['startup_name']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($list['CifStartup']['incubation_date'])); ?></td>
                                <td><?php echo date('d-m-Y', strtotime($list['CifStartup']['graduation_date'])); ?></td>
                                <td><?php echo $list['CifStartup']['founder_name']; ?></td>
                                <td><?php echo $list['CifStartup']['founder_email']; ?></td>
                                <td><?php echo $list['CifStartup']['url']; ?></td>
                                <td><?php echo $list['CifStartup']['no_employees']; ?></td>
                                <td><?php echo $list['CifStartup']['no_employees_women']; ?></td>
                                <td><?php echo ($list['CifStartup']['is_women_founder']) ? "Yes" : "No"; ?></td>
                                <td><?php echo $list['CifStartup']['mobile']; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
                </div>
            <?php } ?>

            <?php if ($queryString['type'] == 'Fund Raised By Startup') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Startup Name</th>
                            <th>Total Fund Raised in INR(Cr)</th>
                            <th>Fundinding Agency</th>
                            <th>Releated Documents</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $manage) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $manage['CifStartupRisedFund']['year']; ?></td>
                                <td><?php echo $manage['CifStartup']['startup_name']; ?></td>
                                <td><?php echo $manage['CifStartupRisedFund']['amount']; ?></td>
                                <td><?php echo $manage['CifStartupRisedFund']['funding_agency']; ?></td>
                                <td><?php if ($manage['CifStartupRisedFund']['file'] != "") { ?>
                                        <a href="<?php echo $this->webroot; ?>cif_startup_raised_fund/<?php echo $manage['CifStartupRisedFund']['file']; ?>" target="_blank">View</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($queryString['type'] == 'Gender Diversity') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Gender Diversity Name</th>
                            <th>Participant Name</th>
                            <th>Gender</th>
                            <th>Contact number</th>
                            <th>Email Id</th>
                            <th>Organization</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $list) {
                        ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $list['CifGenderDiversity']['event_name']; ?></td>
                                <td><?php echo $list['CifGenderDiversityParticipant']['participant_name']; ?></td>
                                <td><?php echo $list['CifGenderDiversityParticipant']['gender']; ?></td>
                                <td><?php echo $list['CifGenderDiversityParticipant']['contact_number']; ?></td>
                                <td><?php echo $list['CifGenderDiversityParticipant']['email']; ?></td>
                                <td><?php echo $list['CifGenderDiversityParticipant']['organization']; ?></td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($queryString['type'] == 'External Event Participants') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>External Event Participant Name</th>
                            <th>Participant Name</th>
                            <th>Gender</th>
                            <th>Contact number</th>
                            <th>Email Id</th>
                            <th>Organization</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $list) {    ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $list['CifExternalEvent']['event_name']; ?></td>
                                <td><?php echo $list['CifExternalEventParticipant']['participant_name']; ?></td>
                                <td><?php echo $list['CifExternalEventParticipant']['gender']; ?></td>
                                <td><?php echo $list['CifExternalEventParticipant']['contact_number']; ?></td>
                                <td><?php echo $list['CifExternalEventParticipant']['email']; ?></td>
                                <td><?php echo $list['CifExternalEventParticipant']['organization']; ?></td>

                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($queryString['type'] == 'Connects') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Startup Name</th>
                            <th>Connect Program Name</th>
                            <th>Name of Investor/ Industry</th>
                            <th>Image</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $manage) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $manage['CifConnect']['year']; ?></td>
                                <td><?php echo $manage['CifConnect']['startup_name']; ?></td>
                                <td><?php echo $manage['CifConnect']['connect_program_name']; ?></td>
                                <td><?php echo $manage['CifConnect']['investor_name']; ?></td>
                                <td><?php if ($manage['CifConnect']['image'] != "") { ?>
                                        <a href="<?php echo $this->webroot; ?>cif_connect/<?php echo $manage['CifConnect']['image']; ?>" target="_blank">View</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            <?php } ?>

            <?php if ($queryString['type'] == 'Customer Satisfaction') { ?>
                <table class="table example_long table-striped table-bordered table-hover">
                    <thead class="bg-primary-gradient text-white">
                        <tr>
                            <th>#</th>
                            <th>Year</th>
                            <th>Feedback Conducted Date</th>
                            <th>No of Feedback Received</th>
                            <th>Satifaction Percentage</th>
                            <th>Feedback Reports</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($table_list as $manage) { ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $manage['CifCustomerSatisfaction']['year']; ?></td>
                                <td><?php echo date('d-m-Y', strtotime($manage['CifCustomerSatisfaction']['feedback_date'])); ?></td>
                                <td><?php echo $manage['CifCustomerSatisfaction']['no_feedback']; ?></td>
                                <td><?php echo $manage['CifCustomerSatisfaction']['satisfaction_pecentage']; ?>%</td>
                                <td><?php if ($manage['CifCustomerSatisfaction']['file'] != "") { ?>
                                        <a href="<?php echo $this->webroot; ?>cif_customer_satisfaction/<?php echo $manage['CifCustomerSatisfaction']['file']; ?>" target="_blank">View</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php
                        } ?>
                    </tbody>
                </table>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal-footer modal-footer-uniform">
    <button type="button" class="btn btn-bold btn-pure btn-info btn-sm float-right" data-dismiss="modal">Close</button>
</div>


<div class="modal center-modal fade" id="chartDetailModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="chartDetailModalContent">


        </div>
    </div>
</div>
<script>
 $(function() {
        'use strict'

        $('.model_slim_scroll').slimScroll({
            height: '300px'
        });
        $('body').tooltip({
            selector: '[data-toggle="tooltip"]'
        });
    });
    function loadParticipant(id,type){
        //console.log(id,type);
        let url = encodeURI('<?php echo Router::url(array("controller" => "Admin", "action" =>"viewParticipant")); ?>?id='+id+'&type='+type);
        $('#chartDetailModalContent').load(url, function() {
            $('#chartDetailModal').modal({
                show: true
            });
        });
    }
</script>