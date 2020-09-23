<?php

// Register Menu
function register_my_menu()
{
    register_nav_menu('header-menu', __('Header Menu'));
}
add_action('init', 'register_my_menu');

function ai_register_scripts()
{
    wp_register_style("portfolio-style", get_template_directory_uri() . "/style.css");
    wp_enqueue_style("portfolio-style");
    wp_enqueue_style("dashicons");
    // wp_enqueue_style('load-fa', 'https://use.fontawesome.com/releases/v5.0.8/css/all.css');
    wp_enqueue_script("portfolio-js", get_template_directory_uri() . "/main.js", array("jquery"));
    // wp_enqueue_style("animate-css", get_template_directory_uri() . "/animate.css");

}

add_action("wp_enqueue_scripts", "ai_register_scripts");

// Remove the header and therefore the margin-top 32px !important on <html>
function remove_admin_login_header()
{
    remove_action('wp_head', '_admin_bar_bump_cb');
}
add_action('get_header', 'remove_admin_login_header');

// Email Ajax Request
function send_email()
{
    global $wpdb;
    $res_msg;
    $status;
    $fields = array('name', 'email', "project", "desc");
    $error = false; //No errors yet

    foreach ($fields as $fieldname) { //Loop trough each field
        if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
            $error = true; //Yup there are errors
        }
    }

    if (!$error) { //Only create queries when no error occurs
        $email = $_POST["email"];
        $name = $_POST["name"];
        $subject = $_POST["project"];
        $msg = $_POST["desc"];

        $footer = "\n" . "\nName: " . $name . "\nE-Mail: " . $email;
        $msg = $msg . $footer;
        $to = "angelosweb@gmx.de";

        $headers = array();
        $headers[] = "MIME-Version: 1.0";
        $headers[] = "Content-type: text/plain; charset=utf-8";

        $mail = mail($to, $subject, $msg, implode("\r\n", $headers));

        if ($mail) {
            $res_msg = "Vielen Dank für ihre E-Mail!";
            $status = "success";
        } else {
            $res_msg = "E-Mail konnte nicht gesendet werden.";
            $status = "failed";
        }
    } else {
        $res_msg = "Bitte alle Felder ausfüllen!";
        $status = "failed";
    }

    $response = array(
        "message" => $res_msg,
        "status" => $status,
    );
    echo json_encode($response);
    wp_die();
}

add_action("wp_ajax_send_email", "send_email");
add_action("wp_ajax_nopriv_send_email", "send_email");

// Endless Scroll Endpoint
function get_next_posts()
{
    $offset = $_POST["offset"];
    $posts = wp_get_recent_posts(array(
        "offset" => $offset,
        "category_name" => "blog_post",
    ));
    foreach ($posts as $post):
    ?>
	<div class="blog-post">
		<a href="<?php echo get_permalink($post["ID"]); ?>" class="post-title">
			<?php echo $post["post_title"]; ?>
		</a>
		<h3 class="post-date">
			&mdash; <?php echo get_the_date("", $post); ?>
		</h3>
		<p class="post-content">
			<?php echo $post["post_excerpt"]; ?>
		</p>
	</div>
	<?php
endforeach;
    wp_reset_query();
    die();
}

// Activate Ajax for authorised Users and guests
add_action("wp_ajax_get_next_posts", "get_next_posts");
add_action("wp_ajax_nopriv_get_next_posts", "get_next_posts");

// Localization
// load_theme_thextdomain("Angelos Ioannou Portfolio", get_template_directory_uri() . "/languages");

?>