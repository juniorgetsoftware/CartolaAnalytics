
$.ajax({
    type: 'POST',
    url: 'matamataEngine.php',
    data: {phase: 'Initial'},
    
    success: function(data, status){
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
//        console.log(timesrodadaatual);
        
        //Hide Loader
        //$('#modalloader').hide();
        
        //Request team's current points
        $.post("matamataEngine.php",
            {
                teams: timesrodadaatual
            },
            function(data, status){
//                console.log(data);
                $('.aux').hide();
                $('.bracket').bracket({
                    skipConsolationRound: true,
                    teamWidth: 180,
                    scoreWidth: 55,
                    matchMargin: 20,
                    roundMargin: 75,
                    init: JSON.parse(data) /* data to initialize the bracket with */ 
                });
            }
        );
    }
});