<template>
	<form class="needs-validation" novalidate>
		<div class="row d-flex justify-content-center">
			<div class="card ">
				<div class="card-header d-flex justify-content-center">
					<img v-bind:src="'http://127.0.0.1:8000/images/'+products.url" class="card-img-top" alt="..." style="width: 250px">
				</div>
				<div class="card-body">
					<h5 class="card-title">{{ products.name }}</h5>
					<p class="card-text">{{products.description}}</p>
					<div>
						<a class="p-2 text-dark" href="#">Disponibles {{ products.stock }}</a>
						<div class="price text-success">
							<h5 class="mt-4">${{ products.value }}</h5>
						</div>
					</div>
				</div>
				<input type="submit" class="btn btn-success mb-3" value="Agregar al carrito">

				<a href="http://127.0.0.1:8000/factura" class=" btn btn-primary">Ver factura</a>
			</div>
		</div>
	</form>
</template>
<script>
	export default {
		props: ["products"],
		data() {
			return {
				products_i: {},
			};
		},
		created() {
			this.products_i = this.products;
		},
	};
</script>
