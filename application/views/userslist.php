<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Userlist</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body class="container">






    <h1>Userslist</h1>

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Image</td>
            <td>Action</td>
        </tr>

        <?php foreach ($users as $user) { ?>

            <tr>
                <td><a href="<?= base_url() ?>user/fullview/<?= $user->id ?>"><?= $user->id ?></a></td>
                <td><?= $user->name ?></td>
                <td><?= $user->email ?></td>
                <td><?= $user->password ?></td>
                <td><a href="<?=base_url()?>/uploads/<?= $user->photo ?>"><img width="40" src="./uploads/<?= $user->photo ?>"></a></td>
                <td>
                    <a href="<?= base_url() ?>user/getbyid/<?= $user->id ?>">
                        <button class="btn btn-primary btn-sm">Edit</button>
                    </a>

                    <button onclick="hello(<?= $user->id ?>)" class="btn btn-danger btn-sm">Delete</button>

                </td>
            </tr>

        <?php } ?>

    </table>


    <script>

        function hello(id) {

            var c = confirm("Are you sure ?");

            if (c == true) {
                window.location.href = "<?= base_url() ?>user/delete?id=" + id;
            } else {
                alert('cancelled');
            }

        }

    </script>

</body>

</html>