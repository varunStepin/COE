<?php

App::uses('Model', 'Model');

class ManageTraining extends AppModel {
    public $hasMany=array("ManageAttendees"=>array('fields'=>array('id')));
}
