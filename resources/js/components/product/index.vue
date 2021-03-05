<template>
    <div class="container-fluid mt-5">
        <div class="row">
            <div v-for="(product, index) in products_i" :key="index" class="col-3 mt-3">
                <div class="card" style="width: 20rem;" >
                    <img class="card-img-top" v-bind:src="'http://127.0.0.1:8000/images/'+product.url" alt="Card image cap" width="100%" height="200px">
                    <div class="card-body">
                        <h4 class="card-title"><strong>{{product.name}}</strong></h4>
                        <h6><strong>Category: </strong>{{product.categories.name}}</h6>
                        <h6><strong>Description:</strong>{{product.description}}</h6>
                        <h6><strong>Stock: </strong>{{product.stock}}</h6>
                        <h6><strong>Price: </strong>$ {{product.value}}</h6>
                        <a v-bind:href="'http://127.0.0.1:8000/Product/edit/'+product.id" class="btn btn-primary">Edit</a>
                        <button @click="Delete(product.id, index)" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    props:['products'],

    data(){
        return{
            url:'http://127.0.0.1:8000/Product/update/',
            products_i:[]
        }
    },
    created(){
        this.products_i = this.products
    },
    methods:{
        async getProducts(){
            var tipo = "datos"
			axios.get(`/Product/product/${tipo}`).then(res=>{
                this.products_i = res.data
			}).catch(error=>{
                console.log(error)
            })
		},
        async Delete(id, index){
            axios.post(`/Product/delete/${id}`).then(res=>{
                this.products_i.splice(index, 1)
            }).catch(error=>{
                console.log(error)
            })
        }
    }

}
</script>
