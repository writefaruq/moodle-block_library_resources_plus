<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Version details
 *
 * @package    block_library_resources_plus
 * @copyright  2013 M O Faruque Sarker <ritefaruq@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */


defined('MOODLE_INTERNAL') || die();

// URLs for reading list
define('LIBRARY_RESOURCES_PLUS_URL_UCL_EXPLORE', 'http://ucl-primo.hosted.exlibrisgroup.com/primo_library/libweb/action/search.do?menuitem=0&fromTop=true&fromPreferences=false&fromEshelf=false&vid=UCL_VU1');
define('LIBRARY_RESOURCES_PLUS_URL_SUBJECT_LIBRARIANS', 'http://www.ucl.ac.uk/Library/whoaz.shtml');
define('LIBRARY_RESOURCES_PLUS_URL_WISE_INFO_SKILLS', 'https://moodle.ucl.ac.uk/course/category.php?id=70');
define('LIBRARY_RESOURCES_PLUS_URL_BASE_MODULES', 'http://readinglists.ucl.ac.uk/modules/');
define('LIBRARY_RESOURCES_PLUS_URL_BASE_PROGRAMMES', 'http://readinglists.ucl.ac.uk/programmes/');

define('LIST_LENGTH', 5);

class block_library_resources_plus extends block_base {

    function init() {
        $this->title = get_string('pluginname', 'block_library_resources_plus');
    }

    function get_content() {
        global $CFG, $OUTPUT, $COURSE;

        if ($this->content !== null) {
            return $this->content;
        }

        
        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
        
        
        // user/index.php expect course context, so get one if page has module context.
        $currentcontext = $this->page->context->get_course_context(false);
        $courseid = urlencode(strtolower(substr($COURSE->idnumber, 0, 8)));

        
        /*
        if (! empty($this->config->text)) {
            $this->content->text = $this->config->text;
        }

        $this->content = '';
        
        
        if (empty($currentcontext)) {
            return $this->content;
        }
        
    
        if ($this->page->course->id == SITEID) {
            $this->context->text .= "site context";
        }

        
        if (! empty($this->config->text)) {
            $this->content->text .= $this->config->text;
        }
        */
        
        //Add the static links
        $static_items = array(
			array ($this->config->displayuclexplore , 'UCL Explore', LIBRARY_RESOURCES_PLUS_URL_UCL_EXPLORE),
			array($this->config->displaysubjectlib, 'UCL Subject Librarians', LIBRARY_RESOURCES_PLUS_URL_SUBJECT_LIBRARIANS),
			array($this->config->displaywiseinfo, 'WISE Information Skills', LIBRARY_RESOURCES_PLUS_URL_WISE_INFO_SKILLS),
		);
		
		foreach ( $static_items as $item) {
			//echo 'Item: '. $item[1] . 'enabled = ' . $item[0];
			if ($item[0] == 1) {
				$this->content->text .= '<a href="' . $item[2] .' "> '. $item[1]  .' </a> <br>';	
			}
		}
		
		for ($i=1; $i<= LIST_LENGTH; $i++) {
			switch ($i) {
				case 1:
					$code = $this->config->readinglistcode1;
					break;
				case 2:
					$code = $this->config->readinglistcode2;
					break;
				case 3:
					$code = $this->config->readinglistcode3;
					break;
				case 4:
					$code = $this->config->readinglistcode4;
					break;
				case 5:
					$code = $this->config->readinglistcode5;
					break;
			}
			if ($code) {
				$link = LIBRARY_RESOURCES_PLUS_URL_BASE_MODULES;
				$link .= $code;  
				$this->content->text .= '<a href="' . $link .' "> Reading List for '. $code .' </a> <br>';	
			}
				
		}
		
     	//$this->content->text .= 'Reading List 1';
		//$this->content->text .=  $this->config->readinglistdropdown;
		
		
		//$display_ucl_explore = $this->config->displaysubjectlib;
		//$link = LIBRARY_RESOURCES_PLUS_URL_SUBJECT_LIBRARIANS;
		//$desc = 
		//$this->content->text .= '<a href="' . $link .' "> '. $desc .' </a> <br>';
        
        
		
		// Add programme list
        $prog_id = $this->config->progreadlist;
        $link = LIBRARY_RESOURCES_PLUS_URL_BASE_PROGRAMMES;
        $link .= $prog_id;
        
        $this->content->text .= '<a href="' . $link .' "> Programme Reading Lists for '. $prog_id .' </a> <br> anothher link';
        
        return $this->content;
    }

    // my moodle can only have SITEID and it's redundant here, so take it away
    public function applicable_formats() {
        return array('all' => false,
                     'site' => true,
                     'site-index' => true,
                     'course-view' => true, 
                     'course-view-social' => false,
                     'mod' => true, 
                     'mod-quiz' => false);
    }

    public function instance_allow_multiple() {
          return true;
    }

    function has_config() {return true;}

    /*
    public function cron() {
            mtrace( "Hey, my cron script is running" );
             
                 // do something
                  
                      return true;
    }
    */
}
