<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffModel;

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
        }

        $staffModel = new StaffModel();
        $staff = $staffModel->getStaff((string) $username);

        if ($staff && password_verify((string) $password, $staff['password'])) {
            session()->set([
                'staff_id' => $staff['id'],
                'staff_username' => $staff['username'],
            ]);
            return redirect()->to('/staff/dashboard')->with('success', 'Login successful!');
        }

        return redirect()->to('/login')->with('error', 'Invalid username or password');
    }
    
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Logged out successfully!');
    }
}
