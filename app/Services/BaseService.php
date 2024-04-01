<?php

namespace App\Services;

use Carbon\Carbon;
use Faker\Extension\Extension;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

/**
 * Class BaseService
 * @package App\Services
 */
class BaseService
{
    public function uploadFile($files, $newFolder = null): array 
    {
        try {
            $imagePath = $files;
            $imageName = $imagePath->getClientOriginalName();
            $fileName = explode('.', $imageName)[0];
            $extension = $imagePath->getClientOriginalExtension();
                $picName = Str::slug(time().'_'.$fileName, '_').'.'. $extension;
                $folder = $newFolder ? 'uploads/'.$newFolder : 'uploads';
                $path = $files->storeAs($folder, $picName, 'public');
            return [
                "name" => $fileName.".".$extension,
                "path" => $path
            ];
            
        }catch(Extension $e) {
            Log::error($e);
            throw $e;
        }
    }

    public function convertDate($data = '') {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $data);
        $data = $carbonDate->format('Y-m-d');
        return $data;
    }

    public function convertDateFromVN($data = '') {
        $carbonDate = Carbon::createFromFormat('Y-m-d', $data);
        $data = $carbonDate->format('d/m/Y');
        return $data;
    }
}
