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

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
include('excel_reader2.php');
class FablessController extends AppController {


	public $uses = array("Companies","CompanyTeamDetails",'PartnerDetail','IncubateeDetail','MentorDetail'    ,'IncubateeTeamDetail','CoeDetail');
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');



    public function companies($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if($id){


            if($this -> Companies -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'companies'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'companies'));
            }
        }

        $dataList = $this->Companies->find('all',array('order'=>array('Companies.id DESC')));
        $this->set('companies_list',$dataList);

        $this->changeCSRFToken();
    }
    public function companiesAdd($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();

        if(!empty($this->request->data)) {
            if ($this->request->data['Companies']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'companiesAdd'));

            }

            if($this->request->data['Companies']['id']){
                $message="Companies Updated Successfully";
            }
            else{
                $message="Companies Added Successfully";
            }
            $this->Companies->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'companies'));
        }
        if($id){
            $this->request->data = $this->Companies->read(null,$id);

        }


        $this->changeCSRFToken();
    }

    public function teamDetails($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->getCompanies();

        $this->set('qualification',["UG"=>"UG","PG"=>"PG","PSD"=>"PSD","MS"=>"MS"]);

        if($this->request->data['CompanyTeamDetails']['type']=="insert")
        {
            //print_r($this->request->data);
             //return;
            $participant_name = $this->request->data['name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "CompanyTeamDetails"=>array(
                        "companies_id"=>$this->request->data['CompanyTeamDetails']['companies_id'],
                        "name"=>$this->request->data['name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "qualification"=>$this->request->data['qualification'][$i],
                        "post"=>$this->request->data['post'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "city"=>$this->request->data['city'][$i],

                    )
                );
                $this->CompanyTeamDetails->saveAll($data);
            }
            $message=" Team Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'teamDetailsList'));
        }


        elseif($this->request->data['CompanyTeamDetails']['csrf_token']!=""){
            if ($this->request->data['CompanyTeamDetails']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'teamDetailsList'));

            }
        }
        $this->changeCSRFToken();
    }
    public function teamDetailsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        if($this->request->data['CompanyTeamDetails']['type']=="delete"){

            $data = $this->request->data['CompanyTeamDetails'];
            if($this->CompanyTeamDetails->deleted($data['id'])){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'teamDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'teamDetailsList'));
            }
        }
        else{
            $participants_list = $this->CompanyTeamDetails->find('all',array(
                'order'=>array('CompanyTeamDetails.id DESC')),array(
                'contain' => array(
                    'Companies' => array(
                        'conditions' => array(
                            'Companies.id' => 'CompanyTeamDetails.companies_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
           //  print_r($participants_list);
        }
    }


	//NEW FABLESS 29-9-20
	public function partnerDetails($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();


        if(!empty($this->request->data)) {
            if ($this->request->data['PartnerDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'partnerDetails'));
            }
        }
        if($this->request->data['PartnerDetail']['type']=="edit"){
            $this->request->data = $this->PartnerDetail->read(null,$this->request->data['PartnerDetail']['id']);

        }
        else if($this->request->data['PartnerDetail']['type']=="delete"){
            $id=$this->request->data['PartnerDetail']['id'];

            if($this->PartnerDetail->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'partnerDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'partnerDetailsList'));
            }
        }

        else if($this->request->data['PartnerDetail']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['PartnerDetail']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->PartnerDetail->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'partnerDetailsList'));

        }
		$this->changeCSRFToken();
        
    }
	
	 public function partnerDetailsList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		
		

		
		$manage_list = $this->PartnerDetail->find('all',array('order'=>array('PartnerDetail.id DESC')));
        $this->set('manage_list',$manage_list);
		
	}
	
	
	
	
	public function incubateeDetails($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
		
		if(!empty($this->request->data)) {
            if ($this->request->data['IncubateeDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'incubateeDetailsList'));
            }
        }

        if($this->request->data['IncubateeDetail']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['IncubateeDetail']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->IncubateeDetail->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'incubateeDetailsList'));

        }

        
        $this->changeCSRFToken();
		
	}
	
	public function incubateeDetailsList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		
		
		if($this->request->data['IncubateeDetail']['type']=="delete"){
            $id=$this->request->data['IncubateeDetail']['id'];

            if($this->IncubateeDetail->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'incubateeDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'incubateeDetailsList'));
            }
        }
		
		$manage_list = $this->IncubateeDetail->find('all',array('order'=>array('IncubateeDetail.id DESC')));
        $this->set('manage_list',$manage_list);
		
	}
	
	
	public function mentorDetails($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
		
		if(!empty($this->request->data)) {
            if ($this->request->data['MentorDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'mentorDetailsList'));
            }
        }

        if($this->request->data['MentorDetail']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['MentorDetail']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->MentorDetail->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'mentorDetailsList'));

        }

        $this->changeCSRFToken();
	}
	
	public function mentorDetailsList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		
		
		if($this->request->data['MentorDetail']['type']=="delete"){
            $id=$this->request->data['MentorDetail']['id'];

            if($this->MentorDetail->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'mentorDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'mentorDetailsList'));
            }
        }
		
		$manage_list = $this->MentorDetail->find('all',array('order'=>array('MentorDetail.id DESC')));
        $this->set('manage_list',$manage_list);
		
	}
	
	public function incubateeTeamDetailsList($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		
		
		if($this->request->data['IncubateeTeamDetail']['type']=="delete"){
            $id=$this->request->data['IncubateeTeamDetail']['id'];

            if($this->IncubateeTeamDetail->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'incubateeTeamDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'incubateeTeamDetailsList'));
            }
        }
		
		$manage_list = $this->IncubateeTeamDetail->find('all',array('order'=>array('IncubateeTeamDetail.id DESC')));
        $this->set('manage_list',$manage_list);
		
	}
	
	public function incubateeTeamDetails($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
		
		if(!empty($this->request->data)) {
            if ($this->request->data['IncubateeTeamDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'incubateeTeamDetailsList'));
            }
        }

        if($this->request->data['IncubateeTeamDetail']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['IncubateeTeamDetail']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
			
			$date =  $this->request->data['IncubateeTeamDetail']['date_of_joining'] ;
			$date1 =  $this->request->data['IncubateeTeamDetail']['date_of_birth'] ;
            $this->request->data['IncubateeTeamDetail']['date_of_joining']= $date ? date('d-m-Y',strtotime($date)): '';
            $this->request->data['IncubateeTeamDetail']['date_of_birth']= $date1 ? date('d-m-Y',strtotime($date1)): '';

            $this->IncubateeTeamDetail->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'incubateeTeamDetailsList'));

        }

        $this->changeCSRFToken();
	}
	
	public function coeDetailsList($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		
		
		if($this->request->data['CoeDetail']['type']=="delete"){
            $id=$this->request->data['CoeDetail']['id'];

            if($this->CoeDetail->delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'coeDetailsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'coeDetailsList'));
            }
        }
		
		$manage_list = $this->CoeDetail->find('all',array('order'=>array('CoeDetail.id DESC')));
        $this->set('manage_list',$manage_list);
		
	}
	
	public function coeDetails($id=null){
		configure::write('debug',0);
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
		
		if(!empty($this->request->data)) {
            if ($this->request->data['CoeDetail']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'coeDetailsList'));
            }
        }

        if($this->request->data['CoeDetail']['type']=="insert"){
            //print_r($this->request->data);exit();
            if($this->request->data['CoeDetail']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->CoeDetail->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'coeDetailsList'));

        }

        $this->changeCSRFToken();
	}
	    public function coeTeamList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('FablessCoeTeam');
        if($id){


            if($this -> FablessCoeTeam -> delete($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'coeTeamList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'coeTeamList'));
            }
        }

        $dataList = $this->FablessCoeTeam->find('all',array('order'=>array('FablessCoeTeam.id DESC')));
        $this->set('companies_list',$dataList);

        $this->changeCSRFToken();
    }
    public function coeTeam($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('FablessCoeTeam');

        if(!empty($this->request->data)) {
            if ($this->request->data['FablessCoeTeam']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'coeTeam'));

            }

            if($this->request->data['FablessCoeTeam']['id']){
                $message="COE Team Updated Successfully";
            }
            else{
                $message="COE Team Added Successfully";
            }
            $this->FablessCoeTeam->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'coeTeamList'));
        }
        if($id){
            $this->request->data = $this->FablessCoeTeam->read(null,$id);

        }


        $this->changeCSRFToken();
    }
    public function fablessTeamImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('CompanyTeamDetails');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['CompanyTeamDetails']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='fablessTeam.xls')
        {
            $data->read($this->request->data['CompanyTeamDetails']["file"]['tmp_name']);
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


                    $emp_data[] = array('CompanyTeamDetails'=>
                        array(

                            'companies_id'=>$this->request->data['CompanyTeamDetails']["program_id"],
                            'name'=>        ($getData[0]!='')?$getData[0]:'',
                            'gender'=>    ($getData[1]!='')?$getData[1]:'',
                            'city'=>    ($getData[2]!='')?$getData[2]:'',
                            'contact_number'=>          ($getData[3]!='')?$getData[3]:'',
                            'email'=>  ($getData[4]!='')?$getData[4]:'',
                            'post'=>           ($getData[5]!='')?$getData[5]:'',
                            'qualification'=>           ($getData[6]!='')?$getData[6]:'',


                        ));
                    $details[] = $getData;
                }
            }
            $this->CompanyTeamDetails->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'teamDetailsList'));
    }
public function successfulCompanies($id=null)
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('SuccessfulCompany');

        if($id){
            if($this -> SuccessfulCompany -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'successfulCompanies'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'successfulCompanies'));
            }
        }
        
        $dataList = $this->SuccessfulCompany->find('all',array('order'=>array('SuccessfulCompany.id DESC')));
        
        $this->set('successful_companies_list',$dataList);

        $this->changeCSRFToken();
    }
    public function successfulCompaniesAdd($id=null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('SuccessfulCompany');

        if(!empty($this->request->data)) {
            if ($this->request->data['SuccessfulCompany']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'successfulCompaniesAdd'));

            }

            if($this->request->data['SuccessfulCompany']['id']){
                $message="Companies Updated Successfully";
            }
            else{
                $message="Companies Added Successfully";
            }
            $this->SuccessfulCompany->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'successfulCompanies'));
        }
        if($id){
            $this->request->data = $this->SuccessfulCompany->read(null,$id);

        }


        $this->changeCSRFToken();
    }

    public function exitedCompanies($id=null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('ExitedCompany');

        if($id){
            if($this -> ExitedCompany -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'exitedCompanies'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'exitedCompanies'));
            }
        }
        
        $dataList = $this->ExitedCompany->find('all',array('order'=>array('ExitedCompany.id DESC')));
        
        $this->set('exited_companies_list',$dataList);

        $this->changeCSRFToken();
    }
    public function exitedCompaniesAdd($id=null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('ExitedCompany');

        if(!empty($this->request->data)) {
            if ($this->request->data['ExitedCompany']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'exitedCompaniesAdd'));

            }

            if($this->request->data['ExitedCompany']['id']){
                $message="Companies Updated Successfully";
            }
            else{
                $message="Companies Added Successfully";
            }
            $this->ExitedCompany->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'exitedCompanies'));
        }
        if($id){
            $this->request->data = $this->ExitedCompany->read(null,$id);

        }


        $this->changeCSRFToken();
    }
}
