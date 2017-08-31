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
  
  <!--User Script-->
  <script src="js/functions.js"></script>
  
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      /*background-color: black;*/
    }
    
    /* Add a gray background color and some padding to the footer */
    footer {
      background-color: #f2f2f2;
      padding: 25px;
    }
    
  .carousel-inner img {
      /*width: 100%;  Set width to 100% */
      margin: auto;
      /*min-height:200px;*/
      max-height: 300px !important;
  }

  /* Hide the carousel text when the screen is less than 600 pixels wide */
  @media (max-width: 600px) {
    .carousel-caption {
      display: none; 
    }
  }
  
  /*Style configuration for checkboxes*/
  ul {
    list-style-type: none;
    margin: 0px;
    padding: 0px;
  }

  li {
    display: inline-block;
  }

  input[type="checkbox"] {
    display: none;
  }

  /*Style configuration for teams checkboxes*/
  label.lblTimes {
    border: 1px solid #fff;
    padding: 10px;
    display: block;
    position: relative;
    margin: 10px;
    cursor: pointer;
  }

  label.lblTimes:before {
    background-color: white;
    color: white;
    content: " ";
    display: block;
    border-radius: 50%;
    border: 1px solid white;
    position: absolute;
    top: 25px;
    left: 25px;
    width: 20px;
    height: 20px;
    text-align: center;
    line-height: 20px;
    transition-duration: 0.4s;
    transform: scale(0);
  }

  label.lblTimes img {
    height: 30px;
    width: 30px;
    transition-duration: 0.2s;
    transform-origin: 50% 50%;
  }

  :checked + label.lblTimes:before {
    content: "✓";
    background-color: #5fba7d;
    transform: scale(1);
  }

  /*Style configuration for positions checkboxes*/
  label.lblPosicoes {
    /*border: 1px solid #eee;*/
    padding: 10px;
    display: inline-block;
    margin: 10px;
    cursor: pointer;
    font-size: 160%;
    width: 100px;
    color: black;
  }

  label.lblPosicoes:before {
    
    font-family: FontAwesome;
    letter-spacing: 10px;
    color: lightgrey;
    content: "\f10c";
  }

  :checked + label.lblPosicoes:before {
    content: "\f05d";
    color: #5fba7d;
  }
  
  a.linkPanel {
      display: block;
      text-decoration: none;
      font-size: 150%;
      color: black;
  }
  
  .h3Mercado {
      display: inline;
  }

  .separa {
      clear: both;
  }
  
  .logo {
      display: inline-block;
      margin: 0px;
      padding: 5px;
      /*background-color: black;*/
  }
  
  .affix {
      top: 0;
      width: 100%;
      z-index: 9999 !important;
  }

  .affix + .container-fluid {
      padding-top: 50px;
  }
  
  </style>
  
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
        <li><a href="index.php">Home</a></li>
        <li class="active"><a href="analise.php">Análise</a></li>
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
        <h3 class="h3Mercado">Análise</h3>
        
        <button type="button" class="btn btn-default pull-right" >Analisar</button>
        
    </div>  
    
   <div class="col-md-12 separa">
        <br>
    </div>
      
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Atacantes</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>  
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Meias</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Laterais</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Zagueiros</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Goleiros</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading"><a class="linkPanel" href="#teamFilter" data-toggle="collapse">Técnicos</a></div>
            <div id="teamFilter" class="panel-collapse collapse in teste">
                <div class="panel-body">
            
                </div>
            </div>
        </div>
    </div>
  </div>
</div><br>

<footer class="container-fluid text-center">
  <p>Copyright © 2017 CartolaAnalytics. All rights reserved.</p>
</footer>

</body>

<script>
    

    
</script>

</html>
