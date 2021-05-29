<?php require_once "header.php"; ?>
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
          <h4 class="text-center mb-4">Register</h4>
          <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" name="user_name" required class="form-control" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Surname</label>
            <input type="text" name="user_surname" required class="form-control" />
          </div>
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="user_email" required class="form-control" />
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="user_password" required class="form-control" />
          </div>
          <button type="submit" class="btn btn-primary w-100" style="background-color: #4c3398" name="register">
            Register
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>