// import {plotly} from "./plotly-latest.min.js";
// import * as Plotly from 'plotly-latest.min.js';

function toggle_menu(){
    var menu = document.getElementById("menu");
    if(menu.style.display == "block"){
        $("#menu").hide("slow");
    }else{
        $("#menu").show("slow");
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

function update_workout_success() {
    success = document.getElementById("update_success");
    success.style.visibility = "visible";
    setTimeout(function(){ success.style.visibility = "hidden"; }, 5000);
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

function display_workout() {
    document.getElementById("workout_form").style.display = "block";
    document.getElementById("submit_workout").style.display = "block";
    document.getElementById("workout_table_header").style.display = "contents";
}

function remove_workout() {
    document.getElementById("workout_form").style.display = "none";
    document.getElementById("submit_workout").style.display = "none";
    document.getElementById("workout_table_header").style.display = "none";
}

// function create_visual_graph(weight, date){
//     // var weight = <?php echo json_encode($weight);?>;
//     // var date = <?php echo json_encode($date);?>;
//     console.log(date);
//     console.log(weight);
//     console.log("hello");
//     // var data = [{x:date, y:weight, type:"line"}];
//     // var layout = {showlegend: false,xaxis: {rangemode: 'tozero',autorange: true},yaxis: {rangemode: 'tozero',autorange: true}};
//     // Plotly.newPlot('tester', data, layout);
// }

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