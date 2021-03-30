<!DOCTYPE html>
<!--



                        .++.                          .++.                       
                     .+1010+`                      .+1010+.                     
                   .+10101010/`                  .+10101010+.                   
                 .+101010101010/`              ./101010101010+.                 
               .+1010101010101010/`          `/1010101010101010+.               
             .+101010100o1010101010/`      `/10101010101010101010+.             
           .+1010101010:``/1010101010/`  `/1010101010/``:1010101010/.           
         ./1010101010:`    `/1010101010//1010101010/`    `/1010101010/.         
       ./1010101010:`        `/101010101010101010/`        `/1010101010/.       
     ./1010101010/`            ./10101010101010/.            `/1010101010/`     
    -o101010100o.                -101010101010-                .1010101010o.    
     .+101010100o-             `:o101010101010o:             `:o101010100+.     
       .+1010100/.           `:o10101010101010+.           `:o101010100+.       
         .+100/.           `:o101010100++100+.           `:o101010100+.         
           -/.           `:o101010100+.  ./.           `-o101010100+.           
                       `:o101010100+.                `-o101010100+-             
                     `:o101010100+.                `-o101010100+-               
                   `-o101010100+.                 -o101010100+-                 
                 `-o101010100+-                 -+101010100o-                   
               `-o101010100+-                 -+101010100o-                     
              -o101010100o-                 .+101010100o-                       
            -o101010100o-                 .+101010100o-                         
          -o101010100o-                 .+101010100o:                           
        -o1010101010:`````````````````.+1010101010:`````````````````````        
      .+1010101010101010101010101010101010101010101010101010101010101010+.      
    .+10101010101010101010101010101010101010101010101010101010101010101010+.    
  .+101010101010101010101010101010101010101010101010101010101010101010101010+.  
.+1010101010101010101010101010101010101010101010101010101010101010101010101010+.



site by dirango.com





-->
<html lang="en">
  <head>   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>
      <?php
        /*
        * Yoast SEO plugin returns duplicate name titles.
        * This adjustment will check if Yoast is active 
        * then return the title function only. Else display
        * default title functions.
        * */
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        if(is_plugin_active('wordpress-seo/wp-seo.php')):
          wp_title('|', true, 'right');
        else:
          wp_title( '|', true, 'right' ); ?><?php bloginfo( 'name' ); 
        endif;
      ?>
    </title>
		<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
		<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/images/favicon.ico"/>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick.css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/slick-theme.css"/>
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500i,600,700,800,900" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/fancybox.css" />
                
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/photoswipe.css"/>
    <link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/default-skin/default-skin.css"/>
  </head>
<body <?php body_class(); ?>>

