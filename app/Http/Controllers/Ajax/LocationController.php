<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\DistrictRepositoryInterface as DistrictRepository;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;

class LocationController extends Controller
{
    protected $districRepository;
    protected $provinceRepository;
    public function __construct(
        DistrictRepository $districRepository,
        ProvinceRepository $provinceRepository
        ) {
        $this->districRepository = $districRepository;
        $this->provinceRepository = $provinceRepository;
    }

    public function getLocation(Request $request) {
        // $province_id = $request->input('province_id');
        $get = $request->input();

        $html = '';
        if($get['target'] == 'districts') {
            $province = $this->provinceRepository->findById($get['data']['location_id'], 
            ['code','name'], ['districts']);
            $html = $this->renderHtml($province->districts);
        }else if($get['target'] == 'wards') {
            $district = $this->districRepository->findById($get['data']['location_id'],
            ['code', 'name'], ['wards']);
            $html = $this->renderHtml($district->wards, '[Chọn Phường/Xã]');
        }

        // $districts = $province->districts->toArray();
        // $districts = $this->districRepository->findDistricByProvinceId($province_id);
        $reponse = [
            'html' => $html
        ];
        return response()->json($reponse);
        
    }

    public function renderHtml($districts, $root = '[Chọn Quận/Huyện]') {
        $html = '<option value="0">'.$root.'</option>';
        foreach($districts as $district) {
            $html .= '<option value="'.$district->code.'">'.$district->name.'</option>';
        }
        return $html;
    }
}
