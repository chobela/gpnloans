
<header class="main-header">
<!-- Logo -->
<a <?php 


if ($_SERVER['PHP_SELF'] == $settings['index_php_self']) {

  echo 'href="index.php"';

} else {
 echo 'href="../index.php"';

}

 ?>  class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>A</b>LT</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><?php echo $settings['appname']?></span>
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar navbar-fixed-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>

 <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <!-- Messages: style can be found in dropdown.less-->
      <li>

         <a class="navbar-brand" href="#"><?php echo $_SESSION['branchname']?></a>
      </li>
      
      
      
      
              <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-send-o"></i>
              <span class="label label-default"><?php echo $settings['sms']?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $settings['sms']?> SMSs Available</li>
          
             
            </ul>
          </li>
      
      
        <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-money"></i>
              <span class="label label-warning"><?php echo $app->countloanstoday();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $app->countloanstoday();?> loans due today</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                                
                  <?php
  $sql = $app->getloanstoday();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
                  <li>
                    <a href="singleloans.php?did=<?php echo $row['ddid'];?>">
                      <i class="fa fa-money text-warning"></i>  <?php echo $row['title'].'.'. ' '.$row['fname'].' '.$row['lname'].' '.'-'.' '.'K '.number_format($row['balance'],2); ?>
                    </a>
                  </li>
                             <?php } ?>
                 
                </ul>
              </li>
             
            </ul>
          </li>
      
      <li class="dropdown notifications-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="label label-success"><?php echo $app->countevents();?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $app->countevents();?> reminders today</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                                      <?php
  $sql = $app->getevents();
  while($row=mysqli_fetch_array($sql))
  {
  ?>
                  <li>
                    <a href="calendar.php">
                      <i class="fa fa-bell-o text-green"></i>  <?php echo$row['title']; ?>
                    </a>
                  </li>
                             <?php } ?>
                 
                </ul>
              </li>
             
            </ul>
          </li>
      
    <li><a  href="includes/logout.php" class="fa fa-power-off"> Sign out</a></li>
     
    </ul>
  </div>
</nav>
</header>
