/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('#Analisa').click(function() {
    //Running analysis
    analysisRun(6, true, 0.4, 0.4, 0.2, 10);
});

//Verify if projection data is available in localstorage
var retrievedObject = localStorage.getItem('caprojdata');
if (retrievedObject){
    projGraphLoad(JSON.parse(retrievedObject), 6, true, 0.4, 0.4, 0.2, 10);
}
else{
    analysisRun(6, true, 0.4, 0.4, 0.2, 10);
}
