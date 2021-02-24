<template>
    <div class="container mt-4">
        <h4>{{type}} product</h4>
        <form @submit.prevent="update" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">Name product</label>
                    <input type="text" class="form-control" v-model="product_i.name" placeholder="Name...">
                </div>
                <div class="mb-3 col-6">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" class="form-control" v-model="product_i.value" placeholder="Value...">
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" v-model="product_i.stock" placeholder="Stock...">
                </div>
                <div class="mb-3 col-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="1" v-model="product_i.description"></textarea>
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label class="form-label">Image</label>
                    <input class="form-control" name="pinture" type="file" v-on:change="onImageChange">
                    <img v-bind:src="imagePreview" width="100" height="100" v-show="showPreview"/>
                </div>
                <div class="mb-3 col-6">
                    <label>Category</label>
                    <select class="form-control" v-model="product_i.category_id">
                        <option v-for="(category, index) in category_i" :key="index" :selected="category.id == product_i.category_id" v-bind:value="category.id">{{category.name}}</option>
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
            product_i:{

            },
            imagePreview: null,
            showPreview: false,
        }
    },
    created(){
        this.category_i = this.category
        this.product_i = this.product
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
        async update(){
            let data = new FormData();
            data.append("name", this.product_i.name)
            data.append("value", this.product_i.value)
            data.append("stock", this.product_i.stock)
            data.append("description", this.product_i.description)
            data.append("category_id", this.product_i.id_category)
            data.append("url", this.image, this.image.name)
			axios.post(`/Product/product/update/${this.product_i.id}`, data).then(res=>{
                location.href ="http://127.0.0.1:8000/Product/product";
			}).catch(error=>{
                console.log(error)
            })
		},
    }
}
</script>
