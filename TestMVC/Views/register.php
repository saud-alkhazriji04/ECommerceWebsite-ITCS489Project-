<!-- <?php // include 'layout/header.php'; ?>
<h2>Register</h2>
<form method="POST">
    <label>Name:</label><input type="text" name="name" required>
    <label>Email:</label><input type="email" name="email" required>
    <label>Password:</label><input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
<?php //include 'layout/footer.php'; ?> -->




<?php //require 'layout/header.php'; ?>

<!-- <h2>Register</h2>
<form method="POST" action="register">
  <label>Name:</label>
  <input type="text" name="name" required>

  <label>Email:</label>
  <input type="email" name="email" required>

  <label>Password:</label>
  <input type="password" name="password" required>

  <label>Phone Number:</label>
  <input type="text" name="phoneNumber">

  <label>Date of Birth:</label>
  <input type="date" name="dateOfBirth">

  <label>Block:</label>
  <input type="text" name="block">

  <label>Road:</label>
  <input type="text" name="road">

  <label>House Number:</label>
  <input type="text" name="houseNumber">

  <button type="submit">Register</button>
</form> -->

<?php //require 'layout/footer.php'; ?>


<?php
// app/views/auth/login.php
?>
<?php
// app/views/auth/login.php
?>
<?php
// app/views/auth/register.php
?>
<?php
// app/views/auth/register.php
?>
<?php
// app/views/auth/register.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register — QuickCart</title>
  <style>
    /* Reset & Base */
    * { box-sizing: border-box; margin:0; padding:0; }
    body { font-family: Arial, sans-serif; background:#f7fafc; color:#2d3748; }

    /* Centered Card */
    .auth-container {
      min-height:90vh;
      display:flex; align-items:center; justify-content:center;
      padding:1rem;
    }
    .auth-card {
      background:#fff;
      border:1px solid #e2e8f0;
      border-radius:8px;
      box-shadow:0 4px 8px rgba(0,0,0,0.05);
      padding:2rem;
      max-width:400px;
      width:100%;
    }
    .auth-card h2 {
      text-align:center; margin-bottom:0.5rem; font-size:1.5rem;
    }
    .auth-card .subtitle {
      text-align:center; color:#4a5568; margin-bottom:1.5rem;
      font-size:0.95rem;
    }

    /* Form Layout */
    .auth-card form { display:flex; flex-direction:column; }
    .form-group {
      display:flex; flex-direction:column; margin-bottom:1rem;
    }
    .form-group label {
      font-weight:600; margin-bottom:0.25rem; font-size:0.95rem;
    }
    .form-group input {
      padding:0.75rem 1rem;
      border:1px solid #e2e8f0;
      border-radius:4px;
      background:#edf2f7;
      font-size:1rem;
    }
    .form-group input:focus {
      outline:none; border-color:#ff6600; background:#fff;
    }

    /* Button */
    .auth-card button {
      padding:0.75rem;
      background:#ff6600; color:#fff;
      border:none; border-radius:4px;
      font-size:1rem; font-weight:600;
      cursor:pointer; transition:background 0.2s;
      margin-top:0.5rem;
    }
    .auth-card button:hover { background:#e65500; }

    /* ===== Guest link styling (same as switch) ===== */
    .auth-guest {
      text-align: center;
      margin: 1rem 0;
    }
    .guest-link {
      color: #ff6600;
      font-size: 0.9rem;
      text-decoration: none;
    }
    .guest-link:hover {
      text-decoration: underline;
      color: #e65500;
    }


    /* Switch link */
    .switch {
      text-align:center; margin-top:1rem;
      font-size:0.9rem;
    }
    .switch a { color:#ff6600; }

    /* Footer branding */
    .auth-footer {
      text-align:center; margin-top:0rem;
      font-size:3rem; font-weight:bold; color:#ff6600;
    }
  </style>
</head>
<body>
  <div class="auth-container">
    <div class="auth-card">
      <h2>Register</h2>
      <p class="subtitle">Kindly fill in this form to register.</p>
      <form method="POST" action="register">
        <div class="form-group">
          <label for="name">Name</label>
          <input id="name" name="name" type="text" placeholder="Enter your name" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Enter your password" required>
        </div>

        <!-- <div class="form-group">
          <label for="password2">Repeat Password</label>
          <input id="password2" name="password2" type="password" placeholder="Repeat your password" required>
        </div> -->

        <div class="form-group">
          <label for="phoneNumber">Phone Number</label>
          <input id="phoneNumber" name="phoneNumber" type="text" placeholder="Enter phone number" required>
        </div>

        <div class="form-group">
          <label for="dateOfBirth">Date of Birth</label>
          <input id="dateOfBirth" name="dateOfBirth" type="date" required>
        </div>

        <div class="form-group">
          <label for="block">Block</label>
          <input id="block" name="block" type="text" placeholder="Enter block" required>
        </div>

        <div class="form-group">
          <label for="road">Road</label>
          <input id="road" name="road" type="text" placeholder="Enter road" required>
        </div>

        <div class="form-group">
          <label for="houseNumber">House Number</label>
          <input id="houseNumber" name="houseNumber" type="text" placeholder="Enter house number" required>
        </div>

        <button type="submit">Register</button>
      </form>

      <div class="auth-guest">
        <a href="products" class="guest-link">Continue as Guest</a>
      </div>

      <div class="switch">
        Already have an account? <a href="login">Log in</a>.
      </div>
    </div>
  </div>
  <div class="auth-footer">QuickCart</div>
</body>
</html>




