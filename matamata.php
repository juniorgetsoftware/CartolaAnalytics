<!DOCTYPE html>
<html lang="pt-BR">
<head>
    
  <!-- Global Site Tag (gtag.js) - Google Analytics -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=UA-107272405-1"></script>
  <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-107272405-1');
  </script>

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
  
  <!--Bracket CSS-->
  <link rel="stylesheet" type="text/css" href="css/jquery.bracket.min.css?v=1.0.5">
  
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/matamata.css?v=1.0.5">
  
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--Bootstrap Script-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
  <!--LINQ for JQuery-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/jquery.linq.min.js" integrity="sha256-e8ZjfQ7o8BN09SDIz2sYT7fSUPGOMqCBLzy1BZbNdgg=" crossorigin="anonymous"></script>
  
  <!--LINQ for Javascript-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/linq.js/2.2.0.2/linq.min.js" integrity="sha256-dq1fzSor46Oc+U/DjuE2hKKN0FfvbVx+CW5GBn1mhiQ=" crossorigin="anonymous"></script>

  <!--Bracket Script-->
  <script src="js/jquery.bracket.min.js?v=1.0.6"></script>
  
  <!--User Scripts-->
  <script src="js/matamataHostilidadefunctions.js?v=1.0.7"></script>
  <script src="js/matamataHostilidade.js?v=1.0.7"></script>
  
</head>
<body data-spy="scroll" data-target=".navbar" data-offset="50">

<?php include('templates/header.html'); ?>    
    
<div class="container-fluid">    
  
    <div class="row">
      
        <div class="col-md-12">
            <br>
            <h3 class="h3Mercado">Mata-Mata</h3>
            <div class="btn-group pull-right">
                <!--<label class="" for="selhorizonte">N. Rodadas:</label>-->
                <select class="btn btn-default" id="selmatamata">
                    <option value="matamataHostilidade03.json">Mata-mata 03</option>
                    <option value="matamataHostilidade04.json" selected="selected">Mata-mata 04</option>
                </select>
                <button id="Atualiza" type="button" class="btn btn-default" >Atualizar</button>
            </div>
        </div>  

        <div class="col-md-12 separa">
            <br>
        </div>
          
        <div id="tournament" class="col-md-12" style="overflow: auto;">
            <div class="aux"></div>
            <div class="bracket"></div>
        </div>
        
        <br>
        
    </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright © 2017 CartolaAnalytics. All rights reserved.</p>
</footer>

<!--Modal for Loader-->
<div id="modalloader"></div>

</body>

<script src="js/matamatafooter.js?v=1.0.8"></script>

</html>
