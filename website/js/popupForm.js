var hidden = true;

var popupDiv = document.getElementById("popupDiv");
var nameInput = document.getElementById("titleandname");

function togglePopup(name, show = null) {
    nameInput.value = name;

    hidden = (show == null) ? !hidden : !show;

    if (hidden) {
        popupDiv.classList.add("Hidden")
    } else {
        popupDiv.classList.remove("Hidden")
    }
}