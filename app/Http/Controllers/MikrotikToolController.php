<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MikrotikToolController extends Controller
{
    public function index()
    {
        return view('frontend.tools.mikrotik.index');
    }

    public function ecmp()
    {
        return view('frontend.tools.mikrotik.ecmp');
    }

    public function nth()
    {
        return view('frontend.tools.mikrotik.nth');
    }

    public function pcc()
    {
        return view('frontend.tools.mikrotik.pcc');
    }

    public function failover()
    {
        return view('frontend.tools.mikrotik.failover');
    }

    public function simpleQueue()
    {
        return view('frontend.tools.mikrotik.simple-queue');
    }

    public function hotspot()
    {
        return view('frontend.tools.mikrotik.hotspot');
    }

    public function subnetCalculator()
    {
        return view('frontend.tools.mikrotik.subnet-calculator');
    }

    public function wireguard()
    {
        return view('frontend.tools.mikrotik.wireguard');
    }

    public function dhcpServer()
    {
        return view('frontend.tools.mikrotik.dhcp-server');
    }
}
