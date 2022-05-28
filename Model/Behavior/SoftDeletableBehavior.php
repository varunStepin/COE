<?php

// models/behaviors/soft_deletable.php
class SoftDeletableBehavior extends ModelBehavior {
    function setup(&$Model, $settings = array()) {
        // do any setup here
    }

    // override the delete function (behavior methods that override model methods take precedence)
    function deleted(&$Model, $id = null) {
        $Model->id = $id;

        // save the deleted field with current date-time
        if ($Model->saveField('deleted', date('Y-m-d H:i:s'))) {
            return true;
        }

        return false;
    }

    function beforeFind(&$Model, $query) {
        // only include records that have null deleted columns
        $query['conditions']["{$Model->alias}.deleted"] =NULL;
        return $query;
    }
}
