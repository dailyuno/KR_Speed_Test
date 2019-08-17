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

    <div class="container">
        <h2 class="mt-5">Create Todo</h2>
        <form action="create.php" method="POST">
            <div class="form-group">
                <input type="text" name="title" class="form-control" placeholder="todo">
            </div>
            <div class="text-right mt-4">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>

        <h2 class="mt-5">Todo List</h2>
        <div class="card-deck mt-3">
            <?php $list = fetchAll('SELECT * FROM todo_list ORDER BY id DESC'); ?>
            <?php foreach ($list as $rs){?>
                <div class="col-lg-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0"><?php echo $rs->title; ?></h4>
                        </div>
                        <div class="card-body">
                            <a href="remove.php?id=<?php echo $rs->id; ?>" class="btn btn-danger">Remove</a>
                            <a href="update.php?id=<?php echo $rs->id; ?>" class="btn btn-success">Update</a>
                        </div>
                    </div>
                </div>
            <?php }?>
        </div>
    </div>

</body>
</html>