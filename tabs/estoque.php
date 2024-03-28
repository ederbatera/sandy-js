<div class="tab-pane fade" id="tab-estoque" role="tabpanel" aria-labelledby="tab-estoque-tab">

	<div class="row justify-content-end">
		<div class="col-auto">
			<button class="btn btn-sm btn-primary " type="button"><i class="fa-solid fa-cart-plus"></i>	Novo Estoque</button>
		</div>
	</div>

	<div class="row mt-4 text-center justify-content-center">
		<div class="col-12 overflow-auto" style="height: 60vh">
			<table class="table table-success table-sm table-borderless table-responsive table-hover text-start"
				id="table-funcionarios">
				<!-- <table id="table-funcionarios"> -->
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr>
						<th scope="col">ID</th>
						<th scope="col">Quantidade</th>
						<th scope="col">Fornecedor</th>
						<th scope="col">Usuário criador</th>
						<th scope="col">Data de cadastro</th>
						<th scope="col">Atualizado</th>
					</tr>
				</thead>
				<tbody class="table-persona fs-6" id="tbody-list-estoques">
					<!-- Append JS -->
				</tbody>
			</table>
		</div>
	</div>
</div>