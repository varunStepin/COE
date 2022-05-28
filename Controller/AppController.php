<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');
App::uses('Security', 'Utility');
App::uses('Sanitize', 'Utility');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    public $uses = array("AcademicYear");

    public static function getPhase(){
   return ['Phase 1'=>'Phase 1','Phase 2'=>'Phase 2'];
}
    public function beforeRender()
    {
        /*//$url=$_SERVER['HTTP_HOST'];
             $whitelisted_domains = array( 'ourwork.in');
             $domain = $_SERVER['HTTP_HOST'];
             // Check if we match the domain exactly
             if ( in_array( $domain, $whitelisted_domains ) )
                 return true;
             $valid = false;
             foreach( $whitelisted_domains as $whitelisted_domain ) {
                 $whitelisted_domain = '.' . $whitelisted_domain; // Prevent things like 'evilsitetime.com'
                 if( strpos( $domain, $whitelisted_domain ) === ( strlen( $domain ) - strlen( $whitelisted_domain ) ) ) {
                     $valid = true;
                     break;
                 }
             }
         if($valid===false){
             $this->Session-> destroy();
             $this->response->disableCache();
             $this->redirect(array('controller'=>'Home','action'=>'login'));
         }*/

    }


    public function _getCurrentDateTime()
    {
        return date('Y-m-d H:i:s', time());
    }

    public function _userSessionCheckout()
    {
        ini_set('session.gc_maxlifetime', 8884000);
        ini_set('session.cookie_lifetime', 8884000);

        if (!$this->Session->check("UserSession")) {

            $this->Session->setFlash('You need to be logged in to access this Application.');
            $this->redirect(array("controller" => "Home", "action" => "login"));

        }

    }

    public function changeCSRFToken()
    {
        $ran_no = bin2hex($this->genRandomStringCustom(32));
        $this->Session->write('CSRFTOKEN', $ran_no);
    }

    public function getUserTypes()
    {
        $user_type = array(
            'Admin' => 'Admin',
            'DATA SCIENCE AND AI' => 'DATA SCIENCE AND AI',
            'AEROSPACE & DEFENSE' => 'AEROSPACE & DEFENSE',
            'CYBER SECURITY' => 'CYBER SECURITY',
            'ANIMATION' => 'ANIMATION',
            'KTECH CENTRE' => 'KTECH CENTRE',
            'IOT' => 'IOT',
            'MI & ROBOTICS' => 'MI & ROBOTICS',
            'FABLESS' => 'FABLESS',
            'CENSE' => 'CENSE',
            'CPDM' => 'CPDM',
            'MUTBI' => 'MUTBI',
            'RMTBI' => 'Ramaiah University',
            'CIF' => 'CIF',
        );
        $this->set('user_types', $user_type);
    }

    public function getDistrict()
    {

        $list_array = array(
            "Bagalkote" => "Bagalkote",
            "Benglore" => "Benglore",
            "Belgam" => "Belgam",
            "Belagavi" => "Belagavi",
            "Ballari" => "Ballari",
            "Bidar" => "Bidar",
            "Bijapur" => "Bijapur",


            "Chikkaballapur" => "Chikkaballapur",
            "Dakshina Kannada" => "Dakshina Kannada",
            "Davangere" => "Davangere",
            "Dharwad" => "Dharwad",
            "Gulbarga" => "Gulbarga",
            "Hassan" => "Hassan",
            "Mandya" => "Mandya",
            "Mysuru" => "Mysuru",
            "Ramanagara" => "Ramanagara",
            "Shivamogga" => "Shivamogga",
            "Tumkur" => "Tumkur",
            "Udupi" => "Udupi",
            "Vijayapura" => "Vijayapura",
            "Uttara Kannada" => "Uttara Kannada");
        $this->set('district', $list_array);
    }

    public function get_encript($message)
    {

        $key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        $dirty = Security::encrypt($message, $key);
        return Sanitize::escape($dirty);


    }

    public function get_decrypt($message)
    {

        $key = 'wt1U5MACWJFTXGenFoZoiLwQGrLgdbHA';
        return Security::decrypt($message, $key);
    }


    function genRandomStringCustom($n)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

    public function encrypt_string($input)
    {
        return Security::hash($input, 'sha256', true);
    }


    public function encrypt_decrypt($action, $string)
    {
        $output = "tesr";
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'wt1U5M$8sdfTXGenFAWX5LwQGrLgdbHA';
        $secret_iv = 'asdd34532sda3rds34;lASDE';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else {
            if ($action == 'decrypt') {
                $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
            }
        }
        return $output;
    }

    public function clean($string)
    {
        $string = str_replace(' ', '_', $string); // Replaces all spaces with underscore.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public function getYear()
    {
        $years_array = array();

        for ($year = date('Y'); $year >= 2015; $year--) {
            $years_array[$year] = $year;
        }
        $this->set('years_list', $years_array);

        return $years_array;
    }

    public function getMonth()
    {
        $month_data = array();
        $month_array = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

        foreach ($month_array as $key => $month) {
            $month_data[$month] = $month;
        }

        $this->set('month_data', $month_data);
        return $month_data;
    }
    public function getSector() {
        $list_array = array();
        $details = $this->Sector->find('all',array("conditions"=>array("is_delete"=>0),"order"=>"sector ASC"));

        foreach($details as $list) {
            $list_array[$list['Sector']['id']] = $list['Sector']['sector'];
        }
        $this->set('sectors',$list_array);
    }

    //NEW
    public function getProgram() {
        $list_array = array();
        $details = $this->ManageTraining->find('all',array("order"=>"ManageTraining.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageTraining']['id']] = $list['ManageTraining']['program_name'];
        }
        $this->set('programs',$list_array);
    }

    public function getSkill() {
        $list_array = array();
        $details = $this->ManageSkill->find('all',array("order"=>"ManageSkill.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageSkill']['id']] = $list['ManageSkill']['training_program_name'];
        }
        $this->set('skill',$list_array);
    }

    public function getWorking() {
        $list_array = array();
        $details = $this->ManageWorking->find('all',array("order"=>"ManageWorking.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageWorking']['id']] = $list['ManageWorking']['program_name'];
        }
        $this->set('work',$list_array);
    }

    public function getResearchProject() {
        $list_array = array();
        $details = $this->ManageResearchProject->find('all',array("order"=>"ManageResearchProject.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageResearchProject']['id']] = $list['ManageResearchProject']['research_project_name'];
        }
        $this->set('research',$list_array);
    }

    public function getResearchProjectIndustry() {
        $list_array = array();
        $details = $this->ManageResearchProjectIndustry->find('all',array("order"=>"ManageResearchProjectIndustry.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageResearchProjectIndustry']['id']] = $list['ManageResearchProjectIndustry']['industry_name'];
        }
        $this->set('research',$list_array);
    }

    public function getAerospaceTraining() {
        $list_array = array();
        $details = $this->ManageAerospaceTraining->find('all',array("order"=>"ManageAerospaceTraining.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageAerospaceTraining']['id']] = $list['ManageAerospaceTraining']['training_program_name'];
        }
        $this->set('aerospace',$list_array);
    }

    public function getInternshipPool() {
        $list_array = array();
        $details = $this->ManageInternshipPool->find('all',array("order"=>"ManageInternshipPool.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageInternshipPool']['id']] = $list['ManageInternshipPool']['internship_program_name'];
        }
        $this->set('internship',$list_array);
    }

    public function getCapacityBuilding() {
        $list_array = array();
        $details = $this->ManageCapacityBuilding->find('all',array("order"=>"ManageCapacityBuilding.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageCapacityBuilding']['id']] = $list['ManageCapacityBuilding']['trainer_name'];
        }
        $this->set('capacitybuilding',$list_array);
    }

    public function department(){
        $department=["It"=>"It","Agriculture"=>"Agriculture"];
        $this->set('department',$department);
    }
        public function getCompanies() {
        $list_array = array();
        $details = $this->Companies->find('all',array("order"=>"Companies.name ASC"));

        foreach($details as $list) {
            $list_array[$list['Companies']['id']] = $list['Companies']['name'];
        }
        $this->set('companies',$list_array);
    }

    public function getIotCurriculum() {
        $list_array = array();
        $details = $this->ManageIotCurriculum->find('all',array("order"=>"ManageIotCurriculum.id ASC"));

        foreach($details as $list) {
            $list_array[$list['ManageIotCurriculum']['id']] = $list['ManageIotCurriculum']['name_of_college'];
        }
        $this->set('iotcurriculum',$list_array);
    }
        public function getMiProgram() {
        $list_array = array();
        $details = $this->MiPrograms->find('all',array("order"=>"MiPrograms.id ASC"));

        foreach($details as $list) {
            $list_array[$list['MiPrograms']['id']] = $list['MiPrograms']['program_name'];
        }
        $this->set('miPrograms',$list_array);
    }
    public function getMiInternationalConferences() {
        $list_array = array();
        $details = $this->MiInternationalConferences->find('all',array("order"=>"MiInternationalConferences.id ASC"));

        foreach($details as $list) {
            $list_array[$list['MiInternationalConferences']['id']] = $list['MiInternationalConferences']['conference_name'];
        }
        $this->set('miInternationalConferences',$list_array);
    }
    public function getMiStartupConferences() {
        $list_array = array();
        $details = $this->MiStartupConferences->find('all',array("order"=>"MiStartupConferences.id ASC"));

        foreach($details as $list) {
            $list_array[$list['MiStartupConferences']['id']] = $list['MiStartupConferences']['conference_name'];
        }
        $this->set('miStartupConferences',$list_array);
    }


/*-----------------------------------------*/
    public function getEmbeddedCourse() {
        $list_array = array();
        $details = $this->AerospaceDefenseEmbeddedCourse->find('all',array("order"=>"AerospaceDefenseEmbeddedCourse.id ASC"));

        foreach($details as $list) {
            $list_array[$list['AerospaceDefenseEmbeddedCourse']['id']] = $list['AerospaceDefenseEmbeddedCourse']['embedded_course'];
        }
        $this->set('embedded_course',$list_array);
    }

    public function getTrainingProcess() {
        $list_array = array();
        $details = $this->AerospaceDefenseTrainingProcess->find('all',array("order"=>"AerospaceDefenseTrainingProcess.id ASC"));

        foreach($details as $list) {
            $list_array[$list['AerospaceDefenseTrainingProcess']['id']] = $list['AerospaceDefenseTrainingProcess']['training_name'];
        }
        $this->set('training_orocess',$list_array);
    }

    public function getBootcamp() {
        $list_array = array();
        $details = $this->AerospaceDefenseBootcamp->find('all',array("order"=>"AerospaceDefenseBootcamp.id ASC"));

        foreach($details as $list) {
            $list_array[$list['AerospaceDefenseBootcamp']['id']] = $list['AerospaceDefenseBootcamp']['bootcamp'];
        }
        $this->set('bootcamp',$list_array);
    }

    public function getSkilling() {
        $list_array = array();
        $details = $this->AerospaceDefenseSkilling->find('all',array("order"=>"AerospaceDefenseSkilling.id ASC"));

        foreach($details as $list) {
            $list_array[$list['AerospaceDefenseSkilling']['id']] = $list['AerospaceDefenseSkilling']['skill_name'];
        }
        $this->set('skilling',$list_array);
    }

    public function getCourse() {
        $list_array = array();
        $details = $this->AerospaceDefenseCourse->find('all',array("order"=>"AerospaceDefenseCourse.id ASC"));

        foreach($details as $list) {
            $list_array[$list['AerospaceDefenseCourse']['id']] = $list['AerospaceDefenseCourse']['course_name'];
        }
        $this->set('courses',$list_array);
    }
    public function getDsAiHackathons() {
        $list_array = array();
        $details = $this->DsHackathon->find('all',array("order"=>"DsHackathon.topic ASC"));

        foreach($details as $list) {
            $list_array[$list['DsHackathon']['id']] = $list['DsHackathon']['topic'];
        }

        $this->set('hackathon',$list_array);
    }
    public function getDsMasterClass() {
        $list_array = array();
        $details = $this->DsMasterClass->find('all',array("order"=>"DsMasterClass.topic ASC"));

        foreach($details as $list) {
            $list_array[$list['DsMasterClass']['id']] = $list['DsMasterClass']['topic'];
        }

        $this->set('masterClass',$list_array);
    }
    public function getDsAiPathshala() {
        $list_array = array();
        $details = $this->DsAiPathshala->find('all',array("order"=>"DsAiPathshala.topic ASC"));

        foreach($details as $list) {
            $list_array[$list['DsAiPathshala']['id']] = $list['DsAiPathshala']['topic'];
        }

        $this->set('aiPathshala',$list_array);
    }
        public function _getFundingYear() {
        $list_array = array();
        $details = $this->FinancialYear->find('all',array("order"=>array("FinancialYear.current DESC","id DESC")));

        foreach($details as $list) {
            $list_array[$list['FinancialYear']['id']] = $list['FinancialYear']['year'];
        }

        $this->set('financialYear',$list_array);
    }
        public function getStartUps() {
        $list_array = array();
        $this->loadModel('IotStartUp');
        $details = $this->IotStartUp->find('all',array("order"=>"IotStartUp.start_up_name ASC"));

        foreach($details as $list) {
            $list_array[$list['IotStartUp']['id']] = $list['IotStartUp']['start_up_name'];
        }

        $this->set('startups',$list_array);
    }
     public function targetType(){
        $arrayOld=[
            "Mentors"=>"Mentor",
            "Investor"=>"Investor",
            "Market"=>"Market Research",
            "Paper"=>"Papers",
            "Hackathon"=>"Hackathons",
            "SolutionSupport"=>"Solutions Supported",
            "DeptLicense"=>"Depts Liasoning & Followup",
            "DeptFollowup"=>"Dept Followup",
            "EnrolledTrainer"=>"Trainers Enrolled",
            "Trainee"=>"Trainees",
            "TraineeSecuredJob"=>"Trainees Secured",
            "Training Program For Engineers"=>"Training Program For Engineers",
            "Skill Training"=>"Skill Training",
            "Training Program For Professionals"=>"Training Program For Professionals",
            "Research Institute"=>"Research Institute",
            "Research Industry"=>"Research Industry",
            "Aerospace & Defense"=>"Aerospace & Defense",
            "Internship"=>"Internship",
            "Enablement"=>"Enablement",
            "Training"=>"Training",
            "White Paper - News Letter"=>"White Paper - News Letter",
            "Workshop"=>"Workshop",
            "Animation & Visual Effects"=>'Animation & Visual Effects',
            "K-Tech Center"=>'K-Tech Center',
            "IotResearchIncubation"=>"Iot Research Incubation",
            "GeneratedEmployment"=>"Generated Employment",
            "WhitePaper"=>"WhitePaper",
            "Poc"=>"Poc",
            "SocietalProject"=>"Societal Project",
            "ManageIotCurriculum"=>"Manage Iot Curriculum",
            "ManageIntellectualProperty"=>"Manage Intellectual Property",
            "CapacityBuilding"=>"Capacity Building",
            "InternationalConferences"=>"International Conferences",
            "StartupConferences"=>"Startup Conferences",
            "GovtOfficialTraining"=>"Govt Official Training",
            "StudentEnrollment"=>"Student Enrollment",
            "Patent"=>"Patent",
            "Fabless"=>"Fabless",
            "IotStartUp"=>"Iot StartUp",
            "IotIntellectualProperty"=>"Iot Intellectual Property",
            "IotStartupsRisedFund"=>"Iot Startups RisedFund",
            "IotEventWorkshop"=>"Iot Event Workshop",
            "IotIndustryConnected"=>"Iot Industry Connected",
            "IotAcademiaConnected"=>"Iot Academia Connected",
            "IotDelegation"=> "Iot Delegation",
            "IotPilotsProject"=> "Iot Pilots Project"];
        $array=array(
            //Research Projects
        'K-tech COE for DS&AI' => array(
            "DsAiVirtualAccStartup"=>"Start-ups Accelerated Virtual",
            "DsAiPhyAccStartup"=>"Start-ups Accelerated Physical",



            //Research Projects
            "ReportPublished"=>"Reports Published",
            "ReportProcess"=>"Reports Process",

            //POC – Societal & Enterprise
            "SolutionSupport"=>"Solutions Supported",
            "DeptLicense"=>"Depts Liasoning & Followup ",
            "EnterpriseSolutionsAdopted"=>"Enterprise Solutions Adopted",

            //Data science & AI
            "StudentTrained"=>"Student Trained",
            "FacultyTrained"=>"Faculty Trained",
            "ProfessionalTrained"=>"Professional Trained"),








        'K-tech COE in A&D' => array(
            //K-tech COE in A&D Training
            "Internship"=>"Internship Foundation",
            "AdvanceCourse"=>"Advance Project",
            "OrientationCourse"=>"Orientation Awareness",

            //K-tech COE in A&D Academia
            "EmbeddedCourse"=>"Embedded Course",
            "TrainingProcess"=>"Training in process",
            "BootCamp"=>"Bootcamp",

            //K-tech COE in A&D Skilling
            "DefenseSkilling"=>"Skilling",
            "DefenseCourse"=>"Defense Course"),





        'K-tech COE in CS' => array(
            //K-tech COE in CS
            "Internship"=>'Internship',
            "Enablement"=>'Enablement',
            "Training"=>"Training",
            "White Paper - News Letter"=>"White Paper/News Letter",
            "Workshop"=>"Workshop"),





        'K-tech COE in AVGC' => array(
                //K-tech COE in AVGC
            "Animation & Visual Effects"=>"K-TECH COE IN AVGC"),





        'K-tech COE by C-Camp' => array(
            //K-tech COE by C-Camp
            "AgricultureInnovation"=>"Innovation Agriculture",
            "ProblemStatement"=>"Problem Statement",
            "EventConducted"=>"Events Conducted",
            "Startup"=>"Fund Raised by Startups",
            "Partnership"=>"Partnership"),





        'K-tech COE on IoT' => array(
            //K-tech COE on IoT
            "IotStartUp"=>"Start-ups enrolled",
            "IotIntellectualProperty"=>"Intellectual Property",

            "GeneratedEmployment"=>"Employment Generated",
            "IotStartupsRisedFund"=>"Funds raised by start ups",
            "IotDelegation"=>"Delegations hosted at CoE",
            "IotPilotsProject"=>"Pilots ProjectList",
            "IotIndustryConnected"=>"Industries Connected",
            "IotAcademiaConnected"=>"Academia Connected",

            "IotEventWorkshop"=>"Events/Workshops Conducted",
			"IotOccupancy" => "Occupancy",
			"IotOtherProgram" => "Other Program"),




        'K-tech COE - MINRO' => array(
            //K-tech COE - MINRO
            "CapacityBuilding"=>"Capacity building",
            "InternationalConferences"=>"International Conference",
            "StartupConferences"=>"Startup Conference",
            "StudentEnrollment"=>"Student Enrollment",
            "GovtOfficialTraining"=>"Training of Govt Officials",
            "Patent"=> "Patents"),




        'K-tech COE - SFAL' => array(
            //K-tech COE - SFAL
            "Companies"=> "Companies",
            "Partners"=> "Partners",
            "Cohort"=> "Cohort"),
    );
        $tableDisplaydata=[];
        foreach ($array as $data){
           foreach ($data as $key=>$displayData){
               $tableDisplaydata[$key]=$displayData;
           }
        }

        $this->set('targetType',$array);
        $this->set('tableDisplaydata',$tableDisplaydata);
    }
     public function getCifRoundtables() {
        $list_array = array();
        $details = $this->CifRoundtable->find('all',array("order"=>"CifRoundtable.name ASC"));

        foreach($details as $list) {
            $list_array[$list['CifRoundtable']['id']] = $list['CifRoundtable']['name'];
        }

        $this->set('roundtable',$list_array);
    }
    public function getCifStartUps() {
        $list_array = array();
        $this->loadModel('CifStartup');
        $details = $this->CifStartup->find('all',array("order"=>"CifStartup.startup_name ASC"));

        foreach($details as $list) {
            $list_array[$list['CifStartup']['id']] = $list['CifStartup']['startup_name'];
        }

        $this->set('startups',$list_array);
    }
    public function getCifGenderDiversity() {
        $list_array = array();
        $this->loadModel('CifGenderDiversity');
        $details = $this->CifGenderDiversity->find('all',array("order"=>"CifGenderDiversity.event_name ASC"));

        foreach($details as $list) {
            $list_array[$list['CifGenderDiversity']['id']] = $list['CifGenderDiversity']['event_name'];
        }

        $this->set('gender_diversity',$list_array);
    }
    public function getCifExternalEvent() {
        $list_array = array();
        $this->loadModel('CifExternalEvent');
        $details = $this->CifExternalEvent->find('all',array("order"=>"CifExternalEvent.event_name ASC"));

        foreach($details as $list) {
            $list_array[$list['CifExternalEvent']['id']] = $list['CifExternalEvent']['event_name'];
        }

        $this->set('external_event',$list_array);
    }
    public function cifTargetType() {
        $array=array(
            'Events' => array(
                'Conference' => 'Conference',
                'Round Table' =>'Round Table',
                'Hackathon' => 'Hackathon',
            ),
            'Publicity Mentions' => array(
                'News Paper' => 'News Paper',
                'Online Platform' => 'Online Platform',
            ),
            'Startups' => 'Startups',
            'Fund Raised by Startup' => 'Fund Raised by Startup',
            'Gender Diversity' => 'Gender Diversity',
            'Participation in External Events' => 'Participation in External Events',
            'Connects' => 'Connects',
            'Customer Satisfaction' => 'Customer Satisfaction',
        );
        $tableDisplaydata=[];
        foreach ($array as $data){
            foreach ($data as $key=>$displayData){
                $tableDisplaydata[$key]=$displayData;
            }
        }
        $this->set('targetType',$array);
        $this->set('tableDisplaydata',$tableDisplaydata);
    }
        public function getCifOrganization() {
        $list_array = array();
        $this->loadModel('CifOrganization');
        $details = $this->CifOrganization->find('all',array("order"=>"CifOrganization.name ASC"));

        foreach($details as $list) {
            $list_array[$list['CifOrganization']['id']] = $list['CifOrganization']['name'];
        }

        $this->set('organization',$list_array);
    }
    public function tbiTargetType() {
        $array=array(
            'CeNSE' =>  'CeNSE'
            //  => array(
                // 'Conference' => 'Conference',
                // 'Round Table' =>'Round Table',
                // 'Hackathon' => 'Hackathon', )
                ,
            'CPDM' => 'CPDM'
            // => array(
                // 'News Paper' => 'News Paper',
                // 'Online Platform' => 'Online Platform',)
                ,
            'MUTBI' => 'MUTBI'
            // => array(
                // 'News Paper' => 'News Paper',
                // 'Online Platform' => 'Online Platform',)
                ,
            'Ramaiah University' => 'Ramaiah University'
        );
        $tableDisplaydata=[];
        foreach ($array as $key=>$data){
            // foreach ($data as $key=>$displayData){
                $tableDisplaydata[$key]=$data;
            // }
        }
        $this->set('targetType',$array);
        // print_r($array);
        $this->set('tableDisplaydata',$tableDisplaydata);
    }
}
