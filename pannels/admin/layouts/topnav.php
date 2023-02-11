<header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
    <a href="dashboard.php" class="logo d-flex align-items-center p-lg-5">
        <img src="/src/images/favicon.png">
        LPGSS
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
</div>


<nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number" id="notific"></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                <li class="dropdown-header notificCountPrint">
                    You have <span id="notific2"></span> new notifications
                    <a href="notifications.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <div class="notificContent">

                </div>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="notifications.php">Show all notifications</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-chat-left-text"></i>
                <span class="badge bg-success badge-number" id="messagePrint1"></span>
            </a>
             <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                <li class="dropdown-header messageCountPrint" >
                    You have <span id="messageCount"></span> new messages
                    <a href="messages.php"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                </li>
                <div id="msgesContent">

                </div>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li class="dropdown-footer">
                    <a href="messages.php">Show all messages</a>
                </li>
            </ul>
        </li>
        <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="/src/images/pro-logo.png" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2"><?= $rowuser['firstName']; ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                <li class="dropdown-header">
                    <h6><?= $name; ?></h6>
                    <span><?php 
                        echo ($rowuser['previlage'] == "super" ? "Super Admin": "Admin");
                    ?></span>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="#" onclick="logOutAdmin()">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
</header>