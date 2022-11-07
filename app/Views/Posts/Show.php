<?php require APPROOT .'/views/Includes/Header.php' ?>
<a href="<?php echo URLROOT?>/Posts" class="btn btn-dark">Back</a>
  <br>
  <h1><?php echo $data['post']->title;?></h1> 
  <div class="bg-secondary text-white p-2 mb-2">
    Written by <?php echo $data['user']->name  ?> on <?php echo $data['post']->created_at;?>
  </div>
  <p><?php echo $data['post']->body?></p>

  <?php if($data['post']->user_id == $_SESSION['user_id']) :?>
    <hr>
    <a href="<?php echo URLROOT?>/Posts/Edit/<?php echo $data['post']->id;?>" class="btn btn-dark">Edit</a>
    <form class="float-end" action="<?php echo URLROOT?>/Posts/Delete/<?php echo $data['post']->id?>" method="POST">
    <input type="submit" value="Delete" class="btn btn-danger "></form>
      
    <?php endif;?>


<?php require APPROOT .'/views/Includes/Footer.php' ?>