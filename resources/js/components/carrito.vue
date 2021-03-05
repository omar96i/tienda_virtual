<template>
	<div>
		<div class="container">
			<div class="row">
				<div class="col-8">
					<table class="table">
						<thead>
							<tr class="table-primary">
								<th scope="col">Producto</th>
								<th scope="col">Nombre</th>
								<th scope="col">Cantidad</th>
								<th scope="col">Subtotal</th>
								<th></th>
							</tr>
						</thead>
						<tbody v-if="status">
							<tr v-for="(factura, index) in factura.factura_producto" :key="index">
								<div>
									<th scope="row">
										<img :src="`http://127.0.0.1:8000/images/${ factura.url }`" width="100" height="100"></img>
									</th>
								</div>
								<td>{{ factura.name }}</td>
								<td>
									<div class="container">
										<div class="row justify-content-md-center">
											<div class="col col-lg-2">
												<button class="btn bg-info" @click="restar(factura)">-</button>
											</div>
											<div class="col-md-auto">
												<input type="6" v-model="factura.pivot.cantidad">
											</div>
											<div class="col col-lg-2">
												<button class="btn bg-info" @click.prevent="sumar(factura)">+</button>
											</div>

										</div>
									</div>

								</td>
								<td>{{ factura.value * factura.pivot.cantidad }}</td>
								<td>
									<div>
										<button class="btn bg-danger" @click="Delete(factura, index)">x</button>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-4 badge bg-info">
					<ul class="list-group">
						<li class="list-group-item active" aria-current="true">Nombre del usuario</li>
						<li class="list-group-item">{{ userAuth }}</li>
						<li class="list-group-item active" aria-current="true">Precio Total</li>
						<li class="list-group-item" v-if="status">{{ factura.total }}</li>
						<li class="list-group-item" v-else>0</li>
					</ul>
                    <div class="alert alert-success mt-3 mb-3" v-if="status_mens" role="alert">
                        Compra realizada
                    </div>
					<button class="btn btn-primary mt-3" v-if="status" @click="Finalizar (factura.id)">Realizar comprar</button>
					<button class="btn btn-primary mt-3" v-else disabled>Realizar comprar</button>

				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				factura: {},
				userAuth: "",
				status: true,
                status_mens: false
			};
		},
		methods: {
			sumar(factura) {
				if (factura.stock > factura.pivot.cantidad) {
					factura.pivot.cantidad = factura.pivot.cantidad + 1;
					axios
						.post(`/Factura/updateCantidad/${factura.pivot.factura_id}`, factura)
						.then((res) => {
							this.factura.total = res.data.total
						});
				} else {
					return "Limite alcanzado";
				}
			},
			restar(factura) {
				if (factura.pivot.cantidad > 0) {
					factura.pivot.cantidad = factura.pivot.cantidad - 1;
					axios
						.post(`/Factura/updateCantidad/${factura.pivot.factura_id}`, factura)
						.then((res) => {
							this.factura.total = res.data.total
						});
				} else {
					return "Cantidad minima alcanzada";
				}
			},
			async Delete(factura, index) {
				const array = { id: factura.pivot.product_id };
				axios
					.post(`/Factura/deleteProducto/${factura.pivot.factura_id}`, array)
					.then((res) => {
						this.factura.factura_producto.splice(index, 1);
                        this.factura.total = res.data.total
					})
					.catch((error) => {
						console.log(error);
					});
			},
			async Finalizar(id) {
				axios.get(`/Factura/Finalizar/${id}`).then((res) => {
					this.status_mens = true;
				});
			},
		},
		mounted() {
			axios.get(`/Factura/index`).then((res) => {
				if (res.data) {
					this.status = res.data.status;
					this.factura = res.data.factura;
					this.userAuth = res.data.user;
				} else {
					alert("Error");
				}
			});
		},
	};
</script>
