/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

auxFile = $("#selmatamata").val();
console.log(auxFile);

$('.aux').remove();
$('.bracket').remove();

$('<div class="aux"></div>').appendTo('#tournament');
$('<div class="bracket"></div>').appendTo('#tournament');

$.ajax({
    type: 'POST',
    url: 'matamataEngine.php',
    data: {phase: 'Initial',
        file: auxFile
    },

    success: function(data, status){
        console.log(data);
        $('.aux').bracket({
            skipConsolationRound: true,
            teamWidth: 180,
            scoreWidth: 55,
            matchMargin: 30,
            roundMargin: 80,
            init: JSON.parse(data) /* data to initialize the bracket with */ 
        });
    },

    complete: function(){

        //Verify current matchups
        timesrodadaatual = $("div.team").not(".win, .lose").map(function (){return $(this).attr('data-teamid');}).get();
        console.log(timesrodadaatual);

        //Hide Loader
        //$('#modalloader').hide();

        //Request team's current points
        $.post("matamataEngine.php",
            {
                teams: timesrodadaatual,
                file: auxFile
            },
            function(data, status){
                console.log(data);
                var jsondata = JSON.parse(data);
                
                $('.aux').hide();
                $('.bracket').bracket({
                    skipConsolationRound: true,
                    teamWidth: 180,
                    scoreWidth: 55,
                    matchMargin: 20,
                    roundMargin: 75,
                    init: jsondata /* data to initialize the bracket with */ 
                });
                
                var onfield = jsondata['onfield'];
                for (x in onfield){
                    $('.round:nth-child(' + jsondata['round'] + ') [data-teamid=' + x.toString()+']').children('.label').prepend('('+onfield[x]+') ');
                }
            }
        );
    }
});

$('#Atualiza').click(function() {
    
    auxFile = $("#selmatamata").val();
    console.log(auxFile);
    
    $('.aux').remove();
    $('.bracket').remove();
    
    $('<div class="aux"></div>').appendTo('#tournament');
    $('<div class="bracket"></div>').appendTo('#tournament');
    
    $.ajax({
        type: 'POST',
        url: 'matamataEngine.php',
        data: {phase: 'Initial',
            file: auxFile
        },

        success: function(data, status){
            console.log(data);
            $('.aux').bracket({
                skipConsolationRound: true,
                teamWidth: 180,
                scoreWidth: 55,
                matchMargin: 30,
                roundMargin: 80,
                init: JSON.parse(data) /* data to initialize the bracket with */ 
            });
        },

        complete: function(){

            //Verify current matchups
            timesrodadaatual = $("div.team").not(".win, .lose").map(function (){return $(this).attr('data-teamid');}).get();
            console.log(timesrodadaatual);

            //Hide Loader
            //$('#modalloader').hide();

            //Request team's current points
            $.post("matamataEngine.php",
                {
                    teams: timesrodadaatual,
                    file: auxFile
                },
                function(data, status){
                    console.log(data);
                    var jsondata = JSON.parse(data);
                
                    $('.aux').hide();
                    $('.bracket').bracket({
                        skipConsolationRound: true,
                        teamWidth: 180,
                        scoreWidth: 55,
                        matchMargin: 20,
                        roundMargin: 75,
                        init: jsondata /* data to initialize the bracket with */ 
                    });

                    var onfield = jsondata['onfield'];
                    for (x in onfield){
                        $('.round:nth-child(' + jsondata['round'] + ') [data-teamid=' + x.toString()+']').children('.label').prepend('('+onfield[x]+') ');
                    }
                }
            );
        }
    });
    
});
