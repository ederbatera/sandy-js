
const getEstoque = async (limit = false) => {
  let url = "../assets/_get_estoque.php"
  let estoques = false
  if(limit){
    url = url+'?limit='+limit
  }

  try {
    const response = await fetch(url);
    estoques = await response.json()
    __ESTOQUE = estoques[0]
    __ESTOQUES = estoques
    __SALDO = estoques[0].quantidade
    populateTableEstoque(estoques)
    sessionStorage.setItem("@Sandy:estoque", JSON.stringify(__SALDO));
    $('#estoqueAll').html(estoques[0].quantidade)
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }

  return estoques

}

(async function () {
  await getEstoque();
})().then(function () {
}) 

// POPULAÇÃO DA TABELA
const tableBodyEstoque = document.getElementById('tbody-list-estoques');

function populateTableEstoque(estoques) {
  tableBodyEstoque.innerHTML = '';

  estoques.forEach(item => {
    const row = document.createElement('tr');

    const idCell = document.createElement('td');
    idCell.textContent = item.id;
    row.appendChild(idCell);
    
    const quantidadeCell = document.createElement('td');
    quantidadeCell.textContent = item.quantidade;
    row.appendChild(quantidadeCell);
    
    const fornecedorCell = document.createElement('td');
    fornecedorCell.textContent = item.fornecedor;
    row.appendChild(fornecedorCell);
    
    const usuarioCell = document.createElement('td');
    usuarioCell.textContent = item?.user_create? item.user_create : 'Desconhecido';
    row.appendChild(usuarioCell);
    
    const cadastroCell = document.createElement('td');
    cadastroCell.textContent = dataBR(item.data_cadastro);
    row.appendChild(cadastroCell);

    const dataAtualCell = document.createElement('td');
    dataAtualCell.textContent = dataBR(item.data_atualizacao);
    row.appendChild(dataAtualCell);

    row.classList.add('fw-semibold', 'lh-1')
    tableBodyEstoque.appendChild(row);
  });
}



$('#modalCriaEstoque').on('shown.bs.modal', function () {  
  (async ()=>{
    let selecFornecedor = ""
    if(__FORNECEDORES.length == 0){
      await getFornecedores()
    }

    if(__FORNECEDORES.length == 0){
      $('#modal_cria_estoque_alert').append('<div class="alert alert-danger">Não há Fornecedores cadastrados.<br>Cadastre um fornecedor antes de adicionar estoque!</div>')
    }else{
      $('#modal_cria_estoque_alert').html('')
    }
    
    __FORNECEDORES.map(fornecedor => {
      // let selected = razao == fornecedor.razao ? "selected" : "";
      // selecFornecedor += '<option value="' + fornecedor.id + '" ' + selected + '>' + fornecedor.razao + '</option>'
      selecFornecedor += '<option value="' + fornecedor.id + '">' + fornecedor.razao + '</option>'
      $("#fornecedor_add_estoque").html(selecFornecedor)
    })
  })()
})


// ENVIO DO FORM DE ADICIONAR ESTOQUE
$('#form-add-estoque').on("submit", function (e) {
  e.preventDefault()
  $.post("../assets/_cria_estoque.php", $("#form-add-estoque").serialize())
      .done(function (retorno) {
          if (retorno.icon == "success") {
              $('#modalCriaEstoque').modal('hide');
              $('#form-add-estoque')[0].reset();
              getEstoque();
          }
          Swal.fire({
              icon: retorno.icon,
              title: retorno.title,
              html: retorno.html,
              showConfirmButton: true,
              timer: 1500
          });

      })
})
