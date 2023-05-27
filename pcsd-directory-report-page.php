<?php
/*
Plugin Name: PCSD Directory Report Page
Plugin URI: 
Description: Creates a dashboard page to display our report that checks for active emails in our website directory
Version: 1.0
Author: Josh Espinoza
Author URI: https://iamjoshespinoza.com
*/

add_action('admin_menu', 'pcsd_dir_admin_menu');

function pcsd_dir_admin_menu()
{
	add_menu_page('Directory Issues', 'Directory Issues', 'special_pages', 'pcsd_dir_admin_page', 'pcsd_dir_admin_page_callback', 'https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png', 6);
}

function pcsd_dir_admin_page_callback()
{
	$dirReportPath = '/var/www/html/public_html/wp-content/uploads/bad-emails/docker-directory_report.txt';
	date_default_timezone_set('America/Denver');

	if (file_exists($dirReportPath)) {
		$modification_time = filemtime($dirReportPath);
		$dircheck_mainweb = nl2br(file_get_contents($dirReportPath));
?>
		<div class="wrap">
			<h1>Invalid Emails in The Website Directory</h1>
			<p>This page will show you emails found in the website directory that are not currently active/found in the vault.</p>
			<strong>This report was last updated on:</strong> <?= date('Y-m-d H:i:s', $modification_time); ?>
			<br><br>
			<?= $dircheck_mainweb; ?>
		</div>
<?php
	} else {
		echo 'File not found.';
	}
}
?>
