<?php

/**
 * @package Dolly_OOP
 * @version 1.0
 */

/**
 * Plugin Name: Hello Dolly OOP
 * Plugin URI: https://github.com/ridwanishaq/hello-dolly-oop
 * Description: This is not just a plugin, it symbolizes the hope and enthusiasm of an entire generation summed up in two words sung most famously by Louis Armstrong: Dolly OOP. When activated you will randomly see a lyric from <cite>Hello, Dolly</cite> in the upper right of your admin screen on every page.
 * Version: 1.0
 * Requires at least: 5.4
 * Requires PHP: 7.2
 * Author: Rilwanu Isyaku
 * Author URI: https://github.com/ridwanishaq
 * License: GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: hello-dolly-oop
 * Update URI: https://github.com/ridwanishaq/hello-dolly-oop
 */

class DollyOOP {

    public function __construct() {

        // Now we set that function up to execute when the admin_notices action is called.
        add_action( 'admin_notices', array($this, 'hello_dolly') );

        add_action( 'admin_head', array($this, 'dolly_css') );

    }

    public function hello_dolly_get_lyric() {
        /** These are the lyrics to Hello Dolly */
        $lyrics = "Hello, Dolly
            Well, hello, Dolly
            It's so nice to have you back where you belong
            You're lookin' swell, Dolly
            I can tell, Dolly
            You're still glowin', you're still crowin'
            You're still goin' strong
            I feel the room swayin'
            While the band's playin'
            One of our old favorite songs from way back when
            So, take her wrap, fellas
            Dolly, never go away again
            Hello, Dolly
            Well, hello, Dolly
            It's so nice to have you back where you belong
            You're lookin' swell, Dolly
            I can tell, Dolly
            You're still glowin', you're still crowin'
            You're still goin' strong
            I feel the room swayin'
            While the band's playin'
            One of our old favorite songs from way back when
            So, golly, gee, fellas
            Have a little faith in me, fellas
            Dolly, never go away
            Promise, you'll never go away
            Dolly'll never go away again";
    
        // Here we split it into lines.
        $lyrics = explode( "\n", $lyrics );
    
        // And then randomly choose a line.
        return wptexturize( $lyrics[ mt_rand( 0, count( $lyrics ) - 1 ) ] );
    }

    // This just echoes the chosen line, we'll position it later.
    public function hello_dolly() {
        $chosen = $this->hello_dolly_get_lyric();
        $lang   = '';
        if ( 'en_' !== substr( get_user_locale(), 0, 3 ) ) {
            $lang = ' lang="en"';
        }

        printf(
            '<p id="dolly"><span class="screen-reader-text">%s </span><span dir="ltr"%s>%s</span></p>',
            __( 'Quote from Hello Dolly song, by Jerry Herman:', 'hello-dolly' ),
            $lang,
            $chosen
        );
    }
    
    // We need some CSS to position the paragraph.
    public function dolly_css() {
        echo "
        <style type='text/css'>
        #dolly {
            float: right;
            padding: 5px 10px;
            margin: 0;
            font-size: 12px;
            line-height: 1.6666;
        }
        .rtl #dolly {
            float: left;
        }
        .block-editor-page #dolly {
            display: none;
        }
        @media screen and (max-width: 782px) {
            #dolly,
            .rtl #dolly {
                float: none;
                padding-left: 0;
                padding-right: 0;
            }
        }
        </style>
        ";
    }

}

$dollyOOP = new DollyOOP();
