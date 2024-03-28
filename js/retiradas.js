


const getEntregas = async (limit = false) => {
    let url = "../assets/_get_retiradas.php"
    let entregas = false
    if(limit){
      url = url+'?limit='+limit
    }
  
    try {
      const response = await fetch(url); // RETORNA ARRAY
      entregas = await response.json()
      populateTableEntregas(entregas)
    } catch (error) {
      console.error('Erro ao buscar dados:', error);
    }
  
    return entregas
  
  }
    
  // POPULAÇÃO DA TABELA
  const tableBodyEntregas = document.getElementById('tbody-list-entregas');
  
  function populateTableEntregas(entregas) {
    tableBodyEntregas.innerHTML = '';
  
    entregas.forEach(item => {
      const row = document.createElement('tr');
      
      const dataRetiradaCell = document.createElement('td');
      dataRetiradaCell.textContent = dataBR(item.data_retirada);
      row.appendChild(dataRetiradaCell);
      
      const matriculaCell = document.createElement('td');
      matriculaCell.textContent = item.matricula;
      row.appendChild(matriculaCell);

      const funcionarioCell = document.createElement('td');
      funcionarioCell.textContent = item.funcionario;
      row.appendChild(funcionarioCell);
      
      const usuarioCell = document.createElement('td');
      usuarioCell.textContent = item.usuario;
      row.appendChild(usuarioCell);
            
      const fornecedorCell = document.createElement('td');
      fornecedorCell.textContent = item.fornecedor;
      row.appendChild(fornecedorCell);
      
      const estoqueCell = document.createElement('td');
      estoqueCell.textContent = item.estoque;
      row.appendChild(estoqueCell);
      
  
      row.classList.add('fw-semibold', 'lh-1')
      tableBodyEntregas.appendChild(row);
    });
  }