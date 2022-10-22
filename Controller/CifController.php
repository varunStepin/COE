<?php

/*----------***------------***
	Created by 	- Rohith K SIT
	Stated Date	- 04-04-2022

	Updated By	-
	Updated Date-
	***----------***------------*/
App::uses('AppController', 'Controller');
include('excel_reader2.php');
class CifController extends AppController
{
    public $helpers = array('Html', 'Form', 'Js', 'Session');
    public $components = array('RequestHandler', 'Email');

    public function roundtables($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       
        $this->getYear();
        $this->loadModel('CifRoundtable');
        if (!empty($this->request->data)) {
            if ($this->request->data['CifRoundtable']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'roundtables'));
            }
            if ($this->request->data['CifRoundtable']['type'] == "edit") {
                $this->request->data = $this->CifRoundtable->read(null, $this->request->data['CifRoundtable']['id']);
                $this->request->data['CifRoundtable']['date'] = date('d-m-Y', strtotime($this->request->data['CifRoundtable']['date']));
            } else if ($this->request->data['CifRoundtable']['type'] == "delete") {
                $roundtable_id = $this->request->data['CifRoundtable']['id'];
                if ($this->CifRoundtable->deleted($roundtable_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'roundtables'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'roundtables'));
                }
            } else if ($this->request->data['CifRoundtable']['type'] == "insert") {
                if ($this->request->data['CifRoundtable']['id']) {
                    $message = "Roundtable Updated Successfully";
                } else {
                    $message = "Roundtable Added Successfully";
                }
                $this->request->data['CifRoundtable']['date'] = date('Y-m-d', strtotime($this->request->data['CifRoundtable']['date']));
                $this->CifRoundtable->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'roundtables'));
            }
        }
        $table_list = $this->CifRoundtable->find('all', array('order' => array('CifRoundtable.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function roundtableParticipantsList($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       
        $this->loadModel('CifRoundtableParticipant');
        if ($this->request->data['CifRoundtableParticipant']['type'] == "delete") {
            $roundtable_participant_id = $this->request->data['CifRoundtableParticipant']['id'];
            if ($this->CifRoundtableParticipant->deleted($roundtable_participant_id)) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'roundtableParticipantsList'));
            } else {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'roundtableParticipantsList'));
            }
        } else {
            $this->CifRoundtableParticipant->bindModel(array('belongsTo' => array("CifRoundtable")));
            $participants_list = $this->CifRoundtableParticipant->find('all', array(
                'order' => array('CifRoundtableParticipant.id DESC')
            ), array());
            $this->set('participants_list', $participants_list);
        }
    }
    public function roundtableParticipants($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
       
        $this->_userSessionCheckout();
        $this->loadModel('CifRoundtable');
        $this->loadModel('CifRoundtableParticipant');
        $this->getCifRoundtables();

        if ($this->request->data['CifRoundtableParticipant']['type'] == "insert") {
            $participant_name = $this->request->data['participant_name'];
            for ($i = 0; $i < count($participant_name); $i++) {
                $data = array(
                    "CifRoundtableParticipant" => array(
                        "cif_roundtable_id" => $this->request->data['CifRoundtableParticipant']['cif_roundtable_id'],
                        "participant_name" => $this->request->data['participant_name'][$i],
                        "contact_number" => $this->request->data['contact_number'][$i],
                        "gender" => $this->request->data['gender'][$i],
                        "email" => $this->request->data['email'][$i],
                        "organization" => $this->request->data['organization'][$i],
                    )
                );
                $this->CifRoundtableParticipant->saveAll($data);
            }
            $message = "Participant Added Successfully";
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
            $this->redirect(array('action' => 'roundtableParticipantsList'));
        } elseif ($this->request->data['CifRoundtableParticipant']['csrf_token'] != "") {
            if ($this->request->data['CifRoundtableParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'icParticipants'));
            }
        }
        $this->changeCSRFToken();
    }
    public function roundtableParticipantsImport($id = null)
    {
        $this->_userSessionCheckout();
        
        $this->loadModel('CifRoundtableParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file = $this->request->data['CifRoundtableParticipant']["file"];
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if ($file["size"] > 0 && $ext == 'xls' && $file['name'] == 'roundtableParticipants.xls') {
            $data->read($this->request->data['CifRoundtableParticipant']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];
            $details = array();
            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();
                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j + 1])) {
                        $getData[$j] = $sheet['cells'][$i][$j + 1];
                    }
                }
                if (!empty($getData[0])) {
                    $emp_data[] = array(
                        'CifRoundtableParticipant' =>
                        array(
                            'cif_roundtable_id' => $this->request->data['CifRoundtableParticipant']["program_id"],
                            'participant_name' => ($getData[0] != '') ? $getData[0] : '',
                            'gender' => ($getData[1] != '') ? $getData[1] : '',
                            'contact_number' => ($getData[2] != '') ? $getData[2] : '',
                            'email' => ($getData[3] != '') ? $getData[3] : '',
                            'organization' => ($getData[4] != '') ? $getData[4] : '',
                        )
                    );
                    $details[] = $getData;
                }
                //print_r($emp_data); exit();
            }
            $this->CifRoundtableParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        } else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this->redirect(array('action' => 'roundtableParticipantsList'));
    }
    public function hackathons($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        
        $this->getYear();
        $this->_userSessionCheckout();
        $this->loadModel('CifHackathon');
        if (!empty($this->request->data)) {
            if ($this->request->data['CifHackathon']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'hackathons'));
            }
            if ($this->request->data['CifHackathon']['type'] == "edit") {
                $this->request->data = $this->CifHackathon->read(null, $this->request->data['CifHackathon']['id']);
                $this->request->data['CifHackathon']['date'] = date('d-m-Y', strtotime($this->request->data['CifHackathon']['date']));
            } else if ($this->request->data['CifHackathon']['type'] == "delete") {
                $hackathon_id = $this->request->data['CifHackathon']['id'];
                if ($this->CifHackathon->deleted($hackathon_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'hackathons'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'hackathons'));
                }
            } else if ($this->request->data['CifHackathon']['type'] == "insert") {
                if ($this->request->data['CifHackathon']['id']) {
                    $message = "Hackathon Updated Successfully";
                } else {
                    $message = "Hackathon Added Successfully";
                }
                $this->request->data['CifHackathon']['date'] = date('Y-m-d', strtotime($this->request->data['CifHackathon']['date']));
                $this->CifHackathon->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'hackathons'));
            }
        }
        $table_list = $this->CifHackathon->find('all', array('order' => array('CifHackathon.id DESC')));
        $this->set('table_list', $table_list);
        $this->changeCSRFToken();
    }
    public function hackathonParticipants($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
       
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->loadModel('CifHackathon');
        $this->loadModel('CifHackathonParticipant');
        $this->getCifHackathons();

        if ($this->request->data['CifHackathonParticipant']['type'] == "insert") {
            $participant_name = $this->request->data['participant_name'];
            for ($i = 0; $i < count($participant_name); $i++) {
                $data = array(
                    "CifHackathonParticipant" => array(
                        "cif_hackathon_id" => $this->request->data['CifHackathonParticipant']['cif_hackathon_id'],
                        "participant_name" => $this->request->data['participant_name'][$i],
                        "contact_number" => $this->request->data['contact_number'][$i],
                        "gender" => $this->request->data['gender'][$i],
                        "email" => $this->request->data['email'][$i],
                        "organization" => $this->request->data['organization'][$i],
                    )
                );
                $this->CifHackathonParticipant->saveAll($data);
            }
            $message = " Participant Added Successfully";
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
            $this->redirect(array('action' => 'hackathonParticipantsList'));
        } elseif ($this->request->data['CifHackathonParticipant']['csrf_token'] != "") {
            if ($this->request->data['CifHackathonParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'icParticipants'));
            }
        }
        $this->changeCSRFToken();
    }
    public function hackathonParticipantsList($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       
        $this->loadModel('CifHackathonParticipant');
        if ($this->request->data['CifHackathonParticipant']['type'] == "delete") {
            $hackathon_participant_id = $this->request->data['CifHackathonParticipant']['id'];
            if ($this->CifHackathonParticipant->deleted($hackathon_participant_id)) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'hackathonParticipantsList'));
            } else {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'hackathonParticipantsList'));
            }
        } else {
            $this->CifHackathonParticipant->bindModel(array('belongsTo' => array("CifHackathon")));
            $participants_list = $this->CifHackathonParticipant->find('all', array(
                'order' => array('CifHackathonParticipant.id DESC')
            ), array());
            $this->set('participants_list', $participants_list);
        }
    }
    public function hackathonParticipantsImport($id = null)
    {
        $this->_userSessionCheckout();
        
        $this->loadModel('CifHackathonParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file = $this->request->data['CifHackathonParticipant']["file"];
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if ($file["size"] > 0 && $ext == 'xls' && $file['name'] == 'cifHackathonParticipants.xls') {
            //print_r(123); exit();
            $data->read($this->request->data['CifHackathonParticipant']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];
            //print_r($cols); exit();
            $details = array();
            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();
                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j + 1])) {
                        $getData[$j] = $sheet['cells'][$i][$j + 1];
                    }
                }
                if (!empty($getData[0])) {
                    $emp_data[] = array(
                        'CifHackathonParticipant' =>
                        array(
                            'cif_hackathon_id' => $this->request->data['CifHackathonParticipant']["program_id"],
                            'participant_name' => ($getData[0] != '') ? $getData[0] : '',
                            'gender' => ($getData[1] != '') ? $getData[1] : '',
                            'contact_number' => ($getData[2] != '') ? $getData[2] : '',
                            'email' => ($getData[3] != '') ? $getData[3] : '',
                            'organization' => ($getData[4] != '') ? $getData[4] : '',
                        )
                    );
                    $details[] = $getData;
                }
            }
            $this->CifHackathonParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        } else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this->redirect(array('action' => 'hackathonParticipantsList'));
    }
    public function startups($id = null)
    {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
     
        $this->_userSessionCheckout();
        $this->getYear();
        $this->loadModel('CifStartup');
        if (!empty($this->request->data)) {
            // print_r($this->request->data); exit();
            if ($this->request->data['CifStartup']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('controller' => 'Cif', 'action' => 'startups'));
            }
            if ($this->request->data['CifStartup']['type'] == "edit") {
                $this->request->data = $this->CifStartup->read(null, $this->request->data['CifStartup']['id']);
                $this->request->data['CifStartup']['incubation_date'] = date('d-m-Y', strtotime($this->request->data['CifStartup']['incubation_date']));
                $this->request->data['CifStartup']['graduation_date'] = date('d-m-Y', strtotime($this->request->data['CifStartup']['graduation_date']));
            } else if ($this->request->data['CifStartup']['type'] == "delete") {
                $id = $this->request->data['CifStartup']['id'];

                if ($this->CifStartup->deleted($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                    $this->redirect(array('controller' => 'Cif', 'action' => 'startupList'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                    $this->redirect(array('controller' => 'Cif', 'action' => 'startupList'));
                }
            } else if ($this->request->data['CifStartup']['type'] == "insert") {

                if ($this->request->data['CifStartup']['id']) {
                    $message = "Updated Successfully";
                } else {
                    $message = "Added Successfully";
                }
                //print_r($this->request->data); exit();
                $this->request->data['CifStartup']['incubation_date'] = date('Y-m-d', strtotime($this->request->data['CifStartup']['incubation_date']));
                $this->request->data['CifStartup']['graduation_date'] = date('Y-m-d', strtotime($this->request->data['CifStartup']['graduation_date']));
                $this->CifStartup->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('controller' => 'Cif', 'action' => 'startupList'));
            }
        }
        $this->changeCSRFToken();
    }
    public function startupList($id = null)
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifStartup');
        $data_list = $this->CifStartup->find('all', array('order' => array('CifStartup.id DESC')));
        $this->set('data_list', $data_list);
    }
    public function startupsImport($id = null)
    {
        $this->_userSessionCheckout();
      
        $this->loadModel('CifStartup');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file = $this->request->data['CifStartup']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if ($file["size"] > 0 && $ext == 'xls' && $file['name'] == 'cif_start_ups_enrolled.xls') {
            $data->read($this->request->data['CifStartup']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];

            $details = array();

            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();

                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j + 1])) {
                        $getData[$j] = $sheet['cells'][$i][$j + 1];
                    }
                }
                if (!empty($getData[0])) {
                    $emp_data[] = array('CifStartup' =>
                    array(

                        'startup_name' => ($getData[0] != '') ? $getData[0] : '',
                        'incubation_date' => ($getData[1] != '') ? date('Y-m-d', strtotime($getData[1])) : '',
                        'graduation_date' => ($getData[2] != '') ? date('Y-m-d', strtotime($getData[2])) : '',
                        'founder_name' => ($getData[3] != '') ? $getData[3] : '',
                        'url' => ($getData[4] != '') ? $getData[4] : '',
                        'founder_email' => ($getData[5] != '') ? $getData[5] : '',
                        'mobile' => ($getData[6] != '') ? $getData[6] : '',
                        'no_employees' => ($getData[7] != '') ? $getData[7] : '',
                        'no_employees_women' => ($getData[8] != '') ? $getData[8] : '',
                        'is_women_founder' => ($getData[9] != '') ? $getData[9] : '',   
                        'year' => ($getData[10] != '') ? $getData[10] : '',
                        'phase' => ($getData[11] != '') ? $getData[11] : '',
                        'centre' => ($getData[12] != '') ? $getData[12] : '',
                    ));
                    $details[] = $getData;
                }
            }
            $this->CifStartup->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        } else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this->redirect(array('action' => 'startupList'));
    }
    public function startupRisedFunds($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        
        $this->loadModel('CifStartupRisedFund');
        $this->getYear();
        $this->getCifStartups();

        if(!empty($this->request->data)) {
            if ($this->request->data['CifStartupRisedFund']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'startupRisedFunds'));
            }
            if($this->request->data['CifStartupRisedFund']['type']=="edit"){
                $this->request->data = $this->CifStartupRisedFund->read(null,$this->request->data['CifStartupRisedFund']['id']);
            } else if($this->request->data['CifStartupRisedFund']['type']=="delete"){
                $id=$this->request->data['CifStartupRisedFund']['id'];
    
                if($this->CifStartupRisedFund->deleted($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
                    $this->redirect(array('action'=>'startupRisedFunds'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");
                    $this->redirect(array('action' => 'startupRisedFunds'));
                }
            } else if($this->request->data['CifStartupRisedFund']['type']=="insert") {
                if($this->request->data['CifStartupRisedFund']['id']){
                    $message="Updated Successfully";
                }
                else{
                    $message="Added Successfully";
                }
               
                $tmp_doc_name=$this->request->data['CifStartupRisedFund']['file']['tmp_name'];
                $doc_name=$this->request->data['CifStartupRisedFund']['file']['name'];
                $doc_name_old=$this->request->data['CifStartupRisedFund']['file_old'];
                $doc_type=$this->request->data['CifStartupRisedFund']['file']['type'];
                $new_doc_name="";
                $img_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
                $allowed_doc_types = array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG','.pdf','.PDF');
                $doc_name = date("YmdHis").''.$img_doc_ext;
                if($doc_name!='') {
                    if(in_array($img_doc_ext,$allowed_doc_types)) {
                        if($doc_name_old != '') {
                            unlink(WWW_ROOT."cif_startup_raised_fund/".$doc_name_old);
                        }
                        $new_doc_name =  $doc_name;
                        $target_doc = WWW_ROOT."cif_startup_raised_fund/".$new_doc_name;
                        move_uploaded_file($tmp_doc_name,$target_doc);
                    } else {
                        $img_message="Only image and pdf file is allowed.";
                        $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$img_message.".</div>");
                        $this -> redirect(array('action' => 'startupRisedFunds'));
                    }
                } else {
                    $doc_name = $doc_name_old;
                }
                $this->request->data['CifStartupRisedFund']['file']=$new_doc_name;
                
                $this->CifStartupRisedFund->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this->redirect(array('action' =>'startupRisedFunds'));
            }
        }
        $this->CifStartupRisedFund->bindModel(array('belongsTo'=>array("CifStartup")));
        $data_list = $this->CifStartupRisedFund->find('all',['order'=>['CifStartupRisedFund.id DESC']]);
        $this->set('manage_list',$data_list);
        $this->changeCSRFToken();
    }
    public function startupsRisedFundsList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifStartupRisedFund');
        $this->CifStartupRisedFund->bindModel(array('belongsTo'=>array("CifStartup")));
        $data_list = $this->CifStartupRisedFund->find('all',['order'=>['CifStartupRisedFund.id DESC']]);
        //print_r($data_list); exit();
        $this->set('data_list',$data_list);
    }
    public function startupRisedFundsImport($id = null) {
        $this->_userSessionCheckout();
        $this->loadModel('CifStartupRisedFund');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['CifStartupRisedFund']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && $file['name']=='cif_startup_rised_funds.xls') {
            $data->read($this->request->data['CifStartupRisedFund']["file"]['tmp_name']);
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
                    $emp_data[] = array('CifStartupRisedFund'=>
                        array(
                            'cif_startup_id'           =>     $this->request->data['CifStartupRisedFund']["program_name_id"],
                            'date_of_funding'           =>     ($getData[0]!='')?date('Y-m-d', strtotime($getData[0])):'',
                            'amount'                    =>     ($getData[1]!='')?$getData[1]:'',
                            'founder_name'              =>     ($getData[2]!='')?$getData[2]:'',
                            'public_announcement_link'  =>     ($getData[3]!='')?$getData[3]:'',
                            'year'                      =>     ($getData[4]!='')?$getData[4]:'',
                        ));
                    $details[] = $getData;
                }
            }
            $this->CifStartupRisedFund->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Added Successfully.</div>");
        }
        else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this -> redirect(array('action' => 'startupsRisedFundsList'));
    }
    public function publicityMention($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
      
        $this->loadModel('CifPublicityMention');
        $this->getYear();

        if(!empty($this->request->data)) {
            if ($this->request->data['CifPublicityMention']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'publicityMention'));
            }
            if($this->request->data['CifPublicityMention']['type']=="edit"){
                $this->request->data = $this->CifPublicityMention->read(null,$this->request->data['CifPublicityMention']['id']);
                $this->request->data['CifPublicityMention']['published_date'] = date('d-m-Y', strtotime($this->request->data['CifPublicityMention']['published_date']));
            } else if($this->request->data['CifPublicityMention']['type']=="delete"){
                $id=$this->request->data['CifPublicityMention']['id'];
    
                if($this->CifPublicityMention->deleted($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
                    $this->redirect(array('action'=>'publicityMention'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");
                    $this->redirect(array('action' => 'publicityMention'));
                }
            } else if($this->request->data['CifPublicityMention']['type']=="insert") {
                if($this->request->data['CifPublicityMention']['id']){
                    $message="Updated Successfully";
                }
                else{
                    $message="Added Successfully";
                }
                $tmp_doc_name=$this->request->data['CifPublicityMention']['image']['tmp_name'];
                $doc_name=$this->request->data['CifPublicityMention']['image']['name'];
                $doc_name_old=$this->request->data['CifPublicityMention']['image_old'];
                $doc_type=$this->request->data['CifPublicityMention']['image']['type'];
                $new_doc_name="";
                $img_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
                $allowed_doc_types = array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG');
                $doc_name = date("YmdHis").''.$img_doc_ext;
                if($doc_name!='') {
                    if(in_array($img_doc_ext,$allowed_doc_types)) {
                        if($doc_name_old != '') {
                            unlink(WWW_ROOT."cif_publicity_mention/".$doc_name_old);
                        }
                        $new_doc_name =  $doc_name;
                        $target_doc = WWW_ROOT."cif_publicity_mention/".$new_doc_name;
                        move_uploaded_file($tmp_doc_name,$target_doc);
                    } else {
                        $img_message="Only image file is allowed.";
                        $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$img_message.".</div>");
                        $this -> redirect(array('action' => 'publicityMention'));
                    }
                } else {
                    $doc_name = $doc_name_old;
                }
                $this->request->data['CifPublicityMention']['image']=$doc_name;
                $this->request->data['CifPublicityMention']['published_date'] = date('Y-m-d', strtotime($this->request->data['CifPublicityMention']['published_date']));
                $this->CifPublicityMention->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this->redirect(array('action' =>'publicityMention'));
            }
        }
        $data_list = $this->CifPublicityMention->find('all',['order'=>['CifPublicityMention.id DESC']]);
        $this->set('manage_list',$data_list);
        $this->changeCSRFToken();
    }  
    public function genderDiversity($id = null) { 
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
      
        $this->getYear();
        $this->loadModel('CifGenderDiversity');
        if (!empty($this->request->data)) {
            if ($this->request->data['CifGenderDiversity']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'genderDiversity'));
            }
            if ($this->request->data['CifGenderDiversity']['type'] == "edit") {
                $this->request->data = $this->CifGenderDiversity->read(null, $this->request->data['CifGenderDiversity']['id']);
                $this->request->data['CifGenderDiversity']['date'] = date('d-m-Y', strtotime($this->request->data['CifGenderDiversity']['date']));
            } else if ($this->request->data['CifGenderDiversity']['type'] == "delete") {
                $roundtable_id = $this->request->data['CifGenderDiversity']['id'];
                if ($this->CifGenderDiversity->deleted($roundtable_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'genderDiversity'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'genderDiversity'));
                }
            } else if ($this->request->data['CifGenderDiversity']['type'] == "insert") {
                if ($this->request->data['CifGenderDiversity']['id']) {
                    $message = "Data Updated Successfully";
                } else {
                    $message = "Data Added Successfully";
                }
                $this->request->data['CifGenderDiversity']['date'] = date('Y-m-d', strtotime($this->request->data['CifGenderDiversity']['date']));
                $this->CifGenderDiversity->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'genderDiversity'));
            }
        }
        $table_list = $this->CifGenderDiversity->find('all', array('order' => array('CifGenderDiversity.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function genderDiversityParticipant($id = null){
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
       
        $this->_userSessionCheckout();
        $this->loadModel('CifGenderDiversity');
        $this->loadModel('CifGenderDiversityParticipant');
        $this->getCifGenderDiversity();

        if ($this->request->data['CifGenderDiversityParticipant']['type'] == "insert") {
            $participant_name = $this->request->data['participant_name'];
            for ($i = 0; $i < count($participant_name); $i++) {
                $data = array(
                    "CifGenderDiversityParticipant" => array(
                        "cif_gender_diversity_id" => $this->request->data['CifGenderDiversityParticipant']['cif_gender_diversity_id'],
                        "participant_name" => $this->request->data['participant_name'][$i],
                        "contact_number" => $this->request->data['contact_number'][$i],
                        "gender" => $this->request->data['gender'][$i],
                        "email" => $this->request->data['email'][$i],
                        "organization" => $this->request->data['organization'][$i],
                    )
                );
                $this->CifGenderDiversityParticipant->saveAll($data);
            }
            $message = "Participant Added Successfully";
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
            $this->redirect(array('action' => 'genderDiversityParticipantList'));
        } elseif ($this->request->data['CifGenderDiversityParticipant']['csrf_token'] != "") {
            if ($this->request->data['CifGenderDiversityParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'icParticipants'));
            }
        }
        $this->changeCSRFToken();
    }
    public function genderDiversityParticipantList($id = null){
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       
        $this->loadModel('CifGenderDiversityParticipant');
        if ($this->request->data['CifGenderDiversityParticipant']['type'] == "delete") {
            $gender_diversity_participant_id = $this->request->data['CifGenderDiversityParticipant']['id'];
            if ($this->CifGenderDiversityParticipant->deleted($gender_diversity_participant_id)) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'genderDiversityParticipantList'));
            } else {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'genderDiversityParticipantList'));
            }
        } else {
            $this->CifGenderDiversityParticipant->bindModel(array('belongsTo' => array("CifGenderDiversity")));
            $participants_list = $this->CifGenderDiversityParticipant->find('all', array(
                'order' => array('CifGenderDiversityParticipant.id DESC')
            ), array());
            //print_r( $participants_list);
            $this->set('participants_list', $participants_list);
        }
    }
    public function genderDiversityParticipantsImport($id = null) {
        $this->_userSessionCheckout();
       
        $this->loadModel('CifGenderDiversityParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file = $this->request->data['CifGenderDiversityParticipant']["file"];
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if ($file["size"] > 0 && $ext == 'xls' && $file['name'] == 'genderDiversityParticipants.xls') {
            //print_r(123); exit();
            $data->read($this->request->data['CifGenderDiversityParticipant']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];
            //print_r($cols); exit();
            $details = array();
            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();
                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j + 1])) {
                        $getData[$j] = $sheet['cells'][$i][$j + 1];
                    }
                }
                if (!empty($getData[0])) {
                    $emp_data[] = array(
                        'CifGenderDiversityParticipant' =>
                        array(
                            'cif_gender_diversity_id' => $this->request->data['CifGenderDiversityParticipant']["program_id"],
                            'participant_name' => ($getData[0] != '') ? $getData[0] : '',
                            'gender' => ($getData[1] != '') ? $getData[1] : '',
                            'contact_number' => ($getData[2] != '') ? $getData[2] : '',
                            'email' => ($getData[3] != '') ? $getData[3] : '',
                            'organization' => ($getData[4] != '') ? $getData[4] : '',
                        )
                    );
                    $details[] = $getData;
                }
            }
            $this->CifGenderDiversityParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        } else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this->redirect(array('action' => 'genderDiversityParticipantList'));
    }
    public function externalEvent($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
       
        $this->loadModel('CifExternalEvent');
        $this->getYear();
        
        if(!empty($this->request->data)) {
            if ($this->request->data['CifExternalEvent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'externalEvent'));
            }
            if ($this->request->data['CifExternalEvent']['type'] == "edit") {
                $this->request->data = $this->CifExternalEvent->read(null, $this->request->data['CifExternalEvent']['id']);
                $this->request->data['CifExternalEvent']['date'] = date('d-m-Y', strtotime($this->request->data['CifExternalEvent']['date']));
            } else if ($this->request->data['CifExternalEvent']['type'] == "delete") {
                $roundtable_id = $this->request->data['CifExternalEvent']['id'];
                if ($this->CifExternalEvent->deleted($roundtable_id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                    $this->redirect(array('action' => 'externalEvent'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                    $this->redirect(array('action' => 'externalEvent'));
                }
            } else if ($this->request->data['CifExternalEvent']['type'] == "insert") {
                if ($this->request->data['CifExternalEvent']['id']) {
                    $message = "Data Updated Successfully";
                } else {
                    $message = "Data Added Successfully";
                }
                $this->request->data['CifExternalEvent']['date'] = date('Y-m-d', strtotime($this->request->data['CifExternalEvent']['date']));
                $this->CifExternalEvent->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
                $this->redirect(array('action' => 'externalEvent'));
            }
        }
        $table_list = $this->CifExternalEvent->find('all', array('order' => array('CifExternalEvent.id DESC')));
        $this->set('table_list', $table_list);

        $this->changeCSRFToken();
    }
    public function externalEventParticipant($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifExternalEvent');
        $this->loadModel('CifExternalEventParticipant');
        $this->getCifExternalEvent();

        if ($this->request->data['CifExternalEventParticipant']['type'] == "insert") {
            $participant_name = $this->request->data['participant_name'];
            for ($i = 0; $i < count($participant_name); $i++) {
                $data = array(
                    "CifExternalEventParticipant" => array(
                        "cif_external_event_id" => $this->request->data['CifExternalEventParticipant']['cif_external_event_id'],
                        "participant_name" => $this->request->data['participant_name'][$i],
                        "contact_number" => $this->request->data['contact_number'][$i],
                        "gender" => $this->request->data['gender'][$i],
                        "email" => $this->request->data['email'][$i],
                        "organization" => $this->request->data['organization'][$i],
                    )
                );
                $this->CifExternalEventParticipant->saveAll($data);
            }
            $message = "Participant Added Successfully";
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>" . $message . ".</div>");
            $this->redirect(array('action' => 'externalEventParticipantList'));
        } elseif ($this->request->data['CifExternalEventParticipant']['csrf_token'] != "") {
            if ($this->request->data['CifExternalEventParticipant']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect(array('action' => 'icParticipants'));
            }
        }
        $this->changeCSRFToken();
    }
    public function externalEventParticipantList($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        
        $this->loadModel('CifExternalEventParticipant');
        if ($this->request->data['CifExternalEventParticipant']['type'] == "delete") {
            $external_event_participant_id = $this->request->data['CifExternalEventParticipant']['id'];
            if ($this->CifExternalEventParticipant->deleted($external_event_participant_id)) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this->redirect(array('action' => 'externalEventParticipantList'));
            } else {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this->redirect(array('action' => 'externalEventParticipantList'));
            }
        } else {
            $this->CifExternalEventParticipant->bindModel(array('belongsTo' => array("CifExternalEvent")));
            $participants_list = $this->CifExternalEventParticipant->find('all', array(
                'order' => array('CifExternalEventParticipant.id DESC')
            ), array());
            $this->set('participants_list', $participants_list);
        }
    }
    public function externalEventParticipantsImport($id = null) {
        $this->_userSessionCheckout();
        
        $this->loadModel('CifExternalEventParticipant');
        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file = $this->request->data['CifExternalEventParticipant']["file"];
        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if ($file["size"] > 0 && $ext == 'xls' && $file['name'] == 'externalEventParticipants.xls') {
            //print_r(123); exit();
            $data->read($this->request->data['CifExternalEventParticipant']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];
            //print_r($cols); exit();
            $details = array();
            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();
                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j + 1])) {
                        $getData[$j] = $sheet['cells'][$i][$j + 1];
                    }
                }
                if (!empty($getData[0])) {
                    $emp_data[] = array(
                        'CifExternalEventParticipant' =>
                        array(
                            'cif_external_event_id' => $this->request->data['CifExternalEventParticipant']["program_id"],
                            'participant_name' => ($getData[0] != '') ? $getData[0] : '',
                            'gender' => ($getData[1] != '') ? $getData[1] : '',
                            'contact_number' => ($getData[2] != '') ? $getData[2] : '',
                            'email' => ($getData[3] != '') ? $getData[3] : '',
                            'organization' => ($getData[4] != '') ? $getData[4] : '',
                        )
                    );
                    $details[] = $getData;
                }
            }
            $this->CifExternalEventParticipant->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Participants Added Successfully.</div>");
        } else {
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Format.</div>");
        }
        fclose($file);
        $this->redirect(array('action' => 'externalEventParticipantList'));
    }
    public function connect($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
      
        $this->loadModel('CifConnect');
        $this->getYear();

        if(!empty($this->request->data)) {
            if ($this->request->data['CifConnect']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'connect'));
            }
            if($this->request->data['CifConnect']['type']=="edit"){
                $this->request->data = $this->CifConnect->read(null,$this->request->data['CifConnect']['id']);
            } else if($this->request->data['CifConnect']['type']=="delete"){
                $id=$this->request->data['CifConnect']['id'];
    
                if($this->CifConnect->deleted($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
                    $this->redirect(array('action'=>'connect'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");
                    $this->redirect(array('action' => 'connect'));
                }
            } else if($this->request->data['CifConnect']['type']=="insert") {
                if($this->request->data['CifConnect']['id']){
                    $message="Updated Successfully";
                }
                else{
                    $message="Added Successfully";
                }
                $tmp_doc_name=$this->request->data['CifConnect']['image']['tmp_name'];
                $doc_name=$this->request->data['CifConnect']['image']['name'];
                $doc_name_old=$this->request->data['CifConnect']['image_old'];
                $doc_type=$this->request->data['CifConnect']['image']['type'];
                $new_doc_name="";
                $img_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
                $allowed_doc_types = array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG','.pdf','.PDF');
                $doc_name = date("YmdHis").''.$img_doc_ext;
                if($doc_name!='') {
                    if(in_array($img_doc_ext,$allowed_doc_types)) {
                        if($doc_name_old != '') {
                            unlink(WWW_ROOT."cif_connect/".$doc_name_old);
                        }
                        $new_doc_name =  $doc_name;
                        $target_doc = WWW_ROOT."cif_connect/".$new_doc_name;
                        move_uploaded_file($tmp_doc_name,$target_doc);
                    } else {
                        $img_message="Only image and pdf file is allowed.";
                        $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$img_message.".</div>");
                        $this -> redirect(array('action' => 'connect'));
                    }
                } else {
                    $doc_name = $doc_name_old;
                }
                $this->request->data['CifConnect']['image']=$doc_name;
                $this->CifConnect->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this->redirect(array('action' =>'connect'));
            }
        }
        $data_list = $this->CifConnect->find('all',['order'=>['CifConnect.id DESC']]);
        $this->set('manage_list',$data_list);
        $this->changeCSRFToken();
    }
    public function customerSatisfaction($id = null) {
        date_default_timezone_set('Asia/Kolkata');
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
      
        $this->loadModel('CifCustomerSatisfaction');
        $this->getYear();

        if(!empty($this->request->data)) {
            if ($this->request->data['CifCustomerSatisfaction']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'customerSatisfaction'));
            }
            if($this->request->data['CifCustomerSatisfaction']['type']=="edit"){
                $this->request->data = $this->CifCustomerSatisfaction->read(null,$this->request->data['CifCustomerSatisfaction']['id']);
                $this->request->data['CifCustomerSatisfaction']['feedback_date'] = date('d-m-Y', strtotime($this->request->data['CifCustomerSatisfaction']['feedback_date']));
            } else if($this->request->data['CifCustomerSatisfaction']['type']=="delete"){
                $id=$this->request->data['CifCustomerSatisfaction']['id'];
    
                if($this->CifCustomerSatisfaction->deleted($id)) {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");
                    $this->redirect(array('action'=>'customerSatisfaction'));
                } else {
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");
                    $this->redirect(array('action' => 'customerSatisfaction'));
                }
            } else if($this->request->data['CifCustomerSatisfaction']['type']=="insert") {
                if($this->request->data['CifCustomerSatisfaction']['id']){
                    $message="Updated Successfully";
                }
                else{
                    $message="Added Successfully";
                }
                $this->request->data['CifCustomerSatisfaction']['feedback_date'] = date('Y-m-d', strtotime($this->request->data['CifCustomerSatisfaction']['feedback_date']));
                $tmp_doc_name=$this->request->data['CifCustomerSatisfaction']['file']['tmp_name'];
                $doc_name=$this->request->data['CifCustomerSatisfaction']['file']['name'];
                $doc_name_old=$this->request->data['CifCustomerSatisfaction']['file_old'];
                $doc_type=$this->request->data['CifCustomerSatisfaction']['file']['type'];
                $new_doc_name="";
                $img_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
                $allowed_doc_types = array('.jpg','.JPG','.jpeg','.JPEG','.png','.PNG','.pdf','.PDF');
                $doc_name = date("YmdHis").''.$img_doc_ext;
                if($doc_name!='') {
                    if(in_array($img_doc_ext,$allowed_doc_types)) {
                        if($doc_name_old != '') {
                            unlink(WWW_ROOT."cif_customer_satisfaction/".$doc_name_old);
                        }
                        $new_doc_name =  $doc_name;
                        $target_doc = WWW_ROOT."cif_customer_satisfaction/".$new_doc_name;
                        move_uploaded_file($tmp_doc_name,$target_doc);
                    } else {
                        $img_message="Only image and pdf file is allowed.";
                        $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$img_message.".</div>");
                        $this -> redirect(array('action' => 'customerSatisfaction'));
                    }
                } else {
                    $doc_name = $doc_name_old;
                }
                $this->request->data['CifCustomerSatisfaction']['file']=$doc_name;
                
                $this->CifCustomerSatisfaction->save($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                $this->redirect(array('action' =>'customerSatisfaction'));
            }
        }
        $data_list = $this->CifCustomerSatisfaction->find('all',['order'=>['CifCustomerSatisfaction.id DESC']]);
        $this->set('manage_list',$data_list);
        $this->changeCSRFToken();
    }
    public function target($id = null) {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->cifTargetType();
        $this->loadModel('CifTarget');

        if(!empty($this->request->data)) {
            if ($this->request->data['CifTarget']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'target'));
            }
        }
        //print_r($this->request->data); exit();

        if($this->request->data['CifTarget']['types']=="edit"){
            $this->request->data = $this->CifTarget->read(null,$this->request->data['CifTarget']['id']);
        }
        else if($this->request->data['CifTarget']['types']=="delete"){
            $id=$this->request->data['CifTarget']['id'];

            if($this -> CifTarget -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'target'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Target delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'target'));
            }
        }
        else if($this->request->data['CifTarget']['types']=="insert"){
            if($this->request->data['CifTarget']['id']){
                $message="Target Updated Successfully";
            }
            else{
                $message="Target Added Successfully";
            }

            $this->CifTarget->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'target'));

        }

        $manage_list = $this->CifTarget->find('all',array('order'=>array('CifTarget.id DESC')));
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function organization($id = null) {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifOrganization');

        if(!empty($this->request->data)) {
            if ($this->request->data['CifOrganization']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'organization'));
            }
        }
        //print_r($this->request->data); exit();

        if($this->request->data['CifOrganization']['types']=="edit"){
            //print_r($this->request->data['CifOrganization']); exit();
            $this->request->data = $this->CifOrganization->read(null,$this->request->data['CifOrganization']['id']);
        }
        else if($this->request->data['CifOrganization']['types']=="delete"){
            $id=$this->request->data['CifOrganization']['id'];

            if($this -> CifOrganization -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Organization data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'organization'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Organization delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'organization'));
            }
        }
        else if($this->request->data['CifOrganization']['types']=="insert"){
            //print_r($this->request->data['CifOrganization']); exit();   
            if($this->request->data['CifOrganization']['id']){
                $message="Organization Updated Successfully";
            }
            else{
                $message="Organization Added Successfully";
            }

            $this->CifOrganization->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'organization'));

        }

        $manage_list = $this->CifOrganization->find('all',array('order'=>array('CifOrganization.id DESC')));
        //print_r($manage_list); exit();
        $this->set('manage_list',$manage_list);
        $this->changeCSRFToken();
    }
    public function fund($id = null) {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifFund');
        $this->loadModel('FinancialYear');
        $this->getCifOrganization();
        $this->_getFundingYear();
        $types = '';
        if(!empty($this->request->data)) {
            //print_r($this->request->data); exit();

            if ($this->request->data['CifFund']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'fund'));
            }
        }

        if($this->request->data['CifFund']['type']=="edit"){
            $this->request->data = $this->CifFund->read(null,$this->request->data['CifFund']['id']);
        }

        else if($this->request->data['CifFund']['type']=="delete"){
            $id=$this->request->data['CifFund']['id'];
            //print_r($this->request->data); exit();
            if($this -> CifFund -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'fund'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'fund'));
            }
        }
        else if($this->request->data['CifFund']['type']=="insert"){

            if($this->request->data['CifFund']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }
			
			/*Upload UC*/
            $tmp_doc_name=$this->request->data['CifFund']['upload_uc']['tmp_name'];
            $doc_name=$this->request->data['CifFund']['upload_uc']['name'];
            $doc_name_old=$this->request->data['CifFund']['upload_uc_old'];
            $doc_type=$this->request->data['CifFund']['upload_uc']['type'];
            $new_doc_name="";
            $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
            $allowed_doc_types = array('.pdf','.PDF');
            if($doc_name!='') {
                if(in_array($pdf_doc_ext,$allowed_doc_types)) {
                    if($doc_name_old != ''){
                        unlink(WWW_ROOT."upload_uc/".$doc_name_old);
                    }
                    $doc_name = date("YmdHis").''.$pdf_doc_ext;
                    $new_doc_name =  $doc_name;
                    $target_doc = WWW_ROOT."upload_uc/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'fund'));
                }
            }else{
                $doc_name = $doc_name_old;
            }
            /*Upload UC*/
			
			/*Upload Bank Statement*/
            $tmp_doc_name=$this->request->data['CifFund']['upload_bs']['tmp_name'];
            $doc_name_bs=$this->request->data['CifFund']['upload_bs']['name'];
            $doc_name_bs_old=$this->request->data['CifFund']['upload_bs_old'];
            $doc_type=$this->request->data['CifFund']['upload_bs']['type'];
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
                $doc_name_bs = date("YmdHis").''.$pdf_doc_ext;
                    $new_doc_name =  $doc_name_bs;
                    $target_doc = WWW_ROOT."upload_bs/".$new_doc_name;
                    move_uploaded_file($tmp_doc_name,$target_doc);
                }
                else
                {
                    $message="Document only PDF file type is allowed.";
                    $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
                    $this -> redirect(array('action' => 'fund'));
                }
            }else{
                $doc_name_bs = $doc_name_bs_old;
            }
            /*Upload Bank Statement*/
			
			//NEW 24 - 10 - 20
			$this->request->data['CifFund']['upload_uc']=$doc_name;
			$this->request->data['CifFund']['upload_bs']=$doc_name_bs;
			//NEW 24 - 10 - 20
			
			//$this->request->data['Financial']['types']=$types;
			$result= $this->CifFund->hasAny(array("types"=>$this->request->data['CifFund']['types'],"expenses_type"=>$this->request->data['CifFund']['expenses_type'],"id !="=>$this->request->data['CifFund']['id'],"financial_year_id"=>$this->request->data['CifFund']['financial_year_id']));
            if($result){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-warning'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Fund for this Finantial Year Exist</div>");
                $this -> redirect(array('action' =>'fund'));
            }

            $this->CifFund->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>'fund'));

        }

        $this->CifFund->bindModel(array("belongsTo"=>array("FinancialYear")));
        $this->CifFund->bindModel(array("belongsTo"=>array("CifOrganization"=>array('foreignKey'=>'types'))));
		$manage_list = $this->CifFund->find('all',array("order"=>array('CifFund.id DESC')));
        //print_r($manage_list); exit();
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
    public function fundExpenditureList($id = null) {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifExpenditure');

        $this->CifExpenditure->bindModel(array("belongsTo"=>array("FinancialYear")));
        $this->CifExpenditure->bindModel(array("belongsTo"=>array("CifOrganization"=>array('foreignKey'=>'types'))));
        $manage_list = $this->CifExpenditure->find('all',array("order"=>array('CifExpenditure.id DESC')));
        $this->set('manage_list',$manage_list);

        $this->changeCSRFToken();
    }
    public function fundExpenditure($id = null) {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('CifExpenditure');
        $this->loadModel('FinancialYear');
        $this->_getFundingYear();
        $this->getCifOrganization();
        $types="";

        if(!empty($this->request->data)) {
            $data = new \Spreadsheet_Excel_Reader();
            $data->setOutputEncoding('ISO-8859-1');
            $file=$this->request->data['Exel']["file"];



            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
            if($file["size"] >0 && $ext=='xls' && $file['name']=='cif_expense.xls')
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
                        $emp_data[] = array('CifExpenditure'=>
                            array(

                                'financial_year_id'=>$this->request->data['Exel']["finance_year_id"],
                                'types'=>$this->request->data['Exel']['cif_organization_id'],
                                'amount_spent'=>        ($getData[0]!='')?$getData[0]:'',
                                'expense_type'=>    ($getData[1]!='')?$getData[1]:'',
                                'date'=>             ($getData[2]!='')?date('Y-m-d',strtotime($getData[2])):'',
                                'end_date'=>             ($getData[3]!='')?date('Y-m-d',strtotime($getData[3])):'',
                                'details'=>  ($getData[4]!='')?$getData[4]:'',
                                'remarks'=>           ($getData[5]!='')?$getData[5]:'',
                                'phase'=>($getData[6]!='')?$getData[6]:'',
                                'centre' => ($getData[7] != '') ? $getData[7] : '',


                            ));
                        $details[] = $getData;
                    }
                }
                if(sizeof($emp_data)>0)$this->CifExpenditure->saveAll($emp_data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Expense Uploaded Successfully.</div>");
               
                $this -> redirect(array('action' =>"fundExpenditureList"));
            }

            fclose($file);

            if ($this->request->data['CifExpenditure']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
               // print_r($this->request->data);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' =>'fundExpenditure'));
            }
        }
        //print_r($this->request->data); exit();
        if($this->request->data['CifExpenditure']['type']=="edit"){
            $this->request->data = $this->CifExpenditure->read(null,$this->request->data['CifExpenditure']['id']);
            $this->request->data['CifExpenditure']['date']=date('d-m-Y',strtotime($this->request->data['CifExpenditure']['date']));
            $this->request->data['CifExpenditure']['end_date']=date('d-m-Y',strtotime($this->request->data['CifExpenditure']['end_date']));

        }

        else if($this->request->data['CifExpenditure']['type']=="delete"){
            if($this->CifExpenditure->deleted($this->request->data['CifExpenditure']['id'])){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Data have been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'fundExpenditureList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  Delete Failed.Please try again.</div>");

                $this -> redirect(array('action' => 'fundExpenditureList'));
            }
        }
        else if($this->request->data['CifExpenditure']['type']=="insert"){
            //print_r($this->request->data); exit();
            if($this->request->data['CifExpenditure']['document_new']['name']!= ''){
                $tmp_doc_name=$this->request->data['CifExpenditure']['document_new']['tmp_name'];
                $doc_name=$this->request->data['CifExpenditure']['document_new']['name'];
                $doc_type=$this->request->data['CifExpenditure']['document_new']['type'];
                $new_doc_name="";
                $pdf_doc_ext = substr($doc_name, strripos($doc_name, '.')); // get file name
                $allowed_doc_types = array('.pdf','.PDF');
                $doc_name = date("YmdHis").''.$pdf_doc_ext;
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
                        $this -> redirect(array('action' =>"fundExpenditure"));
                    }
                    $this->request->data['CifExpenditure']['document'] = $new_doc_name;
                }
            }
            /*Documents Upload*/

            if($this->request->data['CifExpenditure']['id']){
                $message="Updated Successfully";
            }
            else{
                $message="Added Successfully";
            }

            $this->request->data['CifExpenditure']['types']=$this->request->data['CifExpenditure']['cif_organization_id'];
              $this->request->data['CifExpenditure']['date']=date('Y-m-d',strtotime($this->request->data['CifExpenditure']['date']));
             $this->request->data['CifExpenditure']['end_date']=date('Y-m-d',strtotime($this->request->data['CifExpenditure']['end_date']));
            $this->CifExpenditure->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' =>"fundExpenditureList"));

        }
        $this->changeCSRFToken();
    }
   
}
