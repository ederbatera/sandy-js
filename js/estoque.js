const tableBodyEstoque = document.getElementById('tbody-list-funcionarios');
const searchInputEstoque = document.getElementById('search-input-funcionarios');
const pagination = document.getElementById('pagination-table-funcionarios');
const itemsPerPage = 20;
let currentPage = 1;
var __FUNCIONARIOS = [];

async function fetchData() {
  try {
    const response = await fetch('../../assets/_get_estoque.php');
    __FUNCIONARIOS = await response.json();
    //sessionStorage.setItem("__FUNCIONARIOS", JSON.stringify(__FUNCIONARIOS) );
    populateTable(getCurrentPageData());
    renderPagination();
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }
}



function populateTable(__FUNCIONARIOS) {
  tableBodyEstoque.innerHTML = '';

  __FUNCIONARIOS.forEach(item => {


    var saldo = item.saldo > 0 ? '<a href="#" class="text-decoration-none fw-bold" onclick="removeSaldo(\'' + item.id + '\',\'' + item.nome + '\')"><i class="fa-solid fa-box fa-bounce text-success" data-tooltip="Remover saldo"></i></a>' : '<a href="#" class="text-decoration-none fw-bold" onclick="adicionaSaldo(\'' + item.id + '\',\'' + item.nome + '\')"><i class="fa-solid fa-box text-danger" data-tooltip="Adicionar saldo"></i></a>';
    const row = document.createElement('tr');

    const nomeCell = document.createElement('td');
    //nomeCell.textContent = item.nome;
    const nomeFa = document.createElement('i');
    nomeFa.classList.add('text-primary', 'me-1', 'fa-regular', 'fa-id-card', 'fa-xl');
    item.cartao ? nomeCell.append(nomeFa, " ", item.nome) : nomeCell.append(item.nome)
    //nomeCell.appendChild(' '+item.nome);
    row.appendChild(nomeCell);

    const matriculaCell = document.createElement('td');
    matriculaCell.textContent = item.matricula;
    row.appendChild(matriculaCell);

    const vinculoCell = document.createElement('td');
    vinculoCell.textContent = item.vinculo;
    row.appendChild(vinculoCell);

    const lotacaoCell = document.createElement('td');
    lotacaoCell.textContent = item.lotacao;
    row.appendChild(lotacaoCell);

    const localCell = document.createElement('td');
    localCell.textContent = item.local_trabalho;
    row.appendChild(localCell);

    const cargoCell = document.createElement('td');
    cargoCell.textContent = item.cargo;
    row.appendChild(cargoCell);

    const folhaCell = document.createElement('td');
    folhaCell.textContent = item.folha;
    row.appendChild(folhaCell);

    const secretariaCell = document.createElement('td');
    secretariaCell.textContent = item.secretaria;
    row.appendChild(secretariaCell);

    const direitoCell = document.createElement('td');
    //direitoCell.textContent = item.direito;
    direitoCell.classList.add('text-center', 'fs-5');
    const direitoCellIcon = document.createElement('i')
    item.direito_cesta == 1 ? direitoCellIcon.classList.add('fa-regular', 'fa-circle-check', 'text-primary') : direitoCellIcon.classList.add('fa-regular', 'fa-circle-xmark', 'text-danger')
    direitoCell.appendChild(direitoCellIcon)
    row.appendChild(direitoCell);

    const opcaoCell = document.createElement('td');
    //opcaoCell.textContent = item.opcao;
    opcaoCell.classList.add('text-center', 'fs-5');
    const opcaoCellIcon = document.createElement('i')
    item.opcao_cesta == 1 ? opcaoCellIcon.classList.add('fa-regular', 'fa-circle-check', 'text-primary') : opcaoCellIcon.classList.add('fa-regular', 'fa-circle-xmark', 'text-danger')
    opcaoCell.appendChild(opcaoCellIcon)
    row.appendChild(opcaoCell);


    const saldoCell = document.createElement('td');
    //saldoCell.textContent = item.saldo;
    saldoCell.setAttribute('data-tooltip', 'Alterar saldo')
    saldoCell.classList.add('text-center', 'fs-5')
    const saldoCellButton = document.createElement('a')
    const saldoCellFa = document.createElement('i')
    item.saldo > 0 ? saldoCellFa.classList.add('fa-solid', 'fa-box', 'fa-bounce', 'text-success') : saldoCellFa.classList.add('fa-solid', 'fa-box', 'text-danger')
    saldoCellButton.appendChild(saldoCellFa)
    saldoCell.appendChild(saldoCellButton)
    saldoCellButton.addEventListener('click', () => {
      item.saldo > 0 ? removeSaldo(item.id, item.nome) : adicionaSaldo(item.id, item.nome)
    });
    saldoCell.classList.add('text-center', 'fs-5');
    row.appendChild(saldoCell);

    // ADICIONANDO OS BOTÕES
    const editButtonCell = document.createElement('td');
    editButtonCell.classList.add('text-center', 'fs-5')
    const editButton = document.createElement('a');
    const editButtonFa = document.createElement('i')
    //editButton.textContent = '<i class="fa-solid fa-arrow-up-right-from-square"></i>';    
    editButton.classList.add('text-decoration-none', 'hover-black');
    editButtonFa.classList.add('fa-solid', 'fa-arrow-up-right-from-square');

    editButton.addEventListener('click', () => {
      openModalViewFuncionario(item);
    });
    editButton.appendChild(editButtonFa);
    editButtonCell.appendChild(editButton);
    row.appendChild(editButtonCell);


    row.classList.add('fw-semibold', 'lh-1')
    tableBodyEstoque.appendChild(row);
  });
}





function filterData() {
  const searchTerm = searchInputEstoque.value.toLowerCase();
  const filteredData = __FUNCIONARIOS.filter(item => {
    //return Object.values(item).some(value => {
    return Object.entries(item).some(([key, value]) => {
      // Verifica se a chave é "cartao" ou "celular" e a ignora
      if (key === 'cartao' || key === 'celular' || key === 'id' || key === 'email') {
        return false;
      }
      if (typeof value === 'string') {
        return value.toLowerCase().includes(searchTerm);
      } else if (typeof value === 'number') {
        return value.toString().includes(searchTerm);
      }
      return false;
    });
  });





  // Atualiza a paginação considerando os dados filtrados
  renderPagination(filteredData.length);

  // Mantém a página atual se estiver dentro dos limites
  const totalPages = Math.ceil(filteredData.length / itemsPerPage);
  if (currentPage > totalPages) {
    currentPage = totalPages;
  }

  populateTable(getCurrentPageData(filteredData));
}





function getCurrentPageData(filteredData) {
  const dataToUse = filteredData || __FUNCIONARIOS;
  const startIndex = (currentPage - 1) * itemsPerPage;
  const endIndex = startIndex + itemsPerPage;
  return dataToUse.slice(startIndex, endIndex);
}




function renderPagination(totalItems) {
  const totalPages = Math.ceil((totalItems || __FUNCIONARIOS.length) / itemsPerPage);
  pagination.innerHTML = '';
  // const collun = document.createElement('div');
  // collun.classList.add('col-1');





  const firstCol = document.createElement('div');
  firstCol.classList.add('col-auto');
  const first = document.createElement('button');
  first.textContent = 'Primeira';
  first.addEventListener('click', () => {
    currentPage = 1;
    filterData();
  });
  //first.classList.add('btn', 'btn-sm', 'btn-primary');
  first.classList.add('custom-btn', 'btn-2')
  firstCol.appendChild(first);
  pagination.appendChild(firstCol);





  const previousCol = document.createElement('div');
  previousCol.classList.add('col-auto');
  const previous = document.createElement('button');
  previous.textContent = '< Anterior';
  previous.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      filterData();
    }
  });
  //previous.classList.add('btn', 'btn-sm', 'btn-primary');
  previous.classList.add('custom-btn', 'btn-2')
  previousCol.appendChild(previous);
  pagination.appendChild(previousCol);


  const nextCol = document.createElement('div');
  nextCol.classList.add('col-auto');
  const next = document.createElement('button');
  next.textContent = 'Próxima >';
  next.addEventListener('click', () => {
    if (currentPage < totalPages) {
      currentPage++;
      filterData();
    }
  });
  //next.classList.add('btn', 'btn-sm', 'btn-primary');
  next.classList.add('custom-btn', 'btn-2')
  nextCol.appendChild(next)
  pagination.appendChild(nextCol);





  const lastCol = document.createElement('div');
  lastCol.classList.add('col-auto');
  const last = document.createElement('button');
  last.textContent = 'Última';
  last.addEventListener('click', () => {
    currentPage = totalPages;
    filterData();
  });
  //last.classList.add('btn', 'btn-sm', 'btn-primary');
  last.classList.add('custom-btn', 'btn-2')
  lastCol.appendChild(last)
  pagination.appendChild(lastCol);

  const info = `Listando ${itemsPerPage * (currentPage - 1) + 1} à ${Math.min(itemsPerPage * currentPage, totalItems || __FUNCIONARIOS.length)} de ${totalItems || __FUNCIONARIOS.length} resultados`;
  $('#paginationInfo').html(info)

}

searchInputEstoque.addEventListener('input', filterData);

fetchData();

