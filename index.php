<!DOCTYPE html>
<html lang="pt-BR">
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
  
  <!--User Script-->
  <script src="js/functions.js?v=0.0.2"></script>
  <script src="js/initialisation.js?v=0.0.2"></script>
  
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/initialisation.css?v=0.0.2">
   
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<nav class="navbar navbar-inverse" data-spy="affix" data-offset-top="1">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
        <a class="navbar-brand logo" href="#"><img src="images/CartolaAnalyticsOriginalLogo.gif" class="img-responsive" width="40" height="40"></a>
    </div>
    <div id="myNavbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Home</a></li>
        <li><a href="#" data-toggle="tooltip" data-placement="bottom" title="Under construction">Análise</a></li>
        <!--<li><a href="#">Projects</a></li>-->
        <!--<li><a href="#">Contact</a></li>-->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">About / Contato</a></li>
      </ul>
    </div>
  </div>
</nav>

<div id="myCarousel" class="carousel slide" data-ride="carousel" height="100">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
          <img src="images/caurosel1.png" alt="Image">
        <div class="carousel-caption">
          
        </div>      
      </div>

      <div class="item">
          <img src="images/caurosel2.png" alt="Image">
        <div class="carousel-caption">
          
        </div>      
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
  
<div class="container-fluid">    
  
    <div class="row">
      
        <div class="col-md-12">
            <br>
            <h3 class="h3Mercado">Mercado</h3>

            <button id="Limpa" type="button" class="btn btn-default pull-right" >Limpa Filtros</button>

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
                            <label for="tf_AGO" class="lblTimes"><img src="images/ago.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CAM" value="CAM  "/>
                            <label for="tf_CAM" class="lblTimes"><img src="images/cam.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_APR" value="APR  "/>
                            <label for="tf_APR" class="lblTimes"><img src="images/apr.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_AVA" value="AVA  "/>
                            <label for="tf_AVA" class="lblTimes"><img src="images/ava.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_BAH" value="BAH  "/>
                            <label for="tf_BAH" class="lblTimes"><img src="images/bah.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_BOT" value="BOT  "/>
                            <label for="tf_BOT" class="lblTimes"><img src="images/BOTA.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CHA" value="CHA  "/>
                            <label for="tf_CHA" class="lblTimes"><img src="images/cha.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_COR" value="COR  "/>
                            <label for="tf_COR" class="lblTimes"><img src="images/cor.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CTB" value="CTB  "/>
                            <label for="tf_CTB" class="lblTimes"><img src="images/ctb.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_CRU" value="CRU  "/>
                            <label for="tf_CRU" class="lblTimes"><img src="images/cru.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_FLA" value="FLA  "/>
                            <label for="tf_FLA" class="lblTimes"><img src="images/fla.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_FLU" value="FLU  "/>
                            <label for="tf_FLU" class="lblTimes"><img src="images/flu.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_GRE" value="GRE  "/>
                            <label for="tf_GRE" class="lblTimes"><img src="images/gre.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_PAL" value="PAL  "/>
                            <label for="tf_PAL" class="lblTimes"><img src="images/pal.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_PON" value="PON  "/>
                            <label for="tf_PON" class="lblTimes"><img src="images/pon.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SAN" value="SAN  "/>
                            <label for="tf_SAN" class="lblTimes"><img src="images/san.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SAO" value="SAO  "/>
                            <label for="tf_SAO" class="lblTimes"><img src="images/sao.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_SPO" value="SPO  "/>
                            <label for="tf_SPO" class="lblTimes"><img src="images/spo.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_VAS" value="VAS  "/>
                            <label for="tf_VAS" class="lblTimes"><img src="images/vas.png"></label></li>
                            <li><input type="checkbox" name="chkTimes" id="tf_VIT" value="VIT  "/>
                            <label for="tf_VIT" class="lblTimes"><img src="images/vit.png"></label></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>  
        <div class="col-md-6">
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

</body>

<script>
    
    $(":checkbox").change(function(){
       checkedValueTimes = $(":checkbox[name='chkTimes']:checked").map(function (){return $(this).val();}).get();
       checkedValuePosicoes = $(":checkbox[name='chkPosicoes']:checked").map(function (){return $(this).val();}).get();
       gridMercadoLoad(checkedValueTimes,checkedValuePosicoes);
    });
    
    $('#Limpa').click(function() {
        $('input[type="checkbox"]:checked').attr('checked',false).change();
    });
    
</script>

</html>
