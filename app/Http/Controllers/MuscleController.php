<?php

namespace App\Http\Controllers;

use App\Services\WgerApiService;
use Illuminate\Http\Request;

class MuscleController extends Controller
{
    /**
     * Returns api response of getting all muscles information 
     * @param WgerApiService $api The external api class with fetcher functions
     * @author Oriol
     * @since 20/06/2026
     */
    public function index(WgerApiService $api)
    {
        $data = $api->getAllMuscles();
        return $data['results'];
    }
}
