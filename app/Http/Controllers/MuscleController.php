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

    public function showExercisesByMuscles(WgerApiService $api, int $muscleId)
    {
        $data = $api->getExercisesByMuscleId($muscleId);
        if (!is_array($data) || !isset($data['results'])) {
            return response()->json([
                'success' => false,
                'message' => 'La API devolvió un formato inesperado.'
            ], 500);
        }
        $exercises = collect($data['results'])->map(function ($exercise) {
            $englishName = 'Unknown Exercise';
            if (isset($exercise['translations']) && is_array($exercise['translations'])) {
                foreach ($exercise['translations'] as $translation) {
                    if (isset($translation['language']) && $translation['language'] === 2) {
                        $englishName = $translation['name'] ?? 'Unknown Exercise';
                        break;
                    }
                }
            }
            $image = null;
            if (!empty($exercise['images']) && isset($exercise['images'][0]['image'])) {
                $image = $exercise['images'][0]['image'];
            }
            return [
                'id' => $exercise['id'],
                'name' => $englishName,
                'image' => $image,
            ];
        });
        return response()->json([
            'success' => true,
            'muscle_id' => $muscleId,
            'data' => $exercises
        ]);
    }
}
