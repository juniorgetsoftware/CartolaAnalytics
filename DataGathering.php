<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('memory_limit', '192M');

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

//Parse initialization
ParseClient::initialize( $app_id, $rest_key, null );
ParseClient::setServerURL('https://parseapi.back4app.com','/');

// define variables and set to empty values
$teamFilter = filter_input(INPUT_POST, "teamFilter", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$posFilter = filter_input(INPUT_POST, "posFilter", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$statusFilter = filter_input(INPUT_POST, "statusFilter", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$playerFilter = filter_input(INPUT_POST, "playerFilter", FILTER_DEFAULT, FILTER_FORCE_ARRAY);

$flagPlayer = empty($playerFilter[0]);

//Get current status from CartolaFC API
$url = "https://api.cartolafc.globo.com/mercado/status";
$strStatus = exec("curl -X GET ".$url);
$jsonStatus = json_decode($strStatus, true);

//Get current market data
//$strMercado = file_get_contents("data/Mercado.json");
//$jsonMercado = json_decode($strMercado, true);

//Creating an array to put filtered result
$result = array(2);
$result[0] = null;
$result[1] = [];
//$result = array();

//Verify status and collect current round
$currentStatus = $jsonStatus['status_mercado'];
$currentRound = $jsonStatus['rodada_atual'] - 1;

//Filtering according to current round or player ID
if($flagPlayer){
    
    $query = new ParseQuery('Mercado');
    $query->limit(1000);
    $query->equalTo('Rodada_ID', $currentRound);
    if (!empty($statusFilter[0])){
        $query->containedIn('Status', $statusFilter);
    }
    if (!empty($teamFilter[0])){
        $query->containedIn('TimeAbrev', $teamFilter);
    }
    if (!empty($posFilter[0])){
        $query->containedIn('Pos', $posFilter);
    }
    $queryresult = $query->find();

    //Get data date
//    $auxDate = ["createdAt" => $queryresult[0]->getCreatedAt()];
//    array_push($result[0], $auxDate["createdAt"]->date);  
    $auxDate = $queryresult[0]->getCreatedAt();
    $result[0] = $auxDate->format('Y-m-d H:i:s');;
    
    foreach ($queryresult as $auxiliar){
        array_push($result[1], $auxiliar->getAllKeys());
//        array_push($result, $auxiliar->getAllKeys());
    }
    
}
else{
    
    $queryVarPreco = new ParseQuery('Mercado');
    $queryVarPreco->notEqualTo('VarPreco', 0);
    $queryPtsUlt = new ParseQuery('Mercado');
    $queryPtsUlt->notEqualTo('Pts_Ult', 0);
    $query = ParseQuery::orQueries([$queryVarPreco,$queryPtsUlt]);
    $query->equalTo('Atleta_ID', intval($playerFilter[0]));
    $queryresult = $query->find();
    foreach ($queryresult as $auxiliar){
        array_push($result[1], $auxiliar->getAllKeys());
    }
}

//Answering request
echo json_encode($result);
