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
class AVGCController extends AppController
{


    public $uses = array('');
    public $helpers = array('Html', 'Form', 'Js', 'Session');
    public $components = array('RequestHandler', 'Email');


    public function incubation($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AvgcIncubation');

        if (!empty($this->request->data)) {
            if ($this->request->data['AvgcIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'incubation'));
            }
            if ($this->request->data['AvgcIncubation']['type'] == "edit") {
                $this->request->data = $this->AvgcIncubation->read(null, $this->request->data['AvgcIncubation']['id']);
                $this->request->data['AvgcIncubation']['month'] = $this->request->data['AvgcIncubation']['month'] . '-' . $this->request->data['AvgcIncubation']['year'];
            } else if ($this->request->data['AvgcIncubation']['type'] == "delete") {
                $id = $this->request->data['AvgcIncubation']['id'];

                if ($this->AvgcIncubation->delete($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'incubation'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'incubation'));
                }
            } else if ($this->request->data['AvgcIncubation']['type'] == "insert") {

                if ($this->request->data['AvgcIncubation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['AvgcIncubation']['incubation_start_date']);
                $this->request->data['AvgcIncubation']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['AvgcIncubation']['year'] = $monthYear[2];


                $incubation_date =  $this->request->data['AvgcIncubation']['incubation_start_date'];
                $incubation_date_new = new DateTime($incubation_date);
                $this->request->data['AvgcIncubation']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
                $this->request->data['AvgcIncubation']['type'] = 'Incubation';

                $this->AvgcIncubation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'incubation'));
            }
        }

        $table_list = $this->AvgcIncubation->find('all', array('order' => array('AvgcIncubation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function computerGeneratedImagery($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AvgcIncubation');

        if (!empty($this->request->data)) {
            if ($this->request->data['AvgcIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'computerGeneratedImagery'));
            }
            if ($this->request->data['AvgcIncubation']['type'] == "edit") {
                $this->request->data = $this->AvgcIncubation->read(null, $this->request->data['AvgcIncubation']['id']);
                $this->request->data['AvgcIncubation']['month'] = $this->request->data['AvgcIncubation']['month'] . '-' . $this->request->data['AvgcIncubation']['year'];
            } else if ($this->request->data['AvgcIncubation']['type'] == "delete") {
                $hackathon_id = $this->request->data['AvgcIncubation']['id'];

                if ($this->AvgcIncubation->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'computerGeneratedImagery'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'computerGeneratedImagery'));
                }
            } else if ($this->request->data['AvgcIncubation']['type'] == "insert") {

                if ($this->request->data['AvgcIncubation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['AvgcIncubation']['incubation_start_date']);
                $this->request->data['AvgcIncubation']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['AvgcIncubation']['year'] = $monthYear[2];

                $incubation_date =  $this->request->data['AvgcIncubation']['incubation_start_date'];
                $incubation_date_new = new DateTime($incubation_date);
                $this->request->data['AvgcIncubation']['type'] = 'Computer Generated Imagery';
                $this->request->data['AvgcIncubation']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');

                $this->AvgcIncubation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'computerGeneratedImagery'));
            }
        }
        $table_list = $this->AvgcIncubation->find('all', array('order' => array('AvgcIncubation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function motionCapture($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AvgcIncubation');

        if (!empty($this->request->data)) {
            if ($this->request->data['AvgcIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'motionCapture'));
            }
            if ($this->request->data['AvgcIncubation']['type'] == "edit") {
                $this->request->data = $this->AvgcIncubation->read(null, $this->request->data['AvgcIncubation']['id']);
                $this->request->data['AvgcIncubation']['month'] = $this->request->data['AvgcIncubation']['month'] . '-' . $this->request->data['AvgcIncubation']['year'];
            } else if ($this->request->data['AvgcIncubation']['type'] == "delete") {
                $hackathon_id = $this->request->data['AvgcIncubation']['id'];

                if ($this->AvgcIncubation->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'motionCapture'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'motionCapture'));
                }
            } else if ($this->request->data['AvgcIncubation']['type'] == "insert") {

                if ($this->request->data['AvgcIncubation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['AvgcIncubation']['incubation_start_date']);
                $this->request->data['AvgcIncubation']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['AvgcIncubation']['year'] = $monthYear[2];

                $incubation_date =  $this->request->data['AvgcIncubation']['incubation_start_date'];
                $incubation_date_new = new DateTime($incubation_date);
                $this->request->data['AvgcIncubation']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
                $this->request->data['AvgcIncubation']['type'] = 'Motion Capture';

                $this->AvgcIncubation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'motionCapture'));
            }
        }
        $table_list = $this->AvgcIncubation->find('all', array('order' => array('AvgcIncubation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }


    public function greenScreen($id = null)
    {

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AvgcIncubation');

        if (!empty($this->request->data)) {
            if ($this->request->data['AvgcIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'greenScreen'));
            }
            if ($this->request->data['AvgcIncubation']['type'] == "edit") {
                $this->request->data = $this->AvgcIncubation->read(null, $this->request->data['AvgcIncubation']['id']);
                $this->request->data['AvgcIncubation']['month'] = $this->request->data['AvgcIncubation']['month'] . '-' . $this->request->data['AvgcIncubation']['year'];
            } else if ($this->request->data['AvgcIncubation']['type'] == "delete") {
                $hackathon_id = $this->request->data['AvgcIncubation']['id'];

                if ($this->AvgcIncubation->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'greenScreen'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'greenScreen'));
                }
            } else if ($this->request->data['AvgcIncubation']['type'] == "insert") {
                if ($this->request->data['AvgcIncubation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['AvgcIncubation']['incubation_start_date']);
                $this->request->data['AvgcIncubation']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['AvgcIncubation']['year'] = $monthYear[2];

                $incubation_date =  $this->request->data['AvgcIncubation']['incubation_start_date'];
                $incubation_date_new = new DateTime($incubation_date);
                $this->request->data['AvgcIncubation']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
                $this->request->data['AvgcIncubation']['type'] = 'Green Screen';

                $this->AvgcIncubation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'greenScreen'));
            }
        }
        $table_list = $this->AvgcIncubation->find('all', array('order' => array('AvgcIncubation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }

    public function bodyScan($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AvgcIncubation');

        if (!empty($this->request->data)) {
            if ($this->request->data['AvgcIncubation']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'bodyScan'));
            }
            if ($this->request->data['AvgcIncubation']['type'] == "edit") {
                $this->request->data = $this->AvgcIncubation->read(null, $this->request->data['AvgcIncubation']['id']);
                $this->request->data['AvgcIncubation']['month'] = $this->request->data['AvgcIncubation']['month'] . '-' . $this->request->data['AvgcIncubation']['year'];
            } else if ($this->request->data['AvgcIncubation']['type'] == "delete") {
                $hackathon_id = $this->request->data['AvgcIncubation']['id'];

                if ($this->AvgcIncubation->delete($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'bodyScan'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'bodyScan'));
                }
            } else if ($this->request->data['AvgcIncubation']['type'] == "insert") {
                if ($this->request->data['AvgcIncubation']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }

                $monthYear = explode('-', $this->request->data['AvgcIncubation']['incubation_start_date']);
                $this->request->data['AvgcIncubation']['month'] = date('F', mktime(0, 0, 0, $monthYear[1], 10));
                $this->request->data['AvgcIncubation']['year'] = $monthYear[2];

                $incubation_date =  $this->request->data['AvgcIncubation']['incubation_start_date'];
                $incubation_date_new = new DateTime($incubation_date);
                $this->request->data['AvgcIncubation']['incubation_start_date'] =  $incubation_date_new->format('Y-m-d');
                $this->request->data['AvgcIncubation']['type'] = 'Body Scan';

                $this->AvgcIncubation->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'bodyScan'));
            }
        }
        $table_list = $this->AvgcIncubation->find('all', array('order' => array('AvgcIncubation.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
}
