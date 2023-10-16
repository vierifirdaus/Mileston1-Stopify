<?php
function table($params=[]){
    
    $html=<<<EOT
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Gendre</th>
                <th>Release</th>
                <th>Durasi</th>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Queen</td>
                <td>Jajaja</td>
                <td>Jan 2023</td>
                <td>2.30</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Queen</td>
                <td>Jazz</td>
                <td>Jan 2023</td>
                <td>2.30</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Queen Queen Queen Queen Queen QueenQueen</td>
                <td>Jazz</td>
                <td>Jan 2023</td>
                <td>2.30</td>
                
            </tr>
        </tbody>
    </table>
EOT;
    return $html;
}