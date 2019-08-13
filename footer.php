<?php 
/**
 * The footer for our theme
 */
?>
    <footer class="container-fluid footer-t1">
        <?php 
        if( shortcode_exists('show_footer_type_1')){
            do_shortcode('[show_footer_type_1]');
        } else {
            echo "Shortcode inexistente";
        }
        ?>
        <script>
            eva.replace();
            new WOW().init();
        </script>
    </footer>
    <?php wp_footer(); ?>
    </body>
</html>