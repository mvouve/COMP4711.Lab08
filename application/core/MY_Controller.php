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
        //$role = $this->session->userdata('userRole');
+       //$name = $this->session->userdata('userName');
        /*
        if($role == ROLE_USER)
        {
            $this->config->item('menu_choices')['menudata'][2] = NULL;
            $this->config->item('menu_choices')['menudata'][3] = NULL;
        }
        if($role == ROLE_ADMIN)
        {
            $this->config->item('menu_choices')['menudata'][3] = NULL;
        }
        
        if($role === NULL)
        {
            $this->config->item('menu_choices')['menudata'] = array($this->config->item('menu_choices')['menudata'][3]);
        }
        */
        
        $this->data['menubar'] = $this->parser->parse('_menubar', $this->config->item('menu_choices'),true);
        $this->data['content'] = $this->parser->parse($this->data['pagebody'], $this->data, true);

        // finally, build the browser page!
        $this->data['sessionid'] = session_id();
        $this->data['data'] = &$this->data;
        $this->parser->parse('_template', $this->data);
    }
    

}

/* End of file MY_Controller.php */
/* Location: application/core/MY_Controller.php */