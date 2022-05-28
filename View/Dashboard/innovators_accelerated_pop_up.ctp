<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
    <h5  class="box-title text-white">
       <?php echo $title;  ?>
    </h5>
    <!-- <i class="ti-printer font-size-18 mr-12" style="padding-right: 20px; cursor: pointer;" onclick="printTotEmp();"></i>-->
</div>
<div class="modal-body ">
    <div class="table-wrapper-scroll-y">

        <div class="table-responsive model_slim_scroll" style="height: 500px">
            <?php if($type=='DsAiVirtualAccStartup'){?>
            <table class="table table-striped example_long table-bordered table-hover" >
                <thead class="bg-primary-gradient text-white">
                <tr>
                    <th>Sl no.</th>
                    <th>Startup Name </th>
                    <th>Incubation Date </th>
                    <th>Contact Email</th>
                    <th>No of Employees</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($dsAiVirtualAccStartup as $key=>$list){?>
                    <tr>
                        <td><?= ++$key ?></td>
                        <td><?= $list['DsAiVirtualAccStartup']['start_up_name'] ?></td>
                        <td><?= $list['DsAiVirtualAccStartup']['date_of_incubation'] ?></td>
                        <td><?= $list['DsAiVirtualAccStartup']['founder_email'] ?></td>
                        <td><?= $list['DsAiVirtualAccStartup']['no_employees'] ?></td>
                    </tr>

                <?php }?>

                </tbody>
            </table>
            <?php }
			else if($type=='DsAiPhyAccStartup'){?>
				<table class="table table-striped example_long table-bordered table-hover" >
					<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Startup Name </th>
						<th>Incubation Date </th>
						<th>Contact Email</th>
						<th>No of Employees</th>
					</tr>
					</thead>
					<tbody>
					<?php foreach($dsAiPhyAccStartup as $key=>$list){?>
						<tr>
							<td><?= ++$key ?></td>
							<td><?= $list['DsAiPhyAccStartup']['start_up_name'] ?></td>
							<td><?= $list['DsAiPhyAccStartup']['date_of_incubation'] ?></td>
							<td><?= $list['DsAiPhyAccStartup']['founder_email'] ?></td>
							<td><?= $list['DsAiPhyAccStartup']['no_employees'] ?></td>
						</tr>

					<?php }?>

					</tbody>
				</table>
				<?php }


            else if($type=='ReportPublished'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic Covered </th>
                        <th>Research Partner</th>
                        <th>Published Date</th>
                        <th>Downloads</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($research_paper_list as $item){?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?= $item['DsReportPublished']['topic_covered'] ?></td>
                            <td><?= $item['DsReportPublished']['research_partner'] ?></td>
                            <td><?= $item['DsReportPublished']['published_date'] ?></td>
                            <td><?= $item['DsReportPublished']['downloads'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }
            else if($type=='ReportProcess'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic Covered </th>
                        <th>Research Partner</th>
                        <th>Published Date</th>
                        <th>Downloads</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($ReportProcess_list as $item){?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?= $item['DsReportProcess']['topic_covered'] ?></td>
                            <td><?= $item['DsReportProcess']['research_partner'] ?></td>
                            <td><?= $item['DsReportProcess']['published_date'] ?></td>
                            <td><?= $item['DsReportProcess']['downloads'] ?></td>
                        </tr>
                    <?php }?>

                    </tbody>
                </table>
            <?php }

            else if($type=='SolutionSupport'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Solution name </th>
                        <th>Team/Company</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($solutionSupport_list as $item){?>
                        <tr>
                            <td><?php echo ++$i ?></td>
                            <td><?= $item['SolutionSupport']['solution_name'] ?></td>
                            <td><?= $item['SolutionSupport']['solution_name'] ?></td>
                            <td><?= $item['SolutionSupport']['status'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='DeptLicense'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Dept. Name</th>
                        <th>Solution Name</th>
                        <th>Stage</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($license_list as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?= $item['LiasoningDept']['dept_name'] ?></td>
                            <td><?= $item['LiasoningDept']['solution_name'] ?></td>
                            <td><?= $item['LiasoningDept']['stage'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='EnterpriseSolutionsAdopted'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Enterprise</th>
						<th>Start Up</th>
						<th>Category</th>
						<th width='15%'>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($followup_list as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?= $item['DsSolutionsAdopted']['enterprise'] ?></td>
							<td><?= $item['DsSolutionsAdopted']['startup'] ?></td>
							<td><?= $item['DsSolutionsAdopted']['category'] ?></td>
							<td><?= date('d-m-Y',strtotime($item['DsSolutionsAdopted']['date'])) ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='StudentTrained'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name</th><th>Contact</th>
                        <th>College</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsAiTrainedStudent as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?= $item['DsAiTrainedStudent']['student_name'] ?></td>
                            <td><?= $item['DsAiTrainedStudent']['contact_number'] ?></td>
                            <td><?= $item['DsAiTrainedStudent']['collage_name'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='ProfessionalTrained'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name</th> <th>Contact</th>
                        <th>Company</th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsAiTrainedProfessional as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
							<td><?= $item['DsAiTrainedProfessional']['name'] ?></td>
                            <td><?= $item['DsAiTrainedProfessional']['contact_number'] ?></td>
                            <td><?= $item['DsAiTrainedProfessional']['collage_name'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='FacultyTrained'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Name</th>

                        <th>Contact No</th>
						<th>College Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsAiTrainedFaculty as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>
                            <td><?= $item['DsAiTrainedFaculty']['name'] ?></td>
							<td><?= $item['DsAiTrainedFaculty']['contact_number'] ?></td>
                            <td><?= $item['DsAiTrainedFaculty']['collage_name'] ?></td>

                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='MasterClass'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Speaker Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($masterClass as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>

                            <td><?= $item['DsMasterClass']['topic'] ?></td>

                            <td><?= $item['DsMasterClass']['date'] ?></td>
                            <td><?= $item['DsMasterClass']['speaker_name'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='AiPathshala'){?>
                <table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Speaker Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsAiPathshala as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>

                            <td><?= $item['DsAiPathshala']['topic'] ?></td>

                            <td><?= $item['DsAiPathshala']['date'] ?></td>
                            <td><?= $item['DsAiPathshala']['speaker_name'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
            else if($type=='TechMentoring'){?>
				<table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Speaker Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsTechMentoring as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>

                            <td><?= $item['DsTechMentoring']['topic'] ?></td>

                            <td><?= $item['DsTechMentoring']['date'] ?></td>
                            <td><?= $item['DsTechMentoring']['speaker_name'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }
			else if($type=='InvestorConnect'){?>
				<table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Investor Name</th>
                        <th>Date</th>
                        <th>Startups Participated</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsInvestorConnect as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>

                            <td><?= $item['DsInvestorConnect']['investor_name'] ?></td>
                            <td><?= $item['DsInvestorConnect']['date'] ?></td>
                            <td><?= $item['DsInvestorConnect']['startup'] ?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>
            <?php }else if($type=='Hackathon'){?>
				<table class="table table-striped example_long table-bordered table-hover" >
                    <thead class="bg-primary-gradient text-white">
                    <tr>
                        <th>Sl no.</th>
                        <th>Topic</th>
                        <th>Date</th>
                        <th>Who is it Meant</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=0;
                    foreach ($dsHackathon as $item){?>
                        <tr>
                            <td><?php echo ++$i; ?></td>

                            <td><?= $item['DsHackathon']['topic'] ?></td>
                            <td><?= $item['DsHackathon']['date'] ?></td>
                            <td><?= $item['DsHackathon']['hackathon_type'] ?></td>
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
