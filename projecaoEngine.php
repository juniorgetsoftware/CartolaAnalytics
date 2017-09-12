<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//Yalinqo
require_once 'vendor/autoload.php';
use \YaLinqo\Enumerable;

// define variables and set to empty values
$horizon = filter_input(INPUT_POST, "horizon", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$casafora = filter_input(INPUT_POST, "casafora", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$percJog = filter_input(INPUT_POST, "percJog", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$percPos = filter_input(INPUT_POST, "percPos", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$percCamp = filter_input(INPUT_POST, "percCamp", FILTER_DEFAULT, FILTER_FORCE_ARRAY);

//Get current status from CartolaFC API
$url = "https://api.cartolafc.globo.com/mercado/status";
$strStatus = exec("curl -X GET ".$url);
$jsonStatus = json_decode($strStatus, true);

//Get current market data
$strMercado = file_get_contents("data/Mercado.json");
$jsonMercado = json_decode($strMercado, true);

//Creating an array to put filtered result
//$result = array();

//Creating an array to put probable players
$provaveis = array();

//Verify status and collect current round
$currentStatus = $jsonStatus['status_mercado'];
$currentRound = $jsonStatus['rodada_atual'] - 1;

//Filtering probable players
for($x = 0; $x < count($jsonMercado); $x++) {
    if ((($jsonMercado[$x]['Status'] == "Provável  ") || ($jsonMercado[$x]['Status'] == "Dúvida    "))
            && ($jsonMercado[$x]['Rodada_ID'] == $currentRound)
            //&& ($jsonMercado[$x]['TimeAbrev'] == "BAH  ")
            ){
        $provaveis[] = $jsonMercado[$x];
    }
}

//Filtering Market based on analysis horizon
for($x = 0; $x < count($jsonMercado); $x++) {
    if (($jsonMercado[$x]['Rodada_ID'] > $currentRound-$horizon[0])
            && !($jsonMercado[$x]['VarPreco'] ==0 && $jsonMercado[$x]['Pts_Ult'] == 0)
            ){
        $jsonMercadoFiltered[] = $jsonMercado[$x];
    }
}

//Creating variable to store data
$data = [];

foreach ($provaveis as $provavel) {
    
    //Creating arrays to help on calculation, to store partial results
    $auxPtsJog = [];
    $auxPtsPos1 = [];
    $auxPtsPos2 = [];
    $auxPtsCed1 = [];
    $auxPtsCed2 = [];
    
    //Search Market for information to calculate indicators
    for($x = 0; $x < count($jsonMercadoFiltered); $x++) {
        
        if ($casafora[0] == 'true'){
            //Looking for played rounds for the current player
            if  (
                    ($jsonMercadoFiltered[$x]['Atleta_ID'] == $provavel['Atleta_ID'])
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] == ($provavel['CF']=="CASA" ? $jsonMercadoFiltered[$x]['CASA_D'] : $jsonMercadoFiltered[$x]['FORA_D']))
                ){
                    $auxPtsJog[] = $jsonMercadoFiltered[$x]['Pts_Ult'];
            }

            //Looking for played rounds for the current player's position
            if  (
                    ($jsonMercadoFiltered[$x]['Pos'] == $provavel['Pos'])
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] == $provavel['TimeAbrev'])
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] == ($provavel['CF']=="CASA" ? $jsonMercadoFiltered[$x]['CASA_D'] : $jsonMercadoFiltered[$x]['FORA_D']))
                ){
                    $auxPtsPos1[] = array("rodada" => $jsonMercadoFiltered[$x]['Rodada_ID'], "Ptos" => $jsonMercadoFiltered[$x]['Pts_Ult']);
            }

            //Looking for rounds played by opponents, to check points given for that specific position
            if  (
                    ($provavel['ADV'] == ($provavel['CF']=="CASA" ? $jsonMercadoFiltered[$x]['FORA_D'] : $jsonMercadoFiltered[$x]['CASA_D']))
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] != $provavel['ADV'])
                    && ($jsonMercadoFiltered[$x]['Pos'] == $provavel['Pos'])
                ){
                    $auxPtsCed1[] = array("rodada" => $jsonMercadoFiltered[$x]['Rodada_ID'], "Ptos" => $jsonMercadoFiltered[$x]['Pts_Ult']);
            }
        }
        else {
            //Looking for played rounds for the current player
            if  (
                    ($jsonMercadoFiltered[$x]['Atleta_ID'] == $provavel['Atleta_ID'])
                ){
                    $auxPtsJog[] = $jsonMercadoFiltered[$x]['Pts_Ult'];
            }

            //Looking for played rounds for the current player's position
            if  (
                    ($jsonMercadoFiltered[$x]['Pos'] == $provavel['Pos'])
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] == $provavel['TimeAbrev'])
                ){
                    $auxPtsPos1[] = array("rodada" => $jsonMercadoFiltered[$x]['Rodada_ID'], "Ptos" => $jsonMercadoFiltered[$x]['Pts_Ult']);
            }

            //Looking for rounds played by opponents, to check points given for that specific position
            if  (
                    (($provavel['ADV'] == $jsonMercadoFiltered[$x]['CASA_D']) || ($provavel['ADV'] == $jsonMercadoFiltered[$x]['FORA_D']))
                    && ($jsonMercadoFiltered[$x]['TimeAbrev'] != $provavel['ADV'])
                    && ($jsonMercadoFiltered[$x]['Pos'] == $provavel['Pos'])
                ){
                    $auxPtsCed1[] = array("rodada" => $jsonMercadoFiltered[$x]['Rodada_ID'], "Ptos" => $jsonMercadoFiltered[$x]['Pts_Ult']);
            }            
        }

    }
    
    //Calculates the average of earned points for the current player
    $ptosGanhosJog = count($auxPtsJog) > 0 ? array_sum($auxPtsJog)/count($auxPtsJog) : 0;
    
    //Calculates the average of earned points for the current player's position
    $auxPtsPos2[] = from($auxPtsPos1)
            ->groupBy('$v["rodada"]', '$v', function ($subitems) {
                return from($subitems)->average('$v["Ptos"]');
            })->toArray();
    $ptosGanhosPos = count($auxPtsPos2[0]) > 0 ? array_sum($auxPtsPos2[0])/count($auxPtsPos2[0]) : 0;
    
    //Calculates the average of points given by opponents
    $auxPtsCed2[] = from($auxPtsCed1)
            ->groupBy('$v["rodada"]', '$v', function ($subitems) {
                return from($subitems)->average('$v["Ptos"]');
            })->toArray();
    $ptosCedidos = count($auxPtsCed2[0]) > 0 ? array_sum($auxPtsCed2[0])/count($auxPtsCed2[0]) : 0;
    
    //Calculates the global average using championship average, points earned by the current player and points given by opponents
    $mediag = ($percCamp[0] * $provavel['Media']) + ($percJog[0] * ($ptosGanhosJog + $ptosCedidos) / 2) + ($percPos[0] * ($ptosGanhosPos + $ptosCedidos) / 2);
    
    //Storing data for the current player
    $data[] = array(
        "id" => $provavel['Atleta_ID'],
        "nome" => $provavel['Apelido'],
        "posicao" => $provavel['Pos'],
        "clube" => $provavel['TimeAbrev'],
        "qtdJogos" => $provavel['NoJogos'],
        "mediaj" => ($ptosGanhosJog + $ptosCedidos) / 2,
        "mediap" => ($ptosGanhosPos + $ptosCedidos) / 2,
        "mediag" => $mediag,
        "status" => $provavel['Status'],
        "casa" => $provavel['CASA'],
        "fora" => $provavel['FORA']
    );
}

//Building answer
$resultAnalysis = array("horizonte" => $horizon[0], "rodada" => $currentRound+1, "CF" => $casafora[0], "pesoj" => $percJog[0], "pesop" => $percPos[0], "pesoc" => $percCamp[0], "dados" => $data);

//Answering request
echo json_encode($resultAnalysis);
