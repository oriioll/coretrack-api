<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WgerApiService
{
    private string $BASE_URL = "https://wger.de/api/v2";

    /**
     * Fetch all muscles from wger fitness API
     * @author Oriol Plazas
     * @since 20/06/2026
     */
    public function getAllMuscles()
    {
        $response = Http::get($this->BASE_URL . '/muscle');
        return $response->json();
    }

    public function getExercisesByMuscleId(int $id)
    {
        $response = Http::get($this->BASE_URL . '/exerciseinfo/', [
            'muscles' => $id,
            'language' => 2
        ]);
        return $response->json();
    }
}
