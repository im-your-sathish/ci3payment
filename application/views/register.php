<center>

    <h1>Register page</h1>

    <form action="<?= base_url() ?>user/adduser" method="post" enctype="multipart/form-data">

        Name: <input type="text" name="name" id="name"><br><br>
        Email: <input type="email" name="email"><br><br>
        Password: <input type="text" name="password"><br><br>
        Profile pic <input type="file" name="pic"><br><br>
        <input type="submit" name="submit" value="Register"><br><br>

    </form>


    already have an account <a href="<?php echo base_url() ?>login">sign in</a>
</center>