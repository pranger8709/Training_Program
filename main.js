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

function validate_passwords() {
    var x = document.forms["register_form"]["password"].value;
    var y = document.forms["register_form"]["confirm_password"].value;
    if (x != y) {
        success = document.getElementById("register_failed");
        document.getElementById("modal").style.display = "block";
        document.getElementById("register_page").style.display = "flex";
        document.getElementById("login_page").style.display = "none";
        success.style.display = "inline-grid";
        setTimeout(function(){ success.style.display = "none"; }, 5000);
      return false;
    }
}

function validate_change_passwords() {
    var x = document.forms["register_form"]["password"].value;
    var y = document.forms["register_form"]["confirm_password"].value;
    if (x != y) {
        success = document.getElementById("register_failed");
        success.style.display = "inline-grid";
        setTimeout(function(){ success.style.display = "none"; }, 5000);
      return false;
    }
}


function update_successful() {
    success = document.getElementById("update_success");
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}

function login_failed() {
    success = document.getElementById("login_failed");
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}

function no_account_found() {
    success = document.getElementById("no_account");
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}