<?php

/**
 * Register meta box(es).
 */
function blesk_metaboxes() {
    add_meta_box( 'blesk_featured_post', __( 'Is this post featured?', 'blesk' ), 'blesk_metaboxes_rander', 'post', 'side', 'high', null );
}
add_action( 'add_meta_boxes', 'blesk_metaboxes' );
 
/**
 * Meta box display callback.
 *
 * @param WP_Post $post Current post object.
 */
function blesk_metaboxes_rander($object) {
    wp_nonce_field(basename(__FILE__), "blesk_featured_post");
	?>
    <div>
        <label for="blesk_featured_post_checkbox"><?php _e('Is this post featured?', 'blesk'); ?></label>
        <?php
            $checkbox_value = get_post_meta($object->ID, "blesk_featured_post_checkbox", true);
            if($checkbox_value == "") {
                ?>
                    <input name="blesk_featured_post_checkbox" type="checkbox" value="on">
                <?php
            } else if($checkbox_value == "on") {
                ?>  
                    <input name="blesk_featured_post_checkbox" type="checkbox" value="on" checked>
                <?php
            }

        ?>
    </div>
    <?php  
}
 
/**
 * Save meta box content.
 *
 * @param int $post_id Post ID
 */
function blesk_metaboxes_save($post_id, $post, $update) {
    if (!isset($_POST["blesk_featured_post"]) || !wp_verify_nonce($_POST["blesk_featured_post"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "post";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_checkbox_value = "";

    if(isset($_POST["blesk_featured_post_checkbox"])) {
        $meta_box_checkbox_value = $_POST["blesk_featured_post_checkbox"];
    }   
    update_post_meta($post_id, "blesk_featured_post_checkbox", $meta_box_checkbox_value);
}

add_action("save_post", "blesk_metaboxes_save", 10, 3);