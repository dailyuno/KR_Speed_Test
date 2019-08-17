<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap.min.css">
    <style>
        * {
            font-family: Calibri;
        }
        
        .btn {
            font-size: 14px;
            -webkit-border-radius: 2px;
            -moz-border-radius: 2px;
            border-radius: 2px;
        }
    </style>
</head>
<body>

    <?php
        function getJSON($xml) {
            if ($xml == '') {
                return "{\n}";
            }

            $xml = simplexml_load_string($xml);
            $json = json_encode(json_decode("{\"{$xml->getName()}\": " . json_encode($xml) . "}"), JSON_PRETTY_PRINT);
            $json = preg_replace("/    /", "\t", $json);

            return "{$json}";
        }

        $xml = isset($_POST['xml']) ? $_POST['xml'] : '';
        $json = getJSON($xml);
    ?>

    <div class="container mt-5">
        <h4>XML2JSON Converter</h4>
        <form method="POST">
            <div class="row">
                <div class="col-lg-6">
                    <textarea name="xml" id="" cols="30" rows="10" class="form-control" style="min-height: 500px;"><?php echo $xml; ?></textarea>
                </div>
                <div class="col-lg-6">
                    <textarea name="json" id="" cols="30" rows="10" class="form-control" style="min-height: 500px;"><?php echo $json; ?></textarea>
                </div>
            </div>
            <button class="btn btn-primary mt-3">Convert</button>
        </form>
    </div>

</body>
</html>