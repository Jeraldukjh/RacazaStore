<?php

namespace App\Controllers;

use App\Models\SaleModel;

class Staff extends BaseController
{
    public function dashboard()
    {
        // Check if staff is logged in
        if (!session()->get('staff_id')) {
            return redirect()->to('/login');
        }

        $saleModel = new SaleModel();

        $data['username'] = session()->get('staff_username');
        $data['overallSummary'] = $saleModel->getOverallSalesSummary();
        $data['todaySummary'] = $saleModel->getTodaySalesSummary();

        return view('staff/dashboard', $data);
    }
}
