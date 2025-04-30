@extends('layouts.backend.master')
@section('title', 'Expense')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Expense List')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Expense Head</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#supplier_modal">
                                Add New Head
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Add New Head</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('expense.head.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">

                                            <div class="form-group">
                                                <label for="head">Expense Head</label>
                                                <input type="text" class="form-control" name="head" id="head"
                                                    placeholder="Head">
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
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($expenses as $key => $expense)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $expense->head }}</td>
                                            <td>{{ $expense->description }}</td>
                                            <td>
                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                    data-target="#delete_modal{{ $expense->id }}">x</a>
                                                <div class="modal fade" id="delete_modal{{ $expense->id }}"
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
                                                                <a href="{{ route('expense_destroy', $expense->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            {{-- <td>
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#product_edit{{ $expense->id }}">Edit</a>

                                                <div class="modal fade" id="product_edit{{ $expense->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add New
                                                                    Product</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('product.update', $expense->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="product_type">Product Type</label>
                                                                        <select class="form-control" name="product_type" id="product_type">
                                                                            <option value="Aluminum" {{ $product->product_type=="Aluminum"?'selected':'' }}>Aluminum</option>
                                                                            <option value="Glass" {{ $product->product_type=="Glass"?'selected':'' }}>Glass</option>
                                                                            <option value="SS" {{ $product->product_type=="SS"?'selected':'' }}>SS</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="die">Die No</label>
                                                                        <input type="text" required
                                                                            value="{{ $product->die }}"
                                                                            class="form-control" name="die"
                                                                            id="die" aria-describedby="emailHelp"
                                                                            placeholder="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="dsc">Item Name/Description</label>
                                                                        <input type="text"
                                                                            value="{{ $product->item_description }}"
                                                                            class="form-control" name="description"
                                                                            id="dsc" placeholder="dsc">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="unit">unit</label>
                                                                        <input type="text"
                                                                            value="{{ $product->unit }}"
                                                                            class="form-control" name="unit"
                                                                            id="unit" placeholder="Unit">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="size">Size/Thickness</label>
                                                                        <input type="text"
                                                                            value="{{ $product->size }}"
                                                                            class="form-control" name="size"
                                                                            id="size" placeholder="Size">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="silver_rate">Silver Rate</label>
                                                                        <input type="text"
                                                                            value="{{ $product->silver_rate }}"
                                                                            class="form-control" name="silver_rate"
                                                                            id="silver_rate" placeholder="Rate">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="bronze_rate">Bronze Rate</label>
                                                                        <input type="text"
                                                                            value="{{ $product->bronze_rate }}"
                                                                            class="form-control" name="bronze_rate"
                                                                            id="bronze_rate" placeholder="Rate">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="ss_rate">SS Rate</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $product->ss_rate }}"
                                                                            name="ss_rate" id="ss_rate"
                                                                            placeholder="Rate">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="other_rate">Other Rate</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $product->other_rate }}"
                                                                            name="other_rate" id="other_rate"
                                                                            placeholder="Rate">
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
                                                    data-target="#delete_modal{{ $product->id }}">x</a>
                                                <div class="modal fade" id="delete_modal{{ $product->id }}"
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
                                                                <a href="{{ route('product.destroy', $product->id) }}"
                                                                    class="btn btn-danger">Delete</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td> --}}
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
