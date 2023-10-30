<?php

    require_once "inc/header.php";
    require_once "app/classes/Cart.php";
    require_once "app/classes/Order.php";

    if (!$user->is_logged()) {
        header("location: login.php");
        exit();
    }

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $delivery_address = $_POST['country'] . ", " . $_POST['city'] . 
                                ", " . $_POST['zip'] . ", " . $_POST['address'];

        $order = new Order();
        $order = $order->create($delivery_address);
        
        $_SESSION['message']['type'] = "success";
            $_SESSION['message']['text'] = "Uspesno narucene majice!";
            header('location: orders.php');
            exit();
    }
?>

<form action="" method="post">
    <div class="form-group mb-3">
        <label for="country">Drzava</label>
        <input type="text" class="form-control" id="country" name="country" requierd>
    </div>
    <div class="form-group mb-3">
        <label for="city">Grad</label>
        <input type="text" class="form-control" id="city" name="city" requierd>
    </div>
    <div class="form-group mb-3">
        <label for="zip">Postanski broj</label>
        <input type="text" class="form-control" id="zip" name="zip" requierd>
    </div>
    <div class="form-group mb-3">
        <label for="address">Adresa</label>
        <input type="text" class="form-control" id="address" name="address" requierd>
    </div>
    <button type="submit" class="btn btn-primary">Order</button>
</form>

<?php require_once "inc/footer.php"; ?>