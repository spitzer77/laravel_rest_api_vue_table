<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Estate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EstateController extends Controller
{
    public function getData(Request $request)
    {
        $input = [
            'name' => 'nullable|string|regex:/(^([a-zA-z]+)?$)/u',
            'price_from' => 'nullable|integer',
            'price_to' => 'nullable|integer',
            'bedrooms' => 'nullable|integer',
            'bathrooms' => 'nullable|integer',
            'storeys' => 'nullable|integer',
            'garages' => 'nullable|integer',
            'sortBy' => 'nullable|string|in:asc,desc',
            'sortDirection' => 'nullable|string|in:name,price,bedrooms,bathrooms,storeys,garages'
        ];

        $messages = [
            'name.regex' => 'Invalid field name',
            'price_from.integer' => 'Price_from must be an integer',
            'price_to.integer' => 'Price_to must be an integer',
            'bedrooms.integer' => 'Bedrooms must be an integer',
            'bathrooms.integer' => 'Bathrooms must be an integer',
            'storeys.integer' => 'Storeys must be an integer',
            'garages.integer' => 'Garages must be an integer',
            'sortBy.in' => 'This sortBy param is declined',
            'sortDirection.in' => 'This sortDirection is declined',
        ];

        $validation = Validator::make($request->all(), $input, $messages);

        $validation->after(function ($validator) use ($request, $input) {
            $extraFields = array_diff(array_keys($request->all()), array_keys($input));

            foreach ($extraFields as $field) {
                $validator->errors()->add($field, "Field '$field' is not allowed to use");
            }
        });

        if ($validation->fails()) {
            $errors = $validation->errors()->all();
            return response()->json(['error' => true, 'data' => null, 'message' => $errors], 200);
        }

        $data = Estate::query();

        //echo $data->exists();

        if ($request->input('name')) $data->where('name', 'like', '%' . $request->input('name') . '%');
        if ($request->input('price_from')) $data->where('price', '>', $request->input('price_from'));
        if ($request->input('price_to')) $data->where('price', '<', $request->input('price_to'));
        if ($request->input('bedrooms')) $data->where('bedrooms', $request->input('bedrooms'));
        if ($request->input('bathrooms')) $data->where('bathrooms', $request->input('bathrooms'));
        if ($request->input('storeys')) $data->where('storeys', $request->input('storeys'));
        if ($request->input('garages')) $data->where('garages', $request->input('garages'));

        $sortField = $request->input('sortDirection') ? $request->input('sortDirection') : 'name';
        $sortBy = $request->input('sortBy') == 'desc' ? 'desc' : 'asc';

        $data->orderBy($sortField, $sortBy);

        $result = $data->get();

        if (empty($result->toArray())) {
            return response()->json(['error' => false, 'message' => 'Data is empty', 'data' => null], 200);
        } else {
            return response()->json(['error' => false, 'message' => 'Get data success', 'data' => $result], 200);
        }

    }
}
