  var socket = io('https://ws.agudos.digital', {transports: ['polling']});

  socket.on('timestamp', function(payload){
      let dt = moment.tz(payload, "America/Sao_Paulo")
      $('#timestamp').html('<span class="badge bg-success text-white fw-bold fs-6 ml-3">' + dt.format('DD/MM/YYYY HH:mm:ss') + '</span>');
  });


  socket.on('update', function(payload){
    payload = JSON.parse(payload)
    console.log(payload)
    $('#eventWS').html(payload.message);

  }); 

  socket.on('connections-count', function(payload){
    $('#usersWS').html(payload);
    //console.log('Clients count: '+payload) //usersWS
  });

  socket.on("connect", () => {
    localStorage.setItem("socket_id", socket.id);
    console.log('Socket ID: '+ socket.id)
    $('#server-status').html('<i class="fa-solid fa-rotate-right fa-spin fa-xl" style="color: #00ff00;"></i>');
  });
  
  socket.on("disconnect", () => {
    if(localStorage.getItem("socket_id")) {
      localStorage.removeItem("socket_id");
    }    
    console.log('Socket Disconected')
    $('#timestamp').html('<span class="badge bg-danger text-white fw-bold fs-6 ml-3">WebSocket onclose</span>');
    $('#server-status').html('<i class="fa-solid fa-beat-fade fa-xl" style="color: #ea0000;"></i>');
  });