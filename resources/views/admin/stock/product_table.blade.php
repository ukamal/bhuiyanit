<input type="text" hidden name="order_id" value="{{$order->id}}">
<table class="table table-bordered">
    <thead class="bg-dark">
        <tr class="text-white text-center">
            <th scope="col">Sl</th>
            <th scope="col">Die No</th>
            <th scope="col">Description</th>
            <th scope="col">unit</th>
            <th scope="col">Size/Thickness</th>
            <th scope="col" colspan="3" class="text-center">Silver</th>
            <th scope="col" colspan="3" class="text-center">Bronze</th>
            <th scope="col" colspan="3" class="text-center">SS</th>
            <th scope="col" colspan="3" class="text-center">Other</th>

        </tr>
        <tr class="bg-dark">
            <td colspan="5"></td>
            <td class="text-white text-center">Rate</td>
            <td class="text-white text-center">Qty</td>
            <td class="text-white text-center">Total</td>

            <td class="text-white text-center">Rate</td>
            <td class="text-white text-center">Qty</td>
            <td class="text-white text-center">Total</td>

            <td class="text-white text-center">Rate</td>
            <td class="text-white text-center">Qty</td>
            <td class="text-white text-center">Total</td>

            <td class="text-white text-center">Rate</td>
            <td class="text-white text-center">Qty</td>
            <td class="text-white text-center">Total</td>


        </tr>
    </thead>
    <tbody id="table-body">
        @foreach ($order->products as $key => $ord)
            <tr class="text-center">
                <th scope="row">{{ $key + 1 }}</th>
                <td>{{ $ord->product->die }}</td>
                <td>
                    {{ $ord->product->item_description }}
                    <input type="text" name="product_id[]" hidden
                        value="{{ $ord->product->id }}">
                </td>
                <td>{{ $ord->product->unit }}</td>
                <td>{{ $ord->product->size }}</td>

                <td class="text-center">
                    {{ $ord->silver_rate }}
                    <input type="text" name="silver_rate[]"
                        id="silver_rate{{ $key }}" hidden
                        value="{{ $ord->silver_rate }}">
                </td>
                <td class="text-center">
                    <input type="text" name="silver_qty[]" value="{{ $ord->silver_qty }}" style="width: 55px"
                        onkeyup="silver_qty({{ $key }})"
                        id="silver_qty{{ $key }}">
                </td>
                <td>
                    {{$ord->silver_qty*$ord->silver_rate}}
                    <span id="total_qty{{ $key }}"></span>
                </td>
                <td class="text-center">
                    {{ $ord->bronze_rate }}
                    <input type="text" name="bronze_rate[]"
                        id="bronze_rate{{ $key }}" hidden
                        value="{{ $ord->bronze_rate }}">

                </td>
                <td class="text-center">

                    <input type="text" id="bronze_qty{{ $key }}"
                        onkeyup="bronzeQty({{ $key }})" value="{{ $ord->bronze_qty }}" name="bronze_qty[]"
                        style="width: 55px">
                </td>
                <td>
                    {{ $ord->bronze_rate*$ord->bronze_qty }}
                    <span id="bronze_total_qty{{ $key }}"></span>
                </td>
                <td class="text-center">
                    {{ $ord->ss_rate }}
                    <input type="text" name="ss_rate[]" id="ss_rate{{ $key }}"
                        hidden value="{{ $ord->ss_rate }}">

                </td>
                <td class="text-center">

                    <input type="text" id="ss_qty{{ $key }}"
                        onkeyup="ssQty({{ $key }})" value="{{ $ord->ss_qty }}" name="ss_qty[]"
                        style="width: 55px">
                </td>
                <td>
                    {{ $ord->ss_rate*$ord->ss_qty }}
                    <span id="ss_total_qty{{ $key }}"></span>
                </td>
                <td class="text-center">
                    {{ $ord->other_rate }}
                    <input type="text" name="other_rate[]"
                        id="other_rate{{ $key }}" hidden
                        value="{{ $ord->other_rate }}">

                </td>
                <td class="text-center">
                    <input type="text" id="other_qty{{ $key }}"
                        onkeyup="otherQty({{ $key }})" value="{{ $ord->other_qty }}" name="other_qty[]"
                        style="width: 55px">
                </td>
                <td>
                    {{ $ord->other_rate*$ord->other_qty }}
                    <span id="other_total_qty{{ $key }}"></span>
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>
<button type="submit" class="btn btn-primary">Confirm Stock In</button>
