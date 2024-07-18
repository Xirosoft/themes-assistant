<?php
namespace ATA\Admin\Views;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


class AtaAssetsManager {

    private static $instance = null;

    private function __construct() {
        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_assets' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_assets' ] );
    }

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private $assets = [
        'css' => [
            'bootstrap' => [
                'src' => ATA_ASSETS_URL . 'lib/owl-carousel/owl.carousel.min.css',
                'deps' => [],
                'ver' => '4.3.1',
                'media' => 'all'
            ],
            'owl-carousel' => [
                'src' => ATA_ASSETS_URL . 'lib/owl-carousel/owl.carousel.min.css',
                'deps' => [],
                'ver' => '2.3.4',
                'media' => 'all'
            ],
            'fancybox' => [
                'src' => ATA_ASSETS_URL . 'lib/fancybox/jquery.fancybox.min.css',
                'deps' => [],
                'ver' => '3.5.7',
                'media' => 'all'
            ],
            'twentytwenty' => [
                'src' => ATA_ASSETS_URL . 'lib/twentytwenty/twentytwenty.css',
                'deps' => [],
                'ver' => '1.0.0',
                'media' => 'all'
            ],
            
            // Add more CSS assets here...
        ],
        'js' => [
            'bootstrap' => [
                'src' => ATA_ASSETS_URL . 'lib/bootstrap/bootstrap.min.js',
                'deps' => ['jquery'],
                'ver' => '4.3.1',
                'in_footer' => true
            ],
            'owl-carousel' => [
                'src' => ATA_ASSETS_URL . 'lib/owl-carousel/owl.carousel.min.js',
                'deps' => ['jquery'],
                'ver' => '2.3.4',
                'in_footer' => true
            ],
            'owl-carousel-thumb' => [
                'src' => ATA_ASSETS_URL . 'lib/owl-carousel/owl.carousel2.thumbs.min.js',
                'deps' => ['jquery'],
                'ver' => '0.1.8',
                'in_footer' => true
            ],
            'countdown' => [
                'src' => ATA_ASSETS_URL . 'lib/countdown/jquery.countdown.min.js',
                'deps' => ['jquery'],
                'ver' => '2.2.0',
                'in_footer' => true
            ],
            'event-move' => [
                'src' => ATA_ASSETS_URL . 'lib/event-move/jquery.event.move.js',
                'deps' => ['jquery'],
                'ver' => '2.0.0',
                'in_footer' => true
            ],
            'fancybox' => [
                'src' => ATA_ASSETS_URL . 'lib/fancybox/jquery.fancybox.min.js',
                'deps' => ['jquery'],
                'ver' => '3.5.7',
                'in_footer' => true
            ],
            'first-visit-popup' => [
                'src' => ATA_ASSETS_URL . 'lib/first-visit-popup/first-visit-popup.js',
                'deps' => ['jquery'],
                'ver' => '1.0.0', 
                'in_footer' => true
            ],
            'isotope' => [
                'src' => ATA_ASSETS_URL . 'lib/isotope/isotope.pkgd.min.js',
                'deps' => ['jquery'],
                'ver' => '2.2.0',
                'in_footer' => true
            ],
            'lottie' => [
                'src' => ATA_ASSETS_URL . 'lib/lottie/lottie.min.js',
                'deps' => ['jquery'],
                'ver' => '1.0.0',
                'in_footer' => true
            ],
            'onscreeen' => [
                'src' => ATA_ASSETS_URL . 'lib/onscreeen/onscreeen.js',
                'deps' => ['jquery'],
                'ver' => '1.0.0',
                'in_footer' => true
            ],
            'tilt' => [
                'src' => ATA_ASSETS_URL . 'lib/tilt/tilt.jquery.js',
                'deps' => ['jquery'],
                'ver' => '1.0.0',
                'in_footer' => true
            ],
            'twentytwenty' => [
                'src' => ATA_ASSETS_URL . 'lib/twentytwenty/jquery.twentytwenty.js',
                'deps' => ['jquery'],
                'ver' => '1.0.0',
                'in_footer' => true
            ],
            // Add more JS assets here...
        ],
    ];

    public function ata_enqueue_asset( $handle, $type = null, $deps = [], $ver = false, $in_footer_or_media = 'all' ) {
        if ( 'css' === $type || is_null($type) ) {
            if ( isset( $this->assets['css'][ $handle ] ) && !wp_style_is( $handle, 'enqueued' ) ) {
                $args = $this->assets['css'][ $handle ];
                wp_enqueue_style(
                    $handle,
                    $args['src'],
                    !empty($deps) ? $deps : $args['deps'],
                    $ver ? $ver : $args['ver'],
                    $in_footer_or_media ? $in_footer_or_media : $args['media']
                );
            }
        }

        if ( 'js' === $type || is_null($type) ) {
            if ( isset( $this->assets['js'][ $handle ] ) && !wp_script_is( $handle, 'enqueued' ) ) {
                $args = $this->assets['js'][ $handle ];
                wp_enqueue_script(
                    $handle,
                    $args['src'],
                    !empty($deps) ? $deps : $args['deps'],
                    $ver ? $ver : $args['ver'],
                    $in_footer_or_media ? $in_footer_or_media : $args['in_footer']
                );
            }
        }
    }

    public function enqueue_assets() {
        // This function can be used to enqueue all registered assets if needed.
    }
}
