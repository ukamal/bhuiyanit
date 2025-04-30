<template>
    <table class="table table-bordered">
        <tr>
            <td>Date</td>
            <td>
                <div class="form-group">
                    <input type="date" required class="form-control" name="order_date" id="date" placeholder="date">
                </div>
            </td>
        </tr>
        <tr>
            <td>Supplier Name <add-new-supplier></add-new-supplier></td>
            <td>
                <div class="form-group">
                    <vue-select v-model="selected_supplier" :options="all_suppliers" name="supplier"
                        placeholder="Select Supplier" @change="getSupplier(selected_supplier)" />
                </div>
            </td>
        </tr>
        <tr>
            <td>Address</td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="supplier_address" id="supplier_address"
                        placeholder="address">
                </div>
            </td>
        </tr>
        <tr>
            <td>Mobile</td>
            <td>
                <div class="form-group">
                    <input type="text" class="form-control" name="supplier_mobile" id="supplier_mobile"
                        placeholder="Mobile">
                </div>
            </td>
        </tr>
    </table>
</template>

<script>
import Select2 from 'v-select2-component';
import AddNewSupplier from './AddNewSupplier.vue';

export default {
    name: 'select-supplier',
    data() {
        return {
            all_suppliers: [],
            selected_supplier: { id: null, label: null },
        }
    },
    mounted() {
        this.getAllSuppliers();
    },
    computed: {

    },
    components: {
        'vue-select': Select2,
        'add-new-supplier': AddNewSupplier,
    },
    methods: {
        getAllSuppliers() {
            axios.get('/api/suppliers')
                .then(response => {
                    this.all_suppliers = response.data.data;
                })
                .catch(e => {
                    console.log(e);
                });
        },

        getSupplier(id) {
            axios.get(`/api/supplier/show/${id}`)
                .then(response => {
                    document.getElementById('supplier_mobile').value = response.data.data.phone;
                    document.getElementById('supplier_address').value = response.data.data.address;
                })
                .catch(e => {
                    console.log(e);
                });
        }

    }
}
</script>