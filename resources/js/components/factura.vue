<template>
	<form class="needs-validation " novalidate>
		<div class="card " style="width: 38rem;">
			<dl class="row">
				<dt class="col-sm-3">nombre</dt>
				<dd class="col-sm-9">A description list is perfect for defining terms.</dd>

				<dt class="col-sm-3">Cantidad</dt>
				<dd class="col-sm-9">
					<p>Definition for the term.</p>
				</dd>

				<dt class="col-sm-3">Precio</dt>
				<dd class="col-sm-9">
					<p>Definition for the term.</p>
				</dd>
			</dl>
		</div>

		<button class="w-100 btn btn-primary btn-lg" type="submit">Continue to checkout</button>

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
