<?php //include 'layout/header.php'; ?>
<!-- <h2>Login</h2>
<form method="POST">
    <label>Email:</label><input type="email" name="email" required>
    <label>Password:</label><input type="password" name="password" required>
    <button type="submit">Login</button>
    <p>new to QuickCart? <a>register</a></p>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</form> -->
<?php //include 'layout/footer.php'; ?>


<?php
// app/views/auth/login.php
?>
<?php
// app/views/auth/login.php
?>
<?php
// app/views/auth/login.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login — QuickCart</title>
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
      <h2>Login</h2>
      <p class="subtitle">Enter your credentials to sign in.</p>
      <form method="POST" action="login">
        <div class="form-group">
          <label for="email">Email</label>
          <input id="email" name="email" type="email" placeholder="Enter email" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input id="password" name="password" type="password" placeholder="Enter password" required>
        </div>
        <button type="submit">Log in</button>
      </form>
      <div class="switch">
        Don’t have an account? <a href="register">Register</a>.
      </div>
    </div>
  </div>
  <div class="auth-footer">QuickCart</div>
</body>
</html>

