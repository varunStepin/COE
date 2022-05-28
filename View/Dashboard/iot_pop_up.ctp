<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
       <?php echo ucwords(implode(' ',preg_split('/(?=[A-Z])/',$title))); ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php
            if($type=='IotStartUp'){?>
                <table width="100%" class="table table-striped example_long table-responsive table-bordered table-hover" >
                <thead class="bg-primary-gradient text-white">
                <tr>
                    <th>Sl no.</th>
                    <th>StartUp Name</th>
                    <th>Vertical </th>
                    <th>Date of Incubation </th>
                    <th>Date of Graduation</th>
                    <th>Founder Name</th>
                    <th>Founder Email</th>
                    <th>Mobile</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($list as $key=>$data){?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $data['IotStartUp']['start_up_name'] ?></td>
                        <td><?= $data['IotStartUp']['vertical'] ?></td>
                        <td class="text-nowrap"><?= ($data['IotStartUp']['date_of_incubation']!='') ? date('d-m-Y', strtotime($data['IotStartUp']['date_of_incubation'])) : "" ?></td>
                        <td class="text-nowrap"><?= ($data['IotStartUp']['date_of_graduation']!='') ? date('d-m-Y', strtotime($data['IotStartUp']['date_of_graduation'])) : "" ?></td>
                        <td><?= $data['IotStartUp']['founder_name'] ?></td>
                        <td><?= $data['IotStartUp']['founder_email'] ?></td>
                        <td><?= $data['IotStartUp']['mobile'] ?></td>
                    </tr>
                <?php }?>

                </tbody>
            </table>
            <?php }
            else if($type=='GeneratedEmployment'){?>
                <table width="100%" class="table table-striped example_long table-responsive table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name of startup</th>
                        <th>Current No. of employee</th>
                        <th>No. of internships</th>
                        <th>Names of main /full time employees</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotStartUp']['start_up_name'] ?></td>
                            <td><?= $data['GeneratedEmployment']['mobile_no'] ?></td>
                            <td><?= $data['GeneratedEmployment']['place'] ?></td>
                            <td><?= $data['GeneratedEmployment']['other_details'] ?></td>

                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotIntellectualProperty'){?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>StartUp Name</th>
                        <th>Filling Date</th>
                        <th>Grant Date</th>
                        <th>Patent No</th>
                        <th>Title</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotStartUp']['start_up_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['IotIntellectualProperty']['date_of_filling']!='') ? date('d-m-Y', strtotime($data['IotIntellectualProperty']['date_of_filling'])) : "" ?></td>

                            <td class="text-nowrap"><?= ($data['IotIntellectualProperty']['date_of_grant']!='') ? date('d-m-Y', strtotime($data['IotIntellectualProperty']['date_of_grant'])) : "" ?></td>

                            <td><?= $data['IotIntellectualProperty']['appl_patent_no'] ?></td>
                            <td><?= $data['IotIntellectualProperty']['title'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotStartupsRisedFund'){?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                   <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name </th>
                        <th>Date of Funding </th>
                        <th>Amount</th>
                        <th>Founder Name</th>
                        <th>Public Announcement Link</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotStartUp']['start_up_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['IotStartupsRisedFund']['date_of_funding']!='') ? date('d-m-Y', strtotime($data['IotStartupsRisedFund']['date_of_funding'])) : "" ?></td>
                            <td><?= $data['IotStartupsRisedFund']['amount'] ?></td>
                            <td><?= $data['IotStartupsRisedFund']['founder_name'] ?></td>
                            <td><?= $data['IotStartupsRisedFund']['public_announcement_link'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotEventWorkshop'){?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Title</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>No of Registered</th>
                        <th>No of Attended</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotEventWorkshop']['title'] ?></td>
                            <td class="text-nowrap"><?= ($data['IotEventWorkshop']['date']!='0000-00-00') ? date('d-m-Y', strtotime($data['IotEventWorkshop']['date'])) : "" ?></td>
                            <td><?= $data['IotEventWorkshop']['location'] ?></td>
                            <td><?= $data['IotEventWorkshop']['no_registered'] ?></td>
                            <td><?= $data['IotEventWorkshop']['no_attended'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotIndustryConnected'){?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Company Name</th>
                        <th>Purpose</th>
                        <th>Tech Support</th>
                        <th>Adopter</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotIndustryConnected']['company_name'] ?></td>
                            <td><?= $data['IotIndustryConnected']['purpose'] ?></td>
                            <td><?= $data['IotIndustryConnected']['tech_support'] ?></td>
                            <td><?= $data['IotIndustryConnected']['adopter'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotAcademiaConnected'){?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>College Name</th>
                        <th>Date Initiation Course</th>
                        <th>City</th>
                        <th>State</th>
                        <th>IoT Curriculum</th>
                        <th>Other</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotAcademiaConnected']['college_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['IotAcademiaConnected']['date_initiation_course']!='0000-00-00') ? date('d-m-Y', strtotime($data['IotAcademiaConnected']['date_initiation_course'])) : "" ?></td>
                            <td><?= $data['IotAcademiaConnected']['city'] ?></td>
                            <td><?= $data['IotAcademiaConnected']['state'] ?></td>
                            <td><?= $data['IotAcademiaConnected']['iot_curriculum'] ?></td>
                            <td><?= $data['IotAcademiaConnected']['other'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotDelegation'){ ?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name</th>
                        <th>Arrived From</th>
                        <th>No of People</th>
                        <th>Industry Type</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotDelegation']['name'] ?></td>
                            <td><?= $data['IotDelegation']['arrived_from'] ?></td>
                            <td><?= $data['IotDelegation']['no_of_people'] ?></td>
                            <td><?= $data['IotDelegation']['industry_type'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='IotPilotsProject'){ ?>
                <table width="100%" class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Startup Name</th>
                        <th>Date of Started</th>
                        <th>Date of End</th>
                        <th>Industry Category</th>
                        <th>Impact Expected</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($list as $key=>$data){?>
                        <tr>
                            <td><?= ++$key ?></td>
                            <td><?= $data['IotStartUp']['start_up_name'] ?></td>
                            <td class="text-nowrap"><?= ($data['IotPilotsProject']['date_of_started']!='') ? date('d-m-Y', strtotime($data['IotPilotsProject']['date_of_started'])) : "" ?></td>
                            <td class="text-nowrap"><?= ($data['IotPilotsProject']['date_of_end']!='') ? date('d-m-Y', strtotime($data['IotPilotsProject']['date_of_end'])) : "" ?></td>
                            <td><?= $data['IotPilotsProject']['industry_category'] ?></td>
                            <td><?= $data['IotPilotsProject']['impact_expected'] ?></td>

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
