<?php
/**
 * Template Name: Homepage
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 4.0.0
 * @author Denis Kabistan
 */
?>
<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>
<main role="main" class="js">
    <?php 
    $slides = get_field('home_banner_items');
    if(!empty($slides)){
    ?>
    <div class="featured-work full-page-slides">
        <?php
        $slide_count = 0;
        foreach ($slides as $key => $value) {
            $background = wp_get_attachment_image_src($value['background'],'full');
            $style = ''; 
            $slide_class = '';
            if(!empty($background)){
               $style= 'style="background-image: url('.$background[0].')"';
            }
            if($slide_count == 0){
                $slide_class = 'slideIn';
            }
//            var_dump($value['show_with_special_style']);
            if($value['show_with_special_style'][0] == 'Yes'){
                $slide_class .= ' first_slide';
            }
            
        ?>
        <article class="full-page-slide clearfix  <?php echo $slide_class; ?>" <?php echo $style; ?> >
            
            <div class="frontdrop">
                <div class="container">
                    <div class="slide_content_wrapper">
                        <?php
                        if(!empty($value['title'])){
                        ?>
                        <h1>
                            <?php echo $value['title']; ?>
                        </h1>
                        <?php
                        }
                        ?>
                        <?php
                        if($value['image_in_content']){
                            $image_in_content = wp_get_attachment_image_src($value['image_in_content'],'full');
                            ?>
                        <div class="slide_content_image"><img src="<?php echo $image_in_content[0]; ?>" /></div>    
                            <?php
                        }
                        ?>
                        <?php
                        if($value['content']){
                            ?>
                        <div class="slide_content_text"><h4><?php echo $value['content']; ?></h4></div>    
                            <?php
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
            <?php
            if($value['background_part_image']){
                $image_in_content = wp_get_attachment_image_src($value['background_part_image'],'full');
                ?>
            <div class="background_part_image"><img src="<?php echo $image_in_content[0]; ?>" /></div>    
                <?php
            }
            ?>
        </article>
        <?php
            $slide_count++;
        }
        /** adding index for next section of slide **/
//        $slide_count = $slide_count + 1;
        ?>
        
        <ol class="control-nav">
            <?php
            for($i = 0;$i <= $slide_count;$i++){
                $index_class = '';
                if($i == 0){
                    $index_class = 'active';
                }
                ?>
                <li class="<?php echo $index_class; ?>"><a href="#"></a></li>
                <?php
            }
            ?>
        </ol>
        <div class="scroll-to-explore-container">
            <div class="container">
                <div class="scroll-to-explore">
                    <?php echo __('DISCOVER 22RED','22Red'); ?>
                    <a href="#explore" class="navigation-helper_new bounce" title="Scroll Down"><div class="down_arrow "><div></div></div></a>
                </div>
            </div>
        </div>
        
    </div>
    <?php 
    }
    ?>
    <div class="home-secondary" >
        <div class="content">
        <?php
        $section_1_content = get_field('section_1_content');
        if(!empty($section_1_content)){
            $section_1_background = get_field('section_1_background');
            $background = '';
            if(!empty($section_1_background)){
                $img_url = wp_get_attachment_image_src($section_1_background,'full');
                $background = 'background-image: url('.$img_url[0].')';
            }
        ?>
            <div id="home_intro" style="<?php echo $background; ?>">
                <div class="container">
                    <div class="intro_wrapper " ><?php echo $section_1_content; ?></div>                
                </div>
            </div>
        <?php
        }
        $section_2_title = get_field('section_2_title');
        $section_2_images = get_field('section_2_images');
        if(!empty($section_2_images)){
            $section_2_background = get_field('section_2_background');
            $background = '';
            if(!empty($section_2_background)){
                $img_url = wp_get_attachment_image_src($section_2_background,'full');
                $background = 'background-image: url('.$img_url[0].')';
            }
            ?>
            <div id="the_core_goods" style="<?php echo $background; ?>">
                <div class="container">
                    <div class="the_core_goods_wrapper">
                    <?php
                    if(!empty($section_2_title)){
                        ?>
                        <h1><?php echo $section_2_title; ?></h1>    
                        <?php
                    }
                    if(!empty($section_2_images)){
                       ?>
                        <div class="images_wrapper">
                            <?php
                           foreach ($section_2_images as $key => $value) {
                               $image = wp_get_attachment_image_src($value['image'],'full');
                               ?>
                            <img src="<?php echo $image[0]; ?>" />   
                                <?php
                           }
                            ?>
                        </div>   
                        <?php 
                    }
                    ?>
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
        $posts_per_page = 5;
        $section_4_title = get_field('section_4_title');
        $show_blog_on_home = get_field('show_blog_on_home');
        $posts_count = get_field('section_4_post_count_to_show');
        if(!empty($posts_count) && is_numeric($posts_count)){
            $posts_per_page = $posts_count;
        }
        $args = array(
            'posts_per_page'   => $posts_per_page,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'post',
            'post_status'      => 'publish',
        );
        $posts_array = get_posts( $args );
        
        if(!empty($show_blog_on_home) && $show_blog_on_home[0] == 'Yes' && !empty($posts_array)){
        ?>
        <div id="home_blog">
            <div class="container">
                <div class="home_blog_wrapper">
                <?php
                if(!empty($section_4_title)){
                    ?>
                <h1><?php echo $section_4_title; ?></h1>    
                    <?php
                }
                ?>
                <div class="posts_wrapper">
                <?php
                foreach ($posts_array as $key => $value) {
                    ?>
                    <div class="post_item">
                        <div class="post_item_inner">
                    <?php
                    $featured_img_url = get_the_post_thumbnail_url($value->ID, 'full'); 
                    if(!empty($featured_img_url)){
                        ?>
                        <div class="image_wrapper" style="background-image: url(<?php echo $featured_img_url; ?>)"><img src="<?php echo $featured_img_url; ?>" /></div>    
                        <?php
                    }
                    ?>
                        <div class="post_content">
                            <h4><?php echo $value->post_title; ?></h4>
                            <p><?php echo $value->post_excerpt; ?></p>
                            <div class="read_more">
                                <a href="<?php echo get_permalink($value->ID); ?>"><?php echo __('Read More','22Red');?></a>
                            </div>
                        </div>
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
    </div>
</main>
<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>
