/**
 * sliders.js responsável por adicionar, remover e modificar slick-sliders nos elementos necessários
 * v1.0.0
 */
jQuery(document).ready(function(){
   
    var screenWidth = jQuery(window).width(),
        offset = jQuery(this).offset();
    
    /**
     * slider team cards - just mobile version
     */
    if( screenWidth <= 400 ){

        /**
         * Slick slider - Homepage
         */
        jQuery('.articleHome__wrapperSlider').slick({
            dots: true,
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1
        });

        /**
         * Slick slider - Planos mobile
         */
        jQuery('.sct__plans > .sct__contentWrapper').slick({
            dots: true,
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1,
        });


       
    };

    /**
     * slider team cards - above old desktop
     */
    if( screenWidth >= 860 ){
        /**
         * Slick slider - Homepage
         */
        jQuery('.articleHome__wrapperSlider').slick({
            dots: true,
            arrows: false,
            infinite: false,
            slidesToShow: 1,
            slidesToScroll: 1
        });
    }
});