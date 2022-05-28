<?php
App::uses('AppController', 'Controller');
class DashboardController extends AppController{
    public $helpers = array('Html', 'Form', 'Js', 'Session');
    public $components = array('RequestHandler', 'Email');
    public $uses=array('Mentor','InvestorConnect','MarketResearch','Targets','Sector', 'DsReportPublished','Hackathon','SolutionSupport','LiasoningDept','DeptFollowup','EnrolledTrainer','Trainee','TraineeSecuredJob',
        'ManageTraining','ManageAttendees','ManageSkill','ManageSkillAttendee','ManageWorking','ManageResearchProject','ManageResearchProjectIndustry','ManageAerospaceTraining',
        'ManageInternshipPool','ManageStartup','ManageCapacityBuilding','ManageWhitePaper','ManageCyberSecurity',
        'ManageFacility','Companies','ManageAgricultureInnovation',
        'MiPrograms','MiInternationalConferences','MiStartupConferences','MiOfficials','MiStudentEnrollment',"MiPatent",
        "IotResearchIncubation","GeneratedEmployment","WhitePaper","Poc","SocietalProject","ManageIotCurriculum","ManageIotStudentDetail","ManageIntellectualProperty",
        "DsReportPublished","DsReportProcess","DsMasterClass","DsAiPathshala","DsTechMentoring","DsHackathon","DsInvestorConnect"
    );

    /*-----------------------Data Science And AI Dashboard------------------------------------------------*/
    public function dataScienceDashboard(){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $years=array_reverse($this->getYear());
        $month=$this->getMonth();
        /*---------------------------------------------- FIRST GRAPH---------------------------------*/
        /*-------------------------------------------Mentors--------------------------------*/
        $this->Mentor->unbindModel(array('belongsTo'=>array('Sector')));
        $mentor_list = $this->Mentor->find('all',array(
           'fields' => array('COUNT(*) AS count','year','month'),
           'group'=>array('year','month')
        ));
        /*------------------------------------------Investors ------------------------------*/
        $investor_list= $this->InvestorConnect->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        /*------------------------------------ Market Research -----------------------------*/
        $market_list = $this->MarketResearch->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        /*-------------------------------------- Target -------------------------------------*/
        $targets=$this->Targets->find('all',array(
            'fields' => array('SUM(count) AS sum','year','month','type'),
            'group'=>array('type','year','month')
        ));


        $final_array=array();
        $research_array=array();
        $social_array=array();
        $artificial_array=array();
        $events_array = array(); // By Pavan Kumar M(27/10/2020)

        foreach($years as $year){
            $final_array['Mentors']['Achieve']['Year'][$year]=0;
            $final_array['Investor']['Achieve']['Year'][$year]=0;
            $final_array['Market']['Achieve']['Year'][$year]=0;

            $final_array['Mentors']['Target']['Year'][$year]=0;
            $final_array['Investor']['Target']['Year'][$year]=0;
            $final_array['Market']['Target']['Year'][$year]=0;

            /*----------------------Research---------------------*/
            $research_array['ReportPublished']['Achieve']['Year'][$year]=0;
            $research_array['ReportProcess']['Achieve']['Year'][$year]=0;
            $research_array['ReportPublished']['Target']['Year'][$year]=0;
            $research_array['ReportProcess']['Target']['Year'][$year]=0;

            /*-----------------Socialitical solutions--------------*/
            $social_array['SolutionSupport']['Achieve']['Year'][$year]=0;
            $social_array['DeptLicense']['Achieve']['Year'][$year]=0;
            $social_array['DeptFollowup']['Achieve']['Year'][$year]=0;
            $social_array['SolutionSupport']['Target']['Year'][$year]=0;
            $social_array['DeptLicense']['Target']['Year'][$year]=0;
            $social_array['DeptFollowup']['Target']['Year'][$year]=0;

            /*-----------------------Artificial Intelligence ------------------*/
            $artificial_array['EnrolledTrainer']['Achieve']['Year'][$year]=0;
            $artificial_array['EnrolledTrainer']['Target']['Year'][$year]=0;
            $artificial_array['Trainee']['Achieve']['Year'][$year]=0;
            $artificial_array['Trainee']['Target']['Year'][$year]=0;
            $artificial_array['TraineeSecuredJob']['Achieve']['Year'][$year]=0;
            $artificial_array['TraineeSecuredJob']['Target']['Year'][$year]=0;
            $artificial_array['ReportProcess']['Achieve']['Year'][$year]=0;
            $artificial_array['ReportProcess']['Target']['Year'][$year]=0;


            $artificial_array['EnrolledTrainer']['Achieve']['count']=0;
            $artificial_array['EnrolledTrainer']['Target']['count']=0;
            $artificial_array['Trainee']['Achieve']['count']=0;
            $artificial_array['Trainee']['Target']['count']=0;
            $artificial_array['TraineeSecuredJob']['Achieve']['count']=0;
            $artificial_array['TraineeSecuredJob']['Target']['count']=0;
            $artificial_array['ReportProcess']['Achieve']['count']=0;
            $artificial_array['ReportProcess']['Target']['count']=0;

            /*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
			$events_array['MasterClass']['Events']['Year'][$year]=0;
			$events_array['MasterClass']['Events']['count']=0;
			$events_array['AiPathshala']['Events']['Year'][$year]=0;
			$events_array['AiPathshala']['Events']['count']=0;
			$events_array['TechMentoring']['Events']['Year'][$year]=0;
			$events_array['TechMentoring']['Events']['count']=0;
			$events_array['Hackathon']['Events']['Year'][$year]=0;
			$events_array['Hackathon']['Events']['count']=0;
			$events_array['InvestorConnect']['Events']['Year'][$year]=0;
			$events_array['InvestorConnect']['Events']['count']=0;
			/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
			
			
            foreach($month as $m){
                $final_array['Mentors']['Achieve'][$year][$m]=0;
                $final_array['Investor']['Achieve'][$year][$m]=0;
                $final_array['Market']['Achieve'][$year][$m]=0;

                $final_array['Mentors']['Target'][$year][$m]=0;
                $final_array['Investor']['Target'][$year][$m]=0;
                $final_array['Market']['Target'][$year][$m]=0;

                /*-----------------Research--------------------*/
                $research_array['ReportPublished']['Achieve'][$year][$m]=0;
                $research_array['ReportProcess']['Achieve'][$year][$m]=0;
                $research_array['ReportPublished']['Target'][$year][$m]=0;
                $research_array['ReportProcess']['Target'][$year][$m]=0;

                /*-----------------Socialitical solutions--------------*/
                $social_array['SolutionSupport']['Achieve'][$year][$m]=0;
                $social_array['DeptLicense']['Achieve'][$year][$m]=0;
                $social_array['DeptFollowup']['Achieve'][$year][$m]=0;
                $social_array['SolutionSupport']['Target'][$year][$m]=0;
                $social_array['DeptLicense']['Target'][$year][$m]=0;
                $social_array['DeptFollowup']['Target'][$year][$m]=0;

                /*-----------------------Artificial Intelligence ------------------*/
                $artificial_array['EnrolledTrainer']['Achieve'][$year][$m]=0;
                $artificial_array['Trainee']['Achieve'][$year][$m]=0;
                $artificial_array['TraineeSecuredJob']['Achieve'][$year][$m]=0;
                $artificial_array['EnrolledTrainer']['Target'][$year][$m]=0;
                $artificial_array['Trainee']['Target'][$year][$m]=0;
                $artificial_array['TraineeSecuredJob']['Target'][$year][$m]=0;
                $artificial_array['Hackathon']['Target'][$year][$m]=0;
                $artificial_array['Hackathon']['Achieve'][$year][$m]=0;
                
                
                /*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
				$events_array['MasterClass']['Events'][$year][$m]=0;
				$events_array['AiPathshala']['Events'][$year][$m]=0;
				$events_array['TechMentoring']['Events'][$year][$m]=0;
				$events_array['Hackathon']['Events'][$year][$m]=0;
				$events_array['InvestorConnect']['Events'][$year][$m]=0;
				/*-----------------------Events - By Pavan Kumar M(27/10/2020)------------------*/
            }
        }
        foreach($mentor_list as $item){
            $y=$item['Mentor']['year'];
            $m=$item['Mentor']['month'];
            $final_array['Mentors']['Achieve'][$y][$m]=$item[0]['count'];
            $final_array['Mentors']['Achieve']['Year'][$y]=array_sum($final_array['Mentors']['Achieve'][$y]);
            $final_array['Mentors']['Achieve']['count']=array_sum($final_array['Mentors']['Achieve']['Year']);
        }
        foreach($investor_list as $item){
            $y=$item['InvestorConnect']['year'];
            $m=$item['InvestorConnect']['month'];
            $final_array['Investor']['Achieve'][$y][$m]=$item[0]['count'];
            $final_array['Investor']['Achieve']['Year'][$y]=array_sum($final_array['Investor']['Achieve'][$y]);
            $final_array['Investor']['Achieve']['count']=array_sum($final_array['Investor']['Achieve']['Year']);
        }
        foreach($market_list as $item){
            $y=$item['MarketResearch']['year'];
            $m=$item['MarketResearch']['month'];
            $final_array['Market']['Achieve'][$y][$m]=$item[0]['count'];
            $final_array['Market']['Achieve']['Year'][$y]=array_sum($final_array['Market']['Achieve'][$y]);
            $final_array['Market']['Achieve']['count']=array_sum($final_array['Market']['Achieve']['Year']);
        }
        foreach($targets as $item){
            $y=$item['Targets']['year'];
           
            $type=$item['Targets']['type'];
             $item[0]['sum']=round($item[0]['sum']/12);
            foreach($month as $m){
               
                if($type=='Investor' || $type=='Market' || $type=='Mentors'){
                    $final_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $final_array[$type]['Target']['Year'][$y]=array_sum($final_array[$type]['Target'][$y]);
                    $final_array[$type]['Target']['count']=array_sum($final_array[$type]['Target']['Year']);
                }
                else  if($type=='ReportPublished' || $type=='ReportProcess'){
                    $research_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $research_array[$type]['Target']['Year'][$y]=array_sum($research_array[$type]['Target'][$y]);
                    $research_array[$type]['Target']['count']=array_sum($research_array[$type]['Target']['Year']);
                }
                else  if($type=='SolutionSupport' || $type=='DeptLicense' || $type=='DeptFollowup'){
                    $social_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $social_array[$type]['Target']['Year'][$y]=array_sum($social_array[$type]['Target'][$y]);
                    $social_array[$type]['Target']['count']=array_sum($social_array[$type]['Target']['Year']);
                }
                else  if($type=='Hackathon' || $type=='TraineeSecuredJob' || $type=='Trainee' || $type=='EnrolledTrainer'){
                    $artificial_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $artificial_array[$type]['Target']['Year'][$y]=array_sum($artificial_array[$type]['Target'][$y]);
                    $artificial_array[$type]['Target']['count']=array_sum($artificial_array[$type]['Target']['Year']);
                }
            }

        }

        /*-------------------------------------------------SECOND GRAPH ON RESEARCH & HACKATHONS----------------------*/
        /*-------------------------------DsReportPublished --------------------------------*/
        $research_paper_list = $this->DsReportPublished->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        /*------------------------------- DsReportProcess -------------------------*/
        $hackathon_list= $this->DsReportProcess->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));

        foreach($research_paper_list as $item){
            $y=$item['DsReportPublished']['year'];
            $m=$item['DsReportPublished']['month'];
            $research_array['ReportPublished']['Achieve'][$y][$m]=$item[0]['count'];
            $research_array['ReportPublished']['Achieve']['Year'][$y]=array_sum($research_array['ReportPublished']['Achieve'][$y]);
            $research_array['ReportPublished']['Achieve']['count']=array_sum($research_array['ReportPublished']['Achieve']['Year']);
        }
        foreach($hackathon_list as $item){
            $y=$item[0]['year'];
            $m=date('F',strtotime($item['ReportProcess']['date']));
            $research_array['ReportProcess']['Achieve'][$y][$m]=$item[0]['count'];
            $research_array['ReportProcess']['Achieve']['Year'][$y]=array_sum($research_array['ReportProcess']['Achieve'][$y]);
            $research_array['ReportProcess']['Achieve']['count']=array_sum($research_array['ReportProcess']['Achieve']['Year']);
        }

        /*----------------------------------------THIRD GRAPH ON Societal Solutions-----------------------------------*/
        /*---------------Solution Supports---------------------------------*/
        $solutionSupport_list = $this->SolutionSupport->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        $license_list = $this->LiasoningDept->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        $deptFollowup_list = $this->DeptFollowup->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));

        foreach($solutionSupport_list as $item){
            $y=$item['SolutionSupport']['year'];
            $m=$item['SolutionSupport']['month'];
            $social_array['SolutionSupport']['Achieve'][$y][$m]=$item[0]['count'];
            $social_array['SolutionSupport']['Achieve']['Year'][$y]=array_sum($social_array['SolutionSupport']['Achieve'][$y]);
            $social_array['SolutionSupport']['Achieve']['count']=array_sum($social_array['SolutionSupport']['Achieve']['Year']);
        }
        foreach($license_list as $item){
            $y=$item['LiasoningDept']['year'];
            $m=$item['LiasoningDept']['month'];
            $social_array['DeptLicense']['Achieve'][$y][$m]=$item[0]['count'];
            $social_array['DeptLicense']['Achieve']['Year'][$y]=array_sum($social_array['DeptLicense']['Achieve'][$y]);
            $social_array['DeptLicense']['Achieve']['count']=array_sum($social_array['DeptLicense']['Achieve']['Year']);
        }
        foreach($deptFollowup_list as $item){
            $y=$item['DeptFollowup']['year'];
            $m=$item['DeptFollowup']['month'];
            $social_array['DeptFollowup']['Achieve'][$y][$m]=$item[0]['count'];
            $social_array['DeptFollowup']['Achieve']['Year'][$y]=array_sum($social_array['DeptFollowup']['Achieve'][$y]);
            $social_array['DeptFollowup']['Achieve']['count']=array_sum($social_array['DeptFollowup']['Achieve']['Year']);
        }

        /*------------------------------- Fourth Graph ---------------------------------------------------------------*/
        /*--------------------------Trainers Enrolled--------------------------------*/
        $enrolledTrainer_list = $this->EnrolledTrainer->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        $trainee_list = $this->Trainee->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
        $traineeSecuredJob_list = $this->TraineeSecuredJob->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));

        foreach($enrolledTrainer_list as $item){
            $y=$item['EnrolledTrainer']['year'];
            $m=$item['EnrolledTrainer']['month'];
            $artificial_array['EnrolledTrainer']['Achieve'][$y][$m]=$item[0]['count'];
            $artificial_array['EnrolledTrainer']['Achieve']['Year'][$y]=array_sum($artificial_array['EnrolledTrainer']['Achieve'][$y]);
            $artificial_array['EnrolledTrainer']['Achieve']['count']=array_sum($artificial_array['EnrolledTrainer']['Achieve']['Year']);
        }
        foreach($trainee_list as $item){
            $y=$item['Trainee']['year'];
            $m=$item['Trainee']['month'];
            $artificial_array['Trainee']['Achieve'][$y][$m]=$item[0]['count'];
            $artificial_array['Trainee']['Achieve']['Year'][$y]=array_sum($artificial_array['Trainee']['Achieve'][$y]);
            $artificial_array['Trainee']['Achieve']['count']=array_sum($artificial_array['Trainee']['Achieve']['Year']);
        }
        foreach($traineeSecuredJob_list as $item){
            $y=$item['TraineeSecuredJob']['year'];
            $m=$item['TraineeSecuredJob']['month'];
            $artificial_array['TraineeSecuredJob']['Achieve'][$y][$m]=$item[0]['count'];
            $artificial_array['TraineeSecuredJob']['Achieve']['Year'][$y]=array_sum($artificial_array['TraineeSecuredJob']['Achieve'][$y]);
            $artificial_array['TraineeSecuredJob']['Achieve']['count']=array_sum($artificial_array['TraineeSecuredJob']['Achieve']['Year']);
        }
        foreach($hackathon_list as $item){
            $y=$item[0]['year'];
            $m=date('F',strtotime($item['Hackathon']['date']));
            $artificial_array['Hackathon']['Achieve'][$y][$m]=$item[0]['count'];
            $artificial_array['Hackathon']['Achieve']['Year'][$y]=array_sum($artificial_array['Hackathon']['Achieve'][$y]);
            $artificial_array['Hackathon']['Achieve']['count']=array_sum($artificial_array['Hackathon']['Achieve']['Year']);
        }

        //print_r($final_array);

        /*-------------------------------Fifth Graph - By Pavan Kumar M(27/10/2020)---------------------------------------*/
		$events_master_class_list = $this->DsMasterClass->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
		$events_ai_pathshala_list = $this->DsAiPathshala->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
		$events_tech_mentoring_list = $this->DsTechMentoring->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
		$events_hackathon_list = $this->DsHackathon->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
		$investor_connect_list = $this->DsInvestorConnect->find('all',array(
            'fields' => array('COUNT(*) AS count','year','month'),
            'group'=>array('year','month')
        ));
		
		foreach($events_master_class_list as $item){
            $y=$item['DsMasterClass']['year'];
            $m=$item['DsMasterClass']['month'];
            $events_array['MasterClass']['Events'][$y][$m]=$item[0]['count'];
            $events_array['MasterClass']['Events']['Year'][$y]=array_sum($events_array['MasterClass']['Events'][$y]);
            $events_array['MasterClass']['Events']['count']=array_sum($events_array['MasterClass']['Events']['Year']);
        }
		foreach($events_ai_pathshala_list as $item){
            $y=$item['DsAiPathshala']['year'];
            $m=$item['DsAiPathshala']['month'];
            $events_array['AiPathshala']['Events'][$y][$m]=$item[0]['count'];
            $events_array['AiPathshala']['Events']['Year'][$y]=array_sum($events_array['AiPathshala']['Events'][$y]);
            $events_array['AiPathshala']['Events']['count']=array_sum($events_array['AiPathshala']['Events']['Year']);
        }
		foreach($events_tech_mentoring_list as $item){
            $y=$item['DsTechMentoring']['year'];
            $m=$item['DsTechMentoring']['month'];
            $events_array['TechMentoring']['Events'][$y][$m]=$item[0]['count'];
            $events_array['TechMentoring']['Events']['Year'][$y]=array_sum($events_array['TechMentoring']['Events'][$y]);
            $events_array['TechMentoring']['Events']['count']=array_sum($events_array['TechMentoring']['Events']['Year']);
        }
		foreach($events_hackathon_list as $item){
            $y=$item['DsHackathon']['year'];
            $m=$item['DsHackathon']['month'];
            $events_array['Hackathon']['Events'][$y][$m]=$item[0]['count'];
            $events_array['Hackathon']['Events']['Year'][$y]=array_sum($events_array['Hackathon']['Events'][$y]);
            $events_array['Hackathon']['Events']['count']=array_sum($events_array['Hackathon']['Events']['Year']);
        }
		foreach($investor_connect_list as $item){
            $y=$item['DsInvestorConnect']['year'];
            $m=$item['DsInvestorConnect']['month'];
            $events_array['InvestorConnect']['Events'][$y][$m]=$item[0]['count'];
            $events_array['InvestorConnect']['Events']['Year'][$y]=array_sum($events_array['InvestorConnect']['Events'][$y]);
            $events_array['InvestorConnect']['Events']['count']=array_sum($events_array['InvestorConnect']['Events']['Year']);
        }		
		
        $this->set('final_array',$final_array);
        $this->set('research_array',$research_array);
        $this->set('social_array',$social_array);
        $this->set('artificial_array',$artificial_array);
        $this->set('events_array',$events_array); //Updated By Pavan Kumar M(27/10/2020)
    }
    
    
    public function innovatorsAcceleratedPopUp($type=null,$year=null,$month=null){
        $this->layout = 'ajax';

        $this->set('type',$type);

        if($type == 'Mentors'){
            $mentor_list = $this->Mentor->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
            ));
            $title='Mentors Of '.$month.' - '.$year;
            $this->set('mentor_list',$mentor_list);
        }
        else if($type == 'Investor'){
            $investor_connect_list = $this->InvestorConnect->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('InvestorConnect.id DESC')
            ));
            $this->set('investor_connect_list',$investor_connect_list);
            $title='Investor Connect Of '.$month.' - '.$year;
        }
        else if($type == 'Market'){
            $market_research_list = $this->MarketResearch->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('MarketResearch.id DESC')));
            $this->set('market_research_list',$market_research_list);
            $title='Market Research Of '.$month.' - '.$year;
        }
        else if($type == 'ReportPublished'){
            $research_paper_list = $this->DsReportPublished->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('DsReportPublished.id DESC')
            ));
            $this->set('research_paper_list',$research_paper_list);
            $title='Report Published Of '.$month.' - '.$year;
        }
        else if($type=='ReportProcess'){
            $hackathon_list= $this->DsReportProcess->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('DsReportProcess.id DESC')
            ));
            $this->set('ReportProcess_list',$hackathon_list);
            $title='Report Process Of '.$month.' - '.$year;
        }
        else if($type=='Hackathon'){
            $hackathon_list= $this->Hackathon->find('all',array(
                'conditions' => array('YEAR(date)'=>$year,'MONTH(date)'=>date('m',strtotime($month)),'hackathon_type'=>'Research Projects')
            ));
            $this->set('hackathon_list',$hackathon_list);
            $title='Hackathons Of '.$month.' - '.$year;
        }
        else if($type=='SolutionSupport'){
            $solutionSupport_list = $this->SolutionSupport->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('solutionSupport_list',$solutionSupport_list);
            $title='Solution Supports Of '.$month.' - '.$year;
        }
        else if($type=='DeptLicense'){
            $license_list = $this->LiasoningDept->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('license_list',$license_list);
            $title='Dept. License Of '.$month.' - '.$year;
        }
        else if($type=='DeptFollowup'){
            $deptFollowup_list = $this->DeptFollowup->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('followup_list',$deptFollowup_list);
            $title='Dept. Followup Of '.$month.' - '.$year;
        }
        else if($type=='EnrolledTrainer'){
            $enrolledTrainer_list = $this->EnrolledTrainer->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('enrolledTrainer_list',$enrolledTrainer_list);
            $title='Enrolled Trainers Of '.$month.' - '.$year;
        }
        else if($type=='Trainee'){
            $trainee_list = $this->Trainee->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('trainee_list',$trainee_list);
            $title='Trainees Of '.$month.' - '.$year;
        }
        else if($type=='TraineeSecuredJob'){
            $traineeSecuredJob_list = $this->TraineeSecuredJob->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $this->set('traineeJob_list',$traineeSecuredJob_list);
            $title='Trainees Secured Job Of '.$month.' - '.$year;
        }
        elseif($type=='ManageTraining' || $type=='ManageSkill' || $type=='ManageWorking' || $type=='ManageResearchProject' || $type=='ManageResearchProjectIndustry' || $type=='ManageAerospaceTraining'){
            $list = $this->$type->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));

            if($type=='ManageTraining')
                $title='Manage Training Of '.$month.' - '.$year;
            else if($type=='ManageSkill')
                $title='Manage Skills Of '.$month.' - '.$year;
            else if($type=='ManageWorking')
                $title='Professional Training Program Of '.$month.' - '.$year;
            else if($type=='ManageResearchProject')
                $title='Research Institutes Of '.$month.' - '.$year;
            else if($type=='ManageResearchProjectIndustry')
                $title='Research Industry Of '.$month.' - '.$year;
            else if($type=='ManageAerospaceTraining')
                $title='Aerospace & Defence Of '.$month.' - '.$year;
        }
        $this->set('list',$list);
        $this->set('title',$title);
    }

    /*--------------------------- Aerospace & Defence ---------------------------------------------------*/
    public function aerospaceDashboard($type=null,$year=null,$month=null){

        $this->loadModel('ManageAerospaceDefenseTraining');

        $this->loadModel('AerospaceDefenseEmbeddedCourse');
        $this->loadModel('AerospaceDefenseTrainingProcess');
        $this->loadModel('AerospaceDefenseBootcamp');

        $this->loadModel('AerospaceDefenseSkilling');
        $this->loadModel('AerospaceDefenseCourse');

        $this->loadModel('ManageStartupFacilitation');

        if($type!='' && $year!='' && $month!=''){
            $this->layout = 'ajax';
            $types = '';

            /********************** First Graph **********************/
            if($type == 'Internship') $types = 'Internship/Foundation Course';
            elseif($type == 'AdvanceCourse') $types = 'Advance/Project Based Course';
            elseif($type == 'OrientationCourse') $types = 'Orientation/Awareness Course';

            /********************** Second Graph **********************/
            else if($type == 'EmbeddedCourse'){
                $list = $this->AerospaceDefenseEmbeddedCourse->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month), 'order'=>array('id DESC')
                ));
                $title='Aerospace Defense Embedded Courses Of '.$month.' - '.$year;
            }
            else if($type == 'TrainingProcess'){
                $list = $this->AerospaceDefenseTrainingProcess->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month), 'order'=>array('id DESC')
                ));
                $title='Aerospace Defense Training Process Of '.$month.' - '.$year;
            }
            else if($type == 'BootCamp'){
                $list = $this->AerospaceDefenseBootcamp->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month), 'order'=>array('id DESC')
                ));
                $title='Aerospace Defense Boot Camp Process Of '.$month.' - '.$year;
            }

            /********************** Third Graph **********************/
            else if($type == 'DefenseSkilling'){
                $list = $this->AerospaceDefenseSkilling->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month), 'order'=>array('id DESC')
                ));
                $title='Aerospace Defense Skilling Process Of '.$month.' - '.$year;
            }
            else if($type == 'DefenseCourse'){
                $list = $this->AerospaceDefenseCourse->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month), 'order'=>array('id DESC')
                ));
                $title='Aerospace Defense Course Process Of '.$month.' - '.$year;
            }

            /********************** Fourth Graph **********************/
            else if($type == 'StartupFacilitation'){
                $id = $year;
                $list = $this->ManageStartupFacilitation->find('all',array(
                    'conditions'=>array('id'=>$id),
                    'order'=>array('id DESC'
                    )
                ));
                $title='Startup Facilitation Companies';
            }

            /********************** First Graph **********************/
            if($types){
                $list = $this->ManageAerospaceDefenseTraining->find('all',array(
                    'conditions' => array('year'=>$year,'month'=>$month,'types'=>$types),
                    'order'=>array('id DESC')
                ));
                $title=$types.' Of '.$month.' - '.$year;
            }

           // print_r($list);

            $this->set('list_data',$list);
            $this->set('title',$title);
            $this->set('type',$type);

            $this->render('aerospace_pop_up');

        }
        else {

            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years = array_reverse($this->getYear());
            $month = $this->getMonth();

            /*---------------------------------------------- FIRST GRAPH START---------------------------------*/
            /*------------------------------------------- Training --------------------------------*/
            $Training = $this->ManageAerospaceDefenseTraining->find('all',array(
                'fields' => array('COUNT(*) AS count','types','year','month'),
                'group'=>array('types','year','month'),
            ));
            /*---------------------------------------------- FIRST GRAPH END ---------------------------------*/

            /*---------------------------------------------- SECOND GRAPH START ---------------------------------*/
            /*------------------------------------------- Embedded Course --------------------------------*/
            $EmbeddedCourse = $this->AerospaceDefenseEmbeddedCourse->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group' => array('year','month'),
            ));

            /*------------------------------------------- Training Process  --------------------------------*/
            $TrainingProcess = $this->AerospaceDefenseTrainingProcess->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group' => array('year','month'),
            ));

            /*------------------------------------------- BootCamp --------------------------------*/
            $BootCamp = $this->AerospaceDefenseBootcamp->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group' => array('year','month'),
            ));
            /*---------------------------------------------- SECOND GRAPH START ---------------------------------*/

            /*---------------------------------------------- THIRD GRAPH START ---------------------------------*/
            /*------------------------------------------- Defense Skilling --------------------------------*/
            $DefenseSkilling = $this->AerospaceDefenseSkilling->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group' => array('year','month'),
            ));

            /*------------------------------------------- Defense Course --------------------------------*/
            $DefenseCourse = $this->AerospaceDefenseCourse->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group' => array('year','month'),
            ));

            /*---------------------------------------------- THIRD GRAPH START ---------------------------------*/

            /*---------------------------------------------- FOURTH GRAPH START ---------------------------------*/
            /*------------------------------------------- Startup Facilitation --------------------------------*/
            $StartupFacilitation = $this->ManageStartupFacilitation->find('all',array(
                'fields' => array('COUNT(*) AS count','company_name','id'),
                'group' => array('company_name'),
            ));

            $startup_array = array();
            foreach ($StartupFacilitation as $item){
                $startup_array[$item['ManageStartupFacilitation']['company_name']] = array(
                    'count'=>$item[0]['count'],
                    'id'=>$item['ManageStartupFacilitation']['id']
                );
            }

          //  print_r($startup_array);
            /*---------------------------------------------- FOURTH GRAPH START ---------------------------------*/


            /*-------------------------------------- Target -------------------------------------*/
            $targets=$this->Targets->find('all',array(
                'fields' => array('SUM(count) AS sum','year','month','type'),
                'group' => array('type','year','month')
            ));

            $training_array=array();
            $academia_array=array();
            $skilling_array=array();

            foreach($years as $year){
                /*********************** Training Start ************************/
                $training_array['Internship']['Achieve']['Year'][$year]=0;
                $training_array['AdvanceCourse']['Achieve']['Year'][$year]=0;
                $training_array['OrientationCourse']['Achieve']['Year'][$year]=0;

                $training_array['Internship']['Target']['Year'][$year]=0;
                $training_array['AdvanceCourse']['Target']['Year'][$year]=0;
                $training_array['OrientationCourse']['Target']['Year'][$year]=0;
                /*********************** Training End ************************/

                /*********************** Academia Start ************************/
                $academia_array['EmbeddedCourse']['Achieve']['Year'][$year]=0;
                $academia_array['TrainingProcess']['Achieve']['Year'][$year]=0;
                $academia_array['BootCamp']['Achieve']['Year'][$year]=0;

                $academia_array['EmbeddedCourse']['Target']['Year'][$year]=0;
                $academia_array['TrainingProcess']['Target']['Year'][$year]=0;
                $academia_array['BootCamp']['Target']['Year'][$year]=0;
                /*********************** Academia End ************************/

                /*********************** Skilling Start ************************/
                $skilling_array['DefenseSkilling']['Achieve']['Year'][$year]=0;
                $skilling_array['DefenseCourse']['Achieve']['Year'][$year]=0;

                $skilling_array['DefenseSkilling']['Target']['Year'][$year]=0;
                $skilling_array['DefenseCourse']['Target']['Year'][$year]=0;
                /*********************** Skilling End ************************/


                foreach($month as $m){
                    /*********************** Training Start ************************/
                    $training_array['Internship']['Achieve'][$year][$m]=0;
                    $training_array['AdvanceCourse']['Achieve'][$year][$m]=0;
                    $training_array['OrientationCourse']['Achieve'][$year][$m]=0;

                    $training_array['Internship']['Target'][$year][$m]=0;
                    $training_array['AdvanceCourse']['Target'][$year][$m]=0;
                    $training_array['OrientationCourse']['Target'][$year][$m]=0;
                    /*********************** Training End ************************/

                    /*********************** Academia Start ************************/
                    $academia_array['EmbeddedCourse']['Achieve'][$year][$m]=0;
                    $academia_array['TrainingProcess']['Achieve'][$year][$m]=0;
                    $academia_array['BootCamp']['Achieve'][$year][$m]=0;

                    $academia_array['EmbeddedCourse']['Target'][$year][$m]=0;
                    $academia_array['TrainingProcess']['Target'][$year][$m]=0;
                    $academia_array['BootCamp']['Target'][$year][$m]=0;
                    /*********************** Academia End ************************/

                    /*********************** Skilling Start ************************/
                    $skilling_array['DefenseSkilling']['Achieve'][$year][$m]=0;
                    $skilling_array['DefenseCourse']['Achieve'][$year][$m]=0;

                    $skilling_array['DefenseSkilling']['Target'][$year][$m]=0;
                    $skilling_array['DefenseCourse']['Target'][$year][$m]=0;
                    /*********************** Skilling End ************************/
                }
            }

            /*---------------------------------------------- FIRST GRAPH---------------------------------*/
            foreach($Training as $item){
                $y=$item['ManageAerospaceDefenseTraining']['year'];
                $m=$item['ManageAerospaceDefenseTraining']['month'];

                $trainingItem = $item['ManageAerospaceDefenseTraining'];
                $types = '';

                if($trainingItem['types'] == 'Internship/Foundation Course') $types = 'Internship';
                if($trainingItem['types'] == 'Advance/Project Based Course') $types = 'AdvanceCourse';
                if($trainingItem['types'] == 'Orientation/Awareness Course') $types = 'OrientationCourse';

                $training_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $training_array[$types]['Achieve']['Year'][$y] = array_sum($training_array[$types]['Achieve'][$y]);
                $training_array[$types]['Achieve']['count'] = array_sum($training_array[$types]['Achieve']['Year']);
            }

            /*---------------------------------------------- SECOND GRAPH---------------------------------*/
            foreach($EmbeddedCourse as $item){
                $y=$item['AerospaceDefenseEmbeddedCourse']['year'];
                $m=$item['AerospaceDefenseEmbeddedCourse']['month'];
                $types = 'EmbeddedCourse';
                $academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
                $academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
            }
            foreach($TrainingProcess as $item){
                $y=$item['AerospaceDefenseTrainingProcess']['year'];
                $m=$item['AerospaceDefenseTrainingProcess']['month'];
                $types = 'TrainingProcess';
                $academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
                $academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
            }
            foreach($BootCamp as $item){
                $y=$item['AerospaceDefenseBootcamp']['year'];
                $m=$item['AerospaceDefenseBootcamp']['month'];
                $types = 'BootCamp';
                $academia_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $academia_array[$types]['Achieve']['Year'][$y] = array_sum($academia_array[$types]['Achieve'][$y]);
                $academia_array[$types]['Achieve']['count'] = array_sum($academia_array[$types]['Achieve']['Year']);
            }

            /*---------------------------------------------- THIRD GRAPH---------------------------------*/
            foreach($DefenseSkilling as $item){
                $y=$item['AerospaceDefenseSkilling']['year'];
                $m=$item['AerospaceDefenseSkilling']['month'];
                $types = 'DefenseSkilling';
                $skilling_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $skilling_array[$types]['Achieve']['Year'][$y] = array_sum($skilling_array[$types]['Achieve'][$y]);
                $skilling_array[$types]['Achieve']['count'] = array_sum($skilling_array[$types]['Achieve']['Year']);
            }
            foreach($DefenseCourse as $item){
                $y=$item['AerospaceDefenseCourse']['year'];
                $m=$item['AerospaceDefenseCourse']['month'];
                $types = 'DefenseCourse';
                $skilling_array[$types]['Achieve'][$y][$m] = $item[0]['count'];
                $skilling_array[$types]['Achieve']['Year'][$y] = array_sum($skilling_array[$types]['Achieve'][$y]);
                $skilling_array[$types]['Achieve']['count'] = array_sum($skilling_array[$types]['Achieve']['Year']);
            }

            /*----------------------------------------- Targets Loop ------------------------------------*/

            foreach($targets as $item){
                $y=$item['Targets']['year'];
                $m=$item['Targets']['month'];
                $type=$item['Targets']['type'];

                if($type=='Internship' || $type=='AdvanceCourse' || $type=='OrientationCourse'){
                    $training_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $training_array[$type]['Target']['Year'][$y]=array_sum($training_array[$type]['Target'][$y]);
                    $training_array[$type]['Target']['count']=array_sum($training_array[$type]['Target']['Year']);
                }
                elseif($type=='EmbeddedCourse' || $type=='TrainingProcess' || $type=='BootCamp'){
                    $academia_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $academia_array[$type]['Target']['Year'][$y]=array_sum($academia_array[$type]['Target'][$y]);
                    $academia_array[$type]['Target']['count']=array_sum($academia_array[$type]['Target']['Year']);
                }
                elseif($type=='DefenseSkilling' || $type=='DefenseCourse'){
                    $skilling_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                    $skilling_array[$type]['Target']['Year'][$y]=array_sum($skilling_array[$type]['Target'][$y]);
                    $skilling_array[$type]['Target']['count']=array_sum($skilling_array[$type]['Target']['Year']);
                }
            }

            $this->set('training_array', $training_array);
            $this->set('academia_array', $academia_array);
            $this->set('skilling_array', $skilling_array);
            $this->set('StartupFacilitation', $startup_array);
           // print_r($skilling_array);
        }
    }

    /*------------------------Workshop------------------------------------------------------------*/
    public function cyberSecurityDashboard($type=null,$year=null,$month=null){
        if($type!='' && $year!='' && $month!=''){
            $this->layout = 'ajax';

            if ($type == 'Internship') $model = 'ManageInternshipPool';
            else if ($type == 'Enablement') $model = 'ManageStartup';
            else if ($type == 'Training') $model = 'ManageCapacityBuilding';
            else if ($type == 'White Paper - News Letter') $model = 'ManageWhitePaper';
            else if ($type == 'Workshop') $model = 'ManageCyberSecurity';

            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
           // print_r($list);
           // print_r($model);
            $title=$type.' Of '.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$model);
            $this->render('cyber_security_dashboard_pop_up');
        }
        else {
            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years = array_reverse($this->getYear());
            $month = $this->getMonth();

            /*-------------------------------------------ManageTraining--------------------------------*/
            $manageInternshipPool = $this->ManageInternshipPool->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));
            /*------------------------------ManageStartup----------------------------------*/
            $manageStartup = $this->ManageStartup->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));
            /*------------------------------ManageCapacityBuilding----------------------------------*/
            $manageCapacityBuilding = $this->ManageCapacityBuilding->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));
            /*------------------------------ManageWhitePaper----------------------------------*/
            $manageWhitePaper = $this->ManageWhitePaper->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));
            /*------------------------------ManageCyberSecurity----------------------------------*/
            $manageCyberSecurity = $this->ManageCyberSecurity->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));
            /*-------------------------------------- Target -------------------------------------*/
            $targets = $this->Targets->find('all', array(
                'conditions' => array('type IN' => array('Internship', 'Enablement', 'Training', 'White Paper - News Letter', 'Workshop')),
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

            foreach ($targets as $item) {
                $y = $item['Targets']['year'];
                $m = $item['Targets']['month'];
                $type = $item['Targets']['type'];
                $item[0]['sum']=round($item[0]['sum']/12);
                foreach($month as $m) {
                    $final_array[$type]['Target'][$y][$m] = $item[0]['sum'];
                    $final_array[$type]['Target']['Year'][$y] = array_sum($final_array[$type]['Target'][$y]);
                    $final_array[$type]['Target']['count'] = array_sum($final_array[$type]['Target']['Year']);
                }

            }
            $this->set('final_array', $final_array);
        }
       // print_r($final_array);
    }
    /*-----------------------Animation, Visual Effects,Gaming------------------------------------------*/
    public function animationDashboard($year=null,$month=null){
        if($year!='' && $month!=''){
            $this->layout = 'ajax';
            $model='ManageFacility';
            $type='Animation & Visual Effects';

            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $title=$type.' Of '.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$model);
            $this->render('cyber_security_dashboard_pop_up');
        }
        else {
            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years = array_reverse($this->getYear());
            $month = $this->getMonth();

            /*-------------------------------------------ManageTraining--------------------------------*/
            $manageFacility = $this->ManageFacility->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));

            /*-------------------------------------- Target -------------------------------------*/
            $targets = $this->Targets->find('all', array(
                'conditions' => array('type IN' => array('Animation & Visual Effects')),
                'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
                'group' => array('type', 'year', 'month')
            ));

            $final_array = array();
            foreach ($years as $year) {
                $final_array['Achieved']['Year'][$year] = 0;
                $final_array['Target']['Year'][$year] = 0;

                foreach ($month as $m) {
                    $final_array['Achieved'][$year][$m] = 0;
                    $final_array['Target'][$year][$m] = 0;
                }
            }

            foreach ($manageFacility as $item) {
                $key = array_keys($item);
                $key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $final_array['Achieved'][$y][$m] = $item[0]['count'];
                $final_array['Achieved']['Year'][$y] = array_sum($final_array['Achieved'][$y]);
            }
            foreach ($targets as $item) {
                $y = $item['Targets']['year'];
                $m = $item['Targets']['month'];
                $type = $item['Targets']['type'];
                $item[0]['sum']=round($item[0]['sum']/12);
                foreach($month as $m) {
                    $final_array['Target'][$y][$m] = $item[0]['sum'];
                    $final_array['Target']['Year'][$y] = array_sum($final_array['Target'][$y]);
                }
            }

            $this->set('final_array', $final_array);
        }
    }
    /*-----------------------Fabless Dashboard------------------------------------------*/
    public function fablessDashboard($year=null,$month=null){
        if($year!='' && $month!=''){
            $this->layout = 'ajax';
            $model='Companies';
            $type='Fabless';

            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $title=$type.' Of '.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$model);
            $this->render('cyber_security_dashboard_pop_up');
        }
        else {
            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years = array_reverse($this->getYear());
            $month = $this->getMonth();

            /*-------------------------------------------ManageTraining--------------------------------*/
            $manageFacility = $this->Companies->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));

            /*-------------------------------------- Target -------------------------------------*/
            $targets = $this->Targets->find('all', array(
                'conditions' => array('type IN' => array('Fabless')),
                'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
                'group' => array('type', 'year', 'month')
            ));

            $final_array = array();
            foreach ($years as $year) {
                $final_array['Achieved']['Year'][$year] = 0;
                $final_array['Target']['Year'][$year] = 0;

                foreach ($month as $m) {
                    $final_array['Achieved'][$year][$m] = 0;
                    $final_array['Target'][$year][$m] = 0;
                }
            }

            foreach ($manageFacility as $item) {
                $key = array_keys($item);
                $key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $final_array['Achieved'][$y][$m] = $item[0]['count'];
                $final_array['Achieved']['Year'][$y] = array_sum($final_array['Achieved'][$y]);
            }
            foreach ($targets as $item) {
                $y = $item['Targets']['year'];
                $m = $item['Targets']['month'];
                $type = $item['Targets']['type'];
                $item[0]['sum']=round($item[0]['sum']/12);
                foreach($month as $m) {
                    $final_array['Target'][$y][$m] = $item[0]['sum'];
                    $final_array['Target']['Year'][$y] = array_sum($final_array['Target'][$y]);
                }
            }

            $this->set('final_array', $final_array);
        }
    }
    /*-----------------------K-Tech Dashboard------------------------------------------*/
    public function ktechCenterDashboard($year=null,$month=null){
        if($year!='' && $month!=''){
            $this->layout = 'ajax';
            $model='ManageAgricultureInnovation';
            $type='KTECH Centers';

            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
            $title=$type.' Of '.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$model);
            $this->render('cyber_security_dashboard_pop_up');
        }
        else {
            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years = array_reverse($this->getYear());
            $month = $this->getMonth();

            /*-------------------------------------------ManageTraining--------------------------------*/
            $manageFacility = $this->ManageAgricultureInnovation->find('all', array(
                'fields' => array('COUNT(*) AS count', 'year', 'month'),
                'group' => array('year', 'month')
            ));

            /*-------------------------------------- Target -------------------------------------*/
            $targets = $this->Targets->find('all', array(
                'conditions' => array('type IN' => array('K-Tech Center')),
                'fields' => array('SUM(count) AS sum', 'year', 'month', 'type'),
                'group' => array('type', 'year', 'month')
            ));

            $final_array = array();
            foreach ($years as $year) {
                $final_array['Achieved']['Year'][$year] = 0;
                $final_array['Target']['Year'][$year] = 0;

                foreach ($month as $m) {
                    $final_array['Achieved'][$year][$m] = 0;
                    $final_array['Target'][$year][$m] = 0;
                }
            }

            foreach ($manageFacility as $item) {
                $key = array_keys($item);
                $key = (isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y = (isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m = (isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $final_array['Achieved'][$y][$m] = $item[0]['count'];
                $final_array['Achieved']['Year'][$y] = array_sum($final_array['Achieved'][$y]);
            }
            foreach ($targets as $item) {
                $y = $item['Targets']['year'];
                $m = $item['Targets']['month'];
                $type = $item['Targets']['type'];
                $item[0]['sum']=round($item[0]['sum']/12);
                foreach($month as $m) {
                    $final_array['Target'][$y][$m] = $item[0]['sum'];
                    $final_array['Target']['Year'][$y] = array_sum($final_array['Target'][$y]);
                }
            }

            $this->set('final_array', $final_array);
        }
    }
    
    public function miRoboticsDashboard($type=null,$year=null,$month=null){

        if($type!='' && $year!='' && $month!=''){
           // print_r($type);
            $this->layout = 'ajax';

            if ($type == 'CapacityBuilding') $model = 'MiPrograms';
            else if ($type == 'InternationalConferences') $model = 'MiInternationalConferences';
            else if ($type == 'StartupConferences') $model = 'MiStartupConferences';
            else if ($type == 'GovtOfficialTraining') $model = 'MiOfficials';
            else if ($type == 'StudentEnrollment') $model = 'MiStudentEnrollment';
            else if ($type == 'Patent') $model = 'MiPatent';

            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));
           //print_r($list);
            $title=$type.' Of'.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$type);
            $this->render('mi_robotics_pop_up');
        }else{

            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years=array_reverse($this->getYear());
            $month=$this->getMonth();
            $targets=$this->Targets->find('all',array(
                'fields' => array('SUM(count) AS sum','year','month','type'),
                'group'=>array('type','year','month')
            ));


            $mi_array=array();

            foreach($years as $year){
                $mi_array['CapacityBuilding']['Achieve']['Year'][$year]=0;
                $mi_array['InternationalConferences']['Achieve']['Year'][$year]=0;
                $mi_array['StartupConferences']['Achieve']['Year'][$year]=0;
                $mi_array['GovtOfficialTraining']['Achieve']['Year'][$year]=0;
                $mi_array['StudentEnrollment']['Achieve']['Year'][$year]=0;
                $mi_array['Patent']['Achieve']['Year'][$year]=0;

                $mi_array['CapacityBuilding']['Target']['Year'][$year]=0;
                $mi_array['InternationalConferences']['Target']['Year'][$year]=0;
                $mi_array['StartupConferences']['Target']['Year'][$year]=0;
                $mi_array['GovtOfficialTraining']['Target']['Year'][$year]=0;
                $mi_array['StudentEnrollment']['Target']['Year'][$year]=0;
                $mi_array['Patent']['Target']['Year'][$year]=0;

                foreach($month as $m){
                    $mi_array['CapacityBuilding']['Achieve'][$year][$m]=0;
                    $mi_array['InternationalConferences']['Achieve'][$year][$m]=0;
                    $mi_array['StartupConferences']['Achieve'][$year][$m]=0;
                    $mi_array['GovtOfficialTraining']['Achieve'][$year][$m]=0;
                    $mi_array['StudentEnrollment']['Achieve'][$year][$m]=0;
                    $mi_array['Patent']['Achieve'][$year][$m]=0;

                    $mi_array['CapacityBuilding']['Target'][$year][$m]=0;
                    $mi_array['InternationalConferences']['Target'][$year][$m]=0;
                    $mi_array['StartupConferences']['Target'][$year][$m]=0;
                    $mi_array['GovtOfficialTraining']['Target'][$year][$m]=0;
                    $mi_array['StudentEnrollment']['Target'][$year][$m]=0;
                    $mi_array['Patent']['Target'][$year][$m]=0;

                }
            }

            foreach($targets as $item){
                $y=$item['Targets']['year'];
                $m=$item['Targets']['month'];
                $type=$item['Targets']['type'];

                if($type=='CapacityBuilding' || $type=='InternationalConferences' || $type=='StartupConferences' ||
                    $type=='GovtOfficialTraining' || $type=='StudentEnrollment' || $type=='Patent'){
                    $item[0]['sum']=round($item[0]['sum']/12);
                    foreach($month as $m) {
                        $mi_array[$type]['Target'][$y][$m]=$item[0]['sum'];
                        $mi_array[$type]['Target']['Year'][$y] = array_sum($mi_array[$type]['Target'][$y]);
                        $mi_array[$type]['Target']['count'] = array_sum($mi_array[$type]['Target']['Year']);
                    }
                }

            }

            /*------------------------------- MiPrograms --------------------------------*/
            $MiPrograms_list = $this->MiPrograms->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiPrograms_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "CapacityBuilding";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- MiInternationalConferences --------------------------------*/
            $MiIc_list = $this->MiInternationalConferences->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiIc_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "InternationalConferences";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }
            /*------------------------------- MiStartupConferences --------------------------------*/
            $MiStartUp_list = $this->MiStartupConferences->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiStartUp_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "StartupConferences";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- MiOfficials  --------------------------------*/
            $MiOfficials_list = $this->MiOfficials->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiOfficials_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "GovtOfficialTraining";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- MiStudentEnrollment  --------------------------------*/
            $MiStudentEnrollment_list = $this->MiStudentEnrollment->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiStudentEnrollment_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "StudentEnrollment";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- MiStudentEnrollment  --------------------------------*/
            $MiPatent_list = $this->MiPatent->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));

            foreach($MiPatent_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "Patent";
                $mi_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $mi_array[$key]['Achieve']['Year'][$y]=array_sum($mi_array[$key]['Achieve'][$y]);
                $mi_array[$key]['Achieve']['count']=array_sum($mi_array[$key]['Achieve']['Year']);
            }


            //print_r($mi_array);

            $this->set('mi_array',$mi_array);

        }

    }

    public function iotDashboard($type=null,$year=null,$month=null){

        $this->loadModel('IotStartUp');
        $this->loadModel('GeneratedEmployment');
        $this->loadModel('IotIntellectualProperty');
        $this->loadModel('IotStartupsRisedFund');
        $this->loadModel('IotEventWorkshop');
        $this->loadModel('IotIndustryConnected');
        $this->loadModel('IotAcademiaConnected');
        $this->loadModel('IotDelegation');
        $this->loadModel('IotPilotsProject');

        if($type!='' && $year!='' && $month!=''){
           // print_r($type);
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


            $list = $this->$model->find('all',array(
                'conditions' => array('year'=>$year,'month'=>$month),
                'order'=>array('id DESC')
            ));

          // print_r($list);
            $title=$type.' Of'.$month.' - '.$year;
            $this->set('list',$list);
            $this->set('title',$title);
            $this->set('type',$type);
            $this->render('iot_pop_up');
        }else{

            $this->layout = 'fab_layout';
            $this->_userSessionCheckout();
            $years=array_reverse($this->getYear());
            $month=$this->getMonth();
            $targets=$this->Targets->find('all',array(
                'fields' => array('SUM(count) AS sum','year','month','type'),
                'group'=>array('type','year','month')
            ));


            $iot_array=array();

            foreach($years as $year){
                $iot_array['IotStartUp']['Achieve']['Year'][$year]=0;
                $iot_array['GeneratedEmployment']['Achieve']['Year'][$year]=0;
                $iot_array['IotIntellectualProperty']['Achieve']['Year'][$year]=0;
                $iot_array['IotStartupsRisedFund']['Achieve']['Year'][$year]=0;
                $iot_array['IotEventWorkshop']['Achieve']['Year'][$year]=0;
                $iot_array['IotIndustryConnected']['Achieve']['Year'][$year]=0;
                $iot_array['IotAcademiaConnected']['Achieve']['Year'][$year]=0;
                $iot_array['IotDelegation']['Achieve']['Year'][$year]=0;
                $iot_array['IotPilotsProject']['Achieve']['Year'][$year]=0;

                $iot_array['IotStartUp']['Target']['Year'][$year]=0;
                $iot_array['GeneratedEmployment']['Target']['Year'][$year]=0;
                $iot_array['IotIntellectualProperty']['Target']['Year'][$year]=0;
                $iot_array['IotStartupsRisedFund']['Target']['Year'][$year]=0;
                $iot_array['IotEventWorkshop']['Target']['Year'][$year]=0;
                $iot_array['IotIndustryConnected']['Target']['Year'][$year]=0;
                $iot_array['IotAcademiaConnected']['Target']['Year'][$year]=0;
                $iot_array['IotDelegation']['Target']['Year'][$year]=0;
                $iot_array['IotPilotsProject']['Target']['Year'][$year]=0;

                foreach($month as $m){
                    $iot_array['IotStartUp']['Achieve'][$year][$m]=0;
                    $iot_array['GeneratedEmployment']['Achieve'][$year][$m]=0;
                    $iot_array['IotIntellectualProperty']['Achieve'][$year][$m]=0;
                    $iot_array['IotStartupsRisedFund']['Achieve'][$year][$m]=0;
                    $iot_array['IotEventWorkshop']['Achieve'][$year][$m]=0;
                    $iot_array['IotIndustryConnected']['Achieve'][$year][$m]=0;
                    $iot_array['IotAcademiaConnected']['Achieve'][$year][$m]=0;
                    $iot_array['IotDelegation']['Achieve'][$year][$m]=0;
                    $iot_array['IotPilotsProject']['Achieve'][$year][$m]=0;

                    $iot_array['IotStartUp']['Target'][$year][$m]=0;
                    $iot_array['GeneratedEmployment']['Target'][$year][$m]=0;
                    $iot_array['IotIntellectualProperty']['Target'][$year][$m]=0;
                    $iot_array['IotStartupsRisedFund']['Target'][$year][$m]=0;
                    $iot_array['IotEventWorkshop']['Target'][$year][$m]=0;
                    $iot_array['IotIndustryConnected']['Target'][$year][$m]=0;
                    $iot_array['IotAcademiaConnected']['Target'][$year][$m]=0;
                    $iot_array['IotDelegation']['Target'][$year][$m]=0;
                    $iot_array['IotPilotsProject']['Target'][$year][$m]=0;
                }
            }

            foreach($targets as $item){
                $y=$item['Targets']['year'];
                $m=$item['Targets']['month'];
                $type=$item['Targets']['type'];

                if($type=='IotStartUp' || $type=='GeneratedEmployment' || $type=='IotIntellectualProperty' || $type=='IotStartupsRisedFund' ||
                    $type=='IotEventWorkshop' || $type=='IotIndustryConnected' || $type=='IotAcademiaConnected' || $type=='IotDelegation'|| $type== 'IotPilotsProject'){
                    $item[0]['sum']=round($item[0]['sum']/12);
                    foreach($month as $m) {
                        $iot_array[$type]['Target'][$y][$m] = $item[0]['sum'];
                        $iot_array[$type]['Target']['Year'][$y] = array_sum($iot_array[$type]['Target'][$y]);
                        $iot_array[$type]['Target']['count'] = array_sum($iot_array[$type]['Target']['Year']);
                    }
                }

            }

            /*------------------------------- IotStartUp --------------------------------*/
            $IotStartUp_list = $this->IotStartUp->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotStartUp_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotStartUp";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- GeneratedEmployment --------------------------------*/
            $GeneratedEmployment_list = $this->GeneratedEmployment->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($GeneratedEmployment_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "GeneratedEmployment";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotIntellectualProperty --------------------------------*/
            $IotIntellectualProperty_list = $this->IotIntellectualProperty->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotIntellectualProperty_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotIntellectualProperty";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotStartupsRisedFund --------------------------------*/
            $IotStartupsRisedFund_list = $this->IotStartupsRisedFund->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotStartupsRisedFund_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotStartupsRisedFund";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotEventWorkshop --------------------------------*/
            $IotEventWorkshop_list = $this->IotEventWorkshop->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotEventWorkshop_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotEventWorkshop";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotIndustryConnected  --------------------------------*/
            $IotIndustryConnected_list = $this->IotIndustryConnected->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotIndustryConnected_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotIndustryConnected";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotAcademiaConnected  --------------------------------*/
            $IotAcademiaConnected_list = $this->IotAcademiaConnected->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotAcademiaConnected_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotAcademiaConnected";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotDelegation  --------------------------------*/
            $IotDelegation_list = $this->IotDelegation->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotDelegation_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotDelegation";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }

            /*------------------------------- IotPilotsProject  --------------------------------*/
            $IotPilotsProject_list = $this->IotPilotsProject->find('all',array(
                'fields' => array('COUNT(*) AS count','year','month'),
                'group'=>array('year','month')
            ));
            foreach($IotPilotsProject_list as $item){
                $key=array_keys($item);
                $key=(isset($item[$key[1]]['year']) ? $key[1] : $key[0]);
                $y=(isset($item[$key]['year']) ? $item[$key]['year'] : $item[$key]['year']);
                $m=(isset($item[$key]['month']) ? $item[$key]['month'] : $item[$key]['month']);
                $key = "IotPilotsProject";
                $iot_array[$key]['Achieve'][$y][$m]=$item[0]['count'];
                $iot_array[$key]['Achieve']['Year'][$y]=array_sum($iot_array[$key]['Achieve'][$y]);
                $iot_array[$key]['Achieve']['count']=array_sum($iot_array[$key]['Achieve']['Year']);
            }


            //print_r($iot_array);

            $this->set('iot_array',$iot_array);

        }

    }
        public function financeDashboard($type){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('Financial');
        $this->loadModel('Expenditure');

        if($type=="dsAiFund"){

            $types="Data Science and AI";
        }
        else if($type=="aerospaceFund"){

            $types="Aerospace & Defense";
        }
        else if($type=="cyberSecurityFund"){

            $types="Cyber Security";
        }
        else if($type=="iotFund"){

            $types="IOT";
        }
        else if($type=="roboticsFund"){

            $types="MI & Robotics";
        }
        else if($type=="animationFund"){

            $types="Animation";
        }
        else if($type=="ktechCenterFund"){

            $types="KTECH Centre";
        }
        else if($type=="fablessFund"){

            $types="Fabless";
        }

        $this->Financial->bindModel(array("belongsTo"=>array("FinancialYear")));
        $funds = $this->Financial->find('first', array('conditions' => array('types' => $types,'FinancialYear.current'=>1)));

        $this->Expenditure->bindModel(array("belongsTo"=>array("FinancialYear")));
        $manage_list = $this->Expenditure->find('all',array('conditions' => array('Expenditure.types' =>$types,'FinancialYear.current'=>1),"order"=>array('Expenditure.id DESC')));

        $this->set('manage_list',$manage_list);
        $this->set('funds',$funds);
        $this->set('types',$types);

    }

}
