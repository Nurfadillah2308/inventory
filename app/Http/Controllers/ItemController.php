<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Services\ItemService;
use App\Http\Controllers\Api\BaseController;
use Exception;

class ItemController extends BaseController {
    protected ItemService $svc;

    public function __construct(ItemService $svc) {
        $this->svc = $svc;
    }

    public function index() {
        return response()->json([
            'status' => 'success', 
            'data' => $this->svc->all(), 
            'message' => 'Berhasil menarik semua data Item'
        ]);
    }

    public function store(StoreItemRequest $req) {
        return response()->json([
            'status' => 'success', 
            'data' => $this->svc->create($req->validated()), 
            'message' => 'Item berhasil dibuat'
        ], 201);
    }

    public function show($id) {
        try {
            return response()->json([
                'status' => 'success', 
                'data' => $this->svc->find($id), 
                'message' => 'Berhasil menarik satu data Item'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error', 
                'data' => null, 
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function update(UpdateItemRequest $req, $id) {
        return response()->json([
            'status' => 'success', 
            'data' => $this->svc->update($id, $req->validated()), 
            'message' => 'Item berhasil diperbarui'
        ]);
    }

    public function destroy($id) {
        $this->svc->delete($id);
        return response()->json([
            'status' => 'success', 
            'data' => null, 
            'message' => 'Item berhasil dihapus'
        ], 200);
    }
}