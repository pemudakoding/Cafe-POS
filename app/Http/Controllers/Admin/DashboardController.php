<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Transaction;
use App\Models\Ingredients;
use App\Models\TransactionDetail;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function index()
    {
        $incomes = Transaction::selectRaw('year(created_at) year, monthname(created_at) month, sum(total_price) total_incomes, count(id) total,month(created_at) month_number')
            ->where('transaction_status', 'bayar')
            ->groupBy('year', 'month', 'month_number')
            ->orderBy('month_number', 'asc')
            ->get();
        $transactions = Transaction::selectRaw('monthname(created_at) month,month(created_at) month_number, count(id) as total_transaction')
            ->where('transaction_status', 'bayar')
            ->groupBy('month', 'month_number')
            ->orderBy('month_number', 'asc')
            ->get();
        $menus = Menu::count();


        /**
         * Ingredients
         */
        $transactionDetails = TransactionDetail::with(['ingredientMenu.ingredients'])->orderBy('id', 'desc')->get()->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('m');
        });

        $totalIngredients = [];
        foreach ($transactionDetails[date('m')] ?? [] as $transactionDetail) {
            foreach ($transactionDetail->ingredientMenu as $ingredientMenu) {
                $totalIngredients[$ingredientMenu->ingredients->name][] = $ingredientMenu->quantity * $transactionDetail->quantity;
            }
        }
        $sumIngredients = [];
        foreach ($totalIngredients as $key => $totalIngredient) {

            $sumIngredients[] = array_sum($totalIngredients[$key]);
        }

        $ingredientCome = Ingredients::orderBy('id', 'desc')->get()->groupBy(function ($d) {
            return Carbon::parse($d->created_at)->format('m');
        });
        $ingredientCome = $ingredientCome[date('m')] ?? [];



        return view('pages.admin.dashboard.index')->with([
            'incomes' => $incomes,
            'transactions' => $transactions,
            'menus' => $menus,
            'totalIngredients' => $totalIngredients,
            'sumIngredients' => $sumIngredients,
            'ingredientCome' => $ingredientCome,

        ]);
    }
}
