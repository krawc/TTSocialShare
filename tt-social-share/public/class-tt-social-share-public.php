<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       konradkrawczyk.com
 * @since      1.0.0
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Tt_Social_Share
 * @subpackage Tt_Social_Share/public
 * @author     Konrad Krawczyk <konrad.krawczyk@nyu.edu>
 */
class Tt_Social_Share_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->ttsocialshare_options = get_option($this->plugin_name);


	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tt_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tt_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/tt-social-share-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'ionicons', 'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Tt_Social_Share_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Tt_Social_Share_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/tt-social-share-public.js', array( 'jquery' ), $this->version, false );

	}

	public function add_button_styling(){

		$colorCode = $this->ttsocialshare_options['colorCode'];

		$css = '<style>';
		//set the button color optionally
		if ( !empty($colorCode) ){
			$css .= '.tt-btn{
					background: '.$colorCode.'!important;
				}';
		}

		$css .= '</style>';

		echo $css;

	}

	public function register_shortcodes() {
		add_shortcode( 'ttsocialshare', array( $this, 'display_share_buttons' ) );
		add_filter( 'widget_text', 'do_shortcode');
	}

	public function display_share_buttons() {

		$displayFb = $this->ttsocialshare_options['displayFb'];
		$displayTw = $this->ttsocialshare_options['displayTw'];
		$displayGp = $this->ttsocialshare_options['displayGp'];
		$displayPi = $this->ttsocialshare_options['displayPi'];
		$displayLi = $this->ttsocialshare_options['displayLi'];
		$displayWa = $this->ttsocialshare_options['displayWa'];
		$hideTitle = $this->ttsocialshare_options['hideTitle'];

		$btnSize = $this->ttsocialshare_options['btnSize'];
		$floating = '';

		$permalink = get_permalink();

		$output = '<div class="tt-buttons '. $btnSize .'">';

		if (!$hideTitle){
			$output .= __('<h5>SHARE:</h5><a></a>', $this->plugin_name);
		}

		$buttons = array(
		    'tt-btn_1' => array('link' => '<span class="tt-btn btnFb"><a href="https://www.facebook.com/sharer/sharer.php?u='.$permalink.'" target="_blank" ><i class="ion ion-social-facebook"></i></a></span>', 'display' => $displayFb),
		    'tt-btn_2' => array('link' => '<span class="tt-btn btnTw"><a href="https://twitter.com/home?status='.$permalink.'" target="_blank" ><i class="ion ion-social-twitter"></i></a></span>', 'display' => $displayTw),
		    'tt-btn_3' => array('link' => '<span class="tt-btn btnGp"><a href="https://plus.google.com/share?url='.$permalink.'" target="_blank" ><i class="ion ion-social-googleplus"></i></a></span>', 'display' => $displayGp),
				'tt-btn_4' => array('link' => '<span class="tt-btn btnPi"><a href="https://pinterest.com/pin/create/button/?url=&media=&description='.$permalink.'" target="_blank" ><i class="ion ion-social-pinterest"></i></a></span>', 'display' => $displayPi),
		    'tt-btn_5' => array('link' => '<span class="tt-btn btnLi"><a href="https://www.linkedin.com/shareArticle?mini=true&url='.$permalink.'&title=&summary=&source=" target="_blank" ><i class="ion ion-social-linkedin"></i></a></span>', 'display' => $displayLi),
		    'tt-btn_6' => array('link' => '<span class="tt-btn btnWa"><a href="whatsapp://send?text='.$permalink.'" data-action="share/whatsapp/share" target="_blank" ><i class="ion ion-social-whatsapp"></i></a></span>', 'display' => $displayWa)
		);

		$order = explode(',', $this->ttsocialshare_options['btnOrder']);

		foreach ($order as $key){
			if ($buttons[$key]['display']){
				$output .= $buttons[$key]['link'];
			}
		}

		$output .= '</div>';
		return $output;

	}

	public function display_under_title($content) {
		$buttons = $this->display_share_buttons();
		$custom_content = $buttons;
    $custom_content .= $content;
    return $custom_content;
	}

	public function display_under_thumb($content) {
		$buttons = $this->display_share_buttons();
		$custom_content = $content;
		$custom_content .= '<div class="tt-thumb-container">';
    $custom_content .= $buttons;
		$custom_content .= '</div>';
    return $custom_content;
	}

	public function display_left() {
		$buttons = $this->display_share_buttons();
		$custom_content .= '<div class="tt-floating-container">';
		$custom_content .= $buttons;
		$custom_content .= '</div>';
		echo $custom_content;
	}

	public function display_end($content) {
		$buttons = $this->display_share_buttons();
		$custom_content = $content;
		$custom_content .= $buttons;
		return $custom_content;
	}

	public function display_settings(){

			$display = true;
			$loop = $this->ttsocialshare_options['loop'];

			if ($loop == 0){
				if ( !is_singular() ){
					$display = false;
				}
			}

			$type = get_post_type();
			$setting = $this->ttsocialshare_options['displayOn'][$type];

			if ($setting){

			if ( $display && $this->ttsocialshare_options['displayUnderPost'] ){
				add_filter('the_content', array($this, 'display_under_title'), 1);
			}

			if ( $display && $this->ttsocialshare_options['displayUnderThumb'] ){
				add_filter('post_thumbnail_html', array($this, 'display_under_thumb'), 100);
			}

			if ( $this->ttsocialshare_options['displayLeft'] ){
				add_action('wp_footer', array($this, 'display_left'));
			}

			if ( $display && $this->ttsocialshare_options['displayEnd'] ){
				add_filter('the_content', array($this, 'display_end'), 3);
			}

			}
		}

	}
