<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Traits\Coincap\CoincapLive;
use Illuminate\Http\Request;

class LiveRateController extends Controller
{
    use CoincapLive;

    public function index()
    {
        return $this->getLiveRate();
    }
}
