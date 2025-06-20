<?php
require_once "processes/datbase.php";
$errors = array();
if (isset($_SESSION['thouSandsIds'])) {
    header ('location: GM/forum/dashboards.php')
    exit;
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/index.css">
    <title>Project Thousand</title>
</head>
<body>
    <h1>Project ThouSands</h1>
    <h2>Thousands of hours journey to make AAA like games</h2>
    <section>
        <h2>the goal</h2>
        <p>this is a journey where i'll be making high quality products</p>
    </section>
        <h2>stay tuned! and give some feedback(pls)</h2>
        <p>there's no point if i only make this games for myself, my goal were to share this dreams to you guys and if you have a suggestion or want to get some alpha testing, hit me up on slack or check my github cuz in there i usually release a somewhat stable build(not promised). Awhile that pleaseee if you find some bug or have a suggestion for a feature to improve the game expreience, post it on the Wished Feature Forum in this website(i've pour my time to made it y'know)</p>
    <section>
        <h2>the challenge as always</h2>
        <P>making AAA games won't be easy, I'm not quite experienced at even making 3d games let alone the AAA ones.
            but that doesn't meant that i can't make it true, i mean doing it long enough and it will be somewhat done.
            not guaranteeing that it will be good and probably poorly optimized, the real challenge were to optimizing
            and making sure there's close to no bug so that it won't be immersion breaking (let's be real, its useless to
            have a nice looking game but crash every single second).
        </P>
        <p>and to better track what's need to be done and what have been achieved, i made som roadmap that
            you can see down below and it will be updated as it progress with time    
        </p>
    </section>
    <section>
        <h2>the roadmap</h2>
        <p>in there you'll see what have been done and what to be achieved</p>
        <div class="map-container">
            <div class="map-road"></div>
            <div class="achievement-container">
                <h3 class="acv-title">the achievement title</h3>
                <p class="acv-desc">achievement description</p>
                <p class="acv-status">not yet reached, in progress, achieved!</p>
            </div>
            <div class="achievement-container">
                <h3 class="acv-title">the achievement title</h3>
                <p class="acv-desc">achievement description</p>
                <p class="acv-status">not yet reached, in progress, achieved!</p>
            </div>
            <div class="achievement-container">
                <h3 class="acv-title">the achievement title</h3>
                <p class="acv-desc">achievement description</p>
                <p class="acv-status">not yet reached, in progress, achieved!</p>
            </div>
            <div class="achievement-container">
                <h3 class="acv-title">the achievement title</h3>
                <p class="acv-desc">achievement description</p>
                <p class="acv-status">not yet reached, in progress, achieved!</p>
            </div>
        </div>
    </section>
    <section>
        <h2>devlog</h2>
        <p>in here i will make a notice to what currently im doin each day and what problem might i get stuck with</p>
        <div class="devlog-container">
            <div class="devlines"></div>
            <div class="devlog">
                <h3 class="devlog-title">devlog title</h3>
                <p class="devlog-desc">devlog description</p>
                <p class="devlog-tag">#daily #issue #progress #fun</p>
            </div>
            <div class="devlog">
                <h3 class="devlog-title">devlog title</h3>
                <p class="devlog-desc">devlog description</p>
                <p class="devlog-tag">#daily #issue #progress #fun</p>
            </div>
            <div class="devlog">
                <h3 class="devlog-title">devlog title</h3>
                <p class="devlog-desc">devlog description</p>
                <p class="devlog-tag">#daily #issue #progress #fun</p>
            </div>
            <div class="devlog">
                <h3 class="devlog-title">devlog title</h3>
                <p class="devlog-desc">devlog description</p>
                <p class="devlog-tag">#daily #issue #progress #fun<p>
            </div>
        </div>
    </section>
    <section>
        <h2>testing and feedback</h2>
        <p>i reaaalllyyy appreciate for trying my game and it will be nice if you willing to send some feedback about
            any improvement i can do even just for a smol little suggestion for more comfortable gameplay.
        </p>
        <div class="link-container">
            <div class="redirector">
                <h3 class="title">Get da Game</h3>
                <p class="desc">follow the guide and it should be able to run(hopefuly)</p>
                <p class="version">version: 0.0.0</p>
                <a href="#" class="linkie">download</a>
            </div>
            <div class="link-container">
                <h3 class="title">Some feedback plz</h3>
                <p class="desc">I made a special forum page for bug reports and suggestions, feel free to use it!</p>
                <a href="#" class="linkie">go to da forum</a>
            </div>
        </div>
    </section>
    <section>
        <h2>comes soon</h2>
        <p>shh... there's will be more to come(if i have time that is)</p>
    </section>
    <footer>
        <div class="footer-group">
            <h2 class="footer-title">Vintago</h2>
            <h3 class="footer-subtitle">From <img src="img/vdsl.png" alt="" class="footer_logo"><h3>
        </div>
        <div class="footer-group">
            <h2 class="footer-title">Menus</h2>
            <div class="footer-menu_group">
                <a href="#" class="menu_button">Homepage</a>
                <a href="#" class="menu_button">Github</a>
                <a href="#" class="menu_button">Feedback Forum</a>
            </div>
        </div>
        <div class="copyright">
            <p>© 2025 Vintago - All right reserved</p> 
        </div>
    </footer>
</body>
</html>