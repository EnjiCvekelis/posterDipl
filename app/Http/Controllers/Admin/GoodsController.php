<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\GoodsAdmin;
use App\Dal\Entities\Admin\RemainsAdmin;
use App\Dal\Entities\CategoryLocale;
use App\Dal\Entities\Locale;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class GoodsController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function __construct(IImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, GoodsAdmin::class);

        return view(
            'admin.goods.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.goods');

        if ($this->isPost()) {

            $this->validateAddForm($request);
            $entity = new GoodsAdmin($request->all());
            $entity->save();

            $remains = new RemainsAdmin();
            $remains->goods_id = $entity->id;
            $remains->name = $request->name;
            $remains->save();

            return redirect(
                routeWithQuery(
                    'admin.goods.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new GoodsAdmin();
        }


        return view(
            'admin.goods.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = routeWithQuery('admin.goods', [], ['success']);

        if ($this->isPost()) {

            $this->validateEditForm($request);

            $entity = GoodsAdmin::findOrFail($id);
            $entity->fill($request->all());
            $entity->save();

            return redirect(
                routeWithQuery(
                    'admin.goods.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );
        }

        $entity = GoodsAdmin::findOrFail($id);

        return view(
            'admin.goods.form',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl,
            ]
        );
    }

    public function delete($id)
    {
        $entity = GoodsAdmin::findOrFail($id);
        $entity->delete();
        RemainsAdmin::where('goods_id', '=', $id)->delete();

        return redirect()->back();
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
                'manufacturer' => 'bail|required',
                'importer' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
                'manufacturer' => 'Manufacturer',
                'importer' => 'Importer',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
                'manufacturer' => 'bail|required',
                'importer' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
                'manufacturer' => 'Manufacturer',
                'importer' => 'Importer',
            ]
        );
    }
}
