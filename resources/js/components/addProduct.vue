<template>
    <div class="container mt-4">
        <h4>Add product</h4>
        <form @submit.prevent="register" method="post" enctype="multipart/form-data" class="mt-3">
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="name" class="form-label">Name product</label>
                    <input type="text" class="form-control" v-model="name" placeholder="Name...">
                </div>
                <div class="mb-3 col-6">
                    <label for="value" class="form-label">Value</label>
                    <input type="number" class="form-control" v-model="value" placeholder="Value...">
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label for="stock" class="form-label">Stock</label>
                    <input type="number" class="form-control" v-model="stock" placeholder="Stock...">
                </div>
                <div class="mb-3 col-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" rows="1" v-model="description"></textarea>
                </div>
            </div>
            <div class="input-group">
                <div class="mb-3 col-6">
                    <label class="form-label">Image</label>
                    <input class="form-control" type="file" v-on:change="onImageChange">
                </div>
                <div class="mb-3 col-6">
                    <label>Category</label>
                    <select class="form-control" v-model="id_category">
                        <option v-for="(category, index) in category" :key="index" v-bind:value="category.id">{{category.name}}</option>
                    </select>
                </div>
            </div>
            <div class="input-group">
                <div class="col-12">
                    <button class="btn btn-success">Confirm</button>
                </div>
            </div>
        </form>
        <button @click="buscando">hola</button>
    </div>
</template>
<script>
export default {
    props:['category'],
    data(){
        return{
            name: '',
            value:'',
            stock:'',
            description:'',
            id_category:'',
            image:''
        }
    },
    methods:{
        buscando(){
            console.log(this.$root.$children[1].getProducts());
        },
        onImageChange(e){
            this.image = e.target.files[0]
        },
        async register(){
            let data = new FormData();
            data.append("name", this.name)
            data.append("value", this.value)
            data.append("stock", this.stock)
            data.append("description", this.description)
            data.append("id_category", this.id_category)
            data.append("url", this.image, this.image.name)
			axios.post(`/product/insert`, data).then(res=>{
                console.log(res.data);
			}).catch(error=>{
                console.log(error)
            })
		},
    }
}
</script>
