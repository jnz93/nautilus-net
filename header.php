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


    <header id="" class="headerMain">
        <div class="container-fluid row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row headerMain__top">
                <div class="col-lg-4">
                    <div class="infoWrapper">
                        <p class="infoWrapper__text"><i class="infoWrapper__icon"></i> A loja está aberta</p>
                        <p class="infoWrapper__text"><i class="infoWrapper__icon"></i> A loja está fechada</p>
                    </div>
                </div> <!-- #End horário comercial loja -->

                <div class="col-lg-8">
                    <ul class="contactList">
                        <li class="contactList__item">
                            <i class="contactList__icon"></i>
                            <span class="contactList__text">Informação</span>
                        </li>

                        <li class="contactList__item">
                            <i class="contactList__icon"></i>
                            <span class="contactList__text">Informação</span>
                        </li>

                        <li class="contactList__item">
                            <i class="contactList__icon"></i>
                            <span class="contactList__text">Informação</span>
                        </li>
                    </ul> <!-- #End informações top -->
                </div>
            </div> <!-- #End parte de cima -->

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 row headerMain__bottom">
                <div class="col-lg-4">
                    <?php do_shortcode('[custom_logotipo]'); ?>
                </div> <!-- #End Logotipo -->

                <div class="col-lg-8">
                    <?php do_shortcode('[menu_fixed]'); ?>
                </div>
            </div> <!-- #End parte de baixo -->
        </div> <!-- #end Container -->
    </header> <!-- #End main header -->
