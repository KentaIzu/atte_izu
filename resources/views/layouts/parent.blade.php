<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atte</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        flex-direction: column;
    }

    .header {
        height: 50px;
    }

    nav {
        display: flex;
        padding: 0 3%;
        z-index: 1;
    }

    .logo h1 {
        margin: 0px;
        padding: 10px 0;
    }

    .header ul {
        width: 100%;
        display: flex;
        justify-content: flex-end;
        list-style: none;
        align-items: center;
        margin: 17px 0 10px 0;
    }

    .header li {
        padding-left: 3%;
    }

    .header li a {
        text-decoration: none;
        color: black;
        font-weight: bold;
        font-size: 14px;
    }

    .footer {
        background-color: white;
        width: 100%;
        height: 40px;
        padding: 15px 0 20px 0;
        text-align: center;
        z-index: 1;
        position: absolute;
        bottom: 0;
    }

    @media screen and (max-width: 480px) {
        .header {
            width: 100%;
        }

        .logo h1 {
            margin: 0px;
            padding: 13px 0 10px 0;
            font-size: 18px;
        }

        .header ul {
            width: 90%;
            display: flex;
            list-style: none;
            align-items: center;
            margin: 17px 0 0 0;
        }

        .header li {
            padding-left: 3%;
        }

        .header li a {
            text-decoration: none;
            color: black;
            font-weight: bold;
            font-size: 5px;
        }

        nav {
            display: flex;
            z-index: 1;
        }

        .footer {
            background-color: white;
            text-align: center;
            z-index: 1;
            position: absolute;
            bottom: 0;
            padding: 10px 0 30px 0;
        }
    }

</style>

<body>

    <div class="header">
        @yield('header')
    </div>
    <div class="content">
        @yield('content')
    </div>
    <div class="footer">
        <small>@yield('footer')</small>
    </div>
</body>

</html>
