<?php
/*
	Plugin Name: Motivo Mortgages
	Plugin URI: http://www.motivomedia.co.uk/
	Description: Silence is golden
	Author: Ashley Simpson Stock
	Version: 1.2
	Author URI: http://www.motivomedia.co.uk/
*/


add_action('init', 'wpcodex_add_excerpt_support_for_pages');
function wpcodex_add_excerpt_support_for_pages() {
  add_post_type_support('staff', 'excerpt');
  add_post_type_support('staff', 'editor');
  remove_post_type_support('staff', 'thumbnail');
  // add_post_type_support('staff', 'content');
}


add_action('init', 'motivo_mortgage_init');
function motivo_mortgage_init() {
	$labels = array(
		'name'               => _x('Applications', 'post type general name', 'motivo-mortgage' ),
		'singular_name'      => _x('Application', 'post type singular name', 'motivo-mortgage' ),
		'menu_name'          => _x('Applications', 'admin menu', 'motivo-mortgage' ),
		'name_admin_bar'     => _x('Applications', 'add new on admin bar', 'motivo-mortgage' ),
		'add_new'            => _x('Add New', 'book', 'motivo-mortgage' ),
		'add_new_item'       => __('Add New Application', 'motivo-mortgage' ),
		'new_item'           => __('New Application', 'motivo-mortgage' ),
		'edit_item'          => __('Edit Application', 'motivo-mortgage' ),
		'view_item'          => __('View Application', 'motivo-mortgage' ),
		'all_items'          => __('All Applications', 'motivo-mortgage' ),
		'search_items'       => __('Search Applications', 'motivo-mortgage' ),
		'parent_item_colon'  => __('Parent Applications:', 'motivo-mortgage' ),
		'not_found'          => __('No Applications found.', 'motivo-mortgage' ),
		'not_found_in_trash' => __('No Applications found in Trash.', 'motivo-mortgage' )
	);

	$args = array(
		'labels'             => $labels,
    'description'        => __( 'Description.', 'motivo-mortgage' ),
		'public'             => false,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'applicatons'),
		'capability_type'    => 'post',
		'capabilities' => array(
      // 'edit_post'          => 'edit_posts',
      // 'read_posts'         => 'read_posts',
      // 'delete_posts'       => 'delete_posts',
      // 'edit_posts'         => 'edit_posts',
      // 'edit_others_posts'  => 'edit_others_posts',
      // 'publish_posts'      => 'publish_posts',
      // 'read_private_posts' => 'read_private_posts',
      // 'create_posts'       => 'do_not_allow',			// 'delete_posts' => 'allow', // false < WP 4.5, credit @Ewout
		),
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'supports'           => array('title', 'editor')
	);

	register_post_type( 'applications', $args );
}

add_action( 'init', 'create_application_taxonomies', 0);
function create_application_taxonomies() {
	$labels = array(
		'name'              => _x( 'Associations', 'taxonomy general name', 'motivo-mortgage' ),
		'singular_name'     => _x( 'Association', 'taxonomy singular name', 'motivo-mortgage' ),
		'search_items'      => __( 'Search Associations', 'motivo-mortgage' ),
		'all_items'         => __( 'All Associations', 'motivo-mortgage' ),
		'parent_item'       => __( 'Parent Association', 'motivo-mortgage' ),
		'parent_item_colon' => __( 'Parent Association:', 'motivo-mortgage' ),
		'edit_item'         => __( 'Edit Association', 'motivo-mortgage' ),
		'update_item'       => __( 'Update Association', 'motivo-mortgage' ),
		'add_new_item'      => __( 'Add New Association', 'motivo-mortgage' ),
		'new_item_name'     => __( 'New Association Name', 'motivo-mortgage' ),
		'menu_name'         => __( 'Associations', 'motivo-mortgage' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'associations'),
	);

	register_taxonomy('associations', array( 'applications' ), $args);
}

class PageTemplater {

	private static $instance;
	protected $templates;

	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		}
		return self::$instance;
	}
	private function __construct() {
		$this->templates = array();

		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);
		} else {
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);
		}

		add_filter('wp_insert_post_data', array( $this, 'register_project_templates'));
		add_filter('template_include', array( $this, 'view_project_template'));

		$this->templates = array(
			'mortgage-form.php' => 'Motvo Morgage - Apply Now Form',
		);
	}

	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}
	public function register_project_templates( $atts ) {

		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		$templates = wp_get_theme()->get_page_templates();
		if (empty( $templates)) {$templates = array();}

		wp_cache_delete( $cache_key , 'themes');
		$templates = array_merge( $templates, $this->templates );
		wp_cache_add($cache_key, $templates, 'themes', 1800 );

		return $atts;
	}
	public function view_project_template( $template ) {
		global $post;
		if (!$post) {return $template;}
		if (!isset($this->templates[get_post_meta($post->ID, '_wp_page_template', true)])) {return $template;}

		$file = plugin_dir_path( __FILE__ ). get_post_meta( $post->ID, '_wp_page_template', true);

		if (file_exists($file)){return $file;} else {echo $file;}
		// Return template
		return $template;
	}
}
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

function wpdocs_theme_name_scripts_one() {
    wp_enqueue_style('motivo-mortgages-styles', plugin_dir_url( __FILE__ ) . 'assets/css/motivo-mortgages.css');
}
function wpdocs_theme_name_scripts_two() {
    wp_enqueue_script('motivo-mortgages-script', plugin_dir_url( __FILE__ ) . 'assets/js/motivo-mortgages-3.js', array(), date('U'), false);
}
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts_one');
add_action('wp_enqueue_scripts', 'wpdocs_theme_name_scripts_two');


add_action('admin_init','motivoApplication_init');

function motivoApplication_init(){
    add_meta_box('motivoApplication', 'Application Data', 'motivoApplication', 'applications', 'normal');
    add_action('save_post','motivoApplication_save');
}
function motivoApplication(){
    global $post;
    $data = get_post_meta($post->ID);
    $post->post_content = json_decode($post->post_content);
    echo '<pre style="display:none">';
    var_dump($data);
    echo '</pre>';
    echo '
      <style>
        // div#wp-content-wrap {display: none;}
        div#motivoApplication div.item {float: left;width: 50%;padding: 10px 10px;box-sizing: border-box;}
        div#motivoApplication pre {display: none;}
        div#motivoApplication lable {display: block;}
        div#motivoApplication input {width: 100%;}
        div#motivoApplication:after, div#motivoApplication .step:after {clear: both;display: block;content: "";}
        div#motivoApplication .inside {width: 100%;box-sizing: border-box;}
        div#motivoApplication .step{margin:0px -10px;}
        div#motivoApplication h1 {display:block;text-align:center;}
        div#motivoApplication textarea {display: block;margin: 0px 10px 0px 10px;width: 98%;box-sizing: border-box;padding:10px;}
        div#motivoApplication .applicant {margin:0px 0px 40px 0px;}
        .application-errors {padding: 15px 30px 30px 30px;background: rgba(255, 0, 0, 0.3);margin: 10px 0px 30px 0px;border: 1px solid rgba(255, 0, 0, 0.3);border-radius: 4px;}
        .application-errors h1 {margin: 0px 0px 20px 0px;}
        input#publish {background: #0c9;border-color: #0c9;text-shadow: 0px 2px 2px #00936f;box-shadow: 0px 1px 0px #00936f;}
        #associationsdiv, #minor-publishing-actions, #misc-publishing-actions {display: none !important;}
      </style>
      <script>
        jQuery(document).ready(function(){
          jQuery(\'input[type="submit"]\').attr(\'value\', \'Send to Base\');
          jQuery(\'#submitdiv .hndle span\').html(\'BaseCRM\');
        });
        jQuery(document).ready(function(){
          jQuery(\'form\').on("submit", function(){
            var formData = jQuery(this).serialize();
            jQuery.post("'. plugin_dir_url( __FILE__ ) . 'assets/ajax/baseCRM-2.php?id='. $post->ID .'&action=send_to_base", formData, function(){
              alert("Item sent to base");
            });
            console.log(formData)
          });
        });
      </script>
    ';
    if(isset($data['Error'][0])){
      $data['Error'][0] = json_decode($data['Error'][0]);
      if(!empty($data['Error'][0])){
        echo '<div class="application-errors">';
        echo '  <h1>Errors!!</h1>';
        $count = 0;
        foreach ($data['Error'][0] as $error) {
          $count++;
          echo $count . ') ' . $error . '<br/>';
        }
        echo '</div>';
      }
    }
    echo '<div class="applicant">';
    echo '  <h1>Applicant One Details</h1>';
    echo '  <h3>Basic Details</h3>';
    echo '  <div class="step">';
    echo '    <div class="item">';
    echo '      <lable for="Preferred Method of Contact">Preferred Method of Contact</lable>';
    echo '      <input type="text" name="Preferred Method of Contact" value="'. $data['Preferred Method of Contact'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Date of Birth">Date of Birth</lable>';
    echo '      <input type="text" name="Date of Birth" value="'. $data['Date of Birth'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Nationality">Nationality</lable>';
    echo '      <input type="text" name="Nationality" value="'. $data['Nationality'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Indefinite Leave to Remain?">Indefinite Leave to Remain?</lable>';
    echo '      <input type="text" name="Indefinite Leave to Remain?" value="'. $data['Indefinite Leave to Remain?'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Marital Status">Marital Status</lable>';
    echo '      <input type="text" name="Marital Status" value="'. $data['Marital Status'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Gender">Gender</lable>';
    echo '      <input type="text" name="Gender" value="'. $data['Gender'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Gender">Smoker</lable>';
    echo '      <input type="text" name="Smoker" value="'. $data['Smoker'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Status at Current Address">Status at Current Address</lable>';
    echo '      <input type="text" name="Status at Current Address" value="'. $data['Status at Current Address'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Date Moved to Current Address">Date Moved to Current Address</lable>';
    echo '      <input type="text" name="Date Moved to Current Address" value="'. $data['Date Moved to Current Address'][0] .' "/>';
    echo '    </div>';
    echo '  </div>';
    echo '  <h3>Employment Details</h3>';
    echo '  <div class="step">';
    echo '    <div class="item">';
    echo '      <lable for="Self Employed">Self Employed</lable>';
    echo '      <input type="text" name="Self Employed" value="'. $data['Self Employed'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Occupation">Occupation</lable>';
    echo '      <input type="text" name="Occupation" value="'. $data['Occupation'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Date Started at Current Employment">Date Started at Current Employment</lable>';
    echo '      <input type="text" name="Date Started at Current Employment" value="'. $data['Date Started at Current Employment'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Basic Salary (OR Most Recent Year\'s Net Profit)">Basic Salary (OR Most Recent Year\'s Net Profit)</lable>';
    echo '      <input type="text" name="Basic Salary (OR Most Recent Year\'s Net Profit)" value="'. $data['Basic Salary (OR Most Recent Year\'s Net Profit)'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Net Profit Year 2 ">Net Profit Year 2 </lable>';
    echo '      <input type="text" name="Net Profit Year 2 " value="'. $data['Net Profit Year 2 '][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Overtime">Overtime</lable>';
    echo '      <input type="text" name="Overtime" value="'. $data['Overtime'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Benefits">Benefits</lable>';
    echo '      <input type="text" name="Benefits" value="'. $data['Benefits'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Other Income ">Other Income </lable>';
    echo '      <input type="text" name="Other Income " value="'. $data['Other Income'][0] .' "/>';
    echo '    </div>';
    echo '  </div>';
    echo '  <h3>Expence Details</h3>';
    echo '  <div class="step">';
    echo '    <div class="item">';
    echo '      <lable for="# of Dependants"># of Dependants</lable>';
    echo '      <input type="text" name="# of Dependants" value="'. $data['# of Dependants'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Adverse Credit">Adverse Credit</lable>';
    echo '      <input type="text" name="Adverse Credit" value="'. $data['Adverse Credit'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Total Monthly Loan/HP Repayments">Total Monthly Loan/HP Repayments</lable>';
    echo '      <input type="text" name="Total Monthly Loan/HP Repayments" value="'. $data['Total Monthly Loan/HP Repayments'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Total Outstanding Credit Card Balances">Total Outstanding Credit Card Balances</lable>';
    echo '      <input type="text" name="Total Outstanding Credit Card Balances" value="'. $data['Total Outstanding Credit Card Balances'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Student Loan Payments">Student Loan Payments</lable>';
    echo '      <input type="text" name="Student Loan Payments" value="'. $data['Student Loan Payments'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Pension Contributions ">Pension Contributions </lable>';
    echo '      <input type="text" name="Pension Contributions " value="'. $data['Pension Contributions '][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Child Care Costs">Child Care Costs</lable>';
    echo '      <input type="text" name="Child Care Costs" value="'. $data['Child Care Costs'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Maintenance">Maintenance</lable>';
    echo '      <input type="text" name="Maintenance" value="'. $data['Maintenance'][0] .' "/>';
    echo '    </div>';
    echo '  </div>';
    echo '</div>';
    if($data['Application Type'][0] == 'joint'){
      echo '<div class="applicant">';
      echo '  <h1>Applicant Two Details</h1>';
      echo '  <h3>Basic Details</h3>';
      echo '  <div class="step">';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Title">Title</lable>';
      echo '      <input type="text" name="Applicant 2 - Title" value="'. $data['Applicant 2 - Title'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Full Name">Full Name</lable>';
      echo '      <input type="text" name="Applicant 2 - Full Name" value="'. $data['Applicant 2 - Full Name'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Other Known Names">Other Known Names</lable>';
      echo '      <input type="text" name="Applicant 2 - Other Known Names" value="'. $data['Applicant 2 - Other Known Names'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - DOB">DOB</lable>';
      echo '      <input type="text" name="Applicant 2 - DOB" value="'. $data['Applicant 2 - DOB'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Nationality">Nationality</lable>';
      echo '      <input type="text" name="Applicant 2 - Nationality" value="'. $data['Applicant 2 - Nationality'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Indefinite Leave to Remain? ">Indefinite Leave to Remain? </lable>';
      echo '      <input type="text" name="Applicant 2 - Indefinite Leave to Remain? " value="'. $data['Applicant 2 - Indefinite Leave to Remain? '][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Marital Status">Marital Status</lable>';
      echo '      <input type="text" name="Applicant 2 - Marital Status" value="'. $data['Applicant 2 - Marital Status'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Gender">Gender</lable>';
      echo '      <input type="text" name="Applicant 2 - Gender" value="'. $data['Applicant 2 - Gender'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Smoker">Smoker</lable>';
      echo '      <input type="text" name="Applicant 2 - Smoker" value="'. $data['Applicant 2 - Smoker'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Mobile Number">Mobile Number</lable>';
      echo '      <input type="text" name="Applicant 2 - Mobile Number" value="'. $data['Applicant 2 - Mobile Number'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Work Number">Work Number</lable>';
      echo '      <input type="text" name="Applicant 2 - Work Number" value="'. $data['Applicant 2 - Work Number'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Email Address">Email Address</lable>';
      echo '      <input type="text" name="Applicant 2 - Email Address" value="'. $data['Applicant 2 - Email Address'][0] .' "/>';
      echo '    </div>';
      echo '  </div>';
      echo '  <h3>Living Details</h3>';
      echo '  <div class="step">';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Address">Address</lable>';
      echo '      <input type="text" name="Applicant 2 - Address" value="'. $data['Applicant 2 - Address'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Town">Town</lable>';
      echo '      <input type="text" name="Applicant 2 - Town" value="'. $data['Applicant 2 - Town'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - City">City</lable>';
      echo '      <input type="text" name="Applicant 2 - City" value="'. $data['Applicant 2 - City'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Postal Code">Postal Code</lable>';
      echo '      <input type="text" name="Applicant 2 - Postal Code" value="'. $data['Applicant 2 - Postal Code'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Country">Country</lable>';
      echo '      <input type="text" name="Applicant 2 - Country" value="'. $data['Applicant 2 - Country'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Status at Current Address">Status at Current Address</lable>';
      echo '      <input type="text" name="Applicant 2 - Status at Current Address" value="'. $data['Applicant 2 - Status at Current Address'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Date Moved to Current Address">Date Moved to Current Address</lable>';
      echo '      <input type="text" name="Applicant 2 - Date Moved to Current Address" value="'. $data['Applicant 2 - Date Moved to Current Address'][0] .' "/>';
      echo '    </div>';
      echo '  </div>';
      echo '  <h3>Employment Details</h3>';
      echo '  <div class="step">';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Self Employed">Self Employed</lable>';
      echo '      <input type="text" name="Applicant 2 - Self Employed" value="'. $data['Applicant 2 - Self Employed'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Occupation">Occupation</lable>';
      echo '      <input type="text" name="Applicant 2 - Occupation" value="'. $data['Applicant 2 - Occupation'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Date Started at Current Employment">Date Started at Current Employment</lable>';
      echo '      <input type="text" name="Applicant 2 - Date Started at Current Employment" value="'. $data['Applicant 2 - Date Started at Current Employment'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)">Basic Salary (OR Most Recent Year\'s Net Profit)</lable>';
      echo '      <input type="text" name="Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)" value="'. $data['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Net Profit Year 2">Net Profit Year 2</lable>';
      echo '      <input type="text" name="Applicant 2 - Net Profit Year 2" value="'. $data['Applicant 2 - Net Profit Year 2'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Net Profit Year 2">Net Profit Year 2</lable>';
      echo '      <input type="text" name="Applicant 2 - Net Profit Year 2" value="'. $data['Applicant 2 - Net Profit Year 2'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Other Income">Other Income</lable>';
      echo '      <input type="text" name="Applicant 2 - Other Income" value="'. $data['Applicant 2 - Other Income'][0] .' "/>';
      echo '    </div>';
      echo '  </div>';
      echo '  <h3>Expence Details</h3>';
      echo '  <div class="step">';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Adverse Credit">Adverse Credit</lable>';
      echo '      <input type="text" name="Applicant 2 - Adverse Credit" value="'. $data['Applicant 2 - Adverse Credit'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Benefits">Benefits</lable>';
      echo '      <input type="text" name="Applicant 2 - Benefits" value="'. $data['Applicant 2 - Benefits'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - # of Dependants (leave blank if the same as applicant 1)"># of Dependants (leave blank if the same as applicant 1)</lable>';
      echo '      <input type="text" name="Applicant 2 - # of Dependants (leave blank if the same as applicant 1)" value="'. $data['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Total Monthly Loan/HP Repayments">Total Monthly Loan/HP Repayments</lable>';
      echo '      <input type="text" name="Applicant 2 - Total Monthly Loan/HP Repayments" value="'. $data['Applicant 2 - Total Monthly Loan/HP Repayments'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Total Outstanding Credit Card Balances">Total Outstanding Credit Card Balances</lable>';
      echo '      <input type="text" name="Applicant 2 - Total Outstanding Credit Card Balances" value="'. $data['Applicant 2 - Total Outstanding Credit Card Balances'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Student Loan Payments">Student Loan Payments</lable>';
      echo '      <input type="text" name="Applicant 2 - Student Loan Payments" value="'. $data['Applicant 2 - Student Loan Payments'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Pension Contribution">Pension Contribution</lable>';
      echo '      <input type="text" name="Applicant 2 - Pension Contribution" value="'. $data['Applicant 2 - Pension Contribution'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)">Child Care Costs (leave blank if the same as applicant 1)</lable>';
      echo '      <input type="text" name="Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)" value="'. $data['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'][0] .' "/>';
      echo '    </div>';
      echo '    <div class="item">';
      echo '      <lable for="Applicant 2 - Maintenance">Maintenance</lable>';
      echo '      <input type="text" name="Applicant 2 - Maintenance" value="'. $data['Applicant 2 - Maintenance'][0] .' "/>';
      echo '    </div>';
      echo '  </div>';
      echo '</div>';
    }
    echo '  <h1>Housing Details</h1>';
    echo '  <div class="step">';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Type ">Purchase Type</lable>';
    echo '      <input type="text" name="Purchase Type " value="'. $data['Purchase Type '][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Housing Association/Agent">Housing Association/Agent</lable>';
    echo '      <input type="text" name="Housing Association/Agent" value="'. $data['Housing Association/Agent'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Name of Site/Development">Name of Site/Development</lable>';
    echo '      <input type="text" name="Name of Site/Development" value="'. $data['Name of Site/Development'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Full Purchase Price">Full Purchase Price</lable>';
    echo '      <input type="text" name="Full Purchase Price" value="'. $data['Full Purchase Price'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="% Purchase Share">% Purchase Share</lable>';
    echo '      <input type="text" name="% Purchase Share" value="'. $data['% Purchase Share'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Share Price">Share Price</lable>';
    echo '      <input type="text" name="Share Price" value="'. $data['Share Price'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Loan Amount">Loan Amount</lable>';
    echo '      <input type="text" name="Loan Amount" value="'. $data['Loan Amount'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Shared Ownership Rent ">Shared Ownership Rent </lable>';
    echo '      <input type="text" name="Shared Ownership Rent " value="'. $data['Shared Ownership Rent '][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Service Charge">Service Charge</lable>';
    echo '      <input type="text" name="Service Charge" value="'. $data['Service Charge'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Deposit Amount">Deposit Amount</lable>';
    echo '      <input type="text" name="Deposit Amount" value="'. $data['Deposit Amount'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Property Address">Purchase Property Address</lable>';
    echo '      <input type="text" name="Purchase Property Address" value="'. $data['Purchase Property Address'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Property Town">Purchase Property Town</lable>';
    echo '      <input type="text" name="Purchase Property Town" value="'. $data['Purchase Property Town'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Property City">Purchase Property City</lable>';
    echo '      <input type="text" name="Purchase Property City" value="'. $data['Purchase Property City'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Property Postal Code">Purchase Property Postal Code</lable>';
    echo '      <input type="text" name="Purchase Property Postal Code" value="'. $data['Purchase Property Postal Code'][0] .' "/>';
    echo '    </div>';
    echo '    <div class="item">';
    echo '      <lable for="Purchase Property Country">Purchase Property Country</lable>';
    echo '      <input type="text" name="Purchase Property Country" value="'. $data['Purchase Property Country'][0] .' "/>';
    echo '    </div>';
    echo '  </div>';
    echo '  <h3>Other Info</h3>';
    echo '  <div class="step">';
    echo '    <textarea name="Any Other Information">'. $data['Any Other Information'][0] .'</textarea>';
    echo '  </div>';
}
function motivoApplication_save($post_id){
    // $item = get_post($post_id);
    // $item->post_content = json_decode($item->post_content);
    // $clientPost = array(
    //   "name"        => $item->post_content->title . ' ' . $item->post_content->forname . ' ' . $item->post_content->surname,
    //   "title"       => $item->post_content->title,
    //   "first_name"  => $item->post_content->forname,
    //   "last_name"   => $item->post_content->surname,
    //   "description" => "",
    //   "email"       => $item->post_content->email_address,
    //   "mobile"      => $item->post_content->mobile_number,
    //   "address"     =>  array(
    //     "line1"       => $item->post_content->house_and_street,
    //     "city"        => $item->post_content->city,
    //     "postal_code" => $item->post_content->postcode,
    //     "state"       => $item->post_content->county,
    //     "country"     => ''
    //   ),
    //   'custom_fields' => '',
    // );
    // foreach ($_POST as $key => $value) {
    //   update_post_meta($post_id, $key, $value);
    // }
    //
    // require 'assets/api/vendor/autoload.php';
    // $accessToken = '07628ce2f159982af41e49eb66e01eb083a47ce8fd175c2bb919f3211a416175';
    // $client = new \BaseCRM\Client(['accessToken' => $accessToken]);
    //
    // $clientPost['custom_fields']['Post Code App 1'] = $item->post_content->postcode;
    // $clientPost['custom_fields']['Application Type'] = $item->post_content->application_type;
    // $clientPost['custom_fields']['Preferred Method of Contact'] = $_POST['Preferred_Method_of_Contact'];
    // $clientPost['custom_fields']['Date of Birth'] = $_POST['Date_of_Birth'];
    // $clientPost['custom_fields']['Nationality'] = $_POST['Nationality'];
    // $clientPost['custom_fields']['Indefinite Leave to Remain? '] = $_POST['Indefinite_Leave_to_Remain?'];
    // $clientPost['custom_fields']['Marital Status'] = $_POST['Marital_Status'];
    // $clientPost['custom_fields']['Gender'] = $_POST['Gender'];
    // $clientPost['custom_fields']['Smoker'] = $_POST['Smoker'];
    // $clientPost['custom_fields']['Status at Current Address'] = $_POST['Status_at_Current_Address'];
    // $clientPost['custom_fields']['Date Moved to Current Address'] = $_POST['Date_Moved_to_Current_Address'];
    // $clientPost['custom_fields']['Self Employed'] = $_POST['Self_Employed'];
    // $clientPost['custom_fields']['Occupation'] = $_POST['Occupation'];
    // $clientPost['custom_fields']['Date Started at Current Employment'] = $_POST['Date_Started_at_Current_Employment'];
    // $clientPost['custom_fields']['Basic Salary (OR Most Recent Year\'s Net Profit)'] = $_POST['Basic_Salary_(OR_Most_Recent_Year\'s_Net_Profit)'];
    // $clientPost['custom_fields']['Net Profit Year 2 '] = $_POST['Net_Profit_Year_2_'];
    // $clientPost['custom_fields']['Overtime'] = $_POST['Overtime'];
    // $clientPost['custom_fields']['Benefits'] = $_POST['Benefits'];
    // $clientPost['custom_fields']['Other Income '] = $_POST['Other_Income_'];
    // $clientPost['custom_fields']['# of Dependants'] = $_POST['#_of_Dependants'];
    // $clientPost['custom_fields']['Adverse Credit'] = $_POST['Adverse_Credit'];
    // $clientPost['custom_fields']['Total Monthly Loan/HP Repayments'] = $_POST['Total_Monthly_Loan/HP_Repayments'];
    // $clientPost['custom_fields']['Total Outstanding Credit Card Balances'] = $_POST['Total_Outstanding_Credit_Card_Balances'];
    // $clientPost['custom_fields']['Student Loan Payments'] = $_POST['Student_Loan_Payments'];
    // $clientPost['custom_fields']['Pension Contributions '] = $_POST['Pension_Contributions_'];
    // $clientPost['custom_fields']['Child Care Costs'] = $_POST['Child_Care_Costs'];
    // $clientPost['custom_fields']['Maintenance'] = $_POST['Maintenance'];
    // if($item->post_content->application_type == 'joint'){
    //   $clientPost['custom_fields']['Applicant 2 - Title'] = $_POST['Applicant_2_-_Title'];
    //   $clientPost['custom_fields']['Applicant 2 - Full Name'] = $_POST['Applicant_2_-_Full_Name'];
    //   $clientPost['custom_fields']['Applicant 2 - Other Known Names'] = $_POST['Applicant_2_-_Other_Known_Names'];
    //   $clientPost['custom_fields']['Applicant 2 - DOB'] = $_POST['Applicant_2_-_DOB'];
    //   $clientPost['custom_fields']['Applicant 2 - Nationality'] = $_POST['Applicant_2_-_Nationality'];
    //   $clientPost['custom_fields']['Applicant 2 - Indefinite Leave to Remain? '] = $_POST['Applicant_2_-_Indefinite_Leave_to_Remain?_'];
    //   $clientPost['custom_fields']['Applicant 2 - Marital Status'] = $_POST['Applicant_2_-_Marital_Status'];
    //   $clientPost['custom_fields']['Applicant 2 - Gender'] = $_POST['Applicant_2_-_Gender'];
    //   $clientPost['custom_fields']['Applicant 2 - Smoker'] = $_POST['Applicant_2_-_Smoker'];
    //   $clientPost['custom_fields']['Applicant 2 - Address'] = $_POST['Applicant_2_-_Address'];
    //   $clientPost['custom_fields']['Applicant 2 - Town'] = $_POST['Applicant_2_-_Town'];
    //   $clientPost['custom_fields']['Applicant 2 - City'] = $_POST['Applicant_2_-_City'];
    //   $clientPost['custom_fields']['Applicant 2 - Postal Code'] = $_POST['Applicant_2_-_Postal_Code'];
    //   $clientPost['custom_fields']['Applicant 2 - Country'] = $_POST['Applicant_2_-_Country'];
    //   $clientPost['custom_fields']['Applicant 2 - Status at Current Address'] = $_POST['Applicant_2_-_Status_at_Current_Address'];
    //   $clientPost['custom_fields']['Applicant 2 - Date Moved to Current Address'] = $_POST['Applicant_2_-_Date_Moved_to_Current_Address'];
    //   $clientPost['custom_fields']['Applicant 2 - Mobile Number'] = $_POST['Applicant_2_-_Mobile_Number'];
    //   $clientPost['custom_fields']['Applicant 2 - Work Number'] = $_POST['Applicant_2_-_Work_Number'];
    //   $clientPost['custom_fields']['Applicant 2 - Email Address'] = $_POST['Applicant_2_-_Email_Address'];
    //   $clientPost['custom_fields']['Applicant 2 - Self Employed'] = $_POST['Applicant_2_-_Self_Employed'];
    //   $clientPost['custom_fields']['Applicant 2 - Occupation'] = $_POST['Applicant_2_-_Occupation'];
    //   $clientPost['custom_fields']['Applicant 2 - Date Started at Current Employment'] = $_POST['Applicant_2_-_Date_Started_at_Current_Employment'];
    //   $clientPost['custom_fields']['Applicant 2 - Basic Salary (OR Most Recent Year\'s Net Profit)'] = $_POST['Applicant_2_-_Basic_Salary_(OR_Most_Recent_Year\'s_Net_Profit)'];
    //   $clientPost['custom_fields']['Applicant 2 - Benefits'] = $_POST['Applicant_2_-_Benefits'];
    //   $clientPost['custom_fields']['Applicant 2 - Other Income'] = $_POST['Applicant_2_-_Other_Income'];
    //   $clientPost['custom_fields']['Applicant 2 - Adverse Credit'] = $_POST['Applicant_2_-_Adverse_Credit'];
    //   $clientPost['custom_fields']['Applicant 2 - # of Dependants (leave blank if the same as applicant 1)'] = $_POST['Applicant_2_-_#_of_Dependants_(leave_blank_if_the_same_as_applicant_1)'];
    //   $clientPost['custom_fields']['Applicant 2 - Total Monthly Loan/HP Repayments'] = $_POST['Applicant_2_-_Total_Monthly_Loan/HP_Repayments'];
    //   $clientPost['custom_fields']['Applicant 2 - Total Outstanding Credit Card Balances'] = $_POST['Applicant_2_-_Total_Outstanding_Credit_Card_Balances'];
    //   $clientPost['custom_fields']['Applicant 2 - Student Loan Payments'] = $_POST['Applicant_2_-_Student_Loan_Payments'];
    //   $clientPost['custom_fields']['Applicant 2 - Pension Contribution'] = $_POST['Applicant_2_-_Pension_Contribution'];
    //   $clientPost['custom_fields']['Applicant 2 - Child Care Costs (leave blank if the same as applicant 1)'] = $_POST['Applicant_2_-_Child_Care_Costs_(leave_blank_if_the_same_as_applicant_1)'];
    //   $clientPost['custom_fields']['Applicant 2 - Maintenance'] = $_POST['Applicant_2_-_Maintenance'];
    //   $clientPost['custom_fields']['Applicant 2 - Net Profit Year 2'] = $_POST['Applicant_2_-_Net_Profit_Year_2'];
    //   $clientPost['custom_fields']['Email Address App 2'] = $_POST['Applicant_2_-_Email_Address'];
    // }
    // $clientPost['custom_fields']['Housing Association/Agent'] = $_POST['Housing_Association/Agent'];
    // $clientPost['custom_fields']['Name of Site/Development'] = $_POST['Name_of_Site/Development'];
    // $clientPost['custom_fields']['Full Purchase Price'] = $_POST['Full_Purchase_Price'];
    // $clientPost['custom_fields']['% Purchase Share'] = $_POST['%_Purchase_Share'];
    // $clientPost['custom_fields']['Share Price'] = $_POST['Share_Price'];
    // $clientPost['custom_fields']['Loan Amount'] = $_POST['Loan_Amount'];
    // $clientPost['custom_fields']['Shared Ownership Rent '] = $_POST['Shared_Ownership_Rent_'];
    // $clientPost['custom_fields']['Service Charge'] = $_POST['Service_Charge'];
    // $clientPost['custom_fields']['Deposit Amount'] = $_POST['Deposit_Amount'];
    // $clientPost['custom_fields']['Purchase Property Address'] = $_POST['Purchase_Property_Address'];
    // $clientPost['custom_fields']['Purchase Property Town'] = $_POST['Purchase_Property_Town'];
    // $clientPost['custom_fields']['Purchase Property City'] = $_POST['Purchase_Property_City'];
    // $clientPost['custom_fields']['Purchase Property Postal Code'] = $_POST['Purchase_Property_Postal_Code'];
    // $clientPost['custom_fields']['Purchase Type '] = $_POST['Purchase_Type_'];
    // $clientPost['custom_fields']['Purchase Property Country'] = $_POST['Purchase_Property_Country'];
    // $clientPost['custom_fields']['Any Other Information'] = $_POST['Any_Other_Information'];
    // $clientPost['custom_fields']['Email Address App 1'] = $item->post_content->email_address;
    //
    // $client->leads->create($clientPost);
}
function motivoApplication_clean(&$arr){
    if (is_array($arr)){
        foreach ($arr as $i => $v){
            if (is_array($arr[$i])){
                CallToAction_clean($arr[$i]);
                if (!count($arr[$i])){
                    unset($arr[$i]);
                }
            }else{
                if (trim($arr[$i]) == ''){
                    unset($arr[$i]);
                }
            }
        }
        if (!count($arr)){
            $arr = NULL;
        }
    }
}
add_filter( 'manage_edit-applications_columns', 'motivo_mortgage_columns' ) ;

function motivo_mortgage_columns($columns) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __('Full Name'),
		'email' => __('Email Address'),
		'phone' => __('Phone Number'),
		'has_error' => __('Errors'),
		'date' => __('Date')
	);

	return $columns;
}
add_action( 'manage_applications_posts_custom_column', 'manage_application_columns', 10, 2 );

function manage_application_columns($column, $post_id) {
	global $post;
  $errors = get_post_meta($post->ID, 'Error');
  $error = json_decode($errors[0]);
  $item = json_decode($post->post_content);
  echo '<style>';
  echo '.column-has_error{width:100px;}';
  echo '</style>';
	switch($column) {
		case 'email':
			if ( empty( $item->email_address ) ){
				echo __('Unknown');
      } else {
        echo '<a href="mailto:'. $item->email_address .'" title="">' . $item->email_address . '</a>';
      }
		break;
		case 'phone':
			if ( empty($item->mobile_number)){
				echo __('Unknown');
      } else {
        echo '<a href="callto:'. $item->mobile_number .'" title="">' . $item->mobile_number . '</a>';
      }
		break;
		case 'has_error':
      if(is_array($error)){
        $items = count($error);
        echo '<a href="post.php?post='. $post->ID .'&action=edit"><span style="height: 20px;width: 20px;display: block;color: #fff;background: #F00;border-radius: 100%;text-align: center;line-height: 20px;font-weight: 600;margin: 0 auto;font-size: 10px;">'. $items .'</span></a>';
      } else {
        echo '<a href="post.php?post='. $post->ID .'&action=edit"><span style="height: 20px;width: 20px;display: block;color: #fff;background: #008737;border-radius: 100%;text-align: center;line-height: 20px;font-weight: 600;margin: 0 auto;font-size: 10px;"></span></a>';
      }
		break;
		case 'send_to_base':
      if(is_array($error)){
        $items = count($error);
        echo '<a href="post.php?post='. $post->ID .'&action=edit"><span style="color:#f00;">'. $items .' Errors</span></a>';
      } else {
        echo '<span style="color:#008737;">Perfect</span>';
      }
		break;
		default:

    break;
	}
}
function MotivoMortgageWidget() {
  wp_add_dashboard_widget(
    'MotivoMortgageWidget',         // Widget slug.
    'Motivo Media + BaseCRM',         // Title.
    'MotivoMortgageWidget_function' // Display function.
  );
 	// Globalize the metaboxes array, this holds all the widgets for wp-admin
 	global $wp_meta_boxes;
 	// Get the regular dashboard widgets array
 	// (which has our new widget already but at the end)
 	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
 	// Backup and delete our new dashboard widget from the end of the array
 	$example_widget_backup = array( 'MotivoMortgageWidget' => $normal_dashboard['MotivoMortgageWidget'] );
 	unset( $normal_dashboard['MotivoMortgageWidget'] );
 	// Merge the two arrays together so our widget is at the beginnin
 	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );
 	// Save the sorted array back into the original metaboxes
 	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'MotivoMortgageWidget');
function MotivoMortgageWidget_function() {
  global $wpdb;
  $meta_key = 'Error';

  $errored = "SELECT DISTINCT pm.post_id FROM $wpdb->postmeta pm JOIN $wpdb->posts p ON (p.ID = pm.post_id) WHERE pm.meta_key = '$meta_key' AND pm.meta_value != 'No Errors' AND p.post_type = 'applications' AND p.post_status = 'publish'";
  $all = "SELECT DISTINCT pm.post_id FROM $wpdb->postmeta pm JOIN $wpdb->posts p ON (p.ID = pm.post_id) WHERE p.post_type = 'applications' AND p.post_status = 'publish'";

  $errored = count($wpdb->get_results($errored));
  $all = count($wpdb->get_results($all));

  $_HTML = '<style>';
  $_HTML .= '#applicationsWidget{}';
  $_HTML .= '#applicationsWidget .applicationsTotal {display: inline-block;box-sizing: border-box;padding: 10px;text-align: center;font-size: 30px;width: 32.33%;border-right:1px solid #eaeaea;}';
  $_HTML .= '#applicationsWidget .applicationsTotal:last-child {border-right:0px solid #eaeaea;}';
  $_HTML .= '#applicationsWidget .applicationsTotal.All{color: #ff8f00;}';
  $_HTML .= '#applicationsWidget .applicationsTotal.successfull{color: #00b84b;}';
  $_HTML .= '#applicationsWidget .applicationsTotal.errors{color: #f00;}';
  $_HTML .= '#applicationsWidget .applicationsTotal span{display: block;font-size: 13px;margin: 20px 0px 0px 0px;color: #111;}';
  $_HTML .= '#applicationsButton {text-align:center;}';
  $_HTML .= '#applicationsButton a{display: inline-block;padding: 0px 30px;height: 40px;line-height: 40px;background: #00b84b;border-radius: 3px;color: #FFF;font-size: 14px;margin: 30px auto 0 auto;}';
  $_HTML .= '#applicationsButton a:hover{background: #006800;}';
  $_HTML .= '</style>';
  $_HTML .= '<div id="applicationsLogo">';
  $_HTML .= ' <img src="'. plugin_dir_url( __FILE__ ) . 'assets/images/logo.svg" style="display: block;width: 80%;margin: 0 auto 30px auto;">';
  $_HTML .= '</div>';
  $_HTML .= '<div id="applicationsWidget">';
  $_HTML .= '   <div class="applicationsTotal All">';
  $_HTML .= '     ' . $all;
  $_HTML .= '     <span>Total Applications</span>';
  $_HTML .= '   </div>';
  $_HTML .= '   <div class="applicationsTotal successfull">';
  $_HTML .= '     ' . ($all - $errored);
  $_HTML .= '     <span>Successfull Applications</span>';
  $_HTML .= '   </div>';
  $_HTML .= '   <div class="applicationsTotal errors">';
  $_HTML .= '     ' . $errored;
  $_HTML .= '     <span>Errored Applications</span>';
  $_HTML .= '   </div>';
  $_HTML .= '</div>';
  $_HTML .= '<div id="applicationsButton">';
  $_HTML .= '   <a href="edit.php?post_type=applications">View All Applications</a>';
  $_HTML .= '</div>';
  echo $_HTML;
}

?>
