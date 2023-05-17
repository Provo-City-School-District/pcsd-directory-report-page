<?php
/*
Plugin Name: PCSD Directory Report Page
Plugin URI: 
Description: Creates a dashboard page to display our report that checks for active emails in our website directory
Version: 1.0
Author: Josh Espinoza
Author URI: https://iamjoshespinoza.com
License: GPL2
*/
add_action('admin_menu', 'pcsd_dir_admin_menu');
function pcsd_dir_admin_menu()
{
	add_menu_page('Bad emails found in directory', 'Directory Issues', 'special_pages', 'pcsd_dir-admin-page.php', 'pcsd_dir_admin_page', 'https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png', 6);
}
function pcsd_dir_admin_page()
{
?>
	<div class="wrap">
		<h1>Invalid Emails in The Website Directory</h1>
		<?php
		$dirReportPath = '/var/www/html/public_html/wp-content/uploads/bad-emails/docker-directory_report.txt';
		date_default_timezone_set('America/Denver');
		if (file_exists($dirReportPath)) {
			$modification_time = filemtime($dirReportPath);
		} else {
			echo 'File not found.';
		}
		//this file is produced currently by a container running on 1.104. link to github of code https://github.com/Provo-City-School-District/website-directory-checker
		$dircheck_mainweb = nl2br(file_get_contents($dirReportPath));
		?>
		<p>This page will show you emails found in the website directory that are not currently active/found in the vault.</p>
		<?= '<strong>This report was last updated on:</strong> ' . date('Y-m-d H:i:s', $modification_time); ?>

		<?php echo '<br><br>' . $dircheck_mainweb; ?>
	</div> <?php

		}
