<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset = "utf-8"/>
        <title><?= $title ?></title>

        <!-- Meta-tags -->
        <meta name="description" content="Blog de Jean Forteroche" />
        <meta name="keywords" content="Jean Forteroche, chapitres, nouveaux chapitres, commentaires" />
        <meta name="author" content="Aude Leissen">
        <meta name="robots" content="index, follow">
        <meta name="revisit-after" content="3 month">
        <meta name="language" content="French">

        <!-- Open Graph data -->
        <meta property="og:title" content="Blog de Jean Forteroche"/>
        <meta property="og:type" content="website"/>
        <meta property="og:url" content="http://audeleissen.com/BlogJeanForteroche"/>
        <meta property="og:image" content="../public/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg"/>
        <meta property="og:description" content="Blog de Jean Forteroche - Un billet simple pour l'Alaska"/>

        <!-- Twitter Card data-->
        <meta name="twitter:card" content="summary">
        <meta name="twitter:site" content="http://audeleissen.com/BlogJeanForteroche">
        <meta name="twitter:title" content="Blog de Jean Forteroche">
        <meta name="twitter:description" content="Blog de Jean Forteroche - Un billet simple pour l'Alaska">
        <meta name="twitter:creator" content="@AudeL">
        <meta name="twitter:image" content="../public/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg">

        <!-- IE -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <!-- Devices -->
        <meta name="viewport" content = "width = device-width, initial-scale = 1">

        <!-- Stylesheets -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
        <link rel="stylesheet" href="../public/css/style.css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/repond.min.js"></script>
        <![endif]-->

	</head>

	<body>
            <header class="page-header">
                <!-- Loading the necessary nav bar regarding if the visitor is connected or not -->
                <nav class="navbar navbar-expand-md navbar-light bg-light">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        <?php
                        if(!isset($_SESSION['id'])){
                            require ('visitor.php');
                        } else {
                            require ('connected.php');
                        }
                        ?>
                    </div>
                </nav>
            </header>

        <!-- Display the banner image -->
        <div class="container-fluid">
            <section class="row" id="bannerSection">
                <div id="banner">
                    <img class="img-responsive" src="../public/assets/images/Mt._Hayes_and_the_eastern_Alaska_Range_mountains.jpg" alt="Mount Hayes and the eastern Alaska Range mountains"/>

                    <div id="bannerDescription" class="col-xs-12">
                        <h1>Billet simple pour l'Alaska</h1>
                        <h2>par Jean Forteroche</h2>
                    </div>
                </div>
            </section>
        </div>

        <!-- Display the content loaded from the different views -->
        <div class="container-fluid" id="content">
            <?= $content ?>
        </div>


        <!-- JavaScript Files -->
        <!-- Bootstrap -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

        <!-- TinyMCE -->
            <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=47ep4zzfi51ytdurn5a7ju3fuix1v553r78z5vw16yh9wgsl"></script>
            <script>tinymce.init({
                mode: "specific_textareas",
                editor_selector:"writtingChapter"
            });</script>

	</body>
</html>