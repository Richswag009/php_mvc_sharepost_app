<?php require APPROOT .'/views/Includes/Header.php' ?>
<div class="container">
    <div class="row mb-3">
       <div class="col-md-6">
           <h1>Posts</h1>
       </div>
       <div class="col-md-6">
           <a href="<?php echo URLROOT ?>/Posts/Add" class="btn btn-primary float-end">
               <i class="fa fa-pencil"></i> Add Post    
           </a>
           
       </div>

</div>
    <?php foreach($data['Posts'] as $post) : ?>
        <div class="card card-body mb-3">
           <h4 class="card-title"> <?php echo $post->title; ?></h4>
           <div class="bg-light p-2 mb-3">
            <p>written by : <strong><?php echo $post->name ;?></strong> on <?php echo $post->postCreated ;?> </p>
           </div>
           <p class="card-text"><?php echo $post->body;?></p>  
           <a href="<?php echo URLROOT;?>/Posts/Show/<?php echo $post->postId;?>" class="btn btn-dark">More</a>
        </div>
    <?php endforeach ;?>


 </div>
<?php require APPROOT .'/views/Includes/Footer.php' ?>