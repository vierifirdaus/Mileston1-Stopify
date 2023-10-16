<?php 

function icon($user) {
  $html = <<< "EOT"
    <div class="user-info">
        <div class="user-icon">
            <i class="fas fa-user"></i>
        </div>
        <h3 >$user</h3>
    </div>
  EOT;
  return $html;
}
