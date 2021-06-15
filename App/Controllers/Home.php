<?php

/**
 * 
 */
class Home extends Controller
{
    public function index()
    {
        $data['active'] = 'dashboard';
        $data['title'] = 'Dashboard';
        if (!isset($_SESSION['nama'])) {
            $this->view('templates/header', $data);
            $this->view('welcome', $data);
            $this->view('templates/footer');
        } else {
            $this->redirect('/User/dashboard');
        }
    }
    public function login()
    {
        $data['title'] = 'Login';

        $this->view('templates/auth/header', $data);
        $this->view('login');
        $this->view('templates/auth/footer');
    }
    public function register()
    {
        $data['title'] = 'Register';

        $this->view('templates/auth/header', $data);
        $this->view('register');
        $this->view('templates/auth/footer');
    }
}
