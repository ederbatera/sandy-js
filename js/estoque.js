
let __SALDO


const getEstoque = async (limit = false) => {
  let url = "../assets/_get_estoque.php"
  let estoque = false
  if(limit){
    url = url+'?limit='+limit
  }

  try {
    const response = await fetch(url);
    estoque = await response.json()
    __SALDO = estoque[0].quantidade
    sessionStorage.setItem("@Sandy:estoque", JSON.stringify(__SALDO));
    $('#estoqueAll').html(estoque[0].quantidade)
  } catch (error) {
    console.error('Erro ao buscar dados:', error);
  }

  return estoque

}

(async function () {
  await getEstoque();
})().then(function () {
})