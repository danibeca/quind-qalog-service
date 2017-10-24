<?php

namespace App\Http\Controllers\QualitySystem;

use App\Http\Controllers\ApiController;
use App\Models\QualitySystem\QualitySystem;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class QualitySystemController extends ApiController
{
    public function index()
    {
        return $this->respondData(QualitySystem::where('active', true)->get());
    }


}
