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

//Get current status from CartolaFC API
$url = "https://api.cartolafc.globo.com/mercado/status";
$strStatus = exec("curl -X GET ".$url);
$jsonStatus = json_decode($strStatus, true);

//Verify status and collect current round
$currentStatus = $jsonStatus['status_mercado'];
$currentRound = $jsonStatus['rodada_atual'];

//Info
echo "status (1-aberto; 2-fechado; 4-manutenção): ".$currentStatus;
echo "<br>rodada atual: ".$currentRound;

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
    $currentRoundSaved = $query->first();

    if(count($currentRoundSaved)>0){
        //Info
        echo "<br>rodada mais recente b4a: ".$currentRoundSaved->get('Rodada_ID');

        //Before update, delete current round from b4a
        if($currentRoundSaved->get('Rodada_ID') == ($currentRound-1)){

            $querytodelete = new ParseQuery('Mercado');
            $querytodelete->limit(1000);
            $querytodelete->equalTo('Rodada_ID', $currentRoundSaved->get('Rodada_ID'));
            $itemstodel = $querytodelete->find();
            
            echo "<br>Rodada existente";
            echo "<br>Numero de records pra deletar: ".count($itemstodel);
            if(count($itemstodel) > 0){
                ParseObject::destroyAll($itemstodel);
            }

        }
        else
        {
            echo "<br>Nova Rodada";
        }
    }
    else{
        echo "<br>rodada mais recente b4a: base de dados vazia";
    }
    
    
    
    //Get current market
    $url = "https://api.cartolafc.globo.com/atletas/mercado";
    $strMercadoAPI = exec("curl -X GET ".$url);
    $jsonMercadoAPI = json_decode($strMercadoAPI, true);
   
    //Get last matchups
    $url = "https://api.cartolafc.globo.com/partidas/".($currentRound-1);
    $strMatchupsLast = exec("curl -X GET ".$url);
    $jsonMatchupsLast = json_decode($strMatchupsLast, true);
    
    //echo "<br>url last matchups: ".$url;
    
    //Get current matchups
    $url = "https://api.cartolafc.globo.com/partidas";
    $strMatchups = exec("curl -X GET ".$url);
    $jsonMatchups = json_decode($strMatchups, true);
    
    //Get constant tables
    $queryforteam = new ParseQuery('Clubes');
    $tbClubes = $queryforteam->find();
    $queryforposition = new ParseQuery('Posicoes');
    $tbPosicoes = $queryforposition->find();
    $queryforstatus = new ParseQuery('Status');
    $tbStatus = $queryforstatus->find();
    
    //Create variable to count inserted records
    $insertedRecords = 0;
    
    //Create array to upload data (batch saving)
    $list = [];
    
    //Prepare data and add to b4a
    foreach ($jsonMercadoAPI['atletas'] as $atleta) {

        //Identify current opponent
        foreach ($jsonMatchups['partidas'] as $partida){
            if($partida['clube_casa_id']==$atleta['clube_id']){
                $CF = "CASA";
                $AdvId = $partida['clube_visitante_id'];
            }
            elseif($partida['clube_visitante_id']==$atleta['clube_id']){
                $CF = "FORA";
                $AdvId = $partida['clube_casa_id'];
            }
        }

        //Identify last opponent
        foreach ($jsonMatchupsLast['partidas'] as $partida){
            if($partida['clube_casa_id']==$atleta['clube_id']){
                $CFD = "CASA";
                $AdvIdLast = $partida['clube_visitante_id'];
            }
            elseif($partida['clube_visitante_id']==$atleta['clube_id']){
                $CFD = "FORA";
                $AdvIdLast = $partida['clube_casa_id'];
            }
        }
        
        //Verify team 
        foreach ($tbClubes as $clube){
            if($atleta['clube_id'] == $clube->get('Clube_ID')){
                $teamNome = $clube->get('Nome');
                $teamAbrev = $clube->get('Abrev');
            }
            if($AdvId == $clube->get('Clube_ID')){
                $oppAbrev = $clube->get('Abrev');
            }
            if($AdvIdLast == $clube->get('Clube_ID')){
                $oppAbrevLast = $clube->get('Abrev');
            }
        }

        if($CF=="CASA"){
            $CASA = $teamAbrev;
            $FORA = $oppAbrev;
        }
        else{
            $FORA = $teamAbrev;
            $CASA = $oppAbrev;            
        }
        
        if($CFD=="CASA"){
            $CASAD = $teamAbrev;
            $FORAD = $oppAbrevLast;
        }
        else{
            $FORAD = $teamAbrev;
            $CASAD = $oppAbrevLast;            
        }
        
        //Verify status
        foreach ($tbStatus as $status){
            if($atleta['status_id'] == $status->get('ID')){
                $playerStatus = $status->get('Status');
            }
        }
    
        //Verify position
        foreach ($tbPosicoes as $posicao){
            if($atleta['posicao_id'] == $posicao->get('ID')){
                $playerPosition = $posicao->get('Abrev');
            }
        }
        
        $FT = array_key_exists('FT', $atleta['scout']) ? $atleta['scout']['FT'] : 0;
        $FD = array_key_exists('FD', $atleta['scout']) ? $atleta['scout']['FD'] : 0;
        $FF = array_key_exists('FF', $atleta['scout']) ? $atleta['scout']['FF'] : 0;
        
        //Save data to b4a
        $object = new ParseObject("Mercado");
        $object->set('Rodada_ID', $currentRound-1);
        $object->set('Atleta_ID', $atleta['atleta_id']);
        $object->set('Apelido', $atleta['apelido']);
        $object->set('Pos', sprintf('%-5s',$playerPosition));
        $object->set('Time', $teamNome);
        $object->set('TimeAbrev', sprintf('%-5s',$teamAbrev));
        $object->set('Status', $playerStatus);
        $object->set('ADV', sprintf('%-5s',$oppAbrev));
        $object->set('CF', $CF);
        $object->set('CASA', sprintf('%-5s',$CASA));
        $object->set('FORA', sprintf('%-5s',$FORA));
        $object->set('CFD', $CFD);
        $object->set('CASA_D', sprintf('%-5s',$CASAD));
        $object->set('FORA_D', sprintf('%-5s',$FORAD));
        $object->set('Pts_Ult', $atleta['pontos_num']);
        $object->set('Preco', $atleta['preco_num']);
        $object->set('VarPreco', $atleta['variacao_num']);
        $object->set('Media', $atleta['media_num']);        
        $object->set('NoJogos', $atleta['jogos_num']);
        $object->set('Indicador', $atleta['media_num'] - $atleta['preco_num']);
        $object->set('G', array_key_exists('G', $atleta['scout']) ? $atleta['scout']['G'] : 0);
        $object->set('A', array_key_exists('A', $atleta['scout']) ? $atleta['scout']['A'] : 0);
        $object->set('FT', $FT);
        $object->set('FD', $FD);
        $object->set('FF', $FF);
        $object->set('F', $FT + $FD + $FF);
        $object->set('FS', array_key_exists('FS', $atleta['scout']) ? $atleta['scout']['FS'] : 0);
        $object->set('RB', array_key_exists('RB', $atleta['scout']) ? $atleta['scout']['RB'] : 0);
        $object->set('SG', array_key_exists('SG', $atleta['scout']) ? $atleta['scout']['SG'] : 0);
        $object->set('DD', array_key_exists('DD', $atleta['scout']) ? $atleta['scout']['DD'] : 0);
        $object->set('DP', array_key_exists('DP', $atleta['scout']) ? $atleta['scout']['DP'] : 0);
        $object->set('PE', array_key_exists('PE', $atleta['scout']) ? $atleta['scout']['PE'] : 0);
        $object->set('I', array_key_exists('I', $atleta['scout']) ? $atleta['scout']['I'] : 0);
        $object->set('PP', array_key_exists('PP', $atleta['scout']) ? $atleta['scout']['PP'] : 0);
        $object->set('CV', array_key_exists('CV', $atleta['scout']) ? $atleta['scout']['CV'] : 0);
        $object->set('CA', array_key_exists('CA', $atleta['scout']) ? $atleta['scout']['CA'] : 0);
        $object->set('FC', array_key_exists('FC', $atleta['scout']) ? $atleta['scout']['FC'] : 0);
        $object->set('GS', array_key_exists('GS', $atleta['scout']) ? $atleta['scout']['GS'] : 0);
        
        //$object->save();
        array_push($list, $object);

        $insertedRecords++;
        
        echo "<br>Atleta: ".$atleta['apelido']."      Time: ".$teamAbrev."       Adv.: ".$oppAbrev."     Indicador: ".$object->get('Indicador');

    }
    
    ParseObject::saveAll($list);
    
    echo "<br>Número de registros inseridos: ".$insertedRecords;
    echo "<br>FIM";
}

