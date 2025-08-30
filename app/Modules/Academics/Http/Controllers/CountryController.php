<?php

namespace App\Modules\Academics\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Academics\Services\Concretes\CountryService;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    public function index()
    {
        $data = $this->countryService->getAll();

        return response()->json($data, 200);
    }

    public function show(int $countryId)
    {
        try {
            $data = $this->countryService->getBy('id', $countryId);

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255'
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $country = $this->countryService->create($request->all());

            return response()->json($country, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function udpate(int $countryId, Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'string|max:255'
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $country = $this->countryService->update($countryId, $request->all());

            return response()->json($country, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $countryId)
    {
        try {
            $this->countryService->delete($countryId);

            return response()->json(['message' => "Country deleted"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
