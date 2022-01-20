<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('title')</title>
        <link rel="stylesheet" type="text/css" href="/public/assets/css/stylesheet.css">
    </head>
    <body>
        <a href="index.php?newgamebutton">New Game</a> {{-- launch the script via GET message --}}
        <h1>Minesweeper</h1>
        @yield('content')
        <h3 id="message"></h3> {{-- Used to show the message at the end of the game --}}
        <audio id="myaudio" data-winaudiopath="{{PATH_WIN_AUDIO}}" data-loseaudiopath="{{PATH_LOSE_AUDIO}}" autoplay></audio>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
        <script src="/public/assets/js/minesweeper.js"></script>
    </body>
</html>


