<?php
    session_start();
    class GuessingGame{
        private $random_number = null; //private because nothing outside of the class needs to access it
        private $current_message = 'Make a guess!';
        private function chose_random_number(){
            $_SESSION['random_number'] = rand(1,10);
        }
        private function set_message($message){
            $this->current_message = "<p>$message</p>";
        }
        private function get_number_from_session(){
            if(empty($_SESSION['random_number'])){
                return false;
            } else {
                return $_SESSION['random_number'];
            }
        }
        private function get_user_guess(){
            return (int)$_GET['user_guess'];
        }
        public function get_current_message(){
            return $this->current_message;
        }
        private function add_history($user_guess){
            if(empty($_SESSION['history'])){
                $_SESSION['history'] = [];
            }
            $_SESSION['history'][] = $user_guess;
        }
        public function get_history(){
            if(empty($_SESSION['history'])){
               return $this->set_message("Between 1 and 10");
            }
            $output = '';
            foreach($_SESSION['history'] as $number){
                $output.="<li>$number</li>";
            }
            return $output;
        }
        public function reset_game(){
            unset($_SESSION['random_number']);
            unset($_SESSION['history']);
        }
        public function handle_user_guess(){
            $guess = $this->get_user_guess();
            // $this->set_message("Your guess was: $guess");
            // $this->get_current_message();
            $this->add_history($guess);
            $number_to_guess = $this->get_number_from_session();
            if($guess > $number_to_guess){
                $this->set_message("Too hot!");
            } else if($guess < $number_to_guess) {
                $this->set_message("Too cold!!");
            } else if($guess == $number_to_guess) {
                $this->set_message("YA DID IT"); //now we calling our method 
                $this->reset_game();
            } else {
                $this->set_message("how could this have happened.....");
            }
        }
        public function init(){
            if(!$this->get_number_from_session()){
                $this->chose_random_number();
            }
        }
    }

    $game = new GuessingGame;
    $game->init();
    if(!empty($_GET['user_guess'])){
        $game->handle_user_guess();
    }
?>
<div id="display">
   <?= $game->get_current_message(); ?>
</div>
<form method="get">
    <input type="text" name="user_guess"/>
    <button>Make a guess!</button>
</form>
<div>
    So far you have guessed the numbers:
    <ul>
    <?= $game->get_history(); ?>
    </ul>
</div>
