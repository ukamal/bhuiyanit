

<div class="d-flex">
<div class="col-md-6">
    Return date: <input type="date" name="sale_return_date" class="form-control" value="<?php echo date('Y-m-d'); ?>">
    <br><br>
    

</div>
<div class="col-md-6 text-right">
    <h4 style="margin: 0px; padding: 0px;">Customer Information</h4>
    Name: {{$customer->customer}}<br>
    Address: {{$customer->address}}<br>
    Mobile: {{$customer->phone}} <br>
    Email: {{ $customer->email }}
</div>
</div>

<div class="col-md-12">
    <div class="table-responsive">
        <table class="table table-bordered" id="sale_return_table">
            <thead>
            <tr>
                <th>Sl</th>
                <th>Product</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>Already returned quantity</th>
                <th>Already returned amount</th>
                <th>Return Quantity</th>
                <th>Return Rate</th>
                <th>Return Amount</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($saleProduct as $key => $product)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>
                        <input type="hidden" name="product_id[]" id="returned_quantity" placeholder="" value="{{$product->product_id}}">
                        <span id="product_name"> {{$product['product']['item_description']}} </span>
                    </td>
                    <td>
                        <input type="hidden" name="category_id[]" placeholder="" value="{{$product->category_id}}">
                        {{$product['product']['product_category']}}
                    </td>
                    <td><span id="quantity" class="quantity"> {{$product->qty}} </span></td>
                    <td><span id="total"> {{ $product->amount }} </span></td>
                    <td><span id="already_returned_quantity"> 0 </span></td>
                    <td><span id="already_returned_amouont"> 0 </span></td>
                    <td>
                        <input type="text" name="returned_quantity[]"  placeholder="" value=""
                               class="form-control returned_quantity{{ $loop->iteration }}" onkeyup="calculateReturn('{{ $loop->iteration }}')">
                    </td>
                    <td>
                        <input type="text" name="returned_rate[]"  placeholder="" value="{{ $product->rate }}"
                               class="form-control returned_rate{{ $loop->iteration }}" onkeyup="calculateReturn('{{ $loop->iteration }}')">
                    </td>
                    <td>
                        <span class="returned_amouont{{ $loop->iteration }}">0</span>
                        <input name="returned_amouont_input[]" class="returned_amouont_input{{ $loop->iteration }}" type="hidden" >
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="6" style="text-align: right; padding-top: 15px;">Note</td>
                <td colspan="2"><textarea style="width: 100%;" name="note"></textarea></td>
                <td><button type="submit" class="btn btn-success pull-left">Save</button></td>
                <td>
                    Total: <span id="total_amount">0</span>
                    <input name="total_amount_input" type="hidden" id="total_amount_input" readonly>
                </td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>
