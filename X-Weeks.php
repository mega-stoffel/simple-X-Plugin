<?php
/*
 * Plugin Name: X-Weeks
 * Plugin URI:  https://x-tof.de
 * Description: This plugin adds some functionality for the so called cover'd project, adding some week stuff and a polling functionality for each "post"
 * Version:     0.1
 */

// this function adds the "Question" and "Answer" post types
function X_setup_post_type() {
    $Question_Labels = array(
        'name'          => 'Fragen',
        'singular_name' => 'Frage',
        'search_items'  => 'Frage suchen',
        'all_items'     => 'Alle Fragen',
        'parent_item'   => 'Parent?',
        'parent_item_colon' => 'Parent?:',
        'edit_item'     => 'Fragen bearbeiten',
        'update_item'   => 'Frage aktualisieren',
        'add_new_item'  => 'Neue Frage hinzufügen',
        'new_item_name' => 'New Course Qu-Name',
        'menu_name'     => 'Fragen',
    );

    /*$Answer_Labels = array(
        'name'          => 'Antworten',
        'singular_name' => 'Antwort',
        'search_items'  => 'Antwort suchen',
        'all_items'     => 'Alle Antworten',
        'parent_item'   => 'Parent?',
        'parent_item_colon' => 'Parent?:',
        'edit_item'     => 'Antwort bearbeiten',
        'update_item'   => 'Antwort aktualisieren',
        'add_new_item'  => 'Neue Antwort hinzufügen',
        'new_item_name' => 'New Course Ant-Name',
        'menu_name'     => 'Antworten',
    );*/

    $Question_Options = array(
        'labels'      => $Question_Labels,
        'public'      => true,
        'has_archive' => true,
        'menu_position' => 5,
        'supports' => ['title', 'author', 'comments', 'trackbacks', 'custom-fields',],
        'rewrite'     => array( 'slug' => 'frage' ), 
        'delete_with_user' => false,
    );
    //, menu_icon=> 'public/images/stern.svg'
    
    /*$Answer_Options = array(
        'labels' => $Answer_Labels,
        'public' => true,
        'hierarchical' => true,
        'menu_position' => 5,
        'delete_with_user' => true,
    );*/
    
    // arguments for taxonomy
    /*$X_taxonomy   = array(
        'hierarchical'      => true, // make it hierarchical (like categories)
        'labels'            => $Answer_Labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'frage' ],
    );*/
    register_post_type( 'X-Question', $Question_Options); 
    //register_post_type( 'X-Answer', $Answer_Options, $X_taxonomy);
} 
add_action( 'init', 'X_setup_post_type' );

/*
 * Activate the plugin.
 */
function pluginprefix_activate() { 
    // Trigger our function that registers the custom post type plugin.
    pluginprefix_setup_post_type(); 
    // Clear the permalinks after the post type has been registered.
    flush_rewrite_rules(); 
}
register_activation_hook( __FILE__, 'pluginprefix_activate' );

/*
 * Deactivation hook.
 */
function pluginprefix_deactivate() {
    // Unregister the post type, so the rules are no longer in memory.
    unregister_post_type( 'question' );
    unregister_post_type( 'answer' );
    // Clear the permalinks to remove our post types' rules from the database.
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivate' );

?>