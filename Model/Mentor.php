<?php
App::uses('Model', 'Model');
class Mentor extends AppModel {
    public $belongsTo=array("Sector");
}
