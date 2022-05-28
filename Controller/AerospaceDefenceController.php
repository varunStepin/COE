<?php

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
class AerospaceDefenceController extends AppController {


	public $uses = array('');
    public $helpers = array('Html', 'Form', 'Js','Session');
    public $components = array('RequestHandler', 'Email');



    public function importAerospaceExcelUpload(){

        $this->_userSessionCheckout();

        $data = new \Spreadsheet_Excel_Reader();
        $data->setOutputEncoding('ISO-8859-1');
        $file=$this->request->data['AerospaceExcelUpload']["file"];

        $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
        if($file["size"] >0 && $ext=='xls' && ($file['name']=='sample_aerospace_upload.xls' || $file['name']=='aerospase_defence_students.xls') && $this->request->data['AerospaceExcelUpload']["program_id"] != '')
        {
            $data->read($this->request->data['AerospaceExcelUpload']["file"]['tmp_name']);
            $sheet = $data->sheets[0];
            $rows = $sheet['numRows'];
            $cols = $sheet['numCols'];

            $table = $this->request->data['AerospaceExcelUpload']['table_name'];
            $this->loadModel($table);

            for ($i = 2; $i <= $rows; $i++) {
                $getData = array();

                for ($j = 0; $j <= $cols; $j++) {
                    if (isset($sheet['cells'][$i]) && isset($sheet['cells'][$i][$j+1])) {
                        $getData[$j] = $sheet['cells'][$i][$j+1];
                    }
                }
                if(!empty($getData[0]) &&strtolower($getData[0])!='emp_id') {
					print_r($getData);
                    $emp_data[] = array($table=>
                        array(
                            $this->request->data['AerospaceExcelUpload']["field_name"] => $this->request->data['AerospaceExcelUpload']["program_id"],
                            'attendee_name'     =>  ($getData[0]!='')?$getData[0]:'',
                            'gender'     =>         ($getData[1]!='')?$getData[1]:'',
                            'contact_number'    =>  ($getData[3]!='')?$getData[3]:'',
                            'email_id'          =>  ($getData[4]!='')?$getData[4]:'',
                            'institute_name'    =>  ($getData[2]!='')?$getData[2]:'',
                            'city'             =>  ($getData[5]!='')?$getData[5]:'',

                        ));

                }
            }
            $this->$table->saveAll($emp_data);
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Records Added Successfully.</div>");
        }
        else{
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Invalid File Formate.</div>");

        }
        fclose($file);
        $this->redirect($this->request->data['AerospaceExcelUpload']["redirect_to"]);
    }
    public function internshipCourse(){
        $list_array = array();
        $this->loadModel('InternshipFoundationCourse');
        $details = $this->InternshipFoundationCourse->find('all',array("order"=>"InternshipFoundationCourse.internship_program_name ASC"));

        foreach($details as $list) {
            $list_array[$list['InternshipFoundationCourse']['id']] = $list['InternshipFoundationCourse']['internship_program_name'];
        }
        $this->set('course',$list_array);
    }
    public function advanceProjectCourse(){
        $list_array = array();
        $this->loadModel('AdvanceProjectBasedCourse');
        $details = $this->AdvanceProjectBasedCourse->find('all',array("order"=>"AdvanceProjectBasedCourse.internship_program_name ASC"));

        foreach($details as $list) {
            $list_array[$list['AdvanceProjectBasedCourse']['id']] = $list['AdvanceProjectBasedCourse']['internship_program_name'];
        }
        $this->set('course',$list_array);
    }
    public function orientationAwarenessCourse(){
        $list_array = array();
        $this->loadModel('OrientationAwarenessCourse');
        $details = $this->OrientationAwarenessCourse->find('all',array("order"=>"OrientationAwarenessCourse.internship_program_name ASC"));

        foreach($details as $list) {
            $list_array[$list['OrientationAwarenessCourse']['id']] = $list['OrientationAwarenessCourse']['internship_program_name'];
        }
        $this->set('course',$list_array);
    }


    public function internshipStudent($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('InternshipStudent');
        $branch = array('MCA'=>'MCA','BCA'=>'BCA');
        $this->set('branch',$branch);
        $this->internshipCourse();
        if($this->request->data['InternshipStudent']['type']=="insert")
        {
            // print_r($this->request->data);
            // return;
            $student_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "InternshipStudent"=>array(
                        "internship_foundation_course_id"=>$this->request->data['InternshipStudent']['internship_foundation_course_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "city"=>$this->request->data['city'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                    )
                );
                // pr($data);
                $this->InternshipStudent->saveAll($data);
            }
            $message=" Student Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'internshipStudentList'));
        }


        elseif($this->request->data['InternshipStudent']['csrf_token']!=""){
            if ($this->request->data['InternshipStudent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'programStudent'));

            }
        }
        $this->changeCSRFToken();
    }
    public function internshipStudentList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('InternshipStudent');

        if($this->request->data['InternshipStudent']['type']=="delete"){
            $this->request->data['InternshipStudent']['is_delete'] = 1 ;
            $data = $this->request->data['InternshipStudent'];
            if($this->InternshipStudent->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'internshipStudentList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'internshipStudentList'));
            }
        }
        else{
            $this->InternshipStudent->bindModel(array('belongsTo'=>array("InternshipFoundationCourse")));
            $student_list = $this->InternshipStudent->find('all',array('conditions'=>array('InternshipStudent.is_delete'=>0),
                'order'=>array('InternshipStudent.id DESC')));
            $this->set('manage_list',$student_list);

        }
    }


    public function advanceProjectStudent($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AdvanceProjectStudent');
        $branch = array('MCA'=>'MCA','BCA'=>'BCA');
        $this->set('branch',$branch);
        $this->advanceProjectCourse();
        if($this->request->data['AdvanceProjectStudent']['type']=="insert")
        {
            // print_r($this->request->data);
            // return;
            $student_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "AdvanceProjectStudent"=>array(
                        "advance_project_based_course_id"=>$this->request->data['AdvanceProjectStudent']['advance_project_based_course_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "city"=>$this->request->data['city'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                    )
                );
                $this->AdvanceProjectStudent->saveAll($data);
            }
            $message=" Student Added Successfully";
            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'advanceProjectStudentList'));
        }


        elseif($this->request->data['AdvanceProjectStudent']['csrf_token']!=""){
            if ($this->request->data['AdvanceProjectStudent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'advanceProjectStudentList'));

            }
        }
        $this->changeCSRFToken();
    }
    public function advanceProjectStudentList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('AdvanceProjectStudent');

        if($this->request->data['AdvanceProjectStudent']['type']=="delete"){
            $this->request->data['AdvanceProjectStudent']['is_delete'] = 1 ;
            $data = $this->request->data['AdvanceProjectStudent'];
            if($this->AdvanceProjectStudent->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");

                $this -> redirect(array('action' => 'advanceProjectStudentList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");

                $this -> redirect(array('action' => 'advanceProjectStudentList'));
            }
        }
        else{
            $this->AdvanceProjectStudent->bindModel(array('belongsTo'=>array("AdvanceProjectBasedCourse")));
            $student_list = $this->AdvanceProjectStudent->find('all',array('conditions'=>array('AdvanceProjectStudent.is_delete'=>0),
                'order'=>array('AdvanceProjectStudent.id DESC')));
            $this->set('manage_list',$student_list);

        }
    }

    public function orientationAwarenessStudent($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('OrientationAwarenessStudent');
        $branch = array('MCA'=>'MCA','BCA'=>'BCA');
        $this->set('branch',$branch);
        $this->orientationAwarenessCourse();
        if($this->request->data['OrientationAwarenessStudent']['type']=="insert")
        {
            // print_r($this->request->data);
            // return;
            $student_name = $this->request->data['attendee_name'];
            for($i=0;$i<count($student_name);$i++)
            {
                $data = array(
                    "OrientationAwarenessStudent"=>array(
                        "orientation_awareness_course_id"=>$this->request->data['OrientationAwarenessStudent']['internship_foundation_course_id'],
                        "attendee_name"=>$this->request->data['attendee_name'][$i],
                        "gender"=>$this->request->data['gender'][$i],
                        "institute_name"=>$this->request->data['institute_name'][$i],
                        "email_id"=>$this->request->data['email_id'][$i],
                        "city"=>$this->request->data['city'][$i],
                        "contact_number"=>$this->request->data['contact_number'][$i],
                    )
                );
                // pr($data);
                $this->OrientationAwarenessStudent->saveAll($data);
            }
            $message=" Student Added Successfully";

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>".$message.".</div>");
            $this -> redirect(array('action' => 'orientationAwarenessStudentList'));
        }


        elseif($this->request->data['OrientationAwarenessStudent']['csrf_token']!=""){
            if ($this->request->data['OrientationAwarenessStudent']['csrf_token'] != $this->Session->read('CSRFTOKEN')) {
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Unauthorized access. Please try again.</div>");
                $this -> redirect(array('action' => 'orientationAwarenessStudentList'));

            }
        }
        $this->changeCSRFToken();
    }
    public function orientationAwarenessStudentList($id=null){

        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->getYear();
        $this->getMonth();
        $this->loadModel('OrientationAwarenessStudent');

        if($this->request->data['OrientationAwarenessStudent']['type']=="delete"){
            $this->request->data['OrientationAwarenessStudent']['is_delete'] = 1 ;
            $data = $this->request->data['OrientationAwarenessStudent'];
            if($this->OrientationAwarenessStudent->save($data)){
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'orientationAwarenessStudentList'));
            }
            else{
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>Failed to delete.Please try again.</div>");
                $this -> redirect(array('action' => 'orientationAwarenessStudentList'));
            }
        }
        else{
            $this->OrientationAwarenessStudent->bindModel(array('belongsTo'=>array("OrientationAwarenessCourse")));
            $student_list = $this->OrientationAwarenessStudent->find('all',array('conditions'=>array('OrientationAwarenessStudent.is_delete'=>0),
                'order'=>array('OrientationAwarenessStudent.id DESC')));
            $this->set('manage_list',$student_list);

        }
    }


}
