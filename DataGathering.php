<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('memory_limit', '16M');

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
$strMercado = file_get_contents("data/Mercado.json");
$jsonMercado = json_decode($strMercado, true);

//Creating an array to put filtering result
$result = array();

//Verify status and collect current round
$currentStatus = $jsonStatus['status_mercado'];
$currentRound = $jsonStatus['rodada_atual'] - 2;

//Filtering according to current round or player ID
for($x = 0; $x < count($jsonMercado); $x++) {
    
    $aux1 = $jsonMercado[$x]['VarPreco'];
    $aux2 = $jsonMercado[$x]['Pts_Ult'];
    $aux3 = $jsonMercado[$x]['Rodada_ID'];
    
    if($flagPlayer){
        if (($jsonMercado[$x]['Rodada_ID'] == $currentRound) 
                && (empty($statusFilter[0]) ? true : in_array($jsonMercado[$x]['Status'],$statusFilter))
                && (empty($teamFilter[0]) ? true : in_array($jsonMercado[$x]['TimeAbrev'],$teamFilter))
                && (empty($posFilter[0]) ? true : in_array($jsonMercado[$x]['Pos'],$posFilter))
                ){
            $result[] = $jsonMercado[$x];
        }
    }
    else{
        if (($jsonMercado[$x]['Atleta_ID'] == intval($playerFilter[0]))
                && !(($jsonMercado[$x]['VarPreco'] == 0)
                && ($jsonMercado[$x]['Pts_Ult'] == 0))
                ){
            $result[] = $jsonMercado[$x];
        }
    }
}

//Answering request
echo json_encode($result);
