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
  
  
  
  <!--JQuery-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  
  <!--Bootstrap Script-->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
  <!--User CSS-->
  <link rel="stylesheet" type="text/css" href="css/help.css?v=0.0.4">
  
  <script>
        $(document).ready(function() {
            //Menu Link adjust
            $('#menuHelp').addClass("active");
        });
  </script>
</head>
<body>
    <?php include('templates/header.html'); ?>    
    <div class="container-fluid">    
        <div class="row content">
            <div class="col-md-2 sidenav text-center">
                <p><a href="#intro"><strong>Introdução</strong></a></p>
                <p><a href="#tipos"><strong>Tipos de Projeção</strong></a></p>
                <p><a href="#parametros"><strong>Parâmetros</strong></a></p>
            </div>  
            <div class="col-md-8">
                <article>
                    <h1>Projeções do Cartola Analytics</h1>
                    <hr>
                    <section id="intro">
			<h2>Introdução</h2>
                        <p>
                            As projeções do <Strong>Cartola Analytics</Strong> foram inspiradas no <i>www.scoutscartola.com</i>. Este website disponibilizava 
                            uma seção que informava, por exemplo, quais times cediam mais pontos para atacantes. Você ainda tinha a opção de escolher ver as 
                            informações baseadas nas últimas 5 ou nas últimas 10 rodadas. Este conjunto de dados auxiliava na escalação dos jogadores, 
                            com base em análise estatística. Infelizmente, este site não se encontra mais disponível, o que motivou a criação do Cartola Analytics. 
                        </p>
                        <p>
                            O <i>scoutscartola</i> fornecia um conjunto de dados sobre os times e as posições que eram posteriormente trabalhados manualmente, 
                            com auxílio de planilhas eletrônicas. A proposta do Cartola Analytics foi automatizar este processo e entregar projeções de pontos 
                            que um jogador pode fazer com base no seu histórico e no próximo adversário. 
                        </p>
                        <p>
                            <strong>Observação:</strong> Vale lembrar que as projeções são resultados de cálculos que sugerem uma pontuação caso o jogador 
                            tenha o mesmo desempenho médio das rodadas analisadas, mas o futebol sabemos como é, imprevisível, 
                            sempre vale a pena alguma aposta. Talvez o mais interessante seja analisar o ranking de cada posição e não o valor projetado 
                            para cada jogador.
                        </p>
                        <a href="#" class="pull-right"> <i class="fa fa-toggle-up fa-2x"></i></a>
                        <br>
                    </section>
                    
                    <section id="tipos">
                        <hr>
                        <h2>Tipos de projeção</h2>
                        <p>
                            Após ser calculada, a análise retorna 3 tipos de projeção: <strong>Por jogador, por posição e global </strong>. O usuário 
                            pode ver cada uma alterando a opção selecionada na seção de filtros de "Visualização". 
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help1.png" alt="ClassMercado">
				<figcaption align="center">Fig. 1 - Seleção do tipo de análise para visualização</figcaption>			
			</p>                        
                        <br>
                        <p>
                            <strong>Observação:</strong> Ao alternar entre as opções, o sistema filtra o resultado da análise já calculada e apresenta 
                            a opção selecionada, sem a necessidade de rodar a análise novamente para cada tipo de visualização. 
                        </p>
                        <p>
                            Veja a explicação de cada um dos tipos de projeção a seguir.
                        </p>

                        <h3>Jogador</h3>
                        <p>
                            De acordo com os parâmetros setados (ver em <a href="#parametros"><strong>Configuração de parâmetros para o cálculo</strong></a>), a visão por 
                            jogador retorna o valor projetado para cada jogador com status provável ou dúvida, apresentando na forma de gráficos de barra 
                            horizontal, na ordem decrescente, como se fosse um ranking, para cada posição. O cálculo leva em conta o histórico de pontos 
                            ganhos por cada jogador e o histórico de pontos cedidos pelo próximo adversário para a posição deste jogador.
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help2.png" alt="ClassMercado">
				<figcaption align="center">Fig. 2 - Exemplo de visualização de análise por jogador</figcaption>			
			</p>
                        <br>
                        <p>
                            O label dos gráficos tem o seguinte formato:
                        </p>
                        <p>
                            (<strong>D</strong>úvida ou <strong>P</strong>rovável) {Nome do jogador} - {Clube} ({número de jogos realizados}) {Confronto}
                        </p>
                        
                        <h3>Posição</h3>
                        <p>
                            De acordo com os parâmetros setados (ver em <a href="#parametros"><strong>Configuração de parâmetros para o cálculo</strong></a>), a visão por 
                            posição retorna o valor projetado para cada clube, por posição. Por exemplo, se verificar o gráfico 
                            de meias e constatar um valor projetado de 6 pontos para a Chapecoense, significa que, de acordo com o histórico
                            e o próximo adversário, os meias da Chapecoense devem fazer 6 pontos cada um se tiverem o mesmo rendimento no próximo confronto.  
                            Da mesma forma que na visão por jogador, apresenta o resultado na forma de gráficos de barra horizontal, na ordem decrescente, 
                            como se fosse um ranking, para cada posição. O cálculo leva em conta o histórico de pontos ganhos por cada clube naquela posição e o 
                            histórico de pontos cedidos pelo próximo adversário para a mesma posição.
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help3.png" alt="ClassMercado">
				<figcaption align="center">Fig. 3 - Exemplo de visualização de análise por posição</figcaption>			
			</p>
                        <br>
                        <p>
                            O label dos gráficos tem o seguinte formato:
                        </p>
                        <p>
                            {Clube} - {Confronto}
                        </p>
                        
                        <h3 id="global">Global</h3>
                        <p>
                            De acordo com os parâmetros setados (ver em <a href="#parametros"><strong>Configuração de parâmetros para o cálculo</strong></a>), a visão global 
                            retorna o valor projetado para cada jogador com status provável ou dúvida, apresentando na forma de gráficos de barra 
                            horizontal, na ordem decrescente, como se fosse um ranking, para cada posição. O cálculo da análise global faz uma média dos 
                            valores projetados da análise por jogador, por posição e também leva em conta a média deste jogador no campeonato inteiro. 
                            O peso de cada uma destas 3 parcelas no cálculo é definido através de um slider na seção de configurações de <strong>Análise</strong>.
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help4.png" alt="ClassMercado">
				<figcaption align="center">Fig. 4 - Slider para configuração de distribuição de pesos da análise global</figcaption>			
			</p>
                        <br>
                        <p>
                            O label dos gráficos tem o mesmo formato da opção <strong>Jogador</strong>.
                        </p>
                        <p align="center">
                            <img class="img-responsive" src="images/help5.png" alt="ClassMercado">
				<figcaption align="center">Fig. 5 - Exemplo de visualização de análise global</figcaption>			
			</p>
                        <a href="#" class="pull-right"> <i class="fa fa-toggle-up fa-2x"></i></a>
                        <br>
                    </section>
                    
                    <section id="parametros">
                        <hr>
                        <h2>Configuração de parâmetros para o cálculo da análise</h2>
                        <p>
                            Para rodar a análise precisamos definir alguns parâmetros para o cálculo: 
                            <ul>
                                <li>Horizonte</li>
                                <li>Mando de campo</li>
                                <li>Distribuição de pesos para a análise global</li>
                            </ul>
                        </p>
                        
                        <h3>Horizonte</h3>
                        <p>
                            Para o cálculo das projeções precisamos definir o horizonte, ou seja, quantas rodadas passadas, contando da atual, 
                            serão analisadas. Para isso, selecione uma opção na seção de configurações de "Análise" em "N. Rodadas".
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help6.png" alt="ClassMercado">
				<figcaption align="center">Fig. 6 - Configuração do horizonte de análise</figcaption>			
			</p>
                        <br>
                        <h3>Mando de campo</h3>
                        <p>
                            Também devemos informar se será avaliado o mando de campo ou não. 
                        </p>
                        <br>
                        <p align="center">
                            <img class="img-responsive" src="images/help7.png" alt="ClassMercado">
				<figcaption align="center">Fig. 7 - Define se analisa mando de campo ou não</figcaption>			
			</p>
                        <br>
                        <p>
                            Se for marcada a opção de avaliar mando de campo e um jogador vai jogar o próximo jogo em casa, serão avaliadas todas as 
                            rodadas, dentro do horizonte definido, que ele jogou em casa. Por exemplo, se foi definido um horizonte de 6 rodadas e 
                            você selecionar análise com mando de campo, para cada jogador serão analisadas 3 rodadas e não 6, pois cada time, 
                            geralmente, faz uma partida dentro de casa e outra fora, na sequência. Mas o número pode variar para 2 ou 4, caso o time 
                            analisado tenha duas partidas em sequência em casa ou fora. Ou ainda pode até ser 1 ou 0 (zero), caso o jogador tenha
                            ficado fora por algumas rodadas devido suspensão ou lesão. Se o jogador atuou normalmente e você desejar analisar todos os 6 jogos,
                            sem considerar o mando de campo, desmarque a opção. 
                        </p>
                        
                        <h3>Pesos para a análise global</h3>
                        <p>                            
                            Por fim, definimos a distribuição de pesos, em porcentagens, para o cálculo da análise global. A definição é feita através 
                            de um slider na seção de configurações de "Análise", conforme apresentado em <a href="#global"><strong>Tipos de projeção</strong></a>, tipo Global.
                        </p>
                                                
                        <a href="#" class="pull-right"> <i class="fa fa-toggle-up fa-2x"></i></a>
                        
                    </section>
                    <section>
                        <br>
                    </section>
                </article>
            </div>
            <div class="col-md-2 sidenav"></div>  
        </div>
    </div>
    <footer class="container-fluid text-center">
      <p>Copyright © 2017 CartolaAnalytics. All rights reserved.</p>
    </footer>
</body>

</html>
