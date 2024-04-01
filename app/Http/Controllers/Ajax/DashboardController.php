<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    protected $userService;

    public function __construct(
    ) {
        
    }

    public function changeStatus(Request $request) {
        $post = $request->input();
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model'] . 'service');

        if(class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        return $serviceInstance->updateStatus($post);
    }

    public function changeStatusAll(Request $request) {
        $post = $request->input();
        $serviceInterfaceNamespace = 'App\Services\\' . ucfirst($post['model'] . 'service');

        if(class_exists($serviceInterfaceNamespace)) {
            $serviceInstance = app($serviceInterfaceNamespace);
        }

        $flag = $serviceInstance->updateStatusAll($post);

        return response()->json(['flag' => $flag]);
    }
}
