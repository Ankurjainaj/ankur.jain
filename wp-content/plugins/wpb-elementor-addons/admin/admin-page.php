<?php

// don't call the file directly
if ( !defined( 'ABSPATH' ) ) exit;

add_action( 'admin_menu', 'wpb_ea_admin_menu' );

function wpb_ea_admin_menu() {
	add_menu_page( esc_html__( 'About WPB Elementor Addons', 'wpb-elementor-addons' ), esc_html__( 'WPB EA Addons', 'wpb-elementor-addons' ), apply_filters( 'wpb_ea_admin_user_role', 'manage_options' ), 'wpb-ea-about', 'wpb_ea_admin_about_page', 'dashicons-lightbulb', 90  );
}

function wpb_ea_admin_about_page(){
	
	?>
	<div class="wrap wpb-ea-wrap about-wrap">
		<h1>WPB Elementor Addons <?php echo esc_html(WPB_EA_Version); ?></h1>
		<p class="about-text">Customize everything easily with WPB Elementor addons pack.</p><br>
		<div class="wp-badge">Version <?php echo esc_html(WPB_EA_Version); ?></div>

		<hr>
		
		<h3>Description</h3>

		<p><a target="_blank" href="https://wordpress.org/plugins/elementor/" rel="nofollow">Elementor</a> is the number one page builder for WordPress currently available now in the market. It has a super easy user interface, anyone can design complex web pages without knowing any code.</p>
		<p>WPB Elementor Addons can take your site to the next level by adding a number of premium quality addons with a huge number of customization options. It’s one of the Best Elementor Addons pack. All the addons are a premium quality modern design.</p>
		<p>You can build any professional websites with this addon pack. We have elements for any type of business, corporate or personal websites. The team, services, pricing table addon allow you to integrate it for any type of business websites.</p>
		<p>This addons pack works with any standard free or premium WordPress themes. No matter you are using a free theme, our Best Elementor Addons will always make you feel like a premium theme.</p>
		<div class="wpb-ea-btns">
		<a class="wpb-ea-btn" target="_blank" href="https://demo.elementorkit.com/" rel="nofollow">DEMO</a><a class="wpb-ea-btn" target="_blank" href="https://wpbean.freshdesk.com/" rel="nofollow">Support</a><a class="wpb-ea-btn" target="_blank" href="http://docs.wpbean.com/docs/wpb-ea-elementor-addons/" rel="nofollow">Documentation</a>
		</div >

		<hr>

		<h3>Available Addons</h3>
		<ul class="wpb-ea-about-list">
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/post-grid-or-slider/" title="Post Grid and Slider" rel="nofollow">Post Grid/Slider</a></strong> that displays any post types posts in a nice grid or slider.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/pricing-table/" title="Pricing Table" rel="nofollow">Pricing Table</a></strong> to increases your sales.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/testimonial/" title="Testimonials Grid and Slider" rel="nofollow">Testimonials Grid/Slider</a></strong> can show your clients feedbacks.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/team-members/" title="Team Members Grid and Slider" rel="nofollow">Team Members Grid/Slider</a></strong> for showing all of your team members.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/service-box/" title="Service Box" rel="nofollow">Service Box</a></strong> for showing your offer for your customers.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/fancy-list/" title="Fancy List" rel="nofollow">Fancy List</a></strong> can show your list items in a beautiful way.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/content-box/" title="Content Box Grid and Slider" rel="nofollow">Content Box Grid/Slider</a></strong> can present any static content with an image.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/logo-slider/" title="Logo Slider" rel="nofollow">Logo Slider</a></strong> can showcase your sponsors/featured logos in a slider.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/counterup/" title="Counter Up" rel="nofollow">Counter Up</a></strong> can show your statics in a nice counter.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="//demo6.wpbean.com/video-popup/" title="Video Popup" rel="nofollow">Video Popup</a></strong> that displays a video in a popup, can be used for video call to action.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/filterable-gallery/" title="Filterable Image Gallery" rel="nofollow">Filterable Image Gallery</a></strong> to showcase your images with filtering options.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/content-timeline/" title="Content Timeline" rel="nofollow">Content Timeline</a></strong> to show any type of content in a timeline. Support for image, iframe, ShortCode, icon, date etc.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/slider/" title="Hero Slider" rel="nofollow">Hero Slider</a></strong> can show a slideshow of images, contents and buttons.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/news-ticker/" title="News Ticker" rel="nofollow">News Ticker</a></strong> This news ticker can scroll/slide content in a different style.</li>
			<li><i class="dashicons dashicons-yes"></i><strong><a target="_blank" href="https://demo.elementorkit.com/videos-grid/" title="Videos Grid" rel="nofollow">Videos Grid</a></strong> Videos Grid with title, content, and details link and self-hosted/ YouTube Videos.</li>
		</ul>

		<hr>

		<h3>Completely Customizable:</h3>
		<p>All the addons color and typography is changeable from the option. Any unnecessary addon can be disabled from the settings. All the addons are 100% mobile responsive and 100% multilanguage supported.</p>

		<hr>

		<h3>Support and Documentation:</h3>
		<p>Using these addons is super easy as we have details <a target="_blank" href="http://docs.wpbean.com/docs/wpb-ea-elementor-addons/" rel="nofollow">online documentation</a> for this.  If you are having any issue with these addons our expert support team members are always ready for you. Just open a support ticket on our <a target="_blank" href="https://wpbean.freshdesk.com/" rel="nofollow">support forum</a>.</p>
	</div>
	<?php
}