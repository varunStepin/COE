<?php

App::uses('AppController', 'Controller');
include('excel_reader2.php');
class MinroController extends AppController {



    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');





	public function workshop() {

        $this->layout = 'fab_layout';

        $this->loadModel('MinroWorkshop');

        $this->_userSessionCheckout();

        if(!empty($this->request->data)) {

            if ($this->request->data['MinroWorkshop']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this->redirect($this->referer());
            }
        }

        if($this->request->data['MinroWorkshop']['actionType']=="edit"){
            $this->request->data = $this->MinroWorkshop->read(null,$this->request->data['MinroWorkshop']['id']);
            $this->request->data['MinroWorkshop']['month']=$this->request->data['MinroWorkshop']['month'].'-'.$this->request->data['MinroWorkshop']['year'];
        }
        else if($this->request->data['MinroWorkshop']['actionType']=="delete"){
            $id=$this->request->data['MinroWorkshop']['id'];

            if($this -> MinroWorkshop -> deleted($id)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>  data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'workshopList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'workshopList'));
            }
        }
        else if($this->request->data['MinroWorkshop']['actionType']=="insert"){

            //$monthYear=explode('-',$this->request->data['MinroWorkshop']['month']);
            //$this->request->data['MinroWorkshop']['month']=$monthYear[0];
            //$this->request->data['MinroWorkshop']['year']=$monthYear[1];
            $monthYear=explode('-',$this->request->data['MinroWorkshop']['date']);
			$this->request->data['MinroWorkshop']['month']=date('F', mktime(0, 0, 0, $monthYear[1], 10));
			$this->request->data['MinroWorkshop']['year']=$monthYear[2];


            $date =  $this->request->data['MinroWorkshop']['date'] ;
            $this->request->data['MinroWorkshop']['date']= $date ? date('Y-m-d',strtotime($date)): '';
            if($this->request->data['MinroWorkshop']['id']){
                $message="Iot Events / Workshops Updated Successfully";
            }
            else{
                $message="Iot Events / Workshops Added Successfully";
            }
            $this->MinroWorkshop->save($this->request->data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> ".$message.".</div>");
            $this -> redirect(array('action' => 'workshopList'));
        }

        $this->changeCSRFToken();
    }
	public function workshopList() {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('MinroWorkshop');
        $data_list = $this->MinroWorkshop->find('all',['order'=>['id DESC']]);
        $this->set('data_list',$data_list);

    }
    public function workshopParticipants($id=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('MinroWorkshop');  $this->loadModel('ParticipantsDetail');

        $list_array = array();
        $details = $this->MinroWorkshop->find('all',array("order"=>"MinroWorkshop.id ASC"));
        foreach($details as $list) {
            $list_array[$list['MinroWorkshop']['id']] = $list['MinroWorkshop']['title'];
        }
        $this->set('programs',$list_array);

        if($this->request->data['ParticipantsDetail']['type']=="insert")
        {
            $participant_name = $this->request->data['participant_name'];
            for($i=0;$i<count($participant_name);$i++) {
                $data = array(
                    "ParticipantsDetail"=>array(
                        "program_type"=>'MinroWorkshop',
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
        $this->loadModel('ParticipantsDetail');

        $this->ParticipantsDetail->bindModel(array('belongsTo'=>array('MinroWorkshop'=>array('foreignKey'=>'program_id','type'=>'INNER'))));

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
            $participants_list = $this->ParticipantsDetail->find('all',array('conditions'=>array('ParticipantsDetail.program_type'=>'MinroWorkshop'),
                'order'=>array('ParticipantsDetail.id DESC')),array(
                'contain' => array(
                    'MinroWorkshop' => array(
                        'conditions' => array(
                            'MinroWorkshop.id' => 'ParticipantsDetail.programs_id'
                        ),
                    )
                ),
            ));
            $this->set('participants_list',$participants_list);
        }
    }

}
