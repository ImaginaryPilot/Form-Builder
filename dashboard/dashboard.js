function showDeletePopUp(event, formId){
    //get parent element
    var parentElement = event.parentElement

    // Show the overlay
    document.getElementById('overlay').style.display = 'block';

    // Add a class to the body to disable scrolling
    document.body.classList.add('disable-scroll');

    // Show the save pop-up
    document.getElementById('deletePopup').classList.remove('hide')

    // Get the button to confirm deletion
    var yesBtn = document.getElementById("yesBtn");
    
    // Get the button to cancel deletion
    var noBtn = document.getElementById("noBtn");

    // When the user clicks on Yes, close the modal and delete the parent div
    yesBtn.onclick = function() {
        closeDeletePopup()

        deleteForm(formId);

        // parentElement.parentElement.parentElement.remove()
    }

    // When the user clicks on No, close the modal
    noBtn.onclick = function() {
        closeDeletePopup()
    }
}

function deleteForm(formId) {

    // Send Ajax request to delete_row.php
    var xhr = new XMLHttpRequest();
    xhr.open('POST', "<?php echo plugins_url( 'delete_row.php', __FILE__ ); ?>", true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Optionally, reload the page or update the UI
            location.reload();
        } else {
            alert('Error: ' + xhr.statusText);
        }
    };
    xhr.onerror = function() {
        alert('Network Error');
    };
    xhr.send('id=' + encodeURIComponent(formId));

    closeDeletePopup();
}

function closeDeletePopup() {
    // Hide the overlay
    document.getElementById('overlay').style.display = 'none';

    // Remove the class to enable scrolling
    document.body.classList.remove('disable-scroll');

    // Hide the save pop-up
    document.getElementById('deletePopup').classList.add('hide')
}

function setActivate(event){
    var parentElement = event.parentElement

    var row = parentElement.parentElement.parentElement
    if(event.checked){
        // If checked, change the background color to blue
        row.style.backgroundColor = 'lightblue';
    } else {
        // If not checked, reset the background color
        row.style.backgroundColor = '';
    }
}

function redirect(){
    window.location.href = "<?php echo admin_url('admin.php?page=form-builder-add-new'); ?>";
}