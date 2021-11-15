<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <form action="<?=base_url()?>user/update" method="post">
         <input type="hidden" name="id" value="<?=$user->id?>"><br><br>
        Name: <input type="text" name="name" value="<?=$user->name?>"><br><br>
        Email: <input type="email" name="email" value="<?=$user->email?>"><br><br>
        Password: <input type="text" name="password" value="<?=$user->password?>"><br><br>
        <input type="submit" class="btn btn-success" name="update" value="update"><br><br>
    </form>


</body>

</html>