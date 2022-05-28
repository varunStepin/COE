<?php

/*----------***------------***
	Created by 	- Varun SIT
	Stated Date	- 12-11-2021

	Updated By	-
	Updated Date-
	***----------***------------*/
App::uses('AppController', 'Controller');
include('excel_reader2.php');
class TbiController extends AppController
{



	public $helpers = array('Html', 'Form', 'Js', 'Session');
	public $components = array('RequestHandler', 'Email');
    public $uses = array("TbiEvent","TbiEventParticipant");



	public function startup($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');
		configure::write('debug',2);

		$this->_userSessionCheckout();
		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}
		else if ($universityType == 'CCamp') {
			$details['TbiTitle'] = 'K-Tech COE By C-Camp, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startup'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "edit") {
			$this->request->data = $this->TbiStartup->read(null, $this->request->data['TbiStartup']['id']);
			$this->request->data['TbiStartup']['month_year'] = date('m-Y', strtotime($this->request->data['TbiStartup']['month'] . '-' . $this->request->data['TbiStartup']['year']));
		} else if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			if ($this->TbiStartup->deleted($id)) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startup'));
			} else {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startup'));
			}
		} else if ($this->request->data['TbiStartup']['type'] == "insert") {

			if ($this->request->data['TbiStartup']['id']) {
				$message = "Updated Successfully";
			} else {
				$message = "Added Successfully";
			}

			$this->request->data['TbiStartup']['university'] = $universityType;
			$this->TbiStartup->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startup'));
		}
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
	public function startupSelected($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');

		$this->_userSessionCheckout();

		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}
		else if ($universityType == 'CCamp') {
			$details['TbiTitle'] = 'K-Tech COE By C-Camp, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startup'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			$this->TbiStartup->id = $id;
			$this->TbiStartup->saveField('is_selected', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupSelected'));
		} else if ($this->request->data['TbiStartup']['type'] == "insert") {

			$message = "Startup Selected Successfully";
			$this->TbiStartup->id = $this->request->data['TbiStartup']['id'];
			$this->TbiStartup->saveField('is_selected', 1);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupSelected'));
		}
		$unselectedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_selected' => 0), "order" => array('TbiStartup.startup_name ASC')));
		$unselectedStartUps = [];
		$StartUpsDetails = [];
		foreach ($unselectedStartUpsDb as $list) {
			$unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
			$StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
			$StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
		}
		$this->set('unselectedStartUps', $unselectedStartUps);
		$this->set('StartUpsDetails', $StartUpsDetails);
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_selected' => 1), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
	/*
	Created by 	- Rohith K
	Stated Date	- 23-11-2021
	*/
	public function startupIncubated($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');

		$this->_userSessionCheckout();

		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}else if ($universityType == 'CCamp') {
			$details['TbiTitle'] = 'K-Tech COE By C-Camp, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubated'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			$this->TbiStartup->id = $id;
			$this->TbiStartup->saveField('is_incubated', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubated'));
		}
		else if ($this->request->data['TbiStartup']['type'] == "edit") {
			$this->request->data = $this->TbiStartup->read(null, $this->request->data['TbiStartup']['id']);
			$this->request->data['TbiStartup']['incubation_start_date']=date('d-m-Y',strtotime($this->request->data['TbiStartup']['incubation_start_date']));
			
			
		}
		 else if ($this->request->data['TbiStartup']['type'] == "insert") {

			$message = "Startup Selected for incubation Successfully";
			$this->TbiStartup->id = $this->request->data['TbiStartup']['id'];
			$this->TbiStartup->saveField('is_incubated', 1);

			$incubation_date =  $this->request->data['TbiStartup']['incubation_start_date'];
			$incubation_date_new = new DateTime($incubation_date);
			$this->request->data['TbiStartup']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
			$this->TbiStartup->save($this->request->data);

			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubated'));
		}

		$unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_selected' => 1, 'is_incubated' => 0), "order" => array('TbiStartup.startup_name ASC')));
		
		$unselectedStartUps = [];
		$StartUpsDetails = [];
		foreach ($unincubatedStartUpsDb as $list) {
			$unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
			$StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
			$StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
		}
	
		$this->set('unselectedStartUps', $unselectedStartUps);
		$this->set('StartUpsDetails', $StartUpsDetails);
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_incubated' => 1), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
	/*
	Created by 	- Rohith K
	Stated Date	- 23-11-2021
	*/
	public function innovationCommercialized($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');
		configure::write('debug', 2);
		$this->_userSessionCheckout();

		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'innovationCommercialized'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			$this->TbiStartup->id = $id;
			$this->TbiStartup->saveField('is_innovations_commercialized', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'innovationCommercialized'));
		}else if ($this->request->data['TbiStartup']['type'] == "edit") {
			$this->request->data = $this->TbiStartup->read(null, $this->request->data['TbiStartup']['id']);
		}
		 else if ($this->request->data['TbiStartup']['type'] == "insert") {

			$message = "Startup Selected for incubation Successfully";
			$this->TbiStartup->id = $this->request->data['TbiStartup']['id'];
			$this->TbiStartup->saveField('is_innovations_commercialized', 1);

			$this->TbiStartup->save($this->request->data);

			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'innovationCommercialized'));
		}

		$unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_incubated' => 1, 'is_innovations_commercialized' => 0), "order" => array('TbiStartup.startup_name ASC')));
		
		$unselectedStartUps = [];
		$StartUpsDetails = [];
		foreach ($unincubatedStartUpsDb as $list) {
			$unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
			$StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
			$StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
		}
	
		$this->set('unselectedStartUps', $unselectedStartUps);
		$this->set('StartUpsDetails', $StartUpsDetails);
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_innovations_commercialized' => 1), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
	/*
	Created by 	- Rohith K
	Stated Date	- 23-11-2021
	*/
	public function startupIncubatedTbi($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');
		configure::write('debug', 2);
		$this->_userSessionCheckout();

		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubatedTbi'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			$this->TbiStartup->id = $id;
			$this->TbiStartup->saveField('is_incubated_off_tbi', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubatedTbi'));
		} else if ($this->request->data['TbiStartup']['type'] == "edit") {
			$this->request->data = $this->TbiStartup->read(null, $this->request->data['TbiStartup']['id']);
		}
		else if ($this->request->data['TbiStartup']['type'] == "insert") {

			$message = "Startup Selected for incubation Successfully";
			$this->TbiStartup->id = $this->request->data['TbiStartup']['id'];
			$this->TbiStartup->saveField('is_incubated_off_tbi', 1);

			$incubation_date =  $this->request->data['TbiStartup']['incubation_start_date'];
			$incubation_date_new = new DateTime($incubation_date);
			$this->request->data['TbiStartup']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
			$this->TbiStartup->save($this->request->data);

			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupIncubatedTbi'));
		}

		$unincubatedStartUpsTBIDb = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_innovations_commercialized' => 1, 'is_incubated_off_tbi' => 0), "order" => array('TbiStartup.startup_name ASC')));
		
		$unselectedStartUps = [];
		$StartUpsDetails = [];
		foreach ($unincubatedStartUpsTBIDb as $list) {
			$unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
			$StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
			$StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
		}
	
		$this->set('unselectedStartUps', $unselectedStartUps);
		$this->set('StartUpsDetails', $StartUpsDetails);
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_incubated_off_tbi' => 1), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
public function eventConducted($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');
		//configure::write('debug', 2);

		$this->_userSessionCheckout();

	if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		}
		else if ($universityType == 'CNTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}
		else if ($universityType == 'CCamp') {
			$details['TbiTitle'] = 'K-Tech COE By C-Camp, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiEvent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventConducted'));
			}
		}

		if ($this->request->data['TbiEvent']['type'] == "edit") {
			$this->request->data = $this->TbiEvent->read(null, $this->request->data['TbiEvent']['id']);
			$this->request->data['TbiEvent']['month_year'] = date('m-Y', strtotime($this->request->data['TbiEvent']['month'] . '-' . $this->request->data['TbiEvent']['year']));
		} else if ($this->request->data['TbiEvent']['type'] == "delete") {
			$id = $this->request->data['TbiEvent']['id'];
			
			if ($this->TbiEvent->delete($id)) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Event have been deleted Successfully.</div>");

				$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventConducted'));
			} else {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

				$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventConducted'));
			}
		} else if ($this->request->data['TbiEvent']['type'] == "insert") {

			if ($this->request->data['TbiEvent']['id']) {
				$message = "Updated Successfully";
			} else {
				$message = "Added Successfully";
			}

			$this->request->data['TbiEvent']['university'] = $universityType;

			$event_date =  $this->request->data['TbiEvent']['event_date'];
			$event_date_new = new DateTime($event_date);
			$this->request->data['TbiEvent']['event_date'] =  $event_date_new->format('Y-m-d');

			$this->TbiEvent->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventConducted'));
		}
		$manage_list = $this->TbiEvent->find('all', array("conditions" => array("university" => $universityType), "order" => array('TbiEvent.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}

	public function eventDetails($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');
		configure::write('debug', 2);

		$this->_userSessionCheckout();

if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		}
		else if ($universityType == 'CNTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'DMTBI') {
			$details['TbiTitle'] = 'Centre for Product Design and Manufacturing, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'MUTBI') {
			$details['TbiTitle'] = 'Manipal Universal Technology Business Incubator, Startups';
			$details['Controller'] = $universityType;
		} else if ($universityType == 'RMTBI') {
			$details['TbiTitle'] = 'Ramaiah University of Applied Sciences, Startups';
			$details['Controller'] = $universityType;
		}

		if ($this->request->data['TbiEventParticipant']['type'] == "delete") {
			$id = $this->request->data['TbiEventParticipant']['id'];

			$this->TbiEventParticipant->id = $id;
			$this->TbiEventParticipant->saveField('is_details_available', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Participant details have been deleted successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventDetails'));
		}else if ($this->request->data['TbiEventParticipant']['type'] == "edit") {
			$this->request->data = $this->TbiEventParticipant->read(null, $this->request->data['TbiEventParticipant']['id']);
			//$this->request->data['TbiEvent']['month_year'] = date('m-Y', strtotime($this->request->data['TbiEvent']['month'] . '-' . $this->request->data['TbiEvent']['year']));
		}
		else if ($this->request->data['TbiEventParticipant']['type'] == "insert") {
			$message = "Participant details entered successfully";
			$this->TbiEventParticipant->id = $this->request->data['TbiEventParticipant']['id'];
			$this->TbiEventParticipant->saveField('is_details_available', 1);
			$this->TbiEventParticipant->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'eventDetails'));
		}
		
		$manage_list = $this->TbiEventParticipant->find('all', array( "order" => array('TbiEventParticipant.id DESC'),'recursive'=>2));
		//print_r($manage_list); exit();
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();

		$event_name = $this->TbiEvent->find('all', array('order'=>'TbiEvent.event_name DESC'));
		$event_name = Set::extract($event_name, '{n}.TbiEvent');
		$event_name_array = array();
		if(!empty($event_name)){
			foreach($event_name as $eve_name){
				$event_name_array[$eve_name['id']] = $eve_name['event_name'];
			}
		}
		$this->set('event_name_array', $event_name_array);
	}
	public function startupGraduated($universityType = null)
	{
		date_default_timezone_set('Asia/Kolkata');
		$this->layout = 'fab_layout';
		$this->loadModel('TbiStartup');

		$this->_userSessionCheckout();

		if ($universityType == 'NSTBI') {
			$details['TbiTitle'] = 'Centre for Nano Science and Engineering, Startups';
			$details['Controller'] = $universityType;
		} 
		else if ($universityType == 'CCamp') {
			$details['TbiTitle'] = 'K-Tech COE By C-Camp, Startups';
			$details['Controller'] = $universityType;
		}

		if (!empty($this->request->data)) {

			if ($this->request->data['TbiStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
				$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
				$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupGraduated'));
			}
		}

		if ($this->request->data['TbiStartup']['type'] == "delete") {
			$id = $this->request->data['TbiStartup']['id'];

			$this->TbiStartup->id = $id;
			$this->TbiStartup->saveField('is_graduated', 0);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupGraduated'));
		} else if ($this->request->data['TbiStartup']['type'] == "edit") {
			$this->request->data = $this->TbiStartup->read(null, $this->request->data['TbiStartup']['id']);
		}
		else if ($this->request->data['TbiStartup']['type'] == "insert") {

			$message = "Startup Selected for incubation Successfully";
			$this->TbiStartup->id = $this->request->data['TbiStartup']['id'];
			$this->TbiStartup->saveField('is_graduated', 1);
			$this->TbiStartup->save($this->request->data);
			$this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
			$this->redirect(array('controller' => $details['Controller'], 'action' => 'startupGraduated'));
		}

		$unincubatedStartUpsDb = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_selected' => 1, 'is_graduated' => 0), "order" => array('TbiStartup.startup_name ASC')));
		
		$unselectedStartUps = [];
		$StartUpsDetails = [];
		foreach ($unincubatedStartUpsDb as $list) {
			$unselectedStartUps[$list['TbiStartup']['id']] = $list['TbiStartup']['startup_name'];
			$StartUpsDetails[$list['TbiStartup']['id']]['details'] = $list['TbiStartup']['details'];
			$StartUpsDetails[$list['TbiStartup']['id']]['startup_type'] = $list['TbiStartup']['startup_type'];
		}
	
		$this->set('unselectedStartUps', $unselectedStartUps);
		$this->set('StartUpsDetails', $StartUpsDetails);
		$manage_list = $this->TbiStartup->find('all', array("conditions" => array("university" => $universityType, 'is_selected' => 1,'is_graduated' => 1), "order" => array('TbiStartup.id DESC')));
		$this->set('manage_list', $manage_list);
		$this->set('details', $details);
		$this->changeCSRFToken();
	}
	/*--------------------------------------------------------------------------------Niveditha-------------------------------*/
	
	public function target($id = null) 
	{
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->tbiTargetType();
        $this->loadModel('TbiTarget');
		// print_r($this->request->data);
		
        if(!empty($this->request->data)) {
			
            if ($this->request->data['TbiTarget']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'target'));
            }
        }
        // print_r($this->request->data); exit();

        if($this->request->data['TbiTarget']['types']=="edit"){
            $this->request->data = $this->TbiTarget->read(null,$this->request->data['TbiTarget']['id']);
        }
        else if($this->request->data['TbiTarget']['types']=="delete"){
            $id=$this->request->data['TbiTarget']['id'];

            if($this -> TbiTarget -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'target'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'target'));
            }
        }
        else if($this->request->data['TbiTarget']['types']=="insert"){
            if($this->request->data['TbiTarget']['id']){
                $message="Target Updated Successfully";
            }
            else{
                $message="Target Added Successfully";
            }

            $this->TbiTarget->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'target'));

        }

        $manage_list = $this->TbiTarget->find('all',array('TbiTarget.id DESC'));
        $this->set('manage_list',$manage_list);
		// print_r($manage_list);
        $this->changeCSRFToken();
    }
	
	public function financial($id=null)
	{
		$this->layout = 'fab_layout';
		$this->_userSessionCheckout();
		
		$action=explode("/",$this->request->url)[1];
		$this->loadModel('FinancialYear');
		$this->loadModel('Financial');
		$this->_getFundingYear();
		$this->set("action",$action);
		$types="";
		
		
		if($action=="NSTBIFund"){
				$this->set("title","CeNSE Fund Details");
				$types="CeNSE";
		} else if($action=="DMTBIFund"){
				$this->set("title","CPDM Fund Details");
				$types="CPDM";
		} else if($action=="MUTBIFund"){
				$this->set("title","Manipal University Fund Details");
				$types="Manipal University";
		} else if($action=="RMTBIFund"){
				$this->set("title","Ramaiah University Fund Details");
				$types="Ramaiah University";
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
			}
			else{
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
			}
			else{
				$doc_name_bs = $doc_name_bs_old;
			}
			/*Upload Bank Statement*/

			$this->request->data['Financial']['upload_uc']=$doc_name;
			$this->request->data['Financial']['upload_bs']=$doc_name_bs;
				
			$this->request->data['Financial']['types']=$types;
			
			$result= $this->Financial->hasAny(array("types"=>$types,"expenses_type"=>$this->request->data['Financial']['expenses_type'],"id !="=>$this->request->data['Financial']['id'],"financial_year_id"=>$this->request->data['Financial']['financial_year_id'],"phase"=>$this->request->data['Financial']['phase']));
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
		
	public function expenditureList($id=null)
	{
		$this->layout = 'fab_layout';
		$this->loadModel('Expenditure');
		
		$this->_userSessionCheckout();
		$action=explode("/",$this->request->url)[1];
		$types="";
		$linkType="";
			// print_r( $action);
		if($action=="NSTBIExpenseList"){
			$this->set("title","CeNSE Expense Details");
			$types="CeNSE";
			$linkType="NSTBIExpense";
			$this->set("action","NSTBIExpense");
		} 
		else if($action=="DMTBIExpenseList"){
			$this->set("title","CPDM Expense Details");
			$types="CPDM";
			$linkType="DMTBIExpense";
			$this->set("action","DMTBIExpense");
		} 
		else if($action=="MUTBIExpenseList"){
			$this->set("title","Manipal University Expense Details");
			$types="Manipal University";
			$linkType="MUTBIExpense";
			$this->set("action","MUTBIExpense");
		} 
		else if($action=="RMTBIExpenseList"){
			$this->set("title","Ramaiah University Expense Details");
			$types="Ramaiah University";
			$linkType="RMTBIExpense";
			$this->set("action","RMTBIExpense");
		} 
		
		$this->Expenditure->bindModel(array("belongsTo"=>array("FinancialYear")));
		$manage_list = $this->Expenditure->find('all',array('conditions' => array('Expenditure.types' =>$types),"order"=>array('Expenditure.id DESC')));
		$this->set('manage_list',$manage_list);
		$this->set('linkType',$linkType);
		$this->changeCSRFToken();
	}
	
	public function expenditure($id=null)
	{
		$this->layout = 'fab_layout';
		$this->_userSessionCheckout();
		$this->loadModel('FinancialYear');
		$this->loadModel('Expenditure');
		$this->_getFundingYear();
	
		$action=explode("/",$this->request->url)[1];
		$this->set("action",$action);
		$types="";
			// print_r( $id);
		if($action=="NSTBIExpense"){
			$this->set("title","CeNSE Expense Details");
			$types="CeNSE";
		} 
		else if($action=="DMTBIExpense"){
			$this->set("title","CPDM Expense Details");
			$types="CPDM";
		} 
		else if($action=="MUTBIExpense"){
			$this->set("title","Manipal University Expense Details");
			$types="Manipal University";
		} 
		else if($action=="RMTBIExpense"){
			$this->set("title","Ramaiah University Expense Details");
			$types="Ramaiah University";
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
}
