<?php


      $menus_arr = array('1','2','3','4','5','8','9','11','12','14');


    foreach($menus_arr as $menu){


switch ($menu) {
  case '1':
    $label = 'Home';
    break;

  case '2':
    $label = 'Members';
    break;

  case '3':
    $label = 'Loans';
    break;

     case '4':
    $label = 'Collections';
    break;

  case '5':
    $label = 'Collateral Register';
    break;

     case '8':
    $label = 'Savings';
    break;

     case '9':
    $label = 'Office';
    break;

     case '11':
    $label = 'Reports';
    break;

     case '12':
    $label = 'Settings';
    break;

        case '14':
    $label = 'User';
    break;
}

      $checked = "";
      if(in_array($menu,$checked_arr)){
        $checked = "checked";
      } else {
        $checked = "";
      }
      echo '<div class="form-group checkbox">
<label>
<input type="checkbox" name="menu[]" value="'.$menu.'" class="flat-red" '.$checked.'>'.'  '.$label.'
</label>
    </div>';

    //'<input type="checkbox" name="lang[]" value="'.$language.'" '.$checked.' > '.$language.' <br/>';
    }
    ?>

?>