@extends('layouts.backend.master')
@section('title', 'Supplier Payment')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Supplier Payment')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Supplier Payment</h4>
                        <h4 class="card-title mb-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#customer_modal">
                                Supplier Payment
                            </button>
                        </h4>
                        <!-- Modal -->
                        <div class="modal fade" id="customer_modal" tabindex="-1" role="dialog"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Supplier Payment</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form action="{{ route('admin.supplier.payment.store') }}" method="POST">
                                        @csrf
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="supplier_id">Select Supplier</label>
                                                <select class="form-control" name="supplier_id" id="supplier">
                                                    @foreach ($suppliers as $supplier)
                                                        <option value="{{ $supplier->id }}">{{ $supplier->name ?? ''}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="due">Due</label>
                                                <input type="text" readonly class="form-control" name="due"
                                                    id="due" aria-describedby="emailHelp" placeholder="">

                                            </div>
                                            <div class="form-group">
                                                <label for="date">date</label>
                                                <input type="date" class="form-control" name="date" id="date"
                                                    placeholder="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="receive_amount">Amount </label>
                                                <input type="text" class="form-control" name="amount"
                                                    id="receive_amount" placeholder="Amount">
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description Box</label>
                                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
                        <div class="table-responsive">
                            <table class="display table table-striped table-bordered" id="zero_configuration_table"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Supplier Name</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($SupplierTransaction as $key=>$transaction)
                                    
                                        
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$transaction->supplier->name}}</td>
                                            <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d-m-Y')}}</td>
                                            <td>{{$transaction->amount}}</td>
                                            <td>{{$transaction->description}}</td>
                                            <td>
                                                <a class="btn btn-primary" href="{{ route('supplier_payment_print',$transaction->id)}}">Print</a>
                                            </td>
                                            {{-- <td>
                                                <a href="#" class="btn btn-danger" data-toggle="modal"
                                                data-target="#delete_modal{{$customer->id}}">x</a>
                                                <div class="modal fade" id="delete_modal{{$customer->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>

                                                                <div class="modal-body">
                                                                    Are You Sure You Want To Delete This?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>
                                                                        <form action="{{ route('customer.destroy',$customer->id) }}" method="post">
                                                                            <input class="btn btn-danger" type="submit" value="Delete" />
                                                                            @method('delete')
                                                                            @csrf
                                                                        </form>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#edit_customer_modal{{$customer->id}}">
                                                    Edit
                                                </button>
                                                <!-- Modal -->
                                                <div class="modal fade" id="edit_customer_modal{{$customer->id}}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Add New
                                                                    Customer</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('customer.update',$customer->id) }}" method="POST">
                                                                @method('PUT')
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <div class="form-group">
                                                                        <label for="name">Name</label>
                                                                        <input type="text" required
                                                                            class="form-control" value="{{$customer->customer}}" name="name"
                                                                            id="name" aria-describedby="emailHelp"
                                                                            placeholder="">

                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="phone">Phone</label>
                                                                        <input type="text" value="{{$customer->phone}}" class="form-control"
                                                                            name="phone" id="phone"
                                                                            placeholder="Password">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="address">Address</label>
                                                                        <input type="text" value="{{$customer->address}}" class="form-control"
                                                                            name="address" id="address"
                                                                            placeholder="Address">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="email">Email</label>
                                                                        <input type="text" class="form-control"
                                                                            name="email" id="email"
                                                                            placeholder="Email" value="{{$customer->email}}">
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
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>SL</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
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
        $('#supplier').on('change', function() {
            var supplier = $('#supplier').val();
            $.ajax({
                url: "/admin/supplier/due/"+supplier,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    $('#due').val(res);
                }
            });
        })
    </script>
@endpush
