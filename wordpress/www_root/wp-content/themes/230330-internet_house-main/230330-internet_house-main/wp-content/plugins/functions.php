<?php
  function theme_enqueue_styles() {
    // wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'parent-style' ) );
  }
  add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

  
  show_admin_bar(false);
  
  /**
   * admin페이지 문자접수 보기 메뉴 추가
   */
  function add_application_menu() {
    add_menu_page(
      		__( 'This is message View', 'textdomain' ),
      		'문자 접수',
      		'manage_options',
          'message-page',
      		'get_application_view',
          'dashicons-email'
      	);
     
  };
  add_action('admin_menu','add_application_menu');

  /**
   * 위 함수에서 호출한 view_application 화면 가져오는 함수.
   */
  function get_application_view() {
    require_once dirname( __FILE__ )  . '/view_application.php';
  }
  
  /**
   * admin페이지 인터넷신청서 보기 메뉴 추가
   */
  function add_join_application_menu() {
    add_menu_page(
      		__( 'This is Join Application View', 'textdomain' ),
      		'인터넷신청서',
      		'manage_options',
          'application-page',
      		'get_join_application_view',
          'dashicons-media-text'
      	);
     
  };
  add_action('admin_menu','add_join_application_menu');

  /**
   * 위 함수에서 호출한 view_join_internet 화면 가져오는 함수.
   */
  function get_join_application_view() {
    require_once dirname( __FILE__ )  . '/view_join_application.php';
  }
  function get_img($filename) {
     echo('src="' . esc_url( get_template_directory_uri() ) . '/../child/img/' . $filename . '"');
  }
  function get_js($filename="main.js") {
    echo('src="' . esc_url( get_template_directory_uri() ) . '/../child/js/' . $filename . '"');
  }
  // add_filter( 'the_title', function ($title) { return "";});

  // function remove_editor() {
  //   remove_post_type_support('page', 'editor');
  // }
  // add_action('admin_init', 'remove_editor');
  // function wj_add_menus() {
  //   add_theme_support('menus');
  //   register_nav_menus(array(
  //     'main_menu' => '메인메뉴',
  //     'mobile_main_menu' => '모바일 메인 메뉴',
  //   ));
  // }
  // add_action('after_setup_theme', 'wj_add_menus');

// /**
//  * Register a custom menu page.
//  */
// function wpdocs_register_my_custom_menu_page() {
// 	add_menu_page(
// 		__( 'KT Page', 'textdomain' ),
// 		'main_menu',
// 		'manage_options',
// 		'kt_page.html'
// 	);
//   add_menu_page(
// 		__( 'LG Page', 'textdomain' ),
// 		'main_menu',
// 		'manage_options',
// 		'lg_page'
// 	);
// }
// add_action( 'admin_menu', 'wpdocs_register_my_custom_menu_page' );
  
// Gather post data.
// $my_post = array(
// 	'post_title'    => 'My post',
// 	'post_content'  => 'This is my post.',
// 	'post_status'   => 'publish',
// 	'post_author'   => 1,
// 	'post_category' => array( 8,39 ),
//   'tags_input ' => array('kt_page')
// );

// // Insert the post into the database.
// wp_insert_post( $my_post );


// function wpdocs_my_plugin_menu() {
// 	add_links_page(
// 		__( 'My Plugin Posts Page', 'textdomain' ),
// 		__( 'My Plugin', 'textdomain' ),
// 		'read',
// 		'kt_page',
// 		'wpdocs_my_plugin_function'
// 	);
// }
// add_action( 'admin_menu', 'wpdocs_my_plugin_menu');

/**
 * 지원신청서 신청 버튼 클릭시 action
 */
function save_join_application(){
  global $wpdb;
  $data = $_POST['data'];
  $prds = implode(", ", $data['products']);

  $data['date'] = date('m-d h:i');
  $table_name = 'wp_join_application';
  $query = $wpdb->prepare("INSERT INTO `$table_name` (`agency_name`, `products`, `name`,`birth`,`gender`,`phone_number`,`zip_code`,`address`,
  `address_detail`, `bank`, `account_holder`, `account_number`, `memo`,`is_completed`, `is_checked`,`apply_date`) values 
  (%s,%s,%s,%s,%d,%s,%s,%s,%s,%s,%s,%s,%s,%d,%d,%s)", $data['agency'], $prds, $data['name'],$data['birth'],$data['gender'],$data['phone'],$data['zip'],$data['addr']
  ,$data['addr2'],$data['bank'],$data['holder'],$data['account_number'],$data['memo'],0,1,$data['date']);
  $result = $wpdb->query($query);
  wp_send_json($result);
}
add_action('wp_ajax_save_join_application', 'save_join_application');
/**
 * 메인 화면의 비밀지원금 문자신청 버튼 클릭시 action
 */
  function save_application(){
    global $wpdb;
    $data = $_POST['data'];
    $data['date'] = date('m-d h:i');
    $table_name = 'wp_application_info';
    $query = $wpdb->prepare("INSERT INTO `$table_name` (`apply_name`, `apply_phone`, `apply_date`,`is_checked`,`is_completed`) values (%s,%s,%s,%d,%d)", $data['name'], $data['phone'], $data['date'],1,0);
    $result = $wpdb->query($query);
    wp_send_json($result);
  }
  add_action('wp_ajax_save_apply_info', 'save_application');
  add_action('wp_ajax_nopriv_save_apply_info', 'save_application');

  /**
   * admin 페이지의 신청서 메뉴에서 화면에 표시하기 버튼 클릭시 action
   */
  function convert_to_checked() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_application_info';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_checked = 1
      WHERE apply_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_checked', 'convert_to_checked');

  /**
   * admin 페이지의 신청서 메뉴에서 화면에 감추기 버튼 클릭시 action
   */
  function convert_to_unchecked() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_application_info';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_checked = 0
      WHERE apply_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_unchecked', 'convert_to_unchecked');

  /**
   * admin 페이지의 신청서 메뉴에서 신청서를 접수완료로 변경버튼 클릭시 action
   */
  function convert_to_completed() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_application_info';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_completed = 1
      WHERE apply_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_completed', 'convert_to_completed');

  /**
   * init시점에서 wp_application_info라는 db가 없는 경우 생성하는 함수(문자접수DB)
   */
  function create_application_db() {
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = 'wp_application_info';
    $create_sql = '';
    if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") !=  $table_name)
    {   $create_sql = "CREATE TABLE " . $table_name . " (
            apply_idx INT(11) NOT NULL auto_increment,
            apply_name TEXT NOT NULL,
            apply_phone CHAR(11) NOT NULL,
            apply_date VARCHAR(15) NOT NULL,
            is_completed TINYINT(1) NOT NULL,
            is_checked TINYINT(1) NOT NULL,
            PRIMARY KEY (apply_idx))$charset_collate;";
    }
    if($create_sql) {
      require_once(ABSPATH . "wp-admin/includes/upgrade.php");
      dbDelta( $create_sql );
    }
  }
  add_action('init','create_application_db');

  /**
   * init시점에서 wp_application_info라는 db가 없는 경우 생성하는 함수(인터넷가입신청DB)
   */
  function create_join_application_db() {
    global $wpdb;
    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = 'wp_join_application';
    $create_sql = '';
    if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") !=  $table_name)
    {   $create_sql = "CREATE TABLE " . $table_name . " (
            join_idx INT(11) NOT NULL auto_increment,
            apply_date VARCHAR(15) NOT NULL,
            agency_name TEXT NOT NULL,
            products TEXT NOT NULL,
            name TEXT NOT NULL,
            birth VARCHAR(15) NOT NULL,
            gender TINYINT(1) NOT NULL,
            phone_number CHAR(11) NOT NULL,
            zip_code CHAR(6) NOT NULL,
            address TEXT NOT NULL,
            address_detail TEXT,
            bank TEXT NOT NULL,
            account_holder TEXT NOT NULL,
            account_number CHAR(20) NOT NULL,
            memo TEXT ,
            is_completed TINYINT(1) NOT NULL,
            is_checked TINYINT(1) NOT NULL,
            PRIMARY KEY (join_idx))$charset_collate;";
    }
    if($create_sql) {
      require_once(ABSPATH . "wp-admin/includes/upgrade.php");
      dbDelta( $create_sql );
    }
  }
  add_action('init','create_join_application_db');

  /**
   * 메인화면의 가입신청하기 버튼 클릭시 이동하는 페이지인 application페이지일때만 아래의 js파일 로드.
   */
  function get_application_page_js() {
    if( is_page('aplication')){
      global $wpdb;
      $res = $wpdb->tables();
      wp_enqueue_style( 'applicationsCss', get_theme_file_uri() . '/css/application_page.css', array() );
    
      wp_enqueue_script( 'applicationJs', get_theme_file_uri() . '/js/application_page.js', array(), '', true );
    }
  }
  add_action( 'wp_enqueue_scripts', 'get_application_page_js' );
  /**
   *  회원가입 페이지에서만 아래의 css파일 로드.
   */
  function get_signout_js() {
    if( is_page('signout')){
      wp_enqueue_style( 'signoutCss', get_theme_file_uri() . '/css/signout.css', array() );
    
      // wp_enqueue_script( 'applicationJs', get_theme_file_uri() . '/js/application_page.js', array(), '', true );
    }
  }
  add_action( 'wp_enqueue_scripts', 'get_signout_js' );
   /**
   * admin 페이지의 신청서 메뉴에서 화면에 표시하기 버튼 클릭시 action
   */
  function convert_to_checked_join() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_join_application';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_checked = 1
      WHERE join_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_checked_join', 'convert_to_checked_join');

  /**
   * admin 페이지의 신청서 메뉴에서 화면에 감추기 버튼 클릭시 action
   */
  function convert_to_unchecked_join() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_join_application';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_checked = 0
      WHERE join_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_unchecked_join', 'convert_to_unchecked_join');

  /**
   * admin 페이지의 신청서 메뉴에서 신청서를 접수완료로 변경버튼 클릭시 action
   */
  function convert_to_completed_join() {
    global $wpdb;
    $data = $_POST['data'];
    $table_name = 'wp_join_application';
    $query =  $wpdb->query(
      "UPDATE $table_name SET is_completed = 1
      WHERE join_idx IN (". implode(',', array_map( 'intval', $data ) ) .")"
    );
    $result = $wpdb->query($query);
    wp_send_json_success($result);
  }
  add_action('wp_ajax_convert_to_completed_join', 'convert_to_completed_join');
?>