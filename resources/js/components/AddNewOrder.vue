<template>
<div>
    <table class="table table-bordered">
        <thead class="bg-dark">
            <tr class="text-white text-center">
                <th scope="col">Sl</th>
                <th scope="col">Die No & Description</th>
                <th scope="col" v-if="type=='Aluminium'">Color</th>
                <!-- <th scope="col">Unit</th> -->
                <th scope="col">Size/Length</th>
                <th scope="col">Thickness</th>
                <th scope="col">QTY</th>
                <th scope="col">Rate</th>
                <th scope="col">Amount</th>
                
                <!-- <th scope="col" colspan="3" class="text-center" v-if="type !== 'SS' && type !== 'Glass'">Silver</th>
                <th scope="col" colspan="3" class="text-center" v-if="type !== 'SS' && type !== 'Glass'">Bronze</th>    
                <th scope="col" colspan="3" class="text-center" v-if="type !== 'Glass'">SS</th> -->
                <th scope="col" colspan="1" class="text-center" >Action</th>
                <!-- <th scope="col" colspan="3" class="text-center">
                    Other
                    <input type="text" class="form-control" name="other_text">
                </th> -->

            </tr>
            <!-- <tr class="bg-dark">
                <td colspan="4"></td> -->
                <!-- <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Rate</td>
                <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Qty</td>
                <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Total</td>
                
                <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Rate</td>
                <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Qty</td>
                <td class="text-white text-center" v-if="type !== 'SS' && type !== 'Glass'">Total</td>

                <td class="text-white text-center" v-if="type !== 'Glass'">Rate</td>
                <td class="text-white text-center" v-if="type !== 'Glass'">Qty</td>
                <td class="text-white text-center" v-if="type !== 'Glass'">Total</td> -->

                <!-- <td></td> -->

                <!-- 
                <td class="text-white text-center">Rate</td>
                <td class="text-white text-center">Qty</td>
                <td class="text-white text-center">Total</td> -->
            <!-- </tr> -->
        </thead>

        <tbody id="table-body">

            <tr class="text-center" v-for="(input,index) in inputs" :key="input.id">
                <th scope="row">{{ index + 1 }}</th>
                <td><vue-select @change="setProductValue($event,input.id)" :options="all_products"
                            name="product_id[]" placeholder="Select Product"/></td>

                <td v-if="type=='Aluminium'">
                    <select name="color[]" id="" class="form-control" @change="selectColorSetRate($event, input.id)" required>
                        <option value="">Select Color</option>
                        <option value="silver">Silver</option>
                        <option value="bronze">Bronze</option>
                        <option value="ss">SS</option>
                        <!-- <option value="silver">Other</option> -->
                    </select>
                </td>

                <!-- <td>{{ input.unit }}</td> -->
                <td>{{ input.size }}</td>
                <td>{{ input.thickness }}</td>
                <td>
                    <input type="number" step="any" min="0" name="qty[]"  :id="`qty`+input.id" class="form-control" @keyup="updateInput($event,input.id)" @change="updateInput($event,input.id)"  style="width: 100px" autocomplete="off" required>
                </td>
                <td>
                    <span :id="`rate_span`+input.id"></span>
                    <input type="text" name="rate[]" hidden :id="`rate`+input.id">
                </td>
                <td>
                    <span :id="`value_span`+input.id"></span>
                    <input type="text" name="value[]" hidden :id="`value`+input.id">
                </td>

                <!-- <td class="text-center" v-if="type !== 'SS' && type !== 'Glass'">
                    {{input.silver_rate}}
                    <input type="text" name="silver_rate[]" hidden :value="input.silver_rate" :id="`silver_rate`+input.id">
                </td>
                <td class="text-center" v-if="type !== 'SS' && type !== 'Glass'">
                    <input type="number" min="0" name="silver_qty[]" @keyup="updateSilverInputs($event,input.id)" @change="updateSilverInputs($event,input.id)" :id="`silver_qty`+input.id" style="width: 55px" autocomplete="off">
                </td>
                <td v-if="type !== 'SS' && type !== 'Glass'">
                    <span :id="`silver_value`+input.id"></span>
                </td>

                <td class="text-center" v-if="type !== 'SS' && type !== 'Glass'">
                    {{input.bronze_rate}}
                    <input type="text" name="bronze_rate[]" hidden :value="input.bronze_rate" :id="`bronze_rate`+input.id">
                </td>                
                <td class="text-center" v-if="type !== 'SS' && type !== 'Glass'">
                    <input type="number" min="0" name="bronze_qty[]" @keyup="updateBronzeInputs($event,input.id)" @change="updateBronzeInputs($event,input.id)" :id="`bronze_qty`+input.id" style="width: 55px" autocomplete="off">
                </td>
                <td v-if="type !== 'SS' && type !== 'Glass'">
                    <span :id="`bronze_value`+input.id"></span>
                </td>                 
    

                <td class="text-center" v-if="type !== 'Glass'">
                    {{input.ss_rate}}
                    <input type="text" name="ss_rate[]" hidden :value="input.ss_rate" :id="`ss_rate`+input.id">
                </td>
                <td class="text-center" v-if="type !== 'Glass'">
                    <input type="number" min="0" name="ss_qty[]"  @keyup="updateSsInputs($event,input.id)" @change="updateSsInputs($event,input.id)" :id="`ss_qty`+input.id" style="width: 55px" autocomplete="off">
                </td>
                <td v-if="type !== 'Glass'">
                    <span :id="`ss_value`+input.id"></span>
                </td> -->

                <td class="d-flex">
                    <button class="btn btn-success mr-1" @click.prevent="addAnotherItem">+</button>
                    <button class="btn btn-danger" @click.prevent="removeItem">-</button>
                </td>
          
`           <!-- 
                <td class="text-center">
                    {{input.other_rate}} 
                    <input type="text" name="other_rate[]" hidden :value="input.other_rate" :id="`other_rate`+input.id">

                </td>
                <td class="text-center">
                    <input type="number" min="0" name="other_qty[]" @keyup="updateOtherInputs($event,input.id)" @change="updateOtherInputs($event,input.id)" :id="`other_qty`+input.id" style="width: 55px" autocomplete="off">
                </td>
                <td>
                    <span :id="`other_value`+input.id"></span>
                </td> -->
            </tr>



            <tr class="text-center bg-dark text-white">
                               <td></td>
                <td colspan="2" class="text-right">Total</td>
                
    
                <td></td>
                <td v-if="type=='Aluminium'"></td>
                   

 
                <td><span id="total_qty">0</span></td>
                <td></td>

                <td>
                    <span id="total_value_span">0</span>
                    <input type="text" hidden id="total_value">
                </td>
                <td></td>



            </tr>

        </tbody>
    </table>

    <div class="row mt-5">
        <div class="col-lg-9"></div>
        <div class="col-lg-3">
            <table class="table table-bordered">
                <tr>
                    <td class="text-right">Grand Total</td>
                    <td><span class="font-weight-bold" id="grand_total"></span>TK</td>
                    <input type="text" name="grandTotal" hidden id="grand_total_input">
                </tr>
                <tr>
                    <td>
                        <div class="d-flex">Supplier Commision &nbsp; <span>
                                <input @keyup="calculate_supplier_comm($event)"
                                    name="supplier_com_percent" id="supplier_com_percent"
                                    type="text" style="width: 80px"
                                    placeholder="ex: 15%"></span></div>
                    </td>
                    <td><span class="font-weight-bold" id="supplier_comm_show"></span></td>
                    <input type="text" hidden id="supplier_grand_total"
                        name="supplier_comm_show">
                </tr>
                <tr>
                    <td>
                        <div class="d-flex">Supplier Advance</div>
                    </td>
                    <td><span class="font-weight-bold"><input type="text"
                                name="supplier_advenced" style="width: 80px"
                                placeholder="ex: 1000TK"></span></td>
                </tr>
                <!-- <tr>
                    <td>
                        <div class="d-flex">Customer Commision &nbsp; <span><input
                                    type="text" style="width: 80px"
                                    @keyup="calculate_customer_comm($event)"
                                    id="customer_com_percent" name="customer_com_percent"
                                    placeholder="ex: 10%"></span></div>
                    </td>
                    <td><span class="font-weight-bold" id="customer_comm_show"></span></td>
                    <input type="text" hidden id="customer_grand_total"
                        name="customer_comm_show">
                </tr>
                <tr>
                    <td>
                        <div class="d-flex">Customer Advance</div>
                    </td>
                    <td><span class="font-weight-bold"><input type="text"
                                name="customer_advence" style="width: 80px"
                                placeholder="ex: 1000TK"></span></td>
                </tr> -->
            </table>                                
        </div>
    </div>

     <input type="hidden" v-model="do_render">
</div>
</template>

<script>
    import Select2 from 'v-select2-component';

    export default {
        name: 'add-new-order',
        props: ['type'],
        data(){
            return {                
               all_products: [],
               counter: 0,
               inputs: [
                    {
                        id: '0',                      
                    },
               ],
               do_render: 0,
            }
        },
        mounted(){
            this.getAllProducts();
        },
        computed: {
           
        },
        components: {
            'vue-select' : Select2,
        },
        methods: {
            getAllProducts(){
                axios.get(`/api/all_products/${this.type}`)
                    .then(response=>{
                        this.all_products = response.data.data;
                    })
                    .catch(e=>{
                        console.log(e);
                    });
            },
            setProductValue(product_id,input_id){
                axios.get(`/api/product/${product_id}`)
                    .then(response=>{
                    var index =  _.findIndex(this.inputs, o=>{
                            return o.id == input_id;
                        });
                    this.inputs[index] = {
                        id: input_id,
                        product_id: product_id,
                        die: response.data.data.die,
                        item_description: response.data.data.item_description,
                        unit: response.data.data.unit,
                        product_type: response.data.data.product_type,
                        size: response.data.data.size,
                        thickness: response.data.data.thickness,
                        color: response.data.data.color,
                        silver_rate: response.data.data.silver_rate,
                        bronze_rate: response.data.data.bronze_rate,
                        ss_rate: response.data.data.ss_rate,
                        other_rate: response.data.data.other_rate,
                    }     
                    
                    if(this.type=='SS'){
                        var rate = this.inputs[index].ss_rate;
                        document.getElementById(`rate${input_id}`).value = rate;
                        document.getElementById(`rate_span${input_id}`).innerHTML = rate;
                    }
                    
                    ++this.do_render;

                    })
                    .catch(e=>{
                        console.log(e);
                    });
            },
            selectColorSetRate(event, input_id){
                var color = event.target.value;
                var index =  _.findIndex(this.inputs, o=>{
                            return o.id == input_id;
                        });
                if (color == 'silver') {
                    var rate = this.inputs[index].silver_rate;
                } else if(color == 'bronze') {
                    var rate = this.inputs[index].bronze_rate;  
                }else if(color == 'ss'){
                    var rate = this.inputs[index].ss_rate;
                }
                document.getElementById(`rate${input_id}`).value = rate;
                document.getElementById(`rate_span${input_id}`).innerHTML = rate;
            },
            addAnotherItem(){
                this.inputs.push({
                    id: `${++this.counter}`,
                    product_id: null,
                    die: null,
                    item_description: null,
                    unit: null,
                    product_type: null,
                    size: null,
                    thickness: null,
                    color: null,
                    silver_rate: null,
                    bronze_rate: null,
                    ss_rate: null,
                    other_rate: null,
                });
                 
            },
            removeItem(id){
                this.inputs.splice(_.findIndex(this.inputs, o=>{
                    return o.id == id;
                }), 1);
            },
            doRender(){
                ++this.do_render;
            },  

            updateInput(event,input_id){
                var qty = event.target.value;
                var rate = document.getElementById(`rate${input_id}`).value;            
                document.getElementById(`value_span${input_id}`).innerHTML = Number(rate) * Number(qty);
                document.getElementById(`value${input_id}`).value = Number(rate) * Number(qty);

                var total_qty = document.getElementById('total_qty');
                var total_qtyyy = 0.0;
                this.inputs.forEach(element => {
                    total_qtyyy += Number(document.getElementById(`qty${element.id}`).value)
                });
                total_qty.innerHTML = total_qtyyy

                var total_value_span = document.getElementById('total_value_span');
                var total_value = document.getElementById('total_value');
                var total_valueee = 0.0;
                this.inputs.forEach(element => {
                    total_valueee += (Number(document.getElementById(`rate${element.id}`).value) * Number(document.getElementById(`qty${element.id}`).value))
                });
                total_value_span.innerHTML = total_valueee;
                total_value.value = total_valueee;

                this.grandTotal();
            },

            updateSilverInputs(event, input_id){
                var silver_qty_value = event.target.value;
                var silver_rate = document.getElementById(`silver_rate${input_id}`).value;            
                document.getElementById(`silver_value${input_id}`).innerHTML = Number(silver_qty_value) * Number(silver_rate);

                var total_silver_qty = document.getElementById('total_silver_qty');
                var total_qty = 0.0;
                this.inputs.forEach(element => {
                    total_qty += Number(document.getElementById(`silver_qty${element.id}`).value)
                });
                total_silver_qty.innerHTML = total_qty

                var total_silver_value = document.getElementById('total_silver_value');
                var total_value = 0.0;
                this.inputs.forEach(element => {
                    total_value += (Number(document.getElementById(`silver_rate${element.id}`).value) * Number(document.getElementById(`silver_qty${element.id}`).value))
                });
                total_silver_value.innerHTML = total_value

                this.grandTotal();


            },

            updateBronzeInputs(event, input_id){
                var bronze_qty_value = event.target.value;
                var bronze_rate = document.getElementById(`bronze_rate${input_id}`).value;            
                document.getElementById(`bronze_value${input_id}`).innerHTML = Number(bronze_qty_value) * Number(bronze_rate);


                var total_bronze_qty = document.getElementById('total_bronze_qty');
                var total_qty = 0.0;
                this.inputs.forEach(element => {
                    total_qty += Number(document.getElementById(`bronze_qty${element.id}`).value)
                });
                total_bronze_qty.innerHTML = total_qty

                var total_bronze_value = document.getElementById('total_bronze_value');
                var total_value = 0.0;
                this.inputs.forEach(element => {
                    total_value += (Number(document.getElementById(`bronze_rate${element.id}`).value) * Number(document.getElementById(`bronze_qty${element.id}`).value))
                });
                total_bronze_value.innerHTML = total_value

                this.grandTotal();
            },

            updateSsInputs(event, input_id){
                var ss_qty_value = event.target.value;
                var ss_rate = document.getElementById(`ss_rate${input_id}`).value;            
                document.getElementById(`ss_value${input_id}`).innerHTML = Number(ss_qty_value) * Number(ss_rate);

                var total_ss_qty = document.getElementById('total_ss_qty');
                var total_qty = 0.0;
                this.inputs.forEach(element => {
                    total_qty += Number(document.getElementById(`ss_qty${element.id}`).value)
                });
                total_ss_qty.innerHTML = total_qty

                var total_ss_value = document.getElementById('total_ss_value');
                var total_value = 0.0;
                this.inputs.forEach(element => {
                    total_value += (Number(document.getElementById(`ss_rate${element.id}`).value) * Number(document.getElementById(`ss_qty${element.id}`).value))
                });
                total_ss_value.innerHTML = total_value

                this.grandTotal();

            },

            updateOtherInputs(event, input_id){
                var other_qty_value = event.target.value;
                var other_rate = document.getElementById(`other_rate${input_id}`).value;            
                document.getElementById(`other_value${input_id}`).innerHTML = Number(other_qty_value) * Number(other_rate);

                var total_other_qty = document.getElementById('total_other_qty');
                var total_qty = 0.0;
                this.inputs.forEach(element => {
                    total_qty += Number(document.getElementById(`other_qty${element.id}`).value)
                });
                total_other_qty.innerHTML = total_qty

                var total_other_value = document.getElementById('total_other_value');
                var total_value = 0.0;
                this.inputs.forEach(element => {
                    total_value += (Number(document.getElementById(`other_rate${element.id}`).value) * Number(document.getElementById(`other_qty${element.id}`).value))
                });
                total_other_value.innerHTML = total_value

                this.grandTotal();

            },

            grandTotal(){
                var grand_total = document.getElementById('grand_total');
                var grand_total_input = document.getElementById('grand_total_input');

                var total_value = document.getElementById('total_value').value;

                grand_total.innerHTML = Number(total_value);
                grand_total_input.value = Number(grand_total.innerHTML);

            },

            calculate_supplier_comm(event){
                var percent = event.target.value                
                
                var supplier_comm_show = document.getElementById('supplier_comm_show');
                var supplier_grand_total = document.getElementById('supplier_grand_total');
                var grand_total = Number(document.getElementById('grand_total').innerHTML);

                var total = (grand_total * percent) / 100;
                supplier_comm_show.innerHTML = total;
                supplier_grand_total.value = total;

            },

            // calculate_customer_comm(event){
            //     var percent = event.target.value     
            
            //     var customer_comm_show = document.getElementById('customer_comm_show');
            //     var customer_grand_total = document.getElementById('customer_grand_total');
            //     var grand_total = Number(document.getElementById('grand_total').innerHTML);

            //     var total = (grand_total * percent) / 100;
            //     customer_comm_show.innerHTML = total;
            //     customer_grand_total.value = total;
            // }
       
        }
    }
</script>
