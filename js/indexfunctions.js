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

//Initializes grid for player's details
function gridJogadorInit() {
    
        //Creating table
        $('#jogador').DataTable( {

        // Responsive behavior, in case it is nedeed
//        responsive: {
//        details: {
//            renderer: function ( api, rowIdx, columns ) {
//
//                var data = $.map( columns, function ( col, i ) {
//                    return col.hidden ?
//                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
//                            '<td><strong>'+col.title+':</strong>'+'</td> '+
//                            '<td>'+col.data+'</td>' +
//                        '</tr>' :
//                        '';
//                } ).join('');
//
//                return data ?
//                    $('<table/>').append( data ) :
//                    false;
//               }
//            }
//        },

        //Features configuration
        paging: false,
        pageLength: 38,
        lengthChange: false,        
        searching: false,
        scrollX: true,
        language: {
            info: "_TOTAL_ jogo(s) realizado(s)",
            infoEmpty: "Nenhum dado para apresentar"
        },
        //fixedColumns: true,
        order: [[ 29, "asc" ]], //'Rodada_ID' Column

        //Columns Definition
        columns: [
            { data : "Apelido" },
            { data : "Pos" },
            { data : "Time" },
            { data : "Status" },
            { data : "CASA_D" },
            { data : "FORA_D" },
            { data : "Preco" },
            { data : "VarPreco" },
            { data : "Pts_Ult" },
            { data : "Media" },
            { data : "NoJogos" },
            { data : "G" },
            { data : "A" },
            { data : "F" },
            { data : "FT" },
            { data : "FD" },
            { data : "FF" },
            { data : "FS" },
            { data : "RB" },
            { data : "SG" },
            { data : "DD" },
            { data : "DP" },
            { data : "PE" },
            { data : "I" },
            { data : "PP" },
            { data : "CV" },
            { data : "CA" },
            { data : "FC" },
            { data : "GS" },
            { data : "Rodada_ID" }
        ]
    } );
}

//Main grid initialization
function gridMercadoInit() {
    
    $('#mercado').DataTable( {

        // Responsive behavior, in case it is nedeed
//        responsive: {
//        details: {
//            renderer: function ( api, rowIdx, columns ) {
//
//                var data = $.map( columns, function ( col, i ) {
//                    return col.hidden ?
//                        '<tr data-dt-row="'+col.rowIndex+'" data-dt-column="'+col.columnIndex+'">'+
//                            '<td><strong>'+col.title+':</strong>'+'</td> '+
//                            '<td>'+col.data+'</td>' +
//                        '</tr>' :
//                        '';
//                } ).join('');
//
//                return data ?
//                    $('<table/>').append( data ) :
//                    false;
//               }
//            }
//        },

        //Features configuration
        pagingType: "full",
        pageLength: 10,
        lengthChange: false,        
        searching: false,
        scrollX: true,
        //fixedColumns: true,
        order: [[ 9, "desc" ]], //'Média' Column
        language: {
            info: "Página _PAGE_ de _PAGES_. Total de _TOTAL_ jogadores",
            paginate: {
                first: "<<",
                previous: "<",
                next: ">",
                last: ">>"
            },
            infoEmpty: "Nenhum dado para apresentar"
        },
        //Columns Definition
        columnDefs: [{ targets: [30], visible: false}], //Hide 'Atleta_ID' column
        columns: [
            { data : "Apelido" },
            { data : "Pos" },
            { data : "Time" },
            { data : "Status" },
            { data : "CASA" },
            { data : "FORA" },
            { data : "Preco" },
            { data : "VarPreco" },
            { data : "Pts_Ult" },
            { data : "Media" },
            { data : "NoJogos" },
            { data : "G" },
            { data : "A" },
            { data : "F" },
            { data : "FT" },
            { data : "FD" },
            { data : "FF" },
            { data : "FS" },
            { data : "RB" },
            { data : "SG" },
            { data : "DD" },
            { data : "DP" },
            { data : "PE" },
            { data : "I" },
            { data : "PP" },
            { data : "CV" },
            { data : "CA" },
            { data : "FC" },
            { data : "GS" },
            { data : "Rodada_ID" },
            { data : "Atleta_ID" }
        ]
    } );
}

//Main grid loading
function gridMercadoLoad(pTeamFilter, pPosFilter, pStatusFilter){
    
    $.post("DataGathering.php",
        {
            teamFilter: pTeamFilter, 
            posFilter: pPosFilter,
            statusFilter: pStatusFilter
        },
        function(dataMercado, status){
            jsonDataMercado = JSON.parse(dataMercado);
            var d = new Date(jsonDataMercado[0]+" UTC");
            console.log(d.toLocaleString());
            table = $('#mercado').DataTable();
            table.clear();
            table.rows.add(jsonDataMercado[1]).draw();
        }
    );
}

//Loads player's grid and chart
function gridJogadorLoad(pPlayerFilter){
    
    $.post("DataGathering.php",
        {
            playerFilter: pPlayerFilter
        },
        function(data, status){
            //Loading table 'jogador'
            table = $('#jogador').DataTable();
            table.clear();
            var jsonData = JSON.parse(data);
            table.rows.add(jsonData[1]).draw();
            console.log(jsonData);
            
            //Preparing data for graph
            //Get the player's name
            var playerNickname = jsonData[1][0].Apelido;
            console.log(playerNickname);
            
            //Get data and define the labels
            var auxlblRounds = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("x => x.Rodada_ID + '-' + x.CASA_D.trim() + ' x ' + x.FORA_D.trim()").ToArray();
            
            //Load auxiliary variables (Points and Scout)
            var auxpenPts = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.Pts_Ult").ToArray();
            var auxpenG = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.G").ToArray();
            var auxpenA = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.A").ToArray();
            var auxpenF = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.F").ToArray();
            var auxpenFT = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FT").ToArray();
            var auxpenFD = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FD").ToArray();
            var auxpenFF = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FF").ToArray();
            var auxpenFS = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FS").ToArray();
            var auxpenRB = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.RB").ToArray();
            var auxpenSG = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.SG").ToArray();
            var auxpenDD = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.DD").ToArray();
            var auxpenDP = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.DP").ToArray();
            var auxpenPE = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.PE").ToArray();
            var auxpenI = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.I").ToArray();
            var auxpenPP = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.PP").ToArray();
            var auxpenCV = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.CV").ToArray();
            var auxpenCA = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.CA").ToArray();
            var auxpenFC = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FC").ToArray();
            var auxpenGS = Enumerable.From(jsonData[1])
                    .OrderBy("$.Rodada_ID")
                    .Select("$.GS").ToArray();
            
            //Create arrays to push data
            var lblRounds = [];
            var penPts = [];
            var penG = [];
            var penA = [];
            var penF = [];
            var penFT = [];
            var penFD = [];
            var penFF = [];
            var penFS = [];
            var penRB = [];
            var penSG = [];
            var penDD = [];
            var penDP = [];
            var penPE = [];
            var penI = [];
            var penPP = [];
            var penCV = [];
            var penCA = [];
            var penFC = [];
            var penGS = [];
            
            //Prepare limits for the graph based on screen size
            var minRange = 0;
            var maxRange = auxlblRounds.length;
            if(($(window).width() < 1025) && (maxRange>10)) {
                minRange = maxRange - 10;
            }
            
            //Loading arrays
            for (var x=minRange; x < maxRange; x++){
                lblRounds.push(auxlblRounds[x]);
                penPts.push(auxpenPts[x]);
                penG.push((x > 0) ? auxpenG[x] - auxpenG[x-1] : auxpenG[x]);
                penA.push((x > 0) ? auxpenA[x] - auxpenA[x-1] : auxpenA[x]);
                penF.push((x > 0) ? auxpenF[x] - auxpenF[x-1] : auxpenF[x]);
                penFT.push((x > 0) ? auxpenFT[x] - auxpenFT[x-1] : auxpenFT[x]);
                penFD.push((x > 0) ? auxpenFD[x] - auxpenFD[x-1] : auxpenFD[x]);
                penFF.push((x > 0) ? auxpenFF[x] - auxpenFF[x-1] : auxpenFF[x]);
                penFS.push((x > 0) ? auxpenFS[x] - auxpenFS[x-1] : auxpenFS[x]);
                penRB.push((x > 0) ? auxpenRB[x] - auxpenRB[x-1] : auxpenRB[x]);
                penSG.push((x > 0) ? auxpenSG[x] - auxpenSG[x-1] : auxpenSG[x]);
                penDD.push((x > 0) ? auxpenDD[x] - auxpenDD[x-1] : auxpenDD[x]);
                penDP.push((x > 0) ? auxpenDP[x] - auxpenDP[x-1] : auxpenDP[x]);
                penPE.push((x > 0) ? auxpenPE[x] - auxpenPE[x-1] : auxpenPE[x]);
                penI.push((x > 0) ? auxpenI[x] - auxpenI[x-1] : auxpenI[x]);
                penPP.push((x > 0) ? auxpenPP[x] - auxpenPP[x-1] : auxpenPP[x]);
                penCV.push((x > 0) ? auxpenCV[x] - auxpenCV[x-1] : auxpenCV[x]);
                penCA.push((x > 0) ? auxpenCA[x] - auxpenCA[x-1] : auxpenCA[x]);
                penFC.push((x > 0) ? auxpenFC[x] - auxpenFC[x-1] : auxpenFC[x]);
                penGS.push((x > 0) ? auxpenGS[x] - auxpenGS[x-1] : auxpenGS[x]);
            }
            
            //Loading Plotly Traces
            var traces = [];
            traces.push({ x: lblRounds, y: penPts, name: 'Ptos', type: 'bar', hoverinfo: 'x+y+name' });
            traces.push({ x: lblRounds, y: penG, name: 'G', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penA, name: 'A', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penF, name: 'F', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penFT, name: 'FT', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penFD, name: 'FD', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penFF, name: 'FF', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penFS, name: 'FS', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penRB, name: 'RB', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penSG, name: 'SG', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penDD, name: 'DD', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penDP, name: 'DP', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penPE, name: 'PE', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penI, name: 'I', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penPP, name: 'PP', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penCV, name: 'CV', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penCA, name: 'CA', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penFC, name: 'FC', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            traces.push({ x: lblRounds, y: penGS, name: 'GS', type: 'bar', visible: 'legendonly', hoverinfo: 'x+y+name', outsidetextfont:{ size: 12 }});
            
            //Adjusting laytout based on screen size
            var layout;
            if(($(window).width() < 500)) {
                layout = {
                    margin: {
                        l: 20,
                        r: 10,
                        b: 120
                    },
                    barmode: 'group',
                    legend:{
                        orientation: 'h',
                        xanchor: 'center',
                        yanchor: 'top',
                        x: 0.5,
                        y: 1.9
                    },
                    xaxis: {
                        tickangle: -90,
                        title: playerNickname,
                        titlefont: {
                            size: 16
                        },
                        fixedrange: true
                    },
                    yaxis: {
                        fixedrange: true
                    }
                };
            }
            else if(($(window).width() < 1025)) {
                layout = {
                    margin: {
                        l: 20,
                        r: 10,
                        b: 120
                    },
                    barmode: 'group',
                    legend:{
                        orientation: 'h',
                        xanchor: 'center',
                        yanchor: 'top',
                        x: 0.5,
                        y: 1.3
                    },
                    xaxis: {
                        tickangle: -90,
                        title: playerNickname,
                        titlefont: {
                            size: 16
                        },
                        fixedrange: true
                    },
                    yaxis: {
                        fixedrange: true
                    }
                };
            } 
            else {
                layout = {
                    margin: {
                        l: 20,
                        r: 10,
                        b: 80
                    },
                    barmode: 'group',
                    legend:{
                        orientation: 'h',
                        xanchor: 'center',
                        yanchor: 'top',
                        x: 0.5,
                        y: 1.2
                    },
                    xaxis: {
                        title: playerNickname,
                        titlefont: {
                            size: 16
                        },
                        fixedrange: true
                    },
                    yaxis: {
                        fixedrange: true
                    }
                };
            }

            //Creating chart
            Plotly.newPlot('plotlyChart', traces, layout, {displayModeBar: false});
            
            //Adding responsive feature to chart
            (function() {
                var d3 = Plotly.d3;
                var WIDTH_IN_PERCENT_OF_PARENT = 100;
                var gd3 = d3.select('#plotlyChart')
                    .style({
                        width: WIDTH_IN_PERCENT_OF_PARENT + '%',
                        'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%'
                    });
                var gd = gd3.node();
                
                window.onresize = function() {
                    Plotly.Plots.resize(gd);
                };
            })();
        }
    );
}