<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
set_time_limit(0);

require 'vendor/autoload.php';
use Parse\ParseObject;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseUser;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
use Parse\ParseClient;

//IDs for Parse
$app_id = "vzFysiKeae7XA4yy4QXsGg9ZlfUW7rFzSnlAgJdi";
$rest_key = "WfmXfsByDb1CjRoD9FvHt5W3YtmEhAsIuyrdcXUq";

//Get current market data
$strMercadoLoading = file_get_contents("data/Mercado.json");
$jsonMercadoLoading = json_decode($strMercadoLoading, true);

//Create variable to count inserted records
$insertedRecordsLoading = 0;
$total = 0;

$list = [];

//Parse initialization
ParseClient::initialize( $app_id, $rest_key, null );
ParseClient::setServerURL('https://parseapi.back4app.com','/');

$round = 34;

$querytodelete = new ParseQuery('Mercado');
$querytodelete->limit(1000);
$querytodelete->equalTo('Rodada_ID', $round);
$itemstodel = $querytodelete->find();
            
if(count($itemstodel) > 0){
//    ParseObject::destroyAll($itemstodel);
}

foreach ($jsonMercadoLoading as $atletaLoading) {

    //Save data to b4a
    
    if ($atletaLoading['Rodada_ID'] == $round){
        $object = new ParseObject("Mercado");
        $object->set('Rodada_ID', $atletaLoading['Rodada_ID']);
        $object->set('Atleta_ID', $atletaLoading['Atleta_ID']);
        $object->set('Apelido', $atletaLoading['Apelido']);
        $object->set('Pos', $atletaLoading['Pos']);
        $object->set('Time', $atletaLoading['Time']);
        $object->set('TimeAbrev', $atletaLoading['TimeAbrev']);
        $object->set('Status', $atletaLoading['Status']);
        $object->set('ADV', $atletaLoading['ADV']);
        $object->set('CF', $atletaLoading['CF']);
        $object->set('CASA', $atletaLoading['CASA']);
        $object->set('FORA', $atletaLoading['FORA']);
        $object->set('CFD', $atletaLoading['CFD']);
        $object->set('CASA_D', $atletaLoading['CASA_D']);
        $object->set('FORA_D', $atletaLoading['FORA_D']);
        $object->set('Pts_Ult', $atletaLoading['Pts_Ult']);
        $object->set('Preco', $atletaLoading['Preco']);
        $object->set('VarPreco', $atletaLoading['VarPreco']);
        $object->set('Media', $atletaLoading['Media']);        
        $object->set('NoJogos', $atletaLoading['NoJogos']);
        $object->set('Indicador', $atletaLoading['Indicador']);
        $object->set('G', $atletaLoading['G']);
        $object->set('A', $atletaLoading['A']);
        $object->set('FT', $atletaLoading['FT']);
        $object->set('FD', $atletaLoading['FD']);
        $object->set('FF', $atletaLoading['FF']);
        $object->set('F', $atletaLoading['F']);
        $object->set('FS', $atletaLoading['FS']);
        $object->set('RB', $atletaLoading['RB']);
        $object->set('SG', $atletaLoading['SG']);
        $object->set('DD', $atletaLoading['DD']);
        $object->set('DP', $atletaLoading['DP']);
        $object->set('PE', $atletaLoading['PE']);
        $object->set('I', $atletaLoading['I']);
        $object->set('PP', $atletaLoading['PP']);
        $object->set('CV', $atletaLoading['CV']);
        $object->set('CA', $atletaLoading['CA']);
        $object->set('FC', $atletaLoading['FC']);
        $object->set('GS', $atletaLoading['GS']);

        array_push($list, $object);

        $insertedRecordsLoading++;        
    }

    
    if ($insertedRecordsLoading == 1000){
//        ParseObject::saveAll($list);
        $total = $total + $insertedRecordsLoading;
        $list = [];
        $insertedRecordsLoading = 0;
        echo "<br>Número parcial de registros inseridos na lista: ".$total;
    }
    //echo "<br>counter: ".$insertedRecordsLoading;
    //echo "<br>Atleta: ".$atletaLoading['Apelido'];

}
$total = $total + $insertedRecordsLoading;
echo "<br>rodada: ".$round;
echo "<br>Número total de registros inseridos na lista: ".$total;

//ParseObject::saveAll($list);

echo "<br>FIM";