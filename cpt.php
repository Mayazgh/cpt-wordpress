
//projects-cpt
function projects_custom_post_type() {
    $labels = array(
        'name'                => __( 'Projects' ),
        'singular_name'       => __( 'Project'),
        'menu_name'           => __( 'Projects'),
        'parent_item_colon'   => __( 'Parent Project'),
        'all_items'           => __( 'All Projects'),
        'view_item'           => __( 'View Project'),
        'add_new_item'        => __( 'Add New Project'),
        'add_new'             => __( 'Add New'),
        'edit_item'           => __( 'Edit Project'),
        'update_item'         => __( 'Update Project'),
        'search_items'        => __( 'Search Project'),
        'not_found'           => __( 'Not Found'),
        'not_found_in_trash'  => __( 'Not found in Trash')
    );
    $args = array(
        'label'               => __( 'Projects'),
        'description'         => __( 'Projects'),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'thumbnail'),
        'public'              => true,
        'hierarchical'        => false,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'has_archive'         => true,
        'can_export'          => true,
        'exclude_from_search' => false,
            'yarpp_support'       => true,
//         'taxonomies'           => array('post_tag'),
        'publicly_queryable'  => true,
        'capability_type'     => 'page'
);
    register_post_type( 'Projects', $args );
}
add_action( 'init', 'projects_custom_post_type', 0 );

// taxonomy for cpt
add_action( 'init', 'create_projects_custom_taxonomy', 0 );
function create_projects_custom_taxonomy() {
  $labels = array(
    'name' => _x( 'Categories', 'taxonomy general name' ),
    'singular_name' => _x( 'Category', 'taxonomy singular name' ),
    'search_items' =>  __( 'Search Categories' ),
    'all_items' => __( 'All Categories' ),
    'parent_item' => __( 'Parent Category' ),
    'parent_item_colon' => __( 'Parent Category:' ),
    'edit_item' => __( 'Edit Category' ), 
    'update_item' => __( 'Update Category' ),
    'add_new_item' => __( 'Add New Category' ),
    'new_item_name' => __( 'New Category Name' ),
    'menu_name' => __( 'Categories' ),
  );     
  register_taxonomy('categories',array('projects'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => 'category' ),
  ));
}

//shortcode
  
function shortcode_projects_post_type(){
  $result = '';
    $args = array(
                    'post_type'      => 'projects', 
                    'posts_per_page' => '-1',
                    'publish_status' => 'published',
                 );
  
    $query = new WP_Query($args);
  
    if($query->have_posts()) :
  
        while($query->have_posts()) :
  
            $query->the_post() ;
                      
        $result .= '<div class="project-item">';
        $result .= '<div class="project-poster">' . get_the_post_thumbnail() . '</div>';
        $result .= '<div class="project-name">' . get_the_title() . '</div>';
        $result .= '<div class="movie-desc">' . get_the_content() . '</div>'; 
        $result .= '</div>';
  
        endwhile;
  
        wp_reset_postdata();
  
    endif;    
  
    return $result;            
}
  
add_shortcode( 'projects-list', 'shortcode_projects_post_type' ); 
  