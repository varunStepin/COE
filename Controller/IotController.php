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
class IotController extends AppController {


    public $uses = array("IotStartUp","IotIntellectualProperty","IotStartupsRisedFund","IotDelegation","IotPilotsProject","IotIncubatedResearcher","IotGlobalConferencePaper","IotShowcasedPrototype");
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');


    public function startUp() {

        $this->layout = 'fab_layout';

        $this->loadModel('IotStartUp');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotStartUp']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['IotStartUp']['actionType']=="edit"){
            $this->request->data = $this->IotStartUp->read(null,$this->request->data['IotStartUp']['id']);
            $this->request->data['IotStartUp']['month']=$this->request->data['IotStartUp']['month'].'-'.$this->request->data['IotStartUp']['year'];
        }
        else if($this->request->data['IotStartUp']['actionType']=="delete"){
            $id=$this->request->data['IotStartUp']['id'];

            if($this -> IotStartUp -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'startUpList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'startUpList'));
            }
        }
        else if($this->request->data['IotStartUp']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotStartUp']['month']);
            //$this->request->data['IotStartUp']['month']=$monthYear[0];
            //$this->request->data['IotStartUp']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotStartUp']['date_of_incubation']);
			$this->request->data['IotStartUp']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotStartUp']['year']=$monthYear[2];
            
            if($this->request->data['IotStartUp']['id']){
                $message="Iot Start Up Updated Successfully";
            }
            else{
                $message="Iot StartUp Added Successfully";
            }
            $this->IotStartUp->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'startUpList'));
        }

        $this->changeCSRFToken();
    }
    public function startUpList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       $data_list = $this->IotStartUp->find('all',['order'=>['id DESC']]);
       $this->set('data_list',$data_list);

    }

    public function ip() {

        $this->layout = 'fab_layout';
        $this->getStartUps();



        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotIntellectualProperty']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['IotIntellectualProperty']['actionType']=="edit"){
            $this->request->data = $this->IotIntellectualProperty->read(null,$this->request->data['IotIntellectualProperty']['id']);
            $this->request->data['IotIntellectualProperty']['month']=$this->request->data['IotIntellectualProperty']['month'].'-'.$this->request->data['IotIntellectualProperty']['year'];
        }
        else if($this->request->data['IotIntellectualProperty']['actionType']=="delete"){
            $id=$this->request->data['IotIntellectualProperty']['id'];

            if($this -> IotIntellectualProperty -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'ipList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'ipList'));
            }
        }
        else if($this->request->data['IotIntellectualProperty']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotIntellectualProperty']['month']);
            //$this->request->data['IotIntellectualProperty']['month']=$monthYear[0];
            //$this->request->data['IotIntellectualProperty']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotIntellectualProperty']['date_of_filling']);
			$this->request->data['IotIntellectualProperty']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotIntellectualProperty']['year']=$monthYear[2];
			
            
            if($this->request->data['IotIntellectualProperty']['id']){
                $message="Intellectual Property Up Updated Successfully";
            }
            else{
                $message="Intellectual Property Added Successfully";
            }
            $this->IotIntellectualProperty->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'ipList'));
        }

        $this->changeCSRFToken();
    }
    public function ipList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->IotIntellectualProperty->bindModel(array('belongsTo'=>array("IotStartUp")));
        $data_list = $this->IotIntellectualProperty->find('all',['order'=>['IotIntellectualProperty.id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function startupRisedFunds() {

        $this->layout = 'fab_layout';
        $this->getStartUps();



        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotStartupsRisedFund']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['IotStartupsRisedFund']['actionType']=="edit"){
            $this->request->data = $this->IotStartupsRisedFund->read(null,$this->request->data['IotStartupsRisedFund']['id']);
            $this->request->data['IotStartupsRisedFund']['month']=$this->request->data['IotStartupsRisedFund']['month'].'-'.$this->request->data['IotStartupsRisedFund']['year'];
        }
        else if($this->request->data['IotStartupsRisedFund']['actionType']=="delete"){
            $id=$this->request->data['IotStartupsRisedFund']['id'];

            if($this -> IotStartupsRisedFund -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'startupRisedFundsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'startupRisedFundsList'));
            }
        }
        else if($this->request->data['IotStartupsRisedFund']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotStartupsRisedFund']['month']);
            //$this->request->data['IotStartupsRisedFund']['month']=$monthYear[0];
            //$this->request->data['IotStartupsRisedFund']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotStartupsRisedFund']['date_of_funding']);
			$this->request->data['IotStartupsRisedFund']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotStartupsRisedFund']['year']=$monthYear[2];
			
            
            if($this->request->data['IotStartupsRisedFund']['id']){
                $message="Fund Rise  Updated Successfully";
            }
            else{
                $message="Fund Rise  Added Successfully";
            }
            $this->IotStartupsRisedFund->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'startupRisedFundsList'));
        }

        $this->changeCSRFToken();
    }
    public function startupRisedFundsList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->IotStartupsRisedFund->bindModel(array('belongsTo'=>array("IotStartUp")));
        $data_list = $this->IotStartupsRisedFund->find('all',['order'=>['IotStartupsRisedFund.id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function delegation() {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotDelegation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['IotDelegation']['actionType']=="edit"){
            $this->request->data = $this->IotDelegation->read(null,$this->request->data['IotDelegation']['id']);
            $this->request->data['IotDelegation']['month']=$this->request->data['IotDelegation']['month'].'-'.$this->request->data['IotDelegation']['year'];
        }
        else if($this->request->data['IotDelegation']['actionType']=="delete"){
            $id=$this->request->data['IotDelegation']['id'];

            if($this -> IotDelegation -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'delegationList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'delegationList'));
            }
        }
        else if($this->request->data['IotDelegation']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotDelegation']['month']);
            //$this->request->data['IotDelegation']['month']=$monthYear[0];
            //$this->request->data['IotDelegation']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotDelegation']['date_of_visit']);
			$this->request->data['IotDelegation']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotDelegation']['year']=$monthYear[2];
            
            if($this->request->data['IotDelegation']['id']){
                $message="IotDelegation Updated Successfully";
            }
            else{
                $message="Iot Delegation  Added Successfully";
            }
            $this->IotDelegation->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'delegationList'));
        }

        $this->changeCSRFToken();
    }
    public function delegationList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $data_list = $this->IotDelegation->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function pilotsProject() {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getStartUps();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotPilotsProject']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['IotPilotsProject']['actionType']=="edit"){
            $this->request->data = $this->IotPilotsProject->read(null,$this->request->data['IotPilotsProject']['id']);
            $this->request->data['IotPilotsProject']['month']=$this->request->data['IotPilotsProject']['month'].'-'.$this->request->data['IotPilotsProject']['year'];
        }
        else if($this->request->data['IotPilotsProject']['actionType']=="delete"){
            $id=$this->request->data['IotPilotsProject']['id'];

            if($this -> IotPilotsProject -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'pilotsProjectList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'pilotsProjectList'));
            }
        }
        else if($this->request->data['IotPilotsProject']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotPilotsProject']['month']);
            //$this->request->data['IotPilotsProject']['month']=$monthYear[0];
            //$this->request->data['IotPilotsProject']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotPilotsProject']['date_of_started']);
            $this->request->data['IotPilotsProject']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
            $this->request->data['IotPilotsProject']['year']=$monthYear[2];
            
            if($this->request->data['IotPilotsProject']['id']){
                $message="Pilots Project Updated Successfully";
            }
            else{
                $message="Pilots Project  Added Successfully";
            }
            $this->IotPilotsProject->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'pilotsProjectList'));
        }

        $this->changeCSRFToken();
    }
    public function pilotsProjectList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->IotPilotsProject->bindModel(array('belongsTo'=>array("IotStartUp")));
        $data_list = $this->IotPilotsProject->find('all',['order'=>['IotPilotsProject.id DESC']]);
        $this->set('data_list',$data_list);

    }
     public function eventWorkshop() {

        $this->layout = 'fab_layout';

        $this->loadModel('IotEventWorkshop');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotEventWorkshop']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['IotEventWorkshop']['actionType']=="edit"){
            $this->request->data = $this->IotEventWorkshop->read(null,$this->request->data['IotEventWorkshop']['id']);
            $this->request->data['IotEventWorkshop']['month']=$this->request->data['IotEventWorkshop']['month'].'-'.$this->request->data['IotEventWorkshop']['year'];
        }
        else if($this->request->data['IotEventWorkshop']['actionType']=="delete"){
            $id=$this->request->data['IotEventWorkshop']['id'];

            if($this -> IotEventWorkshop -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'eventWorkshopList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'eventWorkshopList'));
            }
        }
        else if($this->request->data['IotEventWorkshop']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotEventWorkshop']['month']);
            //$this->request->data['IotEventWorkshop']['month']=$monthYear[0];
            //$this->request->data['IotEventWorkshop']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotEventWorkshop']['date']);
			$this->request->data['IotEventWorkshop']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotEventWorkshop']['year']=$monthYear[2];
			
            
            $date =  $this->request->data['IotEventWorkshop']['date'] ;
            $this->request->data['IotEventWorkshop']['date']= $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['IotEventWorkshop']['id']){
                $message="Iot Events / Workshops Updated Successfully";
            }
            else{
                $message="Iot Events / Workshops Added Successfully";
            }
            $this->IotEventWorkshop->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'eventWorkshopList'));
        }

        $this->changeCSRFToken();
    }
    public function eventWorkshopList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('IotEventWorkshop');
        $data_list = $this->IotEventWorkshop->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function industryConnected() {

        $this->layout = 'fab_layout';

        $this->loadModel('IotIndustryConnected');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotIndustryConnected']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['IotIndustryConnected']['actionType']=="edit"){
            $this->request->data = $this->IotIndustryConnected->read(null,$this->request->data['IotIndustryConnected']['id']);
            $this->request->data['IotIndustryConnected']['month']=$this->request->data['IotIndustryConnected']['month'].'-'.$this->request->data['IotIndustryConnected']['year'];
        }
        else if($this->request->data['IotIndustryConnected']['actionType']=="delete"){
            $id=$this->request->data['IotIndustryConnected']['id'];

            if($this -> IotIndustryConnected -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'industryConnectedList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'industryConnectedList'));
            }
        }
        else if($this->request->data['IotIndustryConnected']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotIndustryConnected']['month']);
            //$this->request->data['IotIndustryConnected']['month']=$monthYear[0];
            //$this->request->data['IotIndustryConnected']['year']=$monthYear[1];
            $this->request->data['IotIndustryConnected']['month']=date('F');
            $this->request->data['IotIndustryConnected']['year']=date('Y');
            
            if($this->request->data['IotIndustryConnected']['id']){
                $message="Industry Details Updated Successfully";
            }
            else{
                $message="Industry Details Added Successfully";
            }
            $this->IotIndustryConnected->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'industryConnectedList'));
        }

        $this->changeCSRFToken();
    }
    public function industryConnectedList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('IotIndustryConnected');
        $data_list = $this->IotIndustryConnected->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function academiaConnected() {

        $this->layout = 'fab_layout';

        $this->loadModel('IotAcademiaConnected');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['IotAcademiaConnected']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['IotAcademiaConnected']['actionType']=="edit"){
            $this->request->data = $this->IotAcademiaConnected->read(null,$this->request->data['IotAcademiaConnected']['id']);
            $this->request->data['IotAcademiaConnected']['month']=$this->request->data['IotAcademiaConnected']['month'].'-'.$this->request->data['IotAcademiaConnected']['year'];
        }
        else if($this->request->data['IotAcademiaConnected']['actionType']=="delete"){
            $id=$this->request->data['IotAcademiaConnected']['id'];

            if($this -> IotAcademiaConnected -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'academiaConnectedList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'academiaConnectedList'));
            }
        }
        else if($this->request->data['IotAcademiaConnected']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['IotAcademiaConnected']['month']);
            //$this->request->data['IotAcademiaConnected']['month']=$monthYear[0];
            //$this->request->data['IotAcademiaConnected']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['IotAcademiaConnected']['date_initiation_course']);
			$this->request->data['IotAcademiaConnected']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotAcademiaConnected']['year']=$monthYear[2];

            
            $date = $this->request->data['IotAcademiaConnected']['date_initiation_course'] ;
            $this->request->data['IotAcademiaConnected']['date_initiation_course'] = $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['IotAcademiaConnected']['id']){
                $message="Academia Details Updated Successfully";
            }
            else{
                $message="Academia Details Added Successfully";
            }
            $this->IotAcademiaConnected->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'academiaConnectedList'));
        }

        $this->changeCSRFToken();
    }
    public function academiaConnectedList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('IotAcademiaConnected');
        $data_list = $this->IotAcademiaConnected->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);
    }

    /************************* 06-11-2020 Start (MDF) *************************/

    public function intellectualImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotIntellectualProperty');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotIntellectualProperty']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='intellectual_property.xls') {
            $data->read($this->request->data['IotIntellectualProperty']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotIntellectualProperty'=>
                        array(
                            'iot_start_up_id'   =>     $this->request->data['IotIntellectualProperty']["program_name_id"],
                            'date_of_filling'   =>     ($getData[0]!='')?$getData[0]:'',
                            'date_of_grant'     =>     ($getData[1]!='')?$getData[1]:'',
                            'geography'         =>     ($getData[2]!='')?$getData[2]:'',
                            'appl_patent_no'    =>     ($getData[3]!='')?$getData[3]:'',
                            'title'             =>     ($getData[4]!='')?$getData[4]:'',
                            'phase'=>     ($getData[5]!='')?$getData[5]:'',
                            'month'             =>     'Jan',
                            'year'              =>     '2020',
                        ));
                    $details[] = $getData;
                }
            }
            $this->IotIntellectualProperty->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'ipList'));
    }

    public function generatedEmploymentImport(){

        $this->_userSessionCheckout();
        $this->loadModel('GeneratedEmployment');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['GeneratedEmployment']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='employment_generation.xls') {
            $data->read($this->request->data['GeneratedEmployment']["file"]['tmp_name']);
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
                    $date=date('d-m-Y',strtotime($getData[3]));
                    
					$monthYear=explode('-',$date);
					$month=date('F', mktime(0, 0, 0, $monthYear[1], 10));
					$year=$monthYear[2];
                    $emp_data[] = array('GeneratedEmployment'=>
                        array(
                            'iot_start_up_id'   =>     $this->request->data['GeneratedEmployment']["program_name_id"],
                            'mobile_no'         =>     ($getData[0]!='')?$getData[0]:'',
                            'place'             =>     ($getData[1]!='')?$getData[1]:'',
                            'other_details'     =>     ($getData[2]!='')?$getData[2]:'',
                            'email_id'          =>      $date,
                            'phase'             =>      ($getData[3]!='')?$getData[3]:'',
                            'month'             =>      $month,
                            'year'              =>   	$year,
                        ));
                    $details[] = $getData;
                }
            }
            $this->GeneratedEmployment->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('controller'=>'Home','action' => 'generatedEmploymentList'));
    }

    public function startupRisedFundsImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotStartupsRisedFund');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotStartupsRisedFund']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='iot_startup_rised_funds.xls') {
            $data->read($this->request->data['IotStartupsRisedFund']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotStartupsRisedFund'=>
                        array(
                            'iot_start_up_id'           =>     $this->request->data['IotStartupsRisedFund']["program_name_id"],
                            'date_of_funding'           =>     ($getData[0]!='')?$getData[0]:'',
                            'amount'                    =>     ($getData[1]!='')?$getData[1]:'',
                            'founder_name'              =>     ($getData[2]!='')?$getData[2]:'',
                            'public_announcement_link'  =>     ($getData[3]!='')?$getData[3]:'',
                            'phase'                     =>     ($getData[4]!='')?$getData[4]:'',
                            'month'                     =>     'Jan',
                            'year'                      =>     '2020',
                        ));
                    $details[] = $getData;
                }
            }
            $this->IotStartupsRisedFund->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this -> redirect(array('action' => 'startupRisedFundsList'));
    }

    public function iotDelegationImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotDelegation');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotDelegation']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='international_delegations.xls') {
            $data->read($this->request->data['IotDelegation']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotDelegation'=>
                        array(
                            'name'          =>    ($getData[0]!='')?$getData[0]:'',
                            'gender'        =>    ($getData[1]!='')?$getData[1]:'',
                            'arrived_from'  =>    ($getData[2]!='')?$getData[2]:'',
                            'date_of_visit' =>    ($getData[3]!='')?$getData[3]:'',
                            'no_of_people'  =>    ($getData[4]!='')?$getData[4]:'',
                            'industry_type' =>    ($getData[5]!='')?$getData[5]:'',
                            'phase' =>    ($getData[6]!='')?$getData[6]:'',
                            'month'         =>    'Jan',
                            'year'          =>    '2020',


                        ));
                    $details[] = $getData;
                }
            }
            $this->IotDelegation->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'delegationList'));
    }

    public function pilotProjectImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotPilotsProject');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotPilotsProject']["file"];


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='iot_pilot_project.xls')
        {
            $data->read($this->request->data['IotPilotsProject']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotPilotsProject'=>
                        array(
                            'iot_start_up_id'   =>  $this->request->data['IotPilotsProject']["program_name_id"],
                            'date_of_started'   =>  ($getData[0]!='')?$getData[0]:'',
                            'date_of_end'       =>  ($getData[1]!='')?$getData[1]:'',
                            'industry_category' =>  ($getData[2]!='')?$getData[2]:'',
                            'impact_expected'   =>  ($getData[3]!='')?$getData[3]:'',
                            'details'           =>  ($getData[4]!='')?$getData[4]:'',
                            'month'             =>  'Jan',
                            'year'              =>  '2020',
                        ));
                    $details[] = $getData;
                }
            }
            $this->IotPilotsProject->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'pilotsProjectList'));
    }

    public function eventsWorkshopsImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotEventWorkshop');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotEventWorkshop']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='events_workshops_conducted.xls')
        {
            $data->read($this->request->data['IotEventWorkshop']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotEventWorkshop'=>
                        array(
                            'title'         =>  ($getData[0]!='')?$getData[0]:'',
                            'date'          =>  ($getData[1]!='')?$getData[1]:'',
                            'location'      =>  ($getData[2]!='')?$getData[2]:'',
                            'no_registered' =>  ($getData[3]!='')?$getData[3]:'',
                            'no_attended'   =>  ($getData[4]!='')?$getData[4]:'',
                            'phase'   =>  ($getData[5]!='')?$getData[5]:'',
                            'month'         =>  'Jan',
                            'year'          =>  '2020',
                        ));
                    $details[] = $getData;
                }
            }
            $this->IotEventWorkshop->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this -> redirect(array('action' => 'eventWorkshopList'));
    }

    public function industriesConnectedImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotIndustryConnected');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotIndustryConnected']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='industries_connected.xls')
        {
            $data->read($this->request->data['IotIndustryConnected']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotIndustryConnected'=>
                        array(

                            'company_name'=> ($getData[0]!='')?$getData[0]:'',
                            'tech_support'=> ($getData[1]!='')?$getData[1]:'',
                            'adopter'=>    ($getData[2]!='')?$getData[2]:'',
                            'purpose'=>    ($getData[3]!='')?$getData[3]:'',
                            'phase'=>    ($getData[4]!='')?$getData[4]:'',
                            'month'=>           'Jan',
                            'year'=>           '2020',


                        ));
                    $details[] = $getData;
                }
            }
            $this->IotIndustryConnected->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'industryConnectedList'));
    }

    public function startUpImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotStartUp');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotStartUp']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='start_ups_enrolled.xls')
        {
            $data->read($this->request->data['IotStartUp']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotStartUp'=>
                        array(

                            'start_up_name'=> ($getData[0]!='')?$getData[0]:'',
                            'vertical'=> ($getData[1]!='')?$getData[1]:'',
                            'date_of_incubation'=>    ($getData[2]!='')?$getData[2]:'',
                            'date_of_graduation'=>    ($getData[3]!='')?$getData[3]:'',
                            'founder_name'=>    ($getData[4]!='')?$getData[4]:'',
                            'url'=>    ($getData[5]!='')?$getData[5]:'',
                            'founder_email'=>    ($getData[6]!='')?$getData[6]:'',
                            'mobile'=>    ($getData[7]!='')?$getData[7]:'',
                            'no_employees'=>    ($getData[8]!='')?$getData[8]:'',
                            'no_employees_women'=>    ($getData[9]!='')?$getData[9]:'',
                            'no_women_cofounder'=>    ($getData[10]!='')?$getData[10]:'',
                            'founder_education'=>    ($getData[11]!='')?$getData[11]:'',
                            'founders_total_man_year'=>    ($getData[12]!='')?$getData[12]:'',
                            'status_at_start'=>    ($getData[13]!='')?$getData[13]:'',
                            'phase'=> ($getData[14]!='')?$getData[14]:'',
                            'month'=>           'Jan',
                            'year'=>           '2020',

                        ));
                    $details[] = $getData;
                }
            }
            $this->IotStartUp->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'startUpList'));
    }

    public function academiaConnectedImport(){

        $this->_userSessionCheckout();
        $this->loadModel('IotAcademiaConnected');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['IotAcademiaConnected']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='academia_connected.xls')
        {
            $data->read($this->request->data['IotAcademiaConnected']["file"]['tmp_name']);
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
                    $emp_data[] = array('IotAcademiaConnected'=>
                        array(
                            'college_name'          =>  ($getData[0]!='')?$getData[0]:'',
                            'date_initiation_course'=>  ($getData[1]!='')? date('Y-m-d',strtotime($getData[1])):'',
                            'city'                  =>  ($getData[2]!='')?$getData[2]:'',
                            'state'                 =>  ($getData[3]!='')?$getData[3]:'',
                            'iot_curriculum'        =>  ($getData[4]!='')?$getData[4]:'',
                            'other'                 =>  ($getData[5]!='')?$getData[5]:'',
                            'phase'                 =>  ($getData[6]!='')?$getData[6]:'',
                            'month'                 =>  'Jan',
                            'year'                  =>  '2020',
                        ));
                    $details[] = $emp_data;
                }
            }

            $this->IotAcademiaConnected->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'academiaConnectedList'));
    }


    /************************* 06-11-2020 END (MDF) *************************/

    /*************************01-01-2021 Pavan Kumar M(Start)**************************/
	public function researcherIncubatedList($id=null){
		date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
		configure::write('debug',0);
        $this->_userSessionCheckout();
		
		
        if(!empty($this->request->data)) {

            if ($this->request->data['IotIncubatedResearcher']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['IotIncubatedResearcher']['type']=="edit"){
            $this->request->data = $this->IotIncubatedResearcher->read(null,$this->request->data['IotIncubatedResearcher']['id']);
			$this->request->data['IotIncubatedResearcher']['date_of_incubation'] = date('d-m-Y',strtotime($this->request->data['IotIncubatedResearcher']['date_of_incubation']));
        }

        else if($this->request->data['IotIncubatedResearcher']['type']=="delete"){
            $id=$this->request->data['IotIncubatedResearcher']['id'];

            if($this -> IotIncubatedResearcher -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['IotIncubatedResearcher']['type']=="insert"){

            if($this->request->data['IotIncubatedResearcher']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->IotIncubatedResearcher->hasAny(array("id !="=>$this->request->data['IotIncubatedResearcher']['id'],"researcher_name"=>$this->request->data['IotIncubatedResearcher']['researcher_name']));
			
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' =>$action));
            }
			
			
            $monthYear=explode('-',$this->request->data['IotIncubatedResearcher']['date_of_incubation']);
			$this->request->data['IotIncubatedResearcher']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotIncubatedResearcher']['year']=$monthYear[2];
			$this->request->data['IotIncubatedResearcher']['date_of_incubation'] = date('Y-m-d',strtotime($this->request->data['IotIncubatedResearcher']['date_of_incubation']));
			
			//print_r($this->request->data);exit();	
            $this->IotIncubatedResearcher->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action));

        }
		$manage_list = $this->IotIncubatedResearcher->find('all',array("order"=>array('IotIncubatedResearcher.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
	
	public function globalConferencePaperList($id=null){
		date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
		configure::write('debug',0);
        $this->_userSessionCheckout();
		
        if(!empty($this->request->data)) {

            if ($this->request->data['IotGlobalConferencePaper']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['IotGlobalConferencePaper']['type']=="edit"){
            $this->request->data = $this->IotGlobalConferencePaper->read(null,$this->request->data['IotGlobalConferencePaper']['id']);
			$this->request->data['IotGlobalConferencePaper']['publication_date'] = date('d-m-Y',strtotime($this->request->data['IotGlobalConferencePaper']['publication_date']));
        }

        else if($this->request->data['IotGlobalConferencePaper']['type']=="delete"){
            $id=$this->request->data['IotGlobalConferencePaper']['id'];

            if($this -> IotGlobalConferencePaper -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['IotGlobalConferencePaper']['type']=="insert"){

            if($this->request->data['IotGlobalConferencePaper']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->IotGlobalConferencePaper->hasAny(array("id !="=>$this->request->data['IotGlobalConferencePaper']['id'],"title"=>$this->request->data['IotGlobalConferencePaper']['title'],'conference_name'=>$this->request->data['IotGlobalConferencePaper']['conference_name']));
			
			
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' =>$action));
            }
			

			/*Upload Document*/
            $tmp_doc_name=$this->request->data['IotGlobalConferencePaper']['upload_doc']['tmp_name'];
            $doc_name=$this->request->data['IotGlobalConferencePaper']['upload_doc']['name'];
            $doc_name_old=$this->request->data['IotGlobalConferencePaper']['upload_doc_old'];
            $doc_type=$this->request->data['IotGlobalConferencePaper']['upload_doc']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='')
            {
                if(in_array($pdf_doc_ext,$allowed_doc_types))
                {
                    if($doc_name_old != ''){
                        unlink(WWW_ROOT."files/".$doc_name_old);
                    }

                    $new_doc_name =  date('dmYhis').'_'.$doc_name;
                    $target_doc = WWW_ROOT."files/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
					$doc_name = $new_doc_name;
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'globalConferencePaperList'));
                }
            } else {
                $doc_name = $doc_name_old;
            }
            /*Upload Document*/
			$this->request->data['IotGlobalConferencePaper']['upload_doc']=$doc_name;
			
			
            $monthYear=explode('-',$this->request->data['IotGlobalConferencePaper']['publication_date']);
			$this->request->data['IotGlobalConferencePaper']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotGlobalConferencePaper']['year']=$monthYear[2];
			$this->request->data['IotGlobalConferencePaper']['publication_date'] = date('Y-m-d',strtotime($this->request->data['IotGlobalConferencePaper']['publication_date']));

			//print_r($this->request->data);exit();	
            $this->IotGlobalConferencePaper->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action));

        }
		$manage_list = $this->IotGlobalConferencePaper->find('all',array("order"=>array('IotGlobalConferencePaper.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
	
	public function prototypeShowcasedList($id=null){
		date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
		configure::write('debug',0);
        $this->_userSessionCheckout();
		
        if(!empty($this->request->data)) {

            if ($this->request->data['IotShowcasedPrototype']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>$action));
            }
        }

        if($this->request->data['IotShowcasedPrototype']['type']=="edit"){
            $this->request->data = $this->IotShowcasedPrototype->read(null,$this->request->data['IotShowcasedPrototype']['id']);
			$this->request->data['IotShowcasedPrototype']['event_date'] = date('d-m-Y',strtotime($this->request->data['IotShowcasedPrototype']['event_date']));
			
        }

        else if($this->request->data['IotShowcasedPrototype']['type']=="delete"){
            $id=$this->request->data['IotShowcasedPrototype']['id'];

            if($this -> IotShowcasedPrototype -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => $action));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => $action));
            }
        }
        else if($this->request->data['IotShowcasedPrototype']['type']=="insert"){
	
            if($this->request->data['IotShowcasedPrototype']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

			$result= $this->IotShowcasedPrototype->hasAny(array("id !="=>$this->request->data['IotShowcasedPrototype']['id'],"prototype_name"=>$this->request->data['IotShowcasedPrototype']['prototype_name']));
			
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Data already Exists</div>");
                $this -> redirect(array('action' =>$action));
            }
			
			/*Upload photo*/
            $tmp_photo_name=$this->request->data['IotShowcasedPrototype']['photo']['tmp_name'];
            $photo_name=$this->request->data['IotShowcasedPrototype']['photo']['name'];
            $photo_name_old=$this->request->data['IotShowcasedPrototype']['photo_old'];
            $photo_type=$this->request->data['IotShowcasedPrototype']['photo']['type'];
            $new_photo_name="";
            $photo_ext = substr($photo_name, strripos($photo_name, '.')); // get file name
            $allowed_photo_types = array('.png','.PNG','.jpg','.JPG','.jpeg','.JPEG');
            if($photo_name !='')
            {
                if(in_array($photo_ext,$allowed_photo_types))
                {
                    if($photo_name_old != ''){
                        unlink(WWW_ROOT."files/".$photo_name_old);
                    }

                    $new_photo_name =  date('dmYhis').'_'.$photo_name;
                    $target_photo = WWW_ROOT."files/".$new_photo_name;
                    move_uploaded_file($tmp_photo_name,$target_photo);
					$photo_name = $new_photo_name;
                }
                else
                {
                    $message="only png,jpg and jpeg image types are allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'prototypeShowcasedList'));
                }
            } else {
                $photo_name = $photo_name_old;
            }
            /*Upload photo*/
			
			$this->request->data['IotShowcasedPrototype']['photo']=$photo_name;
			
			
            $monthYear=explode('-',$this->request->data['IotShowcasedPrototype']['event_date']);
			$this->request->data['IotShowcasedPrototype']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotShowcasedPrototype']['year']=$monthYear[2];
			$this->request->data['IotShowcasedPrototype']['event_date'] = date('Y-m-d',strtotime($this->request->data['IotShowcasedPrototype']['event_date']));

			//print_r($this->request->data);exit();	
            $this->IotShowcasedPrototype->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>$action));

        }
		$manage_list = $this->IotShowcasedPrototype->find('all',array("order"=>array('IotShowcasedPrototype.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
	
	/*************************01-01-2021 Pavan Kumar M(END)**************************/
	
	
		public function occupancy($id = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('IotOccupancy');

		$this->_userSessionCheckout();


		if (!empty($this->request->data)) {

			if ($this->request->data['IotOccupancy']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('action' => 'occupancy'));
			}
		}

		if ($this->request->data['IotOccupancy']['type'] == "edit") {
			$this->request->data = $this->IotOccupancy->read(null, $this->request->data['IotOccupancy']['id']);
			$this->request->data['IotOccupancy']['month_year'] = date('m-Y', strtotime($this->request->data['IotOccupancy']['month'] . '-' . $this->request->data['IotOccupancy']['year']));
		} else if ($this->request->data['IotOccupancy']['type'] == "delete") {
			$id = $this->request->data['IotOccupancy']['id'];

			if ($this->IotOccupancy->deleted($id)) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

				$this->redirect(array('action' => 'occupancy'));
			} else {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

				$this->redirect(array('action' => 'occupancy'));
			}
		} else if ($this->request->data['IotOccupancy']['type'] == "insert") {

			if ($this->request->data['IotOccupancy']['id']) {
				$message = "Updated Successfully";
			} else {
				$message = "Added Successfully";
			}


			$monthYear = explode('-', $this->request->data['IotOccupancy']['month_year']);
			$this->request->data['IotOccupancy']['month'] = $monthYear[0];
			$this->request->data['IotOccupancy']['year'] = $monthYear[1];

			//print_r($monthYear);exit();
			$this->IotOccupancy->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('action' => 'occupancy'));
		}
		$manage_list = $this->IotOccupancy->find('all', array("order" => array('IotOccupancy.id DESC')));
		$this->set('manage_list', $manage_list);

		$this->changeCSRFToken();
	}
	public function mentoring($id = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('IotMentoring');

		$this->_userSessionCheckout();


		if (!empty($this->request->data)) {

			if ($this->request->data['IotMentoring']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('action' => 'mentoring'));
			}
		}

		if ($this->request->data['IotMentoring']['type'] == "edit") {
			$this->request->data = $this->IotMentoring->read(null, $this->request->data['IotMentoring']['id']);
		} else if ($this->request->data['IotMentoring']['type'] == "delete") {
			$id = $this->request->data['IotMentoring']['id'];

			if ($this->IotMentoring->deleted($id)) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

				$this->redirect(array('action' => 'mentoring'));
			} else {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

				$this->redirect(array('action' => 'mentoring'));
			}
		} else if ($this->request->data['IotMentoring']['type'] == "insert") {

			if ($this->request->data['IotMentoring']['id']) {
				$message = "Updated Successfully";
			} else {
				$message = "Added Successfully";
			}


			$monthYear = explode('-', $this->request->data['IotMentoring']['date']);
			$this->request->data['IotMentoring']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotMentoring']['year'] = $monthYear[2];
			$file_tmp_name = $this->request->data['IotMentoring']['image_file']['tmp_name'];

			if ($file_tmp_name != '') {
				$file_name = $this->request->data['IotMentoring']['image_file']['name'];
				$array = explode('.', $file_name);
				$photo_ext = end($array);
				$new_file_name = '';
				$new_file_name = date('d-m-y_H-i-s') . "." . $photo_ext;
				$target = "images/iot_mentoring_" . $new_file_name;

				move_uploaded_file($file_tmp_name, WWW_ROOT . $target);
				if ($this->request->data['IotMentoring']['image'] != '') {
					$document_target = WWW_ROOT . $this->request->data['IotMentoring']['image'];
					//  print_r($document_target);
					unlink($document_target);
				}
				$this->request->data['IotMentoring']['image'] = $target;
			}

			//print_r($monthYear);exit();
			$this->IotMentoring->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('action' => 'mentoring'));
		}
		$manage_list = $this->IotMentoring->find('all', array("order" => array('IotMentoring.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->changeCSRFToken();
	}

	public function otherProgram()
	{

		$this->layout = 'fab_layout';

		$this->loadModel('IotOtherProgram');

		$this->_userSessionCheckout();

		if (!empty($this->request->data)) {

			if ($this->request->data['IotOtherProgram']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect('otherProgramList');
			}
		}
		if ($this->request->data['IotOtherProgram']['actionType'] == "edit") {
			$this->request->data = $this->IotOtherProgram->read(null, $this->request->data['IotOtherProgram']['id']);
		} else if ($this->request->data['IotOtherProgram']['actionType'] == "delete") {
			$id = $this->request->data['IotOtherProgram']['id'];

			if ($this->IotOtherProgram->deleted($id)) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

				$this->redirect(array('action' => 'otherProgramList'));
			} else {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

				$this->redirect(array('action' => 'otherProgramList'));
			}
		} else if ($this->request->data['IotOtherProgram']['actionType'] == "insert") {

			//$monthYear=explode('-',$this->request->data['IotOtherProgram']['month']);
			//$this->request->data['IotOtherProgram']['month']=$monthYear[0];
			//$this->request->data['IotOtherProgram']['year']=$monthYear[1];
			$monthYear = explode('-', $this->request->data['IotOtherProgram']['session_date']);
			$this->request->data['IotOtherProgram']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['IotOtherProgram']['year'] = $monthYear[2];
			$file_tmp_name = $this->request->data['IotOtherProgram']['image_file']['tmp_name'];

			if ($file_tmp_name != '') {
				$file_name = $this->request->data['IotOtherProgram']['image_file']['name'];
				$array = explode('.', $file_name);
				$photo_ext = end($array);
				$new_file_name = '';
				$new_file_name = date('d-m-y_H-i-s').".".$photo_ext;
				$target = "images/iot_other_program_" . $new_file_name;

				move_uploaded_file($file_tmp_name, WWW_ROOT.$target);
				if($this->request->data['IotOtherProgram']['image']!=''){
					$document_target = WWW_ROOT.$this->request->data['IotOtherProgram']['image'];
                    //  print_r($document_target);
                    unlink($document_target);
				}
				$this->request->data['IotOtherProgram']['image']=$target;
			}

			if ($this->request->data['IotOtherProgram']['id']) {
				$message = "Iot Start Up Updated Successfully";
			} else {
				$message = "Iot StartUp Added Successfully";
			}
			$this->IotOtherProgram->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> " . $message . ".</div>");
			$this->redirect(array('action' => 'otherProgramList'));
		}

		$this->changeCSRFToken();
	}
	public function otherProgramList()
	{
		$this->layout = 'fab_layout';
		$this->loadModel('IotOtherProgram');
		$this->_userSessionCheckout();
		$data_list = $this->IotOtherProgram->find('all', ['order' => ['id DESC']]);
		$this->set('data_list', $data_list);
	}
}
