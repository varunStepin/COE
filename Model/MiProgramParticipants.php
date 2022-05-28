<?php
App::uses('Model', 'Model');
class MiProgramParticipants extends AppModel {
    public $belongsTo=array("MiPrograms");
}
