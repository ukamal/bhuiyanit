require('../bootstrap');

import Vue from 'vue';
import ViewUI from 'view-design';
import 'view-design/dist/styles/iview.css';
Vue.use(ViewUI);


import AddNewOrder from '../components/AddNewOrder.vue';
import SelectCustomer from '../components/parts/SelectCustomer.vue';
import SelectSupplier from '../components/parts/SelectSupplier.vue';

const app = new Vue({
    el: '#add_new_order',
    components: {
        AddNewOrder: AddNewOrder,
        SelectCustomer: SelectCustomer,
        SelectSupplier: SelectSupplier,
    }
});
