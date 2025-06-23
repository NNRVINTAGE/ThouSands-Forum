<?php
require_once "processes/database.php";
$errors = array();
session_start();
if (isset($_SESSION['thouSandsIds'])) {
    $isLogged = true;
} else {
    $isLogged = false;
};
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="img/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="styling/index.css">
    <title>Project ThouSands</title>
</head>
<body>
    <header>
        <nav id="nav">
            <?php
            if ($isLogged == true) {
            ?>
            <a href="TS/forum/dashboard.php" class="linkie dashb">Dashboard</a>
            <?php
            } else {
            ?>
            <a href="forum-connect/connect_it.php?state=login" class="linkie">LOGIN</a>
            <a href="forum-connect/connect_it.php?state=register" class="linkie">JOIN</a>
            <?php
            }
            ?>
            </nav>
    </header>
    <section class="sect_1">
        <h1>Project <span>ThouSands</span></h1>
        <h2>Thousand journeys among the Endless Desert Oasis</h2>
    </section>
    <section>
        <h2>stay tuned! and send some feedback(pls)</h2>
        <p>this is a game of a thousands hour making if you have a suggestion or want to get some alpha testing, hit me up on slack or check my github cuz in there i usually release a somewhat stable build(not promised). Awhile that pleaseee if you find some bug or have a suggestion for a feature to improve the game expreience, post it on the Wished Feature Forum in this website(i've pour my time to made it y'know)</p>
    </section>
    <section>
        <h2>the challenge as always</h2>
        <P>making this kind of games ain't be easy, I'm not quite experienced at even making sandbox or open world games let alone the multiplayer ones.
            but that doesn't meant that i'll never be able to, i mean doing it long enough and it will be somewhat done.
            not guaranteeing that it will be good and probably poorly optimized, the real challenge were to optimizing
            and making sure there's close to no bug so that it won't be immersion breaking (let's be real, it'll be useless to
            have a nice looking game but crash every single second).
        </P>
        <p>and to better track what's need to be done and what have been achieved, i made some kind of
            roadmap that you can see down below and it will be updated as it progress with time    
        </p>
</section>
    <section class="map_main_container">
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
    <section class="devlog_main_container">
        <h2>devlog</h2>
        <p>in here i will post notice to what currently im doin each day and what problem might i get stuck with</p>
        <div class="devlog-container">
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
        <p>i reaaallyyy appreciate for trying my game and it will be nice if you willing to send some feedback about
            any improvement i can do even just for a smol little suggestion for more comfortable gameplay.
        </p>
        <div class="link-container">
            <div class="redirector">
                <h3 class="title">Get da Game</h3>
                <p class="desc">follow the guide and it should be able to run(hopefuly)</p>
                <p class="version">version: 0.0.0</p>
                <a href="#" class="linkie">download</a>
            </div>
            <div class="suggestion-n-smol-feedback-container">
                <h3 class="title">Some feedback plz</h3>
                <p class="desc">I made a special forum page for bug reports and your suggestions, feel free to use it!</p>
                <a href="#" class="linkie">go to da forum</a>
            </div>
        </div>
    </section>
    <section class="comes_soon">
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
                <a href="#" class="menu_button">Forum</a>
            </div>
        </div>
        <div class="copyright">
            <p>© 2025 Vintago - All right reserved</p> 
        </div>
        <h2 class="things">VINTAGO</h2>
    </footer>
</body>
</html>