function linker(reqstate) {
    switch (reqstate) {
        case 'login':
            window.location.replace('login.php');
            break;
        case 'dashboard':
            window.location.replace('dashboard.php');
            break; 
        case 'topic':
            window.location.replace('topic.php');
            break;
        case 'profile':
            window.location.replace('profile.php');
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
            var asd = document.getElementById('add-dialog');
            if (asd) {
                asd.style.display = (asd.style.display === 'none' || asd.style.display === '') ? "flex" : "none";
            }
            break;
        case 'edit':
            var esd = document.getElementById('edit-dialog');
            if (esd) {
                esd.style.display = (esd.style.display === 'none' || esd.style.display === '') ? "flex" : "none";
            }
            break;
        case 'update':
            var esd = document.getElementById('update-dialog');
            if (esd) {
                esd.style.display = (esd.style.display === 'none' || esd.style.display === '') ? "flex" : "none";
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
    const form = document.forms.EDITALBUM;
    const values = ReqstData.dataset;
    Object.keys(values).forEach((key) => {
        if (form[key]) 
            form[key].value = values[key];
    });
}
function LoadDataPhoto(ReqstData) {
    const form = document.forms.DATAPHOTO;
    const values = ReqstData.dataset;
    Object.keys(values).forEach((key) => {
        if (form[key]) 
            form[key].value = values[key];
    });
}