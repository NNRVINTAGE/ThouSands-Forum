    <!-- nav panel -->
    <div id="Navigation_Panel">
        <img src="../../img/home.png" alt="" class="Navigation_Button" onclick="linker('dashboard')">
        <?php
            if ($UploadEnabled === "yes") {
        ?>
                <img src="../../img/search.png" alt="" class="Navigation_Button" onclick="search()">
                <img src="../../img/upload.png" alt="" class="Navigation_Button" onclick="SetDialog('add')">
        <?php
            }
        ?>
        <img src="../../img/category.png" alt="" class="Navigation_Button" onclick="linker('category')">
        <img src="../../img/settings.png" alt="" class="Navigation_Button" onclick="settings()">
    </div>
    <img src="../../img/hide.png"  id="HideNav_Button" onclick="Navigation()">
    <div id="Settings_Panel" style="transform: translateY(100vh) translateX(-50%);">
        <div class="RowGroup">
            <h2>User : <?php echo isset($name) ? $name : 'Unidentified';?></h2>
            <img src="../../img/information.png" alt="" class="Settings_Action" onclick="linker('profile')">
        </div>
        <div class="RowGroup">
            <h2>Log-Out</h2>
            <img src="../../img/log-out.png" alt="" class="Settings_Action" onclick="linker('logout')">
        </div>
    </div>
    <!-- search panel -->
    <form id="Search_Panel" style="transform: translateY(100vh) translateX(-50%);" action="./<?php echo isset($page) ? $page : 'softwarelist';?>.php">
        <input type="text" name="search" placeholder="search stuff..." id="searchbox" class="inputext" tabindex="1">
        <button type="submit" name="onsearch" class="searchbtn" tabindex="2">Search</button>
        <button class="searchbtn" onclick="linker('dashboard')" tabindex="3">Clear</button>
    </form>