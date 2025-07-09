<<<<<<< HEAD
<?php
require_once('./config.php');
if($_settings->userdata('id') > 0){
    $_settings->set_flashdata('warning',' You are already in a session.');
    redirect('./');
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
require_once('inc/header.php');
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_settings->info('name') ?> | Login</title>
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="login-page dark-mode py-4">
<?php if($_settings->chk_flashdata('success')): ?>
  <script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
  </script>
<?php endif;?>
<script>
  start_loader()
</script>
<style>
  html,body{
      height:calc(100%) !important;
      width:calc(100%);
  }
  body:before{
      content:"";
      position:fixed;
      height:calc(100%);
      width:calc(100%);
      top:0;
      left:0;
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      z-index: -1;
  }
  .login-page{ height:100% !important; }
  .login-title{ text-shadow: 4px 4px black; }
  img#cimg{ height: 15vh; width: 15vh; object-fit: cover; border-radius: 100% 100%; }
</style>
<h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('name') ?></b></h1>
<div class="login-box">
  <div class="card card-primary card-outline card-tabs bg-dark-gradient">
    <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="CTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="signup-tab" data-toggle="pill" href="#signup" role="tab" aria-controls="signup" aria-selected="true">Sign Up</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="CTabContent">
        <div class="tab-pane fade active show" id="login" role="tabpanel" aria-labelledby="login-tab">
          <form id="ulogin-frm" action="" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="username" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-4 ml-auto">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
          <form action="" id="user-register" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <input type="hidden" name="type" value="2">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-info">First Name</label>
                  <input type="text" class="form-control" name="firstname" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Middle Name</label>
                  <input type="text" class="form-control" name="middlename">
                </div>
                <div class="form-group">
                  <label class="text-info">Last Name</label>
                  <input type="text" class="form-control" name="lastname" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Gender</label>
                  <select class="form-control" name="gender" required>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="text-info">Date of Birth</label>
                  <input type="date" class="form-control" name="dob" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Contact #</label>
                  <input type="text" class="form-control" name="contact" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-info">Address</label>
                  <textarea class="form-control" name="address" required></textarea>
                </div>
                <div class="form-group">
                  <label class="text-info">Email</label>
                  <input type="email" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" required>
                </div>
                <div class="form-group">
                  <label>Avatar</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <img src="<?php echo validate_image(''); ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>
              </div>
            </div>
            <hr class="bg-light">
            <div class="row">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill w-50">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
function displayImg(input,_this) {
  // alert("go on")
  if (input.files && input.files[0]) {
    const allowed = ['image/jpeg', 'image/png'];
    if (!allowed.includes(input.files[0].type)) {
      alert('Only JPG and PNG images are allowed.');
      input.value = '';
      return;
    }
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#cimg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(document).ready(function(){
  end_loader();
  $('#CTab .nav-link').click(function(){
    if($(this).attr('aria-controls') == 'signup'){
      $('.login-box').addClass('w-75')
    } else {
      $('.login-box').removeClass('w-75')
    }
  });

  $('#ulogin-frm').submit(function(e){
    e.preventDefault();
    $('.pop_msg').remove();
    start_loader();
    const _this = $(this);
    const el = $('<div>').addClass('pop_msg alert').hide();
    _this.find('button[type="submit"]').attr('disabled', true);
    $.ajax({
      url: _base_url_+'classes/Login.php?f=login_user',
      method: 'POST',
      data: _this.serialize(),
      error: err => {
        el.addClass('alert-danger').text('An Error occurred');
        _this.prepend(el);
        el.show('slow');
        $('html,body').animate({scrollTop:0},'fast');
      },
      success: function(resp){
        if(resp){
          resp = JSON.parse(resp);
          if(resp.status == 'success'){
            location.replace(_base_url_);
          } else {
            el.addClass('alert-danger').html("<i class='fa fa-exclamation-triangle'></i> Incorrect username or password");
            _this.prepend(el);
            el.show('slow');
            $('html,body').animate({scrollTop:0},'fast');
            _this.find('input').addClass('is-invalid');
            _this.find('[name="username"]').focus();
          }
        }
        _this.find('button[type="submit"]').removeAttr('disabled');
        end_loader();
      }
    });
  });

  $('#user-register').submit(function(e){
    e.preventDefault();
    $('.pop_msg').remove();
    start_loader();
    const _this = $(this);
    const el = $('<div>').addClass('pop_msg alert').hide();
    if($('#password').val() != $('#cpassword').val()){
      el.addClass('alert-danger').text('Mismatched Password.');
      _this.prepend(el);
      el.show('slow');
      $('#password,#cpassword').addClass('border-danger');
      $('html,body').animate({scrollTop:0},'fast');
      end_loader();
      return false;
    }
    if($('#password').val().length < 8){
      el.addClass('alert-danger').text('Password must be at least 8 characters long.');
      _this.prepend(el);
      el.show('slow');
      end_loader();
      return false;
    }
    $('#password,#cpassword').removeClass('border-danger');
    const formData = new FormData(_this[0]);
    $.ajax({
      url: _base_url_+"classes/Users.php?f=save",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      error: err => {
        el.addClass('alert-danger').text('An error occurred.');
        _this.prepend(el);
        el.show('slow');
        $('html,body').animate({scrollTop:0},'fast');
        end_loader();
      },
      success: function(resp){
        console.log(resp)
        if(resp == 1){
          alert_toast("Registration successful!",'success');
          setTimeout(()=>location.href = './login.php',1500);
        } else if(resp == 2){
          el.addClass('alert-danger').text('An error occurred.');
          _this.prepend(el);
          el.show('slow');
        } else if(resp == 3){
          el.addClass('alert-danger').text('Username already exists.');
          _this.prepend(el);
          el.show('slow');
        }
        $('html,body').animate({scrollTop:0},'fast');
        end_loader();
      }
    });
  });
});
</script>
</body>
=======
<?php
require_once('./config.php');
if($_settings->userdata('id') > 0){
    $_settings->set_flashdata('warning',' You are already in a session.');
    redirect('./');
}
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
require_once('inc/header.php');
?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $_settings->info('name') ?> | Login</title>
  <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="login-page dark-mode py-4">
<?php if($_settings->chk_flashdata('success')): ?>
  <script>
    alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
  </script>
<?php endif;?>
<script>
  start_loader()
</script>
<style>
  html,body{
      height:calc(100%) !important;
      width:calc(100%);
  }
  body:before{
      content:"";
      position:fixed;
      height:calc(100%);
      width:calc(100%);
      top:0;
      left:0;
      background-image: url("<?php echo validate_image($_settings->info('cover')) ?>");
      background-size:cover;
      background-repeat:no-repeat;
      z-index: -1;
  }
  .login-page{ height:100% !important; }
  .login-title{ text-shadow: 4px 4px black; }
  img#cimg{ height: 15vh; width: 15vh; object-fit: cover; border-radius: 100% 100%; }
</style>
<h1 class="text-center py-5 login-title"><b><?php echo $_settings->info('name') ?></b></h1>
<div class="login-box">
  <div class="card card-primary card-outline card-tabs bg-dark-gradient">
    <div class="card-header p-0 pt-1 border-bottom-0">
      <ul class="nav nav-tabs" id="CTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="login-tab" data-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="false">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="signup-tab" data-toggle="pill" href="#signup" role="tab" aria-controls="signup" aria-selected="true">Sign Up</a>
        </li>
      </ul>
    </div>
    <div class="card-body">
      <div class="tab-content" id="CTabContent">
        <div class="tab-pane fade active show" id="login" role="tabpanel" aria-labelledby="login-tab">
          <form id="ulogin-frm" action="" method="post">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="input-group mb-3">
              <input type="email" class="form-control" name="username" placeholder="Email" required>
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-user"></span></div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" name="password" placeholder="Password" required>
              <div class="input-group-append">
                <div class="input-group-text"><span class="fas fa-lock"></span></div>
              </div>
            </div>
            <div class="row">
              <div class="col-4 ml-auto">
                <button type="submit" class="btn btn-primary btn-block">Login</button>
              </div>
            </div>
          </form>
        </div>

        <div class="tab-pane fade" id="signup" role="tabpanel" aria-labelledby="signup-tab">
          <form action="" id="user-register" enctype="multipart/form-data">
            <input type="hidden" name="id">
            <input type="hidden" name="type" value="2">
            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-info">First Name</label>
                  <input type="text" class="form-control" name="firstname" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Middle Name</label>
                  <input type="text" class="form-control" name="middlename">
                </div>
                <div class="form-group">
                  <label class="text-info">Last Name</label>
                  <input type="text" class="form-control" name="lastname" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Gender</label>
                  <select class="form-control" name="gender" required>
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="text-info">Date of Birth</label>
                  <input type="date" class="form-control" name="dob" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Contact #</label>
                  <input type="text" class="form-control" name="contact" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="text-info">Address</label>
                  <textarea class="form-control" name="address" required></textarea>
                </div>
                <div class="form-group">
                  <label class="text-info">Email</label>
                  <input type="email" class="form-control" name="username" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Password</label>
                  <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                  <label class="text-info">Confirm Password</label>
                  <input type="password" class="form-control" id="cpassword" required>
                </div>
                <div class="form-group">
                  <label>Avatar</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
                <div class="form-group d-flex justify-content-center">
                  <img src="<?php echo validate_image(''); ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                </div>
              </div>
            </div>
            <hr class="bg-light">
            <div class="row">
              <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary btn-lg rounded-pill w-50">Register</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script>
function displayImg(input,_this) {
  // alert("go on")
  if (input.files && input.files[0]) {
    const allowed = ['image/jpeg', 'image/png'];
    if (!allowed.includes(input.files[0].type)) {
      alert('Only JPG and PNG images are allowed.');
      input.value = '';
      return;
    }
    var reader = new FileReader();
    reader.onload = function (e) {
      $('#cimg').attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}
$(document).ready(function(){
  end_loader();
  $('#CTab .nav-link').click(function(){
    if($(this).attr('aria-controls') == 'signup'){
      $('.login-box').addClass('w-75')
    } else {
      $('.login-box').removeClass('w-75')
    }
  });

  $('#ulogin-frm').submit(function(e){
    e.preventDefault();
    $('.pop_msg').remove();
    start_loader();
    const _this = $(this);
    const el = $('<div>').addClass('pop_msg alert').hide();
    _this.find('button[type="submit"]').attr('disabled', true);
    $.ajax({
      url: _base_url_+'classes/Login.php?f=login_user',
      method: 'POST',
      data: _this.serialize(),
      error: err => {
        el.addClass('alert-danger').text('An Error occurred');
        _this.prepend(el);
        el.show('slow');
        $('html,body').animate({scrollTop:0},'fast');
      },
      success: function(resp){
        if(resp){
          resp = JSON.parse(resp);
          if(resp.status == 'success'){
            location.replace(_base_url_);
          } else {
            el.addClass('alert-danger').html("<i class='fa fa-exclamation-triangle'></i> Incorrect username or password");
            _this.prepend(el);
            el.show('slow');
            $('html,body').animate({scrollTop:0},'fast');
            _this.find('input').addClass('is-invalid');
            _this.find('[name="username"]').focus();
          }
        }
        _this.find('button[type="submit"]').removeAttr('disabled');
        end_loader();
      }
    });
  });

  $('#user-register').submit(function(e){
    e.preventDefault();
    $('.pop_msg').remove();
    start_loader();
    const _this = $(this);
    const el = $('<div>').addClass('pop_msg alert').hide();
    if($('#password').val() != $('#cpassword').val()){
      el.addClass('alert-danger').text('Mismatched Password.');
      _this.prepend(el);
      el.show('slow');
      $('#password,#cpassword').addClass('border-danger');
      $('html,body').animate({scrollTop:0},'fast');
      end_loader();
      return false;
    }
    if($('#password').val().length < 8){
      el.addClass('alert-danger').text('Password must be at least 8 characters long.');
      _this.prepend(el);
      el.show('slow');
      end_loader();
      return false;
    }
    $('#password,#cpassword').removeClass('border-danger');
    const formData = new FormData(_this[0]);
    $.ajax({
      url: _base_url_+"classes/Users.php?f=save",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      method: 'POST',
      type: 'POST',
      error: err => {
        el.addClass('alert-danger').text('An error occurred.');
        _this.prepend(el);
        el.show('slow');
        $('html,body').animate({scrollTop:0},'fast');
        end_loader();
      },
      success: function(resp){
        console.log(resp)
        if(resp == 1){
          alert_toast("Registration successful!",'success');
          setTimeout(()=>location.href = './login.php',1500);
        } else if(resp == 2){
          el.addClass('alert-danger').text('An error occurred.');
          _this.prepend(el);
          el.show('slow');
        } else if(resp == 3){
          el.addClass('alert-danger').text('Username already exists.');
          _this.prepend(el);
          el.show('slow');
        }
        $('html,body').animate({scrollTop:0},'fast');
        end_loader();
      }
    });
  });
});
</script>
</body>
>>>>>>> 1716a75140648167f1473cd738439f6c3c1b1e6d
</html>