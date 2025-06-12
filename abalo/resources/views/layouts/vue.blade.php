<!DOCTYPE html>
<html>
<head>
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
    <meta charset = "UTF-8">
    <meta id ="csrf-token" name="csrf-token" content="{{ csrf_token() }}">
    <title>ABALOOOO</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class ="modal-active">

    <div id="app">
        <float-menu :buttons="buttons" position="right">
            <template #toggle>
                <i class="fas fa-plus"></i>
            </template>
        </float-menu>
    </div>
</body>
</html>
