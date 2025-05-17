<?php
require_once '../models/customer.php';

class AuthController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer = new Customer();
            $user = $customer->login($_POST['email'], $_POST['password']);
            if ($user) {
                session_start();
                $_SESSION['user'] = $user;
                header("Location: /eComWebSite/TestMVC/Public/products");
                exit;
            } else {
                $error = "Invalid credentials";
            }
        }
        require '../Views/login.php';
    }

    public function logout() {
        session_start();
        // clear the user session
        unset($_SESSION['user']);
        // (optionally) destroy the entire session:
        // session_destroy();
        // redirect back to shop or home
        header("Location: products");
        exit;
    }

    // public function register() {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $customer = new Customer();
    //         $customer->register($_POST);
    //         $user = $customer->getByEmail($_POST['email']);

    //         // 3) Store in session
    //         $_SESSION['user'] = $user;
    //         header("Location: /eComWebSite/TestMVC/Public/products");
    //         exit;
    //     }
    //     require '../Views/register.php';
    // }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            session_start();

            $cust = new Customer();
            // Pass the entire $_POST through; our model will pick out the needed keys.
            $ok = $cust->register($_POST);

            if ($ok) {
                // Auto‑login:
                $user = $cust->getByEmail($_POST['email']);
                $_SESSION['user'] = $user;

                // Redirect to shop:
                header("Location: products");
                exit;
            } else {
                $error = "Registration failed; email may already be in use.";
            }
        }
        // require __DIR__ . '/../views/auth/register.php';
        require '../Views/register.php';
    }
}
?>