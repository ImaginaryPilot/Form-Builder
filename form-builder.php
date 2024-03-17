<?php
/**
 * Plugin name: Form-Builder
 * Description: Create your own unique form using the builder
 * Version: 1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if(!class_exists('FormBuilder')) {
    class FormBuilder {
        public function __construct(){
            add_action('admin_menu', array($this, 'add_custom_menu_item'));
            add_action('admin_init', array($this, 'load_dashboard'));

            add_action('wp_enqueue_scripts', array($this, 'enqueue_plugin_dependencies'));
            
            add_action('wp_ajax_save_form', array($this, 'save_form_callback'));
            add_action('wp_ajax_nopriv_save_form', array($this,'save_form_callback'));

            register_activation_hook( __FILE__, array($this, 'create_saved_forms_table'));
            register_deactivation_hook( __FILE__, array($this, 'delete_saved_forms_table'));

            add_shortcode( 'form-builder', array($this, 'form_builder_shortcode'));
        }

        function enqueue_plugin_dependencies(){

            // css
            wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css');
            wp_enqueue_style('fonts', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'); 

            wp_enqueue_style( 
                'add-form', 
                plugin_dir_url(__FILE__) . 'addform/boilerplate.css', 
                array(), 
                1, 
                'all' 
            );
        }

        function form_builder_shortcode($atts){
            // load wp_load.php file
            require_once(ABSPATH . "wp-load.php");

            wp_dequeue_script('add-form-js');

            wp_enqueue_style('bootstrap');
            wp_enqueue_style('fonts');
            wp_enqueue_style('add-form');

            // Extract shortcode attributes
            $atts = shortcode_atts(array(         
                'id' => '', // Default value if 'id' attribute is not provided     
            ), $atts);
            
            // Get the ID attribute from the shortcode
            $id = $atts['id'];     // Check if ID is provided
            if (empty($id)) {         
                return "Please provide an ID for the form-builder shortcode.";     
            }     // Load the row from the database based on ID

            global $wpdb;     
            $savedFormTable = $wpdb->prefix . 'saved_forms';
            
            $temp = "SELECT * FROM $savedFormTable WHERE id = " . $id;
            
            $row = $wpdb->get_row($wpdb->prepare($temp), ARRAY_A);

            // If no row found, return an error message
            if (!$row) {         
                return "Form with ID $id not found.";     
            }     
            
            // Display the HTML from the database
            return $row['dom'];
        }

        function delete_saved_forms_table(){
            global $wpdb;     
            $savedFormsTable = $wpdb->prefix . 'saved_forms';     
            
            $wpdb->query("DROP TABLE IF EXISTS $savedFormsTable");
        }

        function create_saved_forms_table(){
            global $wpdb;
            $savedFormsTable = $wpdb -> prefix . 'saved_forms'; 

            $charset_collate = $wpdb -> get_charset_collate();

            // SQL statement to create the table
            $sql = "CREATE TABLE IF NOT EXISTS $savedFormsTable (         
            id mediumint(9) NOT NULL AUTO_INCREMENT,        
            title varchar(255) NOT NULL,         
            filename varchar(255) NOT NULL,         
            dom longtext NOT NULL,         
            PRIMARY KEY  (id)     
            ) $charset_collate;";     
            
            require_once(ABSPATH . 'wp-admin/includes/upgrade.php');     
            dbDelta($sql);
        }

        // Loading Assets
        public function load_assets(){

            wp_localize_script(
                'add-form-js', 
                'ajax_object', 
                array('ajax_url' => admin_url('admin-ajax.php'))
            );

            // dashboard css
            wp_enqueue_style( 
                'add-form', 
                plugin_dir_url(__FILE__) . 'dashboard/dashboard.css', 
                array(), 
                1, 
                'all' 
            );

            // addform css
            wp_enqueue_style( 
                'add-form', 
                plugin_dir_url(__FILE__) . 'addform/boilerplate.css', 
                array(), 
                1, 
                'all' 
            );

            // dashboard.js
            wp_enqueue_script(
                'dashboard-js',
                plugin_dir_url(__FILE__) . 'dashboard/dashboard.js',
                array(),
                1, 
                true
            );

            // addform
            wp_enqueue_script(
                'add-form-js',
                plugin_dir_url(__FILE__) . 'addform/boilerplate.js',
                array(),
                1, 
                true
            );
        }

        // Creating Menu and Submenu in admin section
        public function add_custom_menu_item() {
            add_menu_page(
                'Form Builder',                    // Page title
                'Form Builder',                    // Menu title
                'manage_options',                  // Capability
                'form-builder',                    // Menu slug
                array($this, 'load_dashboard'), // Callback function to render the menu page
                'dashicons-table-col-before',      // Icon
                80                                 // Position
            );

            // Add submenus
            add_submenu_page(
                'form-builder',                    // Parent slug
                'Dashboard',                       // Page title
                'Dashboard',                       // Menu title
                'manage_options',                  // Capability
                'form-builder',                    // Menu slug
                array($this, 'load_dashboard'), // Callback function
                1
            );

            add_submenu_page(
                'form-builder',                    // Parent slug
                'Add New',                         // Page title
                'Add New',                         // Menu title
                'manage_options',                  // Capability
                'form-builder-add-new',            // Menu slug
                array($this, 'load_custom_form_builder_page') // Callback function
            );
        }

        // Loading the Dashboard
        public function load_dashboard() {
            // Check if the current page is admin.php?page=form-builder
            if (isset($_GET['page']) && $_GET['page'] === 'form-builder') {
                // Enqueue CSS and JavaScript files
                $this->load_assets();

                // Include the custom page template
                include_once(plugin_dir_path(__FILE__) . 'dashboard/dashboard.php');
                // Stop further execution
                exit;
            }
        }

        // Loading the Add New page
        public function load_custom_form_builder_page() {
            // Check if the current page is admin.php?page=form-builder
            if (isset($_GET['page']) && $_GET['page'] === 'form-builder-add-new') {
                // Enqueue CSS and JavaScript files
                $this->load_assets();

                // Include the custom page template without admin header and footer
                include_once(plugin_dir_path(__FILE__) . 'addform/boilerplate.php');
                // Stop further execution
                exit;
            }
        }

        // Loading the submissions page
        public function render_submissions_page() {
            // Retrieve list of forms and their shortcodes
            $forms = array(
                'Form 1' => '[form_shortcode_1]',
                'Form 2' => '[form_shortcode_2]',
                // Add more forms as needed
            );
        
            // Output dropdown menu
            ?>
            <div class="wrap">
                <h1><?php esc_html_e('Submissions', 'textdomain'); ?></h1>
                <form method="post" action="">
                    <label for="form_dropdown"><?php esc_html_e('Select Form:', 'textdomain'); ?></label>
                    <select name="form_dropdown" id="form_dropdown">
                        <?php foreach ($forms as $name => $shortcode) : ?>
                            <option value="<?php echo esc_attr($shortcode); ?>"><?php echo esc_html($name); ?></option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
            <?php
        }

        // save form callback function
        function save_form_callback(){
            if($_SERVER["REQUEST_METHOD"] == 'POST') {

                echo (ABSPATH . "wp-load.php");

                // load wp_load.php file
                require_once(ABSPATH . "wp-load.php");

                // get global variable
                global $wpdb;
                
                $title = $_POST['title'];
                $filename = $_POST['filename'];
                $dom = urldecode($_POST['dom']);
                $html = str_replace("\\", '', $dom);

                // Prepare data for insertion
                $data = array(         
                    'title' => $title,         
                    'filename' => $filename,  // Assuming a static value for example
                    'dom' => $html  // Assuming a static value for example    
                );     

                // Table name with prefix
                $savedFormsTable = $wpdb->prefix . 'saved_forms'; 

                // Insert data into the table
                $wpdb->insert($savedFormsTable, $data);     

                // Check if the insertion was successful
                if ($wpdb->last_error) {         
                    echo "Error: " . $wpdb->last_error;     
                } else {         
                    echo "Data inserted successfully!";     
                }
            }

            wp_die();
        }
    }

new FormBuilder;
}