<?php
App::uses('AppController', 'Controller');
class DashboardController extends AppController
{
	public $helpers = array('Html', 'Form', 'Js', 'Session');
	public $components = array('RequestHandler', 'Email');
    public $uses = array(
		'Mentor', 'InvestorConnect', 'MarketResearch', 'Targets', 'Sector', 'DsReportPublished', 'Hackathon', 'SolutionSupport', 'LiasoningDept', 'DeptFollowup', 'EnrolledTrainer', 'Trainee', 'TraineeSecuredJob',
		'ManageTraining', 'ManageAttendees', 'ManageSkill', 'ManageSkillAttendee', 'ManageWorking', 'ManageResearchProject', 'ManageResearchProjectIndustry', 'ManageAerospaceTraining',
		'ManageInternshipPool', 'ManageStartup', 'ManageCapacityBuilding', 'ManageWhitePaper', 'ManageCyberSecurity',
		'ManageFacility', 'Companies', 'ManageAgricultureInnovation',
		'MiPrograms', 'MiInternationalConferences', 'MiStartupConferences', 'MiOfficials', 'MiStudentEnrollment', "MiPatent",
		"IotResearchIncubation", "GeneratedEmployment", "WhitePaper", "Poc", "SocietalProject", "ManageIotCurriculum", "ManageIotStudentDetail", "ManageIntellectualProperty",
		"DsReportPublished", "DsReportProcess", "DsMasterClass", "DsAiPathshala", "DsTechMentoring", "DsHackathon", "DsInvestorConnect", "PartnerDetail", "IncubateeDetail",
		'ManageProblemStatement', "KtechEventConducted", "KtechPartnership", "KtechFundRaisedStartup", 'ManageDroneTechnologyAttendee', 'ManageValueStreamCourseAttendee', 'KtechHackthon',
		'KtechEcosystemBuildingService', 'KtechIdeationWorkshop', 'KtechPreIdeation','KtechWorkshop','IotInvestorConnect',''
	);

	/*-----------------------Data Science And AI Dashboard------------------------------------------------*/
	public function dataScienceDashboard()
	{
		$this->layout = 'fab_layout';
		$this->_userSessionCheckout();
		$years = array_reverse($this->getYear());
		$month = $this->getMonth();
		$phase = $this->Session->read('Phase');
		$this->loadModel('DsAiVirtualAccStartup');
		$this->loadModel('DsAiPhyAccStartup');
		$this->loadModel('DsSolutionsAdopted');
		$this->loadModel('DsAiTrainedStudent');
		$this->loadModel('DsAiTrainedFaculty');
		$this->loadModel('DsAiTrainedProfessional');
		/*---------------------------------------------- FIRST GRAPH---------------------------------*/
		/*-------------------------------------------Start-ups Accelerated Virtual--------------------------------*/
		//$this->Mentor->unbindModel(array('belongsTo'=>array('Sector')));
		$dsAiVirtualAccStartup = $this->DsAiVirtualAccStartup->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		/*------------------------------------------Start-ups Accelerated Physical ------------------------------*/
		$dsAiPhyAccStartup = $this->DsAiPhyAccStartup->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));

		/*-------------------------------------- Target -------------------------------------*/
		$targets = $this->Targets->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
			'group' => array('type', 'year', 'month')
		));


		$final_array = array();
		$research_array = array();
		$social_array = array();
		$artificial_array = array();
		$events_array = array(); // By Pavan Kumar M(27/10/2020)

		foreach ($years as $year) {
			$final_array['DsAiVirtualAccStartup']['Achieve']['Year'][$year] = 0;
			$final_array['DsAiPhyAccStartup']['Achieve']['Year'][$year] = 0;


			$final_array['DsAiVirtualAccStartup']['Target']['Year'][$year] = 0;
			$final_array['DsAiPhyAccStartup']['Target']['Year'][$year] = 0;


			/*----------------------Research---------------------*/
			$research_array['ReportPublished']['Achieve']['Year'][$year] = 0;
			$research_array['ReportProcess']['Achieve']['Year'][$year] = 0;
			$research_array['ReportPublished']['Target']['Year'][$year] = 0;
			$research_array['ReportProcess']['Target']['Year'][$year] = 0;

			/*-----------------Socialitical solutions--------------*/
			$social_array['SolutionSupport']['Achieve']['Year'][$year] = 0;
			$social_array['DeptLicense']['Achieve']['Year'][$year] = 0;
			$social_array['EnterpriseSolutionsAdopted']['Achieve']['Year'][$year] = 0;
			$social_array['SolutionSupport']['Target']['Year'][$year] = 0;
			$social_array['DeptLicense']['Target']['Year'][$year] = 0;
			$social_array['EnterpriseSolutionsAdopted']['Target']['Year'][$year] = 0;

			/*-----------------------Artificial Intelligence ------------------*/
			$artificial_array['StudentTrained']['Achieve']['Year'][$year] = 0;
			$artificial_array['StudentTrained']['Target']['Year'][$year] = 0;
			$artificial_array['FacultyTrained']['Achieve']['Year'][$year] = 0;
			$artificial_array['FacultyTrained']['Target']['Year'][$year] = 0;
			$artificial_array['ProfessionalTrained']['Achieve']['Year'][$year] = 0;
			$artificial_array['ProfessionalTrained']['Target']['Year'][$year] = 0;



			$artificial_array['StudentTrained']['Achieve']['count'] = 0;
			$artificial_array['StudentTrained']['Target']['count'] = 0;
			$artificial_array['FacultyTrained']['Achieve']['count'] = 0;
			$artificial_array['FacultyTrained']['Target']['count'] = 0;
			$artificial_array['ProfessionalTrained']['Achieve']['count'] = 0;
			$artificial_array['ProfessionalTrained']['Target']['count'] = 0;


			/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
			$events_array['MasterClass']['Events']['Year'][$year] = 0;
			$events_array['MasterClass']['Events']['count'] = 0;
			$events_array['AiPathshala']['Events']['Year'][$year] = 0;
			$events_array['AiPathshala']['Events']['count'] = 0;
			$events_array['TechMentoring']['Events']['Year'][$year] = 0;
			$events_array['TechMentoring']['Events']['count'] = 0;
			$events_array['Hackathon']['Events']['Year'][$year] = 0;
			$events_array['Hackathon']['Events']['count'] = 0;
			$events_array['InvestorConnect']['Events']['Year'][$year] = 0;
			$events_array['InvestorConnect']['Events']['count'] = 0;
			/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/


			foreach ($month as $m) {
				$final_array['DsAiVirtualAccStartup']['Achieve'][$year][$m] = 0;
				$final_array['DsAiPhyAccStartup']['Achieve'][$year][$m] = 0;
				$final_array['DsAiVirtualAccStartup']['Target'][$year][$m] = 0;
				$final_array['DsAiPhyAccStartup']['Target'][$year][$m] = 0;


				/*-----------------Research--------------------*/
				$research_array['ReportPublished']['Achieve'][$year][$m] = 0;
				$research_array['ReportProcess']['Achieve'][$year][$m] = 0;
				$research_array['ReportPublished']['Target'][$year][$m] = 0;
				$research_array['ReportProcess']['Target'][$year][$m] = 0;

				/*-----------------Socialitical solutions--------------*/
				$social_array['SolutionSupport']['Achieve'][$year][$m] = 0;
				$social_array['DeptLicense']['Achieve'][$year][$m] = 0;
				$social_array['EnterpriseSolutionsAdopted']['Achieve'][$year][$m] = 0;
				$social_array['SolutionSupport']['Target'][$year][$m] = 0;
				$social_array['DeptLicense']['Target'][$year][$m] = 0;
				$social_array['EnterpriseSolutionsAdopted']['Target'][$year][$m] = 0;

				/*-----------------------Artificial Intelligence ------------------*/
				$artificial_array['StudentTrained']['Achieve'][$year][$m] = 0;
				$artificial_array['FacultyTrained']['Achieve'][$year][$m] = 0;
				$artificial_array['ProfessionalTrained']['Achieve'][$year][$m] = 0;
				$artificial_array['StudentTrained']['Target'][$year][$m] = 0;
				$artificial_array['FacultyTrained']['Target'][$year][$m] = 0;
				$artificial_array['ProfessionalTrained']['Target'][$year][$m] = 0;



				/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
				$events_array['MasterClass']['Events'][$year][$m] = 0;
				$events_array['AiPathshala']['Events'][$year][$m] = 0;
				$events_array['TechMentoring']['Events'][$year][$m] = 0;
				$events_array['Hackathon']['Events'][$year][$m] = 0;
				$events_array['InvestorConnect']['Events'][$year][$m] = 0;
				/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
			}
		}
		foreach ($dsAiVirtualAccStartup as $item) {
			$y = $item['DsAiVirtualAccStartup']['year'];
			$m = $item['DsAiVirtualAccStartup']['month'];
			$final_array['DsAiVirtualAccStartup']['Achieve'][$y][$m] = $item[0]['count'];
			$final_array['DsAiVirtualAccStartup']['Achieve']['Year'][$y] = array_sum($final_array['DsAiVirtualAccStartup']['Achieve'][$y]);
			$final_array['DsAiVirtualAccStartup']['Achieve']['count'] = array_sum($final_array['DsAiVirtualAccStartup']['Achieve']['Year']);
		}
		foreach ($dsAiPhyAccStartup as $item) {
			$y = $item['DsAiPhyAccStartup']['year'];
			$m = $item['DsAiPhyAccStartup']['month'];
			$final_array['DsAiPhyAccStartup']['Achieve'][$y][$m] = $item[0]['count'];
			$final_array['DsAiPhyAccStartup']['Achieve']['Year'][$y] = array_sum($final_array['DsAiPhyAccStartup']['Achieve'][$y]);
			$final_array['DsAiPhyAccStartup']['Achieve']['count'] = array_sum($final_array['DsAiPhyAccStartup']['Achieve']['Year']);
		}

		foreach ($targets as $item) {
			$y = $item['Targets']['year'];

			$type = $item['Targets']['type'];
			if ($type == 'DsAiPhyAccStartup' || $type == 'DsAiVirtualAccStartup') {
				$final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
				$final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
			} else  if ($type == 'ReportPublished' || $type == 'ReportProcess') {
				$research_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$research_array[$type]['Target']['Year'][$y] = array_sum($research_array[$type]['Target'][$y]);
				$research_array[$type]['Target']['count'] = array_sum($research_array[$type]['Target']['Year']);
			} else  if ($type == 'SolutionSupport' || $type == 'DeptLicense' || $type == 'EnterpriseSolutionsAdopted') {
				$social_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$social_array[$type]['Target']['Year'][$y] = array_sum($social_array[$type]['Target'][$y]);
				$social_array[$type]['Target']['count'] = array_sum($social_array[$type]['Target']['Year']);
			} else  if ($type == 'StudentTrained' || $type == 'FacultyTrained' || $type == 'ProfessionalTrained') {
				$artificial_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$artificial_array[$type]['Target']['Year'][$y] = array_sum($artificial_array[$type]['Target'][$y]);
				$artificial_array[$type]['Target']['count'] = array_sum($artificial_array[$type]['Target']['Year']);
			}
		}

		/*-------------------------------------------------SECOND GRAPH ON RESEARCH & HACKATHONS----------------------*/
		/*-------------------------------DsReportPublished --------------------------------*/
		$research_paper_list = $this->DsReportPublished->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		/*------------------------------- DsReportProcess -------------------------*/
		$hackathon_list = $this->DsReportProcess->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));

		foreach ($research_paper_list as $item) {
			$y = $item['DsReportPublished']['year'];
			$m = $item['DsReportPublished']['month'];
			$research_array['ReportPublished']['Achieve'][$y][$m] = $item[0]['count'];
			$research_array['ReportPublished']['Achieve']['Year'][$y] = array_sum($research_array['ReportPublished']['Achieve'][$y]);
			$research_array['ReportPublished']['Achieve']['count'] = array_sum($research_array['ReportPublished']['Achieve']['Year']);
		}
		foreach ($hackathon_list as $item) {
			//$y=$item[0]['year'];
			//$m=date('F',strtotime($item['ReportProcess']['date']));

			$m = $item['DsReportProcess']['month']; //Updated by Pavan(01-12-2020)
			$y = $item['DsReportProcess']['year']; //Updated by Pavan(01-12-2020)

			$research_array['ReportProcess']['Achieve'][$y][$m] = $item[0]['count'];
			$research_array['ReportProcess']['Achieve']['Year'][$y] = array_sum($research_array['ReportProcess']['Achieve'][$y]);
			$research_array['ReportProcess']['Achieve']['count'] = array_sum($research_array['ReportProcess']['Achieve']['Year']);
		}

		/*----------------------------------------THIRD GRAPH ON Societal Solutions-----------------------------------*/
		/*---------------Solution Supports---------------------------------*/
		$solutionSupport_list = $this->SolutionSupport->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$license_list = $this->LiasoningDept->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$dsSolutionsAdopted = $this->DsSolutionsAdopted->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));

		foreach ($solutionSupport_list as $item) {
			$y = $item['SolutionSupport']['year'];
			$m = $item['SolutionSupport']['month'];
			$social_array['SolutionSupport']['Achieve'][$y][$m] = $item[0]['count'];
			$social_array['SolutionSupport']['Achieve']['Year'][$y] = array_sum($social_array['SolutionSupport']['Achieve'][$y]);
			$social_array['SolutionSupport']['Achieve']['count'] = array_sum($social_array['SolutionSupport']['Achieve']['Year']);
		}
		foreach ($license_list as $item) {
			$y = $item['LiasoningDept']['year'];
			$m = $item['LiasoningDept']['month'];
			$social_array['DeptLicense']['Achieve'][$y][$m] = $item[0]['count'];
			$social_array['DeptLicense']['Achieve']['Year'][$y] = array_sum($social_array['DeptLicense']['Achieve'][$y]);
			$social_array['DeptLicense']['Achieve']['count'] = array_sum($social_array['DeptLicense']['Achieve']['Year']);
		}

		foreach ($dsSolutionsAdopted as $item) {
			$y = $item['DsSolutionsAdopted']['year'];
			$m = $item['DsSolutionsAdopted']['month'];

			$social_array['EnterpriseSolutionsAdopted']['Achieve'][$y][$m] = $item[0]['count'];
			$social_array['EnterpriseSolutionsAdopted']['Achieve']['Year'][$y] = array_sum($social_array['EnterpriseSolutionsAdopted']['Achieve'][$y]);
			$social_array['EnterpriseSolutionsAdopted']['Achieve']['count'] = array_sum($social_array['EnterpriseSolutionsAdopted']['Achieve']['Year']);
		}

		/*------------------------------- Fourth Graph ---------------------------------------------------------------*/
		/*--------------------------Trainers Enrolled--------------------------------*/
		$dsAiTrainedStudent = $this->DsAiTrainedStudent->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$dsAiTrainedFaculty = $this->DsAiTrainedFaculty->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$dsAiTrainedProfessional = $this->DsAiTrainedProfessional->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));

		foreach ($dsAiTrainedStudent as $item) {
			$y = $item['DsAiTrainedStudent']['year'];
			$m = $item['DsAiTrainedStudent']['month'];
			$artificial_array['StudentTrained']['Achieve'][$y][$m] = $item[0]['count'];
			$artificial_array['StudentTrained']['Achieve']['Year'][$y] = array_sum($artificial_array['StudentTrained']['Achieve'][$y]);
			$artificial_array['StudentTrained']['Achieve']['count'] = array_sum($artificial_array['StudentTrained']['Achieve']['Year']);
		}
		foreach ($dsAiTrainedFaculty as $item) {
			$y = $item['DsAiTrainedFaculty']['year'];
			$m = $item['DsAiTrainedFaculty']['month'];
			$artificial_array['FacultyTrained']['Achieve'][$y][$m] = $item[0]['count'];
			$artificial_array['FacultyTrained']['Achieve']['Year'][$y] = array_sum($artificial_array['FacultyTrained']['Achieve'][$y]);
			$artificial_array['FacultyTrained']['Achieve']['count'] = array_sum($artificial_array['FacultyTrained']['Achieve']['Year']);
		}
		foreach ($dsAiTrainedProfessional as $item) {
			$y = $item['DsAiTrainedProfessional']['year'];
			$m = $item['DsAiTrainedProfessional']['month'];
			$artificial_array['ProfessionalTrained']['Achieve'][$y][$m] = $item[0]['count'];
			$artificial_array['ProfessionalTrained']['Achieve']['Year'][$y] = array_sum($artificial_array['ProfessionalTrained']['Achieve'][$y]);
			$artificial_array['ProfessionalTrained']['Achieve']['count'] = array_sum($artificial_array['ProfessionalTrained']['Achieve']['Year']);
		}

		//print_r($final_array);

		/*-------------------------------Fifth Graph - By Pavan Kumar M(27/10/2020)---------------------------------------*/
		$events_master_class_list = $this->DsMasterClass->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$events_ai_pathshala_list = $this->DsAiPathshala->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$events_tech_mentoring_list = $this->DsTechMentoring->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$events_hackathon_list = $this->DsHackathon->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));
		$investor_connect_list = $this->DsInvestorConnect->find('all', array(
			'conditions' => array("phase" => $phase),
			'fields' => array('COUNT(*) AS count', 'year', 'month'),
			'group' => array('year', 'month')
		));

		foreach ($events_master_class_list as $item) {
			$y = $item['DsMasterClass']['year'];
			$m = $item['DsMasterClass']['month'];
			$events_array['MasterClass']['Events'][$y][$m] = $item[0]['count'];
			$events_array['MasterClass']['Events']['Year'][$y] = array_sum($events_array['MasterClass']['Events'][$y]);
			$events_array['MasterClass']['Events']['count'] = array_sum($events_array['MasterClass']['Events']['Year']);
		}
		foreach ($events_ai_pathshala_list as $item) {
			$y = $item['DsAiPathshala']['year'];
			$m = $item['DsAiPathshala']['month'];
			$events_array['AiPathshala']['Events'][$y][$m] = $item[0]['count'];
			$events_array['AiPathshala']['Events']['Year'][$y] = array_sum($events_array['AiPathshala']['Events'][$y]);
			$events_array['AiPathshala']['Events']['count'] = array_sum($events_array['AiPathshala']['Events']['Year']);
		}
		foreach ($events_tech_mentoring_list as $item) {
			$y = $item['DsTechMentoring']['year'];
			$m = $item['DsTechMentoring']['month'];
			$events_array['TechMentoring']['Events'][$y][$m] = $item[0]['count'];
			$events_array['TechMentoring']['Events']['Year'][$y] = array_sum($events_array['TechMentoring']['Events'][$y]);
			$events_array['TechMentoring']['Events']['count'] = array_sum($events_array['TechMentoring']['Events']['Year']);
		}
		foreach ($events_hackathon_list as $item) {
			$y = $item['DsHackathon']['year'];
			$m = $item['DsHackathon']['month'];
			$events_array['Hackathon']['Events'][$y][$m] = $item[0]['count'];
			$events_array['Hackathon']['Events']['Year'][$y] = array_sum($events_array['Hackathon']['Events'][$y]);
			$events_array['Hackathon']['Events']['count'] = array_sum($events_array['Hackathon']['Events']['Year']);
		}
		foreach ($investor_connect_list as $item) {
			$y = $item['DsInvestorConnect']['year'];
			$m = $item['DsInvestorConnect']['month'];
			$events_array['InvestorConnect']['Events'][$y][$m] = $item[0]['count'];
			$events_array['InvestorConnect']['Events']['Year'][$y] = array_sum($events_array['InvestorConnect']['Events'][$y]);
			$events_array['InvestorConnect']['Events']['count'] = array_sum($events_array['InvestorConnect']['Events']['Year']);
		}

		$this->set('final_array', $final_array);
		$this->set('research_array', $research_array);
		$this->set('social_array', $social_array);
		$this->set('artificial_array', $artificial_array);
		$this->set('events_array', $events_array); //Updated By Pavan Kumar M(27/10/2020)
	}


	public function innovatorsAcceleratedPopUp($type = null, $year = null, $month = null)
	{
		$this->layout = 'ajax';

		$this->set('type', $type);
		$this->loadModel('DsAiVirtualAccStartup');
		$this->loadModel('DsAiPhyAccStartup');
		$this->loadModel('DsAiTrainedStudent');
		$this->loadModel('DsAiTrainedFaculty');
		$this->loadModel('DsAiTrainedProfessional');
		$this->loadModel('DsSolutionsAdopted');
		$phase = $this->Session->read('Phase');

		if ($type == 'DsAiPhyAccStartup') {
			$dsAiPhyAccStartup = $this->DsAiPhyAccStartup->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$title = 'Start-ups Accelerated Physical Of ' . $month . ' - ' . $year;
			$this->set('dsAiPhyAccStartup', $dsAiPhyAccStartup);
		} else if ($type == 'DsAiVirtualAccStartup') {
			$dsAiVirtualAccStartup = $this->DsAiVirtualAccStartup->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsAiVirtualAccStartup', $dsAiVirtualAccStartup);
			$title = 'Start-ups Accelerated Virtual Of ' . $month . ' - ' . $year;
			//print_r($dsAiVirtualAccStartup);
		} else if ($type == 'ReportPublished') {
			$research_paper_list = $this->DsReportPublished->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('DsReportPublished.id DESC')
			));
			$this->set('research_paper_list', $research_paper_list);
			$title = 'Report Published Of ' . $month . ' - ' . $year;
		} else if ($type == 'ReportProcess') {
			$hackathon_list = $this->DsReportProcess->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('DsReportProcess.id DESC')
			));
			$this->set('ReportProcess_list', $hackathon_list);
			$title = 'Report Process Of ' . $month . ' - ' . $year;
		} else if ($type == 'SolutionSupport') {
			$solutionSupport_list = $this->SolutionSupport->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('solutionSupport_list', $solutionSupport_list);
			$title = 'Solution Supports Of ' . $month . ' - ' . $year;
		} else if ($type == 'DeptLicense') {
			$license_list = $this->LiasoningDept->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('license_list', $license_list);
			$title = 'Dept. License Of ' . $month . ' - ' . $year;
		} else if ($type == 'EnterpriseSolutionsAdopted') {
			$dsSolutionsAdopted = $this->DsSolutionsAdopted->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('followup_list', $dsSolutionsAdopted);
			$title = 'Enterprise Solutions Adopted Of ' . $month . ' - ' . $year;
		} else if ($type == 'StudentTrained') {
			$dsAiTrainedStudent = $this->DsAiTrainedStudent->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsAiTrainedStudent', $dsAiTrainedStudent);
			$title = 'Students Trained In ' . $month . ' - ' . $year;
		} else if ($type == 'ProfessionalTrained') {
			$dsAiTrainedProfessional = $this->DsAiTrainedProfessional->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsAiTrainedProfessional', $dsAiTrainedProfessional);
			$title = 'Professional Traineed In ' . $month . ' - ' . $year;
		} else if ($type == 'FacultyTrained') {
			$dsAiTrainedFaculty = $this->DsAiTrainedFaculty->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsAiTrainedFaculty', $dsAiTrainedFaculty);
			$title = 'Faculty Traineed In ' . $month . ' - ' . $year;
		} else if ($type == 'MasterClass') {
			$this->loadModel('DsMasterClass');
			$masterClass = $this->DsMasterClass->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('masterClass', $masterClass);
			// print_r($masterClass);
			$title = 'Master Class In ' . $month . ' - ' . $year;
		} else if ($type == 'AiPathshala') {
			$this->loadModel('DsAiPathshala');
			$dsAiPathshala = $this->DsAiPathshala->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsAiPathshala', $dsAiPathshala);
			$title = 'Ai Pathshala In ' . $month . ' - ' . $year;
		} else if ($type == 'TechMentoring') {
			$this->loadModel('DsTechMentoring');
			$dsTechMentoring = $this->DsTechMentoring->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsTechMentoring', $dsTechMentoring);
			$title = 'Tech Mentoring In ' . $month . ' - ' . $year;
		} else if ($type == 'Hackathon') {
			$this->loadModel('DsHackathon');
			$dsHackathon = $this->DsHackathon->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsHackathon', $dsHackathon);
			$title = 'Hackathon In ' . $month . ' - ' . $year;
		} else if ($type == 'InvestorConnect') {
			$this->loadModel('DsInvestorConnect');
			$dsInvestorConnect = $this->DsInvestorConnect->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, "phase" => $phase),
				'order' => array('id DESC')
			));
			$this->set('dsInvestorConnect', $dsInvestorConnect);
			$title = 'Investor Connect In ' . $month . ' - ' . $year;
		}
		$this->set('title', $title);
	}

	/*--------------------------- Aerospace & Defence ---------------------------------------------------*/

    public function aerospaceDashboard($type = null, $year = null, $month = null)
	{
		$this->loadModel('InternshipFoundationCourse');
		$this->loadModel('AdvanceProjectBasedCourse');
		$this->loadModel('OrientationAwarenessCourse');
		$this->loadModel('StarterCourse');

		$this->loadModel('AerospaceDefenseEmbeddedCourse');
		$this->loadModel('AerospaceDefenseTrainingProcess');
		$this->loadModel('AerospaceDefenseBootcamp');
		$this->loadModel('AerospaceDefenseDroneTechnology');
		$this->loadModel('AerospaceDefenseValueStreamCourse');

		$this->loadModel('AerospaceDefenseSkilling');
		$this->loadModel('AerospaceDefenseCourse');

		$this->loadModel('ManageStartupFacilitation');
		$phase = $this->Session->read('Phase');
	
		if ($type != '' && $year != '' && $month != '') {
			$this->layout = 'ajax';

			$phaseCondition = array('phase' => $phase);
			/********************** Second Graph **********************/

			if ($type == 'EmbeddedCourse') {
				$Embeded = array(
					'joins' => array(
						array(
							'table' => 'manage_embedded_course_attendees',
							'alias' => 'ManageEmbeddedCourseAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageEmbeddedCourseAttendee.aerospace_defense_embedded_course_id = AerospaceDefenseEmbeddedCourse.id')
						),
					),
					'conditions' => array('AerospaceDefenseEmbeddedCourse.year' => $year, 'AerospaceDefenseEmbeddedCourse.month' => $month, $phaseCondition, 'AerospaceDefenseEmbeddedCourse.is_delete' => 0),
					'fields' => array('AerospaceDefenseEmbeddedCourse.year', 'AerospaceDefenseEmbeddedCourse.month', 'AerospaceDefenseEmbeddedCourse.id', 'AerospaceDefenseEmbeddedCourse.embedded_course', 'AerospaceDefenseEmbeddedCourse.duration', 'AerospaceDefenseEmbeddedCourse.start_date', 'AerospaceDefenseEmbeddedCourse.end_date', 'AerospaceDefenseEmbeddedCourse.phase', 'AerospaceDefenseEmbeddedCourse.institute', 'ManageEmbeddedCourseAttendee.attendee_name', 'ManageEmbeddedCourseAttendee.contact_number', 'ManageEmbeddedCourseAttendee.email_id'),
				);
				$list = $this->AerospaceDefenseEmbeddedCourse->find('all', $Embeded);
				$title = 'Aerospace Defense Embedded Courses Of ' . $month . ' - ' . $year;
			} else if ($type == 'TrainingProcess') {

				$train_process = array(
					'joins' => array(
						array(
							'table' => 'manage_training_process_attendees',
							'alias' => 'ManageTrainingProcessAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageTrainingProcessAttendee.aerospace_defense_training_process_id = AerospaceDefenseTrainingProcess.id')
						),
					),
					'conditions' => array('AerospaceDefenseTrainingProcess.year' => $year, 'AerospaceDefenseTrainingProcess.month' => $month, $phaseCondition, 'AerospaceDefenseTrainingProcess.is_delete' => 0),
					'fields' => array('AerospaceDefenseTrainingProcess.year', 'AerospaceDefenseTrainingProcess.month', 'AerospaceDefenseTrainingProcess.id', 'AerospaceDefenseTrainingProcess.training_name', 'AerospaceDefenseTrainingProcess.duration', 'AerospaceDefenseTrainingProcess.start_date', 'AerospaceDefenseTrainingProcess.end_date', 'AerospaceDefenseTrainingProcess.phase', 'AerospaceDefenseTrainingProcess.institute', 'ManageTrainingProcessAttendee.attendee_name', 'ManageTrainingProcessAttendee.contact_number', 'ManageTrainingProcessAttendee.email_id'),
				);
				$list = $this->AerospaceDefenseTrainingProcess->find('all', $train_process);
				$title = 'Aerospace Defense Training Process Of ' . $month . ' - ' . $year;
			} else if ($type == 'BootCamp') {

				$bootcamp = array(
					'joins' => array(
						array(
							'table' => 'manage_bootcamp_attendees',
							'alias' => 'ManageBootcampAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageBootcampAttendee.aerospace_defense_bootcamp_id = AerospaceDefenseBootcamp.id')
						),
					),
					'conditions' => array('AerospaceDefenseBootcamp.year' => $year, 'AerospaceDefenseBootcamp.month' => $month, $phaseCondition, 'AerospaceDefenseBootcamp.is_delete' => 0),
					'fields' => array('AerospaceDefenseBootcamp.year', 'AerospaceDefenseBootcamp.month', 'AerospaceDefenseBootcamp.id', 'AerospaceDefenseBootcamp.bootcamp', 'AerospaceDefenseBootcamp.duration', 'AerospaceDefenseBootcamp.start_date', 'AerospaceDefenseBootcamp.end_date', 'AerospaceDefenseBootcamp.phase', 'AerospaceDefenseBootcamp.institute', 'ManageBootcampAttendee.attendee_name', 'ManageBootcampAttendee.contact_number', 'ManageBootcampAttendee.email_id'),
				);
				$list = $this->AerospaceDefenseBootcamp->find('all', $bootcamp);
				$title = 'Aerospace Defense Boot Camp Process Of ' . $month . ' - ' . $year;
			} else if($type == 'DroneTechnology'){
				$droneTechnology = array(
					'joins' => array(
						array(
							'table' => 'manage_drone_technology_attendees',
							'alias' => 'ManageDroneTechnologyAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageDroneTechnologyAttendee.aerospace_defense_drone_technology_id = AerospaceDefenseDroneTechnology.id')
						),
					),
					'conditions' => array('AerospaceDefenseDroneTechnology.year' => $year, 'AerospaceDefenseDroneTechnology.month' => $month, $phaseCondition, 'AerospaceDefenseDroneTechnology.is_delete' => 0),
					'fields' => array('AerospaceDefenseDroneTechnology.year', 'AerospaceDefenseDroneTechnology.month', 'AerospaceDefenseDroneTechnology.id', 'AerospaceDefenseDroneTechnology.embedded_course', 'AerospaceDefenseDroneTechnology.duration', 'AerospaceDefenseDroneTechnology.start_date', 'AerospaceDefenseDroneTechnology.end_date', 'AerospaceDefenseDroneTechnology.phase', 'AerospaceDefenseDroneTechnology.institute', 'ManageDroneTechnologyAttendee.attendee_name', 'ManageDroneTechnologyAttendee.contact_number', 'ManageDroneTechnologyAttendee.email_id','ManageDroneTechnologyAttendee.institute_name'),
				);
				$list = $this->AerospaceDefenseDroneTechnology->find('all', $droneTechnology);
				$title = 'Aerospace Defense Drone Technology Process Of ' . $month . ' - ' . $year;
				
			}
			else if($type == 'ValueStreamCourse'){
				$valueStreamCourse = array(
					'joins' => array(
						array(
							'table' => 'manage_value_stream_course_attendees',
							'alias' => 'ManageValueStreamCourseAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageValueStreamCourseAttendee.aerospace_defense_value_stream_course_id = AerospaceDefenseValueStreamCourse.id')
						),
					),
					'conditions' => array('AerospaceDefenseValueStreamCourse.year' => $year, 'AerospaceDefenseValueStreamCourse.month' => $month, $phaseCondition, 'AerospaceDefenseValueStreamCourse.is_delete' => 0),
					'fields' => array('AerospaceDefenseValueStreamCourse.year', 'AerospaceDefenseValueStreamCourse.month', 'AerospaceDefenseValueStreamCourse.id', 'AerospaceDefenseValueStreamCourse.embedded_course', 'AerospaceDefenseValueStreamCourse.duration', 'AerospaceDefenseValueStreamCourse.start_date', 'AerospaceDefenseValueStreamCourse.end_date', 'AerospaceDefenseValueStreamCourse.phase', 'AerospaceDefenseValueStreamCourse.institute', 'ManageValueStreamCourseAttendee.attendee_name', 'ManageValueStreamCourseAttendee.contact_number', 'ManageValueStreamCourseAttendee.email_id','ManageValueStreamCourseAttendee.institute_name'),
				);
				$list = $this->AerospaceDefenseValueStreamCourse->find('all', $valueStreamCourse);
				$title = 'Aerospace Defense Value Stream Course Process Of ' . $month . ' - ' . $year;
				
			}

			/********************** Third Graph **********************/
			else if ($type == 'DefenseSkilling') {

				$defense_skilling = array(
					'joins' => array(
						array(
							'table' => 'manage_skilling_attendees',
							'alias' => 'ManageSkillingAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageSkillingAttendee.aerospace_defense_skilling_id = AerospaceDefenseSkilling.id')
						),
					),
					'conditions' => array('AerospaceDefenseSkilling.year' => $year, 'AerospaceDefenseSkilling.month' => $month, $phaseCondition, 'AerospaceDefenseSkilling.is_delete' => 0),
					'fields' => array('AerospaceDefenseSkilling.year', 'AerospaceDefenseSkilling.month', 'AerospaceDefenseSkilling.id', 'AerospaceDefenseSkilling.skill_name', 'AerospaceDefenseSkilling.duration', 'AerospaceDefenseSkilling.start_date', 'AerospaceDefenseSkilling.end_date', 'AerospaceDefenseSkilling.phase', 'AerospaceDefenseSkilling.resource_person', 'ManageSkillingAttendee.attendee_name', 'ManageSkillingAttendee.email_id', 'ManageSkillingAttendee.contact_number', 'ManageSkillingAttendee.institute_name'),
				);
				$list = $this->AerospaceDefenseSkilling->find('all', $defense_skilling);
				$title = 'Aerospace Defense Skilling Process Of ' . $month . ' - ' . $year;
			} else if ($type == 'DefenseCourse') {

				$course_defense = array(
					'joins' => array(
						array(
							'table' => 'manage_courses_attendees',
							'alias' => 'ManageCourseAttendee',
							'type' => 'INNER',
							'conditions' => array('ManageCourseAttendee.aerospace_defense_course_id = AerospaceDefenseCourse.id')
						),
					),
					'conditions' => array('AerospaceDefenseCourse.year' => $year, 'AerospaceDefenseCourse.month' => $month, $phaseCondition, 'AerospaceDefenseCourse.is_delete' => 0),
					'fields' => array('AerospaceDefenseCourse.year', 'AerospaceDefenseCourse.month', 'AerospaceDefenseCourse.id', 'AerospaceDefenseCourse.course_name', 'AerospaceDefenseCourse.duration', 'AerospaceDefenseCourse.start_date', 'AerospaceDefenseCourse.end_date', 'AerospaceDefenseCourse.phase', 'AerospaceDefenseCourse.resource_person', 'ManageCourseAttendee.attendee_name', 'ManageCourseAttendee.contact_number', 'ManageCourseAttendee.email_id', 'ManageCourseAttendee.institute_name'),
				);
				$list = $this->AerospaceDefenseCourse->find('all', $course_defense);
				$title = 'Aerospace Defense Course Process Of ' . $month . ' - ' . $year;
			}

			/********************** Fourth Graph **********************/
			else if ($type == 'StartupFacilitation') {
				$id = $year;
				$list = $this->ManageStartupFacilitation->find('all', array(
					'conditions' => array('id' => $id),
					'order' => array('id DESC')
				));
				$title = 'Startup Facilitation Companies';
			}

			/********************** First Graph **********************/

			else if ($type == 'Internship') {
				$condition =  array('year' => $year, 'month' => $month, $phaseCondition);
				$lists = array(
					'joins' => array(
						array(
							'table' => 'internship_students',
							'alias' => 'InternshipStudent',
							'type' => 'INNER',
							'conditions' => array('InternshipStudent.internship_foundation_course_id = InternshipFoundationCourse.id')
						),
					),
					'conditions' => array('year' => $year, 'month' => $month, $phaseCondition,), //$phaseCondition
					'fields' => array('InternshipFoundationCourse.year', 'InternshipFoundationCourse.month', 'InternshipFoundationCourse.id', 'InternshipFoundationCourse.internship_program_name', 'InternshipFoundationCourse.venue', 'InternshipFoundationCourse.start_date', 'InternshipFoundationCourse.end_date', 'InternshipFoundationCourse.duration', 'InternshipFoundationCourse.phase', 'InternshipStudent.attendee_name', 'InternshipStudent.email_id', 'InternshipStudent.contact_number'),
				);
				$list = $this->InternshipFoundationCourse->find('all', $lists);
				$title = 'Internship/Foundation Course';
			} else if ($type == 'AdvanceCourse') {
				$projectBasedCourse = array(
					'joins' => array(
						array(
							'table' => 'advance_project_students',
							'alias' => 'AdvanceProjectStudent',
							'type' => 'INNER',
							'conditions' => array('AdvanceProjectStudent.advance_project_based_course_id = AdvanceProjectBasedCourse.id')
						),
					),
					'conditions' => array('year' => $year, 'month' => $month, $phaseCondition, 'AdvanceProjectStudent.is_delete' => 0), //$phaseCondition
					'fields' => array('AdvanceProjectBasedCourse.year', 'AdvanceProjectBasedCourse.month', 'AdvanceProjectBasedCourse.id', 'AdvanceProjectBasedCourse.internship_program_name', 'AdvanceProjectBasedCourse.venue', 'AdvanceProjectBasedCourse.start_date', 'AdvanceProjectBasedCourse.end_date', 'AdvanceProjectBasedCourse.duration', 'AdvanceProjectBasedCourse.phase', 'AdvanceProjectStudent.attendee_name', 'AdvanceProjectStudent.email_id', 'AdvanceProjectStudent.contact_number'),
				);
				$list = $this->AdvanceProjectBasedCourse->find('all', $projectBasedCourse);
				$title = 'Advance/Project Based Course';
			} else if ($type == 'OrientationCourse') {

				$orientation = array(
					'joins' => array(
						array(
							'table' => 'orientation_awareness_students',
							'alias' => 'OrientationAwarenessStudent',
							'type' => 'INNER',
							'conditions' => array('OrientationAwarenessStudent.orientation_awareness_course_id = OrientationAwarenessCourse.id')
						),
					),
					'conditions' => array('year' => $year, 'month' => $month, $phaseCondition, 'OrientationAwarenessStudent.is_delete' => 0),
					'fields' => array('OrientationAwarenessCourse.year', 'OrientationAwarenessCourse.month', 'OrientationAwarenessCourse.id', 'OrientationAwarenessCourse.internship_program_name', 'OrientationAwarenessCourse.venue', 'OrientationAwarenessCourse.start_date', 'OrientationAwarenessCourse.end_date', 'OrientationAwarenessCourse.duration', 'OrientationAwarenessCourse.phase', 'OrientationAwarenessStudent.attendee_name', 'OrientationAwarenessStudent.email_id', 'OrientationAwarenessStudent.contact_number'),
				);
				$list = $this->OrientationAwarenessCourse->find('all', $orientation);
				$title = 'Orientation/Awareness Course';
			
		} else if ($type == 'StarterCourse') {

			$starter_course = array(
				'joins' => array(
					array(
						'table' => 'starter_course_students',
						'alias' => 'StarterCourseStudent',
						'type' => 'INNER',
						'conditions' => array('StarterCourseStudent.starter_course_id = StarterCourse.id')
					),
				),
				'conditions' => array('year' => $year, 'month' => $month, $phaseCondition, 'StarterCourseStudent.is_delete' => 0),
				'fields' => array('StarterCourse.year', 'StarterCourse.month', 'StarterCourse.id', 'StarterCourse.starter_program_name', 'StarterCourse.venue', 'StarterCourse.start_date', 'StarterCourse.end_date', 'StarterCourse.duration', 'StarterCourse.phase', 'StarterCourseStudent.attendee_name', 'StarterCourseStudent.email_id', 'StarterCourseStudent.contact_number'),
			);
			$list = $this->StarterCourse->find('all', $starter_course);
			$title = 'Starter Course';
		}

			$this->set('list_data', $list);
			$this->set('title', $title);
			$this->set('type', $type);

			$this->render('aerospace_pop_up');
		} else {
			
			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();

			/*---------------------------------------------- FIRST GRAPH START---------------------------------*/
			/*------------------------------------------- Training --------------------------------*/
			$phaseCondition = array('phase' => $phase);
			$Train = array(
				'joins' => array(
					array(
						'table' => 'internship_students',
						'alias' => 'InternshipStudent',
						'type' => 'INNER',
						'conditions' => array('InternshipStudent.internship_foundation_course_id = InternshipFoundationCourse.id')
					),
				),
				'conditions' => array('InternshipFoundationCourse.phase' => $phase, 'InternshipStudent.is_delete' => 0), //$phaseCondition
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$Training = $this->InternshipFoundationCourse->find('all', $Train);
			
			$projectBasedCourse = array(
				'joins' => array(
					array(
						'table' => 'advance_project_students',
						'alias' => 'AdvanceProjectStudent',
						'type' => 'INNER',
						'conditions' => array('AdvanceProjectStudent.advance_project_based_course_id = AdvanceProjectBasedCourse.id')
					),
				),
				'conditions' => array('AdvanceProjectBasedCourse.phase' => $phase, 'AdvanceProjectStudent.is_delete' => 0), //$phaseCondition
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$AdvanceProjectBasedCourse = $this->AdvanceProjectBasedCourse->find('all', $projectBasedCourse);
			
			$orientation = array(
				'joins' => array(
					array(
						'table' => 'orientation_awareness_students',
						'alias' => 'OrientationAwarenessStudent',
						'type' => 'INNER',
						'conditions' => array('OrientationAwarenessStudent.orientation_awareness_course_id = OrientationAwarenessCourse.id')
					),
				),
				'conditions' => array('OrientationAwarenessCourse.phase' => $phase, 'OrientationAwarenessStudent.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$OrientationAwarenessCourse = $this->OrientationAwarenessCourse->find('all', $orientation);


			$starterCourse = array(
				'joins' => array(
					array(
						'table' => 'starter_course_students',
						'alias' => 'StarterCourseStudent',
						'type' => 'INNER',
						'conditions' => array('StarterCourseStudent.starter_course_id = StarterCourse.id')
					),
				),
				'conditions' => array('StarterCourse.phase' => $phase, 'StarterCourseStudent.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$StarterCourse = $this->StarterCourse->find('all', $starterCourse);
			
			/*---------------------------------------------- FIRST GRAPH END ---------------------------------*/

			/*---------------------------------------------- SECOND GRAPH START ---------------------------------*/
			/*------------------------------------------- Embedded Course --------------------------------*/
			$Embeded = array(
				'joins' => array(
					array(
						'table' => 'manage_embedded_course_attendees',
						'alias' => 'ManageEmbeddedCourseAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageEmbeddedCourseAttendee.aerospace_defense_embedded_course_id = AerospaceDefenseEmbeddedCourse.id')
					),
				),
				'conditions' => array($phaseCondition, 'AerospaceDefenseEmbeddedCourse.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$EmbeddedCourse = $this->AerospaceDefenseEmbeddedCourse->find('all', $Embeded);
		

			/*------------------------------------------- Training Process  --------------------------------*/
			$train_process = array(
				'joins' => array(
					array(
						'table' => 'manage_training_process_attendees',
						'alias' => 'ManageTrainingProcessAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageTrainingProcessAttendee.aerospace_defense_training_process_id = AerospaceDefenseTrainingProcess.id')
					),
				),
				'conditions' => array($phaseCondition, 'AerospaceDefenseTrainingProcess.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$TrainingProcess = $this->AerospaceDefenseTrainingProcess->find('all', $train_process);
		

			/*------------------------------------------- BootCamp --------------------------------*/
			$bootcamp = array(
				'joins' => array(
					array(
						'table' => 'manage_bootcamp_attendees',
						'alias' => 'ManageBootcampAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageBootcampAttendee.aerospace_defense_bootcamp_id = AerospaceDefenseBootcamp.id')
					),
				),
				'conditions' => array($phaseCondition, 'AerospaceDefenseBootcamp.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$BootCamp = $this->AerospaceDefenseBootcamp->find('all', $bootcamp);

			$drone_technology = array(
				'joins' => array(
					array(
						'table' => 'manage_drone_technology_attendees',
						'alias' => 'ManageDroneTechnologyAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageDroneTechnologyAttendee.aerospace_defense_drone_technology_id = AerospaceDefenseDroneTechnology.id')
					),
				),
				'conditions' => array('AerospaceDefenseDroneTechnology.phase'=>$phase,'AerospaceDefenseDroneTechnology.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			
			$DroneTechnology = $this->AerospaceDefenseDroneTechnology->find('all', $drone_technology);

			$valueStreamCourse = array(
				'joins' => array(
					array(
						'table' => 'manage_value_stream_course_attendees',
						'alias' => 'ManageValueStreamCourseAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageValueStreamCourseAttendee.aerospace_defense_value_stream_course_id = AerospaceDefenseValueStreamCourse.id')
					),
				),
				'conditions' => array('AerospaceDefenseValueStreamCourse.phase'=>$phase,'AerospaceDefenseValueStreamCourse.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			
			$ValueStreamCourse = $this->AerospaceDefenseValueStreamCourse->find('all', $valueStreamCourse);


			/*---------------------------------------------- SECOND GRAPH START ---------------------------------*/

			/*---------------------------------------------- THIRD GRAPH START ---------------------------------*/
			/*------------------------------------------- Defense Skilling --------------------------------*/
			$defense_skilling = array(
				'joins' => array(
					array(
						'table' => 'manage_skilling_attendees',
						'alias' => 'ManageSkillingAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageSkillingAttendee.aerospace_defense_skilling_id = AerospaceDefenseSkilling.id')
					),
				),
				'conditions' => array($phaseCondition, 'AerospaceDefenseSkilling.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$DefenseSkilling = $this->AerospaceDefenseSkilling->find('all', $defense_skilling);
		
			/*------------------------------------------- Defense Course --------------------------------*/
			$course_defense = array(
				'joins' => array(
					array(
						'table' => 'manage_courses_attendees',
						'alias' => 'ManageCourseAttendee',
						'type' => 'INNER',
						'conditions' => array('ManageCourseAttendee.aerospace_defense_course_id = AerospaceDefenseCourse.id')
					),
				),
				'conditions' => array($phaseCondition, 'AerospaceDefenseCourse.is_delete' => 0),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month'),
			);
			$DefenseCourse = $this->AerospaceDefenseCourse->find('all', $course_defense);
			

			/*---------------------------------------------- THIRD GRAPH START ---------------------------------*/

			/*---------------------------------------------- FOURTH GRAPH START ---------------------------------*/
			/*------------------------------------------- Startup Facilitation --------------------------------*/
			$StartupFacilitation = $this->ManageStartupFacilitation->find('all', array(
				'conditions' => $phaseCondition,
				'fields' => array('COUNT(*) AS count', 'company_name', 'id'),
				'group' => array('company_name'),
			));

			$startup_array = array();
			foreach ($StartupFacilitation as $item) {
				$startup_array[$item['ManageStartupFacilitation']['company_name']] = array(
					'count' => $item[0]['count'],
					'id' => $item['ManageStartupFacilitation']['id']
				);
			}

			
			/*---------------------------------------------- FOURTH GRAPH START ---------------------------------*/


			/*-------------------------------------- Target -------------------------------------*/
			$targets = $this->Targets->find('all', array(
				'conditions' => $phaseCondition,
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));

			$training_array = array();
			$academia_array = array();
			$skilling_array = array();

			foreach ($years as $year) {
				/*********************** Training Start ************************/
				$training_array['Internship']['Achieve']['Year'][$year] = 0;
				$training_array['AdvanceCourse']['Achieve']['Year'][$year] = 0;
				$training_array['OrientationCourse']['Achieve']['Year'][$year] = 0;
				$training_array['StarterCourse']['Achieve']['Year'][$year] = 0;

				$training_array['Internship']['Target']['Year'][$year] = 0;
				$training_array['AdvanceCourse']['Target']['Year'][$year] = 0;
				$training_array['OrientationCourse']['Target']['Year'][$year] = 0;
				$training_array['StarterCourse']['Target']['Year'][$year] = 0;
				/*********************** Training End ************************/

				/*********************** Academia Start ************************/
				$academia_array['EmbeddedCourse']['Achieve']['Year'][$year] = 0;
				$academia_array['TrainingProcess']['Achieve']['Year'][$year] = 0;
				$academia_array['BootCamp']['Achieve']['Year'][$year] = 0;
				$academia_array['DroneTechnology']['Achieve']['Year'][$year] = 0;
				$academia_array['ValueStreamCourse']['Achieve']['Year'][$year] = 0;

				$academia_array['EmbeddedCourse']['Target']['Year'][$year] = 0;
				$academia_array['TrainingProcess']['Target']['Year'][$year] = 0;
				$academia_array['BootCamp']['Target']['Year'][$year] = 0;
				$academia_array['DroneTechnology']['Target']['Year'][$year] = 0;
				$academia_array['ValueStreamCourse']['Target']['Year'][$year] = 0;
				/*********************** Academia End ************************/

				/*********************** Skilling Start ************************/
				$skilling_array['DefenseSkilling']['Achieve']['Year'][$year] = 0;
				$skilling_array['DefenseCourse']['Achieve']['Year'][$year] = 0;

				$skilling_array['DefenseSkilling']['Target']['Year'][$year] = 0;
				$skilling_array['DefenseCourse']['Target']['Year'][$year] = 0;
				/*********************** Skilling End ************************/


				foreach ($month as $m) {
					/*********************** Training Start ************************/
					$training_array['Internship']['Achieve'][$year][$m] = 0;
					$training_array['AdvanceCourse']['Achieve'][$year][$m] = 0;
					$training_array['OrientationCourse']['Achieve'][$year][$m] = 0;
					$training_array['StarterCourse']['Achieve'][$year][$m] = 0;

					$training_array['Internship']['Target'][$year][$m] = 0;
					$training_array['AdvanceCourse']['Target'][$year][$m] = 0;
					$training_array['OrientationCourse']['Target'][$year][$m] = 0;
					$training_array['StarterCourse']['Target'][$year][$m] = 0;
					/*********************** Training End ************************/

					/*********************** Academia Start ************************/
					$academia_array['EmbeddedCourse']['Achieve'][$year][$m] = 0;
					$academia_array['TrainingProcess']['Achieve'][$year][$m] = 0;
					$academia_array['BootCamp']['Achieve'][$year][$m] = 0;
					$academia_array['DroneTechnology']['Achieve'][$year][$m] = 0;
					$academia_array['ValueStreamCourse']['Achieve'][$year][$m] = 0;

					$academia_array['EmbeddedCourse']['Target'][$year][$m] = 0;
					$academia_array['TrainingProcess']['Target'][$year][$m] = 0;
					$academia_array['BootCamp']['Target'][$year][$m] = 0;
					$academia_array['DroneTechnology']['Target'][$year][$m] = 0;
					$academia_array['ValueStreamCourse']['Target'][$year][$m] = 0;
					/*********************** Academia End ************************/

					/*********************** Skilling Start ************************/
					$skilling_array['DefenseSkilling']['Achieve'][$year][$m] = 0;
					$skilling_array['DefenseCourse']['Achieve'][$year][$m] = 0;

					$skilling_array['DefenseSkilling']['Target'][$year][$m] = 0;
					$skilling_array['DefenseCourse']['Target'][$year][$m] = 0;
					/*********************** Skilling End ************************/
				}
			}

			/*---------------------------------------------- FIRST GRAPH---------------------------------*/
			foreach ($Training as $item) {
				$y = $item['InternshipFoundationCourse']['year'];
				$m = $item['InternshipFoundationCourse']['month'];
				$types = 'Internship';
				$training_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$training_array[$types]['Achieve']['Year'][$y] = array_sum($training_array[$types]['Achieve'][$y]);
				$training_array[$types]['Achieve']['count'] = array_sum($training_array[$types]['Achieve']['Year']);
			}
			foreach ($AdvanceProjectBasedCourse as $item) {
				$y = $item['AdvanceProjectBasedCourse']['year'];
				$m = $item['AdvanceProjectBasedCourse']['month'];
				$types = 'AdvanceCourse';
				$training_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$training_array[$types]['Achieve']['Year'][$y] = array_sum($training_array[$types]['Achieve'][$y]);
				$training_array[$types]['Achieve']['count'] = array_sum($training_array[$types]['Achieve']['Year']);
			}
			foreach ($OrientationAwarenessCourse as $item) {
				$y = $item['OrientationAwarenessCourse']['year'];
				$m = $item['OrientationAwarenessCourse']['month'];
				$types = 'OrientationCourse';
				$training_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$training_array[$types]['Achieve']['Year'][$y] = array_sum($training_array[$types]['Achieve'][$y]);
				$training_array[$types]['Achieve']['count'] = array_sum($training_array[$types]['Achieve']['Year']);
			}
			foreach ($StarterCourse as $item) {
				$y = $item['StarterCourse']['year'];
				$m = $item['StarterCourse']['month'];
				$types = 'StarterCourse';
				$training_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$training_array[$types]['Achieve']['Year'][$y] = array_sum($training_array[$types]['Achieve'][$y]);
				$training_array[$types]['Achieve']['count'] = array_sum($training_array[$types]['Achieve']['Year']);
			}

			/*---------------------------------------------- SECOND GRAPH---------------------------------*/
			foreach ($EmbeddedCourse as $item) {
				$y = $item['AerospaceDefenseEmbeddedCourse']['year'];
				$m = $item['AerospaceDefenseEmbeddedCourse']['month'];
				$types = 'EmbeddedCourse';
				$academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
				$academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
			}
			
			foreach ($TrainingProcess as $item) {
				$y = $item['AerospaceDefenseTrainingProcess']['year'];
				$m = $item['AerospaceDefenseTrainingProcess']['month'];
				$types = 'TrainingProcess';
				$academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
				$academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
			}
		

			foreach ($DroneTechnology as $item) {
				$y = $item['AerospaceDefenseDroneTechnology']['year'];
				$m = $item['AerospaceDefenseDroneTechnology']['month'];
				$types = 'DroneTechnology';
				$academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
				$academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
			}


			foreach ($ValueStreamCourse as $item) {
				$y = $item['AerospaceDefenseValueStreamCourse']['year'];
				$m = $item['AerospaceDefenseValueStreamCourse']['month'];
				$types = 'ValueStreamCourse';
				$academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
				$academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
			}

			/*---------------------------------------------- THIRD GRAPH---------------------------------*/
			foreach ($DefenseSkilling as $item) {
				$y = $item['AerospaceDefenseSkilling']['year'];
				$m = $item['AerospaceDefenseSkilling']['month'];
				$types = 'DefenseSkilling';
				$skilling_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$skilling_array[$types]['Achieve']['Year'][$y] = array_sum($skilling_array[$types]['Achieve'][$y]);
				$skilling_array[$types]['Achieve']['count'] = array_sum($skilling_array[$types]['Achieve']['Year']);
			}
			foreach ($DefenseCourse as $item) {
				$y = $item['AerospaceDefenseCourse']['year'];
				$m = $item['AerospaceDefenseCourse']['month'];
				$types = 'DefenseCourse';
				$skilling_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
				$skilling_array[$types]['Achieve']['Year'][$y] = array_sum($skilling_array[$types]['Achieve'][$y]);
				$skilling_array[$types]['Achieve']['count'] = array_sum($skilling_array[$types]['Achieve']['Year']);
			}

			/*----------------------------------------- Targets Loop ------------------------------------*/

			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				//Updated by Pavan Kumar M(04-12-2020)

				if ($type == 'Internship' || $type == 'AdvanceCourse' || $type == 'OrientationCourse' || $type == 'StarterCourse') {
					
					$training_array[$type]['Target'][$y][$m] = $item[0]['sum'];
					$training_array[$type]['Target']['Year'][$y] = array_sum($training_array[$type]['Target'][$y]);
					$training_array[$type]['Target']['count'] = array_sum($training_array[$type]['Target']['Year']);
				} elseif ($type == 'EmbeddedCourse' || $type == 'TrainingProcess' || $type == 'BootCamp' || $type == 'DroneTechnology' || $type == 'ValueStreamCourse') {
					$academia_array[$type]['Target'][$y][$m] = $item[0]['sum'];
					$academia_array[$type]['Target']['Year'][$y] = array_sum($academia_array[$type]['Target'][$y]);
					$academia_array[$type]['Target']['count'] = array_sum($academia_array[$type]['Target']['Year']);
				} elseif ($type == 'DefenseSkilling' || $type == 'DefenseCourse') {
					$skilling_array[$type]['Target'][$y][$m] = $item[0]['sum'];
					$skilling_array[$type]['Target']['Year'][$y] = array_sum($skilling_array[$type]['Target'][$y]);
					$skilling_array[$type]['Target']['count'] = array_sum($skilling_array[$type]['Target']['Year']);
				}

				//End of updates by Pavan Kumar M(04-12-2020)
			}

			$this->set('training_array', $training_array);
			$this->set('academia_array', $academia_array);
			$this->set('skilling_array', $skilling_array);
			$this->set('StartupFacilitation', $startup_array);
			
		}
	}

	/*------------------------Workshop------------------------------------------------------------*/
public function cyberSecurityDashboard($type = null, $year = null, $month = null)
	{
		$phase = $this->Session->read('Phase');
		$this->loadmodel('CyberSecurityResearch');
		$this->loadmodel('CsIndustryStartup');
		$this->loadModel('CsAwarenessSession');
		$this->loadModel('CyberHygieneHandbook');
		$this->loadModel('CsVolunteerProgram');
		if ($type != '' && $year != '' && $month != '') {
			$this->layout = 'ajax';

			if ($type == 'Internship') $model = 'ManageInternshipPool';
			else if ($type == 'Enablement') $model = 'ManageStartup';
			else if ($type == 'Training') $model = 'ManageCapacityBuilding';
			else if ($type == 'White Paper - News Letter') $model = 'ManageWhitePaper';
			else if ($type == 'Workshop') $model = 'ManageCyberSecurity';
			
			else if ($type == 'Research') $model = 'CyberSecurityResearch';
			else if ($type == 'Industry Startup') $model = 'CsIndustryStartup';
			else if ($type == 'Awareness Session') $model = 'CsAwarenessSession';
			else if ($type == 'CyberHygieneHandbook') $model = 'CyberHygieneHandbook';
            else if ($type == 'CsAwarenessPosters') $model = 'CyberHygieneHandbook';
            else if ($type == 'CsNewsLetter') $model = 'CyberHygieneHandbook';
			else if ($type == 'CsVolunteerProgramme') $model = 'CsVolunteerProgram';
			else if ($type == 'FacultyDevelopmentProgram') $model = 'CsVolunteerProgram';

			if ($model == 'CyberHygieneHandbook' || $model == 'CsVolunteerProgram') {
				$list = $this->$model->find('all', array(
					'conditions' => array('`' . $model . '`.type' => $type,'`' . $model . '`.phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
					'order' => array('`' . $model . '`.id DESC')
					));
				}else{
			$list = $this->$model->find('all', array(
				'conditions' => array('phase' => $phase, 'year' => $year, 'month' => $month),
				'order' => array('id DESC')
			));
		}
			 
			$title = $type . ' Of ' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $model);
			$this->set('model', $type);
			$this->render('cyber_security_dashboard_pop_up');
		} else {
			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();

			/*-------------------------------------------ManageTraining--------------------------------*/
			$manageInternshipPool = $this->ManageInternshipPool->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ManageStartup----------------------------------*/
			$manageStartup = $this->ManageStartup->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ManageCapacityBuilding----------------------------------*/
			$manageCapacityBuilding = $this->ManageCapacityBuilding->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ManageWhitePaper----------------------------------*/
			$manageWhitePaper = $this->ManageWhitePaper->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ManageCyberSecurity----------------------------------*/
			$manageCyberSecurity = $this->ManageCyberSecurity->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			$csResearch = $this->CyberSecurityResearch->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			$csIndustryStartup = $this->CsIndustryStartup->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			$csAwarenessSession = $this->CsAwarenessSession->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			$cyberHygieneHandbook = $this->CyberHygieneHandbook->find('all', array(
				'conditions' => array('phase' => $phase, 'type' => 'CyberHygieneHandbook'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			$awarenessPosters = $this->CyberHygieneHandbook->find('all', array(
				'conditions' => array('phase' => $phase, 'type' => 'CsAwarenessPosters'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			$newsLetters = $this->CyberHygieneHandbook->find('all', array(
				'conditions' => array('phase' => $phase, 'type' => 'CsNewsLetter'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));


			$volunteerProgram = $this->CsVolunteerProgram->find('all', array(
				'conditions' => array('phase' => $phase, 'type' => 'CsVolunteerProgramme'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			$facultyDevelopment = $this->CsVolunteerProgram->find('all', array(
				'conditions' => array('phase' => $phase, 'type' => 'FacultyDevelopmentProgram'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*-------------------------------------- Target -------------------------------------*/
			$targets = $this->Targets->find('all', array(
				'conditions' => array('phase' => $phase, 'type IN' => array('Internship', 'Enablement', 'Training', 'White Paper - News Letter', 'Workshop','Research','Industry Startup',
				'Awareness Session','CyberHygieneHandbook','CsAwarenessPosters','CsNewsLetter','CsVolunteerProgramme','FacultyDevelopmentProgram'
			)),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));

			$final_array = array();
			foreach ($years as $year) {
				$final_array['Internship']['Achieve']['Year'][$year] = 0;
				$final_array['Internship']['Target']['Year'][$year] = 0;

				$final_array['Enablement']['Achieve']['Year'][$year] = 0;
				$final_array['Enablement']['Target']['Year'][$year] = 0;

				$final_array['Training']['Achieve']['Year'][$year] = 0;
				$final_array['Training']['Target']['Year'][$year] = 0;

				$final_array['White Paper - News Letter']['Achieve']['Year'][$year] = 0;
				$final_array['White Paper - News Letter']['Target']['Year'][$year] = 0;

				$final_array['Workshop']['Achieve']['Year'][$year] = 0;
				$final_array['Workshop']['Target']['Year'][$year] = 0;

             
				$final_array['Research']['Achieve']['Year'][$year] = 0;
				$final_array['Research']['Target']['Year'][$year] = 0;

				$final_array['Industry Startup']['Achieve']['Year'][$year] = 0;
				$final_array['Industry Startup']['Target']['Year'][$year] = 0;

				$final_array['Awareness Session']['Achieve']['Year'][$year] = 0;
				$final_array['Awareness Session']['Target']['Year'][$year] = 0;

				$final_array['CyberHygieneHandbook']['Achieve']['Year'][$year] = 0;
				$final_array['CyberHygieneHandbook']['Target']['Year'][$year] = 0;

				$final_array['CsAwarenessPosters']['Achieve']['Year'][$year] = 0;
				$final_array['CsAwarenessPosters']['Target']['Year'][$year] = 0;

				$final_array['CsNewsLetter']['Achieve']['Year'][$year] = 0;
				$final_array['CsNewsLetter']['Target']['Year'][$year] = 0;

				$final_array['CsVolunteerProgramme']['Achieve']['Year'][$year] = 0;
				$final_array['CsVolunteerProgramme']['Target']['Year'][$year] = 0;

				$final_array['FacultyDevelopmentProgram']['Achieve']['Year'][$year] = 0;
				$final_array['FacultyDevelopmentProgram']['Target']['Year'][$year] = 0;
				foreach ($month as $m) {
					$final_array['Internship']['Achieve'][$year][$m] = 0;
					$final_array['Internship']['Target'][$year][$m] = 0;

					$final_array['Enablement']['Achieve'][$year][$m] = 0;
					$final_array['Enablement']['Target'][$year][$m] = 0;

					$final_array['Training']['Achieve'][$year][$m] = 0;
					$final_array['Training']['Target'][$year][$m] = 0;

					$final_array['White Paper - News Letter']['Achieve'][$year][$m] = 0;
					$final_array['White Paper - News Letter']['Target'][$year][$m] = 0;

					$final_array['Workshop']['Achieve'][$year][$m] = 0;
					$final_array['Workshop']['Target'][$year][$m] = 0;

				
					$final_array['Research']['Achieve'][$year][$m] = 0;
					$final_array['Research']['Target'][$year][$m] = 0;

					$final_array['Industry Startup']['Achieve'][$year][$m] = 0;
					$final_array['Industry Startup']['Target'][$year][$m] = 0;

					$final_array['Awareness Session']['Achieve'][$year][$m] = 0;
					$final_array['Awareness Session']['Target'][$year][$m] = 0;

					$final_array['CyberHygieneHandbook']['Achieve'][$year][$m] = 0;
					$final_array['CyberHygieneHandbook']['Target'][$year][$m] = 0;

					$final_array['CsAwarenessPosters']['Achieve'][$year][$m] = 0;
					$final_array['CsAwarenessPosters']['Target'][$year][$m] = 0;

					$final_array['CsNewsLetter']['Achieve'][$year][$m] = 0;
					$final_array['CsNewsLetter']['Target'][$year][$m] = 0;

					$final_array['CsVolunteerProgramme']['Achieve'][$year][$m] = 0;
					$final_array['CsVolunteerProgramme']['Target'][$year][$m] = 0;

					$final_array['FacultyDevelopmentProgram']['Achieve'][$year][$m] = 0;
					$final_array['FacultyDevelopmentProgram']['Target'][$year][$m] = 0;
				}
			}

			foreach ($manageInternshipPool as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Internship';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($manageStartup as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Enablement';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($manageCapacityBuilding as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Training';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($manageWhitePaper as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'White Paper - News Letter';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($manageCyberSecurity as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Workshop';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			
			foreach ($csResearch as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Research';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($csIndustryStartup as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Industry Startup';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($csAwarenessSession as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Awareness Session';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
		
			
			foreach ($cyberHygieneHandbook as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CyberHygieneHandbook';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			
			foreach ($awarenessPosters as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CsAwarenessPosters';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			
			foreach ($newsLetters as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CsNewsLetter';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			
			foreach ($volunteerProgram as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CsVolunteerProgramme';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($facultyDevelopment as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'FacultyDevelopmentProgram';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];
				
				$final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
				$final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
			}
		
			$this->set('final_array', $final_array);
		}
		
	}
	/*-----------------------Animation, Visual Effects,Gaming------------------------------------------*/


    public function animationDashboard($type = null, $year = null, $month = null)
	{
		$this->loadModel('AvgcIncubation');
		if ($type != '' && $year != '' && $month != '') {
			$this->layout = 'ajax';
			$phase = $this->Session->read('Phase');

			$phaseCondition = array('phase' => $phase);
			if ($type == 'Animation & Visual Effects') $model = 'ManageFacility';
			else if ($type == 'Incubation') $model = 'AvgcIncubation';
			else if ($type == 'Computer Generated Imagery') $model = 'AvgcIncubation';
			else if ($type == 'Motion Capture') $model = 'AvgcIncubation';
			else if ($type == 'Green Screen') $model = 'AvgcIncubation';
			else if ($type == 'Body Scan') $model = 'AvgcIncubation';

		if ($model == 'ManageFacility') {
				$list = $this->$model->find('all', array(
					'conditions' => array('year' => $year, 'month' => $month, $phaseCondition),
					'order' => array('id DESC')
				));
			} else {
				$list = $this->$model->find('all', array(
					'conditions' => array('type' => $type, 'year' => $year, 'month' => $month, $phaseCondition),
					'order' => array('id DESC')
				));
			}

			$title = $type . ' Of ' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $model);
			$this->render('animation_dashboard_pop_up');
		} else {
			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();
			$phase = $this->Session->read('Phase');
			$this->Session->write('DashboardAVGC', $phase);

			$modal_name = array('ManageFacility');
			$call_name = array('Animation & Visual Effects');

			$final_array = array();
			$phaseCondition = array('phase' => $phase);
			foreach ($modal_name as $count => $modal) {
				$Companies = $this->$modal->find('all', array(
					'conditions' => $phaseCondition,
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				$callName = $call_name[$count];

				foreach ($years as $year) {
					$final_array[$callName]['Achieve']['Year'][$year] = 0;
					$final_array[$callName]['Target']['Year'][$year] = 0;
					foreach ($month as $m) {
						$final_array[$callName]['Achieve'][$year][$m] = 0;
						$final_array[$callName]['Target'][$year][$m] = 0;

						$final_array['Incubation']['Achieve'][$year][$m] = 0;
						$final_array['Incubation']['Target'][$year][$m] = 0;

						$final_array['Computer Generated Imagery']['Achieve'][$year][$m] = 0;
						$final_array['Computer Generated Imagery']['Target'][$year][$m] = 0;

						$final_array['Motion Capture']['Achieve'][$year][$m] = 0;
						$final_array['Motion Capture']['Target'][$year][$m] = 0;

						$final_array['Green Screen']['Achieve'][$year][$m] = 0;
						$final_array['Green Screen']['Target'][$year][$m] = 0;

						$final_array['Body Scan']['Achieve'][$year][$m] = 0;
						$final_array['Body Scan']['Target'][$year][$m] = 0;
					}
				}
				foreach ($Companies as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array[$callName]['Achieve'][$y][$m] = $item[0]['count'];
					$final_array[$callName]['Achieve']['Year'][$y] = array_sum($final_array[$callName]['Achieve'][$y]);
					$final_array[$callName]['Achieve']['count'] = array_sum($final_array[$callName]['Achieve']['Year']);
				}

				$Incubation  =  $this->AvgcIncubation->find('all', array(
					'conditions' => array($phaseCondition, 'type' => 'Incubation'),
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				foreach ($Incubation as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array['Incubation']['Achieve'][$y][$m] = $item[0]['count'];
					$final_array['Incubation']['Achieve']['Year'][$y] = array_sum($final_array['Incubation']['Achieve'][$y]);
					$final_array['Incubation']['Achieve']['count'] = array_sum($final_array['Incubation']['Achieve']['Year']);
				}

				$ComputerGenerated  =  $this->AvgcIncubation->find('all', array(
					'conditions' => array($phaseCondition, 'type' => 'Computer Generated Imagery'),
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				foreach ($ComputerGenerated as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array['Computer Generated Imagery']['Achieve'][$y][$m] = $item[0]['count'];
					$final_array['Computer Generated Imagery']['Achieve']['Year'][$y] = array_sum($final_array['Computer Generated Imagery']['Achieve'][$y]);
					$final_array['Computer Generated Imagery']['Achieve']['count'] = array_sum($final_array['Computer Generated Imagery']['Achieve']['Year']);
				}

				$MotionCapture  =  $this->AvgcIncubation->find('all', array(
					'conditions' => array($phaseCondition, 'type' => 'Motion Capture'),
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				foreach ($MotionCapture as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array['Motion Capture']['Achieve'][$y][$m] = $item[0]['count'];
					$final_array['Motion Capture']['Achieve']['Year'][$y] = array_sum($final_array['Motion Capture']['Achieve'][$y]);
					$final_array['Motion Capture']['Achieve']['count'] = array_sum($final_array['Motion Capture']['Achieve']['Year']);
				}

				$GreenScreen  =  $this->AvgcIncubation->find('all', array(
					'conditions' => array($phaseCondition, 'type' => 'Green Screen'),
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				foreach ($GreenScreen as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array['Green Screen']['Achieve'][$y][$m] = $item[0]['count'];
					$final_array['Green Screen']['Achieve']['Year'][$y] = array_sum($final_array['Green Screen']['Achieve'][$y]);
					$final_array['Green Screen']['Achieve']['count'] = array_sum($final_array['Green Screen']['Achieve']['Year']);
				}

				$BodyScan  =  $this->AvgcIncubation->find('all', array(
					'conditions' => array($phaseCondition, 'type' => 'Body Scan'),
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month')
				));
				foreach ($BodyScan as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array['Body Scan']['Achieve'][$y][$m] = $item[0]['count'];
					$final_array['Body Scan']['Achieve']['Year'][$y] = array_sum($final_array['Body Scan']['Achieve'][$y]);
					$final_array['Body Scan']['Achieve']['count'] = array_sum($final_array['Body Scan']['Achieve']['Year']);
				}
			}

			/*-------------------------------------- Target -------------------------------------*/
			$targets = $this->Targets->find('all', array(
				'conditions' => array('type IN' => array('Animation & Visual Effects', 'Incubation', 'Computer Generated Imagery', 'Motion Capture', 'Green Screen', 'Body Scan'), $phaseCondition),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));

			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				$final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
				$final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
			}
			$this->set('final_array', $final_array);
		}
	}
	/*-----------------------Fabless Dashboard------------------------------------------*/
	public function fablessDashboard($type = null, $year = null, $month = null)
	{
		$this->loadModel('SuccessfulCompany');
		$this->loadModel('ExitedCompany');
		$phase = $this->Session->read('Phase');
		if ($type != '' && $year != '' && $month != '') {
			$this->layout = 'ajax';

			if ($type == 'Companies') $model = 'Companies';
			else if ($type == 'Partners') $model = 'PartnerDetail';
			else if ($type == 'Cohort') $model = 'IncubateeDetail';
			else if ($type == 'SuccessfulCompany') $model = 'SuccessfulCompany';
			else if ($type == 'ExitedCompany') $model = 'ExitedCompany';
			$list = $this->$model->find('all', array(
				'conditions' => array('year' => $year, 'month' => $month, 'phase' => $phase),
				'order' => array('id DESC')
			));

			$title = $type . ' Of ' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $model);
			// print_r($list);
			// print_r($model);
			$this->render('fabless_dashboard_pop_up');
		} else {
			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();
			$modal_name = array('Companies', 'PartnerDetail', 'IncubateeDetail', 'SuccessfulCompany', 'ExitedCompany');
			$call_name = array('Companies', 'Partners', 'Cohort', 'SuccessfulCompany', 'ExitedCompany');
			$final_array = array();
			foreach ($modal_name as $count => $modal) {
				$Companies = $this->$modal->find('all', array(
					'fields' => array('COUNT(*) AS count', 'year', 'month'),
					'group' => array('year', 'month'),
					'conditions' => array('phase' => $phase)
				));
				$callName = $call_name[$count];

				foreach ($years as $year) {
					$final_array[$callName]['Achieve']['Year'][$year] = 0;
					$final_array[$callName]['Target']['Year'][$year] = 0;

					foreach ($month as $m) {
						$final_array[$callName]['Achieve'][$year][$m] = 0;
						$final_array[$callName]['Target'][$year][$m] = 0;
					}
				}
				foreach ($Companies as $item) {
					$key = array_keys($item);
					$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
					$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
					$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

					$final_array[$callName]['Achieve'][$y][$m] = $item[0]['count'];
					$final_array[$callName]['Achieve']['Year'][$y] = array_sum($final_array[$callName]['Achieve'][$y]);
					$final_array[$callName]['Achieve']['count'] = array_sum($final_array[$callName]['Achieve']['Year']);
				}
			}

			/*-------------------------------------- Target -------------------------------------*/
			$targets = $this->Targets->find('all', array(
				'conditions' => array('type IN' => $call_name, 'phase' => $phase),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));

			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				$final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
				$final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
			}
			$this->set('final_array', $final_array);
			//print_r($final_array);
		}
	}



	/*-----------------------K-Tech Dashboard------------------------------------------*/
	public function ktechCenterDashboard($type = null, $year = null, $month = null)
	{
		$phase = $this->Session->read('Phase');
		$this->loadModel('TbiStartup');
		$this->loadModel('KtechNoOfNewProducts');
		if ($type != '' && $year != '' && $month != '') {
			$this->layout = 'ajax';


			if ($type == 'AgricultureInnovation') $model = 'ManageAgricultureInnovation';
			else if ($type == 'ProblemStatement') $model = 'ManageProblemStatement';
			else if ($type == 'EventConducted') $model = 'KtechEventConducted';
			else if ($type == 'Partnership') $model = 'KtechPartnership';
			else if ($type == 'Startup') $model = 'KtechFundRaisedStartup';
			else if ($type == 'CcampHackthon') $model = 'KtechHackthon';
			else if ($type == 'PreIdeation') $model = 'KtechPreIdeation';
			else if ($type == 'IdeationWorkshop') $model = 'KtechIdeationWorkshop';
			else if ($type == 'EcosystemBuildingService') $model = 'KtechEcosystemBuildingService';
			else if ($type == 'CcampWorkshop') $model = 'KtechWorkshop';
			else if ($type == 'CcampStartUpIncubated') $model = 'TbiStartup';
			else if ($type == 'CcampStartUpGraduated') $model = 'TbiStartup';
			else if ($type == 'NoOfNewProduct') $model = 'KtechNoOfNewProducts';

			if ($model == 'KtechHackthon' || $model == 'KtechPreIdeation' || $model == 'KtechIdeationWorkshop' || $model == 'KtechEcosystemBuildingService' || $model == 'KtechWorkshop') {
				$this->$model->bindModel(array('belongsTo' => array('TbiStartup')));
				$list = $this->$model->find('all', array(
					'conditions' => array('year' => $year, 'month' => $month, 'TbiStartup.phase' => $phase),
					'order' => array('.'.$model.'.id DESC')
				));
			} else if($model=='TbiStartup'){
			    $condition=array('phase' => $phase,'is_graduated'=>1,"university"=>"CCamp");
			    
			    if($type == 'CcampStartUpIncubated'){
			        $condition['is_incubated']=1;
			        $condition['MONTHNAME(incubation_start_date)']=$month;
			        $condition['Year(incubation_start_date)']=$year;
			    }
			    else{
			        $condition['is_graduated']=1;
			        $condition["MONTHNAME(str_to_date(graduated_date, '%d-%m-%Y'))"]=$month;
			        $condition["Year(str_to_date(graduated_date, '%d-%m-%Y'))"]=$year;
			        
			    }
			    
			    $list = $this->$model->find('all', array(
			       
					'conditions' => $condition,
					'order' => array('id DESC')
				));
			//	print_r($list);
			}
			else {
				$list = $this->$model->find('all', array(
					'conditions' => array('year' => $year, 'month' => $month, 'phase' => $phase),
					'order' => array('id DESC')
				));
			}

			$title = $type . ' Of ' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $model);
			$this->set('parmType', $type);

			$this->render('ktech_center_dashboard_pop_up');
		} else {
			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();

			/*------------------------------ ManageAgricultureInnovation --------------------------------*/
			$manageAgricultureInnovation = $this->ManageAgricultureInnovation->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ ManageProblemStatement ----------------------------------*/
			$ManageProblemStatement = $this->ManageProblemStatement->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechEventConducted ----------------------------------*/
			$KtechEventConducted = $this->KtechEventConducted->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechPartnership ----------------------------------*/
			$KtechPartnership = $this->KtechPartnership->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechFundRaisedStartup ----------------------------------*/
			$KtechFundRaisedStartup = $this->KtechFundRaisedStartup->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechHackathons ----------------------------------*/
			$this->KtechHackthon->bindModel(array('belongsTo' => array('TbiStartup')));
			$KtechHackathon = $this->KtechHackthon->find('all', array(
				'conditions' => array('TbiStartup.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechPre-Ideation ----------------------------------*/
			$this->KtechPreIdeation->bindModel(array('belongsTo' => array('TbiStartup')));
			$KtechPreIdeation = $this->KtechPreIdeation->find('all', array(
				'conditions' => array('TbiStartup.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechHackathons ----------------------------------*/
			$this->KtechIdeationWorkshop->bindModel(array('belongsTo' => array('TbiStartup')));
			$KtechIdeationWorkshop = $this->KtechIdeationWorkshop->find('all', array(
				'conditions' => array('TbiStartup.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechHackathons ----------------------------------*/
			$this->KtechEcosystemBuildingService->bindModel(array('belongsTo' => array('TbiStartup')));
			$KtechEcosystemBuildingService = $this->KtechEcosystemBuildingService->find('all', array(
				'conditions' => array('TbiStartup.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ KtechWorkshops ----------------------------------*/
			$this->KtechWorkshop->bindModel(array('belongsTo' => array('TbiStartup')));
			$KtechWorkshop = $this->KtechWorkshop->find('all', array(
				'conditions' => array('TbiStartup.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*------------------------------ StartUpIncubated ----------------------------------*/
			$StartUpIncubated = $this->TbiStartup->find('all', array(
				'conditions' => array('phase' => $phase,'is_incubated'=>1,"university"=>"CCamp"),
				'fields' => array('COUNT(*) AS count', 'MONTHNAME(incubation_start_date) AS month', 'Year(incubation_start_date) AS year'),
				'group' => array('MONTHNAME(incubation_start_date)','Year(incubation_start_date)')
			));
			/*------------------------------ StartUpGraduated ----------------------------------*/
			$StartUpGraduated = $this->TbiStartup->find('all', array(
				'conditions' => array('phase' => $phase,'is_graduated'=>1,"university"=>"CCamp"),
				'fields' => array('COUNT(*) AS count', 'MONTHNAME(str_to_date(graduated_date, "%d-%m-%Y")) AS month', 'Year(str_to_date(graduated_date, "%d-%m-%Y")) AS year'),
				'group' => array('MONTHNAME(str_to_date(graduated_date, "%d-%m-%Y"))','Year(str_to_date(graduated_date, "%d-%m-%Y"))')
			));
			/*------------------------------ KtechNoOfNewProducts ----------------------------------*/
			$noOfNewProducts = $this->KtechNoOfNewProducts->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			/*-------------------------------------- Target -------------------------------------*/
			$targets = $this->Targets->find('all', array(
				'conditions' => array('phase' => $phase, 'type IN' => array('AgricultureInnovation', 'ProblemStatement', 'EventConducted', 'Partnership', 'Startup','CcampHackthon','PreIdeation','IdeationWorkshop','EcosystemBuildingService','CcampWorkshop','NoOfNewProduct','CcampStartUpIncubated','CcampStartUpGraduated')),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));

			$final_array = array();
			foreach ($years as $year) {
				$final_array['AgricultureInnovation']['Achieve']['Year'][$year] = 0;
				$final_array['AgricultureInnovation']['Target']['Year'][$year] = 0;

				$final_array['ProblemStatement']['Achieve']['Year'][$year] = 0;
				$final_array['ProblemStatement']['Target']['Year'][$year] = 0;

				$final_array['EventConducted']['Achieve']['Year'][$year] = 0;
				$final_array['EventConducted']['Target']['Year'][$year] = 0;

				$final_array['Partnership']['Achieve']['Year'][$year] = 0;
				$final_array['Partnership']['Target']['Year'][$year] = 0;

				$final_array['Startup']['Achieve']['Year'][$year] = 0;
				$final_array['Startup']['Target']['Year'][$year] = 0;

				$final_array['CcampHackthon']['Achieve']['Year'][$year] = 0;
				$final_array['CcampHackthon']['Target']['Year'][$year] = 0;

				$final_array['PreIdeation']['Achieve']['Year'][$year] = 0;
				$final_array['PreIdeation']['Target']['Year'][$year] = 0;

				$final_array['IdeationWorkshop']['Achieve']['Year'][$year] = 0;
				$final_array['IdeationWorkshop']['Target']['Year'][$year] = 0;

				$final_array['EcosystemBuildingService']['Achieve']['Year'][$year] = 0;
				$final_array['EcosystemBuildingService']['Target']['Year'][$year] = 0;

				$final_array['CcampWorkshop']['Achieve']['Year'][$year] = 0;
				$final_array['CcampWorkshop']['Target']['Year'][$year] = 0;

				$final_array['CcampStartUpIncubated']['Achieve']['Year'][$year] = 0;
				$final_array['CcampStartUpIncubated']['Target']['Year'][$year] = 0;

				$final_array['CcampStartUpGraduated']['Achieve']['Year'][$year] = 0;
				$final_array['CcampStartUpGraduated']['Target']['Year'][$year] = 0;

				$final_array['NoOfNewProduct']['Achieve']['Year'][$year] = 0;
				$final_array['NoOfNewProduct']['Target']['Year'][$year] = 0;

				foreach ($month as $m) {
					$final_array['AgricultureInnovation']['Achieve'][$year][$m] = 0;
					$final_array['AgricultureInnovation']['Target'][$year][$m] = 0;

					$final_array['ProblemStatement']['Achieve'][$year][$m] = 0;
					$final_array['ProblemStatement']['Target'][$year][$m] = 0;

					$final_array['EventConducted']['Achieve'][$year][$m] = 0;
					$final_array['EventConducted']['Target'][$year][$m] = 0;

					$final_array['Partnership']['Achieve'][$year][$m] = 0;
					$final_array['Partnership']['Target'][$year][$m] = 0;

					$final_array['Startup']['Achieve'][$year][$m] = 0;
					$final_array['Startup']['Target'][$year][$m] = 0;

					$final_array['CcampHackthon']['Achieve'][$year][$m] = 0;
					$final_array['CcampHackthon']['Target'][$year][$m] = 0;

					$final_array['PreIdeation']['Achieve'][$year][$m] = 0;
					$final_array['PreIdeation']['Target'][$year][$m] = 0;

					$final_array['IdeationWorkshop']['Achieve'][$year][$m] = 0;
					$final_array['IdeationWorkshop']['Target'][$year][$m] = 0;

					$final_array['EcosystemBuildingService']['Achieve'][$year][$m] = 0;
					$final_array['EcosystemBuildingService']['Target'][$year][$m] = 0;

					$final_array['CcampWorkshop']['Achieve'][$year][$m] = 0;
					$final_array['CcampWorkshop']['Target'][$year][$m] = 0;

					$final_array['CcampStartUpIncubated']['Achieve'][$year][$m] = 0;
					$final_array['CcampStartUpIncubated']['Target'][$year][$m] = 0;

					$final_array['CcampStartUpGraduated']['Achieve'][$year][$m] = 0;
					$final_array['CcampStartUpGraduated']['Target'][$year][$m] = 0;

					$final_array['NoOfNewProduct']['Achieve'][$year][$m] = 0;
					$final_array['NoOfNewProduct']['Target'][$year][$m] = 0;
				}
			}

			foreach ($manageAgricultureInnovation as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'AgricultureInnovation';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($ManageProblemStatement as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'ProblemStatement';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechEventConducted as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'EventConducted';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechPartnership as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Partnership';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechFundRaisedStartup as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'Startup';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechHackathon as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CcampHackthon';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechPreIdeation as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'PreIdeation';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechIdeationWorkshop as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'IdeationWorkshop';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			//print_r($final_array);
			foreach ($KtechEcosystemBuildingService as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'EcosystemBuildingService';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($KtechWorkshop as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CcampWorkshop';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}

			foreach ($StartUpIncubated as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CcampStartUpIncubated';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			//print_r($final_array);
			foreach ($StartUpGraduated as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'CcampStartUpGraduated';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}

			foreach ($noOfNewProducts as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = 'NoOfNewProduct';
				$final_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$final_array[$key]['Achieve']['Year'][$y] = array_sum($final_array[$key]['Achieve'][$y]);
				$final_array[$key]['Achieve']['count'] = array_sum($final_array[$key]['Achieve']['Year']);
			}
			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				$final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
				$final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
				$final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
			}
            //print_r($final_array);
			$this->set('final_array', $final_array);
		}

	}
	


	public function miRoboticsDashboard($type = null, $year = null, $month = null)
	{
		$phase = $this->Session->read('Phase');
		$this->loadModel('OpenExperienceCentre');
	    $this->loadModel('MiMentorship');
		if ($type != '' && $year != '' && $month != '') {
			// print_r($type);
			$this->layout = 'ajax';

			if ($type == 'CapacityBuilding') $model = 'MiPrograms';
			else if ($type == 'InternationalConferences') $model = 'MiInternationalConferences';
			else if ($type == 'StartupConferences') $model = 'MiStartupConferences';
			else if ($type == 'GovtOfficialTraining') $model = 'MiOfficials';
			else if ($type == 'StudentEnrollment') $model = 'MiStudentEnrollment';
			else if ($type == 'Patent') $model = 'MiPatent';
			else if ($type == 'OpenExperienceCentre') $model = 'OpenExperienceCentre';
	        else if ($type == 'Mentorship') $model = 'MiMentorship';

			$list = $this->$model->find('all', array(
				'conditions' => array('phase' => $phase, 'year' => $year, 'month' => $month),
				'order' => array('id DESC')
			));
			//print_r($list);
			$title = $type . ' Of' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $type);
			$this->render('mi_robotics_pop_up');
		} else {

			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();
			$targets = $this->Targets->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));


			$mi_array = array();

			foreach ($years as $year) {
				$mi_array['CapacityBuilding']['Achieve']['Year'][$year] = 0;
				$mi_array['InternationalConferences']['Achieve']['Year'][$year] = 0;
				$mi_array['StartupConferences']['Achieve']['Year'][$year] = 0;
				$mi_array['GovtOfficialTraining']['Achieve']['Year'][$year] = 0;
				$mi_array['StudentEnrollment']['Achieve']['Year'][$year] = 0;
				$mi_array['Patent']['Achieve']['Year'][$year] = 0;
				$mi_array['OpenExperienceCentre']['Achieve']['Year'][$year] = 0;
                $mi_array['Mentorship']['Achieve']['Year'][$year] = 0;

				$mi_array['CapacityBuilding']['Target']['Year'][$year] = 0;
				$mi_array['InternationalConferences']['Target']['Year'][$year] = 0;
				$mi_array['StartupConferences']['Target']['Year'][$year] = 0;
				$mi_array['GovtOfficialTraining']['Target']['Year'][$year] = 0;
				$mi_array['StudentEnrollment']['Target']['Year'][$year] = 0;
				$mi_array['Patent']['Target']['Year'][$year] = 0;
				$mi_array['OpenExperienceCentre']['Target']['Year'][$year] = 0;
                $mi_array['Mentorship']['Target']['Year'][$year] = 0;

				foreach ($month as $m) {
					$mi_array['CapacityBuilding']['Achieve'][$year][$m] = 0;
					$mi_array['InternationalConferences']['Achieve'][$year][$m] = 0;
					$mi_array['StartupConferences']['Achieve'][$year][$m] = 0;
					$mi_array['GovtOfficialTraining']['Achieve'][$year][$m] = 0;
					$mi_array['StudentEnrollment']['Achieve'][$year][$m] = 0;
					$mi_array['Patent']['Achieve'][$year][$m] = 0;
					$mi_array['OpenExperienceCentre']['Achieve'][$year][$m] = 0;
                    $mi_array['Mentorship']['Achieve'][$year][$m] = 0;

					$mi_array['CapacityBuilding']['Target'][$year][$m] = 0;
					$mi_array['InternationalConferences']['Target'][$year][$m] = 0;
					$mi_array['StartupConferences']['Target'][$year][$m] = 0;
					$mi_array['GovtOfficialTraining']['Target'][$year][$m] = 0;
					$mi_array['StudentEnrollment']['Target'][$year][$m] = 0;
					$mi_array['Patent']['Target'][$year][$m] = 0;
					$mi_array['OpenExperienceCentre']['Target'][$year][$m] = 0;
                    $mi_array['Mentorship']['Target'][$year][$m] = 0;
				}
			}

			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				if (
					$type == 'CapacityBuilding' || $type == 'InternationalConferences' || $type == 'StartupConferences' ||
					$type == 'GovtOfficialTraining' || $type == 'StudentEnrollment' || $type == 'Patent' || $type == 'OpenExperienceCentre' || $type == 'Mentorship'
				) {

					$mi_array[$type]['Target'][$y][$m] = $item[0]['sum'];
					$mi_array[$type]['Target']['Year'][$y] = array_sum($mi_array[$type]['Target'][$y]);
					$mi_array[$type]['Target']['count'] = array_sum($mi_array[$type]['Target']['Year']);
				}
			}

			/*------------------------------- MiPrograms --------------------------------*/
			$MiPrograms_list = $this->MiPrograms->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiPrograms_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "CapacityBuilding";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- MiInternationalConferences --------------------------------*/
			$MiIc_list = $this->MiInternationalConferences->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiIc_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "InternationalConferences";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}
			/*------------------------------- MiStartupConferences --------------------------------*/
			$MiStartUp_list = $this->MiStartupConferences->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiStartUp_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "StartupConferences";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- MiOfficials  --------------------------------*/
			$MiOfficials_list = $this->MiOfficials->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiOfficials_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "GovtOfficialTraining";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- MiStudentEnrollment  --------------------------------*/
			$MiStudentEnrollment_list = $this->MiStudentEnrollment->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiStudentEnrollment_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "StudentEnrollment";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- MiStudentEnrollment  --------------------------------*/
			$MiPatent_list = $this->MiPatent->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));

			foreach ($MiPatent_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "Patent";
				$mi_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array[$key]['Achieve']['Year'][$y] = array_sum($mi_array[$key]['Achieve'][$y]);
				$mi_array[$key]['Achieve']['count'] = array_sum($mi_array[$key]['Achieve']['Year']);
			}


$OpenExperienceCentreNew = $this->OpenExperienceCentre->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($OpenExperienceCentreNew as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$mi_array['OpenExperienceCentre']['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array['OpenExperienceCentre']['Achieve']['Year'][$y] = array_sum($mi_array['OpenExperienceCentre']['Achieve'][$y]);
				$mi_array['OpenExperienceCentre']['Achieve']['count'] = array_sum($mi_array['OpenExperienceCentre']['Achieve']['Year']);
			}
		
			$Mentorship = $this->MiMentorship->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($Mentorship as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$mi_array['Mentorship']['Achieve'][$y][$m] = $item[0]['count'];
				$mi_array['Mentorship']['Achieve']['Year'][$y] = array_sum($mi_array['Mentorship']['Achieve'][$y]);
				$mi_array['Mentorship']['Achieve']['count'] = array_sum($mi_array['Mentorship']['Achieve']['Year']);
			}
			//print_r($mi_array);

			$this->set('mi_array', $mi_array);
		}
	}


public function iotDashboard($type = null, $year = null, $month = null)
	{
		$this->loadModel('IotGlobalConferencePaper');
		$this->loadModel('IotIncubatedResearcher');
		$this->loadModel('IotShowcasedPrototype');
		$this->loadModel('IotStartUp');
		$this->loadModel('GeneratedEmployment');
		$this->loadModel('IotIntellectualProperty');
		$this->loadModel('IotStartupsRisedFund');
		$this->loadModel('IotEventWorkshop');
		$this->loadModel('IotIndustryConnected');
		$this->loadModel('IotAcademiaConnected');
		$this->loadModel('IotDelegation');
		$this->loadModel('IotPilotsProject');
$this->loadModel('IotInvestorConnect');

        $this->loadModel('IotWorkshop');
		
		$phase = $this->Session->read('Phase');
		if ($type != '' && $year != '' && $month != '') {

			$this->layout = 'ajax';


			if ($type == 'IotStartUp') $model = 'IotStartUp';
			else if ($type == 'GeneratedEmployment') $model = 'GeneratedEmployment';
			else if ($type == 'IotIntellectualProperty') $model = 'IotIntellectualProperty';
			else if ($type == 'IotStartupsRisedFund') $model = 'IotStartupsRisedFund';
			else if ($type == 'IotEventWorkshop') $model = 'IotEventWorkshop';
			else if ($type == 'IotIndustryConnected') $model = 'IotIndustryConnected';
			else if ($type == 'IotAcademiaConnected') $model = 'IotAcademiaConnected';
			else if ($type == 'IotDelegation') $model = 'IotDelegation';
			else if ($type == 'IotPilotsProject') $model = 'IotPilotsProject';
			else if ($type == 'IotGlobalConferencePaper') $model = 'IotGlobalConferencePaper';
			else if ($type == 'IotIncubatedResearcher') $model = 'IotIncubatedResearcher';
			else if ($type == 'IotShowcasedPrototype') $model = 'IotShowcasedPrototype';
			
			else if ($type == 'Mentoring') $model = 'IotInvestorConnect';
            else if ($type == 'IotWorkshop') $model = 'IotWorkshop';
            else if ($type == 'Investor Connect') $model = 'IotInvestorConnect';
            else if ($type == 'Demo Days') $model = 'IotInvestorConnect';
            else if ($type == 'Startup Showcase') $model = 'IotInvestorConnect';
            else if ($type == 'Enterprise Connect') $model = 'IotInvestorConnect';
            else if ($type == 'Shark Tank') $model = 'IotInvestorConnect';
            else if ($type == 'Boot Camp') $model = 'IotInvestorConnect';
            else if ($type == 'International Connect') $model = 'IotInvestorConnect';
            else if ($type == 'Soft Landing') $model = 'IotInvestorConnect';
            else if ($type == 'EDP in Tier') $model = 'IotInvestorConnect';
            else if ($type == 'Women Entrepreneurs') $model = 'IotInvestorConnect';
            if ($model =='IotInvestorConnect') {
              $this->$model->bindModel(array('belongsTo' => array("IotStartUp")));
              $list = $this->$model->find('all', array(
               'conditions' => array('`' . $model . '`.type' => $type,'IotStartUp.phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
               'order' => array('`' . $model . '`.id DESC')
        	  ));
        	} else if($type == 'GeneratedEmployment' ||  $type == 'IotIntellectualProperty' || $type == 'IotStartupsRisedFund'  || $type == 'IotPilotsProject'){
        	  $this->$model->bindModel(array('belongsTo' => array("IotStartUp")));
        	  $list = $this->$model->find('all', array(
        	   'conditions' => array('IotStartUp.phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
        	   'order' => array('`' . $model . '`.id DESC')
              ));
        	}else{
        		$list = $this->$model->find('all', array(
        	     'conditions' => array('phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
        		 'order' => array('`' . $model . '`.id DESC')
        		));
        	}
            
            // 	if ($type != 'IotStartUp' && $type != 'IotEventWorkshop' && $type != 'IotIndustryConnected' && $type != 'IotDelegation' && $type != 'IotAcademiaConnected' && $type != 'IotIncubatedResearcher' && $type != 'IotGlobalConferencePaper' && $type != 'IotShowcasedPrototype' && $type != 'IotWorkshop') {
            // 				$this->$model->bindModel(array('belongsTo' => array("IotStartUp")));
            // 				$list = $this->$model->find('all', array(
            // 					'conditions' => array('`' . $model . '`.type' => $type, 'IotStartUp.phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
            // 					'order' => array('`' . $model . '`.id DESC')
            // 				));
            // 			} else {
            // 				$list = $this->$model->find('all', array(
            // 					'conditions' => array('phase' => $phase,  '`' . $model . '`.year' => $year, '`' . $model . '`.month' => $month),
            // 					'order' => array('`' . $model . '`.id DESC')
            // 				));
            // 			}

			$title = $type . ' Of' . $month . ' - ' . $year;
			$this->set('list', $list);
			$this->set('title', $title);
			$this->set('type', $type);
			$this->render('iot_pop_up');
		} else {

			$this->layout = 'fab_layout';
			$this->_userSessionCheckout();
			$years = array_reverse($this->getYear());
			$month = $this->getMonth();
			$targets = $this->Targets->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
				'group' => array('type', 'year', 'month')
			));


			$iot_array = array();

			foreach ($years as $year) {
				$iot_array['IotStartUp']['Achieve']['Year'][$year] = 0;
				$iot_array['GeneratedEmployment']['Achieve']['Year'][$year] = 0;
				$iot_array['IotIntellectualProperty']['Achieve']['Year'][$year] = 0;
				$iot_array['IotStartupsRisedFund']['Achieve']['Year'][$year] = 0;
				$iot_array['IotEventWorkshop']['Achieve']['Year'][$year] = 0;
				$iot_array['IotIndustryConnected']['Achieve']['Year'][$year] = 0;
				$iot_array['IotAcademiaConnected']['Achieve']['Year'][$year] = 0;
				$iot_array['IotDelegation']['Achieve']['Year'][$year] = 0;
				$iot_array['IotPilotsProject']['Achieve']['Year'][$year] = 0;
				$iot_array['IotGlobalConferencePaper']['Achieve']['Year'][$year] = 0;
				$iot_array['IotIncubatedResearcher']['Achieve']['Year'][$year] = 0;
				$iot_array['IotShowcasedPrototype']['Achieve']['Year'][$year] = 0;
				$iot_array['Mentoring']['Achieve']['Year'][$year] = 0;
				$iot_array['IotWorkshop']['Achieve']['Year'][$year] = 0;
				$iot_array['Investor Connect']['Achieve']['Year'][$year] = 0;
				$iot_array['Demo Days']['Achieve']['Year'][$year] = 0;
				$iot_array['Startup Showcase']['Achieve']['Year'][$year] = 0;
				$iot_array['Enterprise Connect']['Achieve']['Year'][$year] = 0;
				$iot_array['Shark Tank']['Achieve']['Year'][$year] = 0;
				$iot_array['Boot Camp']['Achieve']['Year'][$year] = 0;
				$iot_array['International Connect']['Achieve']['Year'][$year] = 0;
				$iot_array['Soft Landing']['Achieve']['Year'][$year] = 0;
				$iot_array['EDP in Tier']['Achieve']['Year'][$year] = 0;
				$iot_array['Women Entrepreneurs']['Achieve']['Year'][$year] = 0;

				$iot_array['IotStartUp']['Target']['Year'][$year] = 0;
				$iot_array['GeneratedEmployment']['Target']['Year'][$year] = 0;
				$iot_array['IotIntellectualProperty']['Target']['Year'][$year] = 0;
				$iot_array['IotStartupsRisedFund']['Target']['Year'][$year] = 0;
				$iot_array['IotEventWorkshop']['Target']['Year'][$year] = 0;
				$iot_array['IotIndustryConnected']['Target']['Year'][$year] = 0;
				$iot_array['IotAcademiaConnected']['Target']['Year'][$year] = 0;
				$iot_array['IotDelegation']['Target']['Year'][$year] = 0;
				$iot_array['IotPilotsProject']['Target']['Year'][$year] = 0;
				$iot_array['IotGlobalConferencePaper']['Target']['Year'][$year] = 0;
				$iot_array['IotIncubatedResearcher']['Target']['Year'][$year] = 0;
				$iot_array['IotShowcasedPrototype']['Target']['Year'][$year] = 0;
				$iot_array['Mentoring']['Target']['Year'][$year] = 0;
				$iot_array['IotWorkshop']['Target']['Year'][$year] = 0;
				$iot_array['Investor Connect']['Target']['Year'][$year] = 0;
				$iot_array['Demo Days']['Target']['Year'][$year] = 0;
				$iot_array['Startup Showcase']['Target']['Year'][$year] = 0;
				$iot_array['Enterprise Connect']['Target']['Year'][$year] = 0;
				$iot_array['Shark Tank']['Target']['Year'][$year] = 0;
				$iot_array['Boot Camp']['Target']['Year'][$year] = 0;
				$iot_array['International Connect']['Target']['Year'][$year] = 0;
				$iot_array['Soft Landing']['Target']['Year'][$year] = 0;
				$iot_array['EDP in Tier']['Target']['Year'][$year] = 0;
				$iot_array['Women Entrepreneurs']['Target']['Year'][$year] = 0;

				foreach ($month as $m) {
					$iot_array['IotStartUp']['Achieve'][$year][$m] = 0;
					$iot_array['GeneratedEmployment']['Achieve'][$year][$m] = 0;
					$iot_array['IotIntellectualProperty']['Achieve'][$year][$m] = 0;
					$iot_array['IotStartupsRisedFund']['Achieve'][$year][$m] = 0;
					$iot_array['IotEventWorkshop']['Achieve'][$year][$m] = 0;
					$iot_array['IotIndustryConnected']['Achieve'][$year][$m] = 0;
					$iot_array['IotAcademiaConnected']['Achieve'][$year][$m] = 0;
					$iot_array['IotDelegation']['Achieve'][$year][$m] = 0;
					$iot_array['IotPilotsProject']['Achieve'][$year][$m] = 0;
					$iot_array['IotGlobalConferencePaper']['Achieve'][$year][$m] = 0;
					$iot_array['IotIncubatedResearcher']['Achieve'][$year][$m] = 0;
					$iot_array['IotShowcasedPrototype']['Achieve'][$year][$m] = 0;
					$iot_array['Mentoring']['Achieve'][$year][$m] = 0;
					$iot_array['IotWorkshop']['Achieve'][$year][$m] = 0;
					$iot_array['Investor Connect']['Achieve'][$year][$m] = 0;
					$iot_array['Demo Days']['Achieve'][$year][$m] = 0;
					$iot_array['Startup Showcase']['Achieve'][$year][$m] = 0;
					$iot_array['Enterprise Connect']['Achieve'][$year][$m] = 0;
					$iot_array['Shark Tank']['Achieve'][$year][$m] = 0;
					$iot_array['Boot Camp']['Achieve'][$year][$m] = 0;
					$iot_array['International Connect']['Achieve'][$year][$m] = 0;
					$iot_array['Soft Landing']['Achieve'][$year][$m] = 0;
					$iot_array['EDP in Tier']['Achieve'][$year][$m] = 0;
					$iot_array['Women Entrepreneurs']['Achieve'][$year][$m] = 0;

					$iot_array['IotStartUp']['Target'][$year][$m] = 0;
					$iot_array['GeneratedEmployment']['Target'][$year][$m] = 0;
					$iot_array['IotIntellectualProperty']['Target'][$year][$m] = 0;
					$iot_array['IotStartupsRisedFund']['Target'][$year][$m] = 0;
					$iot_array['IotEventWorkshop']['Target'][$year][$m] = 0;
					$iot_array['IotIndustryConnected']['Target'][$year][$m] = 0;
					$iot_array['IotAcademiaConnected']['Target'][$year][$m] = 0;
					$iot_array['IotDelegation']['Target'][$year][$m] = 0;
					$iot_array['IotPilotsProject']['Target'][$year][$m] = 0;
					$iot_array['IotGlobalConferencePaper']['Target'][$year][$m] = 0;
					$iot_array['IotIncubatedResearcher']['Target'][$year][$m] = 0;
					$iot_array['IotShowcasedPrototype']['Target'][$year][$m] = 0;
					$iot_array['Mentoring']['Target'][$year][$m] = 0;
					$iot_array['IotWorkshop']['Target'][$year][$m] = 0;
					$iot_array['Investor Connect']['Target'][$year][$m] = 0;
					$iot_array['Demo Days']['Target'][$year][$m] = 0;
					$iot_array['Startup Showcase']['Target'][$year][$m] = 0;
					$iot_array['Enterprise Connect']['Target'][$year][$m] = 0;
					$iot_array['Shark Tank']['Target'][$year][$m] = 0;
					$iot_array['Boot Camp']['Target'][$year][$m] = 0;
					$iot_array['International Connect']['Target'][$year][$m] = 0;
					$iot_array['Soft Landing']['Target'][$year][$m] = 0;
					$iot_array['EDP in Tier']['Target'][$year][$m] = 0;
					$iot_array['Women Entrepreneurs']['Target'][$year][$m] = 0;
				}
			}

			foreach ($targets as $item) {
				$y = $item['Targets']['year'];
				$m = $item['Targets']['month'];
				$type = $item['Targets']['type'];

				if (
					$type == 'IotStartUp' || $type == 'GeneratedEmployment' || $type == 'IotIntellectualProperty' || $type == 'IotStartupsRisedFund' ||
					$type == 'IotEventWorkshop' || $type == 'IotIndustryConnected' || $type == 'IotAcademiaConnected' || $type == 'IotDelegation' || $type == 'IotPilotsProject' ||
					$type == 'IotIncubatedResearcher' || $type == 'IotGlobalConferencePaper' || $type == 'IotShowcasedPrototype' || $type == 'Mentoring' || $type == 'IotWorkshop' || $type == 'Demo Days' || $type == 'Startup Showcase' || $type == 'Enterprise Connect' || $type == 'Shark Tank'
                    || $type == 'Investor Connect' || $type == 'IotInvestorConnect' || $type  == 'Boot Camp'  || $type  == 'International Connect'  || $type  == 'Soft Landing' || $type  == 'EDP in Tier' || $type  == 'Women Entrepreneurs'
				) {

					$iot_array[$type]['Target'][$y][$m] = $item[0]['sum'];
					$iot_array[$type]['Target']['Year'][$y] = array_sum($iot_array[$type]['Target'][$y]);
					$iot_array[$type]['Target']['count'] = array_sum($iot_array[$type]['Target']['Year']);
				}
			}

			/*------------------------------- IotStartUp --------------------------------*/
			$IotStartUp_list = $this->IotStartUp->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotStartUp_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotStartUp";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- GeneratedEmployment --------------------------------*/
			$this->GeneratedEmployment->bindModel(array('belongsTo' => array("IotStartUp")));
			$GeneratedEmployment_list = $this->GeneratedEmployment->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($GeneratedEmployment_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "GeneratedEmployment";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotIntellectualProperty --------------------------------*/
			
            $this->IotIntellectualProperty->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotIntellectualProperty_list = $this->IotIntellectualProperty->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotIntellectualProperty_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotIntellectualProperty";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotStartupsRisedFund --------------------------------*/
			$this->IotStartupsRisedFund->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotStartupsRisedFund_list = $this->IotStartupsRisedFund->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotStartupsRisedFund_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotStartupsRisedFund";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotEventWorkshop --------------------------------*/
			$IotEventWorkshop_list = $this->IotEventWorkshop->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotEventWorkshop_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotEventWorkshop";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotIndustryConnected  --------------------------------*/
			$IotIndustryConnected_list = $this->IotIndustryConnected->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotIndustryConnected_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotIndustryConnected";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotAcademiaConnected  --------------------------------*/
			$IotAcademiaConnected_list = $this->IotAcademiaConnected->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotAcademiaConnected_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotAcademiaConnected";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotDelegation  --------------------------------*/

			$IotDelegation_list = $this->IotDelegation->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotDelegation_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotDelegation";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotPilotsProject  --------------------------------*/
			$this->IotPilotsProject->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotPilotsProject_list = $this->IotPilotsProject->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotPilotsProject_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotPilotsProject";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotIncubatedResearcher 30-05-2022  --------------------------------*/

			$IotIncubatedResearcher_list = $this->IotIncubatedResearcher->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotIncubatedResearcher_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotIncubatedResearcher";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}

			/*------------------------------- IotGlobalConferencePaper 30-05-2022 --------------------------------*/

			$IotGlobalConferencePaper_list = $this->IotGlobalConferencePaper->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotGlobalConferencePaper_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotGlobalConferencePaper";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}


			/*------------------------------- IotShowcasedPrototype 30-05-2022 --------------------------------*/

			$IotShowcasedPrototype_list = $this->IotShowcasedPrototype->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotShowcasedPrototype_list as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
				$key = "IotShowcasedPrototype";
				$iot_array[$key]['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array[$key]['Achieve']['Year'][$y] = array_sum($iot_array[$key]['Achieve'][$y]);
				$iot_array[$key]['Achieve']['count'] = array_sum($iot_array[$key]['Achieve']['Year']);
			}
			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotMentoring = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Mentoring'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotMentoring as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Mentoring']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Mentoring']['Achieve']['Year'][$y] = array_sum($iot_array['Mentoring']['Achieve'][$y]);
				$iot_array['Mentoring']['Achieve']['count'] = array_sum($iot_array['Mentoring']['Achieve']['Year']);
			}

			$IotWorkshop = $this->IotWorkshop->find('all', array(
				'conditions' => array('phase' => $phase),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotWorkshop as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['IotWorkshop']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['IotWorkshop']['Achieve']['Year'][$y] = array_sum($iot_array['IotWorkshop']['Achieve'][$y]);
				$iot_array['IotWorkshop']['Achieve']['count'] = array_sum($iot_array['IotWorkshop']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotInvestor = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Investor Connect'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
		
			foreach ($IotInvestor as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Investor Connect']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Investor Connect']['Achieve']['Year'][$y] = array_sum($iot_array['Investor Connect']['Achieve'][$y]);
				$iot_array['Investor Connect']['Achieve']['count'] = array_sum($iot_array['Investor Connect']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotDemoDays = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Demo Days'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotDemoDays as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Demo Days']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Demo Days']['Achieve']['Year'][$y] = array_sum($iot_array['Demo Days']['Achieve'][$y]);
				$iot_array['Demo Days']['Achieve']['count'] = array_sum($iot_array['Demo Days']['Achieve']['Year']);
			}


			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotStartupShowcase = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Startup Showcase'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotStartupShowcase as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Startup Showcase']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Startup Showcase']['Achieve']['Year'][$y] = array_sum($iot_array['Startup Showcase']['Achieve'][$y]);
				$iot_array['Startup Showcase']['Achieve']['count'] = array_sum($iot_array['Startup Showcase']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotEnterpriseConnect = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Enterprise Connect'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotEnterpriseConnect as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Enterprise Connect']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Enterprise Connect']['Achieve']['Year'][$y] = array_sum($iot_array['Enterprise Connect']['Achieve'][$y]);
				$iot_array['Enterprise Connect']['Achieve']['count'] = array_sum($iot_array['Enterprise Connect']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotSharkTank = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Shark Tank'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotSharkTank as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Shark Tank']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Shark Tank']['Achieve']['Year'][$y] = array_sum($iot_array['Shark Tank']['Achieve'][$y]);
				$iot_array['Shark Tank']['Achieve']['count'] = array_sum($iot_array['Shark Tank']['Achieve']['Year']);
			}
			

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotBootCamps = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Boot Camp'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotBootCamps as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Boot Camp']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Boot Camp']['Achieve']['Year'][$y] = array_sum($iot_array['Boot Camp']['Achieve'][$y]);
				$iot_array['Boot Camp']['Achieve']['count'] = array_sum($iot_array['Boot Camp']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotStartupShowcase = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'International Connect'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotStartupShowcase as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['International Connect']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['International Connect']['Achieve']['Year'][$y] = array_sum($iot_array['International Connect']['Achieve'][$y]);
				$iot_array['International Connect']['Achieve']['count'] = array_sum($iot_array['International Connect']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotSoftLanding = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Soft Landing'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotSoftLanding as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Soft Landing']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Soft Landing']['Achieve']['Year'][$y] = array_sum($iot_array['Soft Landing']['Achieve'][$y]);
				$iot_array['Soft Landing']['Achieve']['count'] = array_sum($iot_array['Soft Landing']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotEDPInTier = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'EDP in Tier'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotEDPInTier as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['EDP in Tier']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['EDP in Tier']['Achieve']['Year'][$y] = array_sum($iot_array['EDP in Tier']['Achieve'][$y]);
				$iot_array['EDP in Tier']['Achieve']['count'] = array_sum($iot_array['EDP in Tier']['Achieve']['Year']);
			}

			$this->IotInvestorConnect->bindModel(array('belongsTo' => array("IotStartUp")));
			$IotWomenEntrepreneurs = $this->IotInvestorConnect->find('all', array(
				'conditions' => array('IotStartUp.phase' => $phase, 'type' => 'Women Entrepreneurs'),
				'fields' => array('COUNT(*) AS count', 'year', 'month'),
				'group' => array('year', 'month')
			));
			foreach ($IotWomenEntrepreneurs as $item) {
				$key = array_keys($item);
				$key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
				$y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
				$m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);

				$iot_array['Women Entrepreneurs']['Achieve'][$y][$m] = $item[0]['count'];
				$iot_array['Women Entrepreneurs']['Achieve']['Year'][$y] = array_sum($iot_array['Women Entrepreneurs']['Achieve'][$y]);
				$iot_array['Women Entrepreneurs']['Achieve']['count'] = array_sum($iot_array['Women Entrepreneurs']['Achieve']['Year']);
			}


			$this->set('iot_array', $iot_array);
		}
	}

	public function financeDashboard($type)
	{
		$this->layout = 'fab_layout';
		$this->_userSessionCheckout();
		$this->loadModel('Financial');
		$this->loadModel('Expenditure');
		$phase = $this->Session->read('Phase');

		if ($type == "dsAiFund") {

			$types = "Data Science and AI";
		} else if ($type == "aerospaceFund") {

			$types = "Aerospace & Defense";
		} else if ($type == "cyberSecurityFund") {

			$types = "Cyber Security";
		} else if ($type == "iotFund") {

			$types = "IOT";
		} else if ($type == "roboticsFund") {

			$types = "MI & Robotics";
		} else if ($type == "animationFund") {

			$types = "Animation";
		} else if ($type == "ktechCenterFund") {

			$types = "KTECH Centre";
		} else if ($type == "fablessFund") {

			$types = "Fabless";
		}

		$this->Financial->bindModel(array("belongsTo" => array("FinancialYear")));
		$funds = $this->Financial->find('first', array('conditions' => array('phase' => $phase, 'types' => $types, 'FinancialYear.current' => 1)));

		$this->Expenditure->bindModel(array("belongsTo" => array("FinancialYear")));
		$manage_list = $this->Expenditure->find('all', array('conditions' => array('phase' => $phase, 'Expenditure.types' => $types, 'FinancialYear.current' => 1), "order" => array('Expenditure.id DESC')));

		$this->set('manage_list', $manage_list);
		$this->set('funds', $funds);
		$this->set('types', $types);
	}
}
