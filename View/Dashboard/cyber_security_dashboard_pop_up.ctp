<div class="modal-header bg-success-gradient  font-size-30" style="padding: 8px 15px !important;">
	<h5 class="box-title text-white">
		<?php echo $title;  ?>
	</h5>
</div>
<div class="modal-body ">
	<div class="table-wrapper-scroll-y">
		<div class="table-responsive model_slim_scroll" style="height: 500px">
			<?php
            if($type=='ManageInternshipPool'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Program Name</th>
						<th>Duration</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['internship_program_name'] ?></td>
						<td><?= $list[$type]['duration'] ?></td>
						<td><?= $list[$type]['date'] ?></td>
						<td><?= $list[$type]['end_date'] ?></td>
					</tr>

					<?php }?>

				</tbody>
			</table>
			<?php }
            else if($type=='ManageStartup'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Startup Name</th>
						<th>Project type</th>
						<th>Status</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Outcome</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['incubation_startup_name'] ?></td>
						<td><?= $list[$type]['type_of_projects'] ?></td>
						<td><?= $list[$type]['current_status_project'] ?></td>
						<td><?= $list[$type]['start_date'] ?></td>
						<td><?= $list[$type]['end_date'] ?></td>
						<td><?= $list[$type]['outcome'] ?></td>
					</tr>

					<?php }?>

				</tbody>
			</table>
			<?php }
            else if($type=='ManageCapacityBuilding'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Training Name</th>
						<th>Trainer Name</th>
						<th>Start Date</th>
						<th>End Date</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['name'] ?></td>
						<td><?= $list[$type]['trainer_name'] ?></td>
						<td><?= $list[$type]['start_date'] ?></td>
						<td><?= $list[$type]['end_date'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='ManageWhitePaper'){?>
			<table class="table table-striped example_long table-responsive table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Title Of White Papers</th>
						<th>Document Type</th>
						<th>Publication Date</th>
						<th>URL Link</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['no_of_white_papers'] ?></td>
						<td><?= $list[$type]['doc_type'] ?></td>
						<td><?= $list[$type]['publication_date'] ?></td>
						<td><?= $list[$type]['url_link'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='ManageCyberSecurity'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Workshops Name</th>
						<th>Resource Person</th>
						<th>Duration</th>
						<th>Date</th>
						<th>Venue</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['list_of_workshops_conducted'] ?></td>
						<td><?= $list[$type]['person_details'] ?></td>
						<td><?= $list[$type]['duration'] ?></td>
						<td><?= $list[$type]['date'] ?></td>
						<td><?= $list[$type]['venue'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='ManageFacility'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>List of equipments</th>
						<th>No. Hours Utilized</th>
						<th>Year Wise Target</th>
						<th>Revenue Details</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['list_of_equipments'] ?></td>
						<td><?= $list[$type]['no_of_hours_utilized'] ?></td>
						<td><?= $list[$type]['yearwise_target'] ?></td>
						<td><?= $list[$type]['details_of_revenue'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='Companies'){?>
			<table class="table table-striped example_long table-bordered table-responsive table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Company Name</th>
						<th>Type</th>
						<th>Status</th>
						<th>Product</th>
						<th>Email</th>
						<th>Mobile No</th>
						<th>Website</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['name'] ?></td>
						<td><?= $list[$type]['company_type'] ?></td>
						<td><?= $list[$type]['status'] ?></td>
						<td><?= $list[$type]['product'] ?></td>
						<td><?= $list[$type]['email'] ?></td>
						<td><?= $list[$type]['mobile'] ?></td>
						<td><?= $list[$type]['website'] ?></td>
						<td><?= $list[$type]['address'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='ManageAgricultureInnovation'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>No. of concepts Registered </th>
						<th>Details of Innovation</th>
						<th>Complete detail of shortlisted Innovation</th>
						<th>Incubation start Date</th>
						<th>Current Status</th>
						<th>Incubation Outcome</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['no_of_concepts_registered'] ?></td>
						<td><?= $list[$type]['detail_innovation'] ?></td>
						<td><?= $list[$type]['shortlisted_innvoation_detail'] ?></td>
						<td><?= $list[$type]['incubation_start_date'] ?></td>
						<td><?= $list[$type]['current_status'] ?></td>
						<td><?= $list[$type]['incubation_outcome'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php } 
            // new one 22-07-2022
             else if($type=='CyberSecurityResearch'){?>
			<table class="table table-striped example_long table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Research Title </th>
						<th>Name of the Candidate</th>
						<th>Organization Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['research_title'] ?></td>
						<td><?= $list[$type]['candidate_name'] ?></td>
						<td><?= $list[$type]['organization_name'] ?></td>
						<td><?= $list[$type]['email_id'] ?></td>
						<td><?= $list[$type]['phone_number'] ?></td>
						<td><?= $list[$type]['address'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($type=='CsIndustryStartup'){?>
			<table class="table table-striped example_long table-bordered table-responsive table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Research Title </th>
						<th>Name of the Candidate</th>
						<th>Organization Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['program_name'] ?></td>
						<td><?= $list[$type]['startup_name'] ?></td>
						<td><?= $list[$type]['founder_name'] ?></td>
						<td><?= $list[$type]['email_id'] ?></td>
						<td><?= $list[$type]['phone_number'] ?></td>
						<td><?= $list[$type]['address'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
			else if($type=='CsAwarenessSession'){?>
			<table class="table table-striped example_long table-bordered  table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Department Name </th>
						<th>Trainer Name</th>
						<th>Session Title</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list[$type]['department_name'] ?></td>
						<td><?= $list[$type]['trainer_name'] ?></td>
						<td><?= $list[$type]['session_title'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
            else if($model=='CyberHygieneHandbook'){?>
			<table class="table table-striped example_long table-bordered  table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Book Title </th>
						<th>Release Date</th>
						<th>Author Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list['CyberHygieneHandbook']['book_title'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['release_date'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['author_name'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['email_address'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['mobile_number'] ?></td>

					</tr>
					<?php }?>
				</tbody>
			</table>

			<?php }
            else if($model=='CsAwarenessPosters'){?>
			<table class="table table-striped example_long  table-bordered table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Title Name</th>
						<th>Date</th>
						<th>Content Details</th>

					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list['CyberHygieneHandbook']['book_title'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['release_date'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['content_details'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
			
            else if($model=='CsNewsLetter'){?>
			<table class="table table-striped example_long table-bordered  table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>

						<th>Candidate Name</th>
						<th>Title Name</th>

						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list['CyberHygieneHandbook']['candidate_name'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['book_title'] ?></td>

						<td><?= $list['CyberHygieneHandbook']['email_address'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['mobile_number'] ?></td>
						<td><?= $list['CyberHygieneHandbook']['address'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
           
			 else if($model=='CsVolunteerProgramme'){?>
			<table class="table table-striped example_long table-responsive table-bordered  table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Program Name</th>
						<th>Candidate Name</th>
						<th>Organization Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list['CsVolunteerProgram']['program_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['candidate_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['organization_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['email_address'] ?></td>
						<td><?= $list['CsVolunteerProgram']['phone_number'] ?></td>
						<td><?= $list['CsVolunteerProgram']['address'] ?></td>
					</tr>
					<?php }?>
				</tbody>
			</table>
			<?php }
         
			 else if($model=='FacultyDevelopmentProgram'){?>
			<table class="table table-striped example_long table-responsive table-bordered  table-hover">
				<thead class="bg-primary-gradient text-white">
					<tr>
						<th>Sl no.</th>
						<th>Program Name</th>
						<th>Candidate Name</th>
						<th>Organization Name</th>
						<th>Email Address</th>
						<th>Phone Number</th>
						<th>Address</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($list as $key=>$list){?>
					<tr>
						<td><?= ++$key ?></td>
						<td><?= $list['CsVolunteerProgram']['program_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['candidate_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['organization_name'] ?></td>
						<td><?= $list['CsVolunteerProgram']['email_address'] ?></td>
						<td><?= $list['CsVolunteerProgram']['phone_number'] ?></td>
						<td><?= $list['CsVolunteerProgram']['address'] ?></td>
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
