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
        $('#mercado').addClass("compact");
        $('#jogador').addClass("compact");
        $('#teamFilter').addClass("in");
        $('#posFilter').addClass("in");
        $('#graphJogador').attr("height",80);
    }else{
        $('#mercado').removeClass("compact");
        $('#jogador').removeClass("compact");
        $('#teamFilter').removeClass("in");
        $('#posFilter').removeClass("in");
        $('#graphJogador').attr("height",180);
    }

    //Same as above, but instead of at initialisation, 
    //this is triggered when resize event occurs
    $(window).resize(function() {
        if($(window).width() > 1024) {
            $('#mercado').addClass("compact");
            $('#jogador').addClass("compact");
        }else{
            $('#mercado').removeClass("compact");
            $('#jogador').removeClass("compact");
            $('#teamFilter').removeClass("in");
            $('#posFilter').removeClass("in");
        }
    });
    
    //Tables 'Mercado' and 'Jogador' Initialisation
    gridMercadoInit();
    gridJogadorInit();
    
    //DataGrid Loading 
    gridMercadoLoad(null,null);

    //Menu Link adjust
    $('#menuHome').addClass("active");
    
    //Row selection treatment
    $('#mercado tbody').on( 'click', 'tr', function () {
        
        table = $('#mercado').DataTable();
        table.$('tr.selected').removeClass("selected");
        $(this).addClass("selected");
        
        var idx = table.cell('.selected', 0).index();
        var data = table.row( idx.row ).data();

        gridJogadorLoad(data.Atleta_ID);
        
    });
        
});

