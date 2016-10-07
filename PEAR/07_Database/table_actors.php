<?php
class actors extends DB_Table {
    var $col = array(
        'act_id' => array(
        'type'    => 'integer',
        'require' => true
        ),
                'act_name' => array(
                'type'    => 'varchar',
                'size'    => 100
        )
     );
    var $idx = array(
                'act_id' => array(
                'type' => 'unique',
                'cols' => 'act_id'
        )
    );
}
?>