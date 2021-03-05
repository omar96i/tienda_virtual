<template>
	<div>
		<div class="row d-flex justify-content-center mt-5">
			<div v-for="(products, index) in products" :key="index" class="col-4">
				<div class="card col-11 mb-4 bg-light">
					<div class="card-header d-flex justify-content-center">
						<img v-bind:src="'http://127.0.0.1:8000/images/'+products.url" class="card-img-top" alt="..." style="width: 250px">
					</div>
					<div class="card-body">
						<h5 class="card-title">{{ products.name }}</h5>
						<p class="card-text">{{products.description}}</p>
						<div>
							<div class="price text-success">
								<h5 class="mt-4">${{ products.value }}</h5>
							</div>
							<a class="p-2 text-dark" href="#">Disponibles {{ products.stock }}</a>
						</div>
						<a v-bind:href="url+'/'+products.id" class="btn btn-success">Comprar</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		props: ["categories"],
		data() {
			return {
                url: "http://127.0.0.1:8000/Product/detalleProducto",
				products: [],
			};
		},
		methods: {
			async getProducts(category_id) {
                var tipo = "consulta";
				axios
					.get(`/categories/${category_id}/${tipo}`)
					.then((res) => {
						this.products = res.data
					})
					.catch((error) => {
						console.log(error);
					});
			},
		},
		created() {
			this.getProducts(this.categories.id);
		},
	};
</script>
