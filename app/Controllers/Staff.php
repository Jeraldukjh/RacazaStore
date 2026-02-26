<?php

namespace App\Controllers;

class Staff extends BaseController
{
    public function dashboard()
    {
        // Check if staff is logged in
        if (!session()->get('staff_id')) {
            return redirect()->to('/login');
        }
        
        $data['username'] = session()->get('staff_username');
        return view('staff/dashboard', $data);
    }
}
