<?php

namespace App\Http\Controllers\Bases;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Contracts\IController;
use App\Services\Contracts\IService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

abstract class BaseController extends Controller implements IController
{
    protected IService $service;
    protected array $createRules = [];
    protected array $updateRules = [];

    public function __construct(IService $service, array $createRules = [], array $updateRules = [])
    {
        $this->service = $service;
        $this->createRules = $createRules;
        $this->updateRules = $updateRules;
    }

    public function index(Request $request)
    {
        $direction = strtolower($request->query('direction', 'asc'));
        $direction = in_array($direction, ['asc', 'desc']) ? $direction : 'asc';

        $orderBy = $request->query('orderBy', 'name');
        $orderBy = $orderBy ? $orderBy : 'name';

        $page = (int) ($request->query('page', 0));
        $size = (int) ($request->query('size', 0));

        $filters = $request->query('filters') ?? [];

        $data = $this->service->getAll($direction, $filters, $orderBy, $page, $size);

        return response()->json($data, 200);
    }

    public function show(Request $request)
    {
        $column = $request->query('column');
        $value = $request->query('value');
        $fail = $request->query('fail') ?? true;
        $onlyActive = $request->query('onlyActive') ?? true;
        $filters = $request->query('filters') ?? [];

        if (!$column || !$value) {
            return response()->json(['message' => 'Column and value are required'], 400);
        }

        $data = $this->service->getBy($column, $value, $fail, $onlyActive, $filters);

        if (!$data) {
            return response()->json(['message' => 'Entity not found'], 404);
        }

        return response()->json($data, 200);
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            $this->createRules
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $data = $this->service->create($request->all(), null);

            return response()->json($data, 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function update(Request $request, string|int $id)
    {
        $validate = Validator::make(
            $request->all(),
            $this->updateRules
        );

        if ($validate->fails()) {
            return response()->json(['errors' => $validate->errors()], 422);
        }

        try {
            $data = $this->service->update($id, $request->all(), null);

            return response()->json($data, 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function destroy(string|int $id)
    {
        try {
            $this->service->delete($id);

            return response()->json(['message' => "Entity deleted"], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
