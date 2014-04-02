<?php
/**
 * Created by PhpStorm.
 * User: Andrew
 * Date: 20/03/14
 * Time: 11:49 PM
 */
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tlm_add_sidebar_box() {

    $screens = array( 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'sidebar_boxid',
            __( 'Sidebar', $GLOBALS['sThemeTextDomain'] ),
            'tlm_inner_sidebar_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'tlm_add_sidebar_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function tlm_inner_sidebar_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'tlm_inner_sidebar_box', 'tlm_inner_sidebar_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, 'sidebar', true );
    $value_c = get_post_meta( $post->ID, 'contact', true );

    echo '<label for="sidebar_switch">';
    _e( "Sidebar?", $GLOBALS['sThemeTextDomain'] );
    echo '</label> ';
    echo $value ? '<input type="checkbox" id="sidebar_switch" name="sidebar_switch" value="1" checked/>' : '<input type="checkbox" id="sidebar_switch" name="sidebar_switch" value="1"/>' ;
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tlm_save_sidebar( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tlm_inner_sidebar_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['tlm_inner_sidebar_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'tlm_inner_sidebar_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = sanitize_text_field( $_POST['sidebar_switch'] );


    // Update the meta field in the database.
    update_post_meta( $post_id, 'sidebar', $mydata );

}
add_action( 'save_post', 'tlm_save_sidebar' );
/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function tlm_page_tracking_box() {

    $screens = array( 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'tracking_boxid',
            __( 'Page specific tracking code', $GLOBALS['sThemeTextDomain'] ),
            'tlm_tracking_box_inner',
            $screen,
            'normal',
            'high'
        );
    }
}
add_action( 'add_meta_boxes', 'tlm_page_tracking_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function tlm_tracking_box_inner( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'tlm_tracking_box_inner', 'tlm_tracking_box_inner_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, 'tracking_code', true );

    echo '<label style="vertical-align:top" for="tracking_code">';
    _e( "Code", $GLOBALS['sThemeTextDomain'] );
    echo '</label> ';
    echo '<textarea style="width:100%" id="tracking_code" name="tracking_code" rows="5">'.esc_attr( $value ).'</textarea>';

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tlm_save_tracking_code( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tlm_tracking_box_inner_nonce'] ) )
        return $post_id;

    $nonce = $_POST['tlm_tracking_box_inner_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'tlm_tracking_box_inner' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = sanitize_text_field( $_POST['tracking_code'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'tracking_code', $mydata );
}
add_action( 'save_post', 'tlm_save_tracking_code' );

function tlm_add_contact_box() {

    $screens = array( 'page' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'contact_boxid',
            __( 'Contact', $GLOBALS['sThemeTextDomain'] ),
            'tlm_inner_contact_box',
            $screen,
            'side'
        );
    }
}
add_action( 'add_meta_boxes', 'tlm_add_contact_box' );

/**
 * Prints the box content.
 *
 * @param WP_Post $post The object for the current post/page.
 */
function tlm_inner_contact_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'tlm_inner_contact_box', 'tlm_inner_contact_box_nonce' );

    /*
     * Use get_post_meta() to retrieve an existing value
     * from the database and use the value for the form.
     */
    $value = get_post_meta( $post->ID, 'contact', true );
    $value_m = get_post_meta( $post->ID, 'map_code', true );

    echo '<label for="contact_switch">';
    _e( "Contact?", $GLOBALS['sThemeTextDomain'] );
    echo '</label> ';
    echo $value ? '<input type="checkbox" id="contact_switch" name="contact_switch" value="1" checked/></br>' : '<input type="checkbox" id="contact_switch" name="contact_switch" value="1"/></br>' ;
    echo '<label for="map_code">';
    _e( "Map Code", $GLOBALS['sThemeTextDomain'] );
    echo '</label> ';
    echo $value_m ? '<input style ="margin-left:10px" type="text" id="map_code" name="map_code" value="'.$value_m.'"/>' : '<input style ="margin-left:10px" type="text" id="map_code" name="map_code" value=""/>' ;

}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function tlm_save_contact( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['tlm_inner_contact_box_nonce'] ) )
        return $post_id;

    $nonce = $_POST['tlm_inner_contact_box_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'tlm_inner_contact_box' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;

    // Check the user's permissions.
    if ( 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) )
            return $post_id;

    } else {

        if ( ! current_user_can( 'edit_post', $post_id ) )
            return $post_id;
    }

    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $mydata = sanitize_text_field( $_POST['contact_switch'] );
    $mydata_c = sanitize_text_field( $_POST['map_code'] );

    // Update the meta field in the database.
    update_post_meta( $post_id, 'contact', $mydata );
    update_post_meta( $post_id, 'map_code', $mydata_c );
}
add_action( 'save_post', 'tlm_save_contact' );