<?php
require_once("{$CFG->libdir}/formslib.php");
 
class myblock_form extends moodleform {
 
    function definition() {
 
        $mform =& $this->_form;
        $mform->addElement('header','displayinfo', get_string('textfields', 'block_myblock'));
        
        // add page title element.
$mform->addElement('text', 'pagetitle', get_string('pagetitle', 'block_myblock'));
$mform->setType('pagetitle', PARAM_RAW);
$mform->addRule('pagetitle', null, 'required', null, 'client');
    
    }
}

?>