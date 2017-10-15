/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//Setup for loaders on ajax requests
$.ajaxSetup({
    beforeSend: function() {
        $('#modalloader').show();
    },
    complete: function() {
        $('#modalloader').hide();
    }
});

