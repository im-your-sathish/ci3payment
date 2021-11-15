<!DOCTYPE HTML>
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

    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

</head>

<body>
    <div class="container">


        <div class="row">
            <div class="col-md-8">



                <h2>Cart</h2>
                <?php $result = $this->db->where("uid", $this->session->id)->get("cart")->result();
                $total = []; ?>
                <table class="table table-striped" border=1>
                    <thead>
                        <th>Book</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </thead>
                    <?php
                    foreach ($result as $p) {
                        $r = $this->db->where("id", $p->pid)->get("books")->row();
                    ?>

                        <tr>
                            <td><?= $r->bname ?></td>
                            <td><?= $r->bprice ?></td>
                            <td>
                                <a href="<?= base_url() ?>user/qdec/<?= $p->cid ?>"> <button>-</button></a>
                                <?= $p->quantity ?>
                                <a href="<?= base_url() ?>user/qinc/<?= $p->cid ?>"> <button>+</button> </a>
                            </td>
                            <td><?= $r->bprice * $p->quantity ?></td>
                            <td><a href='<?= base_url() ?>user/deletefromcart/<?= $p->cid ?>'>X</a></td>
                        </tr>

                    <?php
                        $total[] = $r->bprice * $p->quantity;
                    }
                    $gt = array_sum($total)
                    ?>

                </table>

                <a href="<?= base_url() ?>user/books"><button class="btn btn-primary">Continue shopping</button></a>

                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal">
                    Place order
                </button>

                <div class="modal" id="myModal">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <div class="modal-body ">
                                <input type="hidden" name="gt" value="<?= $gt ?>">
                                Address:<br><textarea id="address" name="address" required>Kothapeta, Hyderabad</textarea><br><br>
                                Payment Method <select name="payment_method" id="payment_method">
                                    <option value="COD">COD</option>
                                    <option value="paynow">Pay Now</option>
                                </select><br><br>

                            </div>

                            <div class="modal-footer">
                                <button id="rzp-button1" class="btn btn-success btn-sm" onclick="pay()">Pay</button>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <div class="col-md-4 ">
                <h1>Total</h1>
                <table class="table" border=1>
                    <tr>
                        <td>Grand Total :</td>
                        <td> Rs. <?php echo $gt; ?> /-</td>
                    </tr>
                </table>


            </div>
        </div>


    </div>



    <script>
        function pay() {
            var payment_method = $("#payment_method").val();
            var address = $("#address").val();
            var total = <?= $gt ?>;

            if (payment_method == "paynow") {

                var options = {
                    "key": "rzp_test_frHvUqxl3X5Xtl",
                    "amount": <?= $gt * 100 ?>,
                    "currency": "INR",
                    "name": "Sathish Pvt Ltd",
                    "description": "Test Transaction",
                    "image": "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSQKIWGYkkVMGCMAnaLUhneUqVGdgaft01ypRt9iXq-b4lhCxxAa9bUTDjTtoGMY5lReFU&usqp=CAU",

                    "handler": function(response) {
                        console.log(response);
                        // alert(response.razorpay_payment_id); // alert(response.razorpay_order_id);  // alert(response.razorpay_signature);
                        window.location.href = "<?= base_url() ?>user/placeorder?pmid=" + response.razorpay_payment_id + "&address=" + address + "&total=" + total;
                    }
                };
                var rzp1 = new Razorpay(options);
                rzp1.open();
            } else {
                window.location.href = "<?= base_url() ?>user/placeorder?address=" + address + "&total=" + total;

            }
        }
    </script>
</body>

</html>