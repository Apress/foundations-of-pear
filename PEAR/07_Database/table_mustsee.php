<?php
class mustsee extends DB_Table {
    var $col = array(
            'ms_id' => array(
            'type'    => 'integer'
        ),
            'ms_rank' => array(
            'type'    => 'integer',
            'size'    => 3,
            'qf_label' => 'Movie Ranking',
            'qf_type'  => 'text',
            'qf_rules' => array(
                'required' => 'Please enter a movie ranking',
                'numeric'    => 'Please enter a numeric value'
            )
        ),
            'ms_name'    => array(
            'type'        => 'varchar',
            'size'        => 100,
            'qf_label'    => 'Movie name',
            'qf_type'    => 'text',
            'qf_rules'    => array(
                'required'    => 'Please enter a movie name'
            )
        ),
            'ms_year'    => array(
            'type'        => 'year',
            'size'        => 4,
            'qf_label'    => 'Movie Year',
            'qf_type'    => 'text',
            'qf_rules'    => array(
                'required'    => 'Please enter the movie year',
                'numeric' => 'Please enter a numeric value',
                'minlength' => array(
                    'Please enter a 4 digit year',
                    4
                ),
                'maxlength' => array(
                    'Please enter a 4 digit year',
                    4
                )
            )
        )

     );
}
?>
