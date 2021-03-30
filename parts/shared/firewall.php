<?php
$firewall_logo = get_field('firewall_logo', 'option');
$firewall_left_column_image = get_field('firewall_left_column_image', 'option');
$firewall_left_column_content = get_field('firewall_left_column_content', 'option');
$firewall_left_column_link_label = get_field('firewall_left_column_link_label', 'option');
$firewall_right_column_image = get_field('firewall_right_column_image', 'option');
$firewall_right_column_content = get_field('firewall_right_column_content', 'option');
$firewall_right_column_link = get_field('firewall_right_column_link', 'option');
$firewall_right_column_link_label = get_field('firewall_right_column_link_label', 'option');
if (!$_COOKIE['firewall_popup'] && (!empty($firewall_left_column_image) || !empty($firewall_left_column_content) || !empty($firewall_left_column_link_label) || !empty($firewall_right_column_image) || !empty($firewall_right_column_content) || !empty($firewall_right_column_link) || !empty($firewall_right_column_link_label))) {
    ?>
    <div class="firewall_wrapper">
<?php 
//echo "<pre style='background: #fff'>";
//var_dump($_COOKIE);
//echo "</pre>";
?>
        <div class="firewall_inner_wrapper">
            <?php
            if (!empty($firewall_logo)) {
                $firewall_logo_url = wp_get_attachment_image_src($firewall_logo, 'full');
                ?>
                <div class="firewall_logo"><img src="<?php echo $firewall_logo_url[0]; ?>" /></div>    
                <?php
            }
            ?>
            <div class="firewall_content_cols">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        if (!empty($firewall_left_column_image) || !empty($firewall_left_column_content) || !empty($firewall_left_column_link_label)) {
                            ?>
                            <div class="col-md-6 col-sm-12 left_col" >
                                <?php
                                if (!empty($firewall_left_column_image)) {
                                    $firewall_left_column_image_url = wp_get_attachment_image_src($firewall_left_column_image, 'full');
                                    ?>
                                    <div class="left_col_img col_img"><a href="#"><img src="<?php echo $firewall_left_column_image_url[0]; ?>" /></a></div>
                                    <?php
                                }
                                if (!empty($firewall_left_column_content)) {
                                    ?>
                                    <div class="left_col_content col_content"><?php echo $firewall_left_column_content; ?></div>
                                    <?php
                                }
                                if (!empty($firewall_left_column_link_label)) {
                                    ?>
                                    <div class="left_col_link col_link"><a href="#"><?php echo $firewall_left_column_link_label; ?></a></div>
                                    <?php
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if (!empty($firewall_right_column_image) || !empty($firewall_right_column_content) || !empty($firewall_right_column_link) || !empty($firewall_right_column_link_label)) {
                            ?>
                            <div class="col-md-6 col-sm-12 right_col" >
                                <?php
                                if (!empty($firewall_right_column_image)) {
                                    $firewall_right_column_image_url = wp_get_attachment_image_src($firewall_right_column_image, 'full');
                                    ?>
                                    <div class="right_col_img col_img">
                                        <?php
                                        if (!empty($firewall_right_column_link)) {
                                            ?>
                                            <a href="<?php echo $firewall_right_column_link; ?>">
                                                <?php
                                            }
                                            ?>
                                            <img src="<?php echo $firewall_right_column_image_url[0]; ?>" />
                                            <?php
                                            if (!empty($firewall_right_column_link)) {
                                                ?>
                                            </a>
                                            <?php
                                        }
                                        ?>
                                    </div>
                                    <?php
                                }
                                if (!empty($firewall_right_column_content)) {
                                    ?>
                                    <div class="right_col_content col_content"><?php echo $firewall_right_column_content; ?></div>
                                    <?php
                                }
                                if (!empty($firewall_right_column_link)) {
                                    ?>
                                    <div class="right_col_link col_link"><a href="<?php echo $firewall_right_column_link; ?>"><?php echo (!empty($firewall_right_column_link_label) ? $firewall_right_column_link_label : __('TAKE ME TO THE STORE', '22Red')); ?></a></div>
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
            <div class="firewall_popup"><?php echo __('*Certain states excluded', '22Red'); ?></div>
        </div>    
    </div>    
    <?php
}
?>