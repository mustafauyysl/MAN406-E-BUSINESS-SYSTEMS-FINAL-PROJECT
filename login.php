<?php
include "header.php";
include "./settings/functions.php";
$isAdminLogin = $_GET['admin'] == "yes";
$captcha = generateCaptcha();

?>

<div id="home-banner-container">
  <div class="container" id="home-banner-inner">
    <div class="row">
      <div class="col">
        <div style="
                background-color: #ffd300;
                height: 200px;
                width: 200px;
                border-radius: 100px;
                padding: 65px 0;
                text-align: center;
              ">
          <h1 class="font-weight-bold" style="color:#4c3398;font-size: 50px;">götür</h1>
        </div>
        <h1 class="text-white w-75">At your door in minutes</h1>
      </div>
      <div class="col"></div>
      <div class="col">
        <form class="login-form" action="./settings/operations.php" method="POST">
          <h4 class="text-center mb-4"><?php if ($isAdminLogin) { ?> Admin Login <?php } else { ?> User Login <?php } ?></h4>
          <?php
          if ($_GET['login'] == 'error') {
          ?>
            <div class="alert alert-danger" role="alert">
              Email or password are invalid!
            </div>
          <?php } elseif ($_GET['captcha'] == 'error') { ?>
            <div class="alert alert-danger" role="alert">
              Captcha is invalid!
            </div>
          <?php } ?>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" required class="form-control" name="user_email" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" required class="form-control" name="user_password" />
          </div>
          <div class="input-group my-4">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon3"><?php echo $captcha; ?></span>
            </div>
            <input type="hidden" name="captcha" value="<?php echo $captcha; ?>">
            <input type="text" required class="form-control" name="entered_captcha" id="basic-url" aria-describedby="basic-addon3">
          </div>
          <div class="text-center mb-3">
            <a href="<?php if ($isAdminLogin) { ?> login.php <?php } else { ?> ?admin=yes <?php } ?>"><?php if ($isAdminLogin) { ?> User Login <?php } else { ?> Admin Login <?php } ?></a>
          </div>
          <button type="submit" class="btn btn-primary w-100" style="background-color: #4c3398" name="<?php if ($isAdminLogin) { ?>adminLogin<?php } else { ?>login<?php } ?>">
            Login
          </button>
        </form>


      </div>
    </div>
  </div>
</div>
<?php
require_once "footer.php";
?>