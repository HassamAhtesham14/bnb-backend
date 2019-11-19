<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MenuItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $category
     * @return Response
     */
    public function index(Category $category)
    {
        $menuItems = $category->menuItems;
        return response()->json(compact('menuItems'), 200, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @param MenuItem $menuItem
     * @return Response
     */
    public function show(Category $category, MenuItem $menuItem)
    {
        return response()->json(compact('menuItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param MenuItem $menuItem
     * @return Response
     */
    public function update(Request $request, MenuItem $menuItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param MenuItem $menuItem
     * @return Response
     */
    public function destroy(MenuItem $menuItem)
    {
        //
    }

    public function popular() 
    {
        $menuItems = MenuItem::where('is_popular', true)->get();
        return response()->json(compact('menuItems'), 200, [], JSON_NUMERIC_CHECK);
    }
}
