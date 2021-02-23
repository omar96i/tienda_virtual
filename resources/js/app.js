
require('./bootstrap');

window.Vue = require('vue');

// Products //
import IndexProduct from './components/product/index.vue';
import EditProduct from './components/product/edit.vue';
import StoreProduct from './components/product/store.vue';
import DetalleProducto from './components/product/details.vue';
/////////////
// Category //
import StoreCategory from './components/category/store.vue';
import IndexCategory from './components/category/index.vue';
import EditCategory from './components/category/edit.vue';
import CategoryWithProducts from './components/category/withProducts.vue';
import ProductsWithCategory from './components/category/productsWith.vue';


/////////////
import register from './components/register.vue';
import HomeProducts from './components/homeProducts.vue';
import Factura from './components/factura.vue';
import User from './components/user.vue';
import RegisterAdmin from './components/registerAdmin.vue';


const app = new Vue({
    el: '#app',
    components:{
        IndexProduct,
        EditProduct,
        DetalleProducto,
        StoreProduct,

        StoreCategory,
        IndexCategory,
        EditCategory,
        CategoryWithProducts,
        ProductsWithCategory,

        HomeProducts,
        Factura,
        User,
        register,
        RegisterAdmin

    }
});
