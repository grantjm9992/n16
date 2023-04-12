<?php

namespace App\Http\Controllers;

use App\Services\GoogleApiService;
use DateTime;
use Illuminate\Http\JsonResponse;
use Ramsey\Uuid\Uuid;

class GroupController extends Controller
{
    private const MAPPING_ARRAY = [
        0 => 'name',
        1 => 'step',
        2 => 'course',
        3 => 'group_type',
        4 => 'date_start',
        5 => 'date_end',
        6 => 'days_of_the_week',
        7 => 'teaching_hours',
        8 => 'status',
        9 => 'students',
        10 => 'company',
        11 => 'id',
        12 => 'source',
        13 => 'start_time',
        14 => 'end_time',
    ];

    private const DAY_SPANISH_INITIAL_TO_NUMBER = [
        'L' => 1,
        'M' => 2,
        'X' => 3,
        'J' => 4,
        'V' => 5,
        'S' => 6,
    ];

    private const COVERT_ARRAY = [
        'date_start' => 'dateConvert',
        'date_end' => 'dateConvert',
        'days_of_the_week' => 'dayOfTheWeekConvert',
    ];

    public function __construct(
        private readonly GoogleApiService $service
    ) {
    }

    public function index(): JsonResponse
    {
        $sheetValues = $this->service->__invoke();

        return new JsonResponse([
            'data' => $this->convertToArray($sheetValues),
            'status' => 'success',
        ]);
    }

    private static function dayOfTheWeekConvert(string $daysOfTheWeek): array
    {
        $daysOfTheWeekArray = explode(',', $daysOfTheWeek);
        $returnArray = [];
        foreach ($daysOfTheWeekArray as $dayOfTheWeek) {
            $returnArray[] = self::DAY_SPANISH_INITIAL_TO_NUMBER[$dayOfTheWeek];
        }

        return $returnArray;
    }

    private static function dateConvert(string $date): string
    {
        $date = DateTime::createFromFormat('d/m/Y', $date);
        return $date->format('Y-m-d');
    }

    private static function convertToArray(array $sheetValues): array
    {
        $returnArray = [];
        $i = 0;
        foreach ($sheetValues as $row) {
            if ($i > 0) {
                $j = 0;
                $rowArray = [];
                foreach ($row as $field) {
                    $key = self::MAPPING_ARRAY[$j];
                    if (array_key_exists($key, self::COVERT_ARRAY)) {
                        $method = self::COVERT_ARRAY[$key];
                        $field = self::$method($field);
                    }
                    $rowArray[$key] = $field;
                    $j++;
                }
                $returnArray[] = $rowArray;
            }
            $i++;
        }
        return $returnArray;
    }
}
