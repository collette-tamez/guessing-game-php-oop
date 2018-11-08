<?php
    session_start();
    if(empty($_SESSION['random_number'])){
        $_SESSION['random_number'] = rand(1,10);
        echo "making one";
    }
?>
<?php
    if(!empty($_GET['user_guess'])){
        print_r("your guess was ".$_GET['user_guess']); 
        if($_GET['user_guess'] > $_SESSION['random_number']){
            $display_message = "Too hot!";
        } else if($_GET['user_guess'] < $_SESSION['random_number']) {
            $display_message = "Too cold!!";
        } else if($_GET['user_guess'] == $_SESSION['random_number']) {
            $display_message = "YA DID IT";
        } else {
            $display_message = "how could this have happened.....";
        }
    }
?>
<div id="display">
   <?php 
    if(!empty($_GET['user_guess'])){
    ?>
       you guessed: <?= $_GET['user_guess'] ?>
    <?php
        print_r($display_message);
    } else{
        echo "Between 1 and 10";
    }
    ?>
</div>
<form method="get">
    <input type="text" name="user_guess"/>
    <button>Make a guess!</button>
</form>
