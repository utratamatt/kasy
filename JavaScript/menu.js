var menuState = document.getElementById("menu-checkbox");

setTimeout(function(){
    document.body.className="";
},1);

function checkState() {
        if(menuState.checked){
            localStorage.setItem("sidebar", "opened");
        }
        else{
            localStorage.setItem("sidebar", "closed");
        }
    }

if(localStorage.getItem("sidebar") == "opened") {
    document.getElementsByClassName("sidebar-position").style="left:0;";
    menuState.checked = true;
} else {
}
