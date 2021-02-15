<template>
    <div class="container mt-5">
        <div class="row">
            <div v-for="(product, index) in products" :key="index" class="col-3 mr-2">
                <div class="card" style="width: 18rem;" >
                    <img class="card-img-top" v-bind:src="'http://127.0.0.1:8000/images/'+product.url" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><strong>{{product.name}}</strong></h4>
                        <h6><strong>Category: </strong>{{product.Cname}}</h6>
                        <h6><strong>Description:</strong>{{product.description}}</h6>
                        <h6><strong>Stock: </strong>{{product.stock}}</h6>
                        <h6><strong>Price: </strong>$ {{product.value}}</h6>
                        <a v-bind:src="url+'/'+product.id" class="btn btn-primary">Edit</a>
                        <a href="#" class="btn btn-danger">Delete</a>
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
            url:'http://127.0.0.1:8000/test'
        }
    },
    methods:{
        async getProducts(){
			axios.post(`/product/getProducts`).then(res=>{
                this.products = res.data;
			}).catch(error=>{
                console.log(error)
            })
		},
    }

}
</script>
