<!DOCTYPE html>
<html lang="ptBR">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EVA - Sistema Web para Gestão de Eventos Culturais</title>

	<link rel="shortcut icon" type="image/png" href="<?=base_url()?>img/favicon.png">

    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">

    <!-- Custom Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="<?=base_url()?>css/font-awesome.min.css" type="text/css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="<?=base_url()?>css/animate.min.css" type="text/css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?=base_url()?>css/creative.css" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a class="page-scroll" href="#about">Sobre</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#services">Vantagens</a>
                    </li>
                    <!--
                    <li>
                        <a class="page-scroll" href="#portfolio">Portfolio</a>
                    </li>
                    -->
                    <li>
                        <a class="page-scroll" href="#manual">Manual</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="#contact">Contato</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="<?=base_url()?>eva">Sistema Eva</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <header>
        <div class="header-content">
            <div class="header-content-inner">
            	<img src="<?=base_url()?>img/logo_hover.png" width="40%">
                <h1>Faça o planejamento completo de seu evento</h1>
                <hr>
                <p>O Sistema EVA é um software gratuito que auxilia na gestão de seu evento cultural, coordenando equipes, tarefas, inscrições de artistas e produtores voluntários, 
                    mantendo você informado sobre tudo em tempo real! </p>
                <a href="#about" class="btn btn-primary btn-xl page-scroll">Saiba mais!</a>
            </div>
        </div>
    </header>

    <section class="bg-primary" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Uma metodologia que funciona!</h2>
                    <hr class="light">
                    <p class="">Desenvolvido a partir de um TCC, o Sistema EVA traz conhecimentos do Senado Federal, do <i>Guia PMBOK&reg;</i> e de práticas do Ministério da Cultura, 
                                            oferecendo uma metodologia completa que irá guiar o gestor através de todos os processos de um evento cultural.</p>
                    <p class="">Em conjunto com o sistema utilize o <a class="page-scroll" href="#manual" style="color: white; font-weight: bold;">Manual para Gestão de Eventos</a>, 
                                            que organiza a gestão do evento em 4 fases: iniciação, planejamento, execução e encerramento, garantindo assim um melhor controle sobre todos os processos de sua realização.</p>
                    <a href="<?=base_url()?>eva" class="btn btn-default btn-xl">Comece agora!</a>
                </div>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Vantagens do Sistema EVA</h2>
                    <hr class="primary">
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-user wow bounceIn text-primary"></i>
                        <h3>Inscrições</h3>
                        <p class="text-muted">Realize pelo sistema a inscrição de artistas e voluntários.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-clock-o wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Cronograma</h3>
                        <p class="text-muted">Monitore todas as tarefas, controle os prazos!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-road wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Suporte</h3>
                        <p class="text-muted">Estabeleça rotas de traslados e acomode os artistas.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-star wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Apresentações</h3>
                        <p class="text-muted">Agende e acompanhe a participação de cada artista!</p>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-calendar wow bounceIn text-primary"></i>
                        <h3>Calendário</h3>
                        <p class="text-muted">Saiba, dia a dia, o que acontecerá no planejamento do evento.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-leaf wow bounceIn text-primary" data-wow-delay=".1s"></i>
                        <h3>Roteiro</h3>
                        <p class="text-muted">Manual interno sobre o que fazer em cada etapa!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-mobile wow bounceIn text-primary" data-wow-delay=".2s"></i>
                        <h3>Smartphones</h3>
                        <p class="text-muted">Design responsivo que se adapta a qualquer dispositivo!</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 text-center">
                    <div class="service-box">
                        <i class="fa fa-4x fa-usd wow bounceIn text-primary" data-wow-delay=".3s"></i>
                        <h3>Balanço</h3>
                        <p class="text-muted">Controle o financeiro sem deixar o orçamento estourar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--
    <section class="no-padding" id="portfolio">
        <div class="container-fluid">
            <div class="row no-gutter">
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/1.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/2.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/3.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/4.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/5.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-4 col-sm-6">
                    <a href="#" class="portfolio-box">
                        <img src="img/portfolio/6.jpg" class="img-responsive" alt="">
                        <div class="portfolio-box-caption">
                            <div class="portfolio-box-caption-content">
                                <div class="project-category text-faded">
                                    Category
                                </div>
                                <div class="project-name">
                                    Project Name
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>
    -->

    <section id="manual">
        <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2>Faça gratuitamente o download do Manual para Gestão de Eventos</h2>
                    <a href="<?=base_url()?>uploads/manual.pdf" target="_blank" class="btn btn-default btn-xl wow tada">Download</a>
                </div>
            </div>
        </aside>
    </section>

    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Entre em contato conosco!</h2>
                    <hr class="primary">
                    <p>Possui alguma dúvida sobre o Sistema EVA ou precisa de consultoria?<br>Não hesite em nos contactar!</p>
                </div>
                <div class="col-lg-4 col-lg-offset-2 text-center">
                    <i class="fa fa-phone fa-3x wow bounceIn"></i>
                    <p>+55 (35) 9131-1372</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x wow bounceIn" data-wow-delay=".1s"></i>
                    <p><a href="mailto:contato@sistemaeva.com.br">contato@sistemaeva.com.br</a></p>
                </div>
            </div>
        </div>
    </section>

    <section class="bg-primary">
        <div class="container">
            <div class="container text-center">
                <div class="call-to-action">
                    <h2 class="section-heading">Acesse gratuitamente!</h2>
                    <a href="<?=base_url()?>eva" class="btn btn-default btn-xl">Sistema EVA</a>
                </div>
            </div>
        </div>
    </section>

    <!-- jQuery -->
    <script src="<?=base_url()?>js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?=base_url()?>js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="<?=base_url()?>js/jquery.easing.min.js"></script>
    <script src="<?=base_url()?>js/jquery.fittext.js"></script>
    <script src="<?=base_url()?>js/wow.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?=base_url()?>js/creative.js"></script>

</body>

</html>
