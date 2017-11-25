<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
ini_set('memory_limit', '192M');
set_time_limit(120);

//Yalinqo
require_once 'vendor/autoload.php';
use \YaLinqo\Enumerable;

//Define variables and set to empty values
$phase = filter_input(INPUT_POST, "phase", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$teams = filter_input(INPUT_POST, "teams", FILTER_DEFAULT, FILTER_FORCE_ARRAY);
$file = filter_input(INPUT_POST, "file", FILTER_DEFAULT, FILTER_FORCE_ARRAY);

//Define 

//Get current tournament bracket
$strMatamata = file_get_contents("data/".$file[0]);
$jsonMatamata = json_decode($strMatamata, true);

$result = array("teams" => $jsonMatamata['teams'], "results" => $jsonMatamata['results']);

//Building answer for new data (complement)
if ($phase[0] != "Initial"){

    //Get current status from CartolaFC API
    $url = "https://api.cartolafc.globo.com/mercado/status";
    $strStatus = exec("curl -X GET ".$url);
    $jsonStatus = json_decode($strStatus, true);
    
    //Verify status and collect current round
    $currentStatus = $jsonStatus['status_mercado'];
    $currentRound = $jsonStatus['rodada_atual'];

    //Calculates round quantity for the tournament
    $roundQt = log($jsonMatamata['noteams'],2);

    //Count number of teams for the current round based on tournament JSON
    $teamsQt = count($teams);
    
    //Is market closed (status = 2)?
    if($currentStatus == 2){
        
        //Verify current round based on API ($parc1) and tournament JSON ($parc2)
        $parc1 = $currentRound - $jsonMatamata['initialround'] + 1;
        $parc2 = $roundQt + 1 - log($teamsQt,2);

        //Verify if requested and current data match
        if ( $parc1 == $parc2 ){
            
            //Store teams's players
            if (count($jsonMatamata['players']) == 0){
                
                //foreach ($teams as $teamid) {
                for($i = 0; $i < $jsonMatamata['noteams']; $i++) {    
                    
                    //Creating array to put player's ID
                    $playersID = [];

                    //Get player's ID
                    if (in_array($i, $teams)){
                        
                        //Get team's players
                        $url = "https://api.cartolafc.globo.com/time/slug/" . $jsonMatamata['slugs'][$i];
                        $strTeam = exec("curl -X GET ".$url);
                        $jsonTeam = json_decode($strTeam, true);
                    
                        for($x = 0; $x < 12; $x++) {
                            array_push($playersID, $jsonTeam['atletas'][$x]['atleta_id']);
                        }
                    }
                        
                    //Add team's players to tournament data
                    $jsonMatamata['players'][$i] = $playersID;
                    
                }
                
                //Save to file
                file_put_contents("data/".$file[0], json_encode($jsonMatamata), LOCK_EX);
                
            }
            
            //Initialize array for response
            $response = array_fill(0,$teamsQt/2,array_fill(0,2,0));
            $playersCounter = [];
            
            //Auxiliary counters to put each team's points at the right position
            $countMatch = 0;
            $countTeam = 0;
            
            //Get current points
            $url = "https://api.cartolafc.globo.com/atletas/pontuados";
            $strPontuados = exec("curl -X GET ".$url);
            $jsonPontuados = json_decode($strPontuados, true);
            
            foreach ($teams as $teamid) {
                
                //Initialize points (=0) 
                $ptosSum = 0;
                $onfield = 0;
                
                //Search for points for each player and add to total
                foreach ($jsonMatamata['players'][$teamid] as $id){
                    
                    if(array_key_exists($id, $jsonPontuados['atletas'])){
                        
                        $ptosSum = $ptosSum + (float)$jsonPontuados['atletas'][$id]['pontuacao'];
                        
                        if ($jsonPontuados['atletas'][$id]['posicao_id'] <> 6)
                            $onfield = $onfield + 1;
                        elseif ($jsonPontuados['atletas'][$id]['posicao_id'] == 6 && $jsonPontuados['atletas'][$id]['pontuacao'] <> 0){
                            $onfield = $onfield + 1;
                        }
                    }
                }
                
                //Store result on response array
                $response[$countMatch][$countTeam] = (float)number_format($ptosSum,2);
                $playersCounter[$teamid] = (string)$onfield."/12";
                
                if( $countTeam == 0 ){
                    $countTeam = 1;
                } 
                else {
                    $countTeam = 0;
                    $countMatch = $countMatch + 1;
                }
            }
            
            //Add new results
            array_push($jsonMatamata['results'][0], $response);
            $result = array("teams" => $jsonMatamata['teams'], "results" => $jsonMatamata['results'], "onfield" => $playersCounter, "round" => $parc1);
        }
    }
    elseif($currentStatus == 1){
        
        //Verify current round based on API ($parc1) and tournament JSON ($parc2)
        $parc1 = $currentRound - $jsonMatamata['initialround'];
        $parc2 = $roundQt + 1 - log($teamsQt,2);

        //Verify if requested and current data match
        if ( $parc1 == $parc2 ){ 

            //Initialize array for response
            $response = array_fill(0,$teamsQt/2,array_fill(0,2,0));
            
            //Auxiliary counters to put each team's points at the right position
            $countMatch = 0;
            $countTeam = 0;
            
            //Get consolidated results
            foreach ($teams as $teamid) {
                
                //Get team's points
                $url = "https://api.cartolafc.globo.com/time/slug/" . $jsonMatamata['slugs'][$teamid];
                $strTeam = exec("curl -X GET ".$url);
                $jsonTeam = json_decode($strTeam, true);            
                $ptosSum = (float)$jsonTeam['pontos'];
                
                //Store result on response array
                $response[$countMatch][$countTeam] = (float)number_format($ptosSum,2);

                if( $countTeam == 0 ){
                    $countTeam = 1;
                } 
                else {
                    $countTeam = 0;
                    $countMatch = $countMatch + 1;
                }
                
            }
 
            //Store new data on file
            array_push($jsonMatamata['results'][0], $response);
            $result = array("teams" => $jsonMatamata['teams'], "results" => $jsonMatamata['results'], "onfield" => array());
            
            $closedround = array("noteams" => $jsonMatamata['noteams'], "initialround" => $jsonMatamata['initialround'], "teams" => $jsonMatamata['teams'], "slugs" => $jsonMatamata['slugs'], "players" => array(), "results" => $jsonMatamata['results']);
            
            file_put_contents("data/".$file[0], json_encode($closedround), LOCK_EX);
        }       
    }
}

//Answering request
echo json_encode($result);