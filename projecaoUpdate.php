<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Get current status from CartolaFC API
$url = "https://api.cartolafc.globo.com/mercado/status";
$strStatus = exec("curl -X GET ".$url);
$jsonStatus = json_decode($strStatus, true);

//Verify current round
$currentRound = $jsonStatus['rodada_atual'];

//Answering request
echo json_encode($currentRound);
