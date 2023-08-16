<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class Hbv2RedisController extends Controller
{
    public function setData(Request $request)
    {
        $qString = $request->query();
        if (empty($qString))
            return response()->json(['message' => 'No query string found.'], 404);

        $data = Redis::get("payload");
        if(!empty($data)) {
            $data = json_decode($data, true);
            array_push($data, $qString);
        } else {
            $data = [$qString];
        }

        return Redis::set("payload", json_encode($data)) ? response()->json(['message' => 'Success']) : response()->json(['message' => 'failed'], 400);
    }

    public function getData()
    {
        $data = Redis::get("payload");
        return response()->json(json_decode($data));
    }
}
