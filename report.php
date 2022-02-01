<?php

// use SimpleXMLElement;

class Report
{
    public function XmlReport($data)
    {
        $xml = new SimpleXMLElement('<root/>');
        array_walk_recursive($data, array($xml, 'addChild'));
        return $xml->asXML();
    }

    public function JsonReport($data){
        return json_encode($data);
    }
}
