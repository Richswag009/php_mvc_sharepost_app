<?php require APPROOT .'/views/Includes/Header.php' ?>
  <div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php echo flash('register_success');?>
            <h2 class="">Login Account</h2>
            <p class="">please fill out this form to Login</p>
            <form action=" <?php echo URLROOT ?>/Users/Login" method="post">
         
            <div class="form-group ">
                <label for="email">Email: <sup class="text-danger">*</sup></label>
                <input type="email" name="email" class="form-control form-control-lg  <?php echo (!empty($data['email'])) ? 'is-invalid':''; ?>" value="<?php echo $data['email']; ?>">
                <span class="invalid-feedback"><?php echo $data['email_err'] ?></span>
            </div>

            <div class="form-group">
                <label for="password">Password: <sup class="text-danger">*</sup></label>
                <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data['password_err'])) ?'is-invalid':'';?>" value="<?php echo $data['password'];?>">
                <span class="invalid feedback"><?php echo $data['password_err'] ?></span>
            </div>
         
            <div class="row mt-4">
                <div class="col-md-6">
                    <button type="submit" class="btn-lg btn-success btn-block ">Login</button>
                    
                </div>
                <div class="col-md-6">
                   <a href="<?php echo URLROOT?>/Users/Register" class="btn-lg btn-light btn-block"> No account?? Register</a>
                </div>
            </div>
            </form>
        </div>
    </div>
  </div>>


<?php require APPROOT .'/views/Includes/Footer.php' ?>