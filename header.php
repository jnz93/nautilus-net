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
    <script>
        new WOW().init()
    </script>
    <header id="" class="wow bounceInDown mainHeader">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mainHeader__flexContainer"> <!-- Container-->
            <div class="col-xs-9 col-sm-6 col-md-4 col-lg-4">
                <?php 
                    if( has_custom_logo() ){
                        $logo_id        = get_theme_mod('custom_logo');
                        $logo_url       = wp_get_attachment_image_src($logo_id, 'medium');
                        $site_name      = get_bloginfo('name');

                        $output =   '<figure id="" class="logo">
                                        <img src="'. $logo_url[0] .'" id="" class="logo__image" alt="'. $site_name .'">
                                        <figcaption class="logo__title">'. $site_name .'</figcaption>
                                    </figure>';
                        
                        echo $output;
                    } else {
                        echo "Adicione um logotipo";
                    }
                ?>
            </div> <!-- #End logotipo -->

            <div class="col-xs-3 col-sm-6 col-md-8 col-lg-8">
                <!-- Botões menu mobile -->
                <button onClick="clickOpenMenuMobile()" class="mainHeader__btnMenu">
                    <i id="ico-menu" class="mainHeader__icoMenu" data-eva="menu" data-eva-width="" data-eva-height=""></i>
                    <i id="ico-close" class="mainHeader__icoMenu mainHeader__icoMenu--disabled" data-eva="close" data-eva-width="" data-eva-height=""></i>
                </button>
                
                <?php 
                if( shortcode_exists('show_menu_navegacao') ){
                    do_shortcode('[show_menu_navegacao]');
                } else {
                    echo "Menu principal ainda não foi criado pela administração.";
                }
                ?>
            </div><!-- #End navigation menu -->
        </div>
    </header> <!-- #End main header -->
