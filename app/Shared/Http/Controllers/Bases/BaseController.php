<?php

namespace App\Shared\Http\Controllers\Bases;

use App\Shared\Http\Controllers\Controller;
use App\Shared\Http\Controllers\Contracts\IController;
use App\Shared\Models\Responses\Concretes\FailedResponse;
use App\Shared\Models\Responses\Concretes\PaginateResponse;
use App\Shared\Models\Responses\Concretes\SuccessResponse;
use App\Shared\Services\Contracts\IService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;

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

        if ($data instanceof LengthAwarePaginator) {
            $response = new PaginateResponse(
                200,
                'Data correctly obtained',
                $data->items(),
                $data->currentPage(),
                $data->lastPage(),
                $data->perPage(),
                $data->total()
            );

            return $response->toResponse();
        }

        $response = new SuccessResponse(200, 'Data correctly obtained', $data);
        return $response->toResponse();
    }

    public function show(Request $request)
    {
        $column = $request->query('column');
        $value = $request->query('value');
        $fail = $request->query('fail') ?? true;
        $onlyActive = $request->query('onlyActive') ?? true;
        $filters = $request->query('filters') ?? [];

        if (!$column || !$value) {
            $response = new FailedResponse(400, 'Column and value are required', null);
            return $response->toResponse();
        }

        $data = $this->service->getBy($column, $value, $fail, $onlyActive, $filters);

        if (!$data) {
            $response = new FailedResponse(404, 'Entity not found', null);
            return $response->toResponse();
        }

        $response = new SuccessResponse(200, 'Data correctly obtained', $data);
        return $response->toResponse();
    }

    public function store(Request $request)
    {
        $validate = Validator::make(
            $request->all(),
            $this->createRules
        );

        if ($validate->fails()) {
            $response = new FailedResponse(422, 'Verify the data sent', $validate->errors());
            return $response->toResponse();
        }

        try {
            $data = $this->service->create($request->all(), null);

            $response = new SuccessResponse(201, 'Object successfully created', $data);
            return $response->toResponse();
        } catch (Exception $e) {
            $response = new FailedResponse(400, $e->getMessage(), null);
            return $response->toResponse();
        }
    }

    public function update(Request $request, string|int $id)
    {
        $validate = Validator::make(
            $request->all(),
            $this->updateRules
        );

        if ($validate->fails()) {
            $response = new FailedResponse(422, 'Verify the data sent', $validate->errors());
            return $response->toResponse();
        }

        try {
            $data = $this->service->update($id, $request->all(), null);

            $response = new SuccessResponse(200, 'Object successfully updated', $data);
            return $response->toResponse();
        } catch (Exception $e) {
            $response = new FailedResponse(400, $e->getMessage(), null);
            return $response->toResponse();
        }
    }

    public function destroy(string|int $id)
    {
        try {
            $this->service->delete($id);

            $response = new SuccessResponse(200, 'Object successfully deleted', null);
            return $response->toResponse();
        } catch (Exception $e) {
            $response = new FailedResponse(400, $e->getMessage(), null);
            return $response->toResponse();
        }
    }
}
