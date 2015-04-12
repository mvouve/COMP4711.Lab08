<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Auth
 *
 * @author Marc
 */
class Auth extends Application{
    
    public function __construct() {
        parent::__construct();
    }
    //put your code here
    
    function index()
    {
        $this->data['pagebody'] = 'login';
        $this->render();
    }
    
    function logout()
    {
        $this->session->sess_destroy();
        redirect('/');
    }
    
    function submit()
    {
        $key = $this->input->post('userid');
        
        $user = $this->users->get($key);
        
        if(password_verify($this->input->post('password'), $user->password))
        {
            $this->session->set_userdata('userID', $key);
            $this->session->set_userdata('userName', $user->name);
            $this->session->set_userdata('userRole', $user->role);
        }
        
        redirect('/');
    }
}
