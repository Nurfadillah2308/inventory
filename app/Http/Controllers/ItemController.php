<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Models\Item;
use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Exception;

class ItemController extends BaseController
{
    public function index()
    {
        $items = Item::with('category')->get();
        return $this->success($items, 'Items retrieved successfully.');
    }

    public function store(StoreItemRequest $request)
    {
        $item = Item::create($request->validated());
        return $this->success($item, 'Item created successfully.', 201);
    }

    public function show($id)
    {
        try {
            $item = Item::with('category')->findOrFail($id);
            return $this->success($item, 'Item found successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Item not found.', 404);
        }
    }

    public function update(UpdateItemRequest $request, $id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->update($request->validated());
            return $this->success($item, 'Item updated successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Item not found.', 404);
        }
    }

    public function destroy($id)
    {
        try {
            $item = Item::findOrFail($id);
            $item->delete();
            return $this->success(null, 'Item deleted successfully.');
        } catch (ModelNotFoundException $e) {
            return $this->error('Item not found.', 404);
        }
    }
}