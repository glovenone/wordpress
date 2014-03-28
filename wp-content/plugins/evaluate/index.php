<?php
/*
Plugin Name: Post Evaluate
Plugin URI: http://immomo.com
Description: evaluate a post 
Version: 1.0
Author: tian.dalong
Author URI: http://immomo.com
 */

/*  Copyright 2014  tian.dalong  (email : tian.dalong@immomo.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

register_activation_hook( __FILE__, 'posts_evaluate_install' );

function posts_evaluate_install() {
    global $wpdb;
    $evaluate_db_version = "1.0";
    $table_name = $wpdb->prefix.'posts_evaluate2';
    if($wpdb->get_var("show tables like '".$table_name."'") != $table_name) {
        $sql = "CREATE TABLE ".$table_name." (
            ID bigint(20) NOT NULL AUTO_INCREMENT,
            post_id bigint(20) unsigned NOT NULL,
            userful_count int(11) unsigned NOT NULL,
            userless_count int(11) unsigned NOT NULL,
            PRIMARY KEY (ID),
            UNIQUE KEY post_id (post_id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        require_once(ABSPATH . "wp-admin/includes/upgrade.php");
        dbDelta($sql);
        add_option( "evaluate_db_version", $evaluate_db_version );
    }
}

function wp_posts_evaluate() {
//    echo '<script>alert("hi~")</script>';
//    posts_evaluate_install();
}

// Now we set that function up to execute when the admin_notices action is called
//add_action( 'admin_notices', 'wp_posts_evaluate' );

?>
