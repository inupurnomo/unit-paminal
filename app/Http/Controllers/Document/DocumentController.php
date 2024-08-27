<?php

namespace App\Http\Controllers\Document;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DocumentController extends Controller
{
    public function store(Request $request, string $id) {
      DB::beginTransaction();

      try {
        //code...

        if ($request->)

        DB::commit();
      } catch (\Throwable $th) {
        throw $th;
      }
    }
}
