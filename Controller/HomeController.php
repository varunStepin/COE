<?php

/*----------***------------***
Created by 	- Pavan Kumar M
Stated Date	- 09-08-2019

Updated By	-
Updated Date-
***----------***------------*/



/**
 * Static content controller.
 *
 * This file will render views from views/pages/
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

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
 include('excel_reader2.php');
class HomeController extends AppController {



    public $uses = array('InternshipFoundationCourse','AdvanceProjectBasedCourse','OrientationAwarenessCourse','UserDetail','Mentor','InvestorConnect','Sector','MarketResearch','Hackathon', 'DsReportPublished','LiasoningDept','EnrolledTrainer','TraineeSecuredJob','SolutionSupport','DeptFollowup','Trainee','ManageTraining','ManageAttendees','ManageSkill','ManageWorking','ManageSkillAttendee','ManageWorkingAttendee','ManageResearchProject','ManageResearchProjectIndustry','ManageAerospaceTraining','ResearchProjectTeam','ResearchProjectIndustryTeam','AerospaceStudent','ManageFacility','ManageInternshipPool','ManageStartup','ManageWhitePaper','ManageCyberSecurity','InternshipPoolIntern','ManageCapacityBuilding','ManageAgricultureInnovation','IotResearchIncubation','GeneratedEmployment','WhitePaper','Poc','SocietalProject',   'ManageIotStudentDetail','ManageIotCurriculum','ManageIntellectualProperty','ManageCapacityStudentDetail','ManageCapacityBuilding','Budget','Target',
        'ManageAerospaceDefenseTraining','AerospaceDefenseEmbeddedCourse','AerospaceDefenseTrainingProcess','AerospaceDefenseBootcamp','ManageEmbeddedCourseAttendee','ManageTrainingProcessAttendee','ManageBootcampAttendee','AerospaceDefenseSkilling','ManageSkillingAttendee' ,'AerospaceDefenseCourse','ManageCoursesAttendee','ManageStartupFacilitation',
        'Financial','Expenditure','ManageProblemStatement','ManageProblemStatementDetail','GraduateSchool'
    );
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');


    public function login() {
        $this->layout = 'login_layout';
        $this->getUserTypes();
        $ran_no = $this->genRandomStringCustom(25);
        $this->Session->write('CSRFTOKEN',$ran_no);
    }
    public function encryptInputs() {
        $this->layout = 'ajax';

        if ($this->request['data']['username']) {
            $inputs = $this->encrypt_decrypt("encrypt",$this->request['data']['username']);
        }
        if ($this->request['data']['password']) {

            $inputs = $this->encrypt_decrypt("encrypt",$this->request['data']['password']);
        }

        echo $inputs;
        exit();
    }



    public function index() {


        $this->layout = 'login_layout';
        $this->getUserTypes();
        //print_r($this->request->data);
        if(!empty($this->request->data)) {

            /*$this->request->data['UserDetail']['username'] = $this->request->data['UserDetail']['username'];

            print_r($this->request->data['UserDetail']);
			$this->request->data['UserDetail']['password'] = $this->encrypt_decrypt("encrypt",$this->request['data']['password']);

			print_r($this->request->data['UserDetail']);
			unset($this->request->data['UserDetail']['username_hidden']);
			unset($this->request->data['UserDetail']['password_hidden']);
           */

            if($this->request->data['UserDetail']['csrf_token']=== $this->Session->read('CSRFTOKEN')) {


                $users=$this->UserDetail->find('first',array(
                    "conditions"=>array(
                        "UserDetail.is_delete in"=>array(0,2),
                        "UserDetail.user_type"=>$this->request->data['UserDetail']['user_type'],
                        "UserDetail.mobile"=>$this->request->data['UserDetail']['username'],
                        "UserDetail.password"=>$this->request->data['UserDetail']['password']
                    ),
                    "fields"=>array('id','user_id','firstname','lastname','user_type','profile_image','email','college_detail_id','password')));
                // print_r($users); return;
                if(!empty($users)) {

                    $this->Session->write('UserSession', session_id());
                    if($users['UserDetail']['lastname'] == 'CIF'){
                        $this->Session->write('ApplicationType',"CIF");
                    }else if($users['UserDetail']['lastname']!='TBI'){
                    	$this->Session->write('ApplicationType',"COE");
					}else if($users['UserDetail']['lastname']=='TBI'){
						$this->Session->write('ApplicationType',"TBI");
					}
                    $this->Session->write('USER_TYPE', $users['UserDetail']['user_type']);
                    $this->Session->write('USER_ID', $users['UserDetail']['id']);
                    $this->Session->write('USER_NAME', $users['UserDetail']['firstname']);
                    $this->Session->write('USER_EMAIL', $users['UserDetail']['email']);
                    $this->Session->write('USER_PROFILE', $users['UserDetail']['profile_image']);
                    $this->Session->write('Phase', "Phase 1");

                    if($users['UserDetail']['user_type']=='Admin'){
                        $this->Session->write('USER_NAME', $users['UserDetail']['firstname']);
                        $this->redirect(array("controller"=>"Admin","action"=>"dashboard"));
                    } else if($users['UserDetail']['lastname']=='TBI'){
						//print_r($users['UserDetail']['user_type']); exit();
						$this->Session->write('USER_NAME', $users['UserDetail']['firstname']);
                        $this->redirect(array("controller"=>"Admin","action"=>"tbiDashboard"));
					}else{
                        $this->redirect(array("controller"=>"Admin","action"=>"dashboard"));
                    }
                } else {
                    $this->Session->setFlash(' <div class="text-center"> User Name or Password Wrong.</div>');
                    $this->redirect(array('controller'=>'Home','action'=>'login'));
                }
            } else {
                $this->Session->setFlash(' <div class="text-center"> Unauthorized access. Please try again</div>');
                $this->redirect(array('controller'=>'Home','action'=>'login'));
            }
        }
        else {
            $this->redirect(array('controller'=>'Home','action'=>'login'));
        }
    }
    function logout()
    {
        $this->Session-> destroy();
        $this->beforeRender();
        $this->response->disableCache();
        $this->redirect(array('controller'=>'Home','action'=>'login'));
    }
    public function changePassword(){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        if(!empty($this->request->data)) {
            if ($this->request->data['UserDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if(!empty($this->request->data)){
            if($this->request->data['UserDetail']['password']==$this->request->data['UserDetail']['confirm_password'])
            {
                $this->UserDetail->id = $this->Session->read('USER_ID');
                $password= $this->encrypt_decrypt("encrypt",$this->request->data['UserDetail']['password']);
                $this->request->data['UserDetail']['password'] = $password ;
                $this->UserDetail->saveField('password', $this->request->data['UserDetail']['password']);
                $this->Session->setFlash("<div class='notify-alert alert alert-success col-xl-3 col-lg-3 col-md-3 col-12 animated fadeInDown' id='php-alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-check'></i>Password updated successfully..</div>");
                $this->redirect(array("controller"=>"Home","action"=>"changePassword"));
            }
            else
            {
                $this->Session->setFlash("<div class='notify-alert alert alert-danger col-xl-3 col-lg-3 col-md-3 col-12 animated fadeInDown' id='php-alert'>
                <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-check'></i>Password doesn't match</div>");
            }
        }
        $this->changeCSRFToken();
    }
    public function delete(){
        $this->layout="ajax";
        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            $array_key=array_keys($this->request->data);
            $array_key=$array_key[0];

            $id=$this->request->data[$array_key]['id'];
            $controller=$this->request->data[$array_key]['controller'];
            $view=$this->request->data[$array_key]['view'];
            $module=$this->request->data[$array_key]['module'];

            if ($this->request->data[$array_key]['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array("controller"=>$controller,"action"=>$view));
            }

            $this->loadModel($module);
            $this->$module->id = $id;

            $this->$module->data[$module]['id']=$id;
            $this->$module->data[$module]['is_delete']=1;
            $this->$module->data[$module]['modified_date_time']=$this->_getCurrentDateTime();
            $this->$module->save($this->$module->data);

            $this->Session->setFlash("<div class='notify-alert alert alert-danger col-xl-3 col-lg-3 col-md-3 col-12 animated fadeInDown' id='php-alert'>
            <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-check'></i>Record Deleted Successfully....</div>");

            $this->redirect(array("controller"=>$controller,"action"=>$view));
        }

    }


    public function deleteUser($userId,$action){
        $this -> delete_from_local_file($userId,'profile_picture_file','UserDetail','profile_image');
        $this->delete_from_local_file ($userId, 'college_logo', 'CollegeDetail', 'logo');
        $this->UserDetail->data['UserDetail']['id']=$userId;
        $this->UserDetail->data['UserDetail']['is_delete']=1;

        $this->UserDetail->save($this->UserDetail->data);
        $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Record Deleted Successfully.</div>");
        $this -> redirect(array('action' =>$action));
    }
    public function mentor() {

        $this->layout = 'fab_layout';
        $this->getSector();

        $this->getYear();
        $this->getMonth();
        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['Mentor']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['Mentor']['actionType']=="edit"){
            $this->request->data = $this->Mentor->read(null,$this->request->data['Mentor']['id']);
        }
        else if($this->request->data['Mentor']['actionType']=="delete"){
            $id=$this->request->data['Mentor']['id'];

            if($this -> Mentor -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'listMentor'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'listMentor'));
            }
        }
        else if($this->request->data['Mentor']['actionType']=="insert"){
            $id=$this->request->data['Mentor']['id'];

            if($this->request->data['Mentor']['id']){
                $message="Mentor Updated Successfully";
            }
            else{
                $message="Mentor Added Successfully";
            }

            $this->Mentor->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");

            $this -> redirect(array('action' => 'listMentor'));
        }

        $this->changeCSRFToken();
    }
    public function listMentor() {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        $mentor_list = $this->Mentor->find('all');

        $this->set('mentor_list',$mentor_list);

    }



    public function manageEmbeddedCourseAttendeesList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        if($this->request->data['ManageEmbeddedCourseAttendee']['type']=="delete"){
            $id=$this->request->data['ManageEmbeddedCourseAttendee']['id'];

            if($this -> ManageEmbeddedCourseAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'manageEmbeddedCourseAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'manageEmbeddedCourseAttendeesList'));
            }
        }
        else{
            $this->ManageEmbeddedCourseAttendee->bindModel(array('belongsTo' => array('AerospaceDefenseEmbeddedCourse')));
            $manage_list = $this->ManageEmbeddedCourseAttendee->find('all',array('order'=>array('ManageEmbeddedCourseAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageTrainingProcessAttendeesList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($this->request->data['ManageTrainingProcessAttendee']['type']=="delete"){
            $id=$this->request->data['ManageTrainingProcessAttendee']['id'];

            if($this->ManageTrainingProcessAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'manageTrainingProcessAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'manageTrainingProcessAttendeesList'));
            }
        }
        else{
            $this->ManageTrainingProcessAttendee->bindModel(array('belongsTo' => array('AerospaceDefenseTrainingProcess')));
            $manage_list = $this->ManageTrainingProcessAttendee->find('all',array('order'=>array('ManageTrainingProcessAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageBootcampAttendeesList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        if($this->request->data['ManageBootcampAttendee']['type']=="delete"){
            $id=$this->request->data['ManageBootcampAttendee']['id'];

            if($this -> ManageBootcampAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'manageBootcampAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'manageBootcampAttendeesList'));
            }
        }
        else{
            $this->ManageBootcampAttendee->bindModel(array('belongsTo' => array('AerospaceDefenseBootcamp')));
            $manage_list = $this->ManageBootcampAttendee->find('all',array('order'=>array('ManageBootcampAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageSkillingAttendeesList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        if($this->request->data['ManageSkillingAttendee']['type']=="delete"){
            $id=$this->request->data['ManageSkillingAttendee']['id'];

            if($this -> ManageSkillingAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'manageSkillingAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'manageSkillingAttendeesList'));
            }
        }
        else{
            $this->ManageSkillingAttendee->bindModel(array('belongsTo' => array('AerospaceDefenseSkilling')));
            $manage_list = $this->ManageSkillingAttendee->find('all',array('order'=>array('ManageSkillingAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageCourseAttendeesList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($this->request->data['ManageCoursesAttendee']['type']=="delete"){
            $id=$this->request->data['ManageCoursesAttendee']['id'];

            if($this -> ManageCoursesAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'manageCourseAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'manageCourseAttendeesList'));
            }
        }
        else{
            $this->ManageCoursesAttendee->bindModel(array('belongsTo' => array('AerospaceDefenseCourse')));
            $manage_list = $this->ManageCoursesAttendee->find('all',array('order'=>array('ManageCoursesAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }
    
    
    
    
    public function investorConnect($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['InvestorConnect']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'investorConnect'));

            }
        }
        if($this->request->data['InvestorConnect']['type']=="edit"){
            $this->request->data = $this->InvestorConnect->read(null,$this->request->data['InvestorConnect']['id']);
        }
        else if($this->request->data['InvestorConnect']['type']=="delete"){
            $investor_connect_id=$this->request->data['InvestorConnect']['id'];

            if($this -> InvestorConnect -> delete($investor_connect_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'investorConnect'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'investorConnect'));
            }
        }
        else if($this->request->data['InvestorConnect']['type']=="insert" ){

            if($this->request->data['InvestorConnect']['id']){
                $message="Investor Connect Updated Successfully";
            }
            else{
                $message="Investor Connect Added Successfully";
            }
            $this->InvestorConnect->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'investorConnect'));

        }


        $investor_connect_list = $this->InvestorConnect->find('all',array('order'=>array('InvestorConnect.id DESC')));
        $this->set('investor_connect_list',$investor_connect_list);

        $this->changeCSRFToken();
    }
    public function marketResearch($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['MarketResearch']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'marketResearch'));

            }
        }
        if($this->request->data['MarketResearch']['type']=="edit"){
            $this->request->data = $this->MarketResearch->read(null,$this->request->data['MarketResearch']['id']);
        }
        else if($this->request->data['MarketResearch']['type']=="delete"){
            $market_research_id=$this->request->data['MarketResearch']['id'];

            if($this -> MarketResearch -> delete($market_research_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'marketResearch'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'marketResearch'));
            }
        }
        else if($this->request->data['MarketResearch']['type']=="insert" ){

            if($this->request->data['MarketResearch']['id']){
                $message="Investor Connect Updated Successfully";
            }
            else{
                $message="Investor Connect Added Successfully";
            }
            $this->MarketResearch->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'marketResearch'));

        }


        $market_research_list = $this->MarketResearch->find('all',array('order'=>array('MarketResearch.id DESC')));
        $this->set('market_research_list',$market_research_list);

        $this->changeCSRFToken();
    }


    public function hackathon($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {
            if ($this->request->data['Hackathon']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'hackathon'));

            }
        }
        if($this->request->data['Hackathon']['type']=="edit"){
            if( $this->request->data = $this->Hackathon->read(null,$this->request->data['Hackathon']['id'])) {
                $this->request->data['Hackathon']['date'] = date('d-m-Y', strtotime($this->request->data['Hackathon']['date']));
            }
        }
        else if($this->request->data['Hackathon']['type']=="delete"){
            $hackathon_id=$this->request->data['Hackathon']['id'];

            if($this -> Hackathon -> delete($hackathon_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'hackathon'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'hackathon'));
            }
        }
        else if($this->request->data['Hackathon']['type']=="insert" ){
            $this -> request -> data['Hackathon']['date']=date('Y-m-d',strtotime(  $this -> request -> data['Hackathon']['date']));

            if($this->request->data['Hackathon']['id']){
                $message="Hackathon Updated Successfully";
            }
            else{
                $message="Hackathon Added Successfully";
            }
            $this->Hackathon->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'hackathon'));

        }


        $hackathon_list = $this->Hackathon->find('all',array('order'=>array('Hackathon.id DESC')));
        $this->set('hackathon_list',$hackathon_list);

        $this->changeCSRFToken();
    }


    public function liasoningDept($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['LiasoningDept']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'liasoningDept'));

            }
        }
        if($this->request->data['LiasoningDept']['type']=="edit"){
            $this->request->data = $this->LiasoningDept->read(null,$this->request->data['LiasoningDept']['id']);
        }
        else if($this->request->data['LiasoningDept']['type']=="delete"){
            $hackathon_id=$this->request->data['LiasoningDept']['id'];

            if($this -> LiasoningDept -> delete($hackathon_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'liasoningDept'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'liasoningDept'));
            }
        }
        else if($this->request->data['LiasoningDept']['type']=="insert" ){

            if($this->request->data['LiasoningDept']['id']){
                $message="Research Paper Updated Successfully";
            }
            else{
                $message="Research Paper Added Successfully";
            }
            $this->LiasoningDept->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'liasoningDept'));

        }


        $dept_list = $this->LiasoningDept->find('all',array('order'=>array('LiasoningDept.id DESC')));
        $this->set('dept_list',$dept_list);

        $this->changeCSRFToken();
    }

    public function solutionSupport($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['SolutionSupport']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'solutionSupport'));
            }
        }

        if($this->request->data['SolutionSupport']['type']=="edit"){
            $this->request->data = $this->SolutionSupport->read(null,$this->request->data['SolutionSupport']['id']);
        }
        else if($this->request->data['SolutionSupport']['type']=="delete"){
            $id=$this->request->data['SolutionSupport']['id'];

            if($this -> SolutionSupport -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  SolutionSupport data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'solutionSupport'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  SolutionSupport delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'solutionSupport'));
            }
        }
        else if($this->request->data['SolutionSupport']['type']=="insert" ){

            if($this->request->data['SolutionSupport']['id']){
                $message="SolutionSupport Updated Successfully";
            }
            else{
                $message="SolutionSupport Added Successfully";
            }

            $this->SolutionSupport->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'solutionSupport'));

        }


        $solutionSupport_list = $this->SolutionSupport->find('all',array('order'=>array('SolutionSupport.id DESC')));
        $this->set('solutionSupport_list',$solutionSupport_list);
        $this->changeCSRFToken();

    }

    public function deptFollowup($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['DeptFollowup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'deptFollowup'));
            }
        }

        if($this->request->data['DeptFollowup']['type']=="edit"){
            $this->request->data = $this->DeptFollowup->read(null,$this->request->data['DeptFollowup']['id']);
        }
        else if($this->request->data['DeptFollowup']['type']=="delete"){
            $id=$this->request->data['DeptFollowup']['id'];

            if($this -> DeptFollowup -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Dept Followup data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'deptFollowup'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Dept Followup delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'deptFollowup'));
            }
        }
        else if($this->request->data['DeptFollowup']['type']=="insert" ){

            if($this->request->data['DeptFollowup']['id']){
                $message="DeptFollowup Updated Successfully";
            }
            else{
                $message="DeptFollowup Added Successfully";
            }

            $this->DeptFollowup->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'deptFollowup'));

        }

        $deptFollowup_list = $this->DeptFollowup->find('all',array('order'=>array('DeptFollowup.id DESC')));
        $this->set('deptFollowup_list',$deptFollowup_list);
        $this->changeCSRFToken();

    }

    public function enrolledTrainer($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getDistrict();

        if(!empty($this->request->data)) {
            if ($this->request->data['EnrolledTrainer']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'enrolledTrainer'));
            }
        }

        if($this->request->data['EnrolledTrainer']['type']=="edit"){
            $this->request->data = $this->EnrolledTrainer->read(null,$this->request->data['EnrolledTrainer']['id']);
        }
        else if($this->request->data['EnrolledTrainer']['type']=="delete"){
            $id=$this->request->data['EnrolledTrainer']['id'];

            if($this -> EnrolledTrainer -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  EnrolledTrainer data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'enrolledTrainer'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  EnrolledTrainer delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'enrolledTrainer'));
            }
        }
        else if($this->request->data['EnrolledTrainer']['type']=="insert" ){

            $this -> request -> data['EnrolledTrainer']['date']=date('Y-m-d',strtotime(  $this -> request -> data['EnrolledTrainer']['date']));

            if($this->request->data['EnrolledTrainer']['id']){
                $message="EnrolledTrainer Updated Successfully";
            }
            else{
                $message="EnrolledTrainer Added Successfully";
            }
            $this->EnrolledTrainer->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'enrolledTrainer'));

        }


        $enrolledTrainer_list = $this->EnrolledTrainer->find('all',array('order'=>array('EnrolledTrainer.id DESC')));
        $this->set('enrolledTrainer_list',$enrolledTrainer_list);
        $this->changeCSRFToken();


    }
    public function trainee($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['Trainee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'trainee'));
            }
        }

        if($this->request->data['Trainee']['type']=="edit"){
            $this->request->data = $this->Trainee->read(null,$this->request->data['Trainee']['id']);
        }
        else if($this->request->data['Trainee']['type']=="delete"){
            $id=$this->request->data['Trainee']['id'];

            if($this -> Trainee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Dept Followup data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'trainee'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Dept Followup delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'trainee'));
            }
        }
        else if($this->request->data['Trainee']['type']=="insert" ){

            if($this->request->data['Trainee']['id']){
                $message="Trainee Updated Successfully";
            }
            else{
                $message="Trainee Added Successfully";
            }

            $this->Trainee->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'trainee'));

        }


        $trainee_list = $this->Trainee->find('all',array('order'=>array('Trainee.id DESC')));
        $this->set('trainee_list',$trainee_list);
        $this->changeCSRFToken();

    }
    public function traineeSecuredJob($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['TraineeSecuredJob']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'traineeSecuredJob'));
            }
        }

        if($this->request->data['TraineeSecuredJob']['type']=="edit"){
            $this->request->data = $this->TraineeSecuredJob->read(null,$this->request->data['TraineeSecuredJob']['id']);
        }
        else if($this->request->data['TraineeSecuredJob']['type']=="delete"){
            $id=$this->request->data['TraineeSecuredJob']['id'];

            if($this -> TraineeSecuredJob -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  TraineeSecuredJob data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'traineeSecuredJob'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  TraineeSecuredJob delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'traineeSecuredJob'));
            }
        }
        else if($this->request->data['TraineeSecuredJob']['type']=="insert" ){

            $this -> request -> data['TraineeSecuredJob']['date']=date('Y-m-d',strtotime(  $this -> request -> data['TraineeSecuredJob']['date']));

            if($this->request->data['TraineeSecuredJob']['id']){
                $message="TraineeSecuredJob Updated Successfully";
            }
            else{
                $message="TraineeSecuredJob Added Successfully";
            }
            $this->TraineeSecuredJob->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'traineeSecuredJob'));

        }


        $traineeSecuredJob_list = $this->TraineeSecuredJob->find('all',array('order'=>array('TraineeSecuredJob.id DESC')));
        $this->set('traineeSecuredJob_list',$traineeSecuredJob_list);
        $this->changeCSRFToken();
    }



    public function manageTrainingProgram($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageTraining']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageTrainingProgram'));

            }
        }
        if($this->request->data['ManageTraining']['type']=="edit"){
            $this->request->data = $this->ManageTraining->read(null,$this->request->data['ManageTraining']['id']);
        }
        else if($this->request->data['ManageTraining']['type']=="delete"){
            $id=$this->request->data['ManageTraining']['id'];

            if($this -> ManageTraining -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageTrainingProgram'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageTrainingProgram'));
            }
        }
        else if($this->request->data['ManageTraining']['type']=="insert" ){

            if($this->request->data['ManageTraining']['id']){
                $message="Training Updated Successfully";
            }
            else{
                $message="Training Added Successfully";
            }

            $this->ManageTraining->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageTrainingProgram'));

        }

        $manage_training_list = $this->ManageTraining->find('all',array('order'=>array('ManageTraining.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }

    public function manageAttendees($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getProgram();

        if($this->request->data['ManageAttendees']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageAttendees"=>array(
                        "manage_training_id"=>$this->request->data['ManageAttendees']['manage_training_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageAttendees->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageAttendees'));
        }


        elseif($this->request->data['ManageAttendees']['csrf_token']!=""){
            if ($this->request->data['ManageAttendees']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageAttendees'));

            }
        }
        $this->changeCSRFToken();
    }

    public function manageAttendeesList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ManageAttendees']['type']=="delete"){
            $id=$this->request->data['ManageAttendees']['id'];

            if($this -> ManageAttendees -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageAttendeesList'));
            }
        }
        else{
            $manage_list = $this->ManageAttendees->find('all',array('order'=>array('ManageAttendees.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageSkillTraining($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageSkill']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageSkillTraining'));

            }
        }
        if($this->request->data['ManageSkill']['type']=="edit"){
            $this->request->data = $this->ManageSkill->read(null,$this->request->data['ManageSkill']['id']);
        }
        else if($this->request->data['ManageSkill']['type']=="delete"){
            $id=$this->request->data['ManageSkill']['id'];

            if($this -> ManageSkill -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageSkillTraining'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageSkillTraining'));
            }
        }
        else if($this->request->data['ManageSkill']['type']=="insert" ){

            if($this->request->data['ManageSkill']['id']){
                $message="Skill Training Updated Successfully";
            }
            else{
                $message="Skill Training Added Successfully";
            }

            $this->ManageSkill->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageSkillTraining'));

        }

        $manage_training_list = $this->ManageSkill->find('all',array('order'=>array('ManageSkill.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }

    public function manageWorkingTraining($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageWorking']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageWorkingTraining'));

            }
        }
        if($this->request->data['ManageWorking']['type']=="edit"){
            $this->request->data = $this->ManageWorking->read(null,$this->request->data['ManageWorking']['id']);
        }
        else if($this->request->data['ManageWorking']['type']=="delete"){
            $id=$this->request->data['ManageWorking']['id'];

            if($this -> ManageWorking -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageWorkingTraining'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageWorkingTraining'));
            }
        }
        else if($this->request->data['ManageWorking']['type']=="insert" ){

            if($this->request->data['ManageWorking']['id']){
                $message="Working Training Updated Successfully";
            }
            else{
                $message="Working Training Added Successfully";
            }

            $this->ManageWorking->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageWorkingTraining'));

        }

        $manage_training_list = $this->ManageWorking->find('all',array('order'=>array('ManageWorking.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }


    public function manageSkillAttendees($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getSkill();

        if($this->request->data['ManageSkillAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageSkillAttendee"=>array(
                        "manage_skill_id"=>$this->request->data['ManageSkillAttendee']['manage_skill_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageSkillAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageSkillAttendees'));
        }


        elseif($this->request->data['ManageSkillAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageSkillAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageSkillAttendees'));

            }
        }
        $this->changeCSRFToken();
    }

    public function manageSkillAttendeesList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ManageSkillAttendee']['type']=="delete"){
            $id=$this->request->data['ManageSkillAttendee']['id'];

            if($this -> ManageSkillAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageSkillAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageSkillAttendeesList'));
            }
        }
        else{
            $manage_list = $this->ManageSkillAttendee->find('all',array('order'=>array('ManageSkillAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }

    public function manageWorkingAttendees($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getWorking();

        if($this->request->data['ManageWorkingAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageWorkingAttendee"=>array(
                        "manage_working_id"=>$this->request->data['ManageWorkingAttendee']['manage_working_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "company_name"=>$this->request->data['company_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageWorkingAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageWorkingAttendees'));
        }


        elseif($this->request->data['ManageWorkingAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageWorkingAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageWorkingAttendees'));

            }
        }
        $this->changeCSRFToken();
    }

    public function manageWorkingAttendeesList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ManageWorkingAttendee']['type']=="delete"){
            $id=$this->request->data['ManageWorkingAttendee']['id'];

            if($this -> ManageWorkingAttendee -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageWorkingAttendeesList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageWorkingAttendeesList'));
            }
        }
        else{
            $manage_list = $this->ManageWorkingAttendee->find('all',array('order'=>array('ManageWorkingAttendee.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }



    public function manageResearchProject($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageResearchProject']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'ManageResearchProject'));

            }
        }
        if($this->request->data['ManageResearchProject']['type']=="edit"){
            $this->request->data = $this->ManageResearchProject->read(null,$this->request->data['ManageResearchProject']['id']);
        }
        else if($this->request->data['ManageResearchProject']['type']=="delete"){
            $id=$this->request->data['ManageResearchProject']['id'];

            if($this -> ManageResearchProject -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'ManageResearchProject'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'ManageResearchProject'));
            }
        }
        else if($this->request->data['ManageResearchProject']['type']=="insert" ){
            /*Project Upload*/
            $tmp_doc_name=$this->request->data['ManageResearchProject']['file']['tmp_name'];
            $doc_name=$this->request->data['ManageResearchProject']['file']['name'];
            $doc_type=$this->request->data['ManageResearchProject']['file']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {

                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."project/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'ManageResearchProject'));
                }
            }
            /*Project Upload*/

            $this->request->data['ManageResearchProject']['file'] = $new_doc_name;

            if($this->request->data['ManageResearchProject']['id']){
                $message="Research Project Updated Successfully";
            }
            else{
                $message="Research Project Added Successfully";
            }

            $this->ManageResearchProject->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'ManageResearchProject'));

        }

        $manage_training_list = $this->ManageResearchProject->find('all',array('order'=>array('ManageResearchProject.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }


    public function manageResearchProjectIndustry($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageResearchProjectIndustry']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageResearchProjectIndustry'));

            }
        }
        if($this->request->data['ManageResearchProjectIndustry']['type']=="edit"){
            $this->request->data = $this->ManageResearchProjectIndustry->read(null,$this->request->data['ManageResearchProjectIndustry']['id']);
        }
        else if($this->request->data['ManageResearchProjectIndustry']['type']=="delete"){
            $id=$this->request->data['ManageResearchProjectIndustry']['id'];

            if($this -> ManageResearchProjectIndustry -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageResearchProjectIndustry'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageResearchProjectIndustry'));
            }
        }
        else if($this->request->data['ManageResearchProjectIndustry']['type']=="insert" ){
            /*Project Upload*/
            $tmp_doc_name=$this->request->data['ManageResearchProjectIndustry']['file']['tmp_name'];
            $doc_name=$this->request->data['ManageResearchProjectIndustry']['file']['name'];
            $doc_type=$this->request->data['ManageResearchProjectIndustry']['file']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {

                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."Industry_project/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'manageResearchProjectIndustry'));
                }
            }
            /*Project Upload*/

            $this->request->data['ManageResearchProjectIndustry']['file'] = $new_doc_name;

            if($this->request->data['ManageResearchProjectIndustry']['id']){
                $message="Research Project Industry Updated Successfully";
            }
            else{
                $message="Research Project Industry Added Successfully";
            }

            $this->ManageResearchProjectIndustry->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageResearchProjectIndustry'));

        }

        $manage_training_list = $this->ManageResearchProjectIndustry->find('all',array('order'=>array('ManageResearchProjectIndustry.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }




    public function researchProjectTeams($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getResearchProject();

        if($this->request->data['ResearchProjectTeam']['type']=="insert")
        {
            $contact_number = $this->request->data['contact_number'];
            for($i=0;$i<count($contact_number);$i++)
            {
                $data = array(
                    "ResearchProjectTeam"=>array(
                        "manage_research_project_id"=>$this->request->data['ResearchProjectTeam']['manage_research_project_id'],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ResearchProjectTeam->saveAll($data);
            }
            $message="Team Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'researchProjectTeams'));
        }


        elseif($this->request->data['ResearchProjectTeam']['csrf_token']!=""){
            if ($this->request->data['ResearchProjectTeam']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'researchProjectTeams'));

            }
        }
        $this->changeCSRFToken();
    }

    public function researchProjectTeamList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ResearchProjectTeam']['type']=="delete"){
            $id=$this->request->data['ResearchProjectTeam']['id'];

            if($this -> ResearchProjectTeam -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'researchProjectTeamList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'researchProjectTeamList'));
            }
        }
        else{
            $manage_list = $this->ResearchProjectTeam->find('all',array('order'=>array('ResearchProjectTeam.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }

    public function researchProjectIndustryTeams($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getResearchProjectIndustry();

        if($this->request->data['ResearchProjectIndustryTeam']['type']=="insert")
        {
            $company_name = $this->request->data['company_name'];
            for($i=0;$i<count($company_name);$i++)
            {
                $data = array(
                    "ResearchProjectIndustryTeam"=>array(
                        "manage_research_project_industry_id"=>$this->request->data['ResearchProjectIndustryTeam']['manage_research_project_industry_id'],
                        "name"=>$this->request->data['name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "company_name"=>$this->request->data['company_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ResearchProjectIndustryTeam->saveAll($data);
            }
            $message="Team Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'researchProjectIndustryTeams'));
        }


        elseif($this->request->data['ResearchProjectIndustryTeam']['csrf_token']!=""){
            if ($this->request->data['ResearchProjectIndustryTeam']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'researchProjectIndustryTeams'));

            }
        }
        $this->changeCSRFToken();
    }

    public function researchProjectIndustryTeamList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ResearchProjectIndustryTeam']['type']=="delete"){
            $id=$this->request->data['ResearchProjectIndustryTeam']['id'];

            if($this -> ResearchProjectIndustryTeam -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'researchProjectIndustryTeamList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'researchProjectIndustryTeamList'));
            }
        }
        else{
            $manage_list = $this->ResearchProjectIndustryTeam->find('all',array('order'=>array('ResearchProjectIndustryTeam.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageAerospaceTraining($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageAerospaceTraining']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageAerospaceTraining'));

            }
        }
        if($this->request->data['ManageAerospaceTraining']['type']=="edit"){
            $this->request->data = $this->ManageAerospaceTraining->read(null,$this->request->data['ManageAerospaceTraining']['id']);
        }
        else if($this->request->data['ManageAerospaceTraining']['type']=="delete"){
            $id=$this->request->data['ManageAerospaceTraining']['id'];

            if($this -> ManageAerospaceTraining -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageAerospaceTraining'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageAerospaceTraining'));
            }
        }
        else if($this->request->data['ManageAerospaceTraining']['type']=="insert" ){

            if($this->request->data['ManageAerospaceTraining']['id']){
                $message="Aerospace Training Updated Successfully";
            }
            else{
                $message="Aerospace Training Added Successfully";
            }

            $this->ManageAerospaceTraining->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageAerospaceTraining'));

        }

        $manage_training_list = $this->ManageAerospaceTraining->find('all',array('order'=>array('ManageAerospaceTraining.id DESC')));
        $this->set('manage_training_list',$manage_training_list);

        $this->changeCSRFToken();
    }

    public function aerospaceStudents($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getAerospaceTraining();

        if($this->request->data['AerospaceStudent']['type']=="insert")
        {
            $institute_name = $this->request->data['institute_name'];
            for($i=0;$i<count($institute_name);$i++)
            {
                $data = array(
                    "AerospaceStudent"=>array(
                        "manage_aerospace_training_id"=>$this->request->data['AerospaceStudent']['manage_aerospace_training_id'],
                        "name"=>$this->request->data['name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->AerospaceStudent->saveAll($data);
            }
            $message="Student Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceStudents'));
        }
        elseif($this->request->data['AerospaceStudent']['csrf_token']!=""){
            if ($this->request->data['AerospaceStudent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceStudents'));

            }
        }
        $this->changeCSRFToken();
    }

    public function aerospaceStudentsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['AerospaceStudent']['type']=="delete"){
            $id=$this->request->data['AerospaceStudent']['id'];

            if($this -> AerospaceStudent -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceStudentsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'aerospaceStudentsList'));
            }
        }
        else{
            $manage_list = $this->AerospaceStudent->find('all',array('order'=>array('AerospaceStudent.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }

    //Animation, Visual Effects

    public function manageFacility($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageFacility']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageFacility'));

            }
        }
        if($this->request->data['ManageFacility']['type']=="edit"){
            $this->request->data = $this->ManageFacility->read(null,$this->request->data['ManageFacility']['id']);
        }
        else if($this->request->data['ManageFacility']['type']=="delete"){
            $id=$this->request->data['ManageFacility']['id'];

            if($this -> ManageFacility -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageFacility'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageFacility'));
            }
        }
        else if($this->request->data['ManageFacility']['type']=="insert" ){

            if($this->request->data['ManageFacility']['id']){
                $message="Facility Updated Successfully";
            }
            else{
                $message="Facility Added Successfully";
            }

            $this->ManageFacility->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageFacility'));

        }

        $manage_list = $this->ManageFacility->find('all',array('order'=>array('ManageFacility.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    //Cyber Security

    public function manageInternshipPool($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageInternshipPool']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageInternshipPool'));

            }
        }
        if($this->request->data['ManageInternshipPool']['type']=="edit"){
            $this->request->data = $this->ManageInternshipPool->read(null,$this->request->data['ManageInternshipPool']['id']);
            $this->request->data['ManageInternshipPool']['month']=$this->request->data['ManageInternshipPool']['month'].'-'.$this->request->data['ManageInternshipPool']['year'];
        }
        else if($this->request->data['ManageInternshipPool']['type']=="delete"){
            $id=$this->request->data['ManageInternshipPool']['id'];

            if($this -> ManageInternshipPool -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageInternshipPool'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageInternshipPool'));
            }
        }
        else if($this->request->data['ManageInternshipPool']['type']=="insert" ){

            if($this->request->data['ManageInternshipPool']['id']){
                $message="Internship Pool Updated Successfully";
            }
            else{
                $message="Internship Pool Added Successfully";
            }
            //$monthYear=explode('-',$this->request->data['ManageInternshipPool']['month']);
            //$this->request->data['ManageInternshipPool']['month']=$monthYear[0];
            //$this->request->data['ManageInternshipPool']['year']=$monthYear[1];
            
            $monthYear=explode('-',$this->request->data['ManageInternshipPool']['date']);
			$this->request->data['ManageInternshipPool']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageInternshipPool']['year']=$monthYear[2];
            
            
            $this->ManageInternshipPool->save($this->request->data);

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageInternshipPool'));

        }

        $manage_list = $this->ManageInternshipPool->find('all',array('order'=>array('ManageInternshipPool.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    public function internshipPoolInterns($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getInternshipPool();

        if($this->request->data['InternshipPoolIntern']['type']=="insert")
        {
            $intern_name = $this->request->data['intern_name'];
            for($i=0;$i<count($intern_name);$i++)
            {
                $data = array(
                    "InternshipPoolIntern"=>array(
                        "manage_internship_pool_id"=>$this->request->data['InternshipPoolIntern']['manage_internship_pool_id'],
                        "intern_name"=>$this->request->data['intern_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->InternshipPoolIntern->saveAll($data);
            }
            $message="Interns Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'internshipPoolInterns'));
        }


        elseif($this->request->data['InternshipPoolIntern']['csrf_token']!=""){
            if ($this->request->data['InternshipPoolIntern']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'internshipPoolInterns'));

            }
        }
        $this->changeCSRFToken();
    }

    public function internshipPoolInternsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['InternshipPoolIntern']['type']=="delete"){
            $id=$this->request->data['InternshipPoolIntern']['id'];

            if($this -> InternshipPoolIntern -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'internshipPoolInternsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'internshipPoolInternsList'));
            }
        }
        else{
            $manage_list = $this->InternshipPoolIntern->find('all',array('order'=>array('InternshipPoolIntern.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageStartup($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageStartup'));

            }
        }
        if($this->request->data['ManageStartup']['type']=="edit"){
            $this->request->data = $this->ManageStartup->read(null,$this->request->data['ManageStartup']['id']);
            $this->request->data['ManageStartup']['month']=$this->request->data['ManageStartup']['month'].'-'.$this->request->data['ManageStartup']['year'];
        }
        else if($this->request->data['ManageStartup']['type']=="delete"){
            $id=$this->request->data['ManageStartup']['id'];

            if($this -> ManageStartup -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageStartup'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageStartup'));
            }
        }
        else if($this->request->data['ManageStartup']['type']=="insert" ){

            if($this->request->data['ManageStartup']['id']){
                $message="Startup Updated Successfully";
            }
            else{
                $message="Startup Added Successfully";
            }
            //$monthYear=explode('-',$this->request->data['ManageStartup']['month']);
            //$this->request->data['ManageStartup']['month']=$monthYear[0];
            //$this->request->data['ManageStartup']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['ManageStartup']['start_date']);
			$this->request->data['ManageStartup']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageStartup']['year']=$monthYear[2];
            
            $this->ManageStartup->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageStartup'));

        }

        $manage_list = $this->ManageStartup->find('all',array('order'=>array('ManageStartup.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }


    public function manageWhitePaper($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageWhitePaper']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageWhitePaper'));

            }
        }
        if($this->request->data['ManageWhitePaper']['type']=="edit"){
            $this->request->data = $this->ManageWhitePaper->read(null,$this->request->data['ManageWhitePaper']['id']);
            $this->request->data['ManageWhitePaper']['month']=$this->request->data['ManageWhitePaper']['month'].'-'.$this->request->data['ManageWhitePaper']['year'];
        }
        else if($this->request->data['ManageWhitePaper']['type']=="delete"){
            $id=$this->request->data['ManageWhitePaper']['id'];

            if($this -> ManageWhitePaper -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageWhitePaper'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageWhitePaper'));
            }
        }
        else if($this->request->data['ManageWhitePaper']['type']=="insert" ){
            /*Newsletter Upload*/
            $tmp_doc_name=$this->request->data['ManageWhitePaper']['newsletter_upload']['tmp_name'];
            $doc_name=$this->request->data['ManageWhitePaper']['newsletter_upload']['name'];
            $doc_type=$this->request->data['ManageWhitePaper']['newsletter_upload']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='') {
                if(in_array($pdf_doc_ext,$allowed_doc_types)) {
                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."Newsletter/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                    $this->request->data['ManageWhitePaper']['newsletter_upload'] = $new_doc_name;
                }
                else {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'manageWhitePaper'));
                }
            }else{
                unset($this->request->data['ManageWhitePaper']['newsletter_upload']);
            }
            /*Newsletter Upload*/

            if($this->request->data['ManageWhitePaper']['id']){
                $message="White Paper Updated Successfully";
            }
            else{
                $message="White Paper Added Successfully";
            }
            //$monthYear=explode('-',$this->request->data['ManageWhitePaper']['month']);
            //$this->request->data['ManageWhitePaper']['month']=$monthYear[0];
            //$this->request->data['ManageWhitePaper']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['ManageWhitePaper']['publication_date']);
			$this->request->data['ManageWhitePaper']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageWhitePaper']['year']=$monthYear[2];

            $this->ManageWhitePaper->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageWhitePaper'));

        }

        $manage_list = $this->ManageWhitePaper->find('all',array('order'=>array('ManageWhitePaper.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    public function manageCyberSecurity($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['ManageCyberSecurity']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageCyberSecurity'));

            }
        }
        if($this->request->data['ManageCyberSecurity']['type']=="edit"){
            $this->request->data = $this->ManageCyberSecurity->read(null,$this->request->data['ManageCyberSecurity']['id']);
            $this->request->data['ManageCyberSecurity']['month']=$this->request->data['ManageCyberSecurity']['month'].'-'.$this->request->data['ManageCyberSecurity']['year'];
        }
        else if($this->request->data['ManageCyberSecurity']['type']=="delete"){
            $id=$this->request->data['ManageCyberSecurity']['id'];

            if($this -> ManageCyberSecurity -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageCyberSecurity'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageCyberSecurity'));
            }
        }
        else if($this->request->data['ManageCyberSecurity']['type']=="insert" ){

            if($this->request->data['ManageCyberSecurity']['id']){
                $message="Cyber Security Updated Successfully";
            }
            else{
                $message="Cyber Security Added Successfully";
            }
            //$monthYear=explode('-',$this->request->data['ManageCyberSecurity']['month']);
            //$this->request->data['ManageCyberSecurity']['month']=$monthYear[0];
            //$this->request->data['ManageCyberSecurity']['year']=$monthYear[1];
            
            $monthYear=explode('-',$this->request->data['ManageCyberSecurity']['date']);
			$this->request->data['ManageCyberSecurity']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageCyberSecurity']['year']=$monthYear[2];
            
            $this->ManageCyberSecurity->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageCyberSecurity'));

        }

        $manage_list = $this->ManageCyberSecurity->find('all',array('order'=>array('ManageCyberSecurity.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }



    public function manageCapacityBuilding($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['ManageCapacityBuilding']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageCapacityBuilding'));


            }
        }
        if($this->request->data['ManageCapacityBuilding']['type']=="edit"){
            $this->request->data = $this->ManageCapacityBuilding->read(null,$this->request->data['ManageCapacityBuilding']['id']);
            $this->request->data['ManageCapacityBuilding']['month']=$this->request->data['ManageCapacityBuilding']['month'].'-'.$this->request->data['ManageCapacityBuilding']['year'];
        }
        else if($this->request->data['ManageCapacityBuilding']['type']=="delete"){
            $id=$this->request->data['ManageCapacityBuilding']['id'];

            if($this -> ManageCapacityBuilding -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageCapacityBuilding'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageCapacityBuilding'));
            }
        }
        else if($this->request->data['ManageCapacityBuilding']['type']=="insert" ){

            if($this->request->data['ManageCapacityBuilding']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            //$monthYear=explode('-',$this->request->data['ManageCapacityBuilding']['month']);
            //$this->request->data['ManageCapacityBuilding']['month']=$monthYear[0];
            //$this->request->data['ManageCapacityBuilding']['year']=$monthYear[1];
           
            $monthYear=explode('-',$this->request->data['ManageCapacityBuilding']['start_date']);
			$this->request->data['ManageCapacityBuilding']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageCapacityBuilding']['year']=$monthYear[2];
			
            
            $this->ManageCapacityBuilding->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageCapacityBuilding'));

        }

        $manage_list = $this->ManageCapacityBuilding->find('all',array('order'=>array('ManageCapacityBuilding.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    public function manageCapacityStudentDetails($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getCapacityBuilding();


        if($this->request->data['ManageCapacityStudentDetail']['type']=="insert")
        {
            $student_name = $this->request->data['student_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "ManageCapacityStudentDetail"=>array(
                        "manage_capacity_building_id"=>$this->request->data['ManageCapacityStudentDetail']['manage_capacity_building_id'],
                        "student_name"=>$this->request->data['student_name'][$i],
                        "branch"=>$this->request->data['branch'][$i],
                        "qualification"=>$this->request->data['qualification'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageCapacityStudentDetail->saveAll($data);
            }
            $message="Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageCapacityStudentDetails'));
        }


        elseif($this->request->data['ManageCapacityStudentDetail']['csrf_token']!=""){
            if ($this->request->data['ManageCapacityStudentDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageCapacityStudentDetails'));

            }
        }
        $this->changeCSRFToken();
    }


    public function manageCapacityStudentDetailsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['ManageCapacityStudentDetail']['type']=="delete"){
            $id=$this->request->data['ManageCapacityStudentDetail']['id'];

            if($this -> ManageCapacityStudentDetail -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageCapacityStudentDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageCapacityStudentDetailsList'));
            }
        }
        else{
            $manage_list = $this->ManageCapacityStudentDetail->find('all',array('order'=>array('ManageCapacityStudentDetail.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }

    public function manageIntellectualProperty($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['ManageIntellectualProperty']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageIntellectualProperty'));

            }
        }
        if($this->request->data['ManageIntellectualProperty']['type']=="edit"){
            if( $this->request->data = $this->ManageIntellectualProperty->read(null,$this->request->data['ManageIntellectualProperty']['id'])) {
                $this->request->data['ManageIntellectualProperty']['date'] = date('d-m-Y', strtotime($this->request->data['ManageIntellectualProperty']['date']));
            }
        }
        else if($this->request->data['ManageIntellectualProperty']['type']=="delete"){
            $id=$this->request->data['ManageIntellectualProperty']['id'];

            if($this -> ManageIntellectualProperty -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageIntellectualProperty'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageIntellectualProperty'));
            }
        }
        else if($this->request->data['ManageIntellectualProperty']['type']=="insert" ){
            $this -> request -> data['ManageIntellectualProperty']['date']=date('Y-m-d',strtotime(  $this -> request -> data['ManageIntellectualProperty']['date']));

            if($this->request->data['ManageIntellectualProperty']['id']){
                $message="Intellectual Property Updated Successfully";
            }
            else{
                $message="Intellectual Property Added Successfully";
            }
            $this->ManageIntellectualProperty->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageIntellectualProperty'));

        }


        $manage_list = $this->ManageIntellectualProperty->find('all',array('order'=>array('ManageIntellectualProperty.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    public function manageIotCurriculum($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['ManageIotCurriculum']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageIotCurriculum'));

            }
        }
        if($this->request->data['ManageIotCurriculum']['type']=="edit"){
            if( $this->request->data = $this->ManageIotCurriculum->read(null,$this->request->data['ManageIotCurriculum']['id'])) {
                $this->request->data['ManageIotCurriculum']['date'] = date('d-m-Y', strtotime($this->request->data['ManageIotCurriculum']['date']));
            }
        }
        else if($this->request->data['ManageIotCurriculum']['type']=="delete"){
            $id=$this->request->data['ManageIotCurriculum']['id'];

            if($this -> ManageIotCurriculum -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageIotCurriculum'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageIotCurriculum'));
            }
        }
        else if($this->request->data['ManageIotCurriculum']['type']=="insert" ){
            $this -> request -> data['ManageIotCurriculum']['date']=date('Y-m-d',strtotime(  $this -> request -> data['ManageIotCurriculum']['date']));

            if($this->request->data['ManageIotCurriculum']['id']){
                $message="Iot Curriculum Updated Successfully";
            }
            else{
                $message="Iot Curriculum Added Successfully";
            }
            $this->ManageIotCurriculum->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageIotCurriculum'));

        }


        $manage_list = $this->ManageIotCurriculum->find('all',array('order'=>array('ManageIotCurriculum.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }

    public function manageIotCurriculumStudents($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getIotCurriculum();


        if($this->request->data['ManageIotStudentDetail']['type']=="insert")
        {
            $student_name = $this->request->data['student_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "ManageIotStudentDetail"=>array(
                        "manage_iot_curriculum_id"=>$this->request->data['ManageIotStudentDetail']['manage_iot_curriculum_id'],
                        "student_name"=>$this->request->data['student_name'][$i],
                        "course"=>$this->request->data['course'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageIotStudentDetail->saveAll($data);
            }
            $message="Details  Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageIotCurriculumStudents'));
        }
        elseif($this->request->data['ManageIotStudentDetail']['csrf_token']!=""){
            if ($this->request->data['ManageIotStudentDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageIotCurriculumStudents'));

            }
        }
        $this->changeCSRFToken();
    }

    public function manageIotCurriculumStudentsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($this->request->data['ManageIotStudentDetail']['type']=="delete"){
            $id=$this->request->data['ManageIotStudentDetail']['id'];

            if($this -> ManageIotStudentDetail -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageIotCurriculumStudentsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageIotCurriculumStudentsList'));
            }
        }
        else{
            $manage_list = $this->ManageIotStudentDetail->find('all',array('order'=>array('ManageIotStudentDetail.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function manageAgricultureInnovation($id=null)
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['ManageAgricultureInnovation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageAgricultureInnovation'));

            }
        }

        if($this->request->data['ManageAgricultureInnovation']['actionType']=="edit"){
            $this->request->data = $this->ManageAgricultureInnovation->read(null,$this->request->data['ManageAgricultureInnovation']['id']);
            $this->request->data['ManageAgricultureInnovation']['incubation_start_date'] = date('d-m-Y', strtotime($this->request->data['ManageAgricultureInnovation']['incubation_start_date']));
        }
        else if($this->request->data['ManageAgricultureInnovation']['actionType']=="delete"){
            $id=$this->request->data['ManageAgricultureInnovation']['id'];

            if($this -> ManageAgricultureInnovation -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageAgricultureInnovation'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageAgricultureInnovation'));
            }
        }

        else if($this->request->data['ManageAgricultureInnovation']['type']=="insert" ){
            $monthYear=explode('-',$this->request->data['ManageAgricultureInnovation']['incubation_start_date']);
			$this->request->data['ManageAgricultureInnovation']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['ManageAgricultureInnovation']['year']=$monthYear[2];
			
            $this -> request -> data['ManageAgricultureInnovation']['incubation_start_date']=date('Y-m-d',strtotime(  $this -> request -> data['ManageAgricultureInnovation']['incubation_start_date']));

            if($this->request->data['ManageAgricultureInnovation']['id']){
                $message=" Agriculture Innovation Updated Successfully";
            }
            else{
                $message="Agriculture Innovation Added Successfully";
            }

            $this->ManageAgricultureInnovation->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageAgricultureInnovation'));

        }

        $this->changeCSRFToken();

    }

    public function manageInnovationAgricultureList()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $manage_agriculture_list = $this->ManageAgricultureInnovation->find('all',array('order'=>array('ManageAgricultureInnovation.id DESC')));
        $this->set('manage_agriculture_list',$manage_agriculture_list);
    }


    public function iotResearchIncubation()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['IotResearchIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'iotResearchIncubation'));

            }
        }
        if($this->request->data['IotResearchIncubation']['actionType']=="edit"){
            $this->request->data = $this->IotResearchIncubation->read(null,$this->request->data['IotResearchIncubation']['id']);
            $this->request->data['IotResearchIncubation']['incubation_start_date'] = date('d-m-Y', strtotime($this->request->data['IotResearchIncubation']['incubation_start_date']));
        }
        else if($this->request->data['IotResearchIncubation']['actionType']=="delete"){
            $id=$this->request->data['IotResearchIncubation']['id'];

            if($this -> IotResearchIncubation -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'iotResearchIncubationList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'iotResearchIncubation'));
            }
        }
        else if($this->request->data['IotResearchIncubation']['type']=="insert" ){
            $this -> request -> data['IotResearchIncubation']['incubation_start_date']=date('Y-m-d',strtotime(  $this -> request -> data['IotResearchIncubation']['incubation_start_date']));

            if($this->request->data['IotResearchIncubation']['id']){
                $message="IOT Research Incubation Updated Successfully";
            }
            else{
                $message="IOT Research Incubation Added Successfully";
            }

            $this->IotResearchIncubation->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'iotResearchIncubationList'));

        }

        $this->changeCSRFToken();
    }

    public function iotResearchIncubationList()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $iot_research_list = $this->IotResearchIncubation->find('all',array('order'=>array('IotResearchIncubation.id DESC')));
        $this->set('iot_research_list',$iot_research_list);
    }







    public function whitePaper()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['WhitePaper']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'whitePaper'));

            }
        }
        if($this->request->data['WhitePaper']['actionType']=="edit"){
            $this->request->data = $this->WhitePaper->read(null,$this->request->data['WhitePaper']['id']);
            $this->request->data['WhitePaper']['date'] = date('d-m-Y', strtotime($this->request->data['WhitePaper']['date']));
            $this -> request -> data['WhitePaper']['published_date']=date('d-m-Y',strtotime(  $this -> request -> data['WhitePaper']['published_date']));

            $this -> request -> data['WhitePaper']['published_status']= $this -> request -> data['published_status'];
        }
        else if($this->request->data['WhitePaper']['actionType']=="delete"){
            $id=$this->request->data['WhitePaper']['id'];

            if($this -> WhitePaper -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'whitePaperList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'whitePaperList'));
            }
        }
        else if($this->request->data['WhitePaper']['type']=="insert" ){
            $this -> request -> data['WhitePaper']['date']=date('Y-m-d',strtotime(  $this -> request -> data['WhitePaper']['date']));
            $this -> request -> data['WhitePaper']['published_date']=date('Y-m-d',strtotime(  $this -> request -> data['WhitePaper']['published_date']));

            $this -> request -> data['WhitePaper']['published_status']= $this -> request -> data['published_status'];

            if($this->request->data['WhitePaper']['id']){
                $message="Paper Updated Successfully";
            }
            else{
                $message="paper  Added Successfully";
            }


            $this->WhitePaper->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'whitePaper'));

        }
        $this->changeCSRFToken();
    }


    public function whitePaperList()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $paper_list = $this->WhitePaper->find('all',array('order'=>array('WhitePaper.id DESC')));
        $this->set('paper_list',$paper_list);
    }

    public function poc()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['Poc']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'poc'));

            }
        }
        if($this->request->data['Poc']['type']=="edit"){
            $this->request->data = $this->Poc->read(null,$this->request->data['Poc']['id']);
        }
        else if($this->request->data['Poc']['type']=="delete"){
            $id=$this->request->data['Poc']['id'];

            if($this -> Poc -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'poc'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'poc'));
            }
        }
        else if($this->request->data['Poc']['type']=="insert" ){

            if($this->request->data['Poc']['id']){
                $message="Poc Updated Successfully";
            }
            else{
                $message="Poc Added Successfully";
            }

            $this->Poc->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'poc'));

        }

        $poc_list = $this->Poc->find('all',array('order'=>array('Poc.id DESC')));
        $this->set('poc_list',$poc_list);

        $this->changeCSRFToken();
    }


    public function societalProject()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        if(!empty($this->request->data)) {
            if ($this->request->data['SocietalProject']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'societalProject'));

            }
        }
        if($this->request->data['SocietalProject']['type']=="edit"){
            $this->request->data = $this->SocietalProject->read(null,$this->request->data['SocietalProject']['id']);
        }
        else if($this->request->data['SocietalProject']['type']=="delete"){
            $id=$this->request->data['SocietalProject']['id'];

            if($this -> SocietalProject -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'societalProject'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'societalProject'));
            }
        }
        else if($this->request->data['SocietalProject']['type']=="insert" ){

            if($this->request->data['SocietalProject']['id']){
                $message="SocietalProject Updated Successfully";
            }
            else{
                $message="SocietalProject Added Successfully";
            }

            $this->SocietalProject->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'societalProject'));

        }

        $societal_project_list = $this->SocietalProject->find('all',array('order'=>array('SocietalProject.id DESC')));
        $this->set('societal_project_list',$societal_project_list);

        $this->changeCSRFToken();
    }
    public function budget($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();

        if(!empty($this->request->data)) {
            if ($this->request->data['Budget']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'budget'));
            }
        }

        if($this->request->data['Budget']['type']=="edit"){
            $this->request->data = $this->Budget->read(null,$this->request->data['Budget']['id']);
        }
        else if($this->request->data['Budget']['type']=="delete"){
            $id=$this->request->data['Budget']['id'];

            if($this -> Budget -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Budget data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'budget'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Budget delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'budget'));
            }
        }
        else if($this->request->data['Budget']['type']=="insert"){
            if($this->request->data['Budget']['id']){
                $message="Budget Updated Successfully";
            }
            else{
                $message="Budget Added Successfully";
            }

            $this->Budget->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'budget'));

        }


        $manage_list = $this->Budget->find('all',array('order'=>array('Budget.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();

    }

    public function target($id=null)
    {
        
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->targetType();

        if(!empty($this->request->data)) {
            if ($this->request->data['Target']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'target'));
            }
        }

        if($this->request->data['Target']['types']=="edit"){
            $this->request->data = $this->Target->read(null,$this->request->data['Target']['id']);
        }
        else if($this->request->data['Target']['types']=="delete"){
            $id=$this->request->data['Target']['id'];

            if($this -> Target -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'target'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'target'));
            }
        }
        else if($this->request->data['Target']['types']=="insert"){
            if($this->request->data['Target']['id']){
                $message="Target Updated Successfully";
            }
            else{
                $message="Target Added Successfully";
            }

            $this->Target->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'target'));

        }

        $manage_list = $this->Target->find('all',array('order'=>array('Target.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }



    /*---------------------------------*/ //New

    public function manageAerospaceDefenseTraining($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();



        if(!empty($this->request->data)) {
            if ($this->request->data['ManageAerospaceDefenseTraining']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageAerospaceDefenseTraining'));
            }
        }

        if($this->request->data['ManageAerospaceDefenseTraining']['type']=="edit"){
            $this->request->data = $this->ManageAerospaceDefenseTraining->read(null,$this->request->data['ManageAerospaceDefenseTraining']['id']);
        }

        else if($this->request->data['ManageAerospaceDefenseTraining']['type']=="delete"){
            $id=$this->request->data['ManageAerospaceDefenseTraining']['id'];

            if($this -> ManageAerospaceDefenseTraining -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageAerospaceDefenseTraining'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'manageAerospaceDefenseTraining'));
            }
        }
        else if($this->request->data['ManageAerospaceDefenseTraining']['type']=="insert"){
            if($this->request->data['ManageAerospaceDefenseTraining']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['ManageAerospaceDefenseTraining']['start_date'] = date('d-m-Y', strtotime($this->request->data['ManageAerospaceDefenseTraining']['start_date']));
            $this->request->data['ManageAerospaceDefenseTraining']['end_date'] = date('d-m-Y', strtotime($this->request->data['ManageAerospaceDefenseTraining']['end_date']));

            $this->ManageAerospaceDefenseTraining->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageAerospaceDefenseTraining'));

        }

        $manage_list = $this->ManageAerospaceDefenseTraining->find('all',array('order'=>array('ManageAerospaceDefenseTraining.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function aerospaceDefenseEmbeddedCourse($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['AerospaceDefenseEmbeddedCourse']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceDefenseEmbeddedCourse'));
            }
        }

        if($this->request->data['AerospaceDefenseEmbeddedCourse']['type']=="edit"){
            $this->request->data = $this->AerospaceDefenseEmbeddedCourse->read(null,$this->request->data['AerospaceDefenseEmbeddedCourse']['id']);
        } else if($this->request->data['AerospaceDefenseEmbeddedCourse']['type']=="delete"){
            $id=$this->request->data['AerospaceDefenseEmbeddedCourse']['id'];

            if($this->AerospaceDefenseEmbeddedCourse->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseEmbeddedCourse'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseEmbeddedCourse'));
            }
        } else if($this->request->data['AerospaceDefenseEmbeddedCourse']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['AerospaceDefenseEmbeddedCourse']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['AerospaceDefenseEmbeddedCourse']['start_date']);
			$this->request->data['AerospaceDefenseEmbeddedCourse']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['AerospaceDefenseEmbeddedCourse']['year']=$monthYear[2];
            //$this->request->data['AerospaceDefenseEmbeddedCourse']['start_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseEmbeddedCourse']['start_date']));
            //$this->request->data['AerospaceDefenseEmbeddedCourse']['end_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseEmbeddedCourse']['end_date']));

            $this->AerospaceDefenseEmbeddedCourse->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceDefenseEmbeddedCourse'));

        }

        $manage_list = $this->AerospaceDefenseEmbeddedCourse->find('all',array('order'=>array('AerospaceDefenseEmbeddedCourse.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function aerospaceDefenseTrainingProcess($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['AerospaceDefenseTrainingProcess']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceDefenseTrainingProcess'));
            }
        }

        if($this->request->data['AerospaceDefenseTrainingProcess']['type']=="edit"){
            $this->request->data = $this->AerospaceDefenseTrainingProcess->read(null,$this->request->data['AerospaceDefenseTrainingProcess']['id']);
        } else if($this->request->data['AerospaceDefenseTrainingProcess']['type']=="delete"){
            $id=$this->request->data['AerospaceDefenseTrainingProcess']['id'];

            if($this->AerospaceDefenseTrainingProcess->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseTrainingProcess'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'AerospaceDefenseTrainingProcess'));
            }
        } else if($this->request->data['AerospaceDefenseTrainingProcess']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['AerospaceDefenseTrainingProcess']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            
            $monthYear=explode('-',$this->request->data['AerospaceDefenseTrainingProcess']['start_date']);
			$this->request->data['AerospaceDefenseTrainingProcess']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['AerospaceDefenseTrainingProcess']['year']=$monthYear[2];
			
            //$this->request->data['AerospaceDefenseTrainingProcess']['start_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseTrainingProcess']['start_date']));
            //$this->request->data['AerospaceDefenseTrainingProcess']['end_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseTrainingProcess']['end_date']));

            $this->AerospaceDefenseTrainingProcess->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceDefenseTrainingProcess'));

        }

        $manage_list = $this->AerospaceDefenseTrainingProcess->find('all',array('order'=>array('AerospaceDefenseTrainingProcess.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function aerospaceDefenseBootcamp($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['AerospaceDefenseBootcamp']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceDefenseBootcamp'));
            }
        }

        if($this->request->data['AerospaceDefenseBootcamp']['type']=="edit"){
            $this->request->data = $this->AerospaceDefenseBootcamp->read(null,$this->request->data['AerospaceDefenseBootcamp']['id']);
        } else if($this->request->data['AerospaceDefenseBootcamp']['type']=="delete"){
            $id=$this->request->data['AerospaceDefenseBootcamp']['id'];

            if($this->AerospaceDefenseBootcamp->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseBootcamp'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'AerospaceDefenseBootcamp'));
            }
        } else if($this->request->data['AerospaceDefenseBootcamp']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['AerospaceDefenseBootcamp']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['AerospaceDefenseBootcamp']['start_date']);
			$this->request->data['AerospaceDefenseBootcamp']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['AerospaceDefenseBootcamp']['year']=$monthYear[2];
            //$this->request->data['AerospaceDefenseBootcamp']['start_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseBootcamp']['start_date']));
            //$this->request->data['AerospaceDefenseBootcamp']['end_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseBootcamp']['end_date']));

            $this->AerospaceDefenseBootcamp->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceDefenseBootcamp'));

        }

        $manage_list = $this->AerospaceDefenseBootcamp->find('all',array('order'=>array('AerospaceDefenseBootcamp.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }


    public function embeddedCourseAttendees($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getEmbeddedCourse();



        if($this->request->data['ManageEmbeddedCourseAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageEmbeddedCourseAttendee"=>array(
                        "aerospace_defense_embedded_course_id"=>$this->request->data['ManageEmbeddedCourseAttendee']['aerospace_defense_embedded_course_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageEmbeddedCourseAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'embeddedCourseAttendees'));
        }
        elseif($this->request->data['ManageEmbeddedCourseAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageEmbeddedCourseAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'embeddedCourseAttendees'));

            }
        }
        $this->changeCSRFToken();
    }
  
    public function trainingProcessAttendees($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getTrainingProcess();


        if($this->request->data['ManageTrainingProcessAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageTrainingProcessAttendee"=>array(
                        "aerospace_defense_training_process_id"=>$this->request->data['ManageTrainingProcessAttendee']['aerospace_defense_training_process_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageTrainingProcessAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'trainingProcessAttendees'));
        }
        elseif($this->request->data['ManageTrainingProcessAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageTrainingProcessAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'trainingProcessAttendees'));
            }
        }
        $this->changeCSRFToken();
    }
   

    public function bootcampAttendees($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getBootcamp();


        if($this->request->data['ManageBootcampAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageBootcampAttendee"=>array(
                        "aerospace_defense_bootcamp_id"=>$this->request->data['ManageBootcampAttendee']['aerospace_defense_bootcamp_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageBootcampAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'bootcampAttendees'));
        }
        elseif($this->request->data['ManageBootcampAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageBootcampAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'bootcampAttendees'));
            }
        }
        $this->changeCSRFToken();
    }
   

    public function aerospaceDefenseSkilling($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['AerospaceDefenseSkilling']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceDefenseSkilling'));
            }
        }

        if($this->request->data['AerospaceDefenseSkilling']['type']=="edit"){
            $this->request->data = $this->AerospaceDefenseSkilling->read(null,$this->request->data['AerospaceDefenseSkilling']['id']);
        } else if($this->request->data['AerospaceDefenseSkilling']['type']=="delete"){
            $id=$this->request->data['AerospaceDefenseSkilling']['id'];

            if($this->AerospaceDefenseSkilling->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseSkilling'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseSkilling'));
            }
        } else if($this->request->data['AerospaceDefenseSkilling']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['AerospaceDefenseSkilling']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['AerospaceDefenseSkilling']['start_date']);
			$this->request->data['AerospaceDefenseSkilling']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['AerospaceDefenseSkilling']['year']=$monthYear[2];
            //$this->request->data['AerospaceDefenseSkilling']['start_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseSkilling']['start_date']));
            //$this->request->data['AerospaceDefenseSkilling']['end_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseSkilling']['end_date']));

            $this->AerospaceDefenseSkilling->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceDefenseSkilling'));

        }

        $manage_list = $this->AerospaceDefenseSkilling->find('all',array('order'=>array('AerospaceDefenseSkilling.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function skillingAttendees($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getSkilling();


        if($this->request->data['ManageSkillingAttendee']['type']=="insert")
        {
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageSkillingAttendee"=>array(
                        "aerospace_defense_skilling_id"=>$this->request->data['ManageSkillingAttendee']['aerospace_defense_skilling_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageSkillingAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'skillingAttendees'));
        }
        elseif($this->request->data['ManageSkillingAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageSkillingAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'skillingAttendees'));
            }
        }
        $this->changeCSRFToken();
    }
   
    public function aerospaceDefenseCourse($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['AerospaceDefenseCourse']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aerospaceDefenseCourse'));
            }
        }

        if($this->request->data['AerospaceDefenseCourse']['type']=="edit"){
            $this->request->data = $this->AerospaceDefenseCourse->read(null,$this->request->data['AerospaceDefenseCourse']['id']);
        } else if($this->request->data['AerospaceDefenseCourse']['type']=="delete"){
            $id=$this->request->data['AerospaceDefenseCourse']['id'];

            if($this->AerospaceDefenseCourse->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseCourse'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'aerospaceDefenseCourse'));
            }
        } else if($this->request->data['AerospaceDefenseCourse']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['AerospaceDefenseCourse']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['AerospaceDefenseCourse']['start_date']);
			$this->request->data['AerospaceDefenseCourse']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['AerospaceDefenseCourse']['year']=$monthYear[2];
            //$this->request->data['AerospaceDefenseCourse']['start_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseCourse']['start_date']));
            //$this->request->data['AerospaceDefenseCourse']['end_date'] = date('d-m-Y', strtotime($this->request->data['AerospaceDefenseCourse']['end_date']));

            $this->AerospaceDefenseCourse->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aerospaceDefenseCourse'));

        }

        $manage_list = $this->AerospaceDefenseCourse->find('all',array('order'=>array('AerospaceDefenseCourse.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function courseAttendees($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getCourse();


        if($this->request->data['ManageCoursesAttendee']['type']=="insert"){
            $attendee_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($attendee_name);$i++)
            {
                $data = array(
                    "ManageCoursesAttendee"=>array(
                        "aerospace_defense_course_id"=>$this->request->data['ManageCoursesAttendee']['aerospace_defense_course_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "year"=>$this->request->data['year'][$i],
                        "month"=>$this->request->data['month'][$i]
                    )
                );
                $this->ManageCoursesAttendee->saveAll($data);
            }
            $message="Attendees Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'courseAttendees'));
        }
        elseif($this->request->data['ManageCoursesAttendee']['csrf_token']!=""){
            if ($this->request->data['ManageCoursesAttendee']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'courseAttendees'));
            }
        }
        $this->changeCSRFToken();
    }
   
    public function manageStartupFacilitation($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['ManageStartupFacilitation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'manageStartupFacilitation'));
            }
        }

        if($this->request->data['ManageStartupFacilitation']['type']=="edit"){
            $this->request->data = $this->ManageStartupFacilitation->read(null,$this->request->data['ManageStartupFacilitation']['id']);
        }
        else if($this->request->data['ManageStartupFacilitation']['type']=="delete"){
            $id=$this->request->data['ManageStartupFacilitation']['id'];

            if($this -> ManageStartupFacilitation -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageStartupFacilitation'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'manageStartupFacilitation'));
            }
        }
        else if($this->request->data['ManageStartupFacilitation']['type']=="insert"){
            if($this->request->data['ManageStartupFacilitation']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
            $this->ManageStartupFacilitation->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'manageStartupFacilitation'));
        }

        $manage_list = $this->ManageStartupFacilitation->find('all',array('order'=>array('ManageStartupFacilitation.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function generatedEmployment($id=null)
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getStartUps();

        if(!empty($this->request->data)) {
            if ($this->request->data['GeneratedEmployment']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'generatedEmployment'));

            }
        }
         if($this->request->data['GeneratedEmployment']['actionType']=="edit"){
            $this->request->data = $this->GeneratedEmployment->read(null,$this->request->data['GeneratedEmployment']['id']);
        }
        //print_r( $this->request->data);
        if($this->request->data['GeneratedEmployment']['actionType']=="delete"){
            $id=$this->request->data['GeneratedEmployment']['id'];

            if($this -> GeneratedEmployment -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'generatedEmploymentList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'generatedEmploymentList'));
            }
        }
        else if($this->request->data['GeneratedEmployment']['type']=="insert" ){


            $message="Employee Added Successfully";
            if($this->request->data['GeneratedEmployment']['id']!=''){
                $message="Employee Updated Successfully";
            }
            //$monthYear=explode('-',$this->request->data['GeneratedEmployment']['month']);
            //$this->request->data['GeneratedEmployment']['month']=$monthYear[0];
            //$this->request->data['GeneratedEmployment']['year']=$monthYear[1];
            
            $monthYear=explode('-',$this->request->data['GeneratedEmployment']['email_id']);
            $this->request->data['GeneratedEmployment']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
            $this->request->data['GeneratedEmployment']['year']=$monthYear[2];
            
            //print_r($this->request->data['GeneratedEmployment']);
            $this->GeneratedEmployment->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'generatedEmploymentList'));

        }

        $this->changeCSRFToken();
    }


    public function generatedEmploymentList()
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->GeneratedEmployment->bindModel(array('belongsTo'=>array("IotStartUp")));
        $employee_list = $this->GeneratedEmployment->find('all',array('order'=>array('GeneratedEmployment.id DESC')));
        $this->set('employee_list',$employee_list);
    }
    public function internshipFoundationCourse($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        Configure::write('debug',0);

        if(!empty($this->request->data)) {
            if ($this->request->data['InternshipFoundationCourse']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'internshipFoundationCourse'));
            }
        }

        if($this->request->data['InternshipFoundationCourse']['type']=="edit"){
            $this->request->data = $this->InternshipFoundationCourse->read(null,$this->request->data['InternshipFoundationCourse']['id']);
        }

        else if($this->request->data['InternshipFoundationCourse']['type']=="delete"){
            $id=$this->request->data['InternshipFoundationCourse']['id'];

            if($this -> InternshipFoundationCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'internshipFoundationCourse'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'internshipFoundationCourse'));
            }
        }
        else if($this->request->data['InternshipFoundationCourse']['type']=="insert"){

            if($this->request->data['InternshipFoundationCourse']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['InternshipFoundationCourse']['start_date'] = date('d-m-Y', strtotime($this->request->data['InternshipFoundationCourse']['start_date']));
            $this->request->data['InternshipFoundationCourse']['end_date'] = date('d-m-Y', strtotime($this->request->data['InternshipFoundationCourse']['end_date']));
            $details = explode('-',$this->request->data['bday-month']);

            if($details[1]==1){ $details[1]="January"; } elseif($details[1]==2){$details[1]="February";}elseif($details[1]==3){$details[1]="March";}elseif($details[1]==4){$details[1]="April";}elseif($details[1]==5){$details[1]="May"; }elseif($details[1]==6){ $details[1]="June"; } elseif($details[1]==7){ $details[1]="July"; }elseif($details[1]==8){ $details[1]="August"; } elseif($details[1]==9){ $details[1]="September";} elseif($details[1]==10){ $details[1]="October";}elseif($details[1]==11){
                $details[1]="November";}elseif($details[1]==12){$details[1]="December";}

            $monthYear=explode('-',$this->request->data['InternshipFoundationCourse']['start_date']);
			$this->request->data['InternshipFoundationCourse']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['InternshipFoundationCourse']['year']=$monthYear[2];

            $this->InternshipFoundationCourse->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'internshipFoundationCourse'));

        }

        $manage_list = $this->InternshipFoundationCourse->find('all',array('order'=>array('InternshipFoundationCourse.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }

    public function manageInternshipFoundationCourseList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        Configure::write('debug',0);

        if($this->request->data['InternshipFoundationCourse']['type']=="delete"){
            $id=$this->request->data['InternshipFoundationCourse']['id'];

            if($this -> InternshipFoundationCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageInternshipFoundationCourseList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageInternshipFoundationCourseList'));
            }
        }
        else{
            $manage_list = $this->InternshipFoundationCourse->find('all',array('order'=>array('InternshipFoundationCourse.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }


    public function advanceProjectBasedCourse($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        Configure::write('debug',0);


        if(!empty($this->request->data)) {
            if ($this->request->data['AdvanceProjectBasedCourse']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'advanceProjectBasedCourse'));
            }
        }

        if($this->request->data['AdvanceProjectBasedCourse']['type']=="edit"){
            $this->request->data = $this->AdvanceProjectBasedCourse->read(null,$this->request->data['AdvanceProjectBasedCourse']['id']);
        }

        else if($this->request->data['AdvanceProjectBasedCourse']['type']=="delete"){
            $id=$this->request->data['AdvanceProjectBasedCourse']['id'];

            if($this -> AdvanceProjectBasedCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'advanceProjectBasedCourse'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'advanceProjectBasedCourse'));
            }
        }
        else if($this->request->data['AdvanceProjectBasedCourse']['type']=="insert"){
            if($this->request->data['AdvanceProjectBasedCourse']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['AdvanceProjectBasedCourse']['start_date'] = date('d-m-Y', strtotime($this->request->data['AdvanceProjectBasedCourse']['start_date']));
            $this->request->data['AdvanceProjectBasedCourse']['end_date'] = date('d-m-Y', strtotime($this->request->data['AdvanceProjectBasedCourse']['end_date']));

            $details = explode('-',$this->request->data['bday-month']);

            if($details[1]==1){ $details[1]="January"; } elseif($details[1]==2){$details[1]="February";}elseif($details[1]==3){$details[1]="March";}elseif($details[1]==4){$details[1]="April";}elseif($details[1]==5){$details[1]="May"; }elseif($details[1]==6){ $details[1]="June"; } elseif($details[1]==7){ $details[1]="July"; }elseif($details[1]==8){ $details[1]="August"; } elseif($details[1]==9){ $details[1]="September";} elseif($details[1]==10){ $details[1]="October";}elseif($details[1]==11){
                $details[1]="November";}elseif($details[1]==12){$details[1]="December";}

            $this->request->data['AdvanceProjectBasedCourse']['month']=$details[1];
            $this->request->data['AdvanceProjectBasedCourse']['year']=$details[0];

            $this->AdvanceProjectBasedCourse->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'advanceProjectBasedCourse'));

        }

        $manage_list = $this->AdvanceProjectBasedCourse->find('all',array('order'=>array('AdvanceProjectBasedCourse.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }

    public function manageAdvanceProjectBasedCourseList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        Configure::write('debug',0);

        if($this->request->data['AdvanceProjectBasedCourse']['type']=="delete"){
            $id=$this->request->data['AdvanceProjectBasedCourse']['id'];

            if($this -> AdvanceProjectBasedCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageAdvanceProjectBasedCourseList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageAdvanceProjectBasedCourseList'));
            }
        }
        else{
            $manage_list = $this->AdvanceProjectBasedCourse->find('all',array('order'=>array('AdvanceProjectBasedCourse.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }

    public function orientationAwarenessCourse($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        Configure::write('debug',0);


        if(!empty($this->request->data)) {
            if ($this->request->data['OrientationAwarenessCourse']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'orientationAwarenessCourse'));
            }
        }

        if($this->request->data['OrientationAwarenessCourse']['type']=="edit"){
            $this->request->data = $this->OrientationAwarenessCourse->read(null,$this->request->data['OrientationAwarenessCourse']['id']);
        }

        else if($this->request->data['OrientationAwarenessCourse']['type']=="delete"){
            $id=$this->request->data['OrientationAwarenessCourse']['id'];

            if($this -> OrientationAwarenessCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'orientationAwarenessCourse'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'orientationAwarenessCourse'));
            }
        }
        else if($this->request->data['OrientationAwarenessCourse']['type']=="insert"){
            if($this->request->data['OrientationAwarenessCourse']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['OrientationAwarenessCourse']['start_date'] = date('d-m-Y', strtotime($this->request->data['OrientationAwarenessCourse']['start_date']));
            $this->request->data['OrientationAwarenessCourse']['end_date'] = date('d-m-Y', strtotime($this->request->data['OrientationAwarenessCourse']['end_date']));

            $details = explode('-',$this->request->data['bday-month']);

            if($details[1]==1){ $details[1]="January"; } elseif($details[1]==2){$details[1]="February";}elseif($details[1]==3){$details[1]="March";}elseif($details[1]==4){$details[1]="April";}elseif($details[1]==5){$details[1]="May"; }elseif($details[1]==6){ $details[1]="June"; } elseif($details[1]==7){ $details[1]="July"; }elseif($details[1]==8){ $details[1]="August"; } elseif($details[1]==9){ $details[1]="September";} elseif($details[1]==10){ $details[1]="October";}elseif($details[1]==11){
                $details[1]="November";}elseif($details[1]==12){$details[1]="December";}

            $this->request->data['OrientationAwarenessCourse']['month']=$details[1];
            $this->request->data['OrientationAwarenessCourse']['year']=$details[0];

            $this->OrientationAwarenessCourse->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'orientationAwarenessCourse'));

        }

        $manage_list = $this->OrientationAwarenessCourse->find('all',array('order'=>array('OrientationAwarenessCourse.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }

    public function manageOrientationAwarenessCourseList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        Configure::write('debug',0);

        if($this->request->data['OrientationAwarenessCourse']['type']=="delete"){
            $id=$this->request->data['OrientationAwarenessCourse']['id'];

            if($this -> OrientationAwarenessCourse -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'manageOrientationAwarenessCourseList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'manageOrientationAwarenessCourseList'));
            }
        }
        else{
            $manage_list = $this->OrientationAwarenessCourse->find('all',array('order'=>array('OrientationAwarenessCourse.id DESC')));
            $this->set('manage_list',$manage_list);
        }
    }
    

    
        // New Finance and Expendature ......................................... varun 
public function financial($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $action=explode("/",$this->request->url)[1];
        $this->loadModel('FinancialYear');
        $this->_getFundingYear();
        $this->set("action",$action);
        $types="";
       // print_r( $action);
        if($action=="dsAiFund"){
            $this->set("title","Ds And  Ai Fund Details");
            $types="Data Science and AI";
        }
        else if($action=="aerospaceFund"){
            $this->set("title","Aerospace & Defence Fund Details");
            $types="Aerospace & Defense";
        }
        else if($action=="cyberSecurityFund"){
            $this->set("title","Cyber Security Fund Details");
            $types="Cyber Security";
        }
        else if($action=="iotFund"){
            $this->set("title","IOT Fund Details");
            $types="IOT";
        }
        else if($action=="roboticsFund"){
            $this->set("title","MI & Robotics Fund Details");
            $types="MI & Robotics";
        }
        else if($action=="animationFund"){
            $this->set("title","Animation Fund Details");
            $types="Animation";
        }
        else if($action=="ktechCenterFund"){
            $this->set("title","KTECH Centre Fund Details");
            $types="KTECH Centre";
        }
        else if($action=="fablessFund"){
            $this->set("title","Fabless Fund Details");
            $types="Fabless";
        }




        if(!empty($this->request->data)) {

            if ($this->request->data['Financial']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['Financial']['type']=="edit"){
            $this->request->data = $this->Financial->read(null,$this->request->data['Financial']['id']);
        }

        else if($this->request->data['Financial']['type']=="delete"){
            $id=$this->request->data['Financial']['id'];

            if($this -> Financial -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['Financial']['type']=="insert"){

            if($this->request->data['Financial']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
			
			/*Upload UC*/
            $tmp_doc_name=$this->request->data['Financial']['upload_uc']['tmp_name'];
            $doc_name=$this->request->data['Financial']['upload_uc']['name'];
            $doc_name_old=$this->request->data['Financial']['upload_uc_old'];
            $doc_type=$this->request->data['Financial']['upload_uc']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='') {
                if(in_array($pdf_doc_ext,$allowed_doc_types)) {
                    if($doc_name_old != ''){
                        unlink(WWW_ROOT."upload_uc/".$doc_name_old);
                    }
                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."upload_uc/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'financial'));
                }
            }else{
                $doc_name = $doc_name_old;
            }
            /*Upload UC*/
			
			/*Upload Bank Statement*/
            $tmp_doc_name=$this->request->data['Financial']['upload_bs']['tmp_name'];
            $doc_name_bs=$this->request->data['Financial']['upload_bs']['name'];
            $doc_name_bs_old=$this->request->data['Financial']['upload_bs_old'];
            $doc_type=$this->request->data['Financial']['upload_bs']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name_bs, strripos($doc_name_bs, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name_bs!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {
                    if($doc_name_bs_old != ''){
                        unlink(WWW_ROOT."upload_bs/".$doc_name_bs_old);
                    }

                    $new_doc_name =  $doc_name_bs;
                    $target_doc = WWW_ROOT."upload_bs/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'financial'));
                }
            }else{
                $doc_name_bs = $doc_name_bs_old;
            }
            /*Upload Bank Statement*/
			
			//NEW 24 - 10 - 20
			$this->request->data['Financial']['upload_uc']=$doc_name;
			$this->request->data['Financial']['upload_bs']=$doc_name_bs;
			//NEW 24 - 10 - 20
			
			$this->request->data['Financial']['types']=$types;
			$result= $this->Financial->hasAny(array("types"=>$types,"expenses_type"=>$this->request->data['Financial']['expenses_type'],"id !="=>$this->request->data['Financial']['id'],"financial_year_id"=>$this->request->data['Financial']['financial_year_id']));
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Fund for this Finantial Year Exist</div>");
                $this -> redirect(array('action' =>$action));
            }

            $this->Financial->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action));

        }
        $this->Financial->bindModel(array("belongsTo"=>array("FinancialYear")));
		$manage_list = $this->Financial->find('all',array('conditions' => array('Financial.types' =>$types),"order"=>array('Financial.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
	
	public function expenditureList($id=null){
        $this->layout = 'fab_layout';

        $this->_userSessionCheckout();
        $action=explode("/",$this->request->url)[1];

        $types="";
        // print_r( $action);
        if($action=="dsAiExpenseList"){
            $this->set("title","Ds And  Ai Expense Details");
            $types="Data Science and AI";
            $this->set("action","dsAiExpense");
        }
        else if($action=="aerospaceExpenseList"){
            $this->set("title","Aerospace & Defence Expense Details");
            $types="Aerospace & Defense";
            $this->set("action","aerospaceExpense");
        }
        else if($action=="cyberSecurityExpenseList"){
            $this->set("title","Cyber Security Expense Details");
            $types="Cyber Security";
            $this->set("action","cyberSecurityExpense");
        }
        else if($action=="iotExpenseList"){
            $this->set("title","IOT Expense Details");
            $types="IOT";
            $this->set("action","iotExpense");
        }
        else if($action=="roboticsExpenseList"){
            $this->set("title","MI & Robotics Expense Details");
            $types="MI & Robotics";
            $this->set("action","roboticsExpense");
        }
        else if($action=="animationExpenseList"){
            $this->set("title","Animation Expense Details");
            $types="Animation";
            $this->set("action","animationExpense");
        }
        else if($action=="ktechCenterExpenseList"){
            $this->set("title","KTECH Centre Expense Details");
            $types="KTECH Centre";
            $this->set("action","ktechCenterExpense");
        }
        else if($action=="fablessExpenseList"){
            $this->set("title","Fabless Expense Details");
            $types="Fabless";
            $this->set("action","fablessExpense");
        }
        $this->Expenditure->bindModel(array("belongsTo"=>array("FinancialYear")));
		$manage_list = $this->Expenditure->find('all',array('conditions' => array('Expenditure.types' =>$types),"order"=>array('Expenditure.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }

    public function expenditure1($id=null){
        $this->layout = 'fab_layout';

        $this->_userSessionCheckout();
        $this->loadModel('FinancialYear');
        $this->_getFundingYear();


        $action=explode("/",$this->request->url)[1];
        $this->set("action",$action);
        $types="";
        // print_r( $action);
        if($action=="dsAiExpense"){
            $this->set("title","Ds And  Ai Expense Details");
            $types="Data Science and AI";
        }
        else if($action=="aerospaceExpense"){
            $this->set("title","Aerospace & Defence Expense Details");
            $types="Aerospace & Defense";
        }
        else if($action=="cyberSecurityExpense"){
            $this->set("title","Cyber Security Expense Details");
            $types="Cyber Security";
        }
        else if($action=="iotExpense"){
            $this->set("title","IOT Expense Details");
            $types="IOT";
        }
        else if($action=="roboticsExpense"){
            $this->set("title","MI & Robotics Expense Details");
            $types="MI & Robotics";
        }
        else if($action=="animationExpense"){
            $this->set("title","Animation Expense Details");
            $types="Animation";
        }
        else if($action=="ktechCenterExpense"){
            $this->set("title","KTECH Centre Expense Details");
            $types="KTECH Centre";
        }
        else if($action=="fablessExpense"){
            $this->set("title","Fabless Expense Details");
            $types="Fabless";
        }

        if(!empty($this->request->data)) {
            $data = new \Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('ISO-8859-1');
            $file=$this->request->data['Exel']["file"];
            //print_r($this->request->data);


            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
            if($file["size"] >0 && $ext=='xls' && $file['name']=='expense.xls')
            {
                $data->read($this->request->data['Exel']["file"]['tmp_name']);
                $sheet = $data->sheets[0];
                $rows = $sheet['numRows'];
                $cols = $sheet['numCols'];


                $details=array();

                for ($i = 2; $i <= $rows; $i++) {
                    $getData = array();

                    for ($j = 0; $j <= $cols; $j++) {
                        if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j+1])) {
                            $getData[$j] = $sheet['cells'][$i][$j+1];
                        }

                    }

                    if(!empty($getData[0])) {


                        $emp_data[] = array('Expenditure'=>
                            array(

                                'financial_year_id'=>$this->request->data['Exel']["finance_year_id"],
                                'types'=>$types,
                                'amount_spent'=>        ($getData[0]!='')?$getData[0]:'',
                                'expense_type'=>    ($getData[1]!='')?$getData[1]:'',
                                'date'=>             ($getData[2]!='')?date('Y-m-d',strtotime($getData[2])):'',
                                'details'=>  ($getData[3]!='')?$getData[3]:'',
                                'remarks'=>           ($getData[4]!='')?$getData[4]:'',
                                'phase'=>  ($getData[5]!='')?$getData[5]:'',


                            ));
                        $details[] = $getData;
                    }
                }
                if(sizeof($emp_data)>0)$this->Expenditure->saveAll($emp_data);
                //print_r($emp_data);
               

                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Expense Uploaded Successfully.</div>");
                $this -> redirect(array('action' =>$action."List"));
            }

            fclose($file);


            if ($this->request->data['Expenditure']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
               // print_r($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['Expenditure']['type']=="edit"){
            $this->request->data = $this->Expenditure->read(null,$this->request->data['Expenditure']['id']);
        }

        else if($this->request->data['Expenditure']['type']=="delete"){

            $id=$this->request->data['Expenditure']['id'];

            if($this -> Expenditure -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action."List"));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['Expenditure']['type']=="insert"){
            $tmp_doc_name=$this->request->data['Expenditure']['document']['tmp_name'];
            $doc_name=$this->request->data['Expenditure']['document']['name'];
            $doc_type=$this->request->data['Expenditure']['document']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {
                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."Expenditure_Documents/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' =>$action));
                }
            }
            /*Documents Upload*/

            $this->request->data['Expenditure']['document'] = $new_doc_name;


            if($this->request->data['Expenditure']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['Expenditure']['types']=$types;
              $this->request->data['Expenditure']['date']=date('Y-m-d',strtotime($this->request->data['Expenditure']['date']));
            $this->Expenditure->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action."List"));

        }
        $this->changeCSRFToken();
    }
     public function expenditure($id=null){
        $this->layout = 'fab_layout';

        $this->_userSessionCheckout();
        $this->loadModel('FinancialYear');
        $this->_getFundingYear();


        $action=explode("/",$this->request->url)[1];
        $this->set("action",$action);
        $types="";
        // print_r( $action);
        if($action=="dsAiExpense"){
            $this->set("title","Ds And  Ai Expense Details");
            $types="Data Science and AI";
        }
        else if($action=="aerospaceExpense"){
            $this->set("title","Aerospace & Defence Expense Details");
            $types="Aerospace & Defense";
        }
        else if($action=="cyberSecurityExpense"){
            $this->set("title","Cyber Security Expense Details");
            $types="Cyber Security";
        }
        else if($action=="iotExpense"){
            $this->set("title","IOT Expense Details");
            $types="IOT";
        }
        else if($action=="roboticsExpense"){
            $this->set("title","MI & Robotics Expense Details");
            $types="MI & Robotics";
        }
        else if($action=="animationExpense"){
            $this->set("title","Animation Expense Details");
            $types="Animation";
        }
        else if($action=="ktechCenterExpense"){
            $this->set("title","KTECH Centre Expense Details");
            $types="KTECH Centre";
        }
        else if($action=="fablessExpense"){
            $this->set("title","Fabless Expense Details");
            $types="Fabless";
        }

        if(!empty($this->request->data)) {
            $data = new \Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('ISO-8859-1');
            $file=$this->request->data['Exel']["file"];



            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
            if($file["size"] >0 && $ext=='xls' && $file['name']=='expense.xls')
            {
               
                $data->read($this->request->data['Exel']["file"]['tmp_name']);
                $sheet = $data->sheets[0];
                $rows = $sheet['numRows'];
                $cols = $sheet['numCols'];


                $details=array();

                for ($i = 2; $i <= $rows; $i++) {
                    $getData = array();

                    for ($j = 0; $j <= $cols; $j++) {
                        if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j+1])) {
                            $getData[$j] = $sheet['cells'][$i][$j+1];
                        }

                    }
                    if(!empty($getData[0])) {
                        $emp_data[] = array('Expenditure'=>
                            array(

                                'financial_year_id'=>$this->request->data['Exel']["finance_year_id"],
                                'types'=>$types,
                                'amount_spent'=>        ($getData[0]!='')?$getData[0]:'',
                                'expense_type'=>    ($getData[1]!='')?$getData[1]:'',
                                'date'=>             ($getData[2]!='')?date('Y-m-d',strtotime($getData[2])):'',
                                'end_date'=>             ($getData[3]!='')?date('Y-m-d',strtotime($getData[3])):'',
                                'details'=>  ($getData[4]!='')?$getData[4]:'',
                                'remarks'=>           ($getData[5]!='')?$getData[5]:'',
                                 'phase'=>           ($getData[6]!='')?$getData[6]:'',


                            ));
                        $details[] = $getData;
                    }
                }
                if(sizeof($emp_data)>0)$this->Expenditure->saveAll($emp_data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Expense Uploaded Successfully.</div>");
               
                $this -> redirect(array('action' =>$action."List"));
            }

            fclose($file);


            if ($this->request->data['Expenditure']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
               // print_r($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['Expenditure']['type']=="edit"){
            $this->request->data = $this->Expenditure->read(null,$this->request->data['Expenditure']['id']);
            $this->request->data['Expenditure']['date']=date('d-m-Y',strtotime($this->request->data['Expenditure']['date']));
            $this->request->data['Expenditure']['end_date']=date('d-m-Y',strtotime($this->request->data['Expenditure']['end_date']));

        }

        else if($this->request->data['Expenditure']['type']=="delete"){

            $id=$this->request->data['Expenditure']['id'];

            if($this -> Expenditure -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action."List"));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['Expenditure']['type']=="insert"){
            $tmp_doc_name=$this->request->data['Expenditure']['document_new']['tmp_name'];
            $doc_name=$this->request->data['Expenditure']['document_new']['name'];
            $doc_type=$this->request->data['Expenditure']['document_new']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {
                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."Expenditure_Documents/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' =>$action));
                }
                $this->request->data['Expenditure']['document'] = $new_doc_name;
            }
            /*Documents Upload*/




            if($this->request->data['Expenditure']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['Expenditure']['types']=$types;
              $this->request->data['Expenditure']['date']=date('Y-m-d',strtotime($this->request->data['Expenditure']['date']));
             $this->request->data['Expenditure']['end_date']=date('Y-m-d',strtotime($this->request->data['Expenditure']['end_date']));
            $this->Expenditure->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action."List"));

        }
        $this->changeCSRFToken();
    }
    
    
    

	public function problemStatement($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        configure::write('debug',0);
		
		if(!empty($this->request->data)) {
			
			if($this->request->data['ManageProblemStatement']['type']=="insert"){
				$details = $this->request->data['details'];
				
				$conditions = array("conditions"=>array("ManageProblemStatement.details"=>$details));
				$check = $this->ManageProblemStatement->find("first",$conditions);
				if($check)
				{
					$message="Data Already Available";
					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
					$this -> redirect(array('action' => 'problemStatement'));
				}
				else
				{
					for($i=0;$i<count($details);$i++)
					{
						$data = array(
							"ManageProblemStatement"=>array(
                                "phase"=>$this->request->data['ManageProblemStatement']['phase'][$i],
								"details"=>$this->request->data['details'][$i],
								"types"=>$this->request->data['ManageProblemStatement']['types'][$i],
								"month"=>date('F'),
								"year"=>date('Y')
							)
						);
						$this->ManageProblemStatement->saveAll($data);
					}
					$message=" Problem Statement Added Successfully";

					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
					$this -> redirect(array('action' => 'problemStatement'));
				}
			}

			elseif($this->request->data['ManageProblemStatement']['csrf_token']!=""){
				if ($this->request->data['ManageProblemStatement']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
					$this -> redirect(array('action' => 'problemStatement'));
				}
			}
		}
        $this->changeCSRFToken();
    }
	
	public function problemStatementList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        configure::write('debug',0);
		
		if(!empty($this->request->data)) {
			if($this->request->data['ManageProblemStatement']['type']=="delete"){
                $id=$this->request->data['ManageProblemStatement']['id'];

                if($this -> ManageProblemStatement -> delete($id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'problemStatementList'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'problemStatementList'));
                }
            }
			elseif($this->request->data['ManageProblemStatement']['csrf_token']!=""){
				if ($this->request->data['ManageProblemStatement']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
					$this -> redirect(array('action' => 'problemStatementList'));
				}
			}
		}
        $table_list = $this->ManageProblemStatement->find('all',array('conditions' => array('ManageProblemStatement.is_delete' =>0),"order"=>array('ManageProblemStatement.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }
	
	public function updateProblemStatement($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		configure::write('debug',0);
        
		if(!empty($this->request->data))
        {
			if($this->request->data['ManageProblemStatementDetail']['type']=="insert")
			{
				array_pop($this->request->data);
				
				foreach($this->request->data as $key=>$value)
				{
					for($i=0;$i<sizeof($value);$i++)
					{
						$data = array(
								"ManageProblemStatementDetail"=>array(
									"manage_problem_statement_id"=>$key,
									"problem_statements"=>$value[$i],
									"is_delete"=>0,
								)
								);
						$this->ManageProblemStatementDetail->saveAll($data);
					}
				}
				$message="Added Successfully";
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
				$this -> redirect(array('action' => 'updateProblemStatement'));
			}
        }
		else{
			$conditions = array("conditions"=>array("ManageProblemStatement.is_delete"=>0), "fields" => array("ManageProblemStatement.id","ManageProblemStatement.details"), "order" =>"ManageProblemStatement.id DESC");
            $list = $this->ManageProblemStatement->find("all",$conditions);
            $this->set("list",$list);
		}
		$this->changeCSRFToken();
    }
	
    
	
	public function updatedProblemStatementList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		configure::write('debug',0);
		
		if(!empty($this->request->data))
        {
			if($this->request->data['ManageProblemStatementDetail']['type']=="delete"){
				$id=$this->request->data['ManageProblemStatementDetail']['id'];

				if($this->ManageProblemStatementDetail->delete($id)){
					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

					$this -> redirect(array('action' => 'updatedProblemStatementList'));
				}
				else{
					$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

					$this -> redirect(array('action' => 'updatedProblemStatementList'));
				}
			}
		} 
		elseif($this->request->data['ManageProblemStatement']['csrf_token']!=""){
			if ($this->request->data['ManageProblemStatement']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this -> redirect(array('action' => 'updatedProblemStatementList'));
			}
		}
		else
		{
			$params = array(
                'joins' => array(
                    array(
                        'table' => 'manage_problem_statements',
                        'alias' => 'ManageProblemStatement',
                        'type' => 'INNER',
                        'conditions' => array(
                            'ManageProblemStatement.id = ManageProblemStatementDetail.manage_problem_statement_id'
                        )
                    ),
                ),
				'conditions' => array("ManageProblemStatementDetail.is_delete"=>0),
				'order' => array('ManageProblemStatementDetail.id DESC'),
				'fields' => array('ManageProblemStatement.details','ManageProblemStatementDetail.problem_statements','ManageProblemStatementDetail.id'),
            );
			
			$manage_list = $this->ManageProblemStatementDetail->find('all',$params);
			$this->set('manage_list',$manage_list);
		}	
			$this->changeCSRFToken();
		
	}
	
	
	public function graduateSchoolList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		configure::write('debug',0);
		date_default_timezone_set('Asia/Kolkata'); 
		
        if(!empty($this->request->data)) {

            if ($this->request->data['GraduateSchool']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'graduateSchoolList'));
            }
        }

        if($this->request->data['GraduateSchool']['type']=="edit"){
            $this->request->data = $this->GraduateSchool->read(null,$this->request->data['GraduateSchool']['id']);
			$this->request->data['GraduateSchool']['date_of_graduation'] = date('d-m-Y',strtotime($this->request->data['GraduateSchool']['date_of_graduation']));
        }

        else if($this->request->data['GraduateSchool']['type']=="delete"){
            $id=$this->request->data['GraduateSchool']['id'];

            if($this -> GraduateSchool -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'graduateSchoolList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'graduateSchoolList'));
            }
        }
        else if($this->request->data['GraduateSchool']['type']=="insert"){

            if($this->request->data['GraduateSchool']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->GraduateSchool->hasAny(array("id !="=>$this->request->data['GraduateSchool']['id'],"graduation_name ="=>$this->request->data['GraduateSchool']['graduation_name']));
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' => 'graduateSchoolList'));
            }


            $monthYear=explode('-',$this->request->data['GraduateSchool']['date_of_graduation']);
			$this->request->data['GraduateSchool']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['GraduateSchool']['year']=$monthYear[2];
			$this->request->data['GraduateSchool']['date_of_graduation'] = date('Y-m-d',strtotime($this->request->data['GraduateSchool']['date_of_graduation']));

			//print_r($this->request->data);exit();
            $this->GraduateSchool->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'graduateSchoolList'));

        }
		$manage_list = $this->GraduateSchool->find('all',array("order"=>array('GraduateSchool.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
	}
	 public function graduateSchoolImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('GraduateSchool');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['GraduateSchool']["file"];



        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='graduateSchoolList.xls')
        {
            $data->read($this->request->data['GraduateSchool']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];

            $details=array();

            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();
                

                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j+1])) {
                        $getData[$j] = $sheet['cells'][$i][$j+1];
                    }

                }

                if(!empty($getData[0])) {


					$monthYear = explode('/',$getData[2]);
					//print_r($monthYear); exit();
					$month = date('F',mktime(0, 0, 0, $monthYear[0], 10));
					$year = $monthYear[2];
					//print_r($year); exit();
					$getData[2] = date('Y-m-d', strtotime($getData[2]));
                    $emp_data[] = array('GraduateSchool'=>
                        array(
                            'graduation_name'=>        ($getData[0]!='')?$getData[0]:'',
                            'batch_no'=>    ($getData[1]!='')?$getData[1]:'',
                            'date_of_graduation'=>          ($getData[2]!='')?$getData[2]:'',
                            'name_of_the_graduate'=>  ($getData[3]!='')?$getData[3]:'',
                            'mobile_no'=>           ($getData[4]!='')?$getData[4]:'',
                            'email'=>           ($getData[5]!='')?$getData[5]:'',
                            'city'=>           ($getData[6]!='')?$getData[6]:'',
                            'phase'=>			($getData[7]!='')?$getData[7]:'',
							'month'=>			($month!='')?$month:'',
							'year'=>			($year!='')?$year:''
                        ));
                    $details[] = $getData;
                }
            }

            $this->GraduateSchool->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }

        $this -> redirect(array('action' => 'graduateSchoolList'));
    }
	public function changeApplication() {
      
        $this->Session->write('ApplicationType', $this->request['data']['type']);
        exit();
    }
    public function setPhase() {

        $this->Session->write('Phase', $this->request['data']['phase']);
        exit();
    }
    
public function revenueGenerated($linktype=null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('RevenueGenerated');

        if ($linktype == 'DS&AI') {
            $details['HomeTitle'] = 'DS&AI RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'CCamp') {
            $details['HomeTitle'] = 'C-Camp RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'MINRO') {
            $details['HomeTitle'] = 'MINRO RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'A&D') {
            $details['HomeTitle'] = 'A&D RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'AVGC') {
            $details['HomeTitle'] = 'AVGC RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'IOT') {
            $details['HomeTitle'] = 'IOT RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'SFAL') {
            $details['HomeTitle'] = 'SFAL RevenueGenerated';
			$details['Controller'] = $linktype;
		} else if ($linktype == 'CS') {
            $details['HomeTitle'] = 'CS RevenueGenerated';
			$details['Controller'] = $linktype;
		}

    
        if(!empty($this->request->data)) {
            if ($this->request->data['RevenueGenerated']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('controller' => $details['Controller'], 'action' => 'revenueGenerated'));
            }
            if($this->request->data['RevenueGenerated']['type']=="edit"){
                $this->request->data = $this->RevenueGenerated->read(null,$this->request->data['RevenueGenerated']['id']);
            }
            else if($this->request->data['RevenueGenerated']['type']=="delete"){
                $hackathon_id=$this->request->data['RevenueGenerated']['id'];

                if($this -> RevenueGenerated -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('controller' => $details['Controller'],'action' => 'revenueGenerated'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('controller' => $details['Controller'],'action' => 'revenueGenerated'));
                }
            }
            else if($this->request->data['RevenueGenerated']['type']=="insert" ){
                if($this->request->data['RevenueGenerated']['id']){
                    $message=" Master Classes Updated Successfully";
                }
                else{
                    $message=" Master Classes Added Successfully";
                }
				$this->RevenueGenerated->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('controller' => $details['Controller'],'action' => 'revenueGenerated'));
            }
        }
        $table_list = $this->RevenueGenerated->find('all',array('conditions'=>array('belongs_to'=>$details['Controller']),'order'=>array('RevenueGenerated.id DESC')));
        $this->set('table_list',$table_list);
        $this->set('details',$details);
        $this->changeCSRFToken();
    }
}
