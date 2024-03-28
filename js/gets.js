

const getUsuarios = () => {

  $.post("../assets/_get_usuarios.php")
    .done(function (usuarios) {

      $('#listUsuarios').html('')

      let textInativo, permissao

      for (var i = 0; i < usuarios.length; i++) {
        if (usuarios[i]['status'] == 'A') {
          textInativo = '';
        }
        else {
          button = "Inativo";
          textInativo = '<span class="badge bg-warning text-dark p-1 mx-2">Inativo</span>';
          checked = '';
        }

        switch (usuarios[i].permissao) {
          case 1:
            permissao = 'Entregador';
            break;
          case 2:
            permissao = 'Administrador';
            break;
          case 3:
            permissao = 'Super Administrador';
            break;

          default:
            permissao = 'Indefinido'
            break;
        }

        // const img_perfil = '/img/perfil/null' + usuarios[i].id + '.jpg'
        const img_perfil = '/img/perfil/null.jpg'
        $('#listUsuarios').append(
          '<tr class="text-dark font-weight-light fs-6">' +
          '<td><span class="rounded"> <image style="width: 40px; height: 40px; border-radius: 25px; z-index: 20;" src="' + img_perfil + '" onclick="viewImage(this.src)"></span></td>' +
          '<td> <span class="fw-bold">' + usuarios[i].nome + '</span> <span class="badge bg-primary p-1">' + permissao + '</span> ' + textInativo + '</td>' +
          '<td> ' + usuarios[i].email + '</td>' +
          '<td> ' + usuarios[i].data_cadastro + '</td>' +
          '<td></td>' +
          '<td> <button class="btn btn-sm btn-success" type="button" data-bs-toggle="modal" data-bs-target="#modalChangePerfil" onclick="getUsuario(' + usuarios[i].id + ')"><i class="fa fa-pencil-alt"></i></button> </td>' +
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
      funcionario.status == 'A' ? $('#ativo_altera_usuario').prop("checked", true) : $('#ativo_altera_usuario').prop("checked", false);
    })
}


