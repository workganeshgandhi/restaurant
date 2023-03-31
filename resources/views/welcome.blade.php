<!DOCTYPE html>

<html>

<head>

    <title>Laravel WebSocket Example</title>

</head>

<body>
    <div id="app">

        <div id="div-data"></div>

    </div>
    <script src='./js/app.js'></script>

    <script>
        window.Echo.channel('EventOrder')
            .listen('OrderEvent', (e) => {
                console.log(e)
                document.querySelector('#div-data').innerHTML = e.message
            })
    </script>

</body>


</html>
