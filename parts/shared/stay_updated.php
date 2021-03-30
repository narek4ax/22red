<?php
$stay_updated_form_shortcode = get_field('stay_updated_form_shortcode','option');
if(!empty($stay_updated_form_shortcode)){
    $stay_updated_section_background_image = get_field('stay_updated_section_background_image','option');
    $background = '';
    if(!empty($stay_updated_section_background_image)){
        $img_url = wp_get_attachment_image_src($stay_updated_section_background_image,'full');
        $background = 'background-image: url('.$img_url[0].')';
    }
    ?>
<div id="stay_updated" style="<?php echo $background; ?>">
    <div class="container">
        <div class="stay_updated_wrapper">
            <?php echo do_shortcode($stay_updated_form_shortcode); ?>
        </div>
    </div>
</div>
    <?php
}
?>