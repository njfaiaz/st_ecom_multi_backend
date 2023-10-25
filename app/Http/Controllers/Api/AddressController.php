<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\AddressUpdateRequest;
use App\Http\Requests\AddressStoreRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\CityResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\City;

class AddressController extends Controller
{
    public function index()
    {
        $address = UserAddress::where('user_id', auth()->id())->where('is_active', true)->get();

        return apiResponse(AddressResource::collection($address));
    }

    public function store(AddressStoreRequest $request)
    {
        auth()->user()->addresses()->create($request->validated());

        return successResponse('Address added successfully');
    }

    public function update(AddressUpdateRequest $request, UserAddress $address)
    {
        if($address->user_id != auth()->id()) {
            return errorResponse('Permission denied', 403);
        }

        $address->update($request->validated());

        return successResponse('Address updated successfully');
    }

    public function destroy(UserAddress $address)
    {
        if($address->user_id != auth()->id()) {
            return errorResponse('Address not found!', 403);
        }

        $address->is_active = false;
        $address->save();

        return successResponse('Address deleted.');
    }

    public function city(){
        $cities = City::where('is_active', true)->get();

        return apiResourceResponse(CityResource::collection($cities), 'City list');
    }

}
