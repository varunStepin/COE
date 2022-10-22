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
 include('excel_reader2.php');
//App::uses('PHPMailer', 'Vendor\PHPMailer\PHPMailer');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class CyberSecurityController extends AppController {


	public $uses = array('ParticipantsDetail');
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');

    
    public function internshipRegistration($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageInternshipPool');

        $list_array = array();
        $details = $this->ManageInternshipPool->find('all',array("order"=>"ManageInternshipPool.id ASC"));
        foreach($details as $list) {
            $list_array[$list['ManageInternshipPool']['id']] = $list['ManageInternshipPool']['internship_program_name'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'ManageInternshipPool',
                        "program_id"=>$this->request->data['ParticipantsDetail']['program_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "designation"=>$this->request->data['designation'][$i],
                        "contact_no"=>$this->request->data['contact_no'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "location"=>$this->request->data['location'][$i],

                    )
                );
                $this->ParticipantsDetail->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'internshipRegistrationList'));
        }

        elseif($this->request->data['ParticipantsDetail']['csrf_token']!=""){
            if ($this->request->data['ParticipantsDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'internshipRegistration'));

            }
        }
        $this->changeCSRFToken();
    }
    public function internshipRegistrationList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageInternshipPool');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('ManageInternshipPool'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

        if($this->request->data['ParticipantsDetail']['type']=="delete"){
            $id = $this->request->data['ParticipantsDetail']['id'];
            if($this->ParticipantsDetail->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'internshipRegistrationList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'internshipRegistrationList'));
            }
        }
        else{
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'ManageInternshipPool'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'ManageInternshipPool' => array(
                        'conditions' => array(
                            'ManageInternshipPool.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }


    public function enablementMembers($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageStartup');

        $list_array = array();
        $details = $this->ManageStartup->find('all',array("order"=>"ManageStartup.id ASC"));
        foreach($details as $list) {
            $list_array[$list['ManageStartup']['id']] = $list['ManageStartup']['incubation_startup_name'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'ManageStartup',
                        "program_id"=>$this->request->data['ParticipantsDetail']['program_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "designation"=>$this->request->data['designation'][$i],
                        "contact_no"=>$this->request->data['contact_no'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "location"=>$this->request->data['location'][$i],

                    )
                );
                $this->ParticipantsDetail->saveAll($data);
            }
            $message=" Record Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'enablementMembersList'));
        }

        elseif($this->request->data['ParticipantsDetail']['csrf_token']!=""){
            if ($this->request->data['ParticipantsDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'enablementMembersList'));

            }
        }
        $this->changeCSRFToken();
    }
    public function enablementMembersList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageStartup');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('ManageStartup'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

        if($this->request->data['ParticipantsDetail']['type']=="delete"){
            $id = $this->request->data['ParticipantsDetail']['id'];
            if($this->ParticipantsDetail->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'enablementMembers'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'enablementMembers'));
            }
        }
        else{
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'ManageStartup'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'ManageStartup' => array(
                        'conditions' => array(
                            'ManageStartup.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }


    public function trainingParticipants($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageCapacityBuilding');

        $list_array = array();
        $details = $this->ManageCapacityBuilding->find('all',array("order"=>"ManageCapacityBuilding.id ASC"));
        foreach($details as $list) {
            $list_array[$list['ManageCapacityBuilding']['id']] = $list['ManageCapacityBuilding']['name'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++) {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'ManageCapacityBuilding',
                        "program_id"=>$this->request->data['ParticipantsDetail']['program_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "designation"=>$this->request->data['designation'][$i],
                        "contact_no"=>$this->request->data['contact_no'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "location"=>$this->request->data['location'][$i],
                        "organization_name"=>$this->request->data['organization_name'][$i],
                        "address" => $this->request->data['address'][$i]
                    )
                );
                $this->ParticipantsDetail->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'trainingParticipantsList'));
        }

        elseif($this->request->data['ParticipantsDetail']['csrf_token']!=""){
            if ($this->request->data['ParticipantsDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'trainingParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function trainingParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageCapacityBuilding');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('ManageCapacityBuilding'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

        if($this->request->data['ParticipantsDetail']['type']=="delete"){
            $id = $this->request->data['ParticipantsDetail']['id'];
            if($this->ParticipantsDetail->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'trainingParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'trainingParticipantsList'));
            }
        }
        else{
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'ManageCapacityBuilding'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'ManageCapacityBuilding' => array(
                        'conditions' => array(
                            'ManageCapacityBuilding.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }


    public function workshopParticipants($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageCyberSecurity');

        $list_array = array();
        $details = $this->ManageCyberSecurity->find('all',array("order"=>"ManageCyberSecurity.id ASC"));
        foreach($details as $list) {
            $list_array[$list['ManageCyberSecurity']['id']] = $list['ManageCyberSecurity']['list_of_workshops_conducted'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++) {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'ManageCyberSecurity',
                        "program_id"=>$this->request->data['ParticipantsDetail']['program_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "designation"=>$this->request->data['designation'][$i],
                        "contact_no"=>$this->request->data['contact_no'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "location"=>$this->request->data['location'][$i],
                        "organization_name"=>$this->request->data['organization_name'][$i],
                        "address" => $this->request->data['address'][$i]
                    )
                );
                $this->ParticipantsDetail->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'workshopParticipantsList'));
        }

        elseif($this->request->data['ParticipantsDetail']['csrf_token']!=""){
            if ($this->request->data['ParticipantsDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'workshopParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function workshopParticipantsList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ManageCyberSecurity');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('ManageCyberSecurity'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

        if($this->request->data['ParticipantsDetail']['type']=="delete"){
            $id = $this->request->data['ParticipantsDetail']['id'];
            if($this->ParticipantsDetail->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'workshopParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'workshopParticipantsList'));
            }
        }
        else{
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'ManageCyberSecurity'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'ManageCyberSecurity' => array(
                        'conditions' => array(
                            'ManageCyberSecurity.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }






    public function importParticipant(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        // $data = new Spreadsheet_Excel_Reader($this->request->data['Employee']["file"]['tmp_name'], true);
        //  echo $data->dump(true,true);
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls')
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

                if(!empty($getData[0]) &&strtolower($getData[0])!='emp_id') {


                    $emp_data[] = array('ParticipantsDetail'=>
                        array(
                            'program_type'=>$this->request->data['Participant']["program_type"],
                            'program_id'=>$this->request->data['Participant']["program_id"],

                            'participant_name'=>$getData[0],
                            'gender'=>$getData[1],
                            'designation'=>$getData[2],
                            'contact_no'=>$getData[3],
                            'email'=>$getData[4],
                            'location'=>$getData[5],
                        ));
                    $details[] = $getData;
                }
            }
            $this->ParticipantsDetail->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Formate.</div>");

        }
        fclose($file);
       if(sizeof(explode("/",$this->request->data['Participant']["redirect_to"]))>2)
        	$this->redirect($this->request->data['Participant']["redirect_to"]);
		else
		   $this->redirect('/CyberSecurity/'.$this->request->data['Participant']["redirect_to"]);
    }
    public function cyberSecurityResearch()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CyberSecurityResearch');

        if (!empty($this->request->data)) {
            if ($this->request->data['CyberSecurityResearch']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'cyberSecurityResearch'));
            }
            if ($this->request->data['CyberSecurityResearch']['type'] == "edit") {
                $this->request->data = $this->CyberSecurityResearch->read(null, $this->request->data['CyberSecurityResearch']['id']);
                $this->request->data['CyberSecurityResearch']['month'] = $this->request->data['CyberSecurityResearch']['month'] . '-' . $this->request->data['CyberSecurityResearch']['year'];
            } else if ($this->request->data['CyberSecurityResearch']['type'] == "delete") {
                $research_id = $this->request->data['CyberSecurityResearch']['id'];

                if ($this->CyberSecurityResearch->delete($research_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'cyberSecurityResearch'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'cyberSecurityResearch'));
                }
            } else if ($this->request->data['CyberSecurityResearch']['type'] == "insert") {

                if ($this->request->data['CyberSecurityResearch']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CyberSecurityResearch']['month']);
                $this->request->data['CyberSecurityResearch']['month'] = $monthYear[0];
                $this->request->data['CyberSecurityResearch']['year'] = $monthYear[1];

                $this->CyberSecurityResearch->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'cyberSecurityResearch'));
            }
        }
       
        $table_list = $this->CyberSecurityResearch->find('all', array('order' => array('CyberSecurityResearch.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function csIndustryStartups()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CsIndustryStartup');

        if (!empty($this->request->data)) {
            if ($this->request->data['CsIndustryStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csIndustryStartups'));
            }
            if ($this->request->data['CsIndustryStartup']['type'] == "edit") {
                $this->request->data = $this->CsIndustryStartup->read(null, $this->request->data['CsIndustryStartup']['id']);
                $this->request->data['CsIndustryStartup']['month'] = $this->request->data['CsIndustryStartup']['month'] . '-' . $this->request->data['CsIndustryStartup']['year'];
            } else if ($this->request->data['CsIndustryStartup']['type'] == "delete") {
                $industry_startup_id = $this->request->data['CsIndustryStartup']['id'];

                if ($this->CsIndustryStartup->delete($industry_startup_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'csIndustryStartups'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'csIndustryStartups'));
                }
            } else if ($this->request->data['CsIndustryStartup']['type'] == "insert") {
                if ($this->request->data['CsIndustryStartup']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CsIndustryStartup']['month']);
                $this->request->data['CsIndustryStartup']['month'] = $monthYear[0];
                $this->request->data['CsIndustryStartup']['year'] = $monthYear[1];

                $this->CsIndustryStartup->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'csIndustryStartups'));
            }
        }
       
        $table_list = $this->CsIndustryStartup->find('all', array('order' => array('CsIndustryStartup.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
  
    public function csAwarenessPosters()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CyberHygieneHandbook');

        if (!empty($this->request->data)) {
            if ($this->request->data['CyberHygieneHandbook']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csAwarenessPosters'));
            }
            if ($this->request->data['CyberHygieneHandbook']['type'] == "edit") {
                $this->request->data = $this->CyberHygieneHandbook->read(null, $this->request->data['CyberHygieneHandbook']['id']);
                $this->request->data['CyberHygieneHandbook']['month'] = $this->request->data['CyberHygieneHandbook']['month'] . '-' . $this->request->data['CyberHygieneHandbook']['year'];
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "delete") {
                $industry_startup_id = $this->request->data['CyberHygieneHandbook']['id'];

                if ($this->CyberHygieneHandbook->delete($industry_startup_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'csAwarenessPosters'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'csAwarenessPosters'));
                }
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "insert") {
                if ($this->request->data['CyberHygieneHandbook']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $this->request->data['CyberHygieneHandbook']['release_date'] = date('d-m-Y', strtotime($this->request->data['CyberHygieneHandbook']['release_date']));
                $monthYear = explode('-', $this->request->data['CyberHygieneHandbook']['release_date']);
                $this->request->data['CyberHygieneHandbook']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['CyberHygieneHandbook']['year'] = $monthYear[2];

                $this->request->data['CyberHygieneHandbook']['type'] = 'CsAwarenessPosters';
                $this->CyberHygieneHandbook->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'csAwarenessPosters'));
            }
        }
       
        $table_list = $this->CyberHygieneHandbook->find('all', array('conditions'=>array('CyberHygieneHandbook.type'=>'CsAwarenessPosters'),'order' => array('CyberHygieneHandbook.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function cyberHygieneHandbook()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CyberHygieneHandbook');

        if (!empty($this->request->data)) {
            if ($this->request->data['CyberHygieneHandbook']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'cyberHygieneHandbook'));
            }
            if ($this->request->data['CyberHygieneHandbook']['type'] == "edit") {
                $this->request->data = $this->CyberHygieneHandbook->read(null, $this->request->data['CyberHygieneHandbook']['id']);
                $this->request->data['CyberHygieneHandbook']['month'] = $this->request->data['CyberHygieneHandbook']['month'] . '-' . $this->request->data['CyberHygieneHandbook']['year'];
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "delete") {
                $handbook_id = $this->request->data['CyberHygieneHandbook']['id'];

                if ($this->CyberHygieneHandbook->delete($handbook_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'cyberHygieneHandbook'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'cyberHygieneHandbook'));
                }
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "insert") {

                if ($this->request->data['CyberHygieneHandbook']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
               
                $this->request->data['CyberHygieneHandbook']['release_date'] = date('d-m-Y', strtotime($this->request->data['CyberHygieneHandbook']['release_date']));
                $monthYear = explode('-', $this->request->data['CyberHygieneHandbook']['release_date']);
                $this->request->data['CyberHygieneHandbook']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['CyberHygieneHandbook']['year'] = $monthYear[2];

                $this->request->data['CyberHygieneHandbook']['type'] = 'CyberHygieneHandbook';
                $this->CyberHygieneHandbook->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'cyberHygieneHandbook'));
            }
        }
       
        $table_list = $this->CyberHygieneHandbook->find('all', array('conditions'=>array('CyberHygieneHandbook.type'=>'CyberHygieneHandbook'),'order' => array('CyberHygieneHandbook.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function csVolunteerProgramme()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CsVolunteerProgram');

        if (!empty($this->request->data)) {
            if ($this->request->data['CsVolunteerProgram']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csVolunteerProgramme'));
            }
            if ($this->request->data['CsVolunteerProgram']['type'] == "edit") {
                $this->request->data = $this->CsVolunteerProgram->read(null, $this->request->data['CsVolunteerProgram']['id']);
                $this->request->data['CsVolunteerProgram']['month'] = $this->request->data['CsVolunteerProgram']['month'] . '-' . $this->request->data['CsVolunteerProgram']['year'];
            } else if ($this->request->data['CsVolunteerProgram']['type'] == "delete") {
                $volunteer_id = $this->request->data['CsVolunteerProgram']['id'];

                if ($this->CsVolunteerProgram->delete($volunteer_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'csVolunteerProgramme'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'csVolunteerProgramme'));
                }
            } else if ($this->request->data['CsVolunteerProgram']['type'] == "insert") {

                if ($this->request->data['CsVolunteerProgram']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CsVolunteerProgram']['month']);
                $this->request->data['CsVolunteerProgram']['month'] = $monthYear[0];
                $this->request->data['CsVolunteerProgram']['year'] = $monthYear[1];
                $this->request->data['CsVolunteerProgram']['type'] = 'CsVolunteerProgramme';
                $this->CsVolunteerProgram->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'csVolunteerProgramme'));
            }
        }
       
        $table_list = $this->CsVolunteerProgram->find('all', array('conditions'=>array('CsVolunteerProgram.type'=>'CsVolunteerProgramme'),'order' => array('CsVolunteerProgram.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function csAwarenessSessions()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear(); 
        $this->getMonth();
            
        $this->loadModel('CsAwarenessSession');

        if (!empty($this->request->data)) {
            if ($this->request->data['CsAwarenessSession']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csAwarenessSessions'));
            }
            if ($this->request->data['CsAwarenessSession']['type'] == "edit") {
                $this->request->data = $this->CsAwarenessSession->read(null, $this->request->data['CsAwarenessSession']['id']);
                $this->request->data['CsAwarenessSession']['month'] = $this->request->data['CsAwarenessSession']['month'] . '-' . $this->request->data['CsAwarenessSession']['year'];
            } else if ($this->request->data['CsAwarenessSession']['type'] == "delete") {
                $hackathon_id = $this->request->data['CsAwarenessSession']['id'];

                if ($this->CsAwarenessSession->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'csAwarenessSessions'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'csAwarenessSessions'));
                }
            } else if ($this->request->data['CsAwarenessSession']['type'] == "insert") {

                if ($this->request->data['CsAwarenessSession']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CsAwarenessSession']['month']);
                $this->request->data['CsAwarenessSession']['month'] = $monthYear[0];
                $this->request->data['CsAwarenessSession']['year'] = $monthYear[1];

                $this->CsAwarenessSession->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'csAwarenessSessions'));
            }
        }
       
        $table_list = $this->CsAwarenessSession->find('all', array('order' => array('CsAwarenessSession.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function csAwarenessSessionParticipants($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CsAwarenessSession');

        $list_array = array();
        $details = $this->CsAwarenessSession->find('all',array("order"=>"CsAwarenessSession.id ASC"));
        foreach($details as $list) {
            $list_array[$list['CsAwarenessSession']['id']] = $list['CsAwarenessSession']['trainer_name'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++) {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'CsAwarenessSession',
                        "program_id"=>$this->request->data['ParticipantsDetail']['program_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "contact_no"=>$this->request->data['contact_no'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "address"=>$this->request->data['address'][$i],
                        "organization_name"=>$this->request->data['organization_name'][$i],
                    )
                );
                $this->ParticipantsDetail->saveAll($data);
            }
            $message="Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this->redirect(array('action' => 'csAwarenessSessionParticipantsList'));
        }

        elseif($this->request->data['ParticipantsDetail']['csrf_token']!=""){
            if ($this->request->data['ParticipantsDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csAwarenessSessionParticipants'));
            }
        }
        $this->changeCSRFToken();
    }
    public function csAwarenessSessionParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CsAwarenessSession');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('CsAwarenessSession'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

        if($this->request->data['ParticipantsDetail']['type']=="delete"){
            $id = $this->request->data['ParticipantsDetail']['id'];
            if($this->ParticipantsDetail->deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'csAwarenessSessionParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'csAwarenessSessionParticipantsList'));
            }
        }
        else{
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'CsAwarenessSession'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'CsAwarenessSession' => array(
                        'conditions' => array(
                            'CsAwarenessSession.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }

    public function csNewsLetter()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CyberHygieneHandbook');

        if (!empty($this->request->data)) {
            if ($this->request->data['CyberHygieneHandbook']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'csNewsLetter'));
            }
            if ($this->request->data['CyberHygieneHandbook']['type'] == "edit") {
                $this->request->data = $this->CyberHygieneHandbook->read(null, $this->request->data['CyberHygieneHandbook']['id']);
                $this->request->data['CyberHygieneHandbook']['month'] = $this->request->data['CyberHygieneHandbook']['month'] . '-' . $this->request->data['CyberHygieneHandbook']['year'];
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "delete") {
                $industry_startup_id = $this->request->data['CyberHygieneHandbook']['id'];

                if ($this->CyberHygieneHandbook->delete($industry_startup_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'csNewsLetter'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'csNewsLetter'));
                }
            } else if ($this->request->data['CyberHygieneHandbook']['type'] == "insert") {
                if ($this->request->data['CyberHygieneHandbook']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CyberHygieneHandbook']['month']);
                $this->request->data['CyberHygieneHandbook']['month'] = $monthYear[0];
                $this->request->data['CyberHygieneHandbook']['year'] = $monthYear[1];

                $this->request->data['CyberHygieneHandbook']['type'] = 'CsNewsLetter';
                $this->CyberHygieneHandbook->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'csNewsLetter'));
            }
        }
       
        $table_list = $this->CyberHygieneHandbook->find('all', array('conditions'=>array('CyberHygieneHandbook.type'=>'CsNewsLetter'),'order' => array('CyberHygieneHandbook.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function facultyDevelopmentProgram()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('CsVolunteerProgram');

        if (!empty($this->request->data)) {
            if ($this->request->data['CsVolunteerProgram']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'facultyDevelopmentProgram'));
            }
            if ($this->request->data['CsVolunteerProgram']['type'] == "edit") {
                $this->request->data = $this->CsVolunteerProgram->read(null, $this->request->data['CsVolunteerProgram']['id']);
                $this->request->data['CsVolunteerProgram']['month'] = $this->request->data['CsVolunteerProgram']['month'] . '-' . $this->request->data['CsVolunteerProgram']['year'];
            } else if ($this->request->data['CsVolunteerProgram']['type'] == "delete") {
                $volunteer_id = $this->request->data['CsVolunteerProgram']['id'];

                if ($this->CsVolunteerProgram->delete($volunteer_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'facultyDevelopmentProgram'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'facultyDevelopmentProgram'));
                }
            } else if ($this->request->data['CsVolunteerProgram']['type'] == "insert") {

                if ($this->request->data['CsVolunteerProgram']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['CsVolunteerProgram']['month']);
                $this->request->data['CsVolunteerProgram']['month'] = $monthYear[0];
                $this->request->data['CsVolunteerProgram']['year'] = $monthYear[1];
                $this->request->data['CsVolunteerProgram']['type'] = 'FacultyDevelopmentProgram';
                $this->CsVolunteerProgram->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'facultyDevelopmentProgram'));
            }
        }
       
        $table_list = $this->CsVolunteerProgram->find('all', array('conditions'=>array('CsVolunteerProgram.type'=>'FacultyDevelopmentProgram'),'order' => array('CsVolunteerProgram.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function importAwarenessSessionParticipant(){

        $this->_userSessionCheckout();
       
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['Participant']["file"];
       
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls')
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

                if(!empty($getData[0]) &&strtolower($getData[0])!='emp_id') {      
                    $emp_data[] = array('ParticipantsDetail'=>
                        array(
                            'program_type'=>$this->request->data['Participant']["program_type"],
                            'program_id'=>$this->request->data['Participant']["program_id"],

                            'participant_name'=>$getData[0],
                            'organization_name'=>$getData[1],
                            'email'=>$getData[2],
                            'contact_no'=>$getData[3],
                            'address'=>$getData[4],
                        ));
                    $details[] = $getData;
                }
            }
            $this->ParticipantsDetail->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Formate.</div>");

        }
        fclose($file);
       if(sizeof(explode("/",$this->request->data['Participant']["redirect_to"]))>2)
        	$this->redirect($this->request->data['Participant']["redirect_to"]);
		else
		   $this->redirect('/CyberSecurity/'.$this->request->data['Participant']["redirect_to"]);
    }
}
