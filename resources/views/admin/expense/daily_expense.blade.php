@extends('layouts.backend.master')
@section('title', 'Daily Expense')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Daily Expense List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Daily Expense</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add Expense
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Expense</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.expense.transaction.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="head">Expense Head</label>
                                                <select name="head_id" class="form-control" id="">
                                                    @foreach ($expenses as $expense)
                                                        <option value="{{ $expense->id }}">{{ $expense->head }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="date" value="{{date('Y-m-d')}}"  class="form-control"
                                                            name="date" id="date" aria-describedby="emailHelp">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="amount">amount</label>
                                                        <input type="text" class="form-control" name="amount"
                                                            placeholder="00.00">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="dsc">Description</label>
                                                <textarea class="form-control" id="dsc" name="dsc" rows="3"></textarea>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ExpenseTransactions as $key => $expense)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $expense->transaction_date?date('d-M-y',strtotime($expense->transaction_date)):''}}</td>
                                            <td>{{ $expense->head->head }}</td>
                                            <td>{{ $expense->amount }}</td>
                                            <td>{{ $expense->remarks }}</td>
                                            <td>
                                                <a href="{{ route('daily_expense_remove',$expense->id) }}" class="text-white btn btn-danger btn-sm">X</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{--<tr>
                                        <th></th>
                                        <th></th>
                                        <th>{{ $expense->sum('amount') }}</th>
                                    </tr>--}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>
    <script>
        $('#zero_configuration_table').DataTable(); // feature enable/disable
    </script>
@endpush
