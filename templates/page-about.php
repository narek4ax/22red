<?php
/**
 * Template Name: About
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 4.0.0
 * @author Denis Kabistan
 */
global $post;
?>
<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>
<?php
BsWp::get_template_parts(array('parts/shared/inside_banner'));
?>
<main role="main" class="js">   
    <div class="content">
        <?php
        $section_1_content_image = get_field('section_1_content_image');
        $section_1_title = get_field('section_1_title');
        $section_1_content = get_field('section_1_content');

        if (!empty($section_1_content_image) || !empty($section_1_title) || !empty($section_1_content)) {
            ?>
            <div id="about_intro">
                <div class="container">
                    <div class="about_intro_wrapper">
                        <?php
                        if (!empty($section_1_content_image) || !empty($section_1_title)) {
                            $title_class = '';
                            if (!empty($section_1_content_image)) {
                                $title_class = 'image_exist';
                            }
                            ?>
                            <div class="intro_title <?php echo $title_class; ?>">
                                <?php
                                if ($section_1_content_image) {
                                    $image_attributes = wp_get_attachment_image_src($section_1_content_image, 'full');
                                    ?>
                                    <img src="<?php echo $image_attributes[0]; ?>" />    
                                    <?php
                                }
                                if (!empty($section_1_title)) {
                                    ?>
                                    <h2><?php echo $section_1_title; ?></h2>    
                                    <?php
                                }
                                ?>
                            </div>    
                            <?php
                            if (!empty($section_1_content)) {
                                ?>
                                <div class="intro_content"><?php echo $section_1_content; ?></div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
            <?php
        }
        $section_2_content = get_field('section_2_content');
        $section_2_image = get_field('section_2_image');
        if (!empty($section_2_content) || !empty($section_2_image)) {
            $image_link = '';
            if (!empty($section_2_image)) {
                $image_attributes = wp_get_attachment_image_src($section_2_image, 'full');
                $image_link = $image_attributes[0];
            }
            ?>
            <div id="about_bontique">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col content">
                            <?php
                            if (!empty($section_2_content)) {
                                ?>
                                <div class="about_bontique_wrapper">
                                    <div class="about_bontique_inner_wrapper">
                                        <?php echo $section_2_content; ?>
                                    </div>    
                                </div>    
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col" style="<?php echo (trim($image_link) != '' ? 'background-image: url(' . $image_link . ');' : '') ?>">
                            <?php
                            if (trim($image_link) != '') {
                                ?>
                                <img src="<?php echo $image_link; ?>" />
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>    
            <?php
        }
        $section_3_title = get_field('section_3_title');
        $section_3_pages = get_field('section_3_pages');
        if(!empty($section_3_pages)){
            ?>
            <div id="in_the_press">
                <div class="container">
                    <div class="in_the_press_wrapper">
                        <?php
                        if(!empty($section_3_title)){
                        ?>
                        <h1><?php echo $section_3_title; ?></h1>    
                        <?php
                        }
                        if(!empty($section_3_pages)){
                            ?>
                        <div class="press_page">
                            <div class="row fadedOut" data-animate-section>
                            <?php
                            $count = 0;
                            foreach ($section_3_pages as $key => $value) {
                                $ms = 250 * $count;
                                ?>
                                <div class="col-xl-3 col-md-6 col-sm-12">
                                    <div class="page_item fadedOut page_item_<?php echo $count?>" data-animate-section>
                                        <style>
                                            .press_page .page_item_<?php echo $count?>{
                                                -webkit-transition-delay: <?php echo $ms; ?>ms; 
                                                -moz-transition-delay: <?php echo $ms; ?>ms; 
                                                -ms-transition-delay: <?php echo $ms; ?>ms; 
                                                -o-transition-delay: <?php echo $ms; ?>ms; 
                                                transition-delay: <?php echo $ms; ?>ms;                                               
                                            }
                                            
                                        </style>
                                        <?php
                                        $image = $value['page_image'];
                                        if(!empty($image)){
                                            $img_url = wp_get_attachment_image_src($image,'full');
                                            ?>
                                        <div class="image_wrapper"><img src="<?php echo $img_url[0]; ?>"  /></div> 
                                            <?php
                                        }
                                        $page_content = $value['page_content'];
                                        if(!empty($page_content)){
                                            ?>
                                        <div class="page_item_content">
                                            <p><?php echo $page_content; ?></p>
                                        </div>
                                            <?php
                                        }
                                        $page_link = $value['page_link'];
                                        if(!empty($page_link)){
                                            $open_in_new_tab = $value['open_in_new_tab'];
                                            $target = '_self';
                                            if(!empty($open_in_new_tab) && $open_in_new_tab[0] == 'Yes'){
                                                $target = '_blank';                                                
                                            }
                                            ?>
                                        <div class="page_item_link">
                                            <a target="<?php echo $target; ?>" href="<?php echo $page_link; ?>"><?php echo __('READ MORE','22Red'); ?></a>
                                        </div>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>    
                                <?php
                                $count++;
                            }
                            ?>
                            </div>
                        </div>
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>    
            <?php
        }
        $section_4_content = get_field('section_4_content');
        if(!empty($section_4_content)){
            $section_4_background_image = get_field('section_4_background_image');
            $style = '';
            if(!empty($section_4_background_image)){
                $img_url = wp_get_attachment_image_src($section_4_background_image,'full');
                $style = 'background-image: url('.$img_url[0].')';
            }
            ?>
        <div id="our_collections" style="<?php echo $style; ?>" >
            <div class="container">
                <div class="our_collections_wrapper"><?php echo $section_4_content; ?></div>
            </div>
        </div>
            <?php
        }
        $section_5_title = get_field('section_5_title');
        if(!empty($section_5_title)){
            $section_5_background_image = get_field('section_5_background_image');
            $style = '';
            if(!empty($section_5_background_image)){
                $img_url = wp_get_attachment_image_src($section_5_background_image,'full');
                $style = 'background-image: url('.$img_url[0].')';
            }
            ?>
        <div id="lauret_non_section" style="<?php echo $style; ?>" >
            <div class="container">
                <h1><?php echo $section_5_title; ?></h1>
            </div>
        </div>
            <?php
        }
        $section_6_content = get_field('section_6_content');
        $section_6_image = get_field('section_6_image');
        if (!empty($section_6_content) || !empty($section_6_image)) {
            $image_link = '';
            if (!empty($section_6_image)) {
                $image_attributes = wp_get_attachment_image_src($section_6_image, 'full');
                $image_link = $image_attributes[0];
            }
            ?>
            <div id="elevating_experience">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col" style="<?php echo (trim($image_link) != '' ? 'background-image: url(' . $image_link . ');' : '') ?>">
                            <?php
                            if (trim($image_link) != '') {
                                ?>
                                <img src="<?php echo $image_link; ?>" />
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col content">
                            <?php
                            if (!empty($section_6_content)) {
                                ?>
                                <div class="elevating_experience_wrapper">
                                    <div class="elevating_experience_inner_wrapper">
                                        <?php echo $section_6_content; ?>
                                    </div>    
                                </div>    
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>    
            <?php
        }
        ?>
    </div>
</main>
<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>
