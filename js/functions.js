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
        function(data, status){
            table = $('#mercado').DataTable();
            table.clear();
            table.rows.add(JSON.parse(data)).draw();
        }
    );
}

//Executes analysis on data to return projections
function analysisRun(pHorizon, pCF, pPercJog, pPercPos, pPercCamp, pInfo, pViewLimit = 12){
    
    $.post("projecaoEngine.php",
        {
            horizon: pHorizon,
            casafora: pCF,
            percJog: pPercJog,
            percPos: pPercPos,
            percCamp: pPercCamp
        }, 
        function(data, status){
            //console.log(data);
            var jsonData = JSON.parse(data);
            localStorage.setItem('caprojdata', data);
            projGraphLoad(jsonData, pInfo, pViewLimit);
            }
        );

}

//Loads projection's graphics
function projGraphLoad(jsonData, pInfo, pViewLimit = 12){        

            //Option selected
            info = pInfo;
            auxlbl = [];
            auxpen = [];
            
            auxpos = ["$.posicao == 'ATA  '","$.posicao == 'MEI  '","$.posicao == 'LAT  '","$.posicao == 'ZAG  '","$.posicao == 'GOL  '","$.posicao == 'TEC  '"]
            
            //Loading data for charts based on option selected
            if (info != "$.mediap"){

                var ylabel = "x => '(' + x.status.substr(0,1) + ') ' + x.nome.trim() + ' - ' + x.clube.trim() + ' (' + x.qtdJogos + ') ' + x.casa.trim() + ' x ' + x.fora.trim() + ' '";

                for(var i=0; i<6; i++){
                    auxlbl[i] = Enumerable.From(jsonData.dados)
                        .OrderByDescending(pInfo)
                        .Where(auxpos[i])
                        .Select(ylabel).ToArray();

                    auxpen[i] = Enumerable.From(jsonData.dados)
                        .OrderByDescending(pInfo)
                        .Where(auxpos[i])
                        .Select(pInfo).ToArray();
                }
            }
            else {
                
                var ylabel = "x => x.clube.trim() + ' - ' + x.casa.trim() + ' x ' + x.fora.trim() + ' '";
                
                posData = [];
                
                for(var i=0; i<6; i++){
                    
                    posData[i] = Enumerable.From(jsonData.dados)
                        .Where(auxpos[i])
                        .GroupBy("$.clube", null, function(key, g){
                                return {clube: key, posicao: g.source[0].posicao, mediap: g.source[0].mediap, casa: g.source[0].casa, fora: g.source[0].fora}
                        }).ToArray();
                    
                    auxlbl[i] = Enumerable.From(posData[i])
                        .OrderByDescending(pInfo)
                        .Where(auxpos[i])
                        .Select(ylabel).ToArray();

                    auxpen[i] = Enumerable.From(posData[i])
                        .OrderByDescending(pInfo)
                        .Where(auxpos[i])
                        .Select(pInfo).ToArray();
                }
            }
            
            //Selecting data based on pen's number limit
            lbl = Array(6);
            pen = Array(6);
            for (var i=0; i < 6; i++) {
                lbl[i] = Array(pViewLimit);
                pen[i] = Array(pViewLimit);
                for (var j=0; j < pViewLimit; j++) {
                    lbl[i][j] = auxlbl[i][j];
                    pen[i][j] = auxpen[i][j];
                }
            }

            //Adjusting laytout
            var layout;
                layout = {
                    margin: {
                        l: 210,
                        r: 10,
                        b: 20,
                        t: 10
                    },
                    showlegend: false,
                    xaxis: {
                        fixedrange: true,
                        side: "top"
                    },
                    yaxis: {
                        fixedrange: true,
                        autorange: "reversed"
                    },
                    font: {
                        size: 10
                    }
                };
            
            //Creating chart data information
            var dataATA = [{
                type: 'bar',
                x: pen[0],
                y: lbl[0],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#53b7d9"
                },
                hoverlabel: {
                    bordercolor: "#ffffff",
                    font: {
                        color: "#ffffff"
                    }
                }
            }];
            var dataMEI = [{
                type: 'bar',
                x: pen[1],
                y: lbl[1],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#e06031"
                },
                hoverlabel: {
                    bordercolor: "#ffffff",
                    font: {
                        color: "#ffffff"
                    }
                }
            }];
            var dataLAT = [{
                type: 'bar',
                x: pen[2],
                y: lbl[2],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#ffb03a"
                }
            }];
            var dataZAG = [{
                type: 'bar',
                x: pen[3],
                y: lbl[3],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#5e9ea0"
                },
                hoverlabel: {
                    bordercolor: "#ffffff",
                    font: {
                        color: "#ffffff"
                    }
                }
            }];
            var dataGOL = [{
                type: 'bar',
                x: pen[4],
                y: lbl[4],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#a52b2a"
                }
            }];
            var dataTEC = [{
                type: 'bar',
                x: pen[5],
                y: lbl[5],
                orientation: 'h',
                hoverinfo: 'x',
                marker: {
                    color: "#ce8540"
                },
                hoverlabel: {
                    bordercolor: "#ffffff",
                    font: {
                        color: "#ffffff"
                    }
                }
            }];
        
            Plotly.newPlot('plotlyChartATA', dataATA, layout, {displayModeBar: false});
            Plotly.newPlot('plotlyChartMEI', dataMEI, layout, {displayModeBar: false});
            Plotly.newPlot('plotlyChartLAT', dataLAT, layout, {displayModeBar: false});
            Plotly.newPlot('plotlyChartZAG', dataZAG, layout, {displayModeBar: false});
            Plotly.newPlot('plotlyChartGOL', dataGOL, layout, {displayModeBar: false});
            Plotly.newPlot('plotlyChartTEC', dataTEC, layout, {displayModeBar: false});
            
            //Adding responsive feature to graphics
            (function() {
                
                var d3 = Plotly.d3;
                var WIDTH_IN_PERCENT_OF_PARENT = 100;
                
                var gd3 = d3.selectAll('.respChart')
                    .style({
                        width: WIDTH_IN_PERCENT_OF_PARENT + '%',
                        'margin-left': (100 - WIDTH_IN_PERCENT_OF_PARENT) / 2 + '%'
                    });
                
                window.onresize = function() {
                    for(i=0;i<gd3[0].length;i++){
                        Plotly.Plots.resize(gd3[0][i]);
                    }
                };
                
            })();
            
        }

//Loads player's grid and graph
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
            table.rows.add(jsonData).draw();
            
            //Preparing data for graph
            //Get the player's name
            var playerNickname = jsonData[0].Apelido;
            
            //Get data and define the labels
            var auxlblRounds = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("x => x.Rodada_ID + '-' + x.CASA_D.trim() + ' x ' + x.FORA_D.trim()").ToArray();
            
            //Load auxiliary variables (Points and Scout)
            var auxpenPts = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.Pts_Ult").ToArray();
            var auxpenG = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.G").ToArray();
            var auxpenA = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.A").ToArray();
            var auxpenF = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.F").ToArray();
            var auxpenFT = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FT").ToArray();
            var auxpenFD = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FD").ToArray();
            var auxpenFF = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FF").ToArray();
            var auxpenFS = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FS").ToArray();
            var auxpenRB = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.RB").ToArray();
            var auxpenSG = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.SG").ToArray();
            var auxpenDD = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.DD").ToArray();
            var auxpenDP = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.DP").ToArray();
            var auxpenPE = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.PE").ToArray();
            var auxpenI = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.I").ToArray();
            var auxpenPP = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.PP").ToArray();
            var auxpenCV = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.CV").ToArray();
            var auxpenCA = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.CA").ToArray();
            var auxpenFC = Enumerable.From(jsonData)
                    .OrderBy("$.Rodada_ID")
                    .Select("$.FC").ToArray();
            var auxpenGS = Enumerable.From(jsonData)
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

            //Creating graph
            Plotly.newPlot('plotlyChart', traces, layout, {displayModeBar: false});
            
            //Adding responsive feature to graphic
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

//String format Function
function sprintf () {
  //  discuss at: http://locutus.io/php/sprintf/
  // original by: Ash Searle (http://hexmen.com/blog/)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Jack
  // improved by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Kevin van Zonneveld (http://kvz.io)
  // improved by: Dj
  // improved by: Allidylls
  //    input by: Paulo Freitas
  //    input by: Brett Zamir (http://brett-zamir.me)
  //   example 1: sprintf("%01.2f", 123.1)
  //   returns 1: '123.10'
  //   example 2: sprintf("[%10s]", 'monkey')
  //   returns 2: '[    monkey]'
  //   example 3: sprintf("[%'#10s]", 'monkey')
  //   returns 3: '[####monkey]'
  //   example 4: sprintf("%d", 123456789012345)
  //   returns 4: '123456789012345'
  //   example 5: sprintf('%-03s', 'E')
  //   returns 5: 'E00'
  var regex = /%%|%(\d+\$)?([-+'#0 ]*)(\*\d+\$|\*|\d+)?(?:\.(\*\d+\$|\*|\d+))?([scboxXuideEfFgG])/g;
  var a = arguments;
  var i = 0;
  var format = a[i++];
  var _pad = function (str, len, chr, leftJustify) {
    if (!chr) {
      chr = ' ';
    }
    var padding = (str.length >= len) ? '' : new Array(1 + len - str.length >>> 0).join(chr);
    return leftJustify ? str + padding : padding + str;
  };
  var justify = function (value, prefix, leftJustify, minWidth, zeroPad, customPadChar) {
    var diff = minWidth - value.length;
    if (diff > 0) {
      if (leftJustify || !zeroPad) {
        value = _pad(value, minWidth, customPadChar, leftJustify);
      } else {
        value = [
          value.slice(0, prefix.length),
          _pad('', diff, '0', true),
          value.slice(prefix.length)
        ].join('');
      }
    }
    return value;
  };
  var _formatBaseX = function (value, base, prefix, leftJustify, minWidth, precision, zeroPad) {
    // Note: casts negative numbers to positive ones
    var number = value >>> 0;
    prefix = (prefix && number && {
      '2': '0b',
      '8': '0',
      '16': '0x'
    }[base]) || '';
    value = prefix + _pad(number.toString(base), precision || 0, '0', false);
    return justify(value, prefix, leftJustify, minWidth, zeroPad);
  };
  // _formatString()
  var _formatString = function (value, leftJustify, minWidth, precision, zeroPad, customPadChar) {
    if (precision !== null && precision !== undefined) {
      value = value.slice(0, precision);
    }
    return justify(value, '', leftJustify, minWidth, zeroPad, customPadChar);
  };
  // doFormat()
  var doFormat = function (substring, valueIndex, flags, minWidth, precision, type) {
    var number, prefix, method, textTransform, value;
    if (substring === '%%') {
      return '%';
    }
    // parse flags
    var leftJustify = false;
    var positivePrefix = '';
    var zeroPad = false;
    var prefixBaseX = false;
    var customPadChar = ' ';
    var flagsl = flags.length;
    var j;
    for (j = 0; j < flagsl; j++) {
      switch (flags.charAt(j)) {
        case ' ':
          positivePrefix = ' ';
          break
        case '+':
          positivePrefix = '+';
          break
        case '-':
          leftJustify = true;
          break
        case "'":
          customPadChar = flags.charAt(j + 1);
          break
        case '0':
          zeroPad = true;
          customPadChar = '0';
          break
        case '#':
          prefixBaseX = true;
          break
      }
    }
    // parameters may be null, undefined, empty-string or real valued
    // we want to ignore null, undefined and empty-string values
    if (!minWidth) {
      minWidth = 0;
    } else if (minWidth === '*') {
      minWidth = +a[i++];
    } else if (minWidth.charAt(0) === '*') {
      minWidth = +a[minWidth.slice(1, -1)];
    } else {
      minWidth = +minWidth;
    }
    // Note: undocumented perl feature:
    if (minWidth < 0) {
      minWidth = -minWidth;
      leftJustify = true;
    }
    if (!isFinite(minWidth)) {
      throw new Error('sprintf: (minimum-)width must be finite');
    }
    if (!precision) {
      precision = 'fFeE'.indexOf(type) > -1 ? 6 : (type === 'd') ? 0 : undefined;
    } else if (precision === '*') {
      precision = +a[i++];
    } else if (precision.charAt(0) === '*') {
      precision = +a[precision.slice(1, -1)];
    } else {
      precision = +precision;
    }
    // grab value using valueIndex if required?
    value = valueIndex ? a[valueIndex.slice(0, -1)] : a[i++];
    switch (type) {
      case 's':
        return _formatString(value + '', leftJustify, minWidth, precision, zeroPad, customPadChar);
      case 'c':
        return _formatString(String.fromCharCode(+value), leftJustify, minWidth, precision, zeroPad);
      case 'b':
        return _formatBaseX(value, 2, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
      case 'o':
        return _formatBaseX(value, 8, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
      case 'x':
        return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
      case 'X':
        return _formatBaseX(value, 16, prefixBaseX, leftJustify, minWidth, precision, zeroPad)
        .toUpperCase();
      case 'u':
        return _formatBaseX(value, 10, prefixBaseX, leftJustify, minWidth, precision, zeroPad);
      case 'i':
      case 'd':
        number = +value || 0;
        // Plain Math.round doesn't just truncate
        number = Math.round(number - number % 1);
        prefix = number < 0 ? '-' : positivePrefix;
        value = prefix + _pad(String(Math.abs(number)), precision, '0', false);
        return justify(value, prefix, leftJustify, minWidth, zeroPad);
      case 'e':
      case 'E':
      case 'f': // @todo: Should handle locales (as per setlocale)
      case 'F':
      case 'g':
      case 'G':
        number = +value;
        prefix = number < 0 ? '-' : positivePrefix;
        method = ['toExponential', 'toFixed', 'toPrecision']['efg'.indexOf(type.toLowerCase())];
        textTransform = ['toString', 'toUpperCase']['eEfFgG'.indexOf(type) % 2];
        value = prefix + Math.abs(number)[method](precision);
        return justify(value, prefix, leftJustify, minWidth, zeroPad)[textTransform]();
      default:
        return substring;
    }
  };
  return format.replace(regex, doFormat);
}