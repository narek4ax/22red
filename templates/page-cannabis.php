<?php
/**
 * Template Name: Cannabis
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
        $section_1_content = get_field('section_1_content');
        if (!empty($section_1_content)) {
            ?>
            <div id="leading_cannabis_revolution">
                <div class="container">
                    <div class="leading_cannabis_revolution_wrapper">
                        <?php
                        echo $section_1_content;
                        ?>
                    </div>
                </div>
            </div>    
            <?php
        }
        $select_cannabis_category_to_show = get_field('select_cannabis_category_to_show');
        $counter = 0;
        if (!empty($select_cannabis_category_to_show)) {
            ?>
            <div id="cannabis_category_to_show">
                <div class="container-fluid">
                    <?php
                    foreach ($select_cannabis_category_to_show as $key => $value) {
                        $term = get_term($value['category']);
//                echo "<pre>";
//                print_r($term);
//                echo "</pre>";
                        $image = get_field('image', $term);
                        $image_url = '';
                        if (!empty($image)) {
                            $image_atts = wp_get_attachment_image_src($image, 'full');
                            $image_url = $image_atts[0];
                        }
                        ?>
                        <div class="row">
                            <?php
                            $class = '';
                            if ($counter % 2 != 0) {
                                $class = 'hidden_till_mobile';
                            }
                            ?>
                            <div class="col <?php echo $class; ?>" style="<?php echo (trim($image_url) != '' ? 'background-image: url(' . $image_url . ')' : '') ?>">
                                <?php
                                if (trim($image_url) != '')
                                    
                                    ?>
                                <img src="<?php echo $image_url; ?>" />
                                <?php ?>
                            </div>
                            <?php
                            ?>
                            <div class="col">
                                <div class="content_wrapper">
                                    <div class="content_inner_wrapper">
                                        <?php
                                        $cannabi_category_title = $term->name;
                                        $cannabi_category_description = $term->description;
                                        $cannabi_type = '';
                                        $cannabi_category_id = $term->term_id;
                                        ?>
                                        <h2><?php echo $cannabi_category_title; ?></h2>
                                        <?php
                                        if (!empty($cannabi_category_description)) {
                                            ?>
                                            <div class="term_content">
                                                <h4><?php echo $cannabi_category_description; ?></h4>
                                            </div>    
                                            <?php
                                        }
                                        $args = array(
                                            'post_type' => 'cannabis',
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => 'cannabis_category',
                                                    'field' => 'term_id',
                                                    'terms' => $value['category']
                                                )
                                            )
                                        );
                                        $query = get_posts($args);
                                        if (!empty($query)) {
                                            ?>
                                            <div class="strains">
                                                <h5><?php echo __('STRAINS', '22Red'); ?></h5>
                                                <table>
                                                    <?php
                                                    foreach ($query as $key => $value) {
                                                        ?>
                                                        <tr class="strain_item">
                                                            <td >
                                                                <h5 class="cannabis_type">
                                                                    <a data-fancybox="post_<?php echo $value->ID; ?>_<?php echo $cannabi_category_id; ?>" data-src="#post_<?php echo $value->ID; ?>_<?php echo $cannabi_category_id; ?>" class="pop_up" href="javascript:;"><?php echo $pop_up_post_title = $value->post_title; ?></a>
                                                                </h5>
                                                            </td>
                                                            <td >
                                                                <?php
                                                                $cannabis_type = get_the_terms($value->ID, 'cannabis_type');
                                                                if (!empty($cannabis_type)) {
                                                                    ?>
                                                                    <p>
                                                                        <?php
                                                                        $cannabis_type_icon = get_field('cannabis_type_icon', $cannabis_type[0]);
                                                                        if (!empty($cannabis_type_icon)) {
                                                                            $image_atts = wp_get_attachment_image_src($cannabis_type_icon, 'full');
                                                                            ?>
                                                                        <span class="type_icon_wrapper"><img src="<?php echo $image_atts[0]; ?>" /></span>
                                                                            <?php
                                                                        }
                                                                        $cannabi_type = $cannabis_type[0]->name;
                                                                        ?>
                                                                        <span><?php echo $cannabi_type; ?></span>
                                                                    </p>

                                                                    <?php
                                                                }
                                                                ?>
                                                                <div id="post_<?php echo $value->ID; ?>_<?php echo $cannabi_category_id; ?>" class="pop_up_content_wrapper">
                                                                    <?php
                                                                    $cannabis_description = get_field('cannabis_description', $value->ID);
                                                                    $chemical_compound = get_field('chemical_compound', $value->ID);
                                                                    $effects = get_field('effects', $value->ID);
                                                                    $weight_info = get_field('weight_info', $value->ID);
                                                                    $chemical_compound = get_field('chemical_compound', $value->ID);
                                                                    ?>
                                                                    <div class="top_part">
                                                                        <div class="pop_up_container">
                                                                            <div class="top_part_inner">
                                                                                <h2><?php echo $pop_up_post_title; ?></h2>
                                                                                <?php
                                                                                if (!empty($weight_info)) {
                                                                                    ?>
                                                                                    <p><?php echo $weight_info; ?></p>                                                                        
                                                                                    <?php
                                                                                }

                                                                                if (trim($cannabi_type) != '') {
                                                                                    ?>
                                                                                    <h5><?php echo $cannabi_type; ?></h5>
                                                                                    <?php
                                                                                }
                                                                                if (!empty($chemical_compound)) {
                                                                                    ?>
                                                                                    <table class="chemical_compound">
                                                                                        <?php
                                                                                        if (!empty($chemical_compound['thc'])) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <div class="thc item">
                                                                                                        <span class="persentage"><?php echo $chemical_compound['thc']; ?>%</span>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="thc item">
                                                                                                        <span class="chemical_compound_ext"><?php echo __('THC', '22Red'); ?></span>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                        <?php
                                                                                        if (!empty($chemical_compound['cbd'])) {
                                                                                            ?>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <div class="cbd item">
                                                                                                        <span class="persentage"><?php echo $chemical_compound['cbd']; ?>%</span>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="cbd item">
                                                                                                        <span class="chemical_compound_ext"><?php echo __('CBD', '22Red'); ?></span>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </table>    
                                                                                    <?php
                                                                                }
                                                                                if (trim($cannabis_description) != '') {
                                                                                    ?>
                                                                                    <div class="pop_up_description">
                                                                                        <h4><?php echo $cannabis_description; ?></h4>
                                                                                    </div>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <div class="short_note"><?php echo __('*Amounts are average, inividual items may vary.', '22Red'); ?></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    if (!empty($effects)) {
                                                                        ?>
                                                                        <div class="effects_wrapper">
                                                                            <div class="pop_up_container">
                                                                                <div class="effects_wrapper_inner">
                                                                                    <h5><?php echo __('Effects', '22Red'); ?></h5>
                                                                                    <?php
                                                                                    $effect_item_index = 0;
                                                                                    foreach ($effects as $key => $value1) {
                                                                                        if (!empty($value1['effect_name']) && !empty($value1['effect_percentage'])) {
                                                                                            $gradient_top_color = '#07d6f3';
                                                                                            $gradient_bottom_color = '#0095f8';

                                                                                            $gradient_top_color_field = $value1['gradient_top_color'];
                                                                                            $gradient_bottom_color_field = $value1['gradient_bottom_color'];

                                                                                            if (!empty($gradient_top_color_field)) {
                                                                                                $gradient_top_color = $gradient_top_color_field;
                                                                                            }
                                                                                            if (!empty($gradient_bottom_color_field)) {
                                                                                                $gradient_bottom_color = $gradient_bottom_color_field;
                                                                                            }
                                                                                            ?>
                                                                                            <style>
                                                                                                .effect_item_<?php echo $effect_item_index; ?>{
                                                                                                    width: <?php echo $value1['effect_percentage']; ?>%;
                                                                                                    background: -moz-linear-gradient(top, <?php echo $gradient_top_color; ?> 0%, <?php echo $gradient_bottom_color; ?> 100%);
                                                                                                    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,<?php echo $gradient_top_color; ?>), color-stop(100%,<?php echo $gradient_bottom_color; ?>));
                                                                                                    background: -webkit-linear-gradient(top, <?php echo $gradient_top_color; ?> 0%,<?php echo $gradient_bottom_color; ?> 100%);
                                                                                                    background: -o-linear-gradient(top, <?php echo $gradient_top_color; ?> 0%,<?php echo $gradient_bottom_color; ?> 100%);
                                                                                                    background: -ms-linear-gradient(top, <?php echo $gradient_top_color; ?> 0%,<?php echo $gradient_bottom_color; ?> 100%);
                                                                                                    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='<?php echo $gradient_top_color; ?>', endColorstr='<?php echo $gradient_bottom_color; ?>',GradientType=0 );
                                                                                                    background: linear-gradient(top, <?php echo $gradient_top_color; ?> 0%,<?php echo $gradient_bottom_color; ?> 100%);
                                                                                                }
                                                                                            </style>
                                                                                            <div class="effect_item effect_item_<?php echo $effect_item_index; ?>">
                                                                                                <h4><?php echo $value1['effect_name']; ?></h4>
                                                                                            </div>    
                                                                                            <?php
                                                                                        }
                                                                                        $effect_item_index++;
                                                                                    }
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>    
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </td>    
                                                        </tr>
                                                        <?php
                                                    }
                                                    ?>
                                                </table>
                                            </div>    
                                            <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                            $class = '';
                            if ($counter % 2 != 0) {
                                $class = 'visible_till_mobile';
                                ?>
                                <div class="col <?php echo $class; ?>" style="<?php echo (trim($image_url) != '' ? 'background-image: url(' . $image_url . ')' : '') ?>">
                                    <?php
                                    if (trim($image_url) != '')
                                        
                                        ?>
                                    <img src="<?php echo $image_url; ?>" />
                                    <?php ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                        $counter++;
                    }
                    ?>
                </div>    
            </div>  
            <?php
        }
        $section_3_content = get_field('section_3_content');
        if (!empty($section_3_content)) {
            ?>
            <div id="cannabis_category_global_info">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if ($counter % 2 != 0) {
                            ?>
                            <div class="col text-left text">
                                <div class="content_wrapper">
                                    <div class="content_inner_wrapper">
                                        <?php echo $section_3_content; ?>
                                    </div>
                                </div>
                            </div>    
                            <?php
                        }
                        ?>
                        <?php
                        $image = get_field('section_3_image');
                        $image_url = '';
                        if (!empty($image)) {
                            $image_atts = wp_get_attachment_image_src($image, 'full');
                            $image_url = $image_atts[0];
                        }
                        ?>
                        <div class="col img" style="<?php echo (trim($image_url) != '' ? 'background-image: url(' . $image_url . ')' : '') ?>">
                            <?php
                            if (trim($image_url) != '')
                                
                                ?>
                            <img src="<?php echo $image_url; ?>" />
                            <?php ?>
                        </div>
                        <?php
                        if ($counter % 2 == 0) {
                            ?>
                            <div class="col text-right text">
                                <div class="content_wrapper">
                                    <div class="content_inner_wrapper">
                                        <?php echo $section_3_content; ?>
                                    </div>
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
        ?>
    </div>
</main>
<?php BsWp::get_template_parts(array('parts/shared/footer', 'parts/shared/html-footer')); ?>
