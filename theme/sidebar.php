<div class="w3-bar w3-top w3-black w3-large" style="z-index:4">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <span class="w3-bar-item w3-right"><?php echo NAME_X; ?></span>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
  <div class="w3-container w3-row">
    <div class="w3-col s4">
      <img src="theme/default_avatar.jpg" class="w3-circle w3-margin-right" style="width:46px">
    </div>
    <div class="w3-col s8 w3-bar">
      <span>Hi, <strong><?php echo ucwords($_SESSION['user']); ?></strong></span><br>
    </div>
  </div>
  <hr>
  <div class="w3-container">
    <h5>Menu</h5>
  </div>
  <div class="w3-bar-block">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <a href="dashboard.php" class="w3-bar-item w3-button w3-padding w3-blue"><i class="fa fa-users fa-fw"></i>  Dashboard</a>
    <a href="manage-livestock.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Manage LiveStock</a>
    <a href="discount.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw"></i>  Discount</a>
    <?php 

        $all_pig = $db->query("SELECT *, livestock.id AS lid FROM livestock INNER JOIN quarantine WHERE quantity <= threshold AND quarantine.livestockno != livestock.livestockno");
        $count_r = $all_pig->rowCount();


    ?>
    <a href="reorder.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-money fa-fw"></i>  Re-order <span class="badge" style="background-color: red;"><?= $count_r; ?></span></a>
    <a href="sales.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-eye fa-fw"></i>  Sales</a>
    <a href="manage-breed.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-users fa-fw"></i>  Manage Breeds</a>
    <a href="manage-quarantine.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-diamond fa-fw"></i>  Quarantine</a>
    <a href="add-user.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw"></i>  Add user</a>
    <a href="logout.php" class="w3-bar-item w3-button w3-padding"><i class="fa fa-power-off fa-fw"></i>  Log out</a><br><br>
  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>