// Get the popup
var popup = document.getElementById("popupWindow");

// Get the button that opens the popup
var btn = document.getElementById("popupButton2");

// Get the <span> element that closes the popup
var span = document.getElementById("closeButton");

// When the user clicks the button, open the popup 
btn.onclick = function() {
    popup.style.display = "block";
}

// When the user clicks on <span> (x), close the popup
span.onclick = function() {
    popup.style.display = "none";
}

// When the user clicks anywhere outside of the popup, close it
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}



// Get the popup
var popup2 = document.getElementById("popupWindow2");

// Get the button that opens the popup
var btn2 = document.getElementById("popupButton2");

// Get the <span> element that closes the popup
var span2 = document.getElementById("closeButton2");

// When the user clicks the button, open the popup 
btn2.onclick = function() {
    popup2.style.display = "block";
}

// When the user clicks on <span> (x), close the popup
span2.onclick = function() {
    popup2.style.display = "none";
}

// When the user clicks anywhere outside of the popup, close it
window.onclick = function(event) {
    if (event.target == popup) {
        popup.style.display = "none";
    }
}
