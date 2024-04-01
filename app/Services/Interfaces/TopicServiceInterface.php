<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface TopicServiceInterface
 * @package App\Services\Interfaces
 */
interface TopicServiceInterface
{

    public function paginate(Request $request);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function destroy(int $id);
}
