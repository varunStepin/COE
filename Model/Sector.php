<?php
App::uses('Model', 'Model');
class Sector extends AppModel {
    //public $belongsTo=array("CollegeDetail");
    public function beforeSave($options = array())
    {
        parent::beforeSave();
        if (isset($this->data[$this->alias]['sector'])) {
            $this->data[$this->alias]['sector'] = h($this->data[$this->alias]['sector'], true, null);
            return true;
        }
    }
}
