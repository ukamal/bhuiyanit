@extends('layouts.backend.master')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/dist-assets/css/plugins/datatables.min.css') }}" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
             <!-- Include Select2 CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css">
@endpush

@section('content')
<h4 class="card-title mb-3">Sales Return</h4>
<form method="POST" action="{{route('user.salesReturn.store')}}" enctype="multipart/form-data">
   @csrf
   <div class="row">
      <div class="col-xl-12">
         <div class="form-horizontal">
            <div class="col-sm-12">
               <div class="form-group d-flex">
                  <label class="col-sm-1 control-label" for="username"> Invoice no:</label>
                  <div class="col-sm-2">
                     <input type="number" id="new_invoice_no" name="new_invoice_no" class="form-control" value="{{ invoiceNo() }}" readonly>
                  </div>
                  <label class="col-sm-1 control-label" for="username"> Customer:</label>
                  <div class="col-sm-4">
                     <select data-placeholder="Choose a Customer..."  name="customer_id" class="chosen-select form-control select2" id="customer_id" tabindex="2" onchange="getCustomerSaleInoviceNo()">
                        <option value="" selected disabled>Select Customer</option>
                        @foreach($customers as $customer)
                        <option value="{{$customer->id}}">{{$customer->customer}}</option>
                        @endforeach
                     </select>
                  </div>
                  <label class="col-sm-1 control-label" for="username"> Invoice: </label>
                  <div class="col-sm-2">
                     <select  id="previous_invoice_no" name="previous_invoice_no form-control" >
                     </select>
                  </div>
                  <div class="justify-content-end">
                     <a class="btn btn-primary text-white" type="submit" onclick="saleByCustomer()">Search</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <hr/>
   <div class="row">
      <div class="col-xs-12 col-md-12 col-lg-12" id="saleByCustomerShow">
         <div id='loader' style='display: none;text-align: center'>
            <img src='site_image/64x64.gif' width='32px' height='32px'>
         </div>
      </div>
   </div>
</form>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var table = $('#example').DataTable( {
            lengthChange: false,
            buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]
        } );

        table.buttons().container()
            .appendTo( '#example_wrapper .col-md-6:eq(0)' );
    } );
</script>
    <script>
        function getCustomerSaleInoviceNo() {
            var customer_id = $('#customer_id').val();

            if (customer_id != null) {
                $.ajax({
                    url: '{{ url('/sales/return/customer-invoice') }}/' + customer_id,
                    type: 'GET',
                    dataType: 'json',
                })
                    .done(function(response) {
                        console.log(response)
                        data = '<option value="">Select A Invoice</option>';
                        selected = '';
                        $.each(response, function(index, val) {
                            data += '<option value=' + val.sale_no + '>' + val.sale_no + '</option>';
                            console.log(data);
                        });
                        $('#previous_invoice_no').html(data);
                    });

            } else {}
        }

      
        function saleByCustomer() {

            var customer_id = $('#customer_id').val();
            var previous_invoice_no = $('#previous_invoice_no').val();

            $.ajax({
                url: '/saleByCustomer/' + customer_id+'/'+ previous_invoice_no ,
                type: 'GET',
                beforeSend  : function() {
                    $('#saleByCustomerShow').html('');
                    $("#loader").show();
                },
                success:(function(response) {
                    console.log(response);
                    $('#saleByCustomerShow').html(response);
                }),
                complete:function(response){
                    $("#loader").hide();
                }
            })

        }

    </script>
    <script>
        function calculateReturn(index){
            var returned_quantity = $('.returned_quantity'+index).val();
            var returned_rate = $('.returned_rate'+index).val();
            var subTotal= parseFloat(returned_quantity) *  parseFloat(returned_rate);
            var returned_amouont = $('.returned_amouont'+index).text(subTotal);
            var returned_amouont_input = $('.returned_amouont_input'+index).val(subTotal);
            calculateTotal();
        }

        function calculateTotal(){
            var total = 0;
            $('#sale_return_table').find('tbody tr').each(function(index) {
                var value = $('.returned_amouont'+(index+1)).text();
                total= total + parseFloat(value);
            });
            console.log(total);
            $('#total_amount').text(total);
            $('#total_amount_input').val(total);
        }

        function submitSellReturn(){
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('user.salesEntry.store') }}",
                type: "post",
                data: formData,
                success: function(response) {
                    console.log(response);
                    location.reload();
                }
            });
        }


    </script>


          <!-- Include Select2 JS -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

      <script>
         $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2();
         });
      </script>
@endpush
