<?php
/**
 * Plugin Name: Toast
 */
add_action('save_post', function($post_id, $post){
    global $wpdb;

    if ($post->post_status == 'publish') {
        $wpdb->insert('wp_toast', [
            'status' => 0,
            'name' => $post->post_status
        ]);
    }
    var_dump('a');
//    add_filter( 'redirect_post_location', 'add_notice_query_var', 99 );
}, 10, 3);

function add_notice_query_var( $location ) {
    remove_filter( 'redirect_post_location', 'add_notice_query_var', 99 );
    return add_query_arg( array( 'YOUR_QUERY_VAR' => 'ID' ), $location );
}

add_action('admin_notices', function(){
    $user = wp_get_current_user();
    if ($user->data->user_login != 'writer') return;

    global $wpdb;

    $list = $wpdb->get_results('SELECT * FROM wp_toast WHERE status = 0');

    echo "<div class='wrap'>";
    foreach ($list as $rs) {
        echo "<div class='updated notice notice-success'><p>editor send a message [Review it]</p></div>";
    }
    echo "</div>";

    $wpdb->query('UPDATE wp_toast SET status = 1');
});