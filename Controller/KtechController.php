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
class KtechController extends AppController {


	public $uses = array('');
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');



    public function eventsConducted($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('KtechEventConducted');

        if(!empty($this->request->data)) {
            if ($this->request->data['KtechEventConducted']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'eventsConducted'));
            }
            if($this->request->data['KtechEventConducted']['type']=="edit"){
                $this->request->data = $this->KtechEventConducted->read(null,$this->request->data['KtechEventConducted']['id']);
                $this->request->data['KtechEventConducted']['month']=$this->request->data['KtechEventConducted']['month'].'-'.$this->request->data['KtechEventConducted']['year'];
            }
            else if($this->request->data['KtechEventConducted']['type']=="delete"){
                $hackathon_id=$this->request->data['KtechEventConducted']['id'];

                if($this->KtechEventConducted->deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'eventsConducted'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'eventsConducted'));
                }
            }
            else if($this->request->data['KtechEventConducted']['type']=="insert" ){

                if($this->request->data['KtechEventConducted']['id']){
                    $message=" Events Conducted Updated Successfully";
                }
                else{
                    $message=" Events Conducted Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['KtechEventConducted']['date']);
			    $this->request->data['KtechEventConducted']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			    $this->request->data['KtechEventConducted']['year']=$monthYear[2];

                $this->KtechEventConducted->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'eventsConducted'));

            }
        }

        $table_list = $this->KtechEventConducted->find('all',array('order'=>array('KtechEventConducted.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function mentors($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('KtechMentor');

        if(!empty($this->request->data)) {
            if ($this->request->data['KtechMentor']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'mentors'));
            }
            if($this->request->data['KtechMentor']['type']=="edit"){
                $this->request->data = $this->KtechMentor->read(null,$this->request->data['KtechMentor']['id']);
                $this->request->data['KtechMentor']['month']=$this->request->data['KtechMentor']['month'].'-'.$this->request->data['KtechMentor']['year'];
            }
            else if($this->request->data['KtechMentor']['type']=="delete"){
                $hackathon_id=$this->request->data['KtechMentor']['id'];

                if($this -> KtechMentor -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'mentors'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'mentors'));
                }
            }
            else if($this->request->data['KtechMentor']['type']=="insert" ){

                if($this->request->data['KtechMentor']['id']){
                    $message=" Mentors Detail Updated Successfully";
                }
                else{
                    $message=" Mentors Detail Added Successfully";
                }

                $monthYear=explode('-',$this->request->data['KtechMentor']['month']);
                $this->request->data['KtechMentor']['month']=$monthYear[0];
                $this->request->data['KtechMentor']['year']=$monthYear[1];

                $this->KtechMentor->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'mentors'));

            }
        }

        $table_list = $this->KtechMentor->find('all',array('order'=>array('KtechMentor.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function partnership($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('KtechPartnership');

        if(!empty($this->request->data)) {
            if ($this->request->data['KtechPartnership']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'partnership'));
            }
            if($this->request->data['KtechPartnership']['type']=="edit"){
                $this->request->data = $this->KtechPartnership->read(null,$this->request->data['KtechPartnership']['id']);
                $this->request->data['KtechPartnership']['month']=$this->request->data['KtechPartnership']['month'].'-'.$this->request->data['KtechPartnership']['year'];
            }
            else if($this->request->data['KtechPartnership']['type']=="delete"){
                $hackathon_id=$this->request->data['KtechPartnership']['id'];

                if($this -> KtechPartnership -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'partnership'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'partnership'));
                }
            }
            else if($this->request->data['KtechPartnership']['type']=="insert" ){

                if($this->request->data['KtechPartnership']['id']){
                    $message=" Partnership Updated Successfully";
                }
                else{
                    $message=" Partnership Added Successfully";
                }

                $this->request->data['KtechPartnership']['month']=date('F');
                $this->request->data['KtechPartnership']['year']=date('Y');

                $this->KtechPartnership->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'partnership'));

            }
        }

        $table_list = $this->KtechPartnership->find('all',array('order'=>array('KtechPartnership.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }

    public function fundRaisedStartup($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('KtechFundRaisedStartup');

        if(!empty($this->request->data)) {
            if ($this->request->data['KtechFundRaisedStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'fundRaisedStartup'));
            }
            if($this->request->data['KtechFundRaisedStartup']['type']=="edit"){
                $this->request->data = $this->KtechFundRaisedStartup->read(null,$this->request->data['KtechFundRaisedStartup']['id']);
                $this->request->data['KtechFundRaisedStartup']['month']=$this->request->data['KtechFundRaisedStartup']['month'].'-'.$this->request->data['KtechFundRaisedStartup']['year'];
            }
            else if($this->request->data['KtechFundRaisedStartup']['type']=="delete"){
                $hackathon_id=$this->request->data['KtechFundRaisedStartup']['id'];

                if($this -> KtechFundRaisedStartup -> deleted($hackathon_id)){
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this -> redirect(array('action' => 'fundRaisedStartup'));
                }
                else{
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this -> redirect(array('action' => 'fundRaisedStartup'));
                }
            }
            else if($this->request->data['KtechFundRaisedStartup']['type']=="insert" ){

                if($this->request->data['KtechFundRaisedStartup']['id']){
                    $message=" Fund Raised Startup Updated Successfully";
                }
                else{
                    $message=" Fund Raised Startup Added Successfully";
                }

       			$this->request->data['KtechFundRaisedStartup']['month']=date('F');
			    $this->request->data['KtechFundRaisedStartup']['year']=date('Y');

                $this->KtechFundRaisedStartup->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this -> redirect(array('action' => 'fundRaisedStartup'));

            }
        }

        $table_list = $this->KtechFundRaisedStartup->find('all',array('order'=>array('KtechFundRaisedStartup.id DESC')));
        $this->set('table_list',$table_list);

        $this->changeCSRFToken();
    }
public function hackathons($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('TbiStartup');

        $unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => 'CCamp', 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));

        $unselectedStartUps = [];
        $StartUpsDetails = [];
        foreach ($unincubatedStartUpsDb as $list) {
            $unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
            $StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
            $StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
        }
        $this->set('unselectedStartUps', $unselectedStartUps);
        $this->loadModel('KtechHackthon');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechHackthon']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'hackathons'));
            }
            if ($this->request->data['KtechHackthon']['type'] == "edit") {
                $this->request->data = $this->KtechHackthon->read(null, $this->request->data['KtechHackthon']['id']);
                $this->request->data['KtechHackthon']['month'] = $this->request->data['KtechHackthon']['month'] . '-' . $this->request->data['KtechHackthon']['year'];
            } else if ($this->request->data['KtechHackthon']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechHackthon']['id'];

                if ($this->KtechHackthon->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'hackathons'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'hackathons'));
                }
            } else if ($this->request->data['KtechHackthon']['type'] == "insert") {

                if ($this->request->data['KtechHackthon']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['KtechHackthon']['month']);
                $this->request->data['KtechHackthon']['month'] = $monthYear[0];
                $this->request->data['KtechHackthon']['year'] = $monthYear[1];

                $this->KtechHackthon->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'hackathons'));
            }
        }
        $this->KtechHackthon->bindModel(array('belongsTo' => array('TbiStartup')));

        $table_list = $this->KtechHackthon->find('all', array('order' => array('KtechHackthon.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function preIdeation($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('TbiStartup');

        $unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => 'CCamp', 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));

        $unselectedStartUps = [];
        $StartUpsDetails = [];
        foreach ($unincubatedStartUpsDb as $list) {
            $unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
            $StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
            $StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
        }
        $this->set('unselectedStartUps', $unselectedStartUps);
        $this->loadModel('KtechPreIdeation');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechPreIdeation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'preIdeation'));
            }
            if ($this->request->data['KtechPreIdeation']['type'] == "edit") {
                $this->request->data = $this->KtechPreIdeation->read(null, $this->request->data['KtechPreIdeation']['id']);
                $this->request->data['KtechPreIdeation']['month'] = $this->request->data['KtechPreIdeation']['month'] . '-' . $this->request->data['KtechPreIdeation']['year'];
            } else if ($this->request->data['KtechPreIdeation']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechPreIdeation']['id'];

                if ($this->KtechPreIdeation->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'preIdeation'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'preIdeation'));
                }
            } else if ($this->request->data['KtechPreIdeation']['type'] == "insert") {

                if ($this->request->data['KtechPreIdeation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['KtechPreIdeation']['month']);
                $this->request->data['KtechPreIdeation']['month'] = $monthYear[0];
                $this->request->data['KtechPreIdeation']['year'] = $monthYear[1];
                $this->KtechPreIdeation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'preIdeation'));
            }
        }
        $this->KtechPreIdeation->bindModel(array('belongsTo' => array('TbiStartup')));

        $table_list = $this->KtechPreIdeation->find('all', array('order' => array('KtechPreIdeation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function ideationWorkshop($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('TbiStartup');

        $unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => 'CCamp', 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));

        $unselectedStartUps = [];
        $StartUpsDetails = [];
        foreach ($unincubatedStartUpsDb as $list) {
            $unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
            $StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
            $StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
        }
        $this->set('unselectedStartUps', $unselectedStartUps);
        $this->loadModel('KtechIdeationWorkshop');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechIdeationWorkshop']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'ideationWorkshop'));
            }
            if ($this->request->data['KtechIdeationWorkshop']['type'] == "edit") {
                $this->request->data = $this->KtechIdeationWorkshop->read(null, $this->request->data['KtechIdeationWorkshop']['id']);
                $this->request->data['KtechIdeationWorkshop']['month'] = $this->request->data['KtechIdeationWorkshop']['month'] . '-' . $this->request->data['KtechIdeationWorkshop']['year'];
            } else if ($this->request->data['KtechIdeationWorkshop']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechIdeationWorkshop']['id'];

                if ($this->KtechIdeationWorkshop->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'ideationWorkshop'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'ideationWorkshop'));
                }
            } else if ($this->request->data['KtechIdeationWorkshop']['type'] == "insert") {

                if ($this->request->data['KtechIdeationWorkshop']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['KtechIdeationWorkshop']['month']);
                $this->request->data['KtechIdeationWorkshop']['month'] = $monthYear[0];
                $this->request->data['KtechIdeationWorkshop']['year'] = $monthYear[1];

                $this->KtechIdeationWorkshop->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'ideationWorkshop'));
            }
        }
        $this->KtechIdeationWorkshop->bindModel(array('belongsTo' => array('TbiStartup')));

        $table_list = $this->KtechIdeationWorkshop->find('all', array('order' => array('KtechIdeationWorkshop.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function ecosystemBuildingService($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('TbiStartup');

        $unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => 'CCamp', 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));

        $unselectedStartUps = [];
        $StartUpsDetails = [];
        foreach ($unincubatedStartUpsDb as $list) {
            $unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
            $StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
            $StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
        }
        $this->set('unselectedStartUps', $unselectedStartUps);
        $this->loadModel('KtechEcosystemBuildingService');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechEcosystemBuildingService']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'ecosystemBuildingService'));
            }
            if ($this->request->data['KtechEcosystemBuildingService']['type'] == "edit") {
                $this->request->data = $this->KtechEcosystemBuildingService->read(null, $this->request->data['KtechEcosystemBuildingService']['id']);
                $this->request->data['KtechEcosystemBuildingService']['month'] = $this->request->data['KtechEcosystemBuildingService']['month'] . '-' . $this->request->data['KtechEcosystemBuildingService']['year'];
            } else if ($this->request->data['KtechEcosystemBuildingService']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechEcosystemBuildingService']['id'];

                if ($this->KtechEcosystemBuildingService->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'ecosystemBuildingService'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'ecosystemBuildingService'));
                }
            } else if ($this->request->data['KtechEcosystemBuildingService']['type'] == "insert") {

                if ($this->request->data['KtechEcosystemBuildingService']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                // $monthYear = explode('-', $this->request->data['KtechEcosystemBuildingService']['date']);
                // $this->request->data['KtechEcosystemBuildingService']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                // $this->request->data['KtechEcosystemBuildingService']['year'] = $monthYear[2];

                $monthYear = explode('-', $this->request->data['KtechEcosystemBuildingService']['month']);
                $this->request->data['KtechEcosystemBuildingService']['month'] = $monthYear[0];
                $this->request->data['KtechEcosystemBuildingService']['year'] = $monthYear[1];

                $this->KtechEcosystemBuildingService->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'ecosystemBuildingService'));
            }
        }
        $this->KtechEcosystemBuildingService->bindModel(array('belongsTo' => array('TbiStartup')));

        $table_list = $this->KtechEcosystemBuildingService->find('all', array('order' => array('KtechEcosystemBuildingService.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function workshop($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('TbiStartup');

        $unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => 'CCamp', 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));

        $unselectedStartUps = [];
        $StartUpsDetails = [];
        foreach ($unincubatedStartUpsDb as $list) {
            $unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
            $StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
            $StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
        }
        $this->set('unselectedStartUps', $unselectedStartUps);
        $this->loadModel('KtechWorkshop');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechWorkshop']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'workshop'));
            }
            if ($this->request->data['KtechWorkshop']['type'] == "edit") {
                $this->request->data = $this->KtechWorkshop->read(null, $this->request->data['KtechWorkshop']['id']);
                $this->request->data['KtechWorkshop']['month'] = $this->request->data['KtechWorkshop']['month'] . '-' . $this->request->data['KtechWorkshop']['year'];
            } else if ($this->request->data['KtechWorkshop']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechWorkshop']['id'];

                if ($this->KtechWorkshop->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'workshop'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'workshop'));
                }
            } else if ($this->request->data['KtechWorkshop']['type'] == "insert") {

                if ($this->request->data['KtechWorkshop']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['KtechWorkshop']['month']);
                $this->request->data['KtechWorkshop']['month'] = $monthYear[0];
                $this->request->data['KtechWorkshop']['year'] = $monthYear[1];

                $this->KtechWorkshop->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'workshop'));
            }
        }
        $this->KtechWorkshop->bindModel(array('belongsTo' => array('TbiStartup')));

        $table_list = $this->KtechWorkshop->find('all', array('order' => array('KtechWorkshop.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function noOfNewProducts($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
            
        $this->loadModel('KtechNoOfNewProducts');

        if (!empty($this->request->data)) {
            if ($this->request->data['KtechNoOfNewProducts']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'noOfNewProducts'));
            }
            if ($this->request->data['KtechNoOfNewProducts']['type'] == "edit") {
                $this->request->data = $this->KtechNoOfNewProducts->read(null, $this->request->data['KtechNoOfNewProducts']['id']);
                $this->request->data['KtechNoOfNewProducts']['month'] = $this->request->data['KtechNoOfNewProducts']['month'] . '-' . $this->request->data['KtechNoOfNewProducts']['year'];
            } else if ($this->request->data['KtechNoOfNewProducts']['type'] == "delete") {
                $hackathon_id = $this->request->data['KtechNoOfNewProducts']['id'];

                if ($this->KtechNoOfNewProducts->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'noOfNewProducts'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'noOfNewProducts'));
                }
            } else if ($this->request->data['KtechNoOfNewProducts']['type'] == "insert") {

                if ($this->request->data['KtechNoOfNewProducts']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }  
                $monthYear = explode('-', $this->request->data['KtechNoOfNewProducts']['month']);
                $this->request->data['KtechNoOfNewProducts']['month'] = $monthYear[0];
                $this->request->data['KtechNoOfNewProducts']['year'] = $monthYear[1];

                $this->KtechNoOfNewProducts->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'noOfNewProducts'));
            }
        }
       
        $table_list = $this->KtechNoOfNewProducts->find('all', array('order' => array('KtechNoOfNewProducts.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

}
