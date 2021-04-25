<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <?php header('Access-Control-Allow-Origin: *'); ?>
        <title>Laravel</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
        <script src="https://cdn.socket.io/4.0.1/socket.io.min.js" integrity="sha384-LzhRnpGmQP+lOvWruF/lgkcqD+WDVt9fU3H4BWmwP5u5LTmkUGafMcpZKNObVMLU" crossorigin="anonymous"></script>
    </head>
    <body>
        <button id="btn">Klik me</button>
    </body>
    <script>
        $(function(){

            let ipAddress = '127.0.0.1';
            let socketPort = '300';
            const socket = io.connect('http://tebar.spydercode.my.id/serverTebar/');

            socket.on('connection');
            socket.on('update',(message)=>{
                console.log(message);
            });

            $('#btn').click(function (e) {
                e.preventDefault();
                socket.emit('update','hallo dunia');
            });

        })
    </script>
</html>
