<?php
function pagination_item($page,$max_page){
    $html = <<< "EOT"
    <div class="pagination-item">
        <p>Page <span id="current-page">$page</span> of <span id="max-page">$max_page</span></p>
        <img src="assets/icon_pagination/left.png" alt="left" id="left">
        <img src="assets/icon_pagination/right.png" alt="right" id="right">
    </div>
    EOT;

    return $html;
}