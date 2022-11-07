<?php require APPROOT .'/views/Includes/Header.php' ?>
<a href="<?php echo URLROOT?>/Posts" class="btn btn-dark">Back</a>
        <div class="card card-body bg-light mt-5">
            <?php echo flash('register_success');?>
            <h2 class="">Have Any Thought?</h2>
            <p class="">Pour out your thought</p>
            <form action=" <?php echo URLROOT ?>/Posts/Edit/<?php echo $data['id'];?>" method="post">
         
            <div class="form-group ">
                <label for="email">title: <sup class="text-danger">*</sup></label>
                <input type="title" name="title" class="form-control form-control-lg  <?php echo (!empty($data['title_err'])) ? 'is-invalid':''; ?>" value="<?php echo $data['title']; ?>">
                <span class="invalid-feedback"><?php echo $data['title_err'] ?></span>
            </div>

            <div class="form-group my-3">
                <label for="password">body: <sup class="text-danger">*</sup></label>
                <textarea type="body" name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ?'is-invalid':'';?>" ><?php echo $data['body'];?></textarea>
                <span class="invalid feedback"><?php echo $data['body_err']?></span>
            </div>
         
     
            <button type="submit" class="btn-lg btn-info ">Update</button>
                    
      
            </form>
        </div>
  

<?php require APPROOT .'/views/Includes/Footer.php' ?>