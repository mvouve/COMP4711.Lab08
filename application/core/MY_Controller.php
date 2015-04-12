<?php

/**
 * core/MY_Controller.php
 *
 * Default application controller
 *
 * @author		JLP
 * @copyright           2010-2013, James L. Parry
 * ------------------------------------------------------------------------
 */
class Application extends CI_Controller {

    protected $data = array();      // parameters for view components
    protected $id;                  // identifier for our content

    /**
     * Constructor.
     * Establish view parameters & load common helpers
     */

    function __construct() {
        parent::__construct();
        $this->data = array();
        $this->data['title'] = "Top Secret Government Site";    // our default title
        $this->errors = array();
        $this->data['pageTitle'] = 'welcome';   // our default page
    }

    /**
     * Render this page
     */
    function render() {
        $role = $this->session->userdata('userRole');
        $name = $this->session->userdata('userName');
        $menu = $this->config->item('menu_choices');
        
        if($role == ROLE_USER)
        {
            
            $menu['menudata'][2] = NULL;
            $menu['menudata'][3] = NULL;
            
            
        }
        if($role == ROLE_ADMIN)
        {
            $menu['menudata'][3] = NULL;
        }
        
        if($role === NULL)
        {
            $menu['menudata'] = array($this->config->item('menu_choices')['menudata'][3]);
        }
        
        $this->data['menubar'] = $this->parser->parse('_menubar', $menu,true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['sessionid'] = session_id();
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
    
    function restrict($rolereq = NULL)
    {
        $userRole = $this->session->userdata('userRole');
        
        if($roleNeeded !== NULL)
        {
            if(is_array($rolereq))
            {
                if(!in_array($userRole, $rolereq))
                {
                    redirect("/");
                    return;
                }
            }
        }
        else if($userRole !== $rolereq)
        {
            redirect("/");
            return;
        }
    }
}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */