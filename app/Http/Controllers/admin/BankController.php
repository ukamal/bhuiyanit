<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaction;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function index()
    {
        $banks = Bank::all();
        return view('admin.bank.bank', compact('banks'));
    }

    public function store(Request $request)
    {
        $data = [
            'name' => $request->bank_name,
            'acount_number' => $request->account_number,
            'acount_name' => $request->account_name,
            'description' => $request->bank_description,
            'prev_amount' => $request->prev_amount,
        ];
        $bank = Bank::create($data);
        BankTransaction::create([
            'bank_id' => $bank->id,
            'amount' => $bank->prev_amount,
            'status' => 'prev',
            'remarks' => 'previews',
        ]);
        return redirect()->back();
    }

    public function update(Request $request, $id)
    {
        $data = [
            'name' => $request->bank_name,
            'acount_number' => $request->account_number,
            'acount_name' => $request->account_name,
            'description' => $request->bank_description,
            'prev_amount' => $request->prev_amount,
        ];
        $bank = Bank::find($id);
        BankTransaction::where('bank_id', $id)->update([
            'bank_id' => $bank->id,
            'amount' => $request->prev_amount,
            'status' => 'prev',
            'remarks' => 'previews',
        ]);
        $bank->update($data);
        return redirect()->back();
    }

    public function destroy($id)
    {
        Bank::find($id)->delete();
        return redirect()->back();
    }

    public function bank_tansaction()
    {
        $banks = Bank::all();

        $selectedBank = 0;
        if (isset($_GET['bank_filter']) && $_GET['bank_filter'] != 0) {
            $selectedBank = $_GET['bank_filter'];
            $transactions = BankTransaction::where('bank_id', $selectedBank)->get();
        } else {
            $transactions = BankTransaction::all();
        }
        return view('admin.bank.bank_transaction', compact('transactions', 'banks', 'selectedBank'));
    }

    public function bank_tansaction_store(Request $request)
    {
        BankTransaction::create([
            'transaction_date' => $request->date,
            'bank_id' => $request->bank,
            'amount' => $request->amount,
            'status' => $request->status,
            'remarks' => $request->description,
        ]);
        return redirect()->back();
    }
}
