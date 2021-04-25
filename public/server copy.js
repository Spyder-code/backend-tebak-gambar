const express = require('express');

const app = express();
const server = require('http').createServer(app);
const io = require('socket.io')(server, {
    cors:{origin:"*"}
});

io.on('connection',(socket)=>{
    console.log('connection');

    socket.on('update',(message)=>{
        console.log(message);
        io.sockets.emit('update',message);
    });

    socket.on('disconnect',(socket)=>{
        console.log('disconnect');
    });
})

server.listen(3000,()=>{
    console.log('server is running');
})
