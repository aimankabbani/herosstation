<?php

namespace App\Http\Controllers;

use App\Http\Services\PhoneNumberService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $phoneNumberService;


    public function __construct(PhoneNumberService $service)
    {
        $this->phoneNumberService = $service;
    }

    public function index()
    {
        return view('admin.index');
    }

    public function reportsPage()
    {
        return view('admin.reports');
    }

    public function loadReportData(Request $request)
    {
        $filter = $request->input('filter');
        $page = $request->input('pageIndex', 1);
        $count = $request->input('pageSize', 10);
        return $this->phoneNumberService->loadReportData($filter, $page, $count);
    }
}
