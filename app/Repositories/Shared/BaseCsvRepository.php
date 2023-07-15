<?php

declare(strict_types=1);

namespace App\Repositories\Shared;

use Cache;

abstract class BaseCsvRepository
{
    protected array $data = [];
    const CSV_PATH = 'app/csv/data.csv';
    const CACHE_KEY = 'csv_data_cache';
    const LAST_MODIFIED_CACHE_KEY = 'csv_last_modified';

    public function __construct()
    {
        $this->loadData();
    }

    private function loadData(): void
    {
        $lastModified = Cache::get(self::LAST_MODIFIED_CACHE_KEY);
        $csvFile = storage_path(self::CSV_PATH);

        if (file_exists($csvFile)) {
            $fileLastModified = filemtime($csvFile);

            if (!$lastModified || $fileLastModified > $lastModified) {
                $this->mountData();
                Cache::put(self::CACHE_KEY, $this->data);
                Cache::put(self::LAST_MODIFIED_CACHE_KEY, $fileLastModified);
            } else {
                $this->data = Cache::get(self::CACHE_KEY);
                Cache::put(self::LAST_MODIFIED_CACHE_KEY, $fileLastModified); // Actualizar el tiempo de modificación
            }
        }
    }

    private function mountData(): void
    {
        $csvFile = storage_path(self::CSV_PATH);
        $index = [];
        if (($handle = fopen($csvFile, 'r')) !== false) {
            $header = fgetcsv($handle, 0, ';');

            while (($data = fgetcsv($handle, 0, ';')) !== false) {
                $user = trim($data[1], "\"");
                $property = trim($data[2], "\"");

                if (!isset($index[$user])) {
                    $index[$user] = array(
                        'user_id' => $user,
                        'user_name' => trim($data[0], "\""),
                        'accommodations' => []
                    );
                }

                $rowData = array_combine($header, $data);
                unset($rowData['user_id']);
                unset($rowData['user_name']);

                $index[$user]['accommodations'][] = $rowData;
            }

            fclose($handle);
        }
        $this->data = $index;
    }

    protected function formatData(array $data): array
    {
        $accommodations = $data['accommodations'] ?? [];
        $formattedData = [
            'id' => $data['user_id'],
            'name' => $data['user_name'],
            'accommodations' => []
        ];

        foreach ($accommodations as $accommodation) {
            $formattedAccommodation = [];
            foreach ($accommodation as $key => $value) {
                if (is_numeric($value)) {
                    $value = intval($value);
                }
                $newKey = str_replace('accommodation_', '', $key);
                if ($key == 'last_update')
                    $newKey = 'updated_at';

                if ($newKey == 'distribution') {
                    $formattedAccommodation[$newKey] = $this->formatDistributionData($value);
                } else {
                    $formattedAccommodation[$newKey] = $value;
                }
            }
            $formattedData['accommodations'][] = $formattedAccommodation;
        }

        return $formattedData;
    }


    private function formatDistributionData(string $distribution_json = ''): array
    {
        $result = [];
        if (!empty($distribution_json)) {
            $distribution = json_decode($distribution_json, true);
            $bedrooms = 0;
            $beds = 0;
            foreach ($distribution['bed_rooms'] as $bedroom) {
                $bedrooms++;
                foreach ($bedroom as $bed) {
                    $beds += intval($bed);
                }
            }
            $result = [
                'living_rooms' => $distribution['living_rooms'],
                'bed_rooms' => $bedrooms,
                'beds' => $beds
            ];
        }
        return $result;
    }
}
