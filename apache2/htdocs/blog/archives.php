<?php
  // ---------------
  // INITIALIZE PAGE
  // ---------------
  require_once('scripts/sb_functions.php');
  global $logged_in;
  $logged_in = logged_in( false, true );
  
  read_config();
  
  require_once('languages/' . $blog_config[ 'blog_language' ] . '/strings.php');
  sb_language( 'archives' );
  
  // ---------------
  // POST PROCESSING
  // ---------------
  
  // Verify information being passed
  $temp_year = NULL;
  if ( array_key_exists( 'y', $_GET ) ) {
    if ( strpos( $_GET[ 'y' ], array( '/', '.', '\\', '%' ) ) === false && strlen( $_GET[ 'y' ] ) == 2 ) {
      $temp_year = $_GET[ 'y' ];
    }
  }
  $temp_month = NULL;
  if ( array_key_exists( 'm', $_GET ) ) {
    if ( strpos( $_GET[ 'm' ], array( '/', '.', '\\', '%' ) ) === false && strlen( $_GET[ 'm' ] ) == 2 ) {
      $temp_month = $_GET[ 'm' ];
    }
  }
  $temp_day = NULL;
  if ( array_key_exists( 'd', $_GET ) ) {
    if ( strpos( $_GET[ 'd' ], array( '/', '.', '\\', '%' ) ) === false && strlen( $_GET[ 'd' ] ) == 2 ) {
      $temp_day = $_GET[ 'd' ];
    }
  }
  $temp_entry = NULL;
  if ( array_key_exists( 'entry', $_GET ) ) {
    if ( strpos( $_GET[ 'entry' ], array( '/', '.', '\\', '%' ) ) === false && strlen( $_GET[ 'entry' ] ) == 18 ) {
      $temp_entry = $_GET[ 'entry' ];
    }
  }
  
  if ( !isset( $temp_year ) || !isset( $temp_month ) ) {
    // Set the $month, $year, $day globals...
    get_latest_entry();
  } else {
    // Grab $year and $month from URL
    global $month, $year;
    $year = $temp_year;
    $month = $temp_month;
  }
  
  if ( isset( $temp_day ) ) {
    global $day;
    $day = $temp_day;
  }
  
  if ( isset( $temp_entry) ) {
    global $temp_entry;
    $entry = $temp_entry;
  }
  
  if ( array_key_exists( 'category', $_GET ) ) {
    global $category;
    $category = $_GET[ 'category' ];
  }
  
  if ( array_key_exists( 'showall', $_GET ) ) {
    global $showall;
    $showall = true;
  }
  
  // ------------
  // PAGE CONTENT
  // ------------
  function page_content() {
    global $month, $year, $day, $lang_string, $showall;
    
    // SUBJECT
    $entry_array = array();
    $entry_array[ 'subject' ] = $lang_string['title'];
    $entry_array[ 'entry' ] = '<p><a href="archives.php?showall=1">' . $lang_string['showall'] . '</a></p>' . read_menus_tree( $month, $year, $day, 300, 'archives.php', $showall );
    
    // THEME ENTRY
    echo( theme_staticentry( $entry_array ) );
  }
  
  // ----
  // HTML
  // ----
?>
  <?php echo( get_init_code() ); ?>
  <?php require_once('themes/' . $blog_theme . '/user_style.php'); ?>
  
  <title><?php echo($blog_config[ 'blog_title' ]); ?></title>
</head>
  <?php 
    // ------------
    // BEGIN OUTPUT
    // ------------
    theme_pagelayout();
  ?>
</html>
