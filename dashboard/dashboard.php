<?php
// Load wp-load.php
require_once(ABSPATH . 'wp-load.php');

// Include WordPress admin header
require_once(ABSPATH . 'wp-admin/admin-header.php'); 

// Get the global wordpress database
global $wpdb;

// Get the table containing the saved forms
$savedFormsTable = $wpdb->prefix . 'saved_forms';

// Get rows from the saved forms table
$results = $wpdb->get_results("SELECT * FROM $savedFormsTable", ARRAY_A);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <style>
        <?php include "dashboard.css" ?>
    </style>
    <body>
        <!--Div containing everything else-->
        <div class="container-fluid" id="main-plugin-container">
            <!--An overlay/grey screen appearing when clicking Save button on top right of the screen-->
            <div class="overlay" id="overlay"></div>

            <!--Pop up that appears after clicking the Save button-->
            <div class="deletePopup hide" id="deletePopup">
                <div class="row" style="flex-direction: row;">
                    <div class="col">
                        <h5 class="deleteFormTitle">Delete Form?</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col PopupButton">
                        <button type="button" class="btn btn-primary mb-3" id="yesBtn" style="background-color: red; float:down; width: 125px; margin-top: 75px;">Yes</button>
                    </div>
                    <div class="col PopupButton">
                        <button type="button" class="btn btn-primary mb-3" id="noBtn" style="background-color: green; float: down; width: 125px; margin-top: 75px;">No</button>
                    </div>
                </div>
            </div>

            <!--Using flexbox to create 1 row overseeing the form editor-->
            <div class="row main-row">
                <h1>Dashboard</h1>
                <div class="row" id="addButton" onclick="redirect()">
                    <!--Done button that opens/closes the sidebar-->
                    <button type="button" class="btn btn-primary mb-3">Add New</button>
                </div>
                <div class="row" id="tableContent">
                    <table>
                        <tr>
                            <th id="tableTitle">Title</th>
                            <th id="tableShortCode">ShortCode</th>
                            <th id="tableActivate" style="text-align: center;">Activate</th>
                            <th id="tableDelete" style="text-align: center;">Delete</th>
                        </tr>
                        <?php foreach($results as $row):?>
                        <tr id="NewFormItem">
                            <td id="formTitle"><?= $row['filename'] ?></td>
                            <td id="formShortCode"><?= "[form-builder id=" . $row['id'] . "]"?></td>
                            <td id="formActivate">
                                <div class="col" id="check" draggable="true" style="text-align: center;">
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="setActivate(this)">
                                </div>
                            </td>
                            <td id="formDelete">
                                <div class="col" style="text-align: center;">
                                    <i class="deleteIcon fa fa-trash-o click" id="trash" onclick="showDeletePopUp(this, <?= $row['id']?>)"></i>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach;?>
                    </table>
                </div>
            </div>
        </div>
        <script>
            <?php include "dashboard.js" ?>
        </script>
    </body>
</html>