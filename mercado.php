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
//$master_key = "1FbUi0hLRKNLoJWI0gAgpfZNV9FU53pxUPtcN1pH";

//Get current status from CartolaFC API
$url = "https://api.cartolafc.globo.com/mercado/status";
$strStatus = exec("curl -X GET ".$url);
$jsonStatus = json_decode($strStatus, true);

//Verify status and collect current round
$currentStatus = $jsonStatus['status_mercado'];
$currentRound = $jsonStatus['rodada_atual'];

echo "status: ".$currentStatus;
echo "<br>rodada: ".$currentRound;

//Opened market? (status = 1)
if($currentStatus == 1){

    //Parse initialization
    ParseClient::initialize( $app_id, $rest_key, null );
    ParseClient::setServerURL('https://parseapi.back4app.com','/');
    
    //Creates query object
    $query = new ParseQuery('Mercado');

    //Search for most recent saved round
    $query->select('Rodada_ID');
    $query->descending('Rodada_ID');
    $currentRoundSaved = $query->first()->get('Rodada_ID');

    echo "<br>rodada b4a: ".$currentRoundSaved;//->get('Rodada_ID');
    
    //Before update, delete current round from b4a
    $queryfordelete = new ParseQuery('Mercado');
    $queryfordelete->limit(1000);
    $queryfordelete->equalTo('Rodada_ID', $currentRound);
    $itemstodel = $queryfordelete->find();
    
    echo "<br>numero de records: ".count($itemstodel);
    
    if(count($itemstodel) > 0){
        ParseObject::destroyAll($itemstodel);
    }
    
    //Get current market
    $url = "https://api.cartolafc.globo.com/atletas/mercado";
    $strMercadoAPI = exec("curl -X GET ".$url);
    $jsonMercadoAPI = json_decode($strMercadoAPI, true);
   
    //echo "<br>".$strMercadoAPI;

    //Get current matchups
    $url = "https://api.cartolafc.globo.com/partidas";
    $strMatchups = exec("curl -X GET ".$url);
    $jsonMatchups = json_decode($strMatchups, true);
    
    //echo "<br>".$strMatchups;
    
    $queryforteam = new ParseQuery('Clubes');
    $tbClubes = $queryforteam->find();
    
    //Prepare data and add to b4a
    foreach ($jsonMercadoAPI['atletas'] as $atleta) {

        //Identify opponent
        foreach ($jsonMatchups['partidas'] as $partida){
            if($partida['clube_casa_id']==$atleta['clube_id']){
                //$CF = "CASA";
                $AdvId = $partida['clube_visitante_id'];
            }
            elseif($partida['clube_visitante_id']==$atleta['clube_id']){
                //$CF = "FORA";
                $AdvId = $partida['clube_casa_id'];
            }
        }

        //Verify team's name and nickname
        foreach ($tbClubes as $clube){
            if($atleta['clube_id'] == $clube->get('Clube_ID')){
                $teamNome = $clube->get('Nome');
                $teamAbrev = $clube->get('Abrev');
            }
        }
        
        //Verify opponent's name and nickname
        foreach ($tbClubes as $clube){
            if($AdvId == $clube->get('Clube_ID')){
                $oppNome = $clube->get('Nome');
                $oppAbrev = $clube->get('Abrev');
            }
        }
    
        //Save data to b4a
        $object = new ParseObject("Mercado");
        $object->set('Rodada_ID', $currentRound);
        $object->set('Atleta_ID', $atleta['atleta_id']);
        $object->set('Apelido', $atleta['apelido']);
        $object->set('Pos', 'ATA');
        $object->set('Time', $teamNome);
        $object->set('ADV', $oppNome);
        $object->set('Status', 'Provável');
        $object->set('Pts_Ult', 0);
        $object->set('Media', 0);
        $object->set('Preco', 10);
        $object->set('VarPreco', 0);
        $object->set('NoJogos', 29);
        $object->set('DD', 2);
        $object->save();

        echo "<br>Atleta: ".$atleta['apelido']."      Time: ".$teamNome."       Adv.: ".$oppNome;

    }
    echo "<br>FIM";
}

