<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cartola Analytics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="images/CartolaAnalyticsOriginalLogo.gif">
  
  <!--Bootstrap and dataTables CSS files-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.3.0/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
  
  <!--Font Awesome CSS file-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!--Chartist CSS file-->
  <link rel="stylesheet" href="//cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
  
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--Bootstrap and dataTables Scripts-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.3.0/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
  
  <!--Chart.js Script-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.bundle.min.js" integrity="sha256-VNbX9NjQNRW+Bk02G/RO6WiTKuhncWI4Ey7LkSbE+5s=" crossorigin="anonymous"></script>

  <!--Plotly Script-->
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  
  <!--LINQ for JQuery-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js" integrity="sha256-e8ZjfQ7o8BN09SDIz2sYT7fSUPGOMqCBLzy1BZbNdgg=" crossorigin="anonymous"></script>
  
  <!--LINQ for Javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js" integrity="sha256-dq1fzSor46Oc+U/DjuE2hKKN0FfvbVx+CW5GBn1mhiQ=" crossorigin="anonymous"></script>
  
  <!--Javascript to include HTML-->
  <script src="https://www.w3schools.com/lib/w3.js"></script>
  
  <!--User Script-->
  <script src="js/functions.js?v=0.0.3"></script>
  <script src="js/projecao.js?v=0.0.3"></script>
  
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/projecao.css?v=0.0.3">
    
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<?php include('templates/header.html'); ?>

<div class="container-fluid">    
  
  <div class="row">
      
    <div class="col-md-12">
        <br>
        <h3 class="h3Mercado">Projeções</h3>
        
        <button id="Analisa" type="button" class="btn btn-default pull-right" >Analisar</button>
        
    </div>  
    
   <div class="col-md-12 separa">
        <br>
    </div>
      
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projATA" data-toggle="collapse">Atacantes</a></div>
            <div id="projATA" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartATA" class="respChart"></div>
                </div>
            </div>
        </div>
    </div>  
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projMEI" data-toggle="collapse">Meias</a></div>
            <div id="projMEI" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartMEI" class="respChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projLAT" data-toggle="collapse">Laterais</a></div>
            <div id="projLAT" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartLAT" class="respChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projZAG" data-toggle="collapse">Zagueiros</a></div>
            <div id="projZAG" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartZAG" class="respChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projGOL" data-toggle="collapse">Goleiros</a></div>
            <div id="projGOL" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartGOL" class="respChart"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#projTEC" data-toggle="collapse">Técnicos</a></div>
            <div id="projTEC" class="panel-collapse collapse in teste">
                <div class="panel-body">
                    <div id="plotlyChartTEC" class="respChart" ></div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright © 2017 CartolaAnalytics. All rights reserved.</p>
</footer>

<!--Modal for Loader-->
<div id="modalloader"></div>

</body>

<script src="js/projecaofooter.js?v=0.0.3"></script>
<!--<script>
    
    $('#Analisa').click(function() {
        //Running analysis
        analysisRun(6, true, 0.4, 0.4, 0.2, 10);
    });
    
    //Verify if projection data is available in localstorage
    var retrievedObject = localStorage.getItem('caprojdata');
    if (retrievedObject){
        projGraphLoad(JSON.parse(retrievedObject), 6, true, 0.4, 0.4, 0.2, 10);
    }
    else{
        analysisRun(6, true, 0.4, 0.4, 0.2, 10);
    }
    
</script>-->

</html>
