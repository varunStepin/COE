<?php
App::uses('Model', 'Model');
class Announcement extends AppModel {
    public function beforeSave($options = array())
    {
        parent::beforeSave();
        if (isset($this->data[$this->alias])) {
            $this->data[$this->alias]['title'] = h($this->data[$this->alias]['title'], true, null);
            $this->data[$this->alias]['date'] = h($this->data[$this->alias]['date'], true, null);
            $this->data[$this->alias]['detail'] = h($this->data[$this->alias]['detail'], true, null);
            return true;
        }
    }
}
