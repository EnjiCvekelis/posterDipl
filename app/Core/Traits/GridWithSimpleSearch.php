<?php

namespace App\Core\Traits;

use Illuminate\Http\Request;

trait GridWithSimpleSearch
{
  function getGrid(Request $request, $model)
  {
    $itemsPerPage = \Config::get('app.admin.grid_items_per_page');
    $gridItems = $model::getGrid($request->q, $itemsPerPage);
    $gridItems->appends(['q' => $request->q]);
    $gridItems->searchQuery = $request->q;
    
    return $gridItems;
  }
}