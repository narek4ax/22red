<?php



$hide_stay_updated_for_current_page = get_field('hide_stay_updated_for_current_page');
if (!isset($hide_stay_updated_for_current_page) || $hide_stay_updated_for_current_page[0] != 'Yes') {
    BsWp::get_template_parts(array('parts/shared/stay_updated'));
}
$hide_follow_us_for_current_page = get_field('hide_follow_us_for_current_page');
if (!isset($hide_follow_us_for_current_page) || $hide_follow_us_for_current_page[0] != 'Yes') {
    BsWp::get_template_parts(array('parts/shared/follow_us'));
}

$footer_logo = get_field('footer_logo', 'option');
$footer_content_under_logo = get_field('footer_content_under_logo', 'option');
$footer_background_image = get_field('footer_background_image', 'option');
$footer_background_color = get_field('footer_background_color', 'option');
$copyright = get_field('copyright', 'option');
$copyright_text = get_field('copyright_text', 'option');

$instagram_link = get_field('instagram_link', 'option');
$youtube_link = get_field('youtube_link', 'option');
$twitter_link = get_field('twitter_link', 'option');
$facebook_link = get_field('facebook_link', 'option');


$background = '';
if (!empty($footer_background_image)) {
    $img_url = wp_get_attachment_image_src($footer_background_image, 'full');
    $background = 'background-image: url(' . $img_url[0] . ');';
}
if (!empty($footer_background_color)) {
    $background .= 'background-color: ' . $footer_background_color . ';';
}

BsWp::get_template_parts(array('parts/shared/firewall'));
?>	
<footer style="<?php echo $background; ?>">
    <div class="container">
        <div class="footer_inner_wrapper">
            <div class="footer_top">
                <div class="footer_left">
                    <?php
                    if ($footer_logo) {
                        $logo_attributes = wp_get_attachment_image_src($footer_logo, 'full');
                        ?>
                        <a class="footer_logo" href="/">
                            <img src="<?php echo $logo_attributes[0]; ?>" />
                        </a>
                        <?php
                    }
                    if (!empty($footer_content_under_logo)) {
                        ?>
                        <div class="footer_text_under_logo">
                            <p><?php echo $footer_content_under_logo; ?></p>
                        </div>    
                        <?php
                    }
                    ?>
                </div>
                <div class="footer_right">
                    <?php
                    wp_nav_menu(array(
                        'menu' => 'Footer Menu',
                        'depth' => 2,
                        'container' => false,
                        'menu_class' => 'navbar-nav mr-auto',
                        'fallback_cb' => 'bs4navwalker::fallback',
                        'walker' => new bs4navwalker())
                    );
                    if (!empty($instagram_link) || !empty($youtube_link) || !empty($twitter_link) || !empty($facebook_link)) {
                        ?>
                        <div class="social_icons">
                            <?php
                            if (!empty($instagram_link)) {
                                ?>
                                <a target="_blank" href="<?php echo $instagram_link; ?>">
                                    <i class="fa fa-instagram" aria-hidden="true"></i>
                                    <?php echo __('INSTAGRAM', '22Red'); ?>
                                </a>
                                <?php
                            }
                            ?>

                            <?php
                            if (!empty($youtube_link)) {
                                ?>
                                <a target="_blank" href="<?php echo $youtube_link; ?>">
                                    <i class="fa fa-youtube" aria-hidden="true"></i>
                                    <?php echo __('YOUTUBE', '22Red'); ?>
                                </a>
                                <?php
                            }
                            ?>

                            <?php
                            if (!empty($twitter_link)) {
                                ?>
                                <a target="_blank" href="<?php echo $twitter_link; ?>">
                                    <i class="fa fa-twitter" aria-hidden="true"></i>
                                    <?php echo __('TWITTER', '22Red'); ?>
                                </a>
                                <?php
                            }
                            ?>

                            <?php
                            if (!empty($facebook_link)) {
                                ?>
                                <a target="_blank" href="<?php echo $facebook_link; ?>">
                                    <i class="fa fa-facebook" aria-hidden="true"></i>
                                    <?php echo __('FACEBOOK', '22Red'); ?>
                                </a>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
            <div class="copyright_wrapper">
                <div class="copyright"><?php echo $copyright; ?></div>
                <?php
                wp_nav_menu(array(
                    'menu' => 'Footer Copyright Menu',
                    'depth' => 2,
                    'container' => false,
                    'menu_class' => 'navbar-nav mr-auto',
                    'fallback_cb' => 'bs4navwalker::fallback',
                    'walker' => new bs4navwalker())
                );
                ?>
                <div class="copyright_text"><?php echo $copyright_text ?></div>
            </div>
        </div>
    </div>
</footer>
