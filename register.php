<?php
include "header.php";
include "./settings/functions.php";
$captcha = generateCaptcha();
?>
<div id="home-banner-container">
  <div class="container">
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
          <h4 class="text-center mb-4">Register</h4>
          <?php
          if ($_GET['register'] == 'exist_user') {
          ?>
            <div class="alert alert-danger" role="alert">
              This e-mail is used by another user.
            </div>
          <?php } ?>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" name="user_name" required class="form-control" />
              </div>
            </div>
            <div class="col">

              <div class="form-group">
                <label for="exampleInputEmail1">Surname</label>
                <input type="text" name="user_surname" required class="form-control" />
              </div>
            </div>
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="user_email" required class="form-control" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="user_password" required class="form-control" />
          </div>
          <label for="exampleInputEmail1">Admin</label>
          <select class="custom-select mb-3" name="user_authority">
            <option value="0">No</option>
            <option value="1">Yes</option>
          </select>
          <div class="input-group my-4">
            <div class="input-group-prepend">
              <span class="input-group-text" id="basic-addon3"><?php echo $captcha; ?></span>
            </div>
            <input type="hidden" name="captcha" value="<?php echo $captcha; ?>">
            <input type="text" required class="form-control" name="entered_captcha" id="basic-url" aria-describedby="basic-addon3">
          </div>
          <button type="submit" class="btn btn-primary w-100" style="background-color: #4c3398" name="register">
            Register
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php require_once "footer.php"; ?>