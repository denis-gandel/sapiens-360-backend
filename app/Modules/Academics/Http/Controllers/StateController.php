<?php

namespace App\Modules\Academics\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Academics\Services\Concretes\StateService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
{
    protected StateService $stateService;

    public function __construct(StateService $stateService)
    {
        $this->stateService = $stateService;
    }

    public function index(Request $request)
    {
        $direction = strtolower($request->query('direction', 'asc'));
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

        $orderBy = $request->query('orderBy', 'name');
        $allowedColumns = ['name', 'created_at', 'updated_at'];
        $orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'name';

        $page = (int) ($request->query('page', 0));
        $size = (int) ($request->query('size', 0));

        $data = $this->stateService->getAll($direction, [], $orderBy, $page, $size);

        return response()->json($data, 200);
    }

    public function getAllByCountry(int $countryId, Request $request)
    {
        $direction = strtolower($request->query('direction', 'asc'));
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

        $orderBy = $request->query('orderBy', 'name');
        $allowedColumns = ['name', 'created_at', 'updated_at'];
        $orderBy = in_array($orderBy, $allowedColumns) ? $orderBy : 'name';

        $page = (int) ($request->query('page', 0));
        $size = (int) ($request->query('size', 0));

        $filters = ['country_id' => $countryId];

        $data = $this->stateService->getAll($direction, $filters, $orderBy, $page, $size);

        return response()->json($data, 200);
    }


    public function show(int $stateId)
    {
        $data = $this->stateService->getBy('id', $stateId);

        if (!$data) {
            return response()->json(['message' => 'State not found'], 404);
        }

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'country_id' => 'required|exists:countries,id|integer'
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $data = $this->stateService->create($request->all());

            return response()->json($data, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, int $stateId)
    {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => 'string|max:255',
                'country_id' => 'exists:countries,id|integer'
            ]
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $data = $this->stateService->update($stateId, $request->all());

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy(int $stateId)
    {
        try {
            $this->stateService->delete($stateId);

            return response()->json(['message' => "State deleted"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
