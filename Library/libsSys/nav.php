    <!-- nav panel -->
    <div id="Navigation_Panel">
        <img src="../../img/home.png" alt="" class="Navigation_Button" onclick="linker('home')">
        <?php
            if ($SearchEnabled === "yes") {
        ?>
                <img src="../../img/search.png" alt="" class="Navigation_Button" onclick="search()">
        <?php
            };
        ?>
        <img src="../../img/library.svg" alt="" class="Navigation_Button" onclick="linker('markout')">
        <img src="../../img/album.png" alt="" class="Navigation_Button" onclick="linker('category')">
        <img src="../../img/grid.svg" alt="" class="Navigation_Button" onclick="settings()">
    </div>
    <img src="../../img/hide.png"  id="HideNav_Button" onclick="Navigation()">
    <div id="Settings_Panel" style="transform: translateY(100vh) translateX(-50%);">
        <img src="../../img/earth.svg" alt="" class="Settings_Option" onclick="linker('forum')">
        <img src="../../img/library.svg" alt="" class="Settings_Option" onclick="linker('library')">
        <img src="../../img/person.svg" alt="" class="Settings_Option" onclick="linker('profile')">
        <img src="../../img/log-out.png" alt="" class="Settings_Option" onclick="linker('logout')">
    </div>
    <!-- search panel -->
    <form id="Search_Panel" style="transform: translateY(100vh) translateX(-50%);" action="./<?php echo isset($page) ? $page : 'home';?>.php">
        <?php if(isset($subpage) && isset($paramsubpage)){ ?><input type="text" name="<?php echo $paramsubpage;?>" value="<?php echo $subpage;?>" hidden tabindex="99"><?php };?>
        <input type="text" name="item" placeholder="search stuff..." id="searchbox" class="inputext" tabindex="1">
        <button type="submit" name="onsearch" class="searchbtn" value="stuff"  tabindex="2">Search</button>
        <a href="<?php echo isset($page) ? $page : 'home';?>.php<?php if(isset($subpage) && isset($paramsubpage)){echo '?' . $paramsubpage . '=' . $subpage;};?>" class="searchbtn" tabindex="3">Clear</a>
    </form>