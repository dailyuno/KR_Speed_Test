<?php
/**
 * Plugin Name: Animate Social Button
 */
add_action('wp_enqueue_scripts', function(){
    wp_enqueue_style('fontawesome', plugins_url('fontawesome/css/all.css', __FILE__));
});

add_shortcode('animate_social_button', function(){
    ?>
    <style>
        .social-button-group {
            display: flex;
        }

        .social-button {
            width: 100px;
            height: 100px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
            border-radius: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            margin-right: 20px;
            cursor: pointer;
        }

        .social-button:before,
        .social-button:after {
            content: "";
            width: 140%;
            height: 140%;
            position: absolute;
            -webkit-transition: transform 0.6s ease-in-out;
            -moz-transition: transform 0.6s ease-in-out;
            -ms-transition: transform 0.6s ease-in-out;
            -o-transition: transform 0.6s ease-in-out;
            transition: transform 0.6s ease-in-out;
        }

        .social-button:before {
            -webkit-transform: translate(-80%, 80%) rotate(45deg);
            -moz-transform: translate(-80%, 80%) rotate(45deg);
            -ms-transform: translate(-80%, 80%) rotate(45deg);
            -o-transform: translate(-80%, 80%) rotate(45deg);
            transform: translate(-80%, 80%) rotate(45deg);
            -webkit-transition-delay: 0.6s;
            -moz-transition-delay: 0.6s;
            -ms-transition-delay: 0.6s;
            -o-transition-delay: 0.6s;
            transition-delay: 0.6s;
        }

        .social-button:after {
            top: 50%;
            left: 50%;
            -webkit-transform: translate(-50%, -50%);
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -o-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            -webkit-border-radius: 50%;
            -moz-border-radius: 50%;
            border-radius: 50%;
            background-color: #fff;
        }

        .social-button span {
            position: relative;
            z-index: 10;
        }

        .social-button i {
            font-size: 24px;
            -webkit-transition: all 0.6s ease-in-out;
            -moz-transition: all 0.6s ease-in-out;
            -ms-transition: all 0.6s ease-in-out;
            -o-transition: all 0.6s ease-in-out;
            transition: all 0.6s ease-in-out;
        }

        .social-button.facebook i {
            color: #3d5998;
        }

        .social-button.pinterest i {
            color: #e50122;
        }

        .social-button.twitter i {
            color: #54acec;
        }

        .social-button.tumblr:before {
            background-color: #314258;
        }

        .social-button.facebook:before {
            background-color: #3d5998;
        }
        .social-button.pinterest:before {
            background-color: #e50122;
        }
        .social-button.twitter:before {
            background-color: #54acec;
        }
        .social-button.tumblr:before {
            background-color: #314258;
        }

        .social-button:hover i {
            font-size: 30px;
            color: #fff;
        }

        .social-button:hover:before {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            -webkit-transition-delay: 0s;
            -moz-transition-delay: 0s;
            -ms-transition-delay: 0s;
            -o-transition-delay: 0s;
            transition-delay: 0s;
        }

        .social-button:hover:after {
            -webkit-transform: translate(-50%, -50%) scale(0);
            -moz-transform: translate(-50%, -50%) scale(0);
            -ms-transform: translate(-50%, -50%) scale(0);
            -o-transform: translate(-50%, -50%) scale(0);
            transform: translate(-50%, -50%) scale(0);
            -webkit-transition: transform 0s;
            -moz-transition: transform 0s;
            -ms-transition: transform 0s;
            -o-transition: transform 0s;
            transition: transform 0s;
        }
    </style>

    <div class="social-button-group">
        <div class="social-button facebook">
            <span><i class="fab fa-facebook-f"></i></span>
        </div>
        <div class="social-button pinterest">
            <span><i class="fab fa-pinterest"></i></span>
        </div>
        <div class="social-button twitter">
            <span><i class="fab fa-twitter"></i></span>
        </div>
        <div class="social-button tumblr">
            <span><i class="fab fa-tumblr"></i></span>
        </div>
    </div>
    <?php
});