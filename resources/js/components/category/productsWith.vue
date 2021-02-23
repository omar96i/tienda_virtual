<template>
	<div>
		<ul class="list-group">
			<li class="list-group-item">
				<div class="container mt-5">
					<div class="row">
						<div v-for="(products, index) in products" :key="index" class="col-3 mr-2">
							<div class="card" style="width: 18rem;">
								<div class="card-body">
									<img class="card-img-top" v-bind:src="'http://127.0.0.1:8000/images/'+products.url" alt="Card image cap">
									<h5 class="card-title">{{ products.name }}</h5>
									<p class="card-text">{{ products.description }}</p>
									<h6><strong>Category: </strong>{{products.categories.name}}</h6>
									<a href="#" class="card-link">Cantidad {{ products.stock }}</a>
									<a href="#" class="card-link">Precio {{ products.value }}</a>
									<a href="#" class="card-link">Another link</a>
								</div>
							</div>
						</div>

					</div>
				</div>
			</li>
		</ul>
	</div>
</template>
<script>
	export default {
		props: ["categories"],
		data() {
			return {
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
