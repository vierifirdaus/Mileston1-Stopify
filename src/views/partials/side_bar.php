<?php
function SideBar($page) {
    $page_list = [
        "Home",
        "Search",
        "Albums",
        "Artists",
        "Genres",
        "Liked song",
        "Log out"
    ];
    $elmnt = "";
    foreach ($page_list as $_page)
    {
        $active = ($page == $_page)  ? "class='active'" : null;
        $elmnt .= "<a $active href='/$_page'>$_page</a>";
    }
    $html = <<<"EOT"
    <div class="sidebar">
        <p>Stopify</p>
        $elmnt
    </div>
    EOT;

    return $html;
}
