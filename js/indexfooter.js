/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(":checkbox").change(function(){
       checkedValueTimes = $(":checkbox[name='chkTimes']:checked").map(function (){return $(this).val();}).get();
       checkedValuePosicoes = $(":checkbox[name='chkPosicoes']:checked").map(function (){return $(this).val();}).get();
       checkedValueStatus = $(":checkbox[name='chkStatus']:checked").map(function (){return $(this).val();}).get();
});
    
$('#Limpa').click(function() {
    $('input[type="checkbox"]:checked').attr('checked',false).change();
    gridMercadoLoad(checkedValueTimes,checkedValuePosicoes,checkedValueStatus);
});

$('#Filtra').click(function() {
    gridMercadoLoad(checkedValueTimes,checkedValuePosicoes,checkedValueStatus);
});
