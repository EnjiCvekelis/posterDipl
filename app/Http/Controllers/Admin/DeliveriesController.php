<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\DeliveriesAdmin;
use App\Dal\Entities\Admin\RemainsAdmin;
use App\Dal\Entities\Admin\SubCategoryAdmin;
use App\Dal\Entities\Deliveries;
use App\Dal\Entities\Goods;
use App\Dal\Entities\CategorySubcategory;
use App\Dal\Entities\SubCategoryLocale;
use App\Dal\Entities\Locale;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class DeliveriesController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function __construct(IImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, DeliveriesAdmin::class);
        $deliveries = Deliveries::with('goods')->get();


        return view(
            'admin.deliveries.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
                'deliveries' => $deliveries
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.deliveries');

        if ($this->isPost()) {

            $this->validateAddForm($request);
            $entity = new DeliveriesAdmin($request->all());
            $entity->total = $request->amount * $request->price;
            $entity->save();

            $remains = RemainsAdmin::where('goods_id', '=', $request->goods_id)->firstOrFail();
            $remains->total = $remains->total + $entity->total;
            $remains->amount = $remains->amount + $request->amount;
            $remains->save();



            return redirect(
                routeWithQuery(
                    'admin.deliveries.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new DeliveriesAdmin();
        }

        $categories = Goods::all();
        $categoriesArr = [(object)['id' => 0, 'name'=> 'Выберите товар']];
        foreach ($categories as $category) {
            $item = (object)['id' => $category->id, 'name'=> $category->name];
            $categoriesArr[] = $item;
        }

        return view(
            'admin.deliveries.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $categoriesArr,
                'selectedGood' => '0'
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = routeWithQuery('admin.deliveries', [], ['success']);

        if ($this->isPost()) {

            $this->validateEditForm($request);

            $entity = DeliveriesAdmin::findOrFail($id);
            $entity->total = $request->amount * $request->price;
            $entity->save();

//            CategorySubcategory::where('subcategory_id', '=', $id)->delete();
//            $pivot = new CategorySubcategory();
//            $pivot->category_id = $request->parent;
//            $pivot->subcategory_id = $entity->id;
//            $pivot->save();


            return redirect(
                routeWithQuery(
                    'admin.deliveries.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );
        }

        $entity = DeliveriesAdmin::findOrFail($id);
        $categories = Goods::all();
        $categoriesArr = [(object)['id' => 0, 'name'=> 'Выберите товар']];
        foreach ($categories as $category) {
            $item = (object)['id' => $category->id, 'name'=> $category->name];
            $categoriesArr[] = $item;
        }


//        $selectedCategory = CategorySubcategory::where('subcategory_id', '=', $id)->select('category_id')->first();

        return view(
            'admin.deliveries.form',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $categoriesArr,
                'selectedGood' => ''
            ]
        );
    }

    public function delete($id)
    {
        $entity = DeliveriesAdmin::findOrFail($id);
        $entity->delete();

        return redirect()->back();
    }


    public function remains(Request $request)
    {
        $gridItems = $this->getGrid($request, DeliveriesAdmin::class);
        $remains = RemainsAdmin::all();


        return view(
            'admin.remains.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
                'remains' => $remains
            ]
        );
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'goods_id' => 'bail|required',
                'amount' => 'bail|required',
                'price' => 'bail|required',
            ],
            [],
            [
                'goods_id' => 'Наименование',
                'amount' => 'Количество',
                'price' => 'Цена за единицу',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'goods_id' => 'bail|required',
            ],
            [],
            [
                'goods_id' => 'Наименование',
            ]
        );
    }


}
