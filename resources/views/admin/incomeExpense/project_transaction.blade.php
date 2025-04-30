@extends('layouts.backend.master')
@section('title', 'Project Transaction')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Project Transaction List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Project Transaction</h4>
                        <div class="d-flex justify-content-between">
                            <h4 class="card-title mb-3">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                    Add Income/Expense
                                </button>
                            </h4>
                            <form action="" method="GET" class="form-group d-flex">
                                <select name="project_filter" class="w-auto form-control">
                                    <option value="0">Filter By Project</option>
                                    @foreach ($banks as $bank)
                                        <option @if($selectedProject == $bank->id) {{'selected'}} @endif value="{{ $bank->id }}">{{ $bank->head }}</option>
                                    @endforeach
                                </select>
                                <button class="form-control btn btn-info" > Filter </button>
                                <a class="btn btn-primary form-control" href="{{url('admin/project/transaction')}}">Clear</a>
                            </form>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Income/Expense</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.project.transaction.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="die">Select Status</label>
                                                        <select name="status" class="form-control" id="">
                                                            <option value="deposit">Income</option>
                                                            <option value="withdraw">Expense</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="date">Date</label>
                                                        <input type="date" value="{{date('Y-m-d')}}" class="form-control"
                                                            name="date" id="date" aria-describedby="emailHelp">

                                                    </div>
                                                </div>
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="amount">Amount</label>
                                                        <input type="text" value="" class="form-control"
                                                            name="amount" id="amount" aria-describedby="emailHelp"
                                                            placeholder="00.00">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Select Project</label>
                                                <select name="project" class="form-control" id="">
                                                    @foreach ($banks as $bank)
                                                        <option value="{{ $bank->id }}">{{ $bank->head }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="bank_description">Description</label>
                                                <textarea class="form-control" name="description" id="bank_description" rows="3"></textarea>
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
                                        <th scope="col">Project</th>
                                        <th scope="col">Income</th>
                                        <th scope="col">Expense</th>
                                        <th scope="col">Blanced</th>
                                        <th scope="col">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $blanced[] = 0;
                                    @endphp
                                    @foreach ($transactions as $key => $transaction)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ date('d-M-y', strtotime($transaction->transaction_date)) }}</td>
                                            <td>{{ ($transaction->project->head)??'' }}</td>
                                            <td>
                                                @if ($transaction->status == 'deposit' || $transaction->status == 'prev')
                                                    {{ $transaction->amount }}
                                                    @php
                                                        $blanced[$transaction->project->id] = isset($blanced[$transaction->project->id])? $blanced[$transaction->project->id] + $transaction->amount : 0 + $transaction->amount;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>
                                                @if ($transaction->status == 'withdraw')
                                                    {{ $transaction->amount }}
                                                    @php
                                                        $blanced[$transaction->project->id] = isset($blanced[$transaction->project->id])? $blanced[$transaction->project->id] - $transaction->amount : 0 - $transaction->amount;
                                                    @endphp
                                                @endif
                                            </td>
                                            <td>
                                                {{ $blanced[$transaction->project->id] }}
                                            </td>
                                            <td>{{ $transaction->remarks }}</td>

                                        </tr>
                                    @endforeach
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
