function openSubmenu(event, submenu) {
  menuItem = document.getElementsByClassName("menuItem");
  for (i = 0; i < menuItem.length; i++) {
    menuItem[i].style.display = "none";
  }

  menuButton = document.getElementsByClassName("menuButton");
  for (i = 0; i < menuButton.length; i++) {
    menuButton[i].className = menuButton[i].className.replace(" active", "");
  }

  document.getElementById(submenu).style.display = "block";
  event.currentTarget.className += " active";
}
function autoHide() {
  menuItems = document.getElementsByClassName("menuItem");
  for (i = 0; i < menuItems.length; i++) {
    menuItems[i].style.display = "none";
  }
  submenuContents = document.getElementsByClassName("submenuContent");
  for (i = 0; i < submenuContents.length; i++) {
    submenuContents[i].style.display = "none";
  }
}
function openContent(event, content){
  submenuContents = document.getElementsByClassName("submenuContent");
  for (i = 0; i < submenuContents.length; i++) {
    submenuContents[i].style.display = "none";
  }

  submenuButtons = document.getElementsByClassName("submenuButton");
  for (i = 0; i < submenuButtons.length; i++) {
    submenuButtons[i].className = submenuButtons[i].className.replace(" active", "");
  }

  document.getElementById(content).style.display = "block";
  event.currentTarget.className += " active";
}
window.onload = autoHide;
