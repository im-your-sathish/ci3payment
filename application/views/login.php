<center>

<h1>Login page</h1>


<?php

echo $this->session->flashdata('msg');
$this->session->set_flashdata('msg', '');

?>
    <form action="<?= base_url() ?>user/logincheck" method="post">
        Email: <input type="text" name="email"><br><br>
        Password: <input type="text" name="password"><br><br>
        <input type="submit" name="name">
    </form>

    Didn't have an account <a href="<?php echo base_url() ?>register">sign up</a>
</center>