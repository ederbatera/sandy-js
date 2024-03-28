// VARIAVEIS GLOBAIS
let __FORNECEDORES = [],
    __FUNCIONARIOS = [],
    __ESTOQUES = [],
    __ESTOQUE,
    __SALDO

// FORMATA DATA E HORA
const dataBR = (data) => {
    let data_br = moment.tz(data, "America/Sao_Paulo")
    return data_br.format('DD/MM/YYYY HH:mm:ss')
  }