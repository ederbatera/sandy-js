// PEGA O SALDO
let __SALDO


async function _getSaldo() {
    let url = "../assets/_get_estoque.php"
    try {
      const response = await fetch(url);
      let saldo = await response.json()
      __SALDO = saldo[0]
      sessionStorage.setItem("__SALDO", JSON.stringify(__SALDO) );
      $('#estoqueAll').html(__SALDO.quantidade)
    } catch (error) {
      console.error('Erro ao buscar dados:', error); 
    }
  }





  (async function() {
	await _getSaldo();
})().then(function() {
  //console.log(__SALDO)
})


const getUsuarios = () => {

  $.post("../assets/_get_usuarios.php")
    .done(function (usuarios) {
      
      $('#listUsuarios').html('')
      
      let textInativo

      for (var i = 0; i < usuarios.length; i++) {
        if (usuarios[i]['status'] == 'A') {
              textInativo = '';
        }
        else {
              button = "Inativo";
              textInativo = '<span class="badge bg-warning text-dark p-1 mx-2">Inativo</span>';
              checked = '';
        }

        // const img_perfil = '/img/perfil/null' + usuarios[i].id + '.jpg'
        const img_perfil = '/img/perfil/null.jpg'
        $('#listUsuarios').append(
          '<tr class="text-dark font-weight-light">' +
              '<td><span class="rounded"> <image style="width: 40px; height: 40px; border-radius: 25px; z-index: 20;" src="'+img_perfil+'" onclick="viewImage(this.src)"></span></td>' +
              '<td> ' + usuarios[i].nome + ' ' + textInativo + '</td>' +
              '<td> ' + usuarios[i].email + '</td>' +
              '<td>' +
              '</td>' +
              '<td> <button class="btn btn-sm btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalChangePerfil" onclick="getUsuario(' + usuarios[i].id + ')"><i class="fa fa-pencil-alt"></i> Editar </button> </td>'+
          '</tr>'
        )

      }
 
    })

}





const getUsuario = async (id) => {
  await $.post("../assets/_get_usuario.php", { "id": id })
    .done(function (json) {
      funcionario = JSON.parse(json)
      let checked
      
      $('#nome_altera_usuario').val(funcionario.nome)
      $('#id_altera_usuario').val(funcionario.id)
      $('#id_user_change_altera_usuario').val(id)
      $('#cargo_altera_usuario').val(funcionario.cargo)
      $('#matricula_altera_usuario').val(funcionario.matricula)
      $('#email_altera_usuario').val(funcionario.email)
      funcionario.status == 'A' ? $('#ativo_altera_usuario').prop( "checked", true ) : $('#ativo_altera_usuario').prop( "checked", false ) ;
    })
}


function alteraPerfil() {

  $.post("../assets/_altera_perfil.php", $("#form-alter-perfil").serialize())
    .done(function (retorno) {
      if (retorno.error.status == false) {
        Swal.fire({
          icon: "success",
          title: retorno.title,
          html: retorno.html,
          showConfirmButton: false,
          timer: 1500
        })

        $('#senha_altera_usuario').val('')
      } else {
        Swal.fire({
          icon: "error",
          title: retorno.title,
          html: retorno.html,
          showConfirmButton: false,
          timer: 1500
        });
        $('#senha_altera_usuario').val('');
      }
    });

}


function addNovoUsuario(){
    
  $.post( "../assets/_cria_usuario.php", $( "#form-add-usuario" ).serialize())
  .done(function( data ) {
      var retorno = JSON.parse(data);
      if(retorno.icon == "success"){
        $('#modalCriaUsuario').modal('hide');
        $('#nome_add_usuario').val('');
        $('#sobrenome_add_usuario').val('');
        $('#cargo_add_usuario').val('');
        $('#matricula_add_usuario').val('');
        $('#email_add_usuario').val('');
        $('#senha_add_usuario').val('');
      }
      Swal.fire({
          icon: retorno.icon,
          title: retorno.title,
          html: retorno.html,
          showConfirmButton: true,
          //timer: 1500
        });

  });

}
