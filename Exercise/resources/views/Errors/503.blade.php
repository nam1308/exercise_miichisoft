<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Errors</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        html, body{ height: 100%; width: 100%; margin: 0; padding: 0; box-sizing: border-box; }
        .checkMaintain{ width: 100%; height: 100%; display: flex; justify-content: center; align-items: center;}
    </style>
</head>
<body class="error">
    <div class="checkMaintain">
        <h1>Hệ thống đang bảo trì. Vui lòng quay lại sau</h1>
    </div>
</body>
</html>
