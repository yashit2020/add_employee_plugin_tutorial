<?php
/**
 * @package contributor
 * @version 1.0.0
 */
/*
Plugin Name: employee menu
Plugin URI: http://www.employeemenu.com
Description: This plugin creates employee menu, employee page and some capabilities.
Author: lalit
Version: 1.0.0
Author URI: http://lalit.com
*/

function employee_menu()
{
	add_menu_page(
		__('Employee page', 'Employees'),
		__('Employee menu', 'Employee menu'),
		'manage_options',
		'employee-page',
		'employee_page_contents',
		'dashicons-schedule',
		3
	);
}

add_action('admin_menu', 'employee_menu');

function employee_page_contents(){
	?>
		<h1>
			<?php esc_html_e('Welcome to Employee Page','');?>
		</h1>
		<form action="" method="post" name="employee_add_form">
		  <label>Employee name:</label>
		  <input type="text" id="ename" name="ename"><br><br>
		  <input type="submit" value="Add Employee" name="submit">
		</form>
	<?php
	if(isset($_POST['submit'])){
		$ename = $_POST['ename'];
		echo $ename;
		$insert_emp = array(
			'post_title' 	=> $ename,
			'post_content' 	=> $ename,
			'post_author' 	=> 1,
			'post_type' 	=> 'employee',
			'post_status' 	=> 'publish'
		);
		//var_dump($insert_emp);
		wp_insert_post($insert_emp);
	}
	?>
		<table style="width:100%;font-family: arial, sans-serif;border-collapse: collapse;">
		  <tr>
			<th>Employee Name</th>
		  </tr>
			<?php
				global $wpdb;
				$results = $wpdb->get_results("SELECT * FROM wp_posts where post_type = 'employee'");
				//var_dump($results);
				if(!empty($results)){
					foreach($results as $result)
					{
						?>
							<tr>
								<td><?php echo $result->post_name;?></td>
							</tr>
						<?php
					}
				}
			?>
		</table>
	<?php
}
?>