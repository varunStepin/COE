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
class DsAndAiController extends AppController {


	public $uses = array('ParticipantsDetail','DsAiTrainedProfessional');
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');



    public function reportPublished($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsReportPublished');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsReportPublished']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'reportPublished'));
            }
            if($this->request->data['DsReportPublished']['type']=="edit"){
                $this->request->data = $this->DsReportPublished->read(null,$this->request->data['DsReportPublished']['id']);
                $this->request->data['DsReportPublished']['month']=$this->request->data['DsReportPublished']['month'].'-'.$this->request->data['DsReportPublished']['year'];
            }
            else if($this->request->data['DsReportPublished']['type']=="delete"){
                $hackathon_id=$this->request->data['DsReportPublished']['id'];

                if($this -> DsReportPublished -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                    $this -> redirect(array('action' => 'reportPublished'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                    $this -> redirect(array('action' => 'reportPublished'));
                }
            }
            else if($this->request->data['DsReportPublished']['type']=="insert" ){

                if($this->request->data['DsReportPublished']['id']){
                    $message=" Reports Published Updated Successfully";
                }
                else{
                    $message=" Reports Published Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsReportPublished']['published_date']);
			    $this->request->data['DsReportPublished']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsReportPublished']['year']=$monthYear[2];

                $this->DsReportPublished->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'reportPublished'));

            }
        }

        $table_list = $this->DsReportPublished->find('all',array('order'=>array('DsReportPublished.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function reportProcess($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsReportProcess');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsReportProcess']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'reportProcess'));
            }
            if($this->request->data['DsReportProcess']['type']=="edit"){
                $this->request->data = $this->DsReportProcess->read(null,$this->request->data['DsReportProcess']['id']);
                $this->request->data['DsReportProcess']['month']=$this->request->data['DsReportProcess']['month'].'-'.$this->request->data['DsReportProcess']['year'];
            }
            else if($this->request->data['DsReportProcess']['type']=="delete"){
                $hackathon_id=$this->request->data['DsReportProcess']['id'];

                if($this -> DsReportProcess -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'reportProcess'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'reportProcess'));
                }
            }
            else if($this->request->data['DsReportProcess']['type']=="insert" ){

                if($this->request->data['DsReportProcess']['id']){
                    $message=" Reports Process Updated Successfully";
                }
                else{
                    $message=" Reports Process Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsReportProcess']['tentative_date']);
			    $this->request->data['DsReportProcess']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsReportProcess']['year']=$monthYear[2];

                $this->DsReportProcess->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'reportProcess'));

            }
        }

        $table_list = $this->DsReportProcess->find('all',array('order'=>array('DsReportProcess.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function solutionProposed($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsSolutionProposed');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsSolutionProposed']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'solutionProposed'));
            }
            if($this->request->data['DsSolutionProposed']['type']=="edit"){
                $this->request->data = $this->DsSolutionProposed->read(null,$this->request->data['DsSolutionProposed']['id']);
                $this->request->data['DsSolutionProposed']['month']=$this->request->data['DsSolutionProposed']['month'].'-'.$this->request->data['DsSolutionProposed']['year'];
            }
            else if($this->request->data['DsSolutionProposed']['type']=="delete"){
                $hackathon_id=$this->request->data['DsSolutionProposed']['id'];

                if($this -> DsSolutionProposed -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'solutionProposed'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'solutionProposed'));
                }
            }
            else if($this->request->data['DsSolutionProposed']['type']=="insert" ){

                if($this->request->data['DsSolutionProposed']['id']){
                    $message=" Solution Proposed Updated Successfully";
                }
                else{
                    $message=" Solution Proposed Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsSolutionProposed']['month']);
                $this->request->data['DsSolutionProposed']['month']=$monthYear[0];
                $this->request->data['DsSolutionProposed']['year']=$monthYear[1];

                $this->DsSolutionProposed->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'solutionProposed'));

            }
        }

        $table_list = $this->DsSolutionProposed->find('all',array('order'=>array('DsSolutionProposed.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }



    public function studentsTrained() {

        $this->layout = 'fab_layout';

        $this->loadModel('DsAiTrainedStudent');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['DsAiTrainedStudent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['DsAiTrainedStudent']['actionType']=="edit"){
            $this->request->data = $this->DsAiTrainedStudent->read(null,$this->request->data['DsAiTrainedStudent']['id']);
            $this->request->data['DsAiTrainedStudent']['month']=$this->request->data['DsAiTrainedStudent']['month'].'-'.$this->request->data['DsAiTrainedStudent']['year'];
        }
        else if($this->request->data['DsAiTrainedStudent']['actionType']=="delete"){
            $id=$this->request->data['DsAiTrainedStudent']['id'];

            if($this -> DsAiTrainedStudent -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'studentsTrainedList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'studentsTrainedList'));
            }
        }
        else if($this->request->data['DsAiTrainedStudent']['actionType']=="insert"){

            $monthYear=explode('-',$this->request->data['DsAiTrainedStudent']['month']);

			$this->request->data['DsAiTrainedStudent']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
            $this->request->data['DsAiTrainedStudent']['year']=$monthYear[2];
            $date = $this->request->data['DsAiTrainedStudent']['date_initiation_course'] ;
            $this->request->data['DsAiTrainedStudent']['date_initiation_course'] = $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['DsAiTrainedStudent']['id']){
                $message="Student Details Updated Successfully";
            }
            else{
                $message="Student Details Added Successfully";
            }
            $this->DsAiTrainedStudent->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'studentsTrainedList'));
        }

        $this->changeCSRFToken();
    }
    public function studentsTrainedList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsAiTrainedStudent');
        $data_list = $this->DsAiTrainedStudent->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);
    }

    public function facultiesTrained() {

        $this->layout = 'fab_layout';

        $this->loadModel('DsAiTrainedFaculty');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['DsAiTrainedFaculty']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['DsAiTrainedFaculty']['actionType']=="edit"){
            $this->request->data = $this->DsAiTrainedFaculty->read(null,$this->request->data['DsAiTrainedFaculty']['id']);
            $this->request->data['DsAiTrainedFaculty']['month']=$this->request->data['DsAiTrainedFaculty']['month'].'-'.$this->request->data['DsAiTrainedFaculty']['year'];
        }
        else if($this->request->data['DsAiTrainedFaculty']['actionType']=="delete"){
            $id=$this->request->data['DsAiTrainedFaculty']['id'];

            if($this -> DsAiTrainedFaculty -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'facultiesTrainedList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'facultiesTrainedList'));
            }
        }
        else if($this->request->data['DsAiTrainedFaculty']['actionType']=="insert"){

            $monthYear=explode('-',$this->request->data['DsAiTrainedFaculty']['month']);
            $this->request->data['DsAiTrainedFaculty']['month']=$monthYear[0];
            $this->request->data['DsAiTrainedFaculty']['year']=$monthYear[1];
            $date = $this->request->data['DsAiTrainedFaculty']['date_initiation_course'] ;
            $this->request->data['DsAiTrainedFaculty']['date_initiation_course'] = $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['DsAiTrainedFaculty']['id']){
                $message="Faculties Updated Successfully";
            }
            else{
                $message="Faculties Added Successfully";
            }
            $this->DsAiTrainedFaculty->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'facultiesTrainedList'));
        }

        $this->changeCSRFToken();
    }
    public function facultiesTrainedList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsAiTrainedFaculty');
        $data_list = $this->DsAiTrainedFaculty->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);
    }

    public function professionalsTrained() {

        $this->layout = 'fab_layout';

        $this->loadModel('DsAiTrainedProfessional');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['DsAiTrainedProfessional']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['DsAiTrainedProfessional']['actionType']=="edit"){
            $this->request->data = $this->DsAiTrainedProfessional->read(null,$this->request->data['DsAiTrainedProfessional']['id']);
            $this->request->data['DsAiTrainedProfessional']['month']=$this->request->data['DsAiTrainedProfessional']['month'].'-'.$this->request->data['DsAiTrainedProfessional']['year'];
        }
        else if($this->request->data['DsAiTrainedProfessional']['actionType']=="delete"){
            $id=$this->request->data['DsAiTrainedProfessional']['id'];

            if($this -> DsAiTrainedProfessional -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'professionalsTrainedList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'professionalsTrainedList'));
            }
        }
        else if($this->request->data['DsAiTrainedProfessional']['actionType']=="insert"){

            $monthYear=explode('-',$this->request->data['DsAiTrainedProfessional']['month']);
            $this->request->data['DsAiTrainedProfessional']['month']=$monthYear[0];
            $this->request->data['DsAiTrainedProfessional']['year']=$monthYear[1];
            $date = $this->request->data['DsAiTrainedProfessional']['date_initiation_course'] ;
            $this->request->data['DsAiTrainedProfessional']['date_initiation_course'] = $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['DsAiTrainedProfessional']['id']){
                $message="Professionals Updated Successfully";
            }
            else{
                $message="Professionals Added Successfully";
            }
            $this->DsAiTrainedProfessional->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'professionalsTrainedList'));
        }

        $this->changeCSRFToken();
    }
    public function professionalsTrainedList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsAiTrainedProfessional');
        $data_list = $this->DsAiTrainedProfessional->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);
    }




    public function startupsAcceleratedPhysical() {

        $this->layout = 'fab_layout';

        $this->loadModel('DsAiPhyAccStartup');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['DsAiPhyAccStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['DsAiPhyAccStartup']['actionType']=="edit"){
            $this->request->data = $this->DsAiPhyAccStartup->read(null,$this->request->data['DsAiPhyAccStartup']['id']);
            $this->request->data['DsAiPhyAccStartup']['month']=$this->request->data['DsAiPhyAccStartup']['month'].'-'.$this->request->data['DsAiPhyAccStartup']['year'];
        }
        else if($this->request->data['DsAiPhyAccStartup']['actionType']=="delete"){
            $id=$this->request->data['DsAiPhyAccStartup']['id'];

            if($this -> DsAiPhyAccStartup -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'startupsAcceleratedPhysicalList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'startupsAcceleratedPhysicalList'));
            }
        }
        else if($this->request->data['DsAiPhyAccStartup']['actionType']=="insert"){

            $monthYear=explode('-',$this->request->data['DsAiPhyAccStartup']['month']);
            $this->request->data['DsAiPhyAccStartup']['month']=$monthYear[0];
            $this->request->data['DsAiPhyAccStartup']['year']=$monthYear[1];
            if($this->request->data['DsAiPhyAccStartup']['id']){
                $message="Iot Start Up Updated Successfully";
            }
            else{
                $message="Iot StartUp Added Successfully";
            }
            $this->DsAiPhyAccStartup->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'startupsAcceleratedPhysicalList'));
        }

        $this->changeCSRFToken();
    }
    public function startupsAcceleratedPhysicalList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsAiPhyAccStartup');
        $data_list = $this->DsAiPhyAccStartup->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }

    public function startupsAcceleratedVirtual() {

        $this->layout = 'fab_layout';

        $this->loadModel('DsAiVirtualAccStartup');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['DsAiVirtualAccStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }
        if($this->request->data['DsAiVirtualAccStartup']['actionType']=="edit"){
            $this->request->data = $this->DsAiVirtualAccStartup->read(null,$this->request->data['DsAiVirtualAccStartup']['id']);
            $this->request->data['DsAiVirtualAccStartup']['month']=$this->request->data['DsAiVirtualAccStartup']['month'].'-'.$this->request->data['DsAiVirtualAccStartup']['year'];
        }
        else if($this->request->data['DsAiVirtualAccStartup']['actionType']=="delete"){
            $id=$this->request->data['DsAiVirtualAccStartup']['id'];

            if($this -> DsAiVirtualAccStartup -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'startupsAcceleratedVirtualList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'startupsAcceleratedVirtualList'));
            }
        }
        else if($this->request->data['DsAiVirtualAccStartup']['actionType']=="insert"){

            $monthYear=explode('-',$this->request->data['DsAiVirtualAccStartup']['month']);
            $this->request->data['DsAiVirtualAccStartup']['month']=$monthYear[0];
            $this->request->data['DsAiVirtualAccStartup']['year']=$monthYear[1];
            if($this->request->data['DsAiVirtualAccStartup']['id']){
                $message="Iot Start Up Updated Successfully";
            }
            else{
                $message="Iot StartUp Added Successfully";
            }
            $this->DsAiVirtualAccStartup->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'startupsAcceleratedVirtualList'));
        }

        $this->changeCSRFToken();
    }
    public function startupsAcceleratedVirtualList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsAiVirtualAccStartup');
        $data_list = $this->DsAiVirtualAccStartup->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }
     /************************* 08-09-2020 F1 ****************************/
    public function masterClasses($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsMasterClass');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsMasterClass']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'masterClasses'));
            }
            if($this->request->data['DsMasterClass']['type']=="edit"){
                $this->request->data = $this->DsMasterClass->read(null,$this->request->data['DsMasterClass']['id']);
                $this->request->data['DsMasterClass']['month']=$this->request->data['DsMasterClass']['month'].'-'.$this->request->data['DsMasterClass']['year'];
            }
            else if($this->request->data['DsMasterClass']['type']=="delete"){
                $hackathon_id=$this->request->data['DsMasterClass']['id'];

                if($this -> DsMasterClass -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'masterClasses'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'masterClasses'));
                }
            }
            else if($this->request->data['DsMasterClass']['type']=="insert" ){

                if($this->request->data['DsMasterClass']['id']){
                    $message=" Master Classes Updated Successfully";
                }
                else{
                    $message=" Master Classes Added Successfully";
                }

                 $monthYear=explode('-',$this->request->data['DsMasterClass']['date']);
			    $this->request->data['DsMasterClass']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsMasterClass']['year']=$monthYear[2];

                $this->DsMasterClass->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'masterClasses'));
            }
        }

        $table_list = $this->DsMasterClass->find('all',array('order'=>array('DsMasterClass.id DESC')));
        $this->set('table_list',$table_list);
        $this->changeCSRFToken();
    }


    public function aiPathshala($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsAiPathshala');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsAiPathshala']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'aiPathshala'));
            }
            if($this->request->data['DsAiPathshala']['type']=="edit"){
                $this->request->data = $this->DsAiPathshala->read(null,$this->request->data['DsAiPathshala']['id']);
                $this->request->data['DsAiPathshala']['month']=$this->request->data['DsAiPathshala']['month'].'-'.$this->request->data['DsAiPathshala']['year'];
            }
            else if($this->request->data['DsAiPathshala']['type']=="delete"){
                $hackathon_id=$this->request->data['DsAiPathshala']['id'];

                if($this -> DsAiPathshala -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'aiPathshala'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'aiPathshala'));
                }
            }
            else if($this->request->data['DsAiPathshala']['type']=="insert" ){

                if($this->request->data['DsAiPathshala']['id']){
                    $message=" AI Pathshala Updated Successfully";
                }
                else{
                    $message=" AI Pathshala Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsAiPathshala']['date']);
			    $this->request->data['DsAiPathshala']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsAiPathshala']['year']=$monthYear[2];

                $this->DsAiPathshala->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'aiPathshala'));
            }
        }
        $table_list = $this->DsAiPathshala->find('all',array('order'=>array('DsAiPathshala.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }



    public function techMentoring($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsTechMentoring');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsTechMentoring']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'techMentoring'));
            }
            if($this->request->data['DsTechMentoring']['type']=="edit"){
                $this->request->data = $this->DsTechMentoring->read(null,$this->request->data['DsTechMentoring']['id']);
                $this->request->data['DsTechMentoring']['month']=$this->request->data['DsTechMentoring']['month'].'-'.$this->request->data['DsTechMentoring']['year'];
            }
            else if($this->request->data['DsTechMentoring']['type']=="delete"){
                $hackathon_id=$this->request->data['DsTechMentoring']['id'];

                if($this -> DsTechMentoring -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'techMentoring'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'techMentoring'));
                }
            }
            else if($this->request->data['DsTechMentoring']['type']=="insert" ){

                if($this->request->data['DsTechMentoring']['id']){
                    $message=" Tech Mentoring Updated Successfully";
                }
                else{
                    $message=" Tech Mentoring Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsTechMentoring']['date']);
			    $this->request->data['DsTechMentoring']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsTechMentoring']['year']=$monthYear[2];

                $this->DsTechMentoring->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'techMentoring'));

            }
        }

        $table_list = $this->DsTechMentoring->find('all',array('order'=>array('DsTechMentoring.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function investorConnect($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsInvestorConnect');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsInvestorConnect']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'investorConnect'));
            }
            if($this->request->data['DsInvestorConnect']['type']=="edit"){
                $this->request->data = $this->DsInvestorConnect->read(null,$this->request->data['DsInvestorConnect']['id']);
                $this->request->data['DsInvestorConnect']['month']=$this->request->data['DsInvestorConnect']['month'].'-'.$this->request->data['DsInvestorConnect']['year'];
            }
            else if($this->request->data['DsInvestorConnect']['type']=="delete"){
                $hackathon_id=$this->request->data['DsInvestorConnect']['id'];

                if($this -> DsInvestorConnect -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'investorConnect'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'investorConnect'));
                }
            }
            else if($this->request->data['DsInvestorConnect']['type']=="insert" ){

                if($this->request->data['DsInvestorConnect']['id']){
                    $message=" Investor Connect Updated Successfully";
                }
                else{
                    $message=" Investor Connect Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsInvestorConnect']['date']);
			    $this->request->data['DsInvestorConnect']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['DsInvestorConnect']['year']=$monthYear[2];

                $this->DsInvestorConnect->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'investorConnect'));

            }
        }

        $table_list = $this->DsInvestorConnect->find('all',array('order'=>array('DsInvestorConnect.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }


    public function solutionsAdopted($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('DsSolutionsAdopted');

        if(!empty($this->request->data)) {
            if ($this->request->data['DsSolutionsAdopted']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'solutionsAdopted'));
            }
            if($this->request->data['DsSolutionsAdopted']['type']=="edit"){
                $this->request->data = $this->DsSolutionsAdopted->read(null,$this->request->data['DsSolutionsAdopted']['id']);
                $this->request->data['DsSolutionsAdopted']['month']=$this->request->data['DsSolutionsAdopted']['month'].'-'.$this->request->data['DsSolutionsAdopted']['year'];
            }
            else if($this->request->data['DsSolutionsAdopted']['type']=="delete"){
                $hackathon_id=$this->request->data['DsSolutionsAdopted']['id'];

                if($this -> DsSolutionsAdopted -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'solutionsAdoptedList'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'solutionsAdoptedList'));
                }
            }
            else if($this->request->data['DsSolutionsAdopted']['type']=="insert" ){

                if($this->request->data['DsSolutionsAdopted']['id']){
                    $message=" Solutions Adopted Updated Successfully";
                }
                else{
                    $message=" Solutions Adopted Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsSolutionsAdopted']['date']);
                $this->request->data['DsSolutionsAdopted']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['DsSolutionsAdopted']['year']=$monthYear[2];
				//print_r($this->request->data['DsSolutionsAdopted']['month']);
                $this->DsSolutionsAdopted->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
               // $this -> redirect(array('action' => 'solutionsAdoptedList'));
            }
        }

        $this->changeCSRFToken();
    }
    public function solutionsAdoptedList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('DsSolutionsAdopted');
        $table_list = $this->DsSolutionsAdopted->find('all',array('order'=>array('DsSolutionsAdopted.id DESC')));
        $this->set('table_list',$table_list);
    }

    public function hackathons($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $this->loadModel('DsHackathon');

        if(!empty($this->request->data)) {

            if ($this->request->data['DsHackathon']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'hackathons'));
            }
            if($this->request->data['DsHackathon']['type']=="edit"){
                $this->request->data = $this->DsHackathon->read(null,$this->request->data['DsHackathon']['id']);
                $this->request->data['DsHackathon']['month']=$this->request->data['DsHackathon']['month'].'-'.$this->request->data['DsHackathon']['year'];
            }
            else if($this->request->data['DsHackathon']['type']=="delete"){
                $hackathon_id=$this->request->data['DsHackathon']['id'];

                if($this -> DsHackathon -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'hackathons'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'hackathons'));
                }
            }
            else if($this->request->data['DsHackathon']['type']=="insert" ){

                if($this->request->data['DsHackathon']['id']){
                    $message=" Hackathons Updated Successfully";
                }
                else{
                    $message=" Hackathons Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['DsHackathon']['date']);
			    $this->request->data['DsHackathon']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
		    	$this->request->data['DsHackathon']['year']=$monthYear[2];

                $this->DsHackathon->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'hackathons'));

            }
        }

        $table_list = $this->DsHackathon->find('all',array('order'=>array('DsHackathon.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function hackathonParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        $this->loadModel('DsHackathon');
        $this->loadModel('DsHackathonParticipant');
        $this->getDsAiHackathons();

        if($this->request->data['DsHackathonParticipant']['type']=="insert")
        {
            //print_r($this->request->data['DsHackathonParticipant']);
            // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "DsHackathonParticipant"=>array(
                        "ds_hackathon_id"=>$this->request->data['DsHackathonParticipant']['ds_hackathon_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "organization"=>$this->request->data['organization'][$i],

                    )
                );
                $this->DsHackathonParticipant->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'hackathonParticipantsList'));
        }


        elseif($this->request->data['DsHackathonParticipant']['csrf_token']!=""){
            if ($this->request->data['DsHackathonParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'icParticipants'));

            }
        }
        $this->changeCSRFToken();
    }

    public function hackathonParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $this->loadModel('DsHackathonParticipant');
        if($this->request->data['DsHackathonParticipant']['type']=="delete"){
            $hackathon_id=$this->request->data['DsHackathonParticipant']['id'];
            if($this ->DsHackathonParticipant-> delete($hackathon_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'hackathonParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'hackathonParticipantsList'));
            }
        }
        else{
            $this->DsHackathonParticipant->bindModel(array('belongsTo'=>array("DsHackathon")));
            $participants_list = $this->DsHackathonParticipant->find('all',array(
                'order'=>array('DsHackathonParticipant.id DESC')),array(

            ));
            $this->set('participants_list',$participants_list);
              //print_r($participants_list);
        }
    }
    public function hackathonParticipantsImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsHackathonParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsHackathonParticipant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='hackathonParticipants.xls')
        {
            $data->read($this->request->data['DsHackathonParticipant']["file"]['tmp_name']);
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


                    $emp_data[] = array('DsHackathonParticipant'=>
                        array(

                            'ds_hackathon_id'=>$this->request->data['DsHackathonParticipant']["program_id"],
                            'participant_name'=>        ($getData[0]!='')?$getData[0]:'',
                            'gender'=>    ($getData[1]!='')?$getData[1]:'',
                            'contact_number'=>          ($getData[2]!='')?$getData[2]:'',
                            'email'=>  ($getData[3]!='')?$getData[3]:'',
                            'organization'=>           ($getData[4]!='')?$getData[4]:'',


                        ));
                    $details[] = $getData;
                }
            }
            $this->DsHackathonParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        $this -> redirect(array('action' => 'hackathonParticipantsList'));
    }

    public function masterClassAiPathsalaParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        $this->loadModel('DsHackathon');
        $this->loadModel('DsHackathonParticipant');
        $this->getDsAiHackathons();

        if($this->request->data['DsHackathonParticipant']['type']=="insert")
        {
            //print_r($this->request->data['DsHackathonParticipant']);
            // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "DsHackathonParticipant"=>array(
                        "ds_hackathon_id"=>$this->request->data['DsHackathonParticipant']['ds_hackathon_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "organization"=>$this->request->data['organization'][$i],

                    )
                );
                $this->DsHackathonParticipant->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'hackathonParticipantsList'));
        }


        elseif($this->request->data['DsHackathonParticipant']['csrf_token']!=""){
            if ($this->request->data['DsHackathonParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'icParticipants'));

            }
        }
        $this->changeCSRFToken();
    }


    public function msParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();


        $this->loadModel('DsMasterClass');
        $this->loadModel('DsMsAiParticipant');
        $this->getDsMasterClass();

        if($this->request->data['DsMsAiParticipant']['type']=="insert")
        {
            // print_r($this->request->data['DsHackathonParticipant']);
            // return;
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++)
            {
                $data = array(
                    "DsMsAiParticipant"=>array(
                        "program_type"=>'DsMasterClass',
                        "program_id"=>$this->request->data['DsMsAiParticipant']['ds_master_class_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "organization"=>$this->request->data['organization'][$i],

                    )
                );
                $this->DsMsAiParticipant->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'msParticipantsList'));
        }


        elseif($this->request->data['DsMsAiParticipant']['csrf_token']!=""){
            if ($this->request->data['DsMsAiParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'msParticipants'));

            }
        }
        $this->changeCSRFToken();
    }
    public function msParticipantsList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $this->loadModel('DsMsAiParticipant');
        if($this->request->data['DsMsAiParticipant']['type']=="delete"){
            $hackathon_id=$this->request->data['DsMsAiParticipant']['id'];
            if($this ->DsMsAiParticipant-> delete($hackathon_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'msParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'msParticipantsList'));
            }
        }
        else{
            $this->DsMsAiParticipant->bindModel(array('belongsTo'=>array("DsMasterClass"=>array('foreignKey'=>'program_id'))));
            $participants_list = $this->DsMsAiParticipant->find('all',array(
                'conditions'=>array('program_type'=>'DsMasterClass'),
                'order'=>array('DsMsAiParticipant.id DESC')),array(
            ));
            $this->set('participants_list',$participants_list);
            //print_r($participants_list);
        }
    }


    public function aiPathshalaParticipants($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $this->loadModel('DsAiPathshala');
        $this->loadModel('DsMsAiParticipant');
        $this->getDsAiPathshala();

        if($this->request->data['DsMsAiParticipant']['type']=="insert") {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++) {
                $data = array(
                    "DsMsAiParticipant"=>array(
                        "program_type"=>'DsAiPathshala',
                        "program_id"=>$this->request->data['DsMsAiParticipant']['ds_pathshala_id'],
                        "participant_name"=>$this->request->data['participant_name'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "email"=>$this->request->data['email'][$i],
                        "organization"=>$this->request->data['organization'][$i],
                    )
                );
                $this->DsMsAiParticipant->saveAll($data);
            }
            $message=" Participant Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'aiPathshalaParticipantsList'));
        }

        else if($this->request->data['DsMsAiParticipant']['csrf_token']!=""){
            if($this->request->data['DsMsAiParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'msParticipants'));
            }
        }
        $this->changeCSRFToken();
    }

    public function aiPathshalaParticipantsList($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();

        $this->loadModel('DsMsAiParticipant');
        if($this->request->data['DsMsAiParticipant']['type']=="delete"){
            $hackathon_id=$this->request->data['DsMsAiParticipant']['id'];
            if($this ->DsMsAiParticipant-> delete($hackathon_id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'aiPathshalaParticipantsList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'aiPathshalaParticipantsList'));
            }
        }
        else{
            $this->DsMsAiParticipant->bindModel(array('belongsTo'=>array("DsAiPathshala"=>array('foreignKey'=>'program_id'))));
            $participants_list = $this->DsMsAiParticipant->find('all',array(
                'conditions'=>array('program_type'=>'DsAiPathshala'),
                'order'=>array('DsMsAiParticipant.id DESC')),array(
            ));
            $this->set('participants_list',$participants_list);
        }
    }


    public function masterClassAipathsalaParticipantsImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsMsAiParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsMsAiParticipant']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='MsAiParticipants.xls') {
            $data->read($this->request->data['DsMsAiParticipant']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsMsAiParticipant'=>
                        array(
                            'program_id'         =>   $this->request->data['DsMsAiParticipant']["program_id"],
                            'program_type'       =>   $this->request->data['DsMsAiParticipant']["program_type"],
                            'participant_name'   =>   ($getData[0]!='')?$getData[0]:'',
                            'gender'             =>   ($getData[1]!='')?$getData[1]:'',
                            'contact_number'     =>   ($getData[2]!='')?$getData[2]:'',
                            'email'              =>   ($getData[3]!='')?$getData[3]:'',
                            'organization'       =>   ($getData[4]!='')?$getData[4]:'',
                        ));
                    $details[] = $getData;
                }
            }
            $this->DsMsAiParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => $this->request->data['DsMsAiParticipant']["back_url"]));
    }

    public function trainedStudentImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsAiTrainedStudent');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsAiTrainedStudent']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_ai_student_trained.xls') {
            $data->read($this->request->data['DsAiTrainedStudent']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsAiTrainedStudent'=>
                        array(
                            'student_name'   =>   ($getData[0]!='') ? $getData[0] : '',
                            'gender'         =>   ($getData[1]!='') ? $getData[1] : '',
                            'collage_name'   =>   ($getData[2]!='') ? $getData[2] : '',
                            'branch'         =>   ($getData[3]!='') ? $getData[3] : '',
                            'contact_number' =>   ($getData[4]!='') ? $getData[4] : '',
                            'email'          =>   ($getData[5]!='') ? $getData[5] : '',
                            'city'           =>   ($getData[6]!='') ? $getData[6] : '',
                            'phase'           =>  ($getData[7]!='') ? $getData[7] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsAiTrainedStudent->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Students Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'studentsTrainedList'));
    }


    public function trainedFacultyImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsAiTrainedFaculty');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsAiTrainedFaculty']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_ai_faculty_trained.xls') {
            $data->read($this->request->data['DsAiTrainedFaculty']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsAiTrainedFaculty'=>
                        array(
                            'name'   =>   ($getData[0]!='') ? $getData[0] : '',
                            'gender'         =>   ($getData[1]!='') ? $getData[1] : '',
                            'collage_name'   =>   ($getData[2]!='') ? $getData[2] : '',
                            'branch'         =>   ($getData[3]!='') ? $getData[3] : '',
                            'contact_number' =>   ($getData[4]!='') ? $getData[4] : '',
                            'email'          =>   ($getData[5]!='') ? $getData[5] : '',
                            'city'           =>   ($getData[6]!='') ? $getData[6] : '',
                            'phase'           =>   ($getData[7]!='') ? $getData[7] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsAiTrainedFaculty->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Faculties Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'facultiesTrainedList'));
    }

	public function trainedProfessionalImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsAiTrainedProfessional');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsAiTrainedProfessional']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_ai_professional_trained.xls') {
            $data->read($this->request->data['DsAiTrainedProfessional']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsAiTrainedProfessional'=>
                        array(
                            'name'   =>   ($getData[0]!='') ? $getData[0] : '',
                            'gender'         =>   ($getData[1]!='') ? $getData[1] : '',
                            'collage_name'   =>   ($getData[2]!='') ? $getData[2] : '',
                            'branch'         =>   ($getData[3]!='') ? $getData[3] : '',
                            'contact_number' =>   ($getData[4]!='') ? $getData[4] : '',
                            'email'          =>   ($getData[5]!='') ? $getData[5] : '',
                            'city'           =>   ($getData[6]!='') ? $getData[6] : '',
                            'phase'           =>   ($getData[7]!='') ? $getData[7] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsAiTrainedProfessional->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Professionals trainies Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'professionalsTrainedList'));
    }

	public function investorConnectImport(){

        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsInvestorConnect');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsInvestorConnect']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_ai_investor_connect.xls') {
            $data->read($this->request->data['DsInvestorConnect']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsInvestorConnect'=>
                        array(
                            'date'   =>   ($getData[0]!='') ? $getData[0] : '',
                            'investor_name'         =>   ($getData[1]!='') ? $getData[1] : '',
                            'startup'   =>   ($getData[2]!='') ? $getData[2] : '',
                           'phase'   =>   ($getData[3]!='') ? $getData[3] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsInvestorConnect->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'investorConnect'));
    }

	public function startupsAcceleratedPhysicalImport(){
        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsAiPhyAccStartup');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsAiPhyAccStartup']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_start_ups_accelerated_physical.xls') {
            $data->read($this->request->data['DsAiPhyAccStartup']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsAiPhyAccStartup'=>
                        array(
                            'start_up_name'	=>   ($getData[0]!='') ? $getData[0] : '',
                            'date_of_incubation'  =>   ($getData[1]!='') ? $getData[1] : '',
                            'date_of_graduation'   =>   ($getData[2]!='') ? $getData[2] : '',
                            'founder_name'   =>   ($getData[3]!='') ? $getData[3] : '',
                            'url'   =>   ($getData[4]!='') ? $getData[4] : '',
                            'founder_email'   =>   ($getData[5]!='') ? $getData[5] : '',
                            'mobile'   =>   ($getData[6]!='') ? $getData[6] : '',
                            'no_employees'   =>   ($getData[7]!='') ? $getData[7] : '',
                            'no_employees_women'   =>   ($getData[8]!='') ? $getData[8] : '',
                            'no_women_cofounder'   =>   ($getData[9]!='') ? $getData[9] : '',
                            'founder_education'   =>   ($getData[10]!='') ? $getData[10] : '',
                            'founders_total_man_year'   =>   ($getData[11]!='') ? $getData[11] : '',
                            'valuation_at_start'   =>   ($getData[12]!='') ? $getData[12] : '',
                            'valuation_current'   =>   ($getData[13]!='') ? $getData[13] : '',
                            'head_count_at_start'   =>   ($getData[14]!='') ? $getData[14] : '',
                            'head_count_current'   =>   ($getData[15]!='') ? $getData[15] : '',
                            'status_at_start'   =>   ($getData[16]!='') ? $getData[16] : '',
                            'phase'   =>   ($getData[17]!='') ? $getData[17] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsAiPhyAccStartup->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'startupsAcceleratedPhysicalList'));
    }

	public function startupsAcceleratedVirtualImport(){
        $this->_userSessionCheckout();
        // Configure::write('debug',2);
        $this->loadModel('DsAiVirtualAccStartup');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['DsAiVirtualAccStartup']["file"];
        //print_r($this->request->data);


        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='ds_start_ups_accelerated_virtual.xls') {
            $data->read($this->request->data['DsAiVirtualAccStartup']["file"]['tmp_name']);
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
                    $emp_data[] = array('DsAiVirtualAccStartup'=>
                        array(
                            'start_up_name'	=>   ($getData[0]!='') ? $getData[0] : '',
                            'date_of_incubation'  =>   ($getData[1]!='') ? $getData[1] : '',
                            'date_of_graduation'   =>   ($getData[2]!='') ? $getData[2] : '',
                            'founder_name'   =>   ($getData[3]!='') ? $getData[3] : '',
                            'url'   =>   ($getData[4]!='') ? $getData[4] : '',
                            'founder_email'   =>   ($getData[5]!='') ? $getData[5] : '',
                            'mobile'   =>   ($getData[6]!='') ? $getData[6] : '',
                            'no_employees'   =>   ($getData[7]!='') ? $getData[7] : '',
                            'no_employees_women'   =>   ($getData[8]!='') ? $getData[8] : '',
                            'no_women_cofounder'   =>   ($getData[9]!='') ? $getData[9] : '',
                            'founder_education'   =>   ($getData[10]!='') ? $getData[10] : '',
                            'founders_total_man_year'   =>   ($getData[11]!='') ? $getData[11] : '',
                            'valuation_at_start'   =>   ($getData[12]!='') ? $getData[12] : '',
                            'valuation_current'   =>   ($getData[13]!='') ? $getData[13] : '',
                            'head_count_at_start'   =>   ($getData[14]!='') ? $getData[14] : '',
                            'head_count_current'   =>   ($getData[15]!='') ? $getData[15] : '',
                            'status_at_start'   =>   ($getData[16]!='') ? $getData[16] : '',
                            'phase'   =>   ($getData[17]!='') ? $getData[17] : '',
                            'month'          =>   date('F'),
                            'year'           =>   date('Y'),

                        ));
                    $details[] = $getData;
                }
            }

            $this->DsAiVirtualAccStartup->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");

        }
        fclose($file);
        return $this->redirect(array('action' => 'startupsAcceleratedVirtualList'));
    }
    
}
