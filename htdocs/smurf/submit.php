<?php
  // redirect to run_smurf if not logged in
  if(!isset($_COOKIE['smurfs'])) { 
    header('Location: run_smurf.php');
  } // end if(!isset($_COOKIE['smurfs']))

  require_once('/usr/local/common/web'.$_SERVER['WEBTIER'].'/templates/class.template.php');
  require_once('scripts/php/config.php');
  
  $template = new template();

  $end_menu = array_splice($side_menu, 3);
  $side_menu[] = array(
    'class' => 'subA side_active',
    'link' => 'submit.php',
    'menu_name' => 'Thank You',
  );  
  
  $side_menu = array_merge($side_menu, $end_menu);
  
  $content = '
    <p>Secondary Metabolite Clusters and Backbone Genes will be emailed to you at the address that you provided during registration or sign in</p>
    <p>You may upload more sequences <a href="upload.php">here</a></p>';
  
  $breadcrumb = array(
    array(
      'link' => 'run_smurf.php',
      'name' => 'Run SMURF',
    ),
    array(
      'link' => 'submit.php',
      'name' => 'Thank You',
    ),
  );
  
  $template->assign('javascript', array('scripts/js/main.js'));
  $template->assign('title', $title.'Thank You');
  $template->assign('top_menu', $top_menu);
  $template->assign('side_menu', $side_menu);
  $template->assign('page_header', 'Thank you for your submission to SMURF');
  $template->assign('home_page', $home_page);  
  $template->assign('project_name', $project_name);
  $template->assign('main_content', $content);
  $template->assign('right_content', $right_content);
  $template->assign('site', 'SMURF');
  $template->assign('section_header', $section_header);
  $template->assign('breadcrumb', $breadcrumb);
  
  $template->display('3_column_fixed_width.tpl');
?>
