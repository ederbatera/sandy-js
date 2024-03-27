
// ENVIO DO FORM DE ADICIONAR USUÁRIO
$('#form-add-usuario').on("submit", function (e) { 
    e.preventDefault();
    $.post("../assets/_cria_usuario.php", $("#form-add-usuario").serialize())
        .done(function (data) {
            var retorno = JSON.parse(data);
            if (retorno.icon == "success") {
                $('#modalCriaUsuario').modal('hide');
                $('#nome_add_usuario').val('');
                $('#sobrenome_add_usuario').val('');
                $('#cargo_add_usuario').val('');
                $('#matricula_add_usuario').val('');
                $('#email_add_usuario').val('');
                $('#senha_add_usuario').val('');
                $('#modalCriaUsuario').modal('hide');
                getUsuarios();
            }
            Swal.fire({
                icon: retorno.icon,
                title: retorno.title,
                html: retorno.html,
                showConfirmButton: true,
                //timer: 1500
            });

        });

})


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
          $('#modalChangePerfil').modal('hide');
          getUsuarios();
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
      })  
  }