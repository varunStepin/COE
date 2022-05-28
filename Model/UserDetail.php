<?php

App::uses('Model', 'Model');

class UserDetail extends AppModel {
    //public $belongsTo=array("CollegeDetail");
    public function beforeSave($options = array())
    {
        parent::beforeSave();
        if (isset($this->data[$this->alias])) {
            $this->data[$this->alias]['college_detail_id'] = h($this->data[$this->alias]['college_detail_id'], true, null);
            $this->data[$this->alias]['user_id'] = h($this->data[$this->alias]['user_id'], true, null);
            $this->data[$this->alias]['firstname'] = h($this->data[$this->alias]['firstname'], true, null);
            $this->data[$this->alias]['lastname'] = h($this->data[$this->alias]['lastname'], true, null);
            $this->data[$this->alias]['gender'] = h($this->data[$this->alias]['gender'], true, null);
            $this->data[$this->alias]['email'] = h($this->data[$this->alias]['email'], true, null);
            $this->data[$this->alias]['mobile'] = h($this->data[$this->alias]['mobile'], true, null);
            $this->data[$this->alias]['website'] = h($this->data[$this->alias]['website'], true, null);
            $this->data[$this->alias]['alternate_mobile'] = h($this->data[$this->alias]['alternate_mobile'], true, null);
            $this->data[$this->alias]['user_type'] = h($this->data[$this->alias]['user_type'], true, null);
            $this->data[$this->alias]['status'] = h($this->data[$this->alias]['status'], true, null);
            $this->data[$this->alias]['sector_id'] = h($this->data[$this->alias]['sector_id'], true, null);
            return true;
        }
    }
}
