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
class AerosoaceController extends AppController {


	public $uses = array("");
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');


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
                            'qualification'=>   ($getData[1]!='')?$getData[1]:'',
                            'contact_number'=>  ($getData[2]!='')?$getData[2]:'',
                            'email'=>           ($getData[3]!='')?$getData[3]:'',
                            'city'=>            ($getData[4]!='')?$getData[4]:'',

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
}
