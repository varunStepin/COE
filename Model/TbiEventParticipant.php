<?php
App::uses('Model', 'Model');
class TbiEventParticipant extends AppModel {
    //var $actsAs = array('SoftDeletable');
     
    public $belongsTo = array("TbiEvent");
  
}