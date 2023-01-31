var userWindow = document.getElementById("user-details-window");
var userIcon = document.querySelector('#logged-user-icon i')

userWindow.style.setProperty('display', 'none');

function managePopupWindow(){
    if(userWindow.style.getPropertyValue('display') == 'none'){
        userWindow.style.setProperty('display', 'block');
        userIcon.style.setProperty('color', '#002b59');
    }
    else{
        userWindow.style.setProperty('display', 'none');
        userIcon.style.removeProperty('color', '#002b59');
    }
}