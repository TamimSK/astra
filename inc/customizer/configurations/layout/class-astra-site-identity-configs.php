<?php
/**
 * Bottom Footer Options for Astra Theme.
 *
 * @package     Astra
 * @author      Astra
 * @copyright   Copyright (c) 2020, Astra
 * @link        https://wpastra.com/
 * @since       Astra 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'Astra_Site_Identity_Configs' ) ) {

	/**
	 * Register Astra Customizerr Site identity Customizer Configurations.
	 */
	class Astra_Site_Identity_Configs extends Astra_Customizer_Config_Base {

		/**
		 * Register Astra Customizerr Site identity Customizer Configurations.
		 *
		 * @param Array                $configurations Astra Customizer Configurations.
		 * @param WP_Customize_Manager $wp_customize instance of WP_Customize_Manager.
		 * @since 1.4.3
		 * @return Array Astra Customizer Configurations with updated configurations.
		 */
		public function register_configuration( $configurations, $wp_customize ) {


			$_section = 'title_tagline';

			$_configs = array(

				/**
				 * Option: Header Builder Tabs
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[builder-header-site-identity-tabs]',
					'section'     => $_section,
					'type'        => 'control',
					'control'     => 'ast-builder-header-control',
					'priority'    => 0,
					'description' => '',
				),

				/**
				 * Notice for Colors - Transparent header enabled on page.
				 */
				array(
					'name'            => ASTRA_THEME_SETTINGS . '[header-transparent-header-logo-notice]',
					'type'            => 'control',
					'control'         => 'ast-description',
					'section'         => $_section,
					'priority'        => 1,
					'required'        => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
						),
					),
					'active_callback' => array( $this, 'is_transparent_header_enabled' ),
					'help'            => $this->get_help_text_notice( 'transparent-header' ),
				),

				/**
				* Option: Transparent Header Section - Link.
				*/
				array(
					'name'            => ASTRA_THEME_SETTINGS . '[header-transparent-header-logo-notice-link]',
					'default'         => astra_get_option( 'header-transparent-header-logo-notice-link' ),
					'type'            => 'control',
					'control'         => 'ast-customizer-link',
					'section'         => $_section,
					'priority'        => 1,
					'link_type'       => 'control',
					'linked'          => ASTRA_THEME_SETTINGS . '[transparent-header-logo]',
					'required'        => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[different-transparent-logo]', '==', true ),
						),
					),
					'link_text'       => '<u>' . __( 'Customize Transparent Header.', 'astra' ) . '</u>',
					'active_callback' => array( $this, 'is_transparent_header_enabled' ),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[divider-section-site-identity-logo]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Site Logo', 'astra' ),
					'priority' => 2,
					'settings' => array(),
				),

				/**
				 * Option: Different retina logo
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[different-retina-logo]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'section'   => $_section,
					'title'     => __( 'Different Logo For Retina Devices?', 'astra' ),
					'default'   => false,
					'priority'  => 5,
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.site-branding',
						'container_inclusive' => false,
						'render_callback'     => array( Astra_Builder_Header::get_instance(), 'site_identity' ),
					),
				),

				/**
				 * Option: Retina logo selector
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[ast-header-retina-logo]',
					'default'        => astra_get_option( 'ast-header-retina-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'section'        => 'title_tagline',
					'required'       => array( ASTRA_THEME_SETTINGS . '[different-retina-logo]', '!=', 0 ),
					'priority'       => 5,
					'title'          => __( 'Retina Logo', 'astra' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'transport'      => 'postMessage',
					'partial'        => array(
						'selector'            => '.site-branding',
						'container_inclusive' => false,
						'render_callback'     => array( Astra_Builder_Header::get_instance(), 'site_identity' ),
					),
				),

				/**
				 * Option: Inherit Desktop logo
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[different-mobile-logo]',
					'type'     => 'control',
					'control'  => 'checkbox',
					'default'  => false,
					'section'  => 'title_tagline',
					'title'    => __( 'Different Logo For Mobile Devices?', 'astra' ),
					'priority' => 5,
					'context'  => Astra_Constants::$mobile_device,
				),

				/**
				 * Option: Mobile header logo
				 */
				array(
					'name'           => ASTRA_THEME_SETTINGS . '[mobile-header-logo]',
					'default'        => astra_get_option( 'mobile-header-logo' ),
					'type'           => 'control',
					'control'        => 'image',
					'required'       => array( ASTRA_THEME_SETTINGS . '[different-mobile-logo]', '==', '1' ),
					'section'        => 'title_tagline',
					'priority'       => 5,
					'title'          => __( 'Mobile Logo (optional)', 'astra' ),
					'library_filter' => array( 'gif', 'jpg', 'jpeg', 'png', 'ico' ),
					'context'        => Astra_Constants::$mobile_device,
				),

				/**
				 * Option: Logo Width
				 */
				array(
					'name'        => ASTRA_THEME_SETTINGS . '[ast-header-responsive-logo-width]',
					'type'        => 'control',
					'control'     => 'ast-responsive-slider',
					'section'     => $_section,
					'transport'   => 'postMessage',
					'default'     => array(
						'desktop' => '',
						'tablet'  => '',
						'mobile'  => '',
					),
					'priority'    => 5,
					'title'       => __( 'Logo Width', 'astra' ),
					'input_attrs' => array(
						'min'  => 0,
						'step' => 1,
						'max'  => 600,
					),
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-site-logo-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Site Icon', 'astra' ),
					'section'  => $_section,
					'priority' => 15,
					'settings' => array(),
				),

				/**
				 * Option: Display Title
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[display-site-title]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'default'   => astra_get_option( 'display-site-title' ),
					'section'   => 'title_tagline',
					'title'     => __( 'Display Site Title', 'astra' ),
					'priority'  => 7,
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.site-branding',
						'container_inclusive' => true,
						'render_callback'     => array( Astra_Builder_Header::get_instance(), 'site_identity' ),
					),
				),

				/**
				 * Option: Display Tagline
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[display-site-tagline]',
					'type'      => 'control',
					'control'   => 'checkbox',
					'default'   => astra_get_option( 'display-site-tagline' ),
					'section'   => 'title_tagline',
					'priority'  => 10,
					'title'     => __( 'Display Site Tagline', 'astra' ),
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.site-branding',
						'container_inclusive' => false,
						'render_callback'     => array( Astra_Builder_Header::get_instance(), 'site_identity' ),
					),
				),

				/**
				 * Option: Logo inline title.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[logo-title-inline]',
					'default'   => astra_get_option( 'logo-title-inline' ),
					'type'      => 'control',
					'required'  => array(
						'conditions' => array(
							array( ASTRA_THEME_SETTINGS . '[display-site-title]', '==', true ),
							array( ASTRA_THEME_SETTINGS . '[display-site-tagline]', '==', true ),
						),
						'operator'   => 'OR',
					),
					'control'   => 'checkbox',
					'section'   => $_section,
					'title'     => __( 'Inline Logo & Site Title', 'astra' ),
					'priority'  => 7,
					'transport' => 'postMessage',
					'partial'   => array(
						'selector'            => '.site-branding',
						'container_inclusive' => false,
						'render_callback'     => array( Astra_Builder_Header::get_instance(), 'site_identity' ),
					),
				),

				/**
				 * Option: Divider
				*/
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-site-icon-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'title'    => __( 'Site Title', 'astra' ),
					'section'  => $_section,
					'priority' => 6,
					'settings' => array(),
				),

				/**
				 * Option: Header Site Title.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'default'   => astra_get_option( 'site-title-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Title', 'astra' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 16,
					'required'  => array(
						ASTRA_THEME_SETTINGS . '[display-site-title]',
						'==',
						true,
					),
					'context'   => Astra_Constants::$design_tab,
				),

				/**
				 * Option: Divider
				 */
				array(
					'name'     => ASTRA_THEME_SETTINGS . '[ast-site-title-divider]',
					'type'     => 'control',
					'control'  => 'ast-heading',
					'section'  => $_section,
					'title'    => __( 'Site Tagline', 'astra' ),
					'priority' => 9,
					'settings' => array(),
				),

				/**
				 * Option: Header Site Title.
				 */
				array(
					'name'      => ASTRA_THEME_SETTINGS . '[site-title-typography]',
					'default'   => astra_get_option( 'site-title-typography' ),
					'type'      => 'control',
					'control'   => 'ast-settings-group',
					'title'     => __( 'Title', 'astra' ),
					'section'   => $_section,
					'transport' => 'postMessage',
					'priority'  => 16,
					'required'  => array(
						ASTRA_THEME_SETTINGS . '[display-site-title]',
						'==',
						true,
					),
					'context'   => Astra_Constants::$design_tab,
				),
			);

			$configurations = array_merge( $configurations, $_configs );
			return $configurations;

		}

		/**
		 * Check if transparent header is enabled on the page being previewed.
		 *
		 * @since  2.4.5
		 * @return boolean True - If Transparent Header is enabled, False if not.
		 */
		public function is_transparent_header_enabled() {
			$status = Astra_Ext_Transparent_Header_Markup::is_transparent_header();
			return ( true === $status ? true : false );
		}

		/**
		 * Help notice message to be displayed when the page that is being previewed has Logo set from Transparent Header.
		 *
		 * @since  2.4.5
		 * @param String $context Type of notice message to be returned.
		 * @return String HTML Markup for the help notice.
		 */
		private function get_help_text_notice( $context ) {

			$notice = '';
			if ( 'transparent-header' === $context ) {
				$notice = '<div class="ast-customizer-notice wp-ui-highlight"><p>The Logo on this page is set from the Transparent Header Section. Please click the link below to customize Transparent Header Logo.</p></div>';
			}
			return $notice;
		}
	}
}


new Astra_Site_Identity_Configs();





