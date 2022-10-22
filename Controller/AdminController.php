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

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class AdminController extends AppController
{



    public $helpers = array('Html', 'Form', 'Js', 'Session');
    public $components = array('RequestHandler', 'Email');

    public function dashboard()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('Financials');
        $this->loadModel('FinancialYear'); // Updated by Pavan Kumar M (27/10/2020)
		$phase=$this->Session->read('Phase');
        if($this->Session->read('ApplicationType')=='TBI'){
            return  $this -> redirect(array('action' => 'tbiDashboard'));
        } else if ($this->Session->read('ApplicationType') == 'CIF') {
            return  $this->redirect(array('action' => 'cifDashboard'));
        }

		/*----------------------------------------------Budget------------------------------------------*/
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$IoT =$this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'IoT','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Machine = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'MI & Robotics','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Aerospace = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Aerospace & Defense','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Cyber =$this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Cyber Security','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Animation = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Animation','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$DataScience = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Data Science and AI','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Camp = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'KTECH Centre','FinancialYear.current'=>1)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Fabless = $this->Financials->find('first', array('conditions' => array('phase'=>$phase, 'types' => 'Fabless','FinancialYear.current'=>1)));
		//print_r($DataScience);
		$this->set(compact('IoT', $IoT,'Machine', $Machine,'Aerospace', $Aerospace,'Cyber', $Cyber,'Animation', $Animation,'DataScience', $DataScience,'Camp', $Camp,'Fabless', $Fabless));

        /*----------------------------------------------Budget------------------------------------------*/

        /*--------------------------------expense-----------------------------------------------------*/
          $result=$this->Financials->query("SELECT DATE_FORMAT(`date`,'%M') as month, sum(amount_spent) total,types FROM `expenditures`
                                         INNER JOIN financial_years ON financial_years.id=financial_year_id
                                            where expenditures.phase='".$phase."' AND financial_years.current=1 GROUP BY types, DATE_FORMAT(`date`,'%Y-%m')");
        $expense=[];

        foreach ($result as $list){
            $expense[$list['expenditures']['types']]['total']+=$list[0]['total'];
            $expense[$list['expenditures']['types']][$list[0]['month']]+=$list[0]['total'];
        }
        $this->set('expenseDetails',$expense);

        /*-----------Get Current Financial Year - Pavan Kumar M(28/10/2020)-----------*/
		$current_financial_year = $this->FinancialYear->find('first',array('conditions'=>array('FinancialYear.current'=>1)));
		$this->set('current_financial_year',$current_financial_year['FinancialYear']['year']);
	    /*-----------Get Current Financial Year - Pavan Kumar M(28/10/2020)-----------*/
    }

    public function innovatorsAcceleratedPopUp($id = null)
    {
        $this->layout = 'ajax';
        $this->set('type',$id);

    }
     public function financialYear($id=null,$type=null){
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('FinancialYear');
        if(!empty($this->request->data)){

            $condition = array('FinancialYear.year'=>$this->request->data['FinancialYear']['year'],'id !='=>$this->request->data['FinancialYear']['id']);
            $check=$this->FinancialYear->hasAny($condition);
            if(!empty($check)) {
                $this->Session->setFlash("<div class='notify-alert alert alert-warning col-xl-3 col-lg-3 col-md-3 col-12 animated fadeInDown' id='php-alert'>
                    <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><i class='fa fa-check'></i>Year is already Present..</div>");
                $this -> redirect(array('action' => 'financialYear'));
            }
            $this->FinancialYear->save($this->request->data);
            if($this->request->data['FinancialYear']['id']!='')
                $msg='Data Updated Successfully.';
            else
                $msg='Data Saved Successfully.';

            $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-success'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button>$msg</div>");
            $this -> redirect(array('action' => 'financialYear'));
        }
        if($id){
            if($type=='Delete'){
                $this->FinancialYear->delete($id);
                $this->Session->setFlash("<div id='php-alert' class='alert alert-dismissible alert-danger'><span class='glyphicon glyphicon-remove-circle'></span><button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true' style='color:black;'>&times;</span></button> Data has been deleted Successfully.</div>");
                $this -> redirect(array('action' => 'financialYear'));
            }
            if($type=='Edit'){
                $this->request->data=$this->FinancialYear->read(null,$id);
            }
        }
        $dataList = $this->FinancialYear->find('all',array('order'=>array('FinancialYear.id DESC')));
        $this->set('year_list',$dataList);
        $this->changeCSRFToken();
    }
     public function expenseDetailsPopUp($type = null, $month = null)
    {
        $this->loadModel('Expenditure');
        $phase = $this->Session->read('Phase');
        $expenseYear = $this->Session->read('TBIYear');
        $months = date('m', strtotime('2021-'.$month.'-21'));

        $this->Expenditure->bindModel(array("belongsTo" => array("FinancialYear")));
        $expense = $this->Expenditure->find('all', array('conditions' => array('phase' => $phase, 'types' => $type, 'FinancialYear.id' => $expenseYear, 'month(date)' => $months)));
     
        $this->set('expenseDetails', $expense);
        $this->set('header', $type);
    }

    /*--------------------------By Pavan Kumar M(28/10/2020)--------------------------*/
	public function financialReport() {
		Configure::write('debug',0);
		$this->layout = 'fab_layout';
        $this->_userSessionCheckout();
		$this->loadModel('Financials');
		$this->loadModel('FinancialYear');
		$phase=$this->Session->read('Phase');
		$this->_getFundingYear();
		if(!empty($this->request->data)) {

			$financial_year_id = $this->request->data['Financials']['financial_year_id'];
		/*----------------------------------------------Budget------------------------------------------*/
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$IoT =$this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'IoT','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Machine = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'MI & Robotics','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Aerospace = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Aerospace & Defense','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Cyber =$this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Cyber Security','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Animation = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Animation','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$DataScience = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Data Science and AI','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Camp = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'KTECH Centre','Financials.financial_year_id'=>$financial_year_id)));
		 $this->Financials->bindModel(array("belongsTo"=>array("FinancialYear")));
		$Fabless = $this->Financials->find('first', array('conditions' => array('phase'=>$phase,'types' => 'Fabless','Financials.financial_year_id'=>$financial_year_id)));
		//print_r($DataScience);
		$this->set(compact('IoT', $IoT,'Machine', $Machine,'Aerospace', $Aerospace,'Cyber', $Cyber,'Animation', $Animation,'DataScience', $DataScience,'Camp', $Camp,'Fabless', $Fabless));

        /*----------------------------------------------Budget------------------------------------------*/

        /*--------------------------------expense-----------------------------------------------------*/
          $result=$this->Financials->query("SELECT DATE_FORMAT(`date`,'%M') as month, sum(amount_spent) total,types FROM `expenditures`
                                         INNER JOIN financial_years ON financial_years.id=financial_year_id
                                            where expenditures.phase='".$phase."' AND expenditures.financial_year_id=$financial_year_id GROUP BY types, expenditures.financial_year_id,DATE_FORMAT(`date`,'%m')");
        $expense=[];

        foreach ($result as $list){
            $expense[$list['expenditures']['types']]['total']+=$list[0]['total'];
            $expense[$list['expenditures']['types']][$list[0]['month']]=$list[0]['total'];
        }
        $this->set('expenseDetails',$expense);
        //print_r($expense);

		$financial_year = $this->FinancialYear->find('first',array('conditions'=>array('FinancialYear.id'=>$financial_year_id)));
		$this->set('financial_year',$financial_year['FinancialYear']['year']);
		$this->set('financial_year_id',$financial_year['FinancialYear']['id']);
		}
	}



	/*-------------------By Pavan Kumar M(27/10/2020)-------------------*/
	public function expenseDetailsPopUpExtended($type=null,$month=null,$year=null){
		Configure::write('debug',0);
        $this->loadModel('Expenditure');
		$phase=$this->Session->read('Phase');
        $this->Expenditure->bindModel(array("belongsTo"=>array("FinancialYear")));
        $expense=$this->Expenditure->find('all',array('conditions'=>array("phase"=>$phase,"types"=>$type,'FinancialYear.id'=>$year,'month(date)'=>date('m',strtotime($month)))));

        $this->set('expenseDetails',$expense);
        $this->set('header',$type);


    }

    /*-------------------By Varun SIT (25/11/2021)-------------------*/
       public function tbiDashboard()
    {
        $this->layout = 'fab_layout';
        $this->_userSessionCheckout();
        $this->loadModel('Financials');
        $this->loadModel('FinancialYear');
       
        $phase = $this->Session->read('Phase');
      
        $expenseYear = $this->Session->read('TBIYear');
      
        $this->set('expenseYear', $expenseYear);

        Configure::write('debug', 1);
        if ($this->Session->read('ApplicationType') == 'COE') {
            return  $this->redirect(array('action' => 'dashboard'));
        }
        $this->loadModel('TbiStartup');

        $this->_getFundingYear();

        $this->Financials->bindModel(array("belongsTo" => array("FinancialYear")));
        $CeNSE = $this->Financials->find('first', array('conditions' => array('phase' => $phase, 'types' => 'CeNSE', 'Financials.financial_year_id' => $expenseYear)));
        $this->Financials->bindModel(array("belongsTo" => array("FinancialYear")));
        $CPDM = $this->Financials->find('first', array('conditions' => array('phase' => $phase, 'types' => 'CPDM', 'Financials.financial_year_id' => $expenseYear)));
        $this->Financials->bindModel(array("belongsTo" => array("FinancialYear")));
        $ManipalUniversity = $this->Financials->find('first', array('conditions' => array('phase' => $phase, 'types' => 'Manipal University', 'Financials.financial_year_id' => $expenseYear)));
        $this->Financials->bindModel(array("belongsTo" => array("FinancialYear")));
        $RamaiahUniversity = $this->Financials->find('first', array('conditions' => array('phase' => $phase, 'types' => 'Ramaiah University', 'Financials.financial_year_id' => $expenseYear)));
        $this->Financials->bindModel(array("belongsTo" => array("FinancialYear")));
        $this->set(compact('CeNSE', $CeNSE, 'CPDM', $CPDM, 'ManipalUniversity', $ManipalUniversity, 'RamaiahUniversity', $RamaiahUniversity));


        $manage_list = $this->TbiStartup->query("SELECT phase,university,is_selected,is_incubated,is_innovations_commercialized,is_incubated_off_tbi,is_graduated, count(*) as counts FROM `tbi_startups` WHERE deleted IS NULL AND tbi_startups.phase='" . $phase . "' GROUP BY  university,is_selected,is_incubated,is_innovations_commercialized,is_incubated_off_tbi,is_graduated ORDER BY `tbi_startups`.`university` ASC");
        $finalArray = [];
        $finalArray["NSTBI"]['title'] = "Centre for Nano Science and Engineering (CeNSE), IISc., Bengaluru";
        $finalArray["DMTBI"]['title'] = "Centre for Product Design and Manufacturing (CPDM), IISc., Bengaluru";
        $finalArray["MUTBI"]['title'] = "Manipal Universal Technology Business Incubator, Manipal, Udupi";
        $finalArray["RMTBI"]['title'] = "Ramaiah University of Applied Sciences, Bengaluru";
        foreach ($manage_list as $list) {
            $data = $list['tbi_startups'];
            $count = $list[0]['counts'];
            $selected = $incubated = $innovations = $tbi = $graduated = $event_conducted = 0;
            $finalArray[$data['university']]['count'] += $count;
            if ($data['is_selected']) $selected = $count;
            if ($data['is_incubated']) $incubated = $count;
            if ($data['is_innovations_commercialized']) $innovations = $count;
            if ($data['is_incubated_off_tbi']) $tbi = $count;
            if ($data['is_graduated']) $graduated = $count;


            $finalArray[$data['university']]['selected'] += $selected;
            $finalArray[$data['university']]['incubated'] += $incubated;
            $finalArray[$data['university']]['innovations'] += $innovations;
            $finalArray[$data['university']]['tbi'] += $tbi;
            $finalArray[$data['university']]['graduated'] += $graduated;
        }
        $this->loadModel('TbiEvent');
        $manage_events = $this->TbiEvent->query("SELECT university, count(*) as counts FROM `tbi_events` WHERE tbi_events.phase='" . $phase . "'  GROUP BY `university` ORDER BY `tbi_events`.`university` ASC");

        foreach ($manage_events as $list) {
            $data = $list['tbi_events'];
            $count = $list[0]['counts'];

            $finalArray[$data['university']]['event_conducted'] += $count;
        }
        /*--------------------------------expense-----------------------------------------------------*/
        $result = $this->Financials->query("SELECT DATE_FORMAT(`date`,'%M') as month, sum(amount_spent) total,types FROM `expenditures`
                         INNER JOIN financial_years ON financial_years.id=financial_year_id
                            where expenditures.phase='" . $phase . "' AND expenditures.financial_year_id='" . $expenseYear . "' GROUP BY types, DATE_FORMAT(`date`,'%Y-%m')");
        $expense = [];

        foreach ($result as $list) {
            $expense[$list['expenditures']['types']]['total'] += $list[0]['total'];
            $expense[$list['expenditures']['types']][$list[0]['month']] += $list[0]['total'];
        }
        $this->set('expenseDetails', $expense);
        $current_financial_year = $this->FinancialYear->find('first', array('conditions' => array('FinancialYear.current' => 1)));
        $this->set('current_financial_year', $current_financial_year['FinancialYear']['year']);

        $this->set('finalArray', json_encode($finalArray));
    }
	public function tbiDashboardPopup($university, $type)
    {
        $this->layout = 'ajax';
        $phase = $this->Session->read('Phase');


        if ($type != 'is_event_conducted') {
            $this->loadModel('TbiStartup');
            $conditions['university'] = $university;
            $conditions['phase'] = $phase;
            if ($type != 'all') $conditions[$type] = 1;
            $manage_list = $this->TbiStartup->find('all', ['conditions' => $conditions]);
        } else  if ($type == 'is_event_conducted') {
            $this->loadModel('TbiEvent');
            $conditions['TbiEvent.university'] = $university;
            $conditions['phase'] = $phase;
            $manage_list = $this->TbiEvent->find('all', ['conditions' => $conditions]);
            //  print_r($manage_list);
        }
        $this->set('manage_list', $manage_list);
        $this->set('type', $type);
        $this->set('university',$university);
    }

   public function cifDashboard($year = null)
    {
        $this->loadModel('CifRoundtable');
        $this->loadModel('CifRoundTableParticipant');
        $this->loadModel('CifHackathon');
        $this->loadModel('CifPublicityMention');
        $this->loadModel('CifStartup');
        $this->loadModel('CifStartupRisedFund');
        $this->loadModel('CifGenderDiversity');
        $this->loadModel('CifGenderDiversityParticipant');
        $this->loadModel('CifExternalEvent');
        $this->loadModel('CifExternalEventParticipant');
        $this->loadModel('CifConnect');
        $this->loadModel('CifCustomerSatisfaction');
        $this->loadModel('CifTarget');
        $this->layout = 'fab_layout';
        $phase = $this->Session->read('Phase');
        $centre = $this->Session->read('Centre');
       

        $year = $year != '' ? $year : date('Y');
        $graphCounts = [];

        /**================== Events Graph Query ====================================== */
        $graphCounts['Events'] = $this->CifRoundtable->find('all', array(
            'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array(
                'SUM(CASE WHEN event_type = "Conference" THEN 1 ELSE 0 END) as Conference',
                'SUM(CASE WHEN event_type = "Round Table" THEN 1 ELSE 0 END) as RoundTable',
                'SUM(CASE WHEN event_type = "Hackathon" THEN 1 ELSE 0 END) as Hackathon',
                'COUNT(*) AS count'
            )
        ))[0][0];
        $graphCounts['EventsTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
            'group' => 'type'
        ));
        foreach ($graphCounts['EventsTarget'] as $event_list) {
            foreach ($event_list as $event) {
                if ($event['type'] === 'Round Table' || $event['type'] === 'Conference' || $event['type'] === 'Hackathon') {
                    $graphCounts['EventsTarget']['count'] += $event['count'];
                }
            }
        }
        /**================== Publicity Mentions Graph Query ====================================== */
        $graphCounts['PublicityMentions'] = $this->CifPublicityMention->find('all', array(
            'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array(
                'SUM(CASE WHEN media_type = "Online Platform" THEN 1 ELSE 0 END) as OnlinePlatform',
                'SUM(CASE WHEN media_type = "News Paper" THEN 1 ELSE 0 END) as NewsPaper',
                'COUNT(*) AS count'
            )
        ))[0][0];

        $graphCounts['PublicityMentionsTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
            'group' => 'type'
        ));
        foreach ($graphCounts['PublicityMentionsTarget'] as $publicity_list) {
            foreach ($publicity_list as $publicity) {
                if ($publicity['type'] === 'News Paper' || $publicity['type'] === 'Online Platform') {
                    $graphCounts['PublicityMentionsTarget']['count'] += $publicity['count'];
                }
            }
        }
        /**==================Startups Enrolled Graph Query ====================================== */
        $graphCounts['Startup'] = $this->CifStartup->find('all', array(
            'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array('COUNT(*) AS count')
        ))[0][0];
        $graphCounts['StartupsTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Startups', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['StartupsTarget']['count'] = $graphCounts['StartupsTarget'][0]['CifTarget']['count'];

        /**==================Startups Raised Fund Graph Query ====================================== */
        $this->CifStartupRisedFund->bindModel(array('belongsTo' => array('CifStartup')));
        $fundsRaised = $this->CifStartupRisedFund->find('all', array(
            'conditions' => array('CifStartupRisedFund.year' => $year, 'CifStartup.phase' => $phase, 'CifStartup.centre' => $centre),
            'fields' => array('SUM(amount) AS amount', 'CifStartup.startup_name', 'CifStartup.id'),
            'group' => 'cif_startup_id'
        ));
        $fundSArr = [];
        foreach ($fundsRaised as $item) {
            $fundSArr[] = [
                'name' => $item['CifStartup']['startup_name'],
                'y' => $item[0]['amount'],
                'startup_id' => $item['CifStartup']['id'],
            ];
        }
        $graphCounts['StartupRaisedFund'] = $fundSArr;

        $graphCounts['StartupsTargetToRaiseFund'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Fund Raised by Startup', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['StartupsTargetToRaiseFund']['count'] = $graphCounts['StartupsTargetToRaiseFund'][0]['CifTarget']['count'];


        /**==================Gender Diversity Graph Query ====================================== */
        $graphCounts['GenderDiversityPrograms'] = $this->CifGenderDiversity->find('all', array(
            'conditions' => array('CifGenderDiversity.year' => $year, 'CifGenderDiversity.phase' => $phase, 'CifGenderDiversity.centre' => $centre),
            'fields' => array('percentage_woman_participants', 'event_name', 'id', 'phase'),
        ));


        $graphCounts['GenderDiversityTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Gender Diversity', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['GenderDiversityTarget']['count'] = $graphCounts['GenderDiversityTarget'][0]['CifTarget']['count'];


        /**==================External Event Participant Graph Query ====================================== */
        $graphCounts['ExternalEventParticipant'] = $this->CifExternalEvent->find('all', array(
            'conditions' => array('CifExternalEvent.year' => $year, 'CifExternalEvent.phase' => $phase, 'CifExternalEvent.centre' => $centre),
            'joins' => array(
                array(
                    'table' => 'cif_external_event_participants',
                    'alias' => 'CifExternalEventParticipant',
                    'type' => 'LEFT',
                    'conditions' => array('CifExternalEventParticipant.cif_external_event_id = CifExternalEvent.id', 'CifExternalEventParticipant.deleted IS NULL')
                ),
            ),
            'fields' => array('COUNT(CifExternalEventParticipant.id) AS count', 'CifExternalEvent.event_name', 'CifExternalEvent.id'),
            'group' => array('CifExternalEvent.id'),
        ));
        $graphCounts['ExternalEventParticipantTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Participation in External Events', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['ExternalEventParticipantTarget']['count'] = $graphCounts['ExternalEventParticipantTarget'][0]['CifTarget']['count'];

        /**==================Connects Graph Query ====================================== */
        $graphCounts['Connects']  = $this->CifConnect->find('all', array(
            'conditions' => array('CifConnect.year' => $year, 'CifConnect.phase' => $phase, 'CifConnect.centre' => $centre),
            'fields' => array('COUNT(id) AS count'),
        ))[0][0];

        $graphCounts['ConnectTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Connects', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['ConnectTarget']['count'] = $graphCounts['ConnectTarget'][0]['CifTarget']['count'];

        /**==================Customer Satisfaction Graph Query ====================================== */
        $customerSatisfactionDetails = $this->CifCustomerSatisfaction->find('all', array(
            'conditions' => array('CifCustomerSatisfaction.year' => $year, 'phase' => $phase, 'centre' => $centre),
            'fields' => array('SUM(satisfaction_pecentage) AS satisfaction_pecentage', 'COUNT(id) AS count', 'feedback_date'),
            'group' => array('feedback_date')
        ));
        $customerSatisfactionDetailsArr = [];
        foreach ($customerSatisfactionDetails as $item) {
            $customerSatisfactionDetailsArr[] = [
                'percentage' => ($item[0]['satisfaction_pecentage'] / $item[0]['count']),
                'date' => date('d-M-y', strtotime($item['CifCustomerSatisfaction']['feedback_date']))
            ];
        }
        $graphCounts['CustomerSatisfaction'] = $customerSatisfactionDetailsArr;
        $graphCounts['CustomerSatisfactionTarget'] = $this->CifTarget->find('all', array(
            'conditions' => array('year' => $year, 'type' => 'Customer Satisfaction', 'phase' => $phase, 'centre' => $centre),
            'fields' => array('count', 'type'),
        ));
        $graphCounts['CustomerSatisfactionTarget']['count'] = $graphCounts['CustomerSatisfactionTarget'][0]['CifTarget']['count'];
        $this->set('graphCounts', $graphCounts);
        $this->set('year', $year);
        $this->set('years', $this->getYear());


        $this->loadModel('CifFund');
        $this->loadModel('CifExpenditures');
        $this->loadModel('CifOrganization');
        $fyYear = $year;
        $fyYear = substr($year, -2);

        $fyYear = "20" . ($fyYear - 1) . "-" . $fyYear;
        $centre = $this->Session->read('Centre');

        $this->CifFund->bindModel(array("belongsTo" => array("FinancialYear", "CifOrganization" => array("foreignKey" => 'types'))));
        $funds = $this->CifFund->find('all', array('conditions' => array('FinancialYear.year Like' => $fyYear, 'CifFund.phase' => $phase, 'CifOrganization.centre' => $centre), 'group' => array("types")));
        $category = [];
        $fundDetails = [];
        foreach ($funds as $key => $fund) {
            $category[$key] = $fund['CifOrganization']['name'];
            $fundDetails['FundReceived'][$key] = (int)$fund['CifFund']['approved_amount'];
            $fundDetails['FundUtilized'][$key] = (int)$fund['CifFund']['amount_utilized'];
            $fundDetails['FundRemaining'][$key] = $fund['CifFund']['approved_amount'] - $fund['CifFund']['amount_utilized'];
        }
        $this->set('fundDetails', $fundDetails);
        $this->set('fundcategory', $category);


        /*---------------------------------------Expense------------------------------*/
        $this->CifExpenditures->bindModel(array("belongsTo" => array("FinancialYear", "CifOrganization" => array("foreignKey" => 'types'))));
        $expence = $this->CifExpenditures->find('all', array(
            'fields' => array(
                'SUM(amount_spent) as amountSpent',
                'CifOrganization.name',
                'types'
            ),
            'conditions' => array('FinancialYear.year Like' => $fyYear, 'CifOrganization.name !=' => '', 'CifExpenditures.phase Like' => $phase, 'CifOrganization.centre' => $centre),  'group' => array("types")
        ));

        $category = [];
        $expenceDetails = [];
        foreach ($expence as $key => $fund) {
            $category[$key] = $fund['CifOrganization']['name'];
            $expenceDetails[$key]['name'] = $fund['CifOrganization']['name'];
            $expenceDetails[$key]['y'] = (int)$fund[0]['amountSpent'];
            $expenceDetails[$key]['drilldown'] = (int)$fund['CifExpenditures']['types'];
        }
        $this->set('expenceDetails', $expenceDetails);
        $this->CifExpenditures->bindModel(array("belongsTo" => array("FinancialYear", "CifOrganization" => array("foreignKey" => 'types'))));

        $expence = $this->CifExpenditures->find('all', array(
            'fields' => array(
                'SUM(amount_spent) as amountSpent',
                'CifOrganization.name',
                'types', 'MONTH(date) as month'
            ),
            'conditions' => array('FinancialYear.year Like' => $fyYear, 'CifOrganization.name !=' => '', 'CifExpenditures.phase Like' => $phase), 'order' => array('types DESC'), 'group' => array("MONTH(date)", "types")
        ));


        $result = array();
        $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
        foreach ($expence as $element) {
            $result[$element['CifExpenditures']['types']][$element[0]['month']] = $element;
        }
        $expenceDetailsMonthly = [];
        $i = 0;
        foreach ($result as $key => $expence) {
            foreach ($months as $key1 => $month) {
                if ($key1 == 0) {
                    $expenceDetailsMonthly[$i]['name'] = $fund['CifOrganization']['name'];
                    $expenceDetailsMonthly[$i]['id'] = $key;
                }
                $expenceDetailsMonthly[$i]['data'][$key1]['name'] = $month;
                $expenceDetailsMonthly[$i]['data'][$key1]['y'] = 0 + $expence[$key1 + 1][0]['amountSpent'];
                $expenceDetailsMonthly[$i]['data'][$key1]['module'] = $key;
            }
            $i++;
        }
        $this->set('expenceDetailsMonthly', $expenceDetailsMonthly);
    }
    public function cifDashboardDetail()
    {
        $this->loadModel('CifRoundtable');
        $this->loadModel('CifHackathon');
        $this->loadModel('CidRoundTableParticipant');
        $this->loadModel('CifPublicityMention');
        $this->loadModel('CifStartup');
        $this->loadModel('CifStartupRisedFund');
        $this->loadModel('CifGenderDiversity');
        $this->loadModel('CifGenderDiversityParticipant');
        $this->loadModel('CifExternalEvent');
        $this->loadModel('CifExternalEventParticipant');
        $this->loadModel('CifConnect');
        $this->loadModel('CifCustomerSatisfaction');
        $this->loadModel('CifTarget');
        $phase = $this->Session->read('Phase');
        $centre = $this->Session->read('Centre');

        $this->layout = 'ajax';
        $queryString = $this->request->query;

        $year = $queryString['year'];

        if ($queryString['type'] == 'Events') {
            $list = $this->CifRoundtable->find('all', array(
                'conditions' => array('year' => $year, 'event_type' => $queryString['category'], 'phase' => $phase, 'centre' => $centre),
                'order' => array('id DESC')
            ));
        } else if ($queryString['type'] == 'Publicity Mentions') {
            $list = $this->CifPublicityMention->find('all', array(
                'conditions' => array('year' => $year, 'media_type' => $queryString['category'], 'phase' => $phase, 'centre' => $centre),
                'order' => array('id DESC')
            ));
        } else if ($queryString['type'] == 'Startups Enrolled') {
            $list = $this->CifStartup->find('all', array(
                'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
                'order' => array('id DESC')
            ));
        } else if ($queryString['type'] == 'Fund Raised By Startup') {
            $this->CifStartupRisedFund->bindModel(array('belongsTo' => array("CifStartup")));
            $list =  $this->CifStartupRisedFund->find('all', array(
                'conditions' => array('CifStartupRisedFund.year' => $year, 'cif_startup_id' => $queryString['id'], 'CifStartup.phase' => $phase, 'CifStartup.centre' => $centre),
                'order' => array('CifStartupRisedFund.id DESC')
            ));
        } else if ($queryString['type'] == 'Gender Diversity') {
            $this->CifGenderDiversityParticipant->bindModel(array('belongsTo' => array("CifGenderDiversity")));
            $list =  $this->CifGenderDiversityParticipant->find('all', array(
                'conditions' => array('cif_gender_diversity_id' => $queryString['id'], 'gender' => 'Female', 'CifGenderDiversity.year' => $year, 'CifGenderDiversity.phase' => $phase, 'CifGenderDiversity.centre' => $centre),
                'order' => array('CifGenderDiversityParticipant.id DESC')
            ));
        } else if ($queryString['type'] == 'External Event Participants') {
            $this->CifExternalEventParticipant->bindModel(array('belongsTo' => array("CifExternalEvent")));
            $list = $this->CifExternalEventParticipant->find('all', array(
                'conditions' => array('cif_external_event_id' => $queryString['id'], 'CifExternalEvent.year' => $year, 'CifExternalEvent.phase' => $phase, 'CifExternalEvent.centre' => $centre),
                'order' => array('CifExternalEventParticipant.id DESC')
            ));
        } else if ($queryString['type'] == 'Connects') {
            $list = $this->CifConnect->find('all', array(
                'conditions' => array('year' => $year, 'phase' => $phase, 'centre' => $centre),
                'order' => array('id DESC')
            ));
        } else if ($queryString['type'] == 'Customer Satisfaction') {
            $list = $this->CifCustomerSatisfaction->find('all', array(
                'conditions' => array('CifCustomerSatisfaction.year' => $year, 'feedback_date' => date('Y-m-d', strtotime($queryString['id'])), 'phase' => $phase, 'centre' => $centre)
            ));
        }
        $this->set('table_list', $list);
        $this->set('queryString', $queryString);
    }

    public function viewParticipant(){
        $this->loadModel('CifRoundtable');
        $this->loadModel('CifRoundtableParticipant');

        $this->layout = 'ajax';
        $queryString = $this->request->query;

        if($queryString['type'] == 'CifRoundtableParticipant'){
            $this->CifRoundtableParticipant->bindModel(array('belongsTo' => array("CifRoundtable")));
            $list = $this->CifRoundtableParticipant->find('all',array(
                'conditions' => array('cif_roundtable_id'=>$queryString['id'])
            ));
        }

        $this->set('table_list',$list);
        $this->set('queryString', $queryString);
    }
    public function  cifExpenseDetailsPopUp($year = null, $type = null, $month = null)
    {
        $this->loadModel('CifExpenditures');
        $fyYear = substr($year, -2);
        $fyYear = "20" . ($fyYear - 1) . "-" . $fyYear;
        $this->CifExpenditures->bindModel(array("belongsTo" => array("FinancialYear")));
        $expense = $this->CifExpenditures->find('all', array('conditions' => array("types" => $type, 'FinancialYear.year' => $fyYear, 'month(date)' => date('m', strtotime($month)))));
        $this->set('expenseDetails', $expense);
        $this->set('header', $type);
    }
}
