<?php
App::uses('Model', 'Model');
class MiIcParticipants extends AppModel {
    public $belongsTo=array("MiInternationalConferences");
}
