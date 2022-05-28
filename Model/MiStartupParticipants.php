<?php
App::uses('Model', 'Model');
class MiStartupParticipants extends AppModel {
    public $belongsTo=array("MiStartupConferences");
}
