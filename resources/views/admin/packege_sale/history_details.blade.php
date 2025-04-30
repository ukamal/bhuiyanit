@extends('layouts.backend.master')
@section('title', 'Packege History Details')
@push('css')
<link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('page_title', 'Packege History Details')
@section('content')
<div class="row" id="add_new_sale">
   <div class="col-lg-12">
      <div class="card mb-4">
         <div class="card text-left">
            <div class="card-body">
               <div class="d-flex justify-content-between">
                  <h4 class="card-title mb-3">Packege History Details</h4>
                  <h4 class="card-title mb-3"><a href="{{ route('admin_package_sale_history') }}">Back</a></h4>
               </div>
               <form action="{{ route('admin.packege_sales.store') }}" method="POST">
                  @csrf
                  <input type="hidden" name="service_name" id="service_name_input">
                  <input type="hidden" name="service_value" id="service_value_input">
                  <input type="hidden" name="quantity" id="quantity_input">
                  <div class="row">
                     <div class="col-lg-4">
                        <table class="table table-bordered">
                           <tr>
                              <td>Date </td>
                              <td>
                                 <input readonly class="form-control" value="{{ $detailsData->sale_date }}" name="sale_date">
                              </td>
                           </tr>
                           <tr>
                              <td>Invoice No</td>
                              <td>
                                 {{ sale_no() }}
                                 <input readonly name="invoice_no" value="{{ sale_no() }}" hidden>
                              </td>
                           </tr>
                           <tr>
                              <td>Customer Name</td>
                              <td>
                                 <input class="form-control" name="customer" readonly value="{{ $detailsData['customer']['customer'] }}">
                              </td>
                           </tr>
                           <tr>
                              <td>Brand Name 
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="brand_name" class="form-control" readonly value="{{ $detailsData->brand_name }}">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Model 
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="model"  class="form-control" readonly value="{{ $detailsData->model }}">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Chasis No
                              </td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="chasis_no" class="form-control" readonly value="{{ $detailsData->chasis_no }}">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Mobile</td>
                              <td>
                                 <div class="form-group">
                                    <input type="text" name="customer_mobile" class="form-control" readonly value="{{ $detailsData->customer_mobile }}">
                                 </div>
                              </td>
                           </tr>
                           <tr>
                              <td>Packege Name</td>
                              <td>
                                 <input class="form-control" name="packege_name" readonly value="{{ $detailsData['package']['packege_name'] }}">
                              </td>
                           </tr>
                        </table>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-lg-12">
                        <table class="table table-bordered">
                           <thead class="bg-dark">
                              <tr class="text-white text-center">
                                 <th width="25%">Service Name </th>
                                 <th width="25%">Service Amount</th>
                                 <th width="25%">Quantity</th>
                                 <th width="25%">Action</th>
                              </tr>
                           </thead>
                           <tbody>
                              <td>
                                 @if ($detailsData->package->services->count() > 0)
                                 @foreach ($detailsData->package->services as $service)
                                 {{ $service->service_name }},
                                 @endforeach
                                 @else
                                 No services
                                 @endif
                              </td>
                              <td>
                                 <p>{{ $detailsData->service_value }}</p>
                              </td>
                              <td>
                                 <p id="quantityDisplay">{{ $detailsData->quantity }}</p>
                              </td>
                              <td>
                                 <p><button type="button" class="btn btn-danger float-right mr-5 minusButton">Take Service ( - ) </button></p>
                              </td>
                           </tbody>
                        </table>
                     </div>
                  </div>
                  <div>   
                  </div>
                  {{--<button type="submit" class="btn btn-primary float-right mr-5">Confirm</button>--}}
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Add this modal HTML at the end of your Blade file -->
<div class="modal" tabindex="-1" role="dialog" id="dateTimeModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Date and Time</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="datetime-local" id="dateTimeInput" class="form-control">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="confirmDateTime">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


@endsection
@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('backend/dist-assets/js/plugins/datatables.min.js') }}"></script>
<script src="{{ asset('backend/dist-assets/js/scripts/datatables.script.min.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var quantityDisplay = document.getElementById('quantityDisplay');
        var minusButton = document.querySelector('.minusButton');
        var dateTimeModal = document.getElementById('dateTimeModal');
        var confirmDateTimeButton = document.getElementById('confirmDateTime');
        var dateTimeInput = document.getElementById('dateTimeInput');

        if (minusButton) {
            minusButton.addEventListener('click', function () {
                // Show the date-time input modal
                $('#dateTimeModal').modal('show');
            });
        }

        if (confirmDateTimeButton) {
            confirmDateTimeButton.addEventListener('click', function () {
                // Get the selected date-time value
                var selectedDateTime = dateTimeInput.value;

                // Update the quantity and display
                var currentQuantity = parseInt(quantityDisplay.innerText);
                if (currentQuantity > 0) {
                    currentQuantity -= 1;
                    quantityDisplay.innerText = currentQuantity;

                    // Send an AJAX request to update the quantity and date-time
                    updateQuantityInBackend(currentQuantity, selectedDateTime);
                } else {
                    alert('Quantity cannot go below 0.');
                }

                // Hide the date-time input modal
                $('#dateTimeModal').modal('hide');
            });
        }
    });

    function updateQuantityInBackend(newQuantity, selectedDateTime) {
        var id = '{{ $detailsData->id }}';

        // Send an AJAX request to update the quantity and date-time
        $.ajax({
            url: '/updateQuantity/' + id,
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                selectedDateTime: selectedDateTime 
            },
            success: function(response) {
                if (response.success) {
                    console.log('Quantity and date-time updated successfully.');
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error updating quantity and date-time:', error);
            }
        });
    }
</script>


@endpush
@push('vue-js')
<script src="{{ asset('js/pages/AddNewSale.js') }}"></script>
@endpush