<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\SubCategoryAdmin;
use App\Dal\Entities\Goods;
use App\Dal\Entities\CategorySubcategory;
use App\Dal\Entities\SubCategoryLocale;
use App\Dal\Entities\Locale;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class SubCategoriesController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function __construct(IImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, SubCategoryAdmin::class);

        return view(
            'admin.subcategories.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.subcategories');

        if ($this->isPost()) {

            $this->validateAddForm($request);
            $entity = new SubCategoryAdmin($request->all());
            if(isset($request->icon)) {
                $image = $request->file('icon');
                if ($image->getClientMimeType() == "image/svg+xml" ) {
                    $name = str_random(10).'.'.$request->file('icon')->getClientOriginalExtension();
                    $path = \Storage::disk('public')->putFileAs(
                        'images/icons', $request->icon, $name);
                    $destinationPath = 'icons/'.$name;
                    $entity->icon = $destinationPath;
                } else {
                    $entity->icon = $this->_imageService->upload($request->icon, 'icons');
                }
            }
            $entity->save();

            $pivot = new CategorySubcategory();
            $pivot->category_id = $request->parent;
            $pivot->subcategory_id = $entity->id;
            $pivot->save();

            if(isset($entity->sort_order)) {
                $swap = SubCategoryAdmin::select(['sort_order', 'id'])->where('id', '!=', $entity->id)->get();
                foreach ($swap as $key => $item) {
                    if ($request->sort_order <= $item->sort_order) {
                        SubCategoryAdmin::where('id', $item->id)->update(['sort_order' => $item->sort_order+1]);
                    }
                }

            }

            return redirect(
                routeWithQuery(
                    'admin.subcategories.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new SubCategoryAdmin();
        }

        $categories = Goods::all();
        $categoriesArr = [(object)['id' => 0, 'name'=> 'Select Parent Goods']];
        foreach ($categories as $category) {
            $item = (object)['id' => $category->id, 'name'=> $category->name];
            $categoriesArr[] = $item;
        }

        return view(
            'admin.subcategories.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $categoriesArr,
                'selectedCategory' => '0'
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = routeWithQuery('admin.subcategories', [], ['success']);

        if ($this->isPost()) {

            $this->validateEditForm($request);

            $entity = SubCategoryAdmin::findOrFail($id);
            $old =$entity->icon;
            $currentPos = $entity->sort_order;
            $entity->fill($request->all());
            if ($request->icon) {
                $image = $request->file('icon');
                if ($image->getClientMimeType() == "image/svg+xml" ) {
                    $newName = str_random(10).'.'.$request->file('icon')->getClientOriginalExtension();
                    if (isset($old)) {
                        unlink(public_path('images'). DIRECTORY_SEPARATOR . $old);
                    }
                    $path = \Storage::disk('public')->putFileAs(
                        'images/icons', $request->icon, $newName);
                    $newDestinationPath = 'icons/'.$newName;
                    $entity->icon = $newDestinationPath;

                } else {
                    $newImage = $this->_imageService->upload($request->icon, 'icons');
                    $this->_imageService->delete($entity->icon);
                    $entity->icon = $newImage;
                }
            }
            $entity->save();

            CategorySubcategory::where('subcategory_id', '=', $id)->delete();
            $pivot = new CategorySubcategory();
            $pivot->category_id = $request->parent;
            $pivot->subcategory_id = $entity->id;
            $pivot->save();

            if(isset($entity->sort_order)) {

                $swap = SubCategoryAdmin::select(['sort_order', 'id'])->where('id', '!=', $id)->get();
                foreach ($swap as $key => $item) {
                    if ($request->sort_order <= $item->sort_order && $request->sort_order != $currentPos ) {
                        SubCategoryAdmin::where('id', $item->id)->update(['sort_order' => $item->sort_order+1]);
                    }
                }
            }

            return redirect(
                routeWithQuery(
                    'admin.subcategories.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );
        }

        $entity = SubCategoryAdmin::findOrFail($id);
        $categories = Goods::all();
        $categoriesArr = [(object)['id' => 0, 'name'=> 'Select Parent Goods']];
        foreach ($categories as $category) {
            $item = (object)['id' => $category->id, 'name'=> $category->name];
            $categoriesArr[] = $item;
        }


        $selectedCategory = CategorySubcategory::where('subcategory_id', '=', $id)->select('category_id')->first();

        return view(
            'admin.subcategories.form',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl,
                'goods' => $categoriesArr,
                'selectedCategory' => $selectedCategory->category_id
            ]
        );
    }

    public function delete($id)
    {
        $entity = SubCategoryAdmin::findOrFail($id);
        CategorySubcategory::where('subcategory_id', '=', $id)->delete();
        $entity->delete();

        return redirect()->back();
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required',
            ],
            [],
            [
                'name' => 'Name',
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
