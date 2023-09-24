<?php

namespace App\Http\Controllers;

use App\Http\Resources\AbstractBakingTypeResource;
use App\Models\AbstractBakingType;
use Illuminate\Http\Request;

class AbstractBakingTypeController extends Controller
{
    /**
     * @return AbstractBakingTypeResource
     */
    public function list(): AbstractBakingTypeResource
    {
        return AbstractBakingTypeResource::make(AbstractBakingType::all());
    }
}
