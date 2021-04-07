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
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
}

function open_modal_register(){
    document.getElementById("modal").style.display = "block";
    document.getElementById("register_page").style.display = "flex";
    document.getElementById("login_page").style.display = "none";
}

function close_modal_login(){
    document.getElementById("modal").style.display = "none";
}