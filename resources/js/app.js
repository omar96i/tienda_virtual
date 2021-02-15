
require('./bootstrap');

window.Vue = require('vue');

import login from './components/login.vue';
import product from './components/product.vue';
import register from './components/register.vue';
import AddCategory from './components/addCategory.vue';
import category from './components/category.vue';
import EditCategory from './components/editCategory.vue';
import AddProduct from './components/addProduct.vue';
import HomeProducts from './components/homeProducts.vue';
import DetalleProducto from './components/detalleProducto.vue';
import Factura from './components/factura.vue';





const app = new Vue({
    el: '#app',
    components:{
        product,
        login,
        register,
        AddCategory,
        category,
        EditCategory,
        AddProduct,
        HomeProducts,
        DetalleProducto,
        Factura
    }
});
