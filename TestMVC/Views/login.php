<?php include 'layout/header.php'; ?>
<h2>Login</h2>
<form method="POST">
    <label>Email:</label><input type="email" name="email" required>
    <label>Password:</label><input type="password" name="password" required>
    <button type="submit">Login</button>
    <?php if (!empty($error)) echo "<p>$error</p>"; ?>
</form>
<?php include 'layout/footer.php'; ?>
