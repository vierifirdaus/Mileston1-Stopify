<?php
function tables($heading, $data) {
    $heading_html = "";
    foreach ($heading as $head) {
        $heading_html .= "<th>{$head}</th>";
    }

    $data_html = "";
    foreach ($data as $row) {
        $data_html .= "<tr>";
        foreach ($row as $col) {
            $data_html .= "<td>{$col}</td>";
        }
        $data_html .= "</tr>";
    }

    $html = "
    <table>
        <thead>
            <tr>
                {$heading_html}
            </tr>
        </thead>
        <tbody>
            {$data_html}
        </tbody>
    </table>";

    return $html;
}