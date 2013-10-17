<?php

class salesforce {


    public function __construct() {}

    function web2lead($postdata) {

        // Check INI
        $data_INI           = eZINI::instance( "wwsalesforce.ini.append.php" );
        $postURL            = $data_INI->variable( "web2lead" , 'HTTP_POST_URL' );
        $postOid            = $data_INI->variable( "web2lead" , 'OID' );
        $postEncoding       = $data_INI->variable( "web2lead" , 'ENCODING' );
        $postDebug          = $data_INI->variable( "web2lead" , 'DEBUG' );
        $postDebugEmail     = $data_INI->variable( "web2lead" , 'DEBUG_EMAIL' );
        $fieldtranslation   = $data_INI->variable( "web2lead" , 'FieldTranslation' );

        // Set array element for each POST/INI variable (ie. first_name=Arsham)
        $params             = array();
        $params[]           = "oid=" . $postOid;
        $params[]           = "encoding=" . $postEncoding;

        if ($postDebug == 1)
        {
            $params[]       = "debug=" . $postDebug;
            $params[]       = "debugEmail=" . $postDebugEmail;
        }

        foreach($postdata as $key => $data)
        {
            if (isset($fieldtranslation[$key]))
                $params[]   = $fieldtranslation[$key] . "=" . $data;
            else
                $params[]   = $key . "=" . $data;
        }

        $query_string       = join("&", $params);

        // Open cURL connection_aborted
        $ch = curl_init();

        // Set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $postURL);
        curl_setopt($ch, CURLOPT_POST, count($params));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $query_string);

        //Set some settings that make it all work
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, FALSE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        //Execute SalesForce web to lead PHP cURL
        $result = curl_exec($ch);

        //close cURL connection
        curl_close($ch);

        return array('result' => $result);

    }

}

?>