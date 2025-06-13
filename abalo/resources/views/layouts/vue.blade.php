<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <meta charset = "UTF-8">
    <meta id ="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <title>ABALOOOO</title>


</head>

<body class ="modal-active">

    <div id="app">
        <float-menu :buttons="buttons" position="right">
            <template #toggle>

            </template>
        </float-menu>
    </div>
</body>
</html>
