<template>
	<div>
		<div class="col-12 mt-2 mb-4 pt-2">
			<div class="row justify-content-between align-items-center">
				<strong>Manage Credit Cards</strong>
				<button class="btn btn-primary" data-toggle="modal" data-target="#add_card">
					Add Card
				</button>
			</div>
		</div>
		<div class="col-12 mt-4 mb-2">
			<div class="row justify-content-between align-items-center">
				<div class="col-3 pl-0">
					<strong class="text-secondary">Expires</strong>
				</div>
				<div class="col-3 text-center">
					<strong class="text-secondary">Number</strong>
				</div>
				<div class="col-3">
					<strong class="text-secondary text-center">Card Type</strong>
				</div>
				<div class="col-3 pr-0 text-right"></div>
			</div>
		</div>
		<div class="col-12">
			<div class="row justify-content-between align-items-center mb-2">
				<div class="col-3 pl-0">
					<div class="col-12">
						<div class="row align-items-center">
							<img src="/img/true.png" width="20" alt="">
							<span class="ml-2">Aug 22, 2020 (in 34 days)</span>
						</div>
					</div>
				</div>
				<div class="col-3 text-center">
					<span>****7432</span>
				</div>
				<div class="col-3 text-center">
					<div class="col-12">
						<div class="row align-items-center">
							<img src="/img/visa.png" width="20" alt="">
							<span class="ml-2">VISA</span>
						</div>
					</div>
				</div>
				<div class="col-3 pr-0 text-right">
					<button type="button" class="btn btn-sm btn-primary mt-2" data-toggle="modal" data-target="#set_as_default">
						Set as Default
					</button>
					<button type="button" class="btn btn-sm btn-secondary ml-2 mt-2" data-toggle="modal" data-target="#remove_card">
						Remove
					</button>
				</div>
			</div>
			<div class="row justify-content-between align-items-center">
				<div class="col-3 pl-0">
					<div class="col-12">
						<div class="row align-items-center">
							<img src="/img/true.png" width="20" alt="">
							<span class="ml-2">Aug 22, 2020 (in 34 days)</span>
						</div>
					</div>
				</div>
				<div class="col-3 text-center">
					<span>****7432</span>
				</div>
				<div class="col-3 text-center">
					<div class="col-12">
						<div class="row align-items-center">
							<img src="/img/visa.png" width="20" alt="">
							<span class="ml-2">VISA</span>
							<span class="badge badge-sm badge-success ml-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">Currently Default</span>
						</div>
					</div>
				</div>
				<div class="col-3 pr-0 text-right">
					<button type="button" class="btn btn-sm btn-secondary" data-toggle="modal" data-target="#remove_card">
						Remove
					</button>
				</div>
			</div>
		</div>
		<hr>
		<span>You did not add any credit cards yet.</span>
		<div id="add_card" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Add new Credit Card
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-lg-12 pt-4 mb-3">
							<div class="row">
								<div class="form-group w-100 mb-0">
									<input type="text" class="form-control" placeholder="Card number">
								</div>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="row">
								<div class="form-group w-100 mb-0">
									<input type="text" class="form-control" placeholder="Name on card">
								</div>
							</div>
						</div>
						<div class="col-lg-12 mb-3">
							<div class="row">
								<div class="col-lg-6 pl-0">
									<div class="form-group w-100 mb-0">
										<input type="text" class="form-control" placeholder="MM / YY">
									</div>
								</div>
								<div class="col-lg-6 pr-0">
									<div class="form-group w-100 mb-0">
										<input type="text" class="form-control" placeholder="CVC">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Add Card
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="set_as_default" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Change Default Card
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="text-center">
							This will set the card ending with <strong>****4483</strong> as your default payment method.
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary">
							Make Default
						</button>
					</div>
				</div>
			</div>
		</div>
		<div id="remove_card" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 id="exampleModalLabel" class="modal-title">
							Remove Card
						</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="text-left">
							Remove the card ending with <strong>****4483</strong>?
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
						<button type="button" class="btn btn-primary">
							Remove Card
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {

		components: {
			//
		},
		data() {
			return {
				//
			};
		},

		mounted() {
			console.log('DashboardBillingCards mounted!');
			$('[data-toggle="tooltip"]').tooltip();
		},

		methods: {
			//
		},
	};
</script>
