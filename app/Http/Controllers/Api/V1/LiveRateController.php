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
        $result = $this->getLiveAssets();
        return response($result, 200);
    }

    public function show($id)
    {
        $result = $this->getSingleAsset($id);

        return response($result, 200);
    }
}
