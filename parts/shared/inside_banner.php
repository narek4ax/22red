<?php
$inside_pages_banner_background = get_field('inside_pages_banner_background');
if(!empty($inside_pages_banner_background)){
    $image_attributes = wp_get_attachment_image_src($inside_pages_banner_background,'full');
    $inside_pages_banner_title = get_field('inside_pages_banner_title');
    $banner_title = (is_page() ? $post->post_title : '');
    $inside_pages_banner_content = get_field('inside_pages_banner_content');
    if(!empty($inside_pages_banner_title)){
        $banner_title = $inside_pages_banner_title;
    }
    
    ?>
<div id="inside_banner" style="background-image: url(<?php echo $image_attributes[0]; ?>);">
    <!--<div class="inside_banner_parallax" style="background-image: url(<?php // echo $image_attributes[0]; ?>);">-->
        <div class="container">
            <h1><?php echo $banner_title; ?></h1>
            <?php 
            if(!empty($inside_pages_banner_content)){
                ?>
            <div class="content">
                <h4><?php echo $inside_pages_banner_content; ?></h4>
            </div>    
                <?php
            }
            ?>
        </div>
    <!--</div>-->    
</div>    
    <?php
}
?>