<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpController extends Controller
{
    public function getIp() {
        $arr_ip = geoip()->getLocation(geoip()->getClientIP());
        echo geoip()->getClientIP();
        echo $arr_ip->country;
        echo $arr_ip->currency;
    }
}
