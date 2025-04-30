<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use App\Models\BankTransaction;
use App\Models\Projects;
use App\Models\ProjectTransaction;
use Illuminate\Http\Request;

class IncomeExpenseController extends Controller {
    public function index() {
        $expenses = Projects::all();
        return view('admin.incomeExpense.head', compact('expenses'));
    }

    /**
     * @param Request $request
     */
    public function project_store(Request $request) {
        $data = [
            'head'        => $request->head,
            'description' => $request->dsc,
        ];
        Projects::create($data);

        return redirect()->back();
    }

    /**
     * @param Request $request
     */
    public function store(Request $request) {
        $data = [
            'name'          => $request->bank_name,
            'acount_number' => $request->account_number,
            'acount_name'   => $request->account_name,
            'description'   => $request->bank_description,
            'prev_amount'   => $request->prev_amount,
        ];
        $bank = Bank::create($data);
        BankTransaction::create([
            'bank_id' => $bank->id,
            'amount'  => $bank->prev_amount,
            'status'  => 'prev',
            'remarks' => 'previews',
        ]);
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param $id
     */
    public function update(Request $request, $id) {
        $data = [
            'name'          => $request->bank_name,
            'acount_number' => $request->account_number,
            'acount_name'   => $request->account_name,
            'description'   => $request->bank_description,
            'prev_amount'   => $request->prev_amount,
        ];
        $bank = Bank::find($id);
        BankTransaction::where('bank_id', $id)->update([
            'bank_id' => $bank->id,
            'amount'  => $request->prev_amount,
            'status'  => 'prev',
            'remarks' => 'previews',
        ]);
        $bank->update($data);
        return redirect()->back();
    }

    /**
     * @param $id
     */
    public function destroy($id) {
        Bank::find($id)->delete();
        return redirect()->back();
    }

    public function bank_tansaction() {
        $banks        = Projects::all();
        $selectedProject = 0;
        if (isset($_GET['project_filter']) && $_GET['project_filter'] != 0) {
            $selectedProject = $_GET['project_filter'];
            $transactions = ProjectTransaction::where('project_id', $selectedProject)->get();
        } else {
            $transactions = ProjectTransaction::all();
        }
        return view('admin.incomeExpense.project_transaction', compact('transactions', 'banks', 'selectedProject'));
    }

    /**
     * @param Request $request
     */
    public function bank_tansaction_store(Request $request) {
        ProjectTransaction::create([
            'transaction_date' => $request->date,
            'project_id'       => $request->project,
            'amount'           => $request->amount,
            'status'           => $request->status,
            'remarks'          => $request->description,
        ]);
        return redirect()->back();
    }
}
