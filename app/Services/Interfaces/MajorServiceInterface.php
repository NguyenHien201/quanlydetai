<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface MajorServiceInterface
 * @package App\Services\Interfaces
 */
interface MajorServiceInterface
{
    public function paginate(Request $request);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function destroy(int $id);
}
