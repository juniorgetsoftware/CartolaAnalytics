<!DOCTYPE html>
<html lang="pt-BR">
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
  
  <!--Bootstrap and dataTables CSS files-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.3.0/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.css"/>
  
  <!--Font Awesome CSS file-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/index.css?v=0.0.9">
  
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--Bootstrap and dataTables Scripts-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/cr-1.3.3/fc-3.2.2/fh-3.1.2/kt-2.3.0/r-2.1.1/rg-1.0.0/rr-1.2.0/sc-1.4.2/se-1.2.2/datatables.min.js"></script>
  
  <!--Plotly Script-->
  <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
  
  <!--LINQ for JQuery-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js" integrity="sha256-e8ZjfQ7o8BN09SDIz2sYT7fSUPGOMqCBLzy1BZbNdgg=" crossorigin="anonymous"></script>
  
  <!--LINQ for Javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js" integrity="sha256-dq1fzSor46Oc+U/DjuE2hKKN0FfvbVx+CW5GBn1mhiQ=" crossorigin="anonymous"></script>
  
  <!--User Scripts-->
  <script src="js/indexfunctions.js?v=0.0.9"></script>
  <script src="js/index.js?v=0.0.9"></script>
  
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<?php include('templates/header.html'); ?>    
    
<div class="container-fluid">    
  
    <div class="row">
      
        <div class="col-md-12">
            <br>
            <h3 class="h3Mercado">Mercado</h3>
            <div class="btn-group pull-right">
                <button id="Filtra" type="button" class="btn btn-default" >Filtrar</button>
                <button id="Limpa" type="button" class="btn btn-default" >Limpa Filtros</button>
            </div>
        </div>  

        <div class="col-md-12 separa">
            <br>
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="linkPanel" href="#teamFilter" data-toggle="collapse"><i style="font-size:22px" class="fa">&#xf0b0;</i> Times</a>
                </div>
                <div id="teamFilter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="text-center">
                            <li><input type="checkbox" name="chkTimes" id="tf_AGO" value="AGO  "/>
                            <label for="tf_AGO" class="lblTimes"><img src="images/AGO.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CAM" value="CAM  "/>
                            <label for="tf_CAM" class="lblTimes"><img src="images/CAM.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_APR" value="APR  "/>
                            <label for="tf_APR" class="lblTimes"><img src="images/APR.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_AVA" value="AVA  "/>
                            <label for="tf_AVA" class="lblTimes"><img src="images/AVA.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_BAH" value="BAH  "/>
                            <label for="tf_BAH" class="lblTimes"><img src="images/BAH.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_BOT" value="BOT  "/>
                            <label for="tf_BOT" class="lblTimes"><img src="images/BOT.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CHA" value="CHA  "/>
                            <label for="tf_CHA" class="lblTimes"><img src="images/CHA.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_COR" value="COR  "/>
                            <label for="tf_COR" class="lblTimes"><img src="images/COR.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CTB" value="CTB  "/>
                            <label for="tf_CTB" class="lblTimes"><img src="images/CTB.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CRU" value="CRU  "/>
                            <label for="tf_CRU" class="lblTimes"><img src="images/CRU.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_FLA" value="FLA  "/>
                            <label for="tf_FLA" class="lblTimes"><img src="images/FLA.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_FLU" value="FLU  "/>
                            <label for="tf_FLU" class="lblTimes"><img src="images/FLU.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_GRE" value="GRE  "/>
                            <label for="tf_GRE" class="lblTimes"><img src="images/GRE.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_PAL" value="PAL  "/>
                            <label for="tf_PAL" class="lblTimes"><img src="images/PAL.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_PON" value="PON  "/>
                            <label for="tf_PON" class="lblTimes"><img src="images/PON.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SAN" value="SAN  "/>
                            <label for="tf_SAN" class="lblTimes"><img src="images/SAN.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SAO" value="SAO  "/>
                            <label for="tf_SAO" class="lblTimes"><img src="images/SAO.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SPO" value="SPO  "/>
                            <label for="tf_SPO" class="lblTimes"><img src="images/SPO.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_VAS" value="VAS  "/>
                            <label for="tf_VAS" class="lblTimes"><img src="images/VAS.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_VIT" value="VIT  "/>
                            <label for="tf_VIT" class="lblTimes"><img src="images/VIT.png"></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="linkPanel" href="#posFilter" data-toggle="collapse">
                        <i style="font-size:22px" class="fa">&#xf0b0;</i> Posições</a>
                </div>
                <div id="posFilter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="ulPosicoes text-center">
                            <li><input type="checkbox" name="chkPosicoes" id="pf_GOL" value="GOL  "/>
                            <label for="pf_GOL" class="lblPosicoes"><strong>GOL</strong></label></li>
                            <li><input type="checkbox" name="chkPosicoes" id="pf_ZAG" value="ZAG  "/>
                            <label for="pf_ZAG" class="lblPosicoes"><strong>ZAG</strong></label></li>
                            <li><input type="checkbox" name="chkPosicoes" id="pf_LAT" value="LAT  "/>
                            <label for="pf_LAT" class="lblPosicoes"><strong>LAT</strong></label></li>
                            <li><input type="checkbox" name="chkPosicoes" id="pf_MEI" value="MEI  "/>
                            <label for="pf_MEI" class="lblPosicoes"><strong>MEI</strong></label></li>
                            <li><input type="checkbox" name="chkPosicoes" id="pf_ATA" value="ATA  "/>
                            <label for="pf_ATA" class="lblPosicoes"><strong>ATA</strong></label></li>
                            <li><input type="checkbox" name="chkPosicoes" id="pf_TEC" value="TEC  "/>
                            <label for="pf_TEC" class="lblPosicoes"><strong>TEC</strong></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><a class="linkPanel" href="#stsFilter" data-toggle="collapse">
                        <i style="font-size:22px" class="fa">&#xf0b0;</i> Status</a>
                </div>
                <div id="stsFilter" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <ul class="ulPosicoes text-center">
                            <li><input type="checkbox" name="chkStatus" id="pf_PRO" value="Provável  " checked/>
                            <label for="pf_PRO" class="lblStatus"><strong>PRV</strong></label></li>
                            <li><input type="checkbox" name="chkStatus" id="pf_DUV" value="Dúvida    " checked/>
                            <label for="pf_DUV" class="lblStatus"><strong>DUV</strong></label></li>
                            <li><input type="checkbox" name="chkStatus" id="pf_CON" value="Contundido"/>
                            <label for="pf_CON" class="lblStatus"><strong>CON</strong></label></li>
                            <li><input type="checkbox" name="chkStatus" id="pf_SUS" value="Suspenso  "/>
                            <label for="pf_SUS" class="lblStatus"><strong>SUS</strong></label></li>
                            <li><input type="checkbox" name="chkStatus" id="pf_NUL" value="Nulo      "/>
                            <label for="pf_NUL" class="lblStatus"><strong>NUL</strong></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        
        <div id="tables" class="col-md-12">
            <table id="mercado" class="display nowrap compact" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Apelido</th>
                        <th>Pos</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>CASA</th>
                        <th>FORA</th>
                        <th>Preço</th>
                        <th>Var. Preço</th>
                        <th>Ptos Ult.</th>
                        <th>Média</th>
                        <th>No. Jogos</th>
                        <th>G</th>
                        <th>A</th>
                        <th>F</th>
                        <th>FT</th>
                        <th>FD</th>
                        <th>FF</th>
                        <th>FS</th>
                        <th>RB</th>
                        <th>SG</th>
                        <th>DD</th>
                        <th>DP</th>
                        <th>PE</th>
                        <th>I</th>
                        <th>PP</th>
                        <th>CV</th>
                        <th>CA</th>
                        <th>FC</th>
                        <th>GS</th>
                        <th>Rodada</th>
                        <th>Atleta ID</th>
                    </tr>
                </thead>
            </table>  

            <h3>Detalhes:</h3><br>

            <table id="jogador" class="display nowrap compact" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Apelido</th>
                        <th>Pos</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>CASA</th>
                        <th>FORA</th>
                        <th>Preço</th>
                        <th>Var. Preço</th>
                        <th>Ptos Ult.</th>
                        <th>Média</th>
                        <th>No. Jogos</th>
                        <th>G</th>
                        <th>A</th>
                        <th>F</th>
                        <th>FT</th>
                        <th>FD</th>
                        <th>FF</th>
                        <th>FS</th>
                        <th>RB</th>
                        <th>SG</th>
                        <th>DD</th>
                        <th>DP</th>
                        <th>PE</th>
                        <th>I</th>
                        <th>PP</th>
                        <th>CV</th>
                        <th>CA</th>
                        <th>FC</th>
                        <th>GS</th>
                        <th>Rodada</th>
                    </tr>
                </thead>
            </table>      
        </div>
        <br>
        
        <div id="grafico" class="col-md-12">
            <!--<h3 id="h3Graph">Gráfico com detalhes do jogador selecionado:</h3><br>-->
            <div id="plotlyChart" ></div>
        </div>
    </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright © 2017 CartolaAnalytics. All rights reserved.</p>
</footer>

<!--Modal for Loader-->
<div id="modalloader"></div>

</body>

<script src="js/indexfooter.js?v=0.0.9"></script>

</html>
