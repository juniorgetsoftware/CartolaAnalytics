<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

set_time_limit(90);

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
            
            //Initialize array for response
            $response = array_fill(0,$teamsQt/2,array_fill(0,2,0));
            
            //Auxiliary counters to put each team's points at the right position
            $countMatch = 0;
            $countTeam = 0;
            
            //Get current points
            $url = "https://api.cartolafc.globo.com/atletas/pontuados";
            $strPontuados = exec("curl -X GET ".$url);
            $jsonPontuados = json_decode($strPontuados, true);
            
            foreach ($teams as $teamid) {
                
                //Get team's players
                $url = "https://api.cartolafc.globo.com/time/slug/" . $jsonMatamata['slugs'][$teamid];
                $strTeam = exec("curl -X GET ".$url);
                $jsonTeam = json_decode($strTeam, true);
                
                //Creating array to put player's ID
                $playersID = [];
                
                //Get player's ID
                for($x = 0; $x < 12; $x++) {
                    array_push($playersID, $jsonTeam['atletas'][$x]['atleta_id']);
                }
                
                //Initialize points (=0) 
                $ptosSum = 0;
                
                foreach ($playersID as $id){
                    //Search for points for each player and add to total
                    if(array_key_exists($id, $jsonPontuados['atletas'])){
                        $ptosSum = $ptosSum + (float)$jsonPontuados['atletas'][$id]['pontuacao'];
                    }
                }
                
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
            
            //Add new results
            array_push($jsonMatamata['results'][0], $response);
            $result = array("teams" => $jsonMatamata['teams'], "results" => $jsonMatamata['results']);
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
            $result = array("teams" => $jsonMatamata['teams'], "results" => $jsonMatamata['results']);
            
            $closedround = array("noteams" => $jsonMatamata['noteams'], "initialround" => $jsonMatamata['initialround'], "teams" => $jsonMatamata['teams'], "slugs" => $jsonMatamata['slugs'], "results" => $jsonMatamata['results']);
            
            file_put_contents("data/".$file[0], json_encode($closedround), LOCK_EX);
        }       
    }
}

//Answering request
echo json_encode($result);