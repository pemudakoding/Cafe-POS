<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ingredients;
use Illuminate\Http\Request;

class IngredientController extends Controller
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
        $ingredients = Ingredients::paginate(10);

        return view('pages.admin.ingredient.index')->with([
            'ingredients' => $ingredients
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.ingredient.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'      => 'required|string',
            'quantity'  => 'required|numeric',
            'price'     => 'required|numeric'
        ]);
        $data['stock'] = $request->quantity;

        $ingredident = Ingredients::where('name', $request->name)->first();


        if (!$ingredident) {
            $insert = Ingredients::create($data);
        } else {
            $insert = $ingredident->update(['quantity' => $request->quantity, 'price' => $request->price, 'stock' => $request->quantity]);
        }

        if ($insert) {
            return redirect()->route('ingredients.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg' => 'Berhasil menambahkan bahan ' . $request->name
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
        $ingredient = Ingredients::findOrFail($id);
        return view('pages.admin.ingredient.edit')->with([
            'ingredient' => $ingredient
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
        $ingredient = Ingredients::find($id);
        $request->validate([
            'name'      => 'required|string',
            'quantity'  => 'required|numeric',
            'price'     => 'required|numeric'
        ]);
        $data = $request->except('quantity');
        $data['stock'] = $request->quantity;
        $data['quantity'] = $request->quantity;

        if ($ingredient->update($data)) {
            return redirect()->route('ingredients.index')->with([
                'alert' => [
                    'type' => 'success',
                    'msg'  => 'Berhasil mengubah data bahan',
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
        $ingredient = Ingredients::find($id);

        if ($ingredient->delete()) {
            return response()->json(['msg' => 'Data bahan berhasil dihapus']);
        }
    }

    public function getIngredients()
    {
        $ingredients = Ingredients::select('id', 'name')->get();

        return response()->json($ingredients);
    }
}
