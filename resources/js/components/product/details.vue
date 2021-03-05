<template>
    <div class="row">
        <div class="col-8">
            <div class="row">
                <div class="col">
                    <img v-bind:src="'http://127.0.0.1:8000/images/'+products.url">
                </div>
            </div>
        </div>
        <div class="col-4 border-left border-info">
            <div class="col-12"><h4>Nombre: <strong>{{products.name}}</strong></h4></div><br>
            <div class="col-12"><h4>Precio:  <strong>$ {{products.value}}</strong></h4></div><br>
            <div class="col-12"><h5>Descripcion: </h5>{{products.description}}</div><br>
            <div class="col-12"><h6>Disponible: {{products.stock}}</h6></div><br>
            <div class="col-12"><label for="">Cantidad</label></div>
            <input type="number" v-model="datos.cantidad" class="form-control">
            <button class="btn btn-success btn-lg btn-block mt-4" @click="comprarProducto">Agregar al carrito</button>
            <div class="alert alert-success mt-3" role="alert" v-if="status">
                Producto Añadido. <a href="http://127.0.0.1:8000/Factura/carrito" class="alert-link">Ir al Carrito de compras</a>
            </div>
            <div class="alert alert-danger mt-3" role="alert" v-if="errorStatus">
                Cantidad ingresada, No valida
            </div>
        </div>
    </div>
</template>
<script>
	export default {
		props: ["products"],
		data() {
			return {
                datos: {
                    'cantidad' : ''
                },
                status: false,
                errorStatus: false
			}
		},
		created() {
			this.products_i = this.products;
		},

        methods:{
            async comprarProducto(){
                axios.post(`/Factura/store/${this.products.id}`, this.datos).then(res=>{
                    if(res.data.status){
                        this.errorStatus = false;
                        this.status = true;
                    }else{
                        this.errorStatus = true;
                    }
                })
            }
        }
	};
</script>
