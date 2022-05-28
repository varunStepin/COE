<?php
App::uses('Model', 'Model');
class MiProgramStudents extends AppModel {
    public $belongsTo=array("MiPrograms");
}
