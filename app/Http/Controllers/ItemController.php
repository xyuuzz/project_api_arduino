<?php

namespace App\Http\Controllers;

use App\Models\{
    Category,
    Item
};
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemCollection;

class ItemController extends Controller
{
    /**
     * Get Item by category id
     *
     * @param Category $category
     * @return void
     */
    public function itemCategory(Category $category)
    {
        return new ItemCollection($category->item);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ItemRequest $request)
    {
        try {
            auth()->user()->seller()->create($request);

            return $this->templateResponse(true, "menambah");
        } catch(\Error $e) {
            return $this->templateResponse(false, "menambah");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ItemRequest  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(ItemRequest $request, Item $item)
    {
        try {
            return response()->json($request->toArray());
            $item->update($request->toArray());

            return $this->templateResponse(true, "mengubah");
        } catch(\Error $e) {
            return $this->templateResponse(false, "mengubah");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        try {
            $item->delete();
            return $this->templateResponse(true, "menghapus");
        } catch(\Error $e) {
            return $this->templateResponse(false, "menghapus");
        }
    }

    /**
     * Define Template Response for this controller
     *
     * @param bool $status
     * @param string $message
     * @return void
     */
    public function templateResponse(bool $status, string $message)
    {
        return response()->json([
            "code" => $status ? 200 : 400,
            "status" => $status,
            "message" => "Gagal {$message} data item di lapak!"
        ]);
    }
}
