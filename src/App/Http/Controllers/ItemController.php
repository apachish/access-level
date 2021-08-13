<?php

namespace Apachish\AccessLevel\App\Http\Controllers;

use Apachish\AccessLevel\App\Http\Requests\ItemStore;
use Apachish\AccessLevel\App\Http\Resources\ItemCollection;
use Apachish\AccessLevel\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Apachish\AccessLevel\App\Http\Resources\Item as ItemResource;

class ItemController extends Controller
{

    public function index(Request $request)
    {
        $limit = $request->get("limit",10);
        $order = $request->get("order","DESC");

        $items = Item::orderBy("created_at",$order)
            ->simplePaginate($limit);

        $data = [
          "items" =>   new ItemCollection($items)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function show(Request $request,$item_id)
    {
        $item = Item::find($item_id);

        if($item == null) return $this->responseData(self::NOTFOUND, []);

        $this->authorize('view',$item);

        $data = [
            "items" =>   new ItemResource($item)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function store(ItemStore $request)
    {
        $user = auth()->user();
        $this->authorize('create',Item::class);

        $item = $user->items()->create($request->only(["title","description"]));

        $data = [
            "items" =>   new ItemResource($item)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }


    public function update(ItemStore $request,$item_id)
    {
        $item = Item::find($item_id);

        if($item == null) return $this->responseData(self::NOTFOUND, []);

        $this->authorize("update",$item);
        $item->update(
          $request->only(["title","description"])
        );

        $item->refresh();

        $data = [
            "items" =>   new ItemResource($item)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function destroy(Request $request,$item_id)
    {
        $item = Item::find($item_id);

        if($item == null) return $this->responseData(self::NOTFOUND, []);

        $this->authorize("update",$item);

        $item->delete();

        return $this->responseData(self::SUCCESS, []);
    }
}
