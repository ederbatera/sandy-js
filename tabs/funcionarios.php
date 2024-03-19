<div class="tab-pane fade" id="tab-funcionarios" role="tabpanel" aria-labelledby="tab-funcionarios-tab">
	 <div class="row justify-content-between">
	 	<div class="col-2">
		 	<div class="input-group input-group-sm">
				<span class="input-group-text" id="inputGroup-rfid-sm">Cartão RFID</span>
				<input type="password" class="form-control form-control-sm" id="rfidCardInput" name="rfidCardInput" aria-label="Sizing example input" aria-describedby="inputGroup-rfid-sm">
				<button class="btn btn-sm btn-outline-dark" type="button" id="findRfidCard" onclick="getRFID()"><i class="fa-solid fa-magnifying-glass"></i></button>
			</div>
	 	</div>
	 	<div class="col-4">
			<div class="input-group input-group-sm">
				<span class="input-group-text" id="inputGroup-find-sm">Filtrar</span>
				<input type="text" class="form-control" onblur="this.value = this.value.toUpperCase();" id="search-input-funcionarios" style="text-transform: uppercase;">
			</div>	 		
	 	</div>
	 	<div class="col-auto ml-auto">
		 	<button class="btn btn-sm btn-outline-dark" type="button" data-bs-toggle="modal" data-bs-target="#modalAddFuncionario"><i class="fa-solid fa-person-circle-plus fa-xl"></i></button>
			<button class="btn btn-sm btn-outline-dark ml-2" type="button" id="btn-atualizaFuncionarios" onclick="fetchData()"><i class="fa-solid fa-rotate fa-xl"></i></button>	 		
	 	</div>
	 </div>
	<div class="row mt-4 text-center justify-content-center">
		<div class="col-12 overflow-auto" style="height: 68vh">
			<table class="table table-success table-sm table-borderless table-responsive table-hover text-start" id="table-funcionarios">
			<!-- <table id="table-funcionarios"> -->
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr>
						<th scope="col">Nome</th>
						<th scope="col">Matricula</th>
						<th scope="col">Vínculo</th>
						<th scope="col">Lotação</th>
						<th scope="col">Local</th>
						<th scope="col">Cargo</th>
						<th scope="col">Folha</th>
						<th scope="col">Secretaria</th>
						<th scope="col">Direito</th>
						<th scope="col">Opção</th>
						<!-- <th scope="col">Ativo</th> -->
						<th scope="col">Saldo</th>
						<th scope="col">Editar</th>
					</tr>
				</thead>
				<tbody class="font-size-12" id="tbody-list-funcionarios">
					<!-- Append JS -->
				</tbody>
			</table>
		</div>
		<div class="row justify-content-md-center mt-2" id="pagination-table-funcionarios"></div>
		<div class="row justify-content-md-center fs-bold mt-1" id="paginationInfo"></div>
	</div>
		
</div>
