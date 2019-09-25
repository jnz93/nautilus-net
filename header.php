<?php 
/**
 * The header for our theme
 * 
 * Displays all of the <head> section
 * 
 * @package nautilusnet
 */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title><?php echo get_bloginfo('title'); ?></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="pingback" href="<?php echo esc_url(get_bloginfo('pingback_url')); ?>">
    <link href="https://fonts.googleapis.com/css?family=Hind:300,400,500|Poppins:400,600,800&display=swap" rel="stylesheet">
    <?php wp_head(); ?>
</head>
<body>
    <?php snippet_ganalytics(); ?>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v4.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>


    <header id="" class="masterHeader">
        <div class="container-fluid row masterHeader__container">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row masterHeader__top">
                <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
                    <div class="infoWrapper">
                        <i class="infoWrapper__icon infoWrapper__icon--online" data-eva="radio-button-on"></i><p class="infoWrapper__text infoWrapper__text--online"> A loja está aberta</p>
                        <!-- <p class="infoWrapper__text"><i class="infoWrapper__icon"></i> A loja está fechada</p> -->
                    </div>
                </div> <!-- #End horário comercial loja -->

                <div class="col-xs-6 col-sm-6 col-md-8 col-lg-8">
                    <ul class="infoList">
                        <li class="infoList__item">
                            <i class="infoList__icon" data-eva="pin"></i>
                            <span class="infoList__text">Av. Iguaçu, 445 - Centro, Capitão Leônidas Marques</span>
                        </li>

                        <li class="infoList__item">
                            <i class="infoList__icon" data-eva="message-circle"></i>
                            <span class="infoList__text">(45) 99831-3997</span>
                        </li>

                        <li class="infoList__item">
                            <i class="infoList__icon" data-eva="phone-call"></i>
                            <span class="infoList__text">(45) 3286-2985</span>
                        </li>
                    </ul> <!-- #End informações top -->
                </div>
            </div> <!-- #End parte de cima -->

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row masterHeader__bottom">
                <div class="col-xs-7 col-sm-7 col-md-4 col-lg-4">
                    <?php do_shortcode('[custom_logotipo]'); ?>
                </div> <!-- #End Logotipo -->

                <div class="col-xs-5 col-sm-5 col-md-8 col-lg-8">
                    <?php do_shortcode('[menu_fixed]'); ?>
                </div>
            </div> <!-- #End parte de baixo -->
        </div> <!-- #end Container -->
    </header> <!-- #End main header -->
