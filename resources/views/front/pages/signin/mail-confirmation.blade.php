

<!DOCTYPE html>
<html>
<head>
    <title>Send email</title>
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
    <style type="text/css">
        .body {
            margin: 0;
        }

        .email-page {
            display: -webkit-box;display: -ms-flexbox;display: flex;
            -webkit-box-pack: center;-ms-flex-pack: center;justify-content: center;
            -webkit-box-align: center;-ms-flex-align: center;align-items: center;
            -ms-flex-wrap: wrap;flex-wrap: wrap;
            max-width: 500px;
            margin: 40px   auto;
            background: #ffffff;
            padding: 0;
        }

        .email-page * {
            font-family: Roboto;
            box-sizing: border-box;
        }

        .page-header {
            width: 100%;
            margin: 0 5px;
        }

        .page-content {
            width: 100%;
            margin: 0 15px;
        }

        .email-page p {
            margin: 0;
        }

        .mail-title {
            width: 100%;
            max-width: 100%;
            padding: 20px;
            background: #23abdf;
            margin-bottom: 30px;
        }

        .mail-title p {
            width: 100%;
            text-align: center;
            color: #ffffff;
            font-size: 18px;
        }

        .mail-title p:not(:last-child) {
            margin-bottom: 8px;
        }

        .introduction-text p.hello {
            margin-bottom: 25px;
        }

        .introduction-text p {
            color: #818181;
            font-size: 15px;
            margin-bottom: 40px;
            line-height: 1.3;
        }


        .mail-footer p {
            color: #787878;
            font-size: 15px;
            margin-bottom: 15px;
        }

    </style>
</head>
<body class="body">
    <div class="email-page">
        
        <div class="page-content">
            <div class="introduction-text">
                <p class="hello">Bonjour {{$content['name']}},<p>
                <p>Nous vous remercions d'avoir utilisé notre service. Pour bien continuer veuillez clicker le lien suivant pour confirmer votre inscription <strong><a href="{{$content['url_confirm']}}">Confirmez votre inscription</a></strong>&nbsp;</p>
            </div>

            <div class="mail-footer">
                <p>L'équipe Ariane Espace</p>
            </div>
        </div>
    </div>
</body>
</html>
