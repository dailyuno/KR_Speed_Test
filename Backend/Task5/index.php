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
    </style>
</head>
<body>

    <?php
        $jsonData = json_decode(file_get_contents('data.json'));
        $total = count($jsonData);
        $block = 5;
        $lastPage = ceil($total / $block);

        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $sPage = $page - 2;
        $ePage = $page + 2;

        if ($sPage < 1) {
            $sPage = 1;
            $ePage = $block;
        }

        if ($ePage > $lastPage) {
            $ePage = $lastPage;
            $sPage = $ePage - $block;
        }

        $sItem = ($page - 1) * $block;
        $eItem = $sItem + 5;

        $fields = $jsonData[0];
        $items = [];
        for ($i = $sItem; $i < $eItem; $i++) {
            $items[] = $jsonData[$i];
        }

        $prevPage = $page - $block;
        $nextPage = $page + $block;

        if ($prevPage < 1) $prevPage = 1;
        if ($nextPage > $lastPage) $nextPage = $lastPage;
    ?>

    <div class="wrap">
        <table class="table">
            <thead>
                <tr>
                    <?php foreach ($fields as $key => $data){?>
                        <th><?php echo $key; ?></th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($items as $item){?>
                    <tr>
                        <?php foreach ($item as $field){?>
                            <td><?php echo $field; ?></td>
                        <?php }?>
                    </tr>
                <?php }?>
            </tbody>
        </table>

        <ul class="pagination">
            <li class="page-item">
                <a href="?page=<?php echo $prevPage; ?>" class="page-link">&lt;</a>
            </li>
            <?php for ($i = $sPage; $i <= $ePage; $i++){?>
                <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                    <a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                </li>
            <?php }?>
            <li class="page-item">
                <a href="?page=<?php echo $nextPage; ?>" class="page-link">&gt;</a>
            </li>
        </ul>
    </div>

</body>
</html>