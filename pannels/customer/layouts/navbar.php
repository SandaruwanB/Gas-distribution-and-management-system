<header id="header" class="header d-flex align-items-center fixed-top" style="background: rgba(0, 0, 0, 0.4);">
    <div class="container container-xl d-flex align-items-center justify-content-between">

      <a href="#" class="logo d-flex align-items-center">
        <img id="logo" src="/src/images/logo.png" alt="">         
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="chome.php">Home</a></li>
          <li><a href="myqr.php">QR & Quota</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="complains.php">Complains</a></li>
        </ul>
      </nav>

      <div class="position-relative">
        <a href="notifications.php" class="mx-2"><i class="fa fa-bell" aria-hidden="true" style="position: relative; font-size: 20px; width: 30px;"><div id="notsd" class="red-dot d-none"><span id="nots"></span></div></i></a>
        <div class="dropdown2">
          <a href="" class="dropdown-btn"><i class="fa fa-user" aria-hidden="true" style="font-size: 20px; margin-right: 3px;"></i><i class="fa fa-caret-down" aria-hidden="true"></i></a>
          <div class="dropdown2-content">
            <p style="color: #fff; text-align: center; margin-top: 5px;"><i class="fa fa-user" aria-hidden="true"></i>&nbsp;&nbsp;<?php echo $user; ?></p>
            <a href="settings.php"><i class="fa fa-cog" aria-hidden="true"></i>&nbsp;&nbsp;Settings</a>
            <a href="#" id="logoutC" style="color: red; font-weight: 700;"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp;&nbsp;Log Out</a> 
          </div>        
        </div>
           
        <i class="fa fa-bars mobile-nav-toggle"  id="navbtn" aria-hidden="true" style="color: #fff; font-size: 28px; padding-left: 10px;"></i>
      </div>
    </div>  
  </header>




