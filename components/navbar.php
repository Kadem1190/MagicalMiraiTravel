<?php
function get_navbar_html(
    bool $logged_in = false,
    bool $in_home = false,
    bool $in_travel = false,
    bool $in_login = false,
) {
    return '
    <nav class="navbar">
        <div class="logo">
            <img style="height: 50px; width: 50px;" src="./img/img_intro_postmark.svg"> 
            マジカルミライ<i class="fa-solid fa-plane-departure"></i>
        </div>
        <ul class="nav-links">
            <li><a href="index.php"'.($in_home ? 'class="active"' : '').'><i class="fas fa-home"></i> Home</a></li>
            <li><a href="travel.php"'.($in_travel ? 'class="active"' : '').'><i class="fas fa-map"></i> Travel</a></li>
            '.($logged_in ?
            '<li><a href="logout.php"'.($in_login ? 'class="active"' : '').'><i class="fas fa-sign-in-alt"></i> Logout</a></li>'
            :
            '<li><a href="login.php"'.($in_login ? 'class="active"' : '').'><i class="fas fa-sign-in-alt"></i> Login</a></li>').'
            <li><a href="#" onclick="return false;" class="toggle-darkmode"><i class="fas fa-moon"></i> <span>Dark Mode</span></a></li>
        </ul>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
    </nav>
    ';
}
?>