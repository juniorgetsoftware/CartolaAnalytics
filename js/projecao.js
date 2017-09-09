/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function() {

    //Smartphone, iPad or Desktop? 
    //Decides whether compact mode or not for grid lines
    //Decides whether panels for filters are expanded or not
    if($(window).width() > 1024) {
        $('#typFilter').addClass("in");
        $('#horFilter').addClass("in");        
    }else{
        $('#typFilter').removeClass("in");
        $('#horFilter').removeClass("in");        
    }

    //Same as above, but instead of at initialisation, 
    //this is triggered when resize event occurs
    $(window).resize(function() {
        if($(window).width() > 1024) {
        
        }else{
        $('#typFilter').removeClass("in");
        $('#horFilter').removeClass("in");        
        }
    });
        
    //Menu Link adjust
    $('#menuAnalise').addClass("active");
 
});
