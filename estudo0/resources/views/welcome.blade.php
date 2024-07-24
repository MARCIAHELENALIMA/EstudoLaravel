<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Titillium+Web:wght@400;600;700&display=swap');

        body {
            font-family: 'Titillium Web', sans-serif;
        }

        #counter {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
    @livewireStyles
</head>

<body>
    @livewire('counter') {{-- chamando o componente --}}

    <livewire:scripts />

</body>

</html>
