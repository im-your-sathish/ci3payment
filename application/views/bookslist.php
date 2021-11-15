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
    <style>
        /* input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        } */
    </style>
</head>

<body class="container">
    <a href="<?= base_url() ?>user/logout">Logout</a>
    <a href="<?= base_url() ?>user/orders"><button class="btn btn-success float-right">Orders</button></a>

    <?php

    $result = $this->db->where("uid", $this->session->id)->get("cart");

    ?>


    <!-- Button to Open the Modal -->
    <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
        Cart (<?= $result->num_rows() ?>)
    </button>


    <div class="modal" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">



                <div class="modal-header">
                    <h4 class="modal-title"><a href="<?= base_url() ?>user/cart">Cart list</a></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>


                <div class="modal-body">


                    <?php

                    $total = [];
                    echo '<table class="table">';
                    echo '<tr><th>Book</th><th>Price</th><th>Quantity</th><th>Total</th><th>Remove</th></tr>';

                    foreach ($result->result() as $p) {

                        $r = $this->db->where("id", $p->pid)->get("books")->row();
                        echo "<tr>
                                <td>" . $r->bname . " </td>
                                <td>" . $r->bprice . "</td>
                                <td>" . $p->quantity . "</td>
                                <td>" . $r->bprice * $p->quantity . "</td>
                                <td><a href='" . base_url() . "user/deletefromcart/" . $p->cid . "'>X</a></td>
                                </tr>";

                        $total[] = $r->bprice * $p->quantity;
                    }

                    echo '</table>';

                    $grandtotal = array_sum($total);

                    echo "<hr><h4>Grand Total :  Rs. " . $grandtotal . " /-</h4>";

                    ?>



                </div>



            </div>
        </div>
    </div>




    <h1><?= $_SESSION["abc"] ?> Book list </h1>

    <table class="table">
        <tr>
            <td>Id</td>
            <td>Name</td>
            <td>Author</td>
            <td>Price</td>
            <td>Quantity</td>
            <td>action</td>

        </tr>

        <?php foreach ($books as $b) { ?>

            <tr>
                <td><?= $b->id ?></td>
                <td><?= $b->bname ?></td>
                <td><?= $b->bauthor ?></td>
                <td><?= $b->bprice ?></td>
                <form action="<?= base_url() ?>user/addtocart" id="myForm">
                    <td>

                        <input type="number" id='<?= $b->id ?>' name="quantity" value="1" min=1 max=100>
                        <input type="hidden" name="pid" value="<?= $b->id ?>">
                    </td>
                    <td><input type="submit" class="btn btn-success" value="Add to cart"></td>
                </form>

            </tr>

        <?php } ?>

    </table>



    <script>


    </script>
</body>

</html>