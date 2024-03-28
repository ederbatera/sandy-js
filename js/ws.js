var socket = io('https://ws.agudos.digital', { transports: ['polling'] });

socket.on('timestamp', function (payload) {
  $('#timestamp').html('<span class="badge bg-success text-white fw-bold ml-2">' + dataBR(payload) + '</span>');
});


socket.on('update', function (payload) {

  $('#eventWS').html(`<marquee>${payload.message}</marquee>`);

  switch (payload.type) {
    case 'delivery':
      getEstoque()
      getEntregas()
      fetchData()
      break;
    case 'saldo':
      getEstoque()
      fetchData()
      break;

    default:
      break;
  }
});

socket.on('connections-count', function (payload) {
  $('#usersWS').html(payload);
});

socket.on("connect", () => {
  localStorage.setItem("socket_id", socket.id);
  console.log('Socket ID: ' + socket.id)
  $('#server-status').html('<i class="fa-solid fa-rotate-right fa-spin fa-xl text-success"></i>');
  // socket.emit("update", {
  //   type: 'connect',
  //   message: `${user_name} logou no sistema.`,
  //   log: {
  //     user: user_id,
  //     funcionario: null,
  //     data: new Date()
  //   }
  // });
});

socket.on("disconnect", () => {
  if (localStorage.getItem("socket_id")) {
    localStorage.removeItem("socket_id");
  }
  console.log('Socket Disconected')
  $('#timestamp').html('<span class="badge bg-danger text-white fw-bold fs-6 ml-3">WebSocket onclose</span>');
  $('#server-status').html('<i class="fa-solid fa-beat-fade fa-xl" style="color: #ea0000;"></i>');
});