<!-- <?php // include 'layout/header.php'; ?>
<h2>Register</h2>
<form method="POST">
    <label>Name:</label><input type="text" name="name" required>
    <label>Email:</label><input type="email" name="email" required>
    <label>Password:</label><input type="password" name="password" required>
    <button type="submit">Register</button>
</form>
<?php //include 'layout/footer.php'; ?> -->




<?php require 'layout/header.php'; ?>

<h2>Register</h2>
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
</form>

<?php require 'layout/footer.php'; ?>
