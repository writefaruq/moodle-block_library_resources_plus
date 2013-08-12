<?php

class block_library_resources_plus_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));


        // Entry for static URLs e.g. UCL Explore, Subject Librarians and WISE info skills etc.
        $static_items = array('displayuclexplore', 'displaysubjectlib');
		foreach($static_items as $item) {
		
			$mform->addElement('advcheckbox', $item,  get_string($item, 'block_library_resources_plus'), null);
			$mform->setDefault($item, 1);
        	
			
		}
        
        
        // Entry for Program reading list codes
        $mform->addElement('text', 'config_progreadlist', get_string('labelprogreadlist', 'block_library_resources_plus'));
        $mform->setType('config_progreadlist', PARAM_TEXT);
		
		
        
     
    }
}
