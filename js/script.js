// Get the popup
var popup = document.getElementById("popupWindow");

// Get the button that opens the popup
var btn = document.getElementById("popupButton");

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
// When the user clicks anywhere outside the popup, close it

/// login 

var popup2 = document.getElementById("popupWindow2");
var btn2 = document.getElementById("popupButton2");
var span2 = document.getElementById("closeButton2");
btn2.onclick = function() {
    popup2.style.display = "block";
}
span2.onclick = function() {
    popup2.style.display = "none";
}

window.onclick = (event)=> {
    if (event.target == popup2) {
        popup2.style.display = "none";
    } else if (event.target == popup) {
        popup.style.display = "none";
    }
}