<!-- <!DOCTYPE html>
<html>
<head>
    <title>QuickCart</title>
    <link rel="stylesheet" href="/eComWebSite/TestMVC/Public/assets/style.css">

</head>
<body>
<header>
    <h1>QuickCart</h1>
    <nav>
        <a href="/">Home</a>
        <a href="/products">Shop</a>
        <a href="/login">Login</a>
    </nav>
</header>
<main> -->

<!-- <?php
$baseURL = '/eComWebSite/TestMVC/Public';
?>
<!DOCTYPE html>
<html>
<head>
    <title>QuickCart</title>
    <link rel="stylesheet" href="<?= $baseURL ?>/assets/style.css">
</head>
<body>
<header>
    <h1>QuickCart</h1>
    <nav>
        <a href="<?= $baseURL ?>/">Home</a>
        <a href="<?= $baseURL ?>/products">Shop</a>
        <a href="<?= $baseURL ?>/login">Login</a>
    </nav>
</header>
<main> -->


<?php
    $baseURL = '/eComWebSite/TestMVC/Public';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>QuickCart</title>
  <link rel="stylesheet" href="<?= $baseURL ?>/assets/style.css">
  <style>
    /* ===== Header Styles ===== */
    * { margin:0; padding:0; box-sizing:border-box; }
    body { font-family: Arial, sans-serif; background: #f7fafc; color: #2d3748; }
    header {
      background: #fff;
      padding: 1rem 2rem;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header h1 {
      font-size: 1.5rem;
      color: #ff6600;
    }
    nav a {
      margin-left: 1.5rem;
      font-size: 1rem;
      color: #4a5568;
      transition: color .2s;
    }
    nav a:hover {
      color: #ff6600;
    }
    main {
      padding: 2rem;
    }
  </style>
</head>
<body>
  <header>
    <h1>QuickCart</h1>
    <nav>
      <a href="/eComWebSite/TestMVC/Public/products">Home</a>
      <a href="/eComWebSite/TestMVC/Public/cart">My Cart</a>
      <a href="/eComWebSite/TestMVC/Public/login">Login</a>
    </nav>
  </header>
  <main>
