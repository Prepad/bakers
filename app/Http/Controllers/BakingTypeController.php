<?php

namespace App\Http\Controllers;

use App\Http\Requests\BakingTypeRequest;
use App\Http\Resources\BakingTypeResource;
use App\Models\BakingType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BakingTypeController extends Controller
{
    /**
     * @param BakingTypeRequest $request
     * @return BakingTypeResource
     */
    public function makeBakingType(BakingTypeRequest $request): BakingTypeResource
    {
        $user = Auth::getUser();
        $bakingType = new BakingType();
        $bakingType->name = $request->getName();
        $bakingType->abstract_baking_type_id = $request->getAbstractBakingType();
        $bakingType->user_id = $user->id;
        $bakingType->save();

        return BakingTypeResource::make($bakingType);
    }
}
