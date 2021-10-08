<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lga;
use App\Community;

class StateLgaController extends Controller
{
    /**
     * Get lgas that belong to particular state
     */
    public function getLga(Request $request)
    {
        $data['lgas'] = Lga::where("state_id", $request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
    /**
    * Get communities that belong to particular state
    */
    public function getCommunity(Request $request)
    {
        $data['communities'] = Community::where("state_id", $request->state_id)
                    ->get(["name","id"]);
        return response()->json($data);
    }
}
