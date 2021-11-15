<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <a href="<?= base_url() ?>user/books">Go Back</a>
        <?php
        $orders  = $this->db->where("uid", $this->session->id)->get("orders")->result();
        ?>
        <table class="table table-striped">
            <thead>
                <td>Orderid</td>
                <td>Total</td>
                <td>Address</td>
                <td>Payment ID</td>
                <td>Payment Method</td>
                <td>Payment status</td>
                <td>Order status</td>
                <td>Action</td>
                <td></td>
            </thead>
            <?php foreach ($orders as $o) : ?>
                <tr>
                    <td><a href="<?= base_url() ?>/user/orderdetails/<?= $o->orderid ?>"><?= $o->orderid ?></a></td>
                    <td>Rs. <?= $o->total ?> /-</td>
                    <td><?= $o->address ?></td>
                    <td><?= $o->payment_id ?></td>
                    <td><?= $o->payment_method ?></td>
                    <td><?= $o->payment_status ?></td>
                    <td><?= $o->status ?></td>
                    <td><a href="">Cancel </a></td>
                </tr>

            <?php endforeach ?>
        </table>

    </div>

</body>

</html>