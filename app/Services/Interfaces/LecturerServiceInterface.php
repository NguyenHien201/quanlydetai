<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

/**
 * Interface LecturerServiceInterface
 * @package App\Services\Interfaces
 */
interface LecturerServiceInterface
{
    public function paginate(Request $request);

    public function create(Request $request);

    public function update(Request $request, $id);

    public function destroy(int $id);
}
