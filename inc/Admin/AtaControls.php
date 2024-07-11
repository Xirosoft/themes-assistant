<?php

namespace ATA\Admin;

use ATA\Admin\Views\Panel\AtaGeneral;
use ATA\Admin\Views\Panel\AtaElements;
use ATA\Admin\Views\Panel\AtaExtensions;
use ATA\Admin\Views\Panel\AtaTools;
use ATA\Admin\Views\Panel\AtaIntegrations;
use ATA\Admin\Views\Panel\AtaPremium;


class AtaControls {

    private $ata_general;
    private $ata_elements;
    private $ata_extensions;
    private $ata_tools;
    private $ata_integrations;
    private $ata_premium;

    public function __construct() {
        $this->ata_general      = new AtaGeneral();
        $this->ata_elements     = new AtaElements();
        $this->ata_extensions   = new AtaExtensions();
        $this->ata_tools        = new AtaTools();
        $this->ata_integrations = new AtaIntegrations();
        $this->ata_premium      = new AtaPremium();
        add_action('admin_menu', array($this, 'add_admin_menu'));
    }

    public function add_admin_menu(){
        add_menu_page(
            __( 'Themes Assistant', 'themes-assistant' ),
            __( 'Themes Assistant', 'themes-assistant' ),
            'manage_options',
            'themes-assistant',
            array($this->ata_general, 'ata_general_page'),
            'dashicons-admin-generic'
        );
        add_submenu_page(
            'themes-assistant',
            __( 'General', 'themes-assistant' ),
            __( 'General', 'themes-assistant' ),
            'manage_options',
            'themes-assistant',
            array($this->ata_general, 'ata_general_page'),
        );

        add_submenu_page(
            'themes-assistant',
            __( 'Elements', 'themes-assistant' ),
            __( 'Elements', 'themes-assistant' ),
            'manage_options',
            'ata-elements',
            array($this->ata_elements, 'ata_elements_page'),
        );

        add_submenu_page(
            'themes-assistant',
            __( 'Extensions', 'themes-assistant' ),
            __( 'Extensions', 'themes-assistant' ),
            'manage_options',
            'ata-extensions',
            array( $this->ata_extensions, 'ata_extensions_page' )
        );

        add_submenu_page(
            'themes-assistant',
            __( 'Tools', 'themes-assistant' ),
            __( 'Tools', 'themes-assistant' ),
            'manage_options',
            'ata-tools',
            array( $this->ata_tools, 'ata_tools_page' )
        );

        add_submenu_page(
            'themes-assistant',
            __( 'Integrations', 'themes-assistant' ),
            __( 'Integrations', 'themes-assistant' ),
            'manage_options',
            'ata-integrations',
            array( $this->ata_integrations, 'ata_integrations_page' )
        );

        add_submenu_page(
            'themes-assistant',
            __( 'Go Premium', 'themes-assistant' ),
            __( 'Go Premium', 'themes-assistant' ),
            'manage_options',
            'ata-go-premium',
            array( $this->ata_premium, 'ata_premium_page' )
        );
    }
}
