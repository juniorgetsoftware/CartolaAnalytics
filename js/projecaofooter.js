/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Configuring and loading slider 
sliderPesos = $("#pesos").slider({ id: "pesoscss", min: 0, max: 100, range: true, step: 5, value: [40, 80], formatter: function(value) {
		return 'Jog: ' + value[0] + '% - Pos: ' + (value[1]-value[0]) + '% - Camp: ' + (100 - value[1]) + '%';
	} });

//Reading local storage
retrievedObject = localStorage.getItem('caprojdata');

//Is data available?
if (retrievedObject){
    
    //Parsing data
    data = JSON.parse(retrievedObject);
    
    //Loading charts with player view (default)
    projGraphLoad(data, "$.mediaj");
    
    //Loading past rounds field based on saved data
    $("#selhorizonte").val(data.horizonte);
    
    //Setting Home/Away checkbox based on saved data
    $("#CF").prop('checked', data.CF=="true" ? true : false);
    
    //Setting slider based on saved data
    sliderPesos.slider('setValue',[data.pesoj*100, data.pesoj*100 + data.pesop*100]);
}
else{
    //Default parameters, according to page initial configuration
    analysisRun(6, true, 0.4, 0.4, 0.2, "$.mediaj");
}



$('#Analisa').click(function() {
    
    //Radio Buttons (projections types)
    checkedProjTipo = $(":radio[name='optTipo']:checked").map(function (){return $(this).val();}).get();
    
    //Number of past rounds to analyze
    horizonte = $("#selhorizonte").val();
        
    //Home or Away?
    if ($('#CF').is(":checked")){
        cf = true;
    }
    else{
        cf = false;
    }
    
    //Weights for global projection calculation
    perc = sliderPesos.slider('getValue');
    
    //Running analysis
    analysisRun(horizonte, cf, perc[0]/100, (perc[1]-perc[0])/100, 1 - perc[1]/100, checkedProjTipo[0]);
});

$(":radio").change(function(){
    
    //Get selected option
    checkedProjTipo = $(":radio[name='optTipo']:checked").map(function (){return $(this).val();}).get();
    
    //Get saved data
    retrievedObject = localStorage.getItem('caprojdata');
    
    //Load charts according to selected option
    projGraphLoad(JSON.parse(retrievedObject), checkedProjTipo[0]);
});

