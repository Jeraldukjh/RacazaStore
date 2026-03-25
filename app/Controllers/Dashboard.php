<?php

namespace App\Controllers;

use App\Models\SaleModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('admin_id')) {
            return redirect()->to('/login');
        }

        $saleModel = new SaleModel();

        $data['username'] = session()->get('username');
        $data['overallSummary'] = $saleModel->getOverallSalesSummary();
        $data['todaySummary'] = $saleModel->getTodaySalesSummary();

        return view('admin/dashboard', $data);
    }
}
