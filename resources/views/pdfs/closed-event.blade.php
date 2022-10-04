<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $event->title }}</title>
    <style type="text/css">
        @font-face {
            font-family: 'Inter';
            src: url('/fonts/Inter.ttf') format('truetype');
            font-weight: 400;
            font-style: normal;
        }

        body {
            font-family: "Inter";
        }
    </style>
</head>

<body>
    <h1>{{ config('app.name') }}</h1>
</body>

</html>
