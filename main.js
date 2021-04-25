//Shows and hides the menu
function toggle_menu(){
    var menu = document.getElementById("menu");
    if(menu.style.display == "block"){
        $("#menu").hide("slow");
    }else{
        $("#menu").show("slow");
    }
    
}

//on mouse leave this will trigger this function to execute
function mouse_toggle_menu(){
    var menu = document.getElementById("menu");
    menu.style.display = "none";
}

//Opens the Modal for Login 
function open_modal_login(){
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
}

//Opens the Modal for Registering
function open_modal_register(){
    document.getElementById("modal").style.display = "block";
    document.getElementById("register_page").style.display = "flex";
    document.getElementById("login_page").style.display = "none";
}

//Closes the modal for both Login and Register
function close_modal_login(){
    document.getElementById("modal").style.display = "none";
}

//Validates both passwords when registering. If both pass then it will proceed otherwise it will throw an error to the user
function validate_passwords() {
    var x = document.forms["register_form"]["password"].value;
    var y = document.forms["register_form"]["confirm_password"].value;
    if (x != y) {
        fail = document.getElementById("register_failed");
        document.getElementById("modal").style.display = "block";
        document.getElementById("register_page").style.display = "flex";
        document.getElementById("login_page").style.display = "none";
        fail.style.display = "inline-grid";
        setTimeout(function(){ fail.style.display = "none"; }, 5000);
      return false;
    }
}

//Validates passwords and throws an error if it does not match in Account Settings
function validate_change_passwords() {
    var x = document.forms["register_form"]["password"].value;
    var y = document.forms["register_form"]["confirm_password"].value;
    if (x != y) {
        fail = document.getElementById("register_failed");
        fail.style.display = "inline-grid";
        setTimeout(function(){ fail.style.display = "none"; }, 5000);
      return false;
    }
}

//If the update is successful on the Account Settings page the div will appear for 5 seconds
function update_successful() {
    success = document.getElementById("update_success");
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}

//Had to change the update successful function for another page but essentially does the same thing
function update_workout_success() {
    success = document.getElementById("update_success");
    success.style.visibility = "visible";
    setTimeout(function(){ success.style.visibility = "hidden"; }, 5000);
}

//If the login failed the div to display that will display for 5 seconds
function login_failed() {
    success = document.getElementById("login_failed");
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}

//If no account is found when trying to login then it will display that div for 5 seconds
function no_account_found() {
    success = document.getElementById("no_account");
    document.getElementById("modal").style.display = "block";
    document.getElementById("login_page").style.display = "flex";
    document.getElementById("register_page").style.display = "none";
    success.style.display = "inline-grid";
    setTimeout(function(){ success.style.display = "none"; }, 5000);
}

//Shows the workout div in Generate Workout page
function display_workout() {
    document.getElementById("workout_form").style.display = "block";
    document.getElementById("submit_workout").style.display = "block";
    document.getElementById("workout_table_header").style.display = "contents";
}

//Hides the workout div in Generate Workout page
function remove_workout() {
    document.getElementById("workout_form").style.display = "none";
    document.getElementById("submit_workout").style.display = "none";
    document.getElementById("workout_table_header").style.display = "none";
}

//Removes the exercises in a particular workout that is generated
function remove_exercise(exercise) {
    console.log(exercise);
    document.getElementById(exercise).remove();
}


//Shows the exercise list on the exercise stats page
function show_exercises(){
    var value = document.getElementById("area").value;
    console.log(value);

    if(value == "arms"){
        $("#shoulder").hide("slow");
        $("#chest").hide("slow");
        $("#leg").hide("slow");
        $("#back").hide("slow");
        $("#core").hide("slow");
        $("#arms").show("slow");
        $("#generate_submit").show("slow");
    }else if(value == "chest"){
        $("#arms").hide("slow");
        $("#shoulder").hide("slow");
        $("#leg").hide("slow");
        $("#back").hide("slow");
        $("#core").hide("slow");
        $("#chest").show("slow");
        $("#generate_submit").show("slow");
    }else if(value == "shoulder"){
        $("#chest").hide("slow");
        $("#arms").hide("slow");
        $("#leg").hide("slow");
        $("#back").hide("slow");
        $("#core").hide("slow");
        $("#shoulder").show("slow");
        $("#generate_submit").show("slow");
    }else if(value == "leg"){
        $("#chest").hide("slow");
        $("#arms").hide("slow");
        $("#shoulder").hide("slow");
        $("#back").hide("slow");
        $("#core").hide("slow");
        $("#leg").show("slow");
        $("#generate_submit").show("slow");
    }else if(value == "back"){
        $("#chest").hide("slow");
        $("#arms").hide("slow");
        $("#shoulder").hide("slow");
        $("#leg").hide("slow");
        $("#core").hide("slow");
        $("#back").show("slow");
        $("#generate_submit").show("slow");
    }
    else if(value == "core"){
        $("#chest").hide("slow");
        $("#arms").hide("slow");
        $("#shoulder").hide("slow");
        $("#leg").hide("slow");
        $("#back").hide("slow");
        $("#core").show("slow");
        $("#generate_submit").show("slow");
    }
}