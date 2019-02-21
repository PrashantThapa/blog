</div>
<!-- End Ever Container -->

<footer class="footer-area">
    <!-- Start Container -->
    <div class="container">
        <div class="tw-footer clearfix">
        <?php 
            ever_footer_menu();
            $copyright = ever_option('footer_text', sprintf(__( '&copy; 2017 <a href="%s">Ever Magazine Theme</a>. All rights reserved.', 'ever'), 'https://themeforest.net/user/themewaves'));
            if(!empty($copyright)){
                echo '<p class="copyright">'.wp_kses_post($copyright).'</p>';
            }
            $socials = ever_option('footer_socials');
            if(!empty($socials)){
                $class = ever_option('footer_socials_color', 'silver');
                echo '<div class="tw-social-icon social-'.esc_attr($class).' clearfix">';
                    $social_links=explode("\n",$socials);
                    foreach($social_links as $social_link){ 
                        $link=explode("|",$social_link);
                        echo ever_social_link(esc_url($link[0]));
                    }
                echo '</div>';
            }
        ?>
        </div>
    </div>
    <!-- End Container -->
</footer>

</div>
<div class="scrollUp"><a class="scrollUp-child" href="#"><i class="ion-ios-arrow-up"></i></a></div>
<?php wp_footer(); ?>
</body>
</html>