<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }
        
        $data['username'] = session()->get('username');
        
        return view('admin/dashboard', $data);
    }
}
