<?php
    session_start();
    if(empty($_SESSION['random_number'])){
        $_SESSION['random_number'] = rand(1,10);
        echo "making one";
    }
?>
<?php
    $display_message = "Between 1 and 10";
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
   <?= $display_message ?>
</div>
<form method="get">
    <input type="text" name="user_guess"/>
    <button>Make a guess!</button>
</form>
