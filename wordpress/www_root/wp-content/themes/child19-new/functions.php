<?php
/* Enqueue Styles */
if ( ! function_exists('thr_enqueue_styles') ) {
    function thr_enqueue_styles() {
        wp_enqueue_style( 'twenty-nineteen-style', get_template_directory_uri() .'/style.css' );
    }
    add_action('wp_enqueue_scripts', 'thr_enqueue_styles');
}

show_admin_bar(false);

/* 헤더에 설정 추가 */
function custom_header_metadata() {
  echo '<meta charset="utf-8">';
	echo '<meta name="viewport" content="width=device-width,initial-scale=1.0" />';
  echo '<link rel="icon" type="image/png" href="/img/favicon.png">';
}

add_action( 'wp_head', 'custom_header_metadata' );

/**
 * admin페이지 투표 진행상황 메뉴 추가
 */
function add_vote_menu() {
  add_menu_page(
        __( 'This is message View', 'textdomain' ),
        '투표 진행상황',
        'manage_options',
        'message-page',
        'get_vote_view',
        'dashicons-email'
      );
    
};
add_action('admin_menu','add_vote_menu');

/**
 * 위 함수에서 호출한 view_vote 화면 가져오는 함수.
 */
function get_vote_view() {
  require_once dirname( __FILE__ )  . '/view_vote.php';
}

/**
 * 메인 화면의 투표 완료 버튼 클릭시 action
 */
function save_vote_handler() {
  $tz = 'Asia/Seoul';
  $timestamp = time();
  $dt = new DateTime("now", new DateTimeZone('Asia/Seoul'));
  $dt->setTimestamp($timestamp);
  $time = $dt->format('H:i:s');

  // 투표 시작 & 종료
  
  global $wpdb;
  $d = $_POST['data'];
  $table_name = 'wp_vote';
  $device = substr($_SERVER['HTTP_USER_AGENT'], 17, 20);
  $canvas = $d['fp'];
  $rawIp = getRealClientIp();

  // $ip = $rawIp . $canvas . $device;
  // $queryCheck = $wpdb->prepare("SELECT time FROM `$table_name` WHERE ip = '".$ip."' ");
  // $resultCheck = $wpdb->get_results($queryCheck);
  // if($resultCheck[0] && $resultCheck[0]->time) {
  //   wp_send_json(["type"=>'voted', "time"=>$resultCheck[0]->time]);
  //   return;
  // }

  // $query = $wpdb->prepare("INSERT INTO `$table_name` (`ip`,`g1L`,`g2L`,`g3L`,`g4L`,`t1`,`t2`,`t3`,`t4`,`t5`,`t6`,`t7`,`t8`,`time`) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",$ip,$d['g1']=='L'?1:0,$d['g2']=='L'?1:0,$d['g3']=='L'?1:0,$d['g4']=='L'?1:0,$d['t1'],$d['t2'],$d['t3'],$d['t4'],$d['t5'],$d['t6'],$d['t7'],$d['t8'],$time);
  $query = $wpdb->prepare("INSERT INTO `$table_name` (`ip`,`g1L`,`g2L`,`g3L`,`g4L`,`t1`,`t2`,`t3`,`t4`,`t5`,`t6`,`t7`,`t8`,`time`) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",$ip,1,1,0,0,1,1,1,1,0,0,0,0,$time);
  $result = $wpdb->query($query);

  //test
  // wp_send_json($_POST);
  // wp_send_json(["rawIp"=>$rawIp, "hash"=>$ip, 'device'=> $device, 'canvas'=>$d['fp'], 'post'=> $d]);

  wp_send_json_success($result);
}
add_action('wp_ajax_save_vote', 'save_vote_handler');
add_action('wp_ajax_nopriv_save_vote', 'save_vote_handler');

/**
 * init시점에서 wp_vote라는 db가 없는 경우 생성하는 함수(투표 테이블)
 */
function create_vote_table() {
  global $wpdb;
  require_once ABSPATH . 'wp-admin/includes/upgrade.php';
  $charset_collate = $wpdb->get_charset_collate();
  $table_name = 'wp_vote';
  $create_sql = '';
  if( $wpdb->get_var("SHOW TABLES LIKE '" . $table_name . "'") !=  $table_name)
  {   $create_sql = "CREATE TABLE " . $table_name . " (
          idx INT(11) auto_increment,
          ip TEXT,
          g1L INTEGER,
          g2L INTEGER,
          g3L INTEGER,
          g4L INTEGER,
          t1 INTEGER,
          t2 INTEGER,
          t3 INTEGER,
          t4 INTEGER,
          t5 INTEGER,
          t6 INTEGER,
          t7 INTEGER,
          t8 INTEGER,
          time text,
          PRIMARY KEY (idx))$charset_collate;";
  }
  if($create_sql) {
    require_once(ABSPATH . "wp-admin/includes/upgrade.php");
    dbDelta( $create_sql );
  }
}
// add_action('init','create_vote_table');

// IP + 기기 정보로 사용자 식별
function getRealClientIp() {

  // 사용자의 IP 주소 가져오기
  $ipaddress = '';
  if ($_SERVER['HTTP_CLIENT_IP']) {
      $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
  } else if($_SERVER['HTTP_X_FORWARDED_FOR']) {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else if($_SERVER['HTTP_X_FORWARDED']) {
      $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
  } else if($_SERVER['HTTP_FORWARDED_FOR']) {
      $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
  } else if($_SERVER['HTTP_FORWARDED']) {
      $ipaddress = $_SERVER['HTTP_FORWARDED'];
  } else if($_SERVER['REMOTE_ADDR']) {
      $ipaddress = $_SERVER['REMOTE_ADDR'];
  } else {
      $ipaddress = '알수없음';
  }
  
  return $ipaddress ;
}
