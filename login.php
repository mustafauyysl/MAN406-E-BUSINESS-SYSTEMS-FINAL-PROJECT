<?php include "header.php"; ?>
<div id="home-banner-container">
  <div class="container" id="home-banner-inner">
    <div class="row">
      <div class="col">
        <div style="
                background-color: #ffd300;
                height: 200px;
                width: 200px;
                border-radius: 100px;
                padding: 70px 0;
                text-align: center;
              ">
          <h1>götür</h1>
        </div>
        <h1 class="text-white w-75">At your door in minutes</h1>
      </div>
      <div class="col"></div>
      <div class="col">
        <form class="login-form" action="./settings/operations.php" method="POST">
          <h4 class="text-center mb-4">Login</h4>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" required class="form-control" name="user_email" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" required class="form-control" name="user_password" />
          </div>
          <button type="submit" class="btn btn-primary w-100" style="background-color: #4c3398" name="login">
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