<?php include("welcome.php");?>  
  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">

<?php

if ($_SERVER['PHP_SELF'] == $settings['index_php_self']) {       

  echo '<img src="dist/img/'.$settings['logo'].'" class="img-circle" alt="User Image">';
} else {

  echo '<img src="../dist/img/'.$settings['logo'].'" class="img-circle" alt="User Image">';
}
        
     ?>   
        </div>
        <div class="pull-left info">
     
          <p><?= welcome(). ' '. $name.' !'?></p>

  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>


       <!--   <a id="network">
          <script>myFunction();</script>
          </a>-->
        
        </div>
      </div>
    <form action="search.php" method="POST" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="debtor" class="form-control" placeholder="Find Borrower...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
<!--Load the menu here-->
<ul class="sidebar-menu" data-widget="tree">

<?php

$uid = $_SESSION ['id'];



     // Fetch checked values
    $menus = mysqli_query($db,"SELECT menus FROM users WHERE id = '$uid'");
 
    $result = mysqli_fetch_assoc($menus);
    $checked_arr = $result['menus'];


$query=mysqli_query($db,"SELECT * FROM menus WHERE id IN ($checked_arr)");

 foreach($query AS $row){


          ?>
 <?php 

echo  '<li class="'.$row['active'].'">
          <a href="'.$row['link'].'">
            <i class="'.$row['icon_class'].'"></i>
            <span>'.$row['tab_name'].'</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">';

          $menu_id = $row['id'];

$subquery=mysqli_query($db,"SELECT * FROM submenu WHERE menu_id = $menu_id");

while($row=mysqli_fetch_array($subquery)){

//rows: id | menu_id | active_class(__leave blank/active| icon_class | tab_name | link | file | 
echo '<li onclick="mytab()" class=""><a href="'.$row['link'].'"><i class="'.$row['icon_class'].'"></i>'.$row['tab_name'].'</a></li>'?>


 <?php
 
        }
      ?>    
        <?php echo '</ul>'?>
        <?php echo '</li>'?>
      
      <?php
        }
      ?>    

      <!--Load the menu ends here-->
      
    </section>
    <!-- /.sidebar -->
  </aside>
