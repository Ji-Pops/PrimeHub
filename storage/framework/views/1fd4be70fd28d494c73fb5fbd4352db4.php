<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - PrimeHub</title>
  <link rel="stylesheet" href="<?php echo e(asset('css/loginStyles.css')); ?>">
</head>
<body>
<header class="header">
  <div class="logo-holder">
    <div class="logo">
    <img src="<?php echo e(asset('images/phlogo.png')); ?>" alt="PrimeHub Logo">
    </div>
    <h1>PrimeHub</h1>
  </div>
</header>

<div class="content">
  <div class="card">
    <h2>Sign-in</h2>
    <form action="<?php echo e(route('login')); ?>" method="POST">
      <?php echo csrf_field(); ?>
      <div class="form-group">
        <label class="label" for="username">Username:</label>
        <input class="input" type="text" name="username" id="username" required>
      </div>
      <div class="form-group">
        <label class="label" for="password">Password:</label>
        <div class="input-container">
          <input class="input" type="password" name="password" id="password" required>
          <img class="eye-icon" src="https://img.icons8.com/material-outlined/24/000000/visible--v1.png">
        </div>
      </div>
      <input class="login-btn" type="submit" name="login" value="Sign-in">
    </form>
  </div>
  <div class="error-message" id="error-message" style="display: none; color: red;"></div>
</div>

<script>
const eyeIcon = document.querySelector('.eye-icon');
const passwordInput = document.querySelector('#password');
eyeIcon.addEventListener('click', () => {
  if (passwordInput.type === 'password') {
    passwordInput.type = 'text';
    eyeIcon.src = 'https://img.icons8.com/material-outlined/24/000000/invisible--v1.png';
  } else {
    passwordInput.type = 'password';
    eyeIcon.src = 'https://img.icons8.com/material-outlined/24/000000/visible--v1.png';
  }
});
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
    // Check if there are any errors in the session (from failed login attempt)
    <?php if($errors->any()): ?>
      displayErrorMessage("Invalid username or password.");
    <?php endif; ?>

    // Function to display the error message
    function displayErrorMessage(message) {
      var errorMessage = $('#error-message');
      errorMessage.text(message);
      errorMessage.show();

      // Automatically hide the error message after 2 seconds
      setTimeout(function() {
        errorMessage.hide();
      }, 2000);
    }
  });
</script>

</body>
</html>
<?php /**PATH C:\Users\gamev\OneDrive\Desktop\PrimeHub\PrimeHub\resources\views/auth/login.blade.php ENDPATH**/ ?>