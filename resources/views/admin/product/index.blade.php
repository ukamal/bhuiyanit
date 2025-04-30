@extends('layouts.backend.master')
@section('title', 'Product')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'Product List')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
    <div class="row">
        <div class="col-lg-12">
            <div class="card mb-4">
                <div class="card text-left">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Product</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="card-title mb-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#supplier_modal">
                                        Add New Product
                                    </button>
                                </h4>
                                <!-- Modal -->
                                <div class="modal fade" id="supplier_modal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="{{ route('product.store') }}" method="POST">
                                                @csrf
                                                <div class="modal-body">
                                                    <div class="form-group">
                                                        <label for="product_type">Product Category</label>
                                                        <select class="form-control" name="product_category" id="product_type_add">
                                                            <option value="">Select An Category </option>
                                                            @foreach ($category as $item)
                                                                <option value="{{$item->id}}">{{$item->category_name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="product_type">Product Brand</label>
                                                        <select class="form-control" name="brand_id" id="brand_id">
                                                            <option selected disabled>Select Brand</option>
                                                            @foreach ($brand as $key => $item)
                                                                <option value="{{ $item->id }}">{{ $item->brand_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="dsc">Product Name</label>
                                                        <input type="text" class="form-control" name="product_name"
                                                            id="dsc" placeholder="Product Name">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="code">Product Code</label>
                                                        <input type="text" class="form-control" name="code"
                                                            id="code" placeholder="code">
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="unit">Unit</label>
                                                        <input type="text" class="form-control" name="unit"
                                                            id="unit" placeholder="Unit">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="color">Color</label>
                                                        <input type="text" class="form-control" name="color"
                                                            id="silver_rate_add" placeholder="Color">
                                                    </div>

                                                   
                                                    <div class="form-group">
                                                        <label for="other_rate_add">Rate</label>
                                                        <input type="text" class="form-control" name="rate"
                                                            id="other_rate_add" placeholder="Rate">
                                                    </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form action="{{ url('/admin/product') }}" method="GET">
                                    <div class="form-group d-flex">
                                        <select name="brand_id" class="form-control" id="">
                                            <option selected value="">Filter by Brand</option>
                                            @foreach ($brand as $key => $sup)
                                                <option @if ($search_brand == $sup->id) {{ 'selected' }} @endif
                                                    value="{{ $sup->id }}">{{ $sup->brand_name }}</option>
                                            @endforeach
                                        </select>
                                        <input type="text" class="form-control" name="search"
                                            placeholder="Search Here .." value="{{ $search }}">
                                        <button class="btn btn-info">Filter</button>
                                        <a href="{{ url('/admin/product') }}" class="btn btn-primary">Clear</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Sl</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Unit</th>
                                        <th scope="col">Code</th>
                                        <th scope="col">Product Category</th>
                                        <th scope="col">Brand</th>
                                        <th scope="col">Color</th>
                                        <th scope="col">Rate</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $key => $product)
                                        <tr>
                                            <th scope="row">{{ $key + 1 }}</th>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->unit }}</td>
                                            <td>{{ $product->code }}</td>
                                            <td>{{ $product['category']['category_name'] }}</td>
                                            <td>{{ $product['brand']['brand_name'] }}</td>
                                            <td>{{ $product->color }}</td>
                                            <td>{{ $product->rate }}</td>
                                            <td>
                                                <div class="d-flex">
                                                <a href="#" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#product_edit{{ $product->id }}">
                                                    <i class="fa fa-pencil"></i>
                                                </a>

                                                <div class="modal fade" id="product_edit{{ $product->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Edit
                                                                    Product</h5>
                                                                <button type="button" class="close"
                                                                    data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <form action="{{ route('product.update', $product->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    
                                                                    <div class="form-group">
                                                                        <label for="product_type">Select Category</label>
                                                                        <select class="form-control" name="product_category"
                                                                            id="product_category">
                                                                            <option selected value="0">Select Category
                                                                            @foreach ($category as $key => $sup)
                                                                            </option>
                                                                                <option
                                                                                    @if ($sup->id == $product->product_category) {{ 'selected' }} @endif
                                                                                    value="{{ $sup->id }}">
                                                                                    {{ $sup->category_name }}</option>
                                                                            @endforeach

   
                                                                        </select>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="product_type">Select Brand</label>
                                                                        <select class="form-control" name="brand_id"
                                                                            id="brand_id">
                                                                            <option selected value="0">Select Brand
                                                                            @foreach ($brand as $key => $sup)
                                                                            </option>
                                                                                <option
                                                                                    @if ($sup->id == $product->brand_id) {{ 'selected' }} @endif
                                                                                    value="{{ $sup->id }}">
                                                                                    {{ $sup->brand_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                  
                                                                    <div class="form-group">
                                                                        <label for="dsc">Product Name</label>
                                                                        <input type="text"
                                                                            value="{{ $product->product_name }}"
                                                                            class="form-control" name="product_name"
                                                                            id="dsc" placeholder="dsc">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="unit">Unit</label>
                                                                        <input type="text"
                                                                            value="{{ $product->unit }}"
                                                                            class="form-control" name="unit"
                                                                            id="unit" placeholder="Unit">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label for="code">Code</label>
                                                                        <input type="text"
                                                                            value="{{ $product->code }}"
                                                                            class="form-control" name="code"
                                                                            id="code" placeholder="code">
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="silver_rate_edit">Color</label>
                                                                        <input type="text"
                                                                            value="{{ $product->color }}"
                                                                            class="form-control" name="color"
                                                                            id="silver_rate_edit" placeholder="Color">
                                                                    </div>
                                                                 
                                                                    <div class="form-group">
                                                                        <label for="other_rate_edit">Rate</label>
                                                                        <input type="text" class="form-control"
                                                                            value="{{ $product->rate }}"
                                                                            name="other_rate" id="other_rate_edit"
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
                                                </div>

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
    <script>
        $(document).ready(function() {
                     
            let glass_product_name  = $('#glass_product_name');
            let glass_product_code  = $('#glass_product_code');

            let grade  = $('#grade');


            glass_product_name.parent().hide();
            glass_product_code.parent().hide();
   

            $('#product_type_add').on('change', function(e) {
                let silver_rate = $('#silver_rate_add');
                let bronze_rate = $('#bronze_rate_add');
                let ss_rate     = $('#ss_rate_add');
                let other_rate  = $('#other_rate_add');
                let die  = $('#die');
                let dsc  = $('#dsc');
                let code  = $('#code');
                let unit  = $('#unit');

     
                if (e.target.value == 'Aluminium') {
                    silver_rate.parent().show();
                    bronze_rate.parent().show();
                    ss_rate.parent().show();
                    other_rate.parent().show();
                    die.parent().show();
                    dsc.parent().show();
                    code.parent().show();
                    unit.parent().show();
                    glass_product_name.parent().hide();
                    glass_product_code.parent().hide();

                }

                if (e.target.value == 'Glass') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().hide();
                    other_rate.parent().hide();
                    die.parent().hide();
                    dsc.parent().hide();
                    code.parent().hide();
                    unit.parent().hide();
                    grade.parent().hide();

                    glass_product_name.parent().show();
                    glass_product_code.parent().show();
        
                }

                if (e.target.value == 'SS') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().show();
                    other_rate.parent().show();
                    die.parent().show();
                    dsc.parent().show();
                    code.parent().show();
                    unit.parent().show();
                    grade.parent().hide();

                    glass_product_name.parent().hide();
                    glass_product_code.parent().hide();
       
                }
            });


            $('#product_type_edit').on('change', function(e) {
                let silver_rate = $('#silver_rate_edit');
                let bronze_rate = $('#bronze_rate_edit');
                let ss_rate     = $('#ss_rate_edit');
                let other_rate  = $('#other_rate_edit');
                
                
                if (e.target.value == 'Aluminium') {
                    silver_rate.parent().show();
                    bronze_rate.parent().show();
                    ss_rate.parent().show();
                }

                if (e.target.value == 'Glass') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().hide();
                    grade.parent().hide();

                    
                    silver_rate.val(' ');
                    bronze_rate.val(' ');
                    ss_rate.val(' ');
                }

                if (e.target.value == 'SS') {
                    silver_rate.parent().hide();
                    bronze_rate.parent().hide();
                    ss_rate.parent().show();
                    grade.parent().hide();


                    silver_rate.val(' ');
                    bronze_rate.val(' ');
                }
            });
        });
    </script>
@endpush
