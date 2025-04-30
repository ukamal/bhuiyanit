@extends('layouts.backend.master')
@section('title', 'Customer Info')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
@endpush
@section('page_title', 'All Info')
@section('content')
<div class="row">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card text-left">
            <div class="card-body">
              
               <div>


                  <div class="card">
                        <h4 class="ml-4 mt-2">Customer Info</h4>
                     <div class="card-body">
                        <p><strong>Name:</strong> {{ $customer->customer  }}</p>
                        <p><strong>Phone:</strong> {{ $customer->phone }}</p>
                        <p><strong>Address:</strong> {{ $customer->address }}</p>
                        <p><strong>Email:</strong> {{ $customer->email }}</p>
                        <hr>
                        <h4>Product Info</h4>
                        @if ($products->count() > 0)
                        <table class="table">
                           <thead>
                              <tr>
                                 <th>Product</th>
                                 <th>Color</th>
                                 <th>Size</th>
                                 <th>Quantity</th>
                                 <th>Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              @foreach ($products as $product)
                              <tr>
                                 <td>{{ $product->product->item_description }}</td>
                                 <td>{{ $product->product->color }}</td>
                                 <td>{{ $product->product->size }}</td>
                                 <td>{{ $product->qty }}</td>
                                 <td>
                                    <a href="" class="btn btn-primary">Sale Retun</a>
                                 </td>
                              </tr>
                              @endforeach
                           </tbody>
                        </table>
                        @else
                        <p>No products found for this customer.</p>
                        @endif
                     </div>
                  </div>


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