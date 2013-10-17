<?php

$FunctionList = array();

$FunctionList['web2lead'] = array(

      'name' => 'web2lead',
      'call_method' => array(
            'include_file' => 'extension/salesforce/modules/salesforce/salesforce.php',
            'class' => 'salesforce',
            'method' => 'web2lead'
        ),
      'parameter_type' => 'standard',
      'parameters' => array( array( 'name' => 'formdata',
                                    'required' => true,
                                    'default' => false ) ));

?>
