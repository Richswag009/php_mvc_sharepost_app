  
  <nav class="navbar navbar-dark navbar-expand-md  bg-dark mb-3 p-3" >
  <div class="container">

    <a class="navbar-brand " href="<?php echo URLROOT; ?>"> <h5><?php echo SITENAME; ?></h5></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample01" aria-controls="navbarsExample01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse flex flex-col justify-content-between " id="navbarsExample01">
        <ul class="navbar-nav mr-auto mb-2">
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?php echo URLROOT; ?>">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>/Pages/About">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link"href=''>links</a>
          </li>
        </ul>

        <ul class="navbar-nav ml-auto mb-2">
          <?php if(isset($_SESSION['user_id'])) :?>
          
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="">Welcome : <?php echo $_SESSION['user_name']?></a>
            </li>
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="<?php echo URLROOT;?>/Users/Logout">Logout</a>
            </li>

          <?php else :?>

          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?php echo URLROOT;?>/Users/Login">Login </a>
          </li>
          <li class="nav-item">
            <a class="nav-link " aria-current="page" href="<?php echo URLROOT;?>/Users/Register">Register </a>
          </li>
         <?php endif ;?>
        </ul>
        
      </div>
    </div>
 
  </nav>