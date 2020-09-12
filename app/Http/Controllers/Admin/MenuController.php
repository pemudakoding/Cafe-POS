<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\IngredientMenu;
use App\Models\Ingredients;
use App\Models\Menu;

class MenuController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $menus = Menu::paginate(5);
        return view('pages.admin.menu.index')->with([
            'menus' => $menus
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'              => 'required|string|max:255|unique:menus',
            'price'             => 'required|numeric',
            'category'          => 'required|in:Minuman,Makanan',
            'photo'             => 'required|file|mimetypes:image/jpg,image/png,image/jpeg|max:1024',
            'ingredients'       => 'required|array',
            'ingredients.*'     => 'required|integer',
            'quantity'          => 'required|array',
            'quantitiy.*'       => 'required|numeric'
        ]);

        $data = $request->except(['ingredients', 'photos', 'quantity']);
        $data['photo'] = $request->photo->store('images/menus', 'public');

        $insert = Menu::create($data);
        $ingredientDatas = [];
        if (count($request->ingredients) > 0) {
            for ($i = 0; $i < count($request->ingredients); $i++) {
                $ingredientDatas[] = ['id_menu' => $insert->id, 'id_ingredient' => $request->ingredients[$i], 'quantity' => $request->quantity[$i]];
            }
        }


        if ($insert) {
            IngredientMenu::insert($ingredientDatas);
            return redirect()->route('menu.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg' => 'Berhasil menambahkan menu ' . $request->name,
                ]
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu = Menu::with(['ingredients', 'ingredient_menus'])->findOrFail($id);
        $ingredients = Ingredients::select('name', 'id')->get();
        return view('pages.admin.menu.edit')->with([
            'menu' => $menu,
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $request->validate([
            'name'              => 'required|string|max:255|unique:menus,id,' . $id,
            'price'             => 'required|numeric',
            'category'          => 'required|in:Minuman,Makanan',
            'photo'             => 'nullable|file|mimetypes:image/jpg,image/png,image/jpeg|max:1024',
            'ingredients'       => 'required|array',
            'ingredients.*'     => 'required|integer',
            'quantity'          => 'required|array',
            'quantitiy.*'       => 'required|numeric'
        ]);

        $data = $request->except(['ingredients', 'photos', 'quantity']);
        if ($request->has('photo')) {
            $data['photo'] = $request->photo->store('images/menus', 'public');
        }

        if ($menu->update($data)) {
            for ($i = 0; $i < count($request->ingredients); $i++) {
                IngredientMenu::updateOrCreate(
                    ['id_menu' => $id, 'id_ingredient' => $request->ingredients[$i]],
                    ['quantity' => $request->quantity[$i]]
                );
            }
            return redirect()->route('menu.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg' => 'Berhasil mengubah data menu ' . $menu->name
                ]
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $menu = Menu::find($id);

        $menu_ingredients = IngredientMenu::whereIn('id_menu', [$id]);

        if ($menu->delete()) {
            $menu_ingredients->delete();

            return response()->json(['msg' => 'Menu berhasil dihapus']);
        } else {
            return response()->json(['msg' => 'Menu gagal dihapus']);
        }
        // return response()->json(['msg' => 'Menu berhasil dihapus']);
    }
}
