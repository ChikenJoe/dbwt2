@extends('layouts.abalo')

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <div id ="app">
        @{{msg}}
    </div>
</body>
<script>
    const app = createApp({
        data(){
            return{
                msg: "Hello!"
            }
        }
    }).mount('#app');
</script>
</html>
