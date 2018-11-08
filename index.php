<?php
    session_start();
    if(empty($_SESSION['random_number'])){
        $_SESSION['random_number'] = rand(1,10);
    }
?>
<div id="display">
<?php
    if(!empty($_GET['user_guess'])){
        print_r("your guess was ".$_GET['user_guess']); 
    }
?>
</div>
<form method="get">
    <input type="text" name="user_guess"/>
    <button>Make a guess!</button>
</form>
