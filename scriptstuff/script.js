function linker(reqstate) {
    switch (reqstate) {
        case 'login':
            window.location.replace('login.php');
            break;
        case 'home':
            window.location.replace('home.php');
            break; 
        case 'dashboard':
            window.location.replace('dashboard.php');
            break; 
        case 'topic':
            window.location.replace('topic.php');
            break;
        case 'category':
            window.location.replace('category.php');
            break;
        case 'profile':
            window.location.replace('../../TS/forum/profile.php?user=self');
            break;
        case 'logout':
            window.location.replace('../../processes/logout.php');
            break;
        default:
            return;
    }
}

function SetDialog(reqstate) {
    switch (reqstate) {
        case 'add':
            var adds = document.getElementById('add-dialog');
            if (adds) {
                adds.style.display = (adds.style.display === 'none' || adds.style.display === '') ? "flex" : "none";
            }
            break;
        case 'edit':
            var udt = document.getElementById('edit-dialog');
            if (udt) {
                udt.style.display = (udt.style.display === 'none' || udt.style.display === '') ? "flex" : "none";
            }
            break;
        case 'update':
            var udt = document.getElementById('update-dialog');
            if (udt) {
                udt.style.display = (udt.style.display === 'none' || udt.style.display === '') ? "flex" : "none";
            }
            break;
        default:
        return;
    }
}


var nav = document.getElementById('Navigation_Panel');
var navbtn = document.getElementById('HideNav_Button');
var searchpanel = document.getElementById('Search_Panel');
var settingspanel = document.getElementById('Settings_Panel');
function Navigation() {
    navbtn.src = (navbtn.src.includes('hide.png')) ? '../../img/show.png' : '../../img/hide.png';
    if (nav.style.transform === 'translateY(81px) translateX(-50%)') {
        nav.style.transform = "translateY(0px) translateX(-50%)";
        navbtn.style.transform = "translateY(0px) translateX(-50%)";
    } else {
        nav.style.transform = "translateY(81px) translateX(-50%)";
        navbtn.style.transform = "translateY(81px) translateX(-50%)";
    }
}
function search() {
    if (searchpanel.style.transform === 'translateY(100vh) translateX(-50%)') {
        searchpanel.style.transform = "translateY(0) translateX(-50%)";
    } else {
        searchpanel.style.transform = "translateY(100vh) translateX(-50%)";
    }
}
function settings() {
    if (settingspanel.style.transform === 'translateY(100vh) translateX(-50%)') {
        settingspanel.style.transform = "translateY(0) translateX(-50%)";
    } else {
        settingspanel.style.transform = "translateY(100vh) translateX(-50%)";
    }
}


var loadFile = function(event) {
    var output = document.getElementById('prev');
    output.src = URL.createObjectURL(event.target.files[0]);
    output.onload = function() {
      URL.revokeObjectURL(output.src)
    }
};

function LoadEditTopics(ReqstData) {
    const form = document.forms.EDITSTUFF;
    const values = ReqstData.dataset;
    Object.keys(values).forEach((key) => {
        if (form[key]) 
            form[key].value = values[key];
    });
}
function LoadBios(ReqstData) {
    const form = document.forms.BIOS;
    const values = ReqstData.dataset;
    Object.keys(values).forEach((key) => {
        if (form[key]) 
            form[key].value = values[key];
    });
}