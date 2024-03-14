<div class="tab-pane fade" id="tab-cestas" role="tabpanel" aria-labelledby="tab-cestas-tab">
		<form id="userForm">
		<div class="row text-center justify-content-center">
			<div class="col-12 overflow-auto" style="height: 78vh">			
				<table class="table table-info table-sm table-borderless table-responsive table-hover text-start user-select-none" id="userTable">
				<thead class="table-primary sticky-top" style="background-color: #41605890; z-index: 10;">
					<tr class="">
					<th>Nome</th>
					<th>Matrícula</th>
          <th>Lotação</th>
          <th>Local</th>
          <th>Cargo</th>
					<th>Saldo <input class="form-check-input" id="checkBoxSaldoAll" type="checkbox"></th>
					</tr>
				</thead>
				<tbody class="height-150 font-size-12">
					<!-- Os campos de cada usuário serão adicionados aqui -->
				</tbody>
				</table>
			</div>
		</div>
    <div class="row justify-content-between mt-2">
      <!-- <div class="col"><button class="btn btn-danger" onclick="setSaldoAll()"> Carregar </button></div> -->
      <div class="col-auto">Total: <span class="badge bg-success fw-bold fs-6" id="usersAll">...</span></div>
      <div class="col-auto"> Com direito: <span class="badge bg-success fw-bold fs-6" id="usersWithRights">...</span></div>
      <div class="col-auto"> Optantes: <span class="badge bg-success fw-bold fs-6" id="usersWithOption">...</span></div>
      <div class="col-auto me-auto"> Selecionados: <span class="badge bg-success fw-bold fs-6" id="selectedUserCount">...</span></div>
      <div class="col-auto align-self-end"><input class="btn btn-sm btn-primary" type="submit" value="SALVAR"></div>
    </div>

	</form>

<script>

	const form = document.getElementById('userForm');
	const userTable = document.getElementById('userTable').getElementsByTagName('tbody')[0];
	const usersWithRightsElem = document.getElementById('usersWithRights');
  const usersWithOptionElem = document.getElementById('usersWithOption');
	const selectedusersWithOptionElem = document.getElementById('selectedUserCount');
  const checkBoxSaldoAll = document.getElementById('checkBoxSaldoAll');
	let selectedUserCount = 0;
  let formData = {}
		

	async function setSaldoAll (){

    const usersWithRightsAndOptions = __FUNCIONARIOS.filter(user => user.opcao_cesta === 1 && user.direito_cesta === 1 && user.ativo === 1 );
    const usersWithRights = __FUNCIONARIOS.filter(user => user.direito_cesta === 1 );
    const usersWithOption = __FUNCIONARIOS.filter(user => user.direito_cesta === 1 && user.opcao_cesta === 1 );
		userTable.textContent = '';
    selectedUserCount = 0;
    
    function updateCounts() {
      usersWithOptionElem.textContent = usersWithOption.length;
      selectedusersWithOptionElem.textContent = selectedUserCount;
      $("#usersAll").html(__FUNCIONARIOS.length);
      $("#usersWithRights").html(usersWithRights.length);
    }

    function updateSelectedUserCount(checked) {
      selectedUserCount += checked ? 1 : -1;
      updateCounts();
    }

    function createRow(user) {
      const row = document.createElement('tr');
      row.classList.add('border-top', 'text-start', 'lh-1');

      const userId = document.createElement('td');
      userId.textContent = user.id || '';
      userId.classList.add('hidden');
      row.appendChild(userId);

      const userName = document.createElement('td');
      userName.textContent = user.nome || '';
      row.appendChild(userName);

      const userMatricula = document.createElement('td');
      userMatricula.textContent = user.matricula || '';
      row.appendChild(userMatricula);

      const userLotacao = document.createElement('td');
      userLotacao.textContent = user.lotacao || '';
      row.appendChild(userLotacao);

      const userLocal = document.createElement('td');
      userLocal.textContent = user.local_trabalho || '';
      row.appendChild(userLocal);

      const userCargo = document.createElement('td');
      userCargo.textContent = user.cargo || '';
      row.appendChild(userCargo);

      const userSaldo = document.createElement('td');
      const saldoCheckbox = document.createElement('input');
      saldoCheckbox.setAttribute('type', 'checkbox');
      saldoCheckbox.classList.add('form-check-input');
      saldoCheckbox.setAttribute('name', `userSaldo[${user.id}]`); // Define um nome único para cada checkbox
      saldoCheckbox.setAttribute('value', 1);
      saldoCheckbox.checked = user.opcao_cesta == 1 ? true : false;
      if (user.opcao_cesta != 1) {
        row.classList.add('table-danger');
        updateSelectedUserCount();
      }

      // Adiciona um listener de clique ao checkbox para evitar propagação para a linha
      saldoCheckbox.addEventListener('click', function(event) {
        event.stopPropagation(); // Impede que o clique seja propagado para a linha
      });

      saldoCheckbox.addEventListener('change', function() {
        updateSelectedUserCount(this.checked);
        const row = this.closest('tr'); // Encontra a linha pai
        if (this.checked) {
          row.classList.remove('table-danger'); // Adiciona a classe quando marcado
        } else {
          row.classList.add('table-danger'); // Remove a classe quando desmarcado
        }        
      });
      userSaldo.appendChild(saldoCheckbox);
      row.appendChild(userSaldo);

      // const userIdInput = document.createElement('input');
      // userIdInput.setAttribute('type', 'number');
      // userIdInput.hidden = true;
      // userIdInput.setAttribute('name', `userId[${user.id}]`); // Define um nome único para cada ID
      // userIdInput.setAttribute('value', parseInt(user.id));
      // row.appendChild(userIdInput);

      // Adiciona evento de clique na linha para alternar o estado do checkbox
      row.addEventListener('click', function() {
        saldoCheckbox.checked = !saldoCheckbox.checked;
        updateSelectedUserCount(saldoCheckbox.checked);
        if (saldoCheckbox.checked) {
          row.classList.remove('table-danger');
        } else {
          row.classList.add('table-danger');
        }
      });

      //if (user.saldo == 1) {
        updateSelectedUserCount(true); // Atualiza a contagem inicial de checkboxes marcados
      //}

      return row;
    }

    function toggleAllCheckboxes(checked) {
      const checkboxes = userTable.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        checkbox.checked = checked;
        const row = checkbox.closest('tr');
        if (checked) {
          row.classList.remove('table-danger');
        } else {
          row.classList.add('table-danger');
        }
      });
      selectedUserCount = checked ? checkboxes.length : 0;
      updateCounts();
    }

    // Adiciona evento de clique ao checkbox no cabeçalho
    checkBoxSaldoAll.addEventListener('change', function() {
      toggleAllCheckboxes(this.checked);
    });
    
    
		// usersWithRights.forEach(user => {
    //   		const row = createRow(user);
    //   		userTable.appendChild(row);
    // 	});

      usersWithRightsAndOptions.forEach(user => {
      		const row = createRow(user);
      		userTable.appendChild(row);
    	});


    form.addEventListener('submit', async function(event) {
      event.preventDefault();

      Swal.fire({
        //title: 'Carregando...',
        allowOutsideClick: false,
        showConfirmButton: false,
    });
      Swal.showLoading();

      // Remove os elementos ocultos existentes antes de adicionar os novos
      const hiddenInputs = form.querySelectorAll('input[type="hidden"]');
      hiddenInputs.forEach(hiddenInput => {
        hiddenInput.remove();
      });
      
      const checkboxes = userTable.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach(checkbox => {
        if (!checkbox.checked) {
          const hiddenInput = document.createElement('input');
          hiddenInput.setAttribute('type', 'hidden');
          hiddenInput.setAttribute('name', checkbox.getAttribute('name'));
          hiddenInput.setAttribute('value', 0);
          form.appendChild(hiddenInput);
        }
      });
      formData = {}
      formData = new FormData(form)
      
      // //Display the key/value pairs
      // for (var pair of formData.entries()) {
      //     console.log(pair[0]+' => '+pair[1]); 
      // }

      try {
        const response = await fetch('../assets/_saldo_all.php', {
          method: 'POST',
          body: formData
        });
        //console.log(await response.text());
        const contentType = response.headers.get('content-type');
        Swal.close();
      if (contentType && contentType.indexOf('application/json') !== -1) {
        const jsonResponse = await response.json();
        
        if (response.ok) {
          fetchData();
          if (jsonResponse.success) {
            console.log('Usuários atualizados com sucesso:', jsonResponse.message);
            Swal.fire({
                        icon: 'success',
                        title: 'Sucesso!',
                        html: jsonResponse.message,
                        showConfirmButton: false,
                        timer: 2000
                      });
          } else {
            console.error('Falha ao atualizar os usuários:', jsonResponse.message);
              Swal.fire({
                          icon: 'error',
                          title: 'Ocorreu um erro:',
                          html: jsonResponse.message,
                          //showConfirmButton: false,
                          //timer: 2000
                        });
          }
        } else {
          console.error('Erro na requisição:', jsonResponse.message);
            Swal.fire({
                        icon: 'error',
                        title: 'Ocorreu um erro:',
                        html: jsonResponse.message,
                        //showConfirmButton: false,
                        //timer: 2000
                      });
          }
      } else {
        var err = await response.text()
        console.error('Erro na resposta do servidor:', err);
          Swal.fire({
                      icon: 'error',
                      title: 'Ocorreu um erro:',
                      html: err,
                      //showConfirmButton: false,
                      //timer: 2000
                    });
        }
    } catch (error) {
      Swal.close();
      console.error('Erro ao enviar a requisição:', error);
        Swal.fire({
                    icon: 'error',
                    title: 'Ocorreu um erro:',
                    html: error,
                    //showConfirmButton: false,
                    //timer: 2000
                  });
    }
  });

}


/* EVENTO DE CLICK E ARRASTA*/
let isMouseDown = false;

function handleMouseDown(event) {
  const clickedRow = event.target.closest('tr');

  if (clickedRow && clickedRow.parentNode === userTable) {
    isMouseDown = true;
  }
}

function handleMouseMove(event) {
  if (isMouseDown) {
    const clickedRow = event.target.closest('tr');
    if (clickedRow && clickedRow.parentNode === userTable) {
      const checkboxes = document.querySelectorAll('input[type="checkbox"]');
      checkboxes.forEach((checkbox) => {
        const row = checkbox.closest('tr');
        if (row === clickedRow) {
          checkbox.checked = !checkbox.checked;
          if (checkbox.checked) {
            row.classList.add('table-danger');
          } else {
            row.classList.remove('table-danger');
          }
        }
      });
    }
  }
}

function handleMouseUp() {
  isMouseDown = false;
}

userTable.addEventListener('mousedown', handleMouseDown);
userTable.addEventListener('mousemove', handleMouseMove);
document.addEventListener('mouseup', handleMouseUp);

  </script>
<!-- </body>
</html> -->

		
</div>