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
    public function gets(Request $request)
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

    public function get(Request $request,$item_id)
    {
        $item = Item::find($item_id);
        
        if($item == null) return $this->responseData(self::NOTFOUND, []);

        $data = [
            "items" =>   new ItemResource($item)
        ];
        
        return $this->responseData(self::SUCCESS, $data);
    }

    public function store(ItemStore $request)
    {
        $item = Item::create($request->only(["title","description"]));

        $data = [
            "items" =>   new ItemResource($items)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function update(ItemStore $request,$item_id)
    {
        $item = Item::find($item_id);

        if($item == null) return $this->responseData(self::NOTFOUND, []);

        $item->update(
          $request->only(["title","description"])  
        );
        
        $item->refresh();
        
        $data = [
            "items" =>   new ItemResource($items)
        ];

        return $this->responseData(self::SUCCESS, $data);
    }

    public function destroy(Request $request,$item_id)
    {
        $item = Item::find($item_id);

        if($item == null) return $this->responseData(self::NOTFOUND, []);
        
        $item->delete();

        return $this->responseData(self::SUCCESS, []);
    }
}
