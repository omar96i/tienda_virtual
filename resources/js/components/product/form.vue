<template>
    <div class="container mt-4">
        <h4>{{type}} product</h4>
        <form @submit.prevent="action" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">Name product</label>
                    <input type="text" v-if="mode" class="form-control" v-model="insert_product.name" placeholder="Name...">
                    <input type="text" v-else class="form-control" v-model="update_product.name" placeholder="Name...">
                </div>
                <div class="mb-3 col-6">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" v-if="mode" class="form-control" v-model="insert_product.value" placeholder="Value...">
                    <input type="number" v-else class="form-control" v-model="update_product.value" placeholder="Value...">
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" v-if="mode" class="form-control" v-model="insert_product.stock" placeholder="Stock...">
                    <input type="number" v-else class="form-control" v-model="update_product.stock" placeholder="Stock...">
                </div>
                <div class="mb-3 col-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="1" v-if="mode" v-model="insert_product.description"></textarea>
                    <textarea class="form-control" rows="1" v-else v-model="update_product.description"></textarea>
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label class="form-label">Image</label>
                    <input class="form-control" name="pinture"  type="file" v-on:change="onImageChange">
                    <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
                </div>
                <div class="mb-3 col-6">
                    <label>Category</label>
                    <select class="form-control" v-if="mode" v-model="insert_product.category_id">
                        <option v-for="(category, index) in category_i" :key="index" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                    <select class="form-control" v-else v-model="update_product.category_id">
                        <option v-for="(category, index) in category_i" :key="index" :selected="category.id == update_product.category_id" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <div class="col-12">
                    <button class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
export default {

    props:['category', 'product', 'type'],
    data(){
        return{
            image:'',
            category_i:{

            },

            insert_product:{
                name:'',
                value:'',
                stock: '',
                description: '',
                url: '',
                category_id: ''
            },

            update_product:{

            },

            mode:false,
            imagePreview: null,
            showPreview: false,
        }
    },
    created(){
        if(this.type == "insert"){
            this.mode=true
        }else{
            this.update_product = this.product
        }
        this.category_i = this.category
    },
    methods:{
        onImageChange(e){
            this.image = e.target.files[0]


            let reader  = new FileReader();

            reader.addEventListener("load", function () {
                this.showPreview = true;
                this.imagePreview = reader.result;
            }.bind(this), false);

            if( this.image ){


                if ( /\.(jpe?g|png|gif)$/i.test( this.image.name ) ) {

                    console.log("here");
                    /*
                    Fire the readAsDataURL method which will read the file in and
                    upon completion fire a 'load' event which we will listen to and
                    display the image in the preview.
                    */
                    reader.readAsDataURL( this.image );
                }
            }
        },

        async action(){
            if(this.mode){
                let data = new FormData();
                data.append("name", this.insert_product.name)
                data.append("value", this.insert_product.value)
                data.append("stock", this.insert_product.stock)
                data.append("description", this.insert_product.description)
                data.append("category_id", this.insert_product.category_id)
                data.append("url", this.image, this.image.name)
                axios.post(`/Product/store`, data).then(res=>{
                    this.$root.$children[1].getProducts()
                    this.insert_product.name = ''
                    this.insert_product.value = ''
                    this.insert_product.stock = ''
                    this.insert_product.description = ''
                    this.insert_product.category_id = ''
                    this.insert_product.url = ''
                }).catch(error=>{
                    console.log(error)
                })
            }else{
                let data = new FormData()
                data.append("name", this.update_product.name)
                data.append("value", this.update_product.value)
                data.append("stock", this.update_product.stock)
                data.append("description", this.update_product.description)
                data.append("category_id", this.update_product.category_id)
                data.append("url", this.image, this.image.name)
                axios.post(`/Product/update/${this.update_product.id}`, data).then(res=>{
                    location.href ="http://127.0.0.1:8000/Product/product/"+"admin";
                }).catch(error=>{
                    console.log(error)
                })
            }
		},
    }
}
</script>
