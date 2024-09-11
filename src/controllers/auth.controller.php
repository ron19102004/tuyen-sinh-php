<?php
class AuthController {
    private $userRepository;
    /**
     * @param UserRepository $userRepository
     */
    public function __construct($userRepository){
        $this->userRepository = $userRepository;
    }
    public function login(){
        
    }
}