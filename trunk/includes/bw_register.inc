<?php // (C) Copyright Bobbing Wide 2012

/**
 * Register functions for custom post types, taxonomies and fields
 */
 
/**
 * singularize a plural string 
 * 
 * @param string $plural - a plural string - or anything with a 'stem'
 * @returns string $singular - the singularized version of the string
 * @uses bw_porter_stemmer if it exists
 *
 */
function bw_singularize( $plural ) {
  if ( function_exists( "bw_porter_stemmer" ) ) {
    $singular = bw_porter_stemmer( $plural ) ;
  } else {
    $singular = rtrim( $plural, 's' );
  }
  return( $singular );
}

/**
 * Register a custom post type using as many defaults as we can
 *
 * Refer to the WordPress codex or [bw_plug name='custom UI,types']
 *
  'capability_type' => $cpt_post_type["capability_type"],
  'description' => esc_html($cpt_post_type["description"]),
  'has_archive' => $cpt_has_archive,
  'hierarchical' => get_disp_boolean($cpt_post_type["hierarchical"]),   
  'label' => __($cpt_label),
  'labels' => $cpt_labels
  'menu_position' => $cpt_menu_position,
  'public' => get_disp_boolean($cpt_post_type["public"]),
  'query_var' => get_disp_boolean($cpt_post_type["query_var"]),
  'rewrite' => array('slug' => $cpt_rewrite_slug),
  'show_in_menu' => $cpt_show_in_menu,
  'show_ui' => get_disp_boolean($cpt_post_type["show_ui"]),
  'singular_label' => $cpt_post_type["singular_label"],
  'supports' => $cpt_supports,
  'taxonomies' => $cpt_taxonomies,
 * @arguments                         
 * label - optional - default $post_type
 * labels - optional 
 
 * Register a post type. Do not use before init.
 *
 * A function for creating or modifying a post type based on the
 * parameters given. The function will accept an array (second optional
 * parameter), along with a string for the post type name.
 *
 * Optional $args contents:
 *
 * - label - Name of the post type shown in the menu. Usually plural. If not set, labels['name'] will be used.
 * - description - A short descriptive summary of what the post type is. Defaults to blank.
 * - public - Whether posts of this type should be shown in the admin UI. Defaults to false.
 * - exclude_from_search - Whether to exclude posts with this post type from search results.
 *     Defaults to true if the type is not public, false if the type is public.
 * - publicly_queryable - Whether post_type queries can be performed from the front page.
 *     Defaults to whatever public is set as.
 * - show_ui - Whether to generate a default UI for managing this post type. Defaults to true
 *     if the type is public, false if the type is not public.
 * - show_in_menu - Where to show the post type in the admin menu. True for a top level menu,
 *     false for no menu, or can be a top level page like 'tools.php' or 'edit.php?post_type=page'.
 *     show_ui must be true.
 * - menu_position - The position in the menu order the post type should appear. Defaults to the bottom.
 * - menu_icon - The url to the icon to be used for this menu. Defaults to use the posts icon.
 * - capability_type - The string to use to build the read, edit, and delete capabilities. Defaults to 'post'.
 *   May be passed as an array to allow for alternative plurals when using this argument as a base to construct the
 *   capabilities, e.g. array('story', 'stories').
 * - capabilities - Array of capabilities for this post type. By default the capability_type is used
 *      as a base to construct capabilities. You can see accepted values in {@link get_post_type_capabilities()}.
 * - map_meta_cap - Whether to use the internal default meta capability handling. Defaults to false.
 * - hierarchical - Whether the post type is hierarchical. Defaults to false.
 * - supports - An alias for calling add_post_type_support() directly. See {@link add_post_type_support()}
 *     for documentation. Defaults to none.
 * - register_meta_box_cb - Provide a callback function that will be called when setting up the
 *     meta boxes for the edit form.  Do remove_meta_box() and add_meta_box() calls in the callback.
 * - taxonomies - An array of taxonomy identifiers that will be registered for the post type.
 *     Default is no taxonomies. Taxonomies can be registered later with register_taxonomy() or
 *     register_taxonomy_for_object_type().
 * - labels - An array of labels for this post type. By default post labels are used for non-hierarchical
 *     types and page labels for hierarchical ones. You can see accepted values in {@link get_post_type_labels()}.
 * - permalink_epmask - The default rewrite endpoint bitmasks.
 * - has_archive - True to enable post type archives. Will generate the proper rewrite rules if rewrite is enabled.
 * - rewrite - false to prevent rewrite. Defaults to true. Use array('slug'=>$slug) to customize permastruct;
 *     default will use $post_type as slug. Other options include 'with_front', 'feeds', and 'pages'.
 * - query_var - false to prevent queries, or string to value of the query var to use for this post type
 * - can_export - true allows this post type to be exported.
 * - show_in_nav_menus - true makes this post type available for selection in navigation menus.
 * - _builtin - true if this post type is a native or "built-in" post_type. THIS IS FOR INTERNAL USE ONLY!
 * - _edit_link - URL segement to use for edit link of this post type. THIS IS FOR INTERNAL USE ONLY!
 */
function bw_register_post_type( $post_type, $post_type_args ) {
  $post_type_args['public'] = bw_array_get( $post_type_args, 'public', true );
  $post_type_args['query_var'] = bw_array_get( $post_type_args, 'query_var', $post_type );
  $post_type_args['label'] = bw_array_get_dcb( $post_type_args, 'label', $post_type, "ucfirst"  );
  $post_type_args['singular_label'] = bw_array_get_dcb( $post_type_args, 'singular_label', $post_type_args['label'] , "bw_singularize" );
  $post_type_args['labels'] = bw_array_get_dcb( $post_type_args, 'labels', array( 'singular_name' => $post_type_args['singular_label'], 'name' => $post_type_args['label'] ) , "bw_default_labels" );
  register_post_type( $post_type, $post_type_args );
}

/**
 * Attempt to set labels given the 'name' and/or 'singular_name'
 * 
 * When the singular_name is not just the name without the last 's' then you need to set the singular_name yourself 
 * OR let the Porter Stemmer algorithm come up with a solution.
 *
 * @uses bw_singularize
 */
function bw_default_labels( $labels= array() ) {
  $ucplural = bw_array_get_dcb( $labels, 'name', 'Post', "ucfirst" );
  $lcplural = strtolower( $ucplural );
  
  $labels['name'] = bw_array_get( $labels, 'name', $ucplural );
  $labels['menu_name'] = bw_array_get( $labels, 'menu_name', $ucplural );
  $ucsingular = bw_array_get_dcb( $labels, 'singular_name', $ucplural, "bw_singularize" );
  $labels['singular_name'] = $ucsingular; 
  $labels['all_items'] = bw_array_get( $labels, 'all_items', "All $ucplural" );
  $labels['add_new'] = bw_array_get( $labels, 'add_new', "New $ucsingular" );
  $labels['add_new_item'] = bw_array_get( $labels, 'add_new_item', "Create New $ucsingular" );
  $labels['edit'] = bw_array_get( $labels, 'edit', "Edit" );
  $labels['edit_item'] = bw_array_get( $labels, 'edit_item', "Edit $ucsingular" );
  $labels['new_item'] = bw_array_get( $labels, 'new_item', "New $ucsingular" );
  $labels['view'] = bw_array_get( $labels, 'view', "View $ucsingular" );
  $labels['view_item'] = bw_array_get( $labels, 'view_item', "View $ucsingular" );
  $labels['search_items'] = bw_array_get( $labels, 'search_items', "View $ucplural" );
  $labels['not_found'] = bw_array_get( $labels, 'not_found', "No $lcplural found" );
  $labels['not_found_in_trash'] = bw_array_get( $labels, 'not_found_in_trash', "No $lcplural found in Trash" ); 
  // 'parent_item_colon'  => __( 'Forum:',                   'bbpress' )

  // should each array element now be translated? 
  return( $labels );
}  

/**
 * Register a custom taxonomy 
 * 
 * Currently this is a simple wrapper to register_taxonomy
 * 
 */
function bw_register_taxonomy( $taxonomy, $object_type=NULL, $args=NULL ) {
  register_taxonomy( $taxonomy, $object_type, $args );
}


/** 
 * Register a field named $field_name for object type $object_type
 * 
 * @param string $field_name - meta_key of the field - precede with an underscore so it's not in custom fields
 * @param string $object_type - object type
 */
function bw_register_field_for_object_type( $field_name, $object_type ) {
  global $bw_mapping;
  //$bw_mapping = get_option( 'bw_mapping' );
  
  $bw_mapping['field'][$object_type][$field_name] = $field_name;
  $bw_mapping['type'][$field_name][$object_type] = $object_type;

  //update_option( 'bw_mapping', $bw_mapping );
  //bw_trace2( $bw_mapping );
}  

/** 
 * Register a field named $field_name of type $field_type with title $field_title and additional values $args
 * 
 * @param string $field_name - meta_key of the field - precede with an underscore so it's not in custom fields
 * @param string $field_type - type of field e.g. text, textarea, radio button
 * @param string $field_title - title of the field
 * @param string $args - $field_type specific values
 *   these could include:
 *   #length - for text fields
 *   #validate - for any field
 *   #type - for noderef 
 *   #options - for select 
 */
function bw_register_field( $field_name, $field_type, $field_title, $args=NULL ) {
  global $bw_fields;
  //$bw_fields = get_option( 'bw_fields' );
  $data = array( '#field_type' => $field_type,
                 '#title' => $field_title, 
                 '#args' => $args, 
               );
               
  $bw_fields[$field_name] = $data;
  //update_option( 'bw_fields', $bw_fields );
  //bw_trace2( $bw_fields ); 
}

 
  

