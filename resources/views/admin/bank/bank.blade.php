@extends('layouts.backend.master')
@section('title', 'Bank')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Bank List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Bank</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Bank
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Bank</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('bank.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6"></div>
                                                <div class="col-lg-6">
                                                    <div class="form-group">
                                                        <label for="prev_amount">Previews Amount</label>
                                                        <input type="text" value=""
                                                            class="form-control" name="prev_amount" id="prev_amount"
                                                            aria-describedby="emailHelp" placeholder="00.00">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="die">Bank Name</label>
                                                <input type="text" required class="form-control" name="bank_name"
                                                    id="die" aria-describedby="emailHelp" placeholder="">

                                            </div>
                                            <div class="form-group">
                                                <label for="dsc">Account Number</label>
                                                <input type="text" class="form-control" name="account_number"
                                                    id="dsc" placeholder="Account Number">
                                            </div>
                                            <div class="form-group">
                                                <label for="unit">Account Name</label>
                                                <input type="text" class="form-control" name="account_name"
                                                    id="unit" placeholder="Account Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="bank_description">Bank Description</label>
                                                <textarea class="form-control" name="bank_description" id="bank_description" rows="3"></textarea>
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
                                        <th scope="col">Bank Name</th>
                                        <th scope="col">Account Name</th>
                                        <th scope="col">Account Number</th>
                                        <th scope="col">Previews Amount</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($banks as $key => $bank)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $bank->name }}</td>
                                            <td>{{ $bank->acount_name }}</td>
                                            <td>{{ $bank->acount_number }}</td>
                                            <td>{{ $bank->prev_amount }}</td>
                                            <td>{{ $bank->description }}</td>
                                            <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#product_edit{{ $bank->id }}">Edit</a>

                                                <div class="modal fade" id="product_edit{{ $bank->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Bank</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('bank.update', $bank->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">

                                                                    <div class="row">
                                                                        <div class="col-lg-6"></div>
                                                                        <div class="col-lg-6">
                                                                            <div class="form-group">
                                                                                <label for="prev_amount">Previews
                                                                                    Amount</label>
                                                                                <input type="text"
                                                                                    value="{{ $bank->prev_amount }}"
                                                                                    class="form-control"
                                                                                    name="prev_amount" id="prev_amount"
                                                                                    aria-describedby="emailHelp"
                                                                                    placeholder="00.00">

                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="die">Bank Name</label>
                                                                        <input type="text" value="{{ $bank->name }}"
                                                                            required class="form-control" name="bank_name"
                                                                            id="die" aria-describedby="emailHelp"
                                                                            placeholder="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dsc">Account Number</label>
                                                                        <input type="text"
                                                                            value="{{ $bank->acount_number }}"
                                                                            class="form-control" name="account_number"
                                                                            id="dsc" placeholder="Account Number">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="unit">Account Name</label>
                                                                        <input type="text"
                                                                            value="{{ $bank->acount_name }}"
                                                                            class="form-control" name="account_name"
                                                                            id="unit" placeholder="Account Name">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="bank_description">Bank
                                                                            Description</label>
                                                                        <textarea class="form-control" name="bank_description" id="bank_description" rows="3">{{ $bank->description }}</textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>



                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete_modal{{ $bank->id }}">x</a>
                                                <div class="modal fade" id="delete_modal{{ $bank->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                            <div class="modal-body">
                                                                Are You Sure You Want To Delete This?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Close</button>
                                                                <a href="{{ route('bank.destroy', $bank->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
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
