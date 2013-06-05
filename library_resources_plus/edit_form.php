<?php

class block_library_resources_plus_edit_form extends block_edit_form {

    protected function specific_definition($mform) {

        // Section header title according to language file.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // A sample string variable with a default value.
        $mform->addElement('text', 'config_text', get_string('blockstring', 'block_library_resources_plus'));
        $mform->setDefault('config_text', 'default value');
        $mform->setType('config_text', PARAM_MULTILANG);
        
        $link = array(
            "url" => LIBRARY_RESOURCES_PLUS_MODULE_URL_BASE,
            "target" => LIBRARY_RESOURCES_PLUS_MODULE_URL_BASE,
            "notes" => 'Notes of URL',
            "linktext" => 'Link text',
        );
        
        $mform->addElement('selectwithlink', 'config_link', get_string('modulereadinglist', 'block_library_resources_plus'), $options, null, 
        array('link' => $link->url, 'label' => get_string('modulereadinglist', 'block_library_resources_plus')));

    }
}
