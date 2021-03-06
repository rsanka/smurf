<?php
  require_once('/usr/local/common/web'.$_SERVER['WEBTIER'].'/templates/class.template.php');
  require_once('scripts/php/config.php');
  
  $template = new template();

  $side_menu[1]['class'] = 'no_sub side_active';
  
  $content = '
    <p>Users must be registered or signed in to upload sequences because results will be sent by email</p>
    <table class="contenttable">
      <tbody>
        <tr class="tableHeader">       
          <td rowspan="1"><p>New Users | Registration</p></td>
          <td rowspan="1"><p>Returning Users | SignIn</p></td>
        </tr>
        <tr class="tableRowEven">
          <td>
            <form id="registration" action = "/cgi-bin/smurf/registration.cgi" onsubmit="return validator(this)" method="post">
              <p><label for="email_reg">Email:</label></p>
              <p><input type="text" name="email" id="email_reg" /></p>
              <p><label for="affiliation">Affiliation:</label></p>
              <p><input type="text" name="affiliation" id="affiliation" /></p>
              <p><input type="submit" value="Register" /> <input type="reset" value="Reset" /></p>
	  </form>
          </td>
          <td>
	  <form id="validation" action = "/cgi-bin/smurf/sign.cgi" onsubmit="return checkemail()" method="post">
              <p><label for="email_val">Email address:</label></p>
              <p><input type="text" name ="email" id="email_val" /></p>
              <p><input type="submit" value="SignIn" /> <input type="reset" value="Reset" /></p>
	  </form>
          </td>
        </tr>
      </tbody>
    </table>';
  
  $breadcrumb = array(
    array(
      'link' => 'run_smurf.php',
      'name' => 'Run SMURF',
    ),
  );
  
  $template->assign('javascript', array('scripts/js/main.js'));
  $template->assign('title', $title.'Run Smurf');
  $template->assign('top_menu', $top_menu);
  $template->assign('side_menu', $side_menu);
  $template->assign('page_header', $page_header);
  $template->assign('home_page', $home_page);  
  $template->assign('project_name', $project_name);
  $template->assign('main_content', $content);
  $template->assign('right_content', $right_content);
  $template->assign('site', 'SMURF');
  $template->assign('section_header', $section_header);
  $template->assign('breadcrumb', $breadcrumb);
  
  $template->display('3_column_fixed_width.tpl');
?>
