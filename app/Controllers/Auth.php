<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('admin_id')) {
            return redirect()->to('/dashboard');
        }
        
        return view('auth/login');
    }
    
    public function authenticate()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        
        $adminModel = new AdminModel();
        $admin = $adminModel->getAdmin($username);
        
        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'admin_id' => $admin['id'],
                'username' => $admin['username']
            ]);
            return redirect()->to('/dashboard')->with('success', 'Login successful!');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid username or password');
        }
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully!');
    }
}
