<?php

namespace App\Http\Controllers;

use App\Http\Requests\BakingTypeRequest;
use App\Http\Requests\MakeBakeRequest;
use App\Http\Resources\BakingTypeResource;
use App\Http\Resources\MakeBakeResource;
use App\Models\Bake;
use App\Models\BakingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BakesController extends Controller
{
    public function makeBake(MakeBakeRequest $request)
    {
        $bake = new Bake();
        $bake->count = $request->getCount();
        $bake->user_id = Auth::getUser()->id;
        $bake->baking_type_id = $request->getBakingType();
        $bake->save();
        return MakeBakeResource::make($bake);
    }

    public function bakeList(Request $request)
    {
        $bakes = Bake::paginate(10);
        return MakeBakeResource::make($bakes);
    }
}
