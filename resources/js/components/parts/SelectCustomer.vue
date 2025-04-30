<template>
    <table class="table table-bordered">
        <tr>
            <td>Order No</td>
            <td>
                {{ order_no }}
                <input type="text" name="order_no" :value="order_no" hidden>
            </td>
        </tr>
        <tr>
            <td>Customer Name <add-new-customer></add-new-customer></td>
            <td>
                <div class="form-group">
                    <vue-select v-model="selected_customer" :options="all_customers" name="customer"
                        placeholder="Select Customer" @change="getCustomer(selected_customer)" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Site Delivery Address</td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="customer_address" id="customer_address"
                        placeholder="address">
                </div>
            </td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="customer_mobile" id="customer_mobile"
                        placeholder="Mobile">
                </div>
            </td>
        </tr>
    </table>
</template>

<script>
import Select2 from 'v-select2-component';
import AddNewCustomer from './AddNewCustomer.vue';

export default {
    name: 'select-customer',
    data() {
        return {
            order_no: null,
            all_customers: [],
            selected_customer: { id: null, label: null },
        }
    },
    mounted() {
        this.getAllCustomers();
        this.getOrderNo();
    },
    computed: {

    },
    components: {
        'vue-select': Select2,
        'add-new-customer': AddNewCustomer,
    },
    methods: {
        getAllCustomers() {
            axios.get('/api/customers')
                .then(response => {
                    this.all_customers = response.data.data;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        getOrderNo() {
            axios.get('/api/order_no')
                .then(response => {
                    this.order_no = response.data;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        getCustomer(id) {
            axios.get(`/api/customer/show/${id}`)
                .then(response => {
                    document.getElementById('customer_mobile').value = response.data.data.phone;
                    document.getElementById('customer_address').value = response.data.data.address;
                })
                .catch(e => {
                    console.log(e);
                });

        }

    }
}
</script>