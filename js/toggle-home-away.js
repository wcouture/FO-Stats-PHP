var last_click = "";
var toggle_hidden = false;

function handle_toggle(toggle_name) {
    var element_list = document.getElementsByClassName("games-card");
    
    if (toggle_name != last_click) {
        last_click = "";
        toggle_hidden = false;
        for (let i = 0; i < element_list.length; i++) {
            let element = element_list[i];
            if (element.className.includes("home")){
                element.className = "games-card home";
            }
            else {
                element.className = "games-card";
            }
        }
    }

    if (toggle_name == "home") {
        for(let i = 0 ; i < element_list.length; i++) {
            if (element_list[i].className.includes("home")) {
                continue;
            }

            if (last_click == "home" && toggle_hidden) {
                element_list[i].className = "games-card";
            }
            else {
                element_list[i].className = "games-card hidden";
            }
        }
        last_click = "home";
        toggle_hidden = !toggle_hidden;
    }

    else if (toggle_name == "away") {
        for(let i = 0 ; i < element_list.length; i++) {
            if (!element_list[i].className.includes("home")) {
                continue;
            }

            if (last_click == "away" && toggle_hidden) {
                element_list[i].className = "games-card home";
            }
            else {
                element_list[i].className = "games-card home hidden";
            }
        }
        last_click = "away";
        toggle_hidden = !toggle_hidden;
    }

    if (last_click == "home") {
        let class_name = toggle_hidden ? "home-key-label active" : "home-key-label";
        document.getElementById("home-key").className = class_name;
        document.getElementById("away-key").className = "away-key-label";
    }
    else if (last_click == "away") {
        let class_name = toggle_hidden ? "away-key-label active" : "away-key-label";
        document.getElementById("away-key").className = class_name;
        document.getElementById("home-key").className = "home-key-label";
    }
}