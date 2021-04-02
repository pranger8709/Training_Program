function toggle_menu(){
    var menu = document.getElementById("menu");
    if(menu.style.display == "block"){
        menu.style.display = "none";
    }else{
        menu.style.display = "block";
    }
    
}

function mouse_toggle_menu(){
    var menu = document.getElementById("menu");
    menu.style.display = "none";
}


function open_modal_login(){
    document.getElementById("myModal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
}

function open_modal_register(){
    document.getElementById("myModal").style.display = "block";
    document.getElementById("register_page").style.display = "flex";
    document.getElementById("login_page").style.display = "none";
}

function close_modal_login(){
    document.getElementById("myModal").style.display = "none";
}

// // Get the <span> element that closes the modal
// var span = document.getElementsByClassName("close")[0];

// // When the user clicks on the button, open the modal
// btn.onclick = function() {
//   modal.style.display = "block";
// }

// // When the user clicks on <span> (x), close the modal
// span.onclick = function() {
//   modal.style.display = "none";
// }

// // When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }