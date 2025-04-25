<?php

namespace App\Services;

use App\Models\Vahed;

class DataServices
{
    public function getAllData()
    {
        $vaheds = Vahed::with([
            'otaghs.takhts.resident.infoResident'
        ])->get();

        $data = [];

        foreach ($vaheds as $vahed) {
            $vahedData = [
                'vahed_id' => $vahed->id,
                'vahed_name' => $vahed->name,
                'otaghs' => [],
            ];

            foreach ($vahed->otaghs as $otagh) {
                $otaghData = [
                    'otagh_id' => $otagh->id,
                    'otagh_name' => $otagh->name,
                    'otagh_vahedID' => $otagh->vahed_id,
                    'takhts' => [],
                ];

                foreach ($otagh->takhts as $takht) {
                    $takhtData = [
                        'takht_id' => $takht->id,
                        'takht_name' => $takht->name,
                        'state' => $takht->state,
                        'resident' => null,
                    ];

                    if ($takht->resident) {
                        $resident = $takht->resident;
                        $info = $resident->infoResident;

                        $takhtData['resident'] = [
                            'resident_id' => $resident->id,
                            'full_name' => $resident->full_name,
                            'phone' => $resident->phone,
                            'start_date' => $resident->start_date,
                            'end_date' => $resident->end_date,
                            'info' => $info ? [
                                'description' => $info->description,
                                'vadeh' => $info->vadeh,
                                'ejareh' => $info->ejareh,
                                'madrak' => $info->madrak,
                                'has_phone' => $info->has_phone,
                                'state_stay' => $info->state_stay,
                                'bedehy' => $info->bedehy,
                                'form' => $info->form,
                                'hamahang' => $info->hamahang,
                                'state_colty' => $info->state_colty,
                                'job' => $info->job,
                                'age' => $info->age,
                                'takhir' => $info->takhir,
                            ] : null
                        ];
                    }

                    $otaghData['takhts'][] = $takhtData;
                }

                $vahedData['otaghs'][] = $otaghData;
            }

            $data[] = $vahedData;
        }
        return $data;
    }

    public function getResidents($data)
    {
        $residents = [];

        foreach ($data as $vahed) {
            foreach ($vahed['otaghs'] as $otagh) {
                foreach ($otagh['takhts'] as $takht) {
                    if (!empty($takht['resident'])) {
                        $resident = $takht['resident'];
                        $flattened = [
                            'resident_id' => $resident['resident_id'],
                            'full_name' => $resident['full_name'],
                            'phone' => $resident['phone'],
                            'start_date' => $resident['start_date'],
                            'end_date' => $resident['end_date'],
                        ];

                        if (!empty($resident['info'])) {
                            $flattened = array_merge($flattened, $resident['info']);
                        }

                        $residents[] = $flattened;
                    }
                }
            }
        }

        return $residents;
    }
}
