<?php

define('LIST_LENGTH', 5);

class block_library_resources_plus_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section : Common  settings
        $mform->addElement('header', 'commonsettings', get_string('commonsettings', 'block_library_resources_plus'));

        // Entry for static URLs e.g. UCL Explore, Subject Librarians and WISE info skills etc.
        $static_items = array('displayuclexplore', 'displaysubjectlib', 'displaywiseinfo');
		foreach($static_items as $item) {
		
			$mform->addElement('advcheckbox', 'config_'.$item,  get_string($item, 'block_library_resources_plus'), null, array('group' => 1), array(0, 1));
			$mform->setDefault('config_'.$item, 1);	
		}
        
		// Section : Reading Lists
		$types = array(
				'module' => 'Module',
				'program' => 'Programme',
		);
		for ($i=1; $i<= LIST_LENGTH; $i++) {
			$mform->addElement('header', 'readinglist'.$i , 'Reading List '.$i);	
			$select = $mform->addElement('select', 'config_readinglistdropdown'.$i, 'Type', $types);
			$select->setSelected('module');
			$mform->addElement('text', 'config_readinglistcode'.$i, 'Code');
			$mform->addElement('advcheckbox', 'config_readinglistcheckbox'.$i,  'Display', null, array('group' => 2), array(0, 1));
			if ($i==1){
				$mform->setDefault('config_readinglistcode'.$i, 'CODE123');	
				$mform->setDefault('config_readinglistcheckbox'.$i, 1);	
				
			}
				
		}
		
        
        // Entry for Program reading list codes
        //$mform->addElement('text', 'config_progreadlist', get_string('labelprogreadlist', 'block_library_resources_plus'));
        //$mform->setType('config_progreadlist', PARAM_TEXT);
		
		
        
     
    }
}
