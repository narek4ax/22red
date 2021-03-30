<?php
/**
 * Template Name: Contact
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 4.0.0
 * @author 
 */
global $post;
?>
<?php BsWp::get_template_parts(array('parts/shared/html-header', 'parts/shared/header')); ?>
<?php
BsWp::get_template_parts(array('parts/shared/inside_banner'));
?>
<main role="main" class="js">   
    <div class="content">
        <div id="contact_content">
            <div class="container-fluid">
                <div class="row">
                    <?php
                    $image_link = '';
                    $left_side_image = get_field('left_side_image');
                    if (!empty($left_side_image)) {
                        $image_attributes = wp_get_attachment_image_src($left_side_image, 'full');
                        $image_link = $image_attributes[0];
                    }
                    ?>
                    <div class="col" style="<?php echo (trim($image_link) != '' ? 'background-image: url(' . $image_link . ');' : '') ?>">
                        <div class="leftcol">
                            <h1>
                                <?php the_title(); ?>
                            </h1>
                            <p>
                                <?php echo get_field('left_paragraph'); ?>
                        </div>    
                        <?php
                        if (trim($image_link) != '') {
                            ?>
                            <img src="<?php echo $image_link; ?>" />
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col rightcol">
                        <div class="content_wrapper">
                        <?php if (have_posts()) while (have_posts()) : the_post(); ?>
                                <?php the_content(); ?>
                                <?php comments_template('', true); ?>

                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>
