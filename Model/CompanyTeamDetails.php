<?php
App::uses('Model', 'Model');
class CompanyTeamDetails extends AppModel {
    var $actsAs = array('SoftDeletable');

    public $belongsTo=array("Companies");
}
