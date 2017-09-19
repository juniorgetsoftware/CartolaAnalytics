<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cartola Analytics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  
  <!--iPhone icons-->
  <link rel="apple-touch-icon" href="images/apple-touch-icon.png" />
  <link rel="apple-touch-icon" sizes="57x57" href="images/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon" sizes="76x76" href="images/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon" sizes="120x120" href="images/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon" sizes="144x144" href="images/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon" sizes="152x152" href="images/apple-touch-icon-152x152.png" />
  <link rel="apple-touch-icon" sizes="180x180" href="images/apple-touch-icon-180x180.png" />
  
  <!--Bootstrap CSS file-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      
  <!--Font Awesome CSS file-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!--Slider CSS file-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.1/css/bootstrap-slider.min.css" integrity="sha256-qxOBz0Std9dtkon+cnUi5A7HTHO0CLbp9DnkxsJuIXc=" crossorigin="anonymous" />
  
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/projecao.css?v=0.0.7">

  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--Bootstrap Script-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  <!--Plotly Script-->
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  
  <!--LINQ for JQuery-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js" integrity="sha256-e8ZjfQ7o8BN09SDIz2sYT7fSUPGOMqCBLzy1BZbNdgg=" crossorigin="anonymous"></script>
  
  <!--LINQ for Javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js" integrity="sha256-dq1fzSor46Oc+U/DjuE2hKKN0FfvbVx+CW5GBn1mhiQ=" crossorigin="anonymous"></script>
  
  <!--Slider Script-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.8.1/bootstrap-slider.min.js" integrity="sha256-3nkG8q6ajh1K1fHC3hi142DykXlM5TA2xX3OzP/NNJM=" crossorigin="anonymous"></script>
  
  <!--User Scripts-->
  <script src="js/projecaofunctions.js?v=0.0.7"></script>
  <script src="js/projecao.js?v=0.0.7"></script>
      
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<?php include('templates/header.html'); ?>

<div class="container-fluid">    
  
  <div class="row">
      
        <br>
        
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="linkPanel" href="#typFilter" data-toggle="collapse">
                        <i style="font-size:22px" class="fa">&#xf0b0;</i> Visualização</a>
                        <a href="help.php#tipos" class="pull-right"><i class="fa fa-question-circle fa-2x"></i></a>
                </div>
                <div id="typFilter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!--<form class="form-inline">-->
                            <div class="form-group text-center">
                                <ul class="ulOpcoes text-center">
                                    <li><input type="radio" name="optTipo" id="optJOG" value="$.mediaj" class="form-control" checked/>
                                    <label for="optJOG" class="lblTipo"><strong>Jogador</strong></label></li>
                                    <li><input type="radio" name="optTipo" id="optPOS" value="$.mediap" class="form-control"/>
                                    <label for="optPOS" class="lblTipo"><strong>Posicao</strong></label></li>
                                    <li><input type="radio" name="optTipo" id="optCAM" value="$.mediag" class="form-control"/>
                                    <label for="optCAM" class="lblTipo"><strong>Global</strong></label></li>
                                </ul>
                            </div>
                        <!--</form>-->
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="linkPanel" href="#horFilter" data-toggle="collapse">
                        <i style="font-size:22px" class="fa">&#xf013;</i> Análise</a>
                        <a href="help.php#parametros" class="pull-right"><i class="fa fa-question-circle fa-2x"></i></a>
                </div>
                <div id="horFilter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <form class="form-inline text-center">
                            <div class="form-group">
                                <ul class="ulCasaFora">
                                    <li><input type="checkbox" name="chkCasaFora" id="CF" checked/>
                                    <label for="CF" class="lblCF"> <strong>Avalia mando?</strong></label></li>
                                </ul>
                            </div>
                            <div class="form-group text-center">
                                <label class="lblQtd" for="selhorizonte">N. Rodadas:</label>
                                <select class="form-control text-center" id="selhorizonte">
                                    <option>6</option>
                                    <option>8</option>
                                    <option>10</option>
                                    <option>12</option>
                                    <option>14</option>
                                    <option>16</option>
                                    <option>18</option>
                                    <option>20</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="lblQtd">Dist. global:</label> <input id="pesos" type="text"/>
                            </div>
                            <div class="form-group">
                                <button id="Analisa" type="button" class="btn btn-default" >Analisar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

   <div class="col-md-12 separa">
        <!--<br>-->
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

<script src="js/projecaofooter.js?v=0.0.7"></script>

</html>
