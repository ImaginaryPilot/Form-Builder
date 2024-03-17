<?php

$wp_load_path = dirname( dirname( dirname( dirname( dirname( __FILE__ ) ) ) ) ) . '/wp-load.php';

// Include WordPress core files if necessary
require_once($wp_load_path);

// Check if the request is POST
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    // Get the form ID to be deleted
    $form_id = isset($_POST['id']) ? $_POST['id'] : '';

    // Validate form ID
    if (!empty($form_id)) {
        // Sanitize input if necessary
        // $form_id = filter_var($form_id, FILTER_SANITIZE_NUMBER_INT);

        // Perform database operation to delete the row
        global $wpdb;
        $savedFormsTable = $wpdb->prefix . 'saved_forms';
        $result = $wpdb->delete($savedFormsTable, array('id' => $form_id));

        if ($result === false) {
            echo "Error: Failed to delete form.";
        } else {
            echo "Form deleted successfully!";
        }
    } else {
        echo "Error: Invalid form ID.";
    }
} else {
    echo "Error: Invalid request method.";
}
