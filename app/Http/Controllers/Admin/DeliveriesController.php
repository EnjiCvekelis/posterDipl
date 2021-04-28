<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\DeliveriesAdmin;
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
        $name = Deliveries::with('goods')->get();


        return view(
            'admin.deliveries.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
                'name' => $name
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
//        CategorySubcategory::where('subcategory_id', '=', $id)->delete();
        $entity->delete();

        return redirect()->back();
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

    public function json()
    {
        $json = Goods::with(['locale', 'subcategory.track'])->get();
//        $json = Goods::all()->locale()->subcategory();
//        dd($json);
//        dd($json);
//        foreach ($json as $item)
//        {
//            unset($item['id']);
//            unset($item['sort_order']);
//            unset($item['created_at']);
//            unset($item['updated_at']);
//        }

        $data = json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        $filename = "test.json";
        $handle = fopen($filename, 'w+');
        fputs($handle, $data);
        fclose($handle);
        $headers = array('Content-type'=> 'application/json');
        return response()->download($filename,'test.json',$headers);
    }
}
