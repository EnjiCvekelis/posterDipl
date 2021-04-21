<?php

namespace App\Http\Controllers\Admin;

use App\Core\Services\Infrastructure\IImageService;
use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\LocaleAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class LocaleController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function __construct(IImageService $imageService)
    {
        $this->_imageService = $imageService;
    }

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, LocaleAdmin::class);

        return view(
            'admin.locales.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.locales');

        if ($this->isPost()) {

            $this->validateAddForm($request);
            $entity = new LocaleAdmin($request->all());
            $entity->save();


            return redirect(
                routeWithQuery(
                    'admin.locales.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new LocaleAdmin();
        }

        return view(
            'admin.locales.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
                'photos' => [],
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = routeWithQuery('admin.locales', [], ['success']);

        if ($this->isPost()) {

            $this->validateEditForm($request);

            $entity = LocaleAdmin::findOrFail($id);
            $entity->fill($request->all());
            $entity->save();


            return redirect(
                routeWithQuery(
                    'admin.locales.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );
        }

        $entity = LocaleAdmin::findOrFail($id);


        return view(
            'admin.locales.form',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl,
            ]
        );
    }

    public function delete($id)
    {
        $entity = LocaleAdmin::findOrFail($id);
        $entity->delete();

        return redirect()->back();
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'language' => 'bail|required',
            ],
            [],
            [
                'language' => 'Locale',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'language' => 'bail|required',
            ],
            [],
            [
                'language' => 'Locale',
            ]
        );
    }
}
