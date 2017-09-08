/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(":checkbox").change(function(){
       checkedValueTimes = $(":checkbox[name='chkTimes']:checked").map(function (){return $(this).val();}).get();
       checkedValuePosicoes = $(":checkbox[name='chkPosicoes']:checked").map(function (){return $(this).val();}).get();
       gridMercadoLoad(checkedValueTimes,checkedValuePosicoes);
});
    
$('#Limpa').click(function() {
    $('input[type="checkbox"]:checked').attr('checked',false).change();
});
