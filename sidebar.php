<?php include_once 'library/library.php'; ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200;300;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 260px;
      background: #11101d;
      z-index: 100;
      transition: all 0.5s ease;
    }

    .sidebar.close {
      width: 78px;
    }

    .sidebar .logo-details {
      height: 60px;
      width: 100%;
      display: flex;
      align-items: center;
    }

    .sidebar .logo-details i {
      font-size: 30px;
      color: #fff;
      height: 50px;
      min-width: 78px;
      text-align: center;
      line-height: 50px;
    }

    .sidebar .logo-details .logo_name {
      font-size: 22px;
      color: #fff;
      font-weight: 600;
      transition: 0.3s ease;
      transition-delay: 0.1s;
    }

    .sidebar.close .logo-details .logo_name {
      transition-delay: 0s;
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links {
      height: 100%;
      padding: 30px 0 150px 0;
      overflow: auto;
    }

    .sidebar.close .nav-links {
      overflow: visible;
    }

    .sidebar .nav-links::-webkit-scrollbar {
      display: none;
    }

    .sidebar .nav-links li {
      position: relative;
      list-style: none;
      transition: all 0.4s ease;
    }

    .sidebar .nav-links li:hover {
      background: #1d1b31;
    }

    .sidebar .nav-links li .iocn-link {
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .sidebar.close .nav-links li .iocn-link {
      display: block;
    }

    .sidebar .nav-links li i {
      height: 50px;
      min-width: 45px;
      text-align: center;
      line-height: 50px;
      color: #fff;
      font-size: 20px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .sidebar .nav-links li.showMenu i.arrow {
      transform: rotate(-180deg);
    }

    .sidebar.close .nav-links i.arrow {
      display: none;
    }

    .sidebar .nav-links li a {
      display: flex;
      align-items: center;
      text-decoration: none;
    }

    .sidebar .nav-links li a .link_name {
      font-size: 16px;
      font-weight: 400;
      color: #fff;
      transition: all 0.4s ease;
    }

    .sidebar.close .nav-links li a .link_name {
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links li .sub-menu {
      padding: 6px 6px 14px 80px;
      margin-top: -10px;
      background: #1d1b31;
      display: none;
    }

    .sidebar .nav-links li.showMenu .sub-menu {
      display: block;
    }

    .sidebar .nav-links li .sub-menu a {
      color: #fff;
      font-size: 15px;
      padding: 5px 0;
      white-space: nowrap;
      opacity: 0.6;
      transition: all 0.3s ease;
    }

    .sidebar .nav-links li .sub-menu a:hover {
      opacity: 1;
    }

    .sidebar.close .nav-links li .sub-menu {
      position: absolute;
      left: 100%;
      top: -10px;
      margin-top: 0;
      padding: 10px 20px;
      border-radius: 0 6px 6px 0;
      opacity: 0;
      display: block;
      pointer-events: none;
      transition: 0s;
    }

    .sidebar.close .nav-links li:hover .sub-menu {
      top: 0;
      opacity: 1;
      pointer-events: auto;
      transition: all 0.4s ease;
    }

    .sidebar .nav-links li .sub-menu .link_name {
      display: none;
    }

    .sidebar.close .nav-links li .sub-menu .link_name {
      font-size: 18px;
      opacity: 1;
      display: block;
    }

    .sidebar .nav-links li .sub-menu.blank {
      opacity: 1;
      pointer-events: auto;
      padding: 3px 20px 6px 16px;
      opacity: 0;
      pointer-events: none;
    }

    .sidebar .nav-links li:hover .sub-menu.blank {
      top: 50%;
      transform: translateY(-50%);
    }

    html, body {
      height: 100%;
    }

    .home-section {
      position: relative;
      background: #E4E9F7;
      min-height: 100%;
      left: 260px;
      width: calc(100% - 260px);
      transition: all 0.5s ease;
    }

    .sidebar.close~.home-section {
      left: 78px;
      width: calc(100% - 78px);
    }

    .home-section .home-content {
      height: 60px;
      display: flex;
      align-items: center;
    }

    .home-section .home-content .bx-menu,
    .home-section .home-content .text {
      color: #11101d;
      font-size: 35px;
    }

    .home-section .home-content .bx-menu {
      margin: 0 15px;
      cursor: pointer;
    }

    .avoid-clicks {
      pointer-events: none;
    }

    .cursor-not-allowed {
      cursor: not-allowed;
    }
  </style>
</head>

<body>
  <?php
  if (isset($_COOKIE["token"])) {
    echo script("console.log('token [SET]')");
    echo script("console.log('" . "cuToken: " . $_COOKIE["token"] . "')");
    $getuser = tep_fetch_object(tep_query("SELECT * FROM employees WHERE emp_id = '" . $_COOKIE["token"] . "'"));
  } else {
    echo script("console.log('token [UNSET]')");
    echo redirect("login.php");
  }
  if ($getuser->emp_status != 1) {
    echo redirect("setup_cookies.php?logout=1");
  }
  ?>
  <div class="sidebar">
    <div class="logo-details">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <span class="logo_name">GotoGro-MRM</span><br><br><br>
    </div>
    <div style="display: flex;
    flex-direction: column;
    align-items: flex-end;
    margin-right: 12px;
    margin-top: 17px;">
      <span class="link_name"><?= $getuser->emp_name ?></span>
      <span class="link_name"><?= $getuser->emp_email ?></span>
    </div>
    <ul class="nav-links">
      <?php if ($getuser->emp_position >= 0 && $getuser->emp_position != 2) { ?>
        <li>
          <div class="iocn-link">
            <a href="sales.php">
              <i class='fa fa-list'></i>
              <span class="link_name">Sales</span>
            </a>
          </div>
        </li>
      <?php } ?>

      <?php if ($getuser->emp_position >= 2) { ?>
        <li>
          <div class="iocn-link">
            <a href="#">
              <i class='fa fa-tag'></i>
              <span class="link_name">Site Preferences</span>
            </a>
            <i class='bx bxs-chevron-down arrow'></i>
          </div>
          <ul class="sub-menu">
            <li><a href="site_inventory.php">Inventory</a></li>
          </ul>
        </li>
      <?php } ?>
      
      <?php if ($getuser->emp_position >= 9) { ?>
        <li>
          <div class="iocn-link">
            <a href="members_listing.php">
              <i class='fa fa-user'></i>
              <span class="link_name">Members Listing</span>
            </a>
          </div>
        </li>
        <li>
          <div class="iocn-link">
            <a href="employee_listing.php">
              <i class='fa fa-users'></i>
              <span class="link_name">Employee Listing</span>
            </a>
          </div>
        </li>
      <?php } ?>

      <li>
        <a href="setup_cookies.php?logout=1">
          <i class='fa fa-power-off'></i>
          <span class="link_name">Log Out</span>
        </a>
        <ul class="sub-menu blank">
          <li><a class="link_name" href="setup_cookies.php?logout=1">Log Out</a></li>
        </ul>
      </li>
      <li>
      </li>
    </ul>
  </div>
  <section class="home-section">
    <div class="home-content">
      <i class='bx bx-menu'></i>
      <h3>Admin Panel</h3>
    </div>
    <script>
      let arrow = document.querySelectorAll(".arrow");
      for (var i = 0; i < arrow.length; i++) {
        arrow[i].addEventListener("click", (e) => {
          let arrowParent = e.target.parentElement.parentElement;
          arrowParent.classList.toggle("showMenu");
        });
      }

      let sidebar = document.querySelector(".sidebar");
      let sidebarBtn = document.querySelector(".bx-menu");
      console.log(sidebarBtn);
      sidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("close");
      });
    </script>
</body>

</html>