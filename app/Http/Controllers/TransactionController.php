<?php

namespace App\Http\Controllers;

use App\Models\IngredientMenu;
use App\Models\Ingredients;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class TransactionController extends Controller
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
    public function index(Request $request)
    {
        $transactions_instance = Transaction::where('transaction_status', '=', 'bayar')->orderBy('id', 'Desc');
        $transaction_total     = $transactions_instance->count();
        $income                = $transactions_instance->sum('total_price');

        if ($request->s == '') {
            $transactions = Transaction::where('transaction_status', '!=', 'bayar')->orderBy('id', 'desc')->get();
        } else {
            $transactions = Transaction::where('transaction_status', '!=', 'bayar')
                ->where('name', 'LIKE', "%$request->s%")
                ->orWhere('table_number', $request->s)
                ->orderBy('id', 'desc')
                ->get();
        }

        return view('pages.transaction.index')->with([
            'transactions' => $transactions,
            'transaction_total' => $transaction_total,
            'income' => $income

        ]);
    }

    public function show($id)
    {
        $data = Transaction::with(['transactionDetails.menus'])->find($id);
        return $data;
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $foods  = Menu::where('category', 'Makanan')->get();
        $drinks = Menu::where('category', 'Minuman')->get();

        return view('pages.transaction.create')->with([
            'foods' => $foods,
            'drinks' => $drinks
        ]);
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
            'name' => 'required|string|max:100',
            "table_number" => 'required|numeric',
            "total_price" => 'required|numeric',
            'orders' => 'required|array',
            "orders.*.id_menu" => 'required|integer',
            'orders.*.quantity' => 'required|integer'
        ]);

        /**
         * Data for transactions Table
         */
        $data = $request->except('orders');
        $data['transaction_status'] = 'belum';
        $data['user_id'] = 1;

        $transaction = Transaction::create($data);
        if ($transaction) {

            /**
             * Insert data to transaction_details table
             */
            $orders = $request->only('orders');
            $insertOrder = [];
            foreach ($orders as $orders => $order) {
                foreach ($order as $item) {
                    /**
                     * Push some data to variable insertORder
                     */
                    $insertOrder[] = ['id_transaction' => $transaction->id, 'id_menu' => $item['id_menu'], 'quantity' =>  $item['quantity']];

                    /**
                     * Update Ingredient Quantity
                     */
                    $menus = Menu::with('ingredients')->find($item['id_menu']);
                    foreach ($menus->ingredients as $ingredient) {
                        $ingredientMenu = IngredientMenu::where('id_menu', $item['id_menu'])->where('id_ingredient', $ingredient->id)->first();
                        Ingredients::find($ingredient->id)->decrement('quantity', $ingredientMenu->quantity * $item['quantity']);
                    }
                }
            }

            TransactionDetail::insert($insertOrder);
            return response()->json(['msg' => 'Transaksi Berhasil'], 200);
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $transaction = Transaction::find($request->id);
        $transaction->name = $request->name;
        $transaction->table_number = $request->table_number;

        if (count($request->orders) > 0) {
            $transactionDetail = TransactionDetail::with(['menus'])->whereIn('id_menu', $request->orders)->where('id_transaction', $request->id);
            foreach ($transactionDetail->get() as $detail) {
                $transaction->total_price = $transaction->total_price - ($detail->menus->price * $detail->quantity);
                $menu = Menu::with('ingredients')->find($detail->menus->id);
                foreach ($menu->ingredients as $ingredient) {
                    $ingredientMenu = IngredientMenu::where('id_ingredient', $ingredient->id)->first();

                    Ingredients::find($ingredient->id)->increment('quantity', $ingredientMenu->quantity * $detail->quantity);
                }
            }
            $transactionDetail->delete();
        }

        if ($transaction->save()) {
            return response()->json(['msg' => 'Data berhasil diubah']);
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

        $transaction = Transaction::find($id);
        $transactionDetail = TransactionDetail::where('id_transaction', $id)->first();

        $transaction->delete();
        if ($transactionDetail != null) {
            $transactionDetail->delete();
        }


        return response()->json(['msg' => 'Data Pesanan berhasil dihapus'], 200);
    }

    public function setStatus(Request $request)
    {
        $data = $request->validate([
            'status' => 'required|string|in:bayar,belum',
            'id' => 'required|numeric'
        ]);

        $transaction = Transaction::find($data['id'])->update(['transaction_status' => $data['status']]);

        if ($transaction) {
            return response()->json(['msg' => 'Status transaksi berhasil diubah'], 200);
        } else {
            return response()->json(['msg' => 'Status transaksi gagal diubah'], 500);
        }
    }
}
