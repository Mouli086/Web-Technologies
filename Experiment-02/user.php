<div id="friends">
  <?php
  $image = "male.jpg";
  if ($FRIEND_ROW['gender'] == "f") {
    $image = "female.jpg";
  }
  ?>
  <img id="friends_img" src="<?php echo $image ?>" alt="">
  <br>

  <?php echo $FRIEND_ROW['first_name'] . " " . $FRIEND_ROW['last_name'] ?>
</div>