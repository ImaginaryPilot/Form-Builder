// Global Variables
var searchInput;

var draggablesCol;

var rows;
var editRows;
var editRowsClass;
var placeholderRow;

var sideBar;
var form;

//when loaded, automatically scrolls to the top
window.onload = function () {
    window.scrollTo(0, 0);
}

const loadConst = function(){
    // search bar
    searchInput = document.querySelector("[data-search]")

    // all draggable columns
    draggablesCol = document.querySelectorAll('.col.drag-col')

    // Rows
    rows = document.querySelectorAll('.row.drag-row')
    editRows = document.querySelectorAll('#editRow')
    editRowsClass = document.querySelectorAll('.row.edit-row')
    placeholderRow = document.querySelector('#placeholderRow')

    // sidebar and form
    form = document.querySelector('#form')
    sidePanel = document.querySelector('#sidebar')
}

// invoke loadConst() to find elements
loadConst();

// function responsible for search bar
const search = function() {
    searchInput.addEventListener("input", e => {

        // gets search input
        const value = e.target.value.toLowerCase()

        rows.forEach(row => {
            // check if the row contains the search input
            const isVisible = row.id.toLowerCase().includes(value)
            
            // toggle hide class
            row.classList.toggle("hide", !isVisible)
        })
    })
}

search();

const dragCol = function(){
    //Drag event listener for divs
    draggablesCol.forEach(draggable => {
        // adding a dragstart eventlistener for each drag-col
        draggable.addEventListener('dragstart', () => {

            // added a class called dragging to each drag-col
            draggable.classList.add('dragging')

            // the placeholderRow is now visible
            placeholderRow.classList.remove("hide")

            // for every row, we add highlight class, which shows the border
            editRows.forEach(editrow => {
                editrow.classList.add('highlight')
            });
        })

        // adding a dragend eventlistener for each drag-col
        draggable.addEventListener('dragend', () => {

            // removed a class called dragging to each drag-col
            draggable.classList.remove('dragging')

            // the placeholderRow is now hidden
            placeholderRow.classList.add("hide")

            // for every row, we remove highlight class
            editRows.forEach(editrow => {
                editrow.classList.remove('highlight')
            });
        })
    })

    //each div drag function
    editRowsClass.forEach(row => {

        // add dragover listener to each row
        row.addEventListener('dragover', e => {

            // possibility of cancelling drag
            e.preventDefault()

            // constants 
            const afterElement = getDragAfterElement(row, e.clientX)
            const draggable = document.querySelector('.dragging')
            
            // checking where to append/insert
            if(afterElement == null){
                row.appendChild(draggable)
            } else{
                row.insertBefore(draggable, afterElement)
            }
        })
    })
}

dragCol();

//calculting offset between divs
function getDragAfterElement(row, x) {
    // get all elements that don't have the the dragging class
    const draggableElements = [...row.querySelectorAll('.col.drag-col:not(.dragging)')]

    return draggableElements.reduce((closest, child) => {
        // set box variable and data
        const box = child.getBoundingClientRect()

        // calculate offset
        const offset = x - box.left - box.width / 2
        if (offset < 0 && offset > closest.offset) {
            return { offset: offset, element: child}
        }
        else{
            return closest
        }
    }, {offset: Number.NEGATIVE_INFINITY}).element 
}

//Adding new rows 
placeholderRow.addEventListener('drop', removePlaceholder);
placeholderRow.addEventListener('dragover', (event) => event.preventDefault());

// removing current placeholder row
function removePlaceholder(event){
    event.preventDefault();
    event.stopPropagation();

    // convert placeholder to editRow
    event.currentTarget.removeAttribute('id')
    event.currentTarget.id = "editRow"
    event.currentTarget.classList.add("trashRow")
    event.currentTarget.setAttribute('onmouseover', 'handleMouseOver(this)')
    event.currentTarget.setAttribute('onclick', 'removeRow(this)')
    
    // adds a new placeholder
    addNewPlaceholder()
}

// add a new placeholder
function addNewPlaceholder(){
    // checks all placeholderRows
    const existingPlaceholder = document.getElementById('placeholderRow');

    // if there already exists a placeholder, then we don't add a new one
    if(!existingPlaceholder){
        // creating new div
        const newDiv = document.createElement("div");

        // assign classes and id
        newDiv.classList.add("row", "edit-row");
        newDiv.id = "placeholderRow"

        // adds eventlisteners
        newDiv.addEventListener('drop', removePlaceholder);
        newDiv.addEventListener('dragover', (event) => event.preventDefault());

        // appends to the form
        form.append(newDiv);

        // Re-initialize your constants and functions
        loadConst();
        dragCol();
    }
}

// when hovering over row, we show trash icon
function showTrashIcon(event) {
    if(form.contains(event)){
        // get trash icon
        const trashIcon = event.getElementsByTagName('i')[0];

        // make it visible
        trashIcon.classList.remove('hide')
    }
}

// when NOT hovering over row, we hide trash icon
function hideTrashIcon(event) {
    if(form.contains(event)){
        // get trash icon
        const trashIcon = event.getElementsByTagName('i')[0];

        // hide it
        trashIcon.classList.add('hide')
    }
}
// deleteing element
function remove(event){
    if(form.contains(event)){
        var parentElement = event.parentElement

        parentElement.parentElement.remove()
    }
}

// removing row within form
function removeRow(event){
    if (event.childElementCount > 0) {
        
    } else {
        event.remove()
    }
}

// adding/removing hover to delete row
function handleMouseOver(event) {
    if (event.childElementCount > 0) {
        event.classList.remove("trashRow")
    } else {
        event.classList.add("trashRow")
    }
}

// hiding Sidebar
function hideSidebar(event){
    const parent = event.parentElement
    parent.classList.add("hide")
    const addButton = document.querySelector("#addButton")
    addButton.classList.remove("hide")
}

function showSidebar(event){
    const sidebar = document.querySelector('#sidebar')
    sidebar.classList.remove("hide")
    event.classList.add("hide")
}

function showSavePopup() {
    // Show the overlay
    document.getElementById('overlay').style.display = 'block';

    // Add a class to the body to disable scrolling
    document.body.classList.add('disable-scroll');

    // Show the save pop-up
    document.getElementById('savePopup').classList.remove('hide')
}

function closeSavePopup() {
    // Hide the overlay
    document.getElementById('overlay').style.display = 'none';

    // Remove the class to enable scrolling
    document.body.classList.remove('disable-scroll');

    // Hide the save pop-up
    document.getElementById('savePopup').classList.add('hide')
}

function saveChanges() {
    const fileName = document.getElementById('inputSaveFileName').value

    const navbarName = document.getElementById('FilenameOnNavbar')

    navbarName.textContent = fileName

    // Select the div element by its id
    const filenameDiv = document.getElementById('fileNameDiv');

    // Set the text content of the div to the shortcode value
    filenameDiv.textContent = fileName;

    // savedForm
    var savedForm = document.getElementById('savedForm')

    // savedTitle
    var savedTitle = document.getElementById('savedTitle');

    // Get the next sibling of the savedTitle element
    var nextSibling = savedTitle.nextSibling;

    // Loop through each child of the parent div
    while (nextSibling) {
        // Remove the child
        savedForm.removeChild(nextSibling);
        // Update the reference to the next sibling
        nextSibling = savedTitle.nextSibling;
    }

    editRows.forEach(row => {
        if(row.children.length > 0){
            // Clone new row
            var clonedRow = row.cloneNode(true)
        
            // Remove Row functionalities
            clonedRow.removeAttribute('draggable');
            clonedRow.removeAttribute('onmouseover');
            clonedRow.removeAttribute('onclick');
            clonedRow.className = "row save-row";
            clonedRow.id = "savedRow";

            // get all children elements
            var children = clonedRow.children;

            // Loop through each child and modify its class
            for (var i = 0; i < children.length; i++) {
                var col = children[i];
                // Modify the class of the child
                if(col.classList.contains("input-group")) {
                    col.classList.remove("drag-col")
                    col.classList.add("save-col", "input-group")
                } else if (col.classList.contains("form-switch")){
                    col.classList.remove("drag-col")
                    col.classList.add("save-col", "form-switch")
                } else{
                    col.className = "col save-col";
                }
                col.draggable = false;
                col.removeAttribute('onmouseover');
                col.removeAttribute('onmouseout');

                // get all children elements
                var colChildren = col.children;

                // Loop through each child of the column and remove unnecessary functionalities
                for (var j = 0; j < colChildren.length; j++) {
                    var child = colChildren[j];

                    child.contentEditable = false;
                    if (child.classList.contains('trash')) {
                        col.removeChild(child); // Remove the child element
                    }
                }

                col.querySelectorAll('.grab').forEach(function(el) {
                    el.classList.remove('grab');
                });
            }

            savedForm.appendChild(clonedRow)
        }
    })

    // Optional: You can also change the title on the saved side if needed
    savedTitle.innerText = document.getElementById('form').querySelector('h2').innerText;

    closeSavePopup()

    const savedScreen = document.getElementById('savedScreen')
    
    savedScreen.classList.remove('hide')
}

(function() {     
    document.addEventListener("DOMContentLoaded", function() {         
        document.getElementById("SaveFormButton").addEventListener("click", function() {   
            
            var xhr = new XMLHttpRequest();             
            xhr.open("POST", "admin-ajax.php", true);             
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");             
            xhr.onreadystatechange = function() {                 
                if (xhr.readyState === 4 && xhr.status === 200) {                     
                    console.log(xhr.responseText); 
                    // Handle the response                
                }             
            };    
            
            // Getting title and filename
            var title = document.getElementById('savedTitle').innerText;
            var filename = document.getElementById('fileNameDiv').innerText;
            var htmlContent = document.getElementById('savedSection').innerHTML;
            var encodedHTML = encodeURIComponent(htmlContent);

            // You can send data to the PHP file if needed
            var data = `action=save_form&title=${title}&filename=${filename}&dom=${encodedHTML}`;             
            xhr.send(data);         
        });     
    }); 
})();

// Title limiting characters
function limitCharacters(element, maxLength) {
    const currentText = element.innerText;
    const previousText = element.getAttribute('data-previous') || '';

    if (currentText.length > maxLength) {
        element.innerText = previousText; // Restore previous content
    } else {
        element.setAttribute('data-previous', currentText); // Save current content
    }
}