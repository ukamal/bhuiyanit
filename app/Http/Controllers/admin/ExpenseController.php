<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\ExpenseTransaction;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function expense()
    {
        $expenses = Expense::all();
        return view('admin.expense.index', compact('expenses'));
    }
    public function expense_head_store(Request $request)
    {
        $data = [
            'head' => $request->head,
            'description' => $request->dsc,
        ];
        Expense::create($data);

        return redirect()->back();
    }

    public function daily_expense()
    {
        $expenses = Expense::all();
        $ExpenseTransactions = ExpenseTransaction::all();
        
        return view('admin.expense.daily_expense', compact('expenses','ExpenseTransactions'));
    }
    public function daily_expense_store(Request $request)
    {
        $data = [
            'expense_id' => $request->head_id,
            'transaction_date' => $request->date,
            'amount' => $request->amount,
            'remarks' => $request->dsc,
        ];
        ExpenseTransaction::create($data);
        return redirect()->back();
    }

    public function expenseDestroy($id){
        Expense::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function dailyExpenseRemove($id){
        ExpenseTransaction::findOrFail($id)->delete();
        return redirect()->back();
    }
}
