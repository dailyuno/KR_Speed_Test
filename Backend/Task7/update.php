<?php require_once 'db.php'; ?>
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
        if (isset($_POST['id'])) {
            execute('UPDATE todo_list SET title = ? WHERE id = ?', array($_POST['title'], $_POST['id']));
            header('Location: index.php');
            exit;
        }
    ?>

    <?php if (isset($_GET['id'])){?>
        <?php $item = fetch('SELECT * FROM todo_list WHERE id = ?', array($_GET['id'])); ?>
        <div class="container">
            <h2 class="mt-5">Update Todo</h2>
            <form action="update.php" method="POST">
                <div class="form-group">
                    <input type="hidden" name="id" value="<?php echo $item->id; ?>">
                    <input type="text" name="title" class="form-control" placeholder="todo" value="<?php echo $item->title; ?>">
                </div>
                <div class="text-right mt-4">
                    <button class="btn btn-primary" type="submit">Update</button>
                </div>
            </form>
        </div>
    <?php }?>

</body>
</html>