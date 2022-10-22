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
//App::uses('PHPMailer', 'Vendor\PHPMailer\PHPMailer');
include('excel_reader2.php');
/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class MachineIntelligenceController extends AppController {


	public $uses = array("MiOfficials","MiStudentEnrollment","MiPatent","MiPrograms","MiProgramParticipants","MiProgramStudents","MiInternationalConferences","MiIcParticipants",
    "MiStartupConferences","MiStartupParticipants","MiOpenExperienceCentre","MiMentorship");
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');


    public function govtOfficialTraining($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){


            if($this -> MiOfficials -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'govtOfficialTraining'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'govtOfficialTraining'));
            }
        }

        $dataList = $this->MiOfficials->find('all',array('order'=>array('MiOfficials.id DESC')));
        $this->set('dataList',$dataList);

        $this->changeCSRFToken();
    }
    public function govtOfficialTrainingAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->department();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['MiOfficials']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'govtOfficialTrainingAdd'));

            }

            if($this->request->data['MiOfficials']['id']){
                $message="Officials Updated Successfully";
            }
            else{
                $message="Officials Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['MiOfficials']['date']);
			$this->request->data['MiOfficials']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiOfficials']['year']=$monthYear[2];
			
            $this->MiOfficials->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'govtOfficialTraining'));
        }
        if($id){
            $this->request->data = $this->MiOfficials->read(null,$id);

        }


        $this->changeCSRFToken();
    }

    public function studentEnrollment($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){


            if($this -> MiStudentEnrollment -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'studentEnrollment'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'studentEnrollment'));
            }
        }

        $dataList = $this->MiStudentEnrollment->find('all',array('order'=>array('MiStudentEnrollment.id DESC')));
        $this->set('dataList',$dataList);

        $this->changeCSRFToken();
    }
    public function studentEnrollmentAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->department();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['MiStudentEnrollment']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'studentEnrollment'));

            }

            if($this->request->data['MiStudentEnrollment']['id']){
                $message="Students Updated Successfully";
            }
            else{
                $message="Students Added Successfully";
            }
            $this->MiStudentEnrollment->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'studentEnrollment'));
        }
        if($id){
            $this->request->data = $this->MiStudentEnrollment->read(null,$id);

        }


        $this->changeCSRFToken();
    }


	public function patents($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){


            if($this ->MiPatent->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'patents'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'patents'));
            }
        }

        $dataList = $this->MiPatent->find('all',array('order'=>array('MiPatent.id DESC')));
        $this->set('dataList',$dataList);

        $this->changeCSRFToken();
    }
    public function patentsAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->department();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['MiPatent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'patentsAdd'));

            }

            if($this->request->data['MiPatent']['id']){
                $message="Students Updated Successfully";
            }
            else{
                $message="Students Added Successfully";
            }
            $this->MiPatent->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'patents'));
        }
        if($id){
            $this->request->data = $this->MiPatent->read(null,$id);

        }


        $this->changeCSRFToken();
    }
    
     public function programs($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){


            if($this -> MiPrograms -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'programs'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'programs'));
            }
        }

        $dataList = $this->MiPrograms->find('all',array('order'=>array('MiPrograms.id DESC')));
        $this->set('program_list',$dataList);
        //print_r($dataList);
        $this->changeCSRFToken();
    }
    public function programsAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $programType = array('Online'=>'Online','Conducted'=>'Conducted');
        $this->set('programType',$programType);

        if(!empty($this->request->data)) {
            if ($this->request->data['MiPrograms']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'programsAdd'));

            }
            if($this->request->data['MiPrograms']['id']){
                $message="Programs Updated Successfully";
            }
            else{
                $message="Programs Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['MiPrograms']['program_date']);
			$this->request->data['MiPrograms']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiPrograms']['year']=$monthYear[2];
			
			
            $this -> request -> data['MiPrograms']['program_date']=date('Y-m-d',strtotime(  $this -> request -> data['MiPrograms']['program_date']));
            $this->MiPrograms->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'programs'));
        }
        if($id){
            $data = $this->MiPrograms->read(null,$id);
            $data['MiPrograms']['program_date'] = ($data['MiPrograms']['program_date'] != '0000-00-00') ? date('d-m-Y',strtotime($data['MiPrograms']['program_date'])) : '';
            $this->request->data = $data;
        }


        $this->changeCSRFToken();
    }


    public function programParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getMiProgram();

        if($this->request->data['MiProgramParticipants']['type']=="insert")
        {
            //print_r($this->request->data['MiProgramParticipants']);
           // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "MiProgramParticipants"=>array(
                        "mi_programs_id"=>$this->request->data['MiProgramParticipants']['mi_programs_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "qualification"=>$this->request->data['qualification'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "city"=>$this->request->data['city'][$i],

                    )
                );
                $this->MiProgramParticipants->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'programParticipantsList'));
        }


        elseif($this->request->data['MiProgramParticipants']['csrf_token']!=""){
            if ($this->request->data['MiProgramParticipants']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'programParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function programParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['MiProgramParticipants']['type']=="delete"){
            $this->request->data['MiProgramParticipants']['is_delete'] = 1 ;
            $data = $this->request->data['MiProgramParticipants'];
            if($this->MiProgramParticipants->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'programParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'programParticipantsList'));
            }
        }
        else{
            $participants_list = $this->MiProgramParticipants->find('all',array('conditions'=>array('MiProgramParticipants.is_delete'=>0),
                'order'=>array('MiProgramParticipants.id DESC')),array(
                'contain' => array(
                    'MiPrograms' => array(
                        'conditions' => array(
                            'MiPrograms.id' => 'MiProgramParticipants.mi_programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
          //  print_r($participants_list);
        }
    }


    public function programStudent($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getMiProgram();
        $branch = array('MCA'=>'MCA','BCA'=>'BCA');
        $this->set('branch',$branch);
        if($this->request->data['MiProgramStudents']['type']=="insert")
        {
            //print_r($this->request->data['MiProgramParticipants']);
            // return;
            $student_name = $this->request->data['student_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "MiProgramStudents"=>array(
                        "mi_programs_id"=>$this->request->data['MiProgramStudents']['mi_programs_id'],
                        "student_name"=>$this->request->data['student_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "collage_name"=>$this->request->data['collage_name'][$i],
                        "branch"=>$this->request->data['branch'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "city"=>$this->request->data['city'][$i],

                    )
                );
                $this->MiProgramStudents->saveAll($data);
            }
            $message=" Student Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'programStudentList'));
        }


        elseif($this->request->data['MiProgramStudents']['csrf_token']!=""){
            if ($this->request->data['MiProgramStudents']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'programStudent'));

            }
        }
        $this->changeCSRFToken();
    }
    public function programStudentList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['MiProgramStudents']['type']=="delete"){
            $this->request->data['MiProgramStudents']['is_delete'] = 1 ;
            $data = $this->request->data['MiProgramStudents'];
            if($this->MiProgramStudents->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'programStudentList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'programStudentList'));
            }
        }
        else{
            $student_list = $this->MiProgramStudents->find('all',array('conditions'=>array('MiProgramStudents.is_delete'=>0),
                'order'=>array('MiProgramStudents.id DESC')),array(
                'contain' => array(
                    'MiPrograms' => array(
                        'conditions' => array(
                            'MiPrograms.id' => 'MiProgramStudents.mi_programs_id'
                        ),
                    )
                ),
            ));
            $this->set('student_list',$student_list);
           // print_r($student_list);
        }
    }


    public function conference($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){
            $this->request->data['MiInternationalConferences']['id'] = $id;
            $this->request->data['MiInternationalConferences']['is_delete'] = 1 ;
            $data = $this->request->data['MiInternationalConferences'];

            if($this -> MiInternationalConferences -> save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'conference'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'conference'));
            }
        }

        $dataList = $this->MiInternationalConferences->find('all',array(
            'conditions'=>array('MiInternationalConferences.is_delete'=>0),
            'order'=>array('MiInternationalConferences.id DESC')));
        $this->set('program_list',$dataList);
        //print_r($dataList);
        $this->changeCSRFToken();
    }
    public function conferenceAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['MiInternationalConferences']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'conferenceAdd'));

            }
            if($this->request->data['MiInternationalConferences']['id']){
                $message="Conference Updated Successfully";
            }
            else{
                $message="Conference Added Successfully";
            }
            $monthYear=explode('-',$this->request->data['MiInternationalConferences']['conference_date']);
			$this->request->data['MiInternationalConferences']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiInternationalConferences']['year']=$monthYear[2];
			
			
            $this->request->data['MiInternationalConferences']['conference_date']=date('Y-m-d',strtotime($this->request->data['MiInternationalConferences']['conference_date']));
            $this->MiInternationalConferences->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'conference'));
        }
        if($id){
            $data = $this->MiInternationalConferences->read(null,$id);
            $data['MiInternationalConferences']['conference_date'] = ($data['MiInternationalConferences']['conference_date'] != '0000-00-00') ? date('d-m-Y',strtotime($data['MiInternationalConferences']['conference_date'])) : '';
            $this->request->data = $data;
        }

        $this->changeCSRFToken();
    }

    public function icParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getMiInternationalConferences();

        if($this->request->data['MiIcParticipants']['type']=="insert")
        {
            //print_r($this->request->data['MiIcParticipants']);
            // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "MiIcParticipants"=>array(
                        "mi_international_conferences_id"=>$this->request->data['MiIcParticipants']['mi_international_conferences_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "qualification"=>$this->request->data['qualification'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "city"=>$this->request->data['city'][$i],

                    )
                );
                $this->MiIcParticipants->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'icParticipantsList'));
        }


        elseif($this->request->data['MiIcParticipants']['csrf_token']!=""){
            if ($this->request->data['MiIcParticipants']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'icParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function icParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['MiIcParticipants']['type']=="delete"){
            $this->request->data['MiIcParticipants']['is_delete'] = 1 ;
            $data = $this->request->data['MiIcParticipants'];
            if($this->MiIcParticipants->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'icParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'icParticipantsList'));
            }
        }
        else{
            $participants_list = $this->MiIcParticipants->find('all',array('conditions'=>array('MiIcParticipants.is_delete'=>0),
                'order'=>array('MiIcParticipants.id DESC')),array(
                'contain' => array(
                    'MiInternationalConferences' => array(
                        'conditions' => array(
                            'MiPrograms.id' => 'MiInternationalConferences.mi_international_conferences_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
            //  print_r($participants_list);
        }
    }


    public function startupConference($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){
            $this->request->data['MiStartupConferences']['id'] = $id;
            $this->request->data['MiStartupConferences']['is_delete'] = 1 ;
            $data = $this->request->data['MiStartupConferences'];

            if($this -> MiStartupConferences -> save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'startupConference'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'startupConference'));
            }
        }

        $dataList = $this->MiStartupConferences->find('all',array(
            'conditions'=>array('MiStartupConferences.is_delete'=>0),
            'order'=>array('MiStartupConferences.id DESC')));
        $this->set('conference_list',$dataList);
        //print_r($dataList);
        $this->changeCSRFToken();
    }
    public function startupConferenceAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['MiStartupConferences']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'startupConferenceAdd'));

            }
            if($this->request->data['MiStartupConferences']['id']){
                $message="Conference Updated Successfully";
            }
            else{
                $message="Conference Added Successfully";
            }
            
            $monthYear=explode('-',$this->request->data['MiStartupConferences']['conference_date']);
			$this->request->data['MiStartupConferences']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiStartupConferences']['year']=$monthYear[2];
			
            $this->request->data['MiStartupConferences']['conference_date']=date('Y-m-d',strtotime($this->request->data['MiStartupConferences']['conference_date']));
            $this->MiStartupConferences->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'startupConference'));
        }
        if($id){
            $data = $this->MiStartupConferences->read(null,$id);
            $data['MiStartupConferences']['conference_date'] = ($data['MiStartupConferences']['conference_date'] != '0000-00-00') ? date('d-m-Y',strtotime($data['MiStartupConferences']['conference_date'])) : '';
            $this->request->data = $data;
        }

        $this->changeCSRFToken();
    }


    public function startupParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getMiStartupConferences();

        if($this->request->data['MiStartupParticipants']['type']=="insert")
        {
            //print_r($this->request->data['MiStartupParticipants']);
            // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "MiStartupParticipants"=>array(
                        "mi_startup_conferences_id"=>$this->request->data['MiStartupParticipants']['mi_startup_conferences_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "qualification"=>$this->request->data['qualification'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "city"=>$this->request->data['city'][$i],

                    )
                );
                $this->MiStartupParticipants->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'startupParticipantsList'));
        }


        elseif($this->request->data['MiStartupParticipants']['csrf_token']!=""){
            if ($this->request->data['MiStartupParticipants']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'startupParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function startupParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if($this->request->data['MiStartupParticipants']['type']=="delete"){
            $this->request->data['MiStartupParticipants']['is_delete'] = 1 ;
            $data = $this->request->data['MiStartupParticipants'];
            if($this->MiStartupParticipants->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'startupParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'startupParticipantsList'));
            }
        }
        else{
            $participants_list = $this->MiStartupParticipants->find('all',array('conditions'=>array('MiStartupParticipants.is_delete'=>0),
                'order'=>array('MiStartupParticipants.id DESC')),array(
                'contain' => array(
                    'MiStartupConferences' => array(
                        'conditions' => array(
                            'MiPrograms.id' => 'MiStartupConferences.mi_startup_conferences_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
            //  print_r($participants_list);
        }
    }


    public function importProgramParticipants(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        // $data = new Spreadsheet_Excel_Reader($this->request->data['Employee']["file"]['tmp_name'], true);
        //  echo $data->dump(true,true);
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='mi_program_participants.xls')
        {
            $data->read($this->request->data['Participant']["file"]['tmp_name']);
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

                if(!empty($getData[0]) ) {


                    $emp_data[] = array('MiProgramParticipants'=>
                        array(

                            'mi_programs_id'=>$this->request->data['Participant']["program_id"],
                            'participant_name'=>($getData[0]!='')?$getData[0]:'',
                            'gender'=>          ($getData[1]!='')?$getData[1]:'',
                            'qualification'=>   ($getData[2]!='')?$getData[2]:'',
                            'contact_number'=>  ($getData[3]!='')?$getData[3]:'',
                            'email'=>           ($getData[4]!='')?$getData[4]:'',
                            'city'=>            ($getData[5]!='')?$getData[5]:'',

                        ));
                    $details[] = $getData;
                }
            }

            $this->MiProgramParticipants->saveAll($emp_data);
            return;
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this->redirect('/MachineIntelligence/programParticipantsList');
    }
    public function importIcProgramParticipants(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        // $data = new Spreadsheet_Excel_Reader($this->request->data['Employee']["file"]['tmp_name'], true);
        //  echo $data->dump(true,true);
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='mi_program_participants.xls')
        {
            $data->read($this->request->data['Participant']["file"]['tmp_name']);
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

                if(!empty($getData[0]) ) {


                    $emp_data[] = array('MiIcParticipants'=>
                        array(

                            'mi_international_conferences_id'=>$this->request->data['Participant']["program_id"],
                            'participant_name'=>($getData[0]!='')?$getData[0]:'',
                            'gender'=>          ($getData[1]!='')?$getData[1]:'',
                            'qualification'=>   ($getData[2]!='')?$getData[2]:'',
                            'contact_number'=>  ($getData[3]!='')?$getData[3]:'',
                            'email'=>           ($getData[4]!='')?$getData[4]:'',
                            'city'=>            ($getData[5]!='')?$getData[5]:'',


                        ));
                    $details[] = $getData;
                }
            }
            $this->MiIcParticipants->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this->redirect('/MachineIntelligence/icParticipantsList');
    }
    public function importStartupParticipants(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        // $data = new Spreadsheet_Excel_Reader($this->request->data['Employee']["file"]['tmp_name'], true);
        //  echo $data->dump(true,true);
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='mi_program_participants.xls')
        {
            $data->read($this->request->data['Participant']["file"]['tmp_name']);
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

                if(!empty($getData[0]) ) {


                    $emp_data[] = array('MiStartupParticipants'=>
                        array(

                            'mi_startup_conferences_id'=>$this->request->data['Participant']["program_id"],
                            'participant_name'=>($getData[0]!='')?$getData[0]:'',
                            'gender'=>          ($getData[1]!='')?$getData[1]:'',
                            'qualification'=>   ($getData[2]!='')?$getData[2]:'',
                            'contact_number'=>  ($getData[3]!='')?$getData[3]:'',
                            'email'=>           ($getData[4]!='')?$getData[4]:'',
                            'city'=>            ($getData[5]!='')?$getData[5]:'',


                        ));
                    $details[] = $getData;
                }
            }
            $this->MiStartupParticipants->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this->redirect('/MachineIntelligence/startupParticipantsList');
    }

    public function importProgramStudents(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        // $data = new Spreadsheet_Excel_Reader($this->request->data['Employee']["file"]['tmp_name'], true);
        //  echo $data->dump(true,true);
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='mi_program_students.xls')
        {
            $data->read($this->request->data['Participant']["file"]['tmp_name']);
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


                    $emp_data[] = array('MiProgramStudents'=>
                        array(

                            'mi_programs_id'=>$this->request->data['Participant']["program_id"],
                             'student_name'=>        ($getData[0]!='')?$getData[0]:'',
                            'gender'=>        ($getData[1]!='')?$getData[1]:'',
                            'collage_name'=>    ($getData[2]!='')?$getData[2]:'',
                            'branch'=>          ($getData[3]!='')?$getData[3]:'',
                            'contact_number'=>  ($getData[4]!='')?$getData[4]:'',
                            'email'=>           ($getData[5]!='')?$getData[5]:'',
                            'city'=>            ($getData[6]!='')?$getData[6]:'',

                        ));

                }
            }

            if(sizeof($emp_data)>0)$this->MiProgramStudents->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this->redirect('/MachineIntelligence/programStudentList');
    }
    
    
    public function openExperienceCentreList($id=null){
        $this->layout = 'fab_layout';
		configure::write('debug',0);
        $this->_userSessionCheckout(); 
		
		date_default_timezone_set('Asia/Kolkata');
		
        if(!empty($this->request->data)) {

            if ($this->request->data['MiOpenExperienceCentre']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'openExperienceCentreList'));
            }
        }

        if($this->request->data['MiOpenExperienceCentre']['type']=="edit"){
            $this->request->data = $this->MiOpenExperienceCentre->read(null,$this->request->data['MiOpenExperienceCentre']['id']);
			$this->request->data['MiOpenExperienceCentre']['date_of_establishment'] = date('d-m-Y',strtotime($this->request->data['MiOpenExperienceCentre']['date_of_establishment']));
        }

        else if($this->request->data['MiOpenExperienceCentre']['type']=="delete"){
            $id=$this->request->data['MiOpenExperienceCentre']['id'];

            if($this -> MiOpenExperienceCentre -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'openExperienceCentreList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'openExperienceCentreList'));
            }
        }
        else if($this->request->data['MiOpenExperienceCentre']['type']=="insert"){

            if($this->request->data['MiOpenExperienceCentre']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->MiOpenExperienceCentre->hasAny(array("id !="=>$this->request->data['MiOpenExperienceCentre']['id'],"name_of_the_experience_center ="=>$this->request->data['MiOpenExperienceCentre']['name_of_the_experience_center']));
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' => 'openExperienceCentreList'));
            }


            $monthYear=explode('-',$this->request->data['MiOpenExperienceCentre']['date_of_establishment']);
			$this->request->data['MiOpenExperienceCentre']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiOpenExperienceCentre']['year']=$monthYear[2];
			$this->request->data['MiOpenExperienceCentre']['date_of_establishment'] = date('Y-m-d',strtotime($this->request->data['MiOpenExperienceCentre']['date_of_establishment']));

			//print_r($this->request->data);exit();
            $this->MiOpenExperienceCentre->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'openExperienceCentreList'));

        }
		$manage_list = $this->MiOpenExperienceCentre->find('all',array("order"=>array('MiOpenExperienceCentre.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
		
    }
	
	public function mentorshipList($id=null){
        $this->layout = 'fab_layout';
		configure::write('debug',0);
        $this->_userSessionCheckout();
		
		date_default_timezone_set('Asia/Kolkata');
		
        if(!empty($this->request->data)) {

            if ($this->request->data['MiMentorship']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'mentorshipList'));
            }
        }

        if($this->request->data['MiMentorship']['type']=="edit"){
            $this->request->data = $this->MiMentorship->read(null,$this->request->data['MiMentorship']['id']);
			$this->request->data['MiMentorship']['mentorship_start_date'] = date('d-m-Y',strtotime($this->request->data['MiMentorship']['mentorship_start_date']));
        }

        else if($this->request->data['MiMentorship']['type']=="delete"){
            $id=$this->request->data['MiMentorship']['id'];

            if($this -> MiMentorship -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'mentorshipList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'mentorshipList'));
            }
        }
        else if($this->request->data['MiMentorship']['type']=="insert"){

            if($this->request->data['MiMentorship']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->MiMentorship->hasAny(array("id !="=>$this->request->data['MiMentorship']['id'],"mentor_name ="=>$this->request->data['MiMentorship']['mentor_name']));
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' => 'mentorshipList'));
            }


            $monthYear=explode('-',$this->request->data['MiMentorship']['mentorship_start_date']);
			$this->request->data['MiMentorship']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MiMentorship']['year']=$monthYear[2];
			$this->request->data['MiMentorship']['mentorship_start_date'] = date('Y-m-d',strtotime($this->request->data['MiMentorship']['mentorship_start_date']));

			//print_r($this->request->data);exit();
            $this->MiMentorship->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'mentorshipList'));

        }
		$manage_list = $this->MiMentorship->find('all',array("order"=>array('MiMentorship.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
		
    }
    public function openExperienceCentreNew($id=null)
    {
        $this->layout = 'fab_layout';
        $this->getStartUps();

        $this->_userSessionCheckout();
        $this->loadModel('OpenExperienceCentre');

        if (!empty($this->request->data)) {
            if ($this->request->data['OpenExperienceCentre']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'openExperienceCentreNew'));
            }
        }
        if ($this->request->data['OpenExperienceCentre']['type'] == "edit") {
            $this->request->data = $this->OpenExperienceCentre->read(null, $this->request->data['OpenExperienceCentre']['id']);
            $this->request->data['OpenExperienceCentre']['month'] = $this->request->data['OpenExperienceCentre']['month'] . '-' . $this->request->data['OpenExperienceCentre']['year'];
        } else if ($this->request->data['OpenExperienceCentre']['type'] == "delete") {
            $investor_id = $this->request->data['OpenExperienceCentre']['id'];

            if ($this->OpenExperienceCentre->delete($investor_id)) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this->redirect(array('action' => 'openExperienceCentreNew'));
            } else {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this->redirect(array('action' => 'openExperienceCentreNew'));
            }
        } else if ($this->request->data['OpenExperienceCentre']['type'] == "insert") {

            if ($this->request->data['OpenExperienceCentre']['id']) {
                $message = "Updated Successfully";
            } else {
                $message = "Added Successfully";
            }
            
            $monthYear = explode('-', $this->request->data['OpenExperienceCentre']['start_date']);
            $this->request->data['OpenExperienceCentre']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
            $this->request->data['OpenExperienceCentre']['year'] = $monthYear[2];

            $incubation_date =  $this->request->data['OpenExperienceCentre']['start_date'];
            $incubation_date_new = new DateTime($incubation_date);
            $this->request->data['OpenExperienceCentre']['start_date'] =  $incubation_date_new->format('Y-m-d');
            $this->OpenExperienceCentre->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> " . $message . ".</div>");
            $this->redirect(array('action' => 'openExperienceCentreNew'));
        }

        $manage_list = $this->OpenExperienceCentre->find('all', array("order" => array('OpenExperienceCentre.id DESC')));
        $this->set('table_list', $manage_list);

        $this->changeCSRFToken();
    }

}
