


const getFornecedores = async (limit = false) => {
  let url = "../assets/_get_fornecedores.php"
  let fornecedores = false
  if(limit){
    url = url+'?limit='+limit
  }

  try {
    const response = await fetch(url); // RETORNA ARRAY
    fornecedores = await response.json()
    populateTableFornecedores(fornecedores)
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }

  return fornecedores

}


// POPULAÇÃO DA TABELA
const tableBodyFornecedores = document.getElementById('tbody-list-fornecedores');

function populateTableFornecedores(fornecedores) {
  tableBodyFornecedores.innerHTML = '';

  fornecedores.forEach(item => {
    const row = document.createElement('tr');

    const codigoCell = document.createElement('td');
    codigoCell.textContent = item.codigo;
    row.appendChild(codigoCell);
    
    const razaoCell = document.createElement('td');
    razaoCell.textContent = item.razao;
    row.appendChild(razaoCell);
    
    const dataCadastroCell = document.createElement('td');
    dataCadastroCell.textContent = dataBR(item.data_cadastro);
    row.appendChild(dataCadastroCell);

    const estoquesCell = document.createElement('td');
    estoquesCell.textContent = item?.estoques? item.estoques : '?';
    row.appendChild(estoquesCell);

        // ADICIONANDO OS BOTÕES
        const editButtonCell = document.createElement('td');
        editButtonCell.classList.add('text-center', 'fs-5')
        const editButton = document.createElement('a');
        const editButtonFa = document.createElement('i')
        //editButton.textContent = '<i class="fa-solid fa-arrow-up-right-from-square"></i>';    
        editButton.classList.add('text-decoration-none', 'hover-black');
        // editButtonFa.classList.add('fa-solid', 'fa-arrow-up-right-from-square');
        editButtonFa.classList.add('fa-regular', 'fa-pen-to-square');
    
        editButton.addEventListener('click', () => {
          openModalViewFornecedor(item);
        });
        editButton.appendChild(editButtonFa);
        editButtonCell.appendChild(editButton);
        row.appendChild(editButtonCell);


    row.classList.add('fw-semibold', 'lh-1')
    tableBodyFornecedores.appendChild(row);
  });
}


const openModalViewFornecedor = () => {
    Swal.fire({
        icon: "info",
        html: 'Recurso em desenvolvimento',
      })
}