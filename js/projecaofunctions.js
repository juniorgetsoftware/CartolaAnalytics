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

//Loads projection's charts
function projGraphLoad(jsonData, pInfo, pViewLimit = 12){        

    //Auxiliary array to store data before it is filtered based on the viewing limit
    auxlbl = [];
    auxpen = [];
            
    //Auxiliary array for loops
    auxpos = ["$.posicao == 'ATA  '","$.posicao == 'MEI  '","$.posicao == 'LAT  '","$.posicao == 'ZAG  '","$.posicao == 'GOL  '","$.posicao == 'TEC  '"]
            
    //Loading data for charts based on option selected
    if (pInfo != "$.mediap"){

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
            l: pInfo != "$.mediap" ? 210 : 110,
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

    //Adding responsive feature to charts
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