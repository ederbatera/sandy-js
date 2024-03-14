// PEGA O SALDO
let __SALDO


async function _getSaldo() {
    let url = "../assets/_get_estoque.php"
    try {
      const response = await fetch(url);
      let saldo = await response.json()
      __SALDO = saldo[0]
      sessionStorage.setItem("__SALDO", JSON.stringify(__SALDO) );
    } catch (error) {
      console.error('Erro ao buscar dados:', error);
    }
  }





  (async function() {
	await _getSaldo();
})().then(function() {
  console.log(__SALDO)
})