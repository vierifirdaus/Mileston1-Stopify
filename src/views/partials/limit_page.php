<?php
function limit_page($limit)
{
    
    $html = <<< "EOT"
        <div class="limit-page">
            <label for="limit"><p>Limit: </p></label>
            <select name="limit_page" id="limit" >
        EOT;
    $option ="";
    for($i = 1; $i <= 10; $i++){
        $res= $i * 5;
        if($res == $limit){
            $option .= "<option value=$res selected>$res</option>";
        }
        else{
            $option .= "<option value=$res>$res</option>";
        }
    }
    $html .= $option;
    $html .= <<< "EOT"
            </select>
        </div>
    EOT;
    return $html;
}