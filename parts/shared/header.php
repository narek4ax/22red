<?php
$light_header = get_field('light_header');
$header_class = '';
//var_dump($light_header);
if(!empty($light_header) && $light_header[0] == 'Yes'){
    $header_class = 'light_header';
}
?>
<header id="header" class="<?php echo $header_class; ?>">
    <div class="container">
        <?php $logo_white = get_field('white_font_logo','option'); ?>
        <div class="logo fadedOut <?php echo (!empty($logo_white) ? 'has_white_logo' : '');?>" data-animate-section>
            <a href="/">
                <?php 
                $logo = get_field('logo','option');
                if($logo){
                    $logo_attributes = wp_get_attachment_image_src($logo,'full');
                    ?>
                <img class="original" src="<?php echo $logo_attributes[0]; ?>" />
                    <?php
                }
                
                if($logo_white){
                    $logo_attributes = wp_get_attachment_image_src($logo_white,'full');
                    ?>
                <img class="white" src="<?php echo $logo_attributes[0]; ?>" />
                    <?php
                }
                ?>
            </a>
        </div>
        <nav class="navbar navbar-expand-lg navbar-light bg-faded">
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#primaryNav" aria-controls="primaryNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="line"></span>
                    <span class="line"></span>
                    <span class="line"></span>
                </button>

                <div class="collapse navbar-collapse" id="primaryNav">
                        <?php
                        wp_nav_menu( array(
                                'menu'          	=> 'primary',
                                'theme_location'	=> 'primary',
                                'depth'         	=> 2,
                                'container'			=> false,
                                'menu_class'    	=> 'navbar-nav mr-auto',
                                'fallback_cb'   	=> 'bs4navwalker::fallback',
                                'walker'         	=> new bs4navwalker())

                        );
                        ?>
                        <?php // get_search_form(); ?>
                </div>
        </nav>
        <div class="clearfix"></div>
    </div>
</header>
