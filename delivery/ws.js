var socket = io('https://ws.agudos.digital', {transports: ['polling']});


socket.on("connect", () => {
  localStorage.setItem("@Sandy:socket_id", socket.id);
  console.log('Socket ID: '+ socket.id)
});

socket.on("disconnect", () => {
  if(localStorage.getItem("@Sandy:socket_id")) {
    localStorage.removeItem("@Sandy:socket_id");
  }    
  console.log('Socket Disconected')
}); 

// socket.on('update', function(payload){
//   $('#eventWS').html(payload.message);

// }); 

function sendMessage(user_id, funcionario, message) {
  socket.emit("update", {
    type: 'delivery', 
    message: message,
    log: {
        user: user_id,
        funcionario: funcionario.id,
        data: new Date()
    } 
} ); 
}