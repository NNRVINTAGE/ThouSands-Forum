    <!-- nav panel -->
    <div id="Navigation_Panel">
        <img src="../../img/home.png" alt="" class="Navigation_Button" onclick="linker('dashboard')">
        <?php
            if ($UploadEnabled === "yes") {
        ?>
                <img src="../../img/add-circle.svg" alt="" class="Navigation_Button" onclick="SetDialog('add')">
                <img src="../../img/search.png" alt="" class="Navigation_Button" onclick="search()">
        <?php
            } elseif (isset($SearchEnabled) && $SearchEnabled === "yes") {
        ?>
                <img src="../../img/search.png" alt="" class="Navigation_Button" onclick="search()">
        <?php
            };
        ?>
    </div>
    <img src="../../img/hide.png"  id="HideNav_Button" onclick="Navigation()">
    <!-- search panel -->
    <form id="Search_Panel" style="transform: translateY(100vh) translateX(-50%);" action="./<?php echo isset($page) ? $page : 'dashboard';?>.php">
        <?php if(isset($subpage) && isset($paramsubpage)){ ?><input type="text" name="<?php echo $paramsubpage;?>" value="<?php echo $subpage;?>" hidden tabindex="99"><?php };?>
        <input type="text" name="item" placeholder="search stuff..." id="searchbox" class="inputext" tabindex="1">
        <button type="submit" name="onsearch" class="searchbtn" tabindex="2">Search</button>
        <a href="<?php echo isset($page) ? $page : 'dashboard';?>.php<?php if(isset($subpage) && isset($paramsubpage)){echo '?' . $paramsubpage . '=' . $subpage;};?>" class="searchbtn" tabindex="3">Clear</a>
    </form>