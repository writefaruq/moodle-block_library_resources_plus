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

// URLs for reading list -- Can be moved to admin config
define('LIBRARY_RESOURCES_PLUS_URL_UCL_EXPLORE', 'http://ucl-primo.hosted.exlibrisgroup.com/primo_library/libweb/action/search.do?menuitem=0&fromTop=true&fromPreferences=false&fromEshelf=false&vid=UCL_VU1');
define('LIBRARY_RESOURCES_PLUS_URL_SUBJECT_LIBRARIANS', 'http://www.ucl.ac.uk/Library/whoaz.shtml');
define('LIBRARY_RESOURCES_PLUS_URL_WISE_INFO_SKILLS', 'https://moodle.ucl.ac.uk/course/category.php?id=70');
define('LIBRARY_RESOURCES_PLUS_URL_BASE_MODULES', 'http://readinglists.ucl.ac.uk/modules/');
define('LIBRARY_RESOURCES_PLUS_URL_BASE_PROGRAMMES', 'http://readinglists.ucl.ac.uk/programmes/');
define('LIBRARY_RESOURCES_PLUS_URL_BASE_EXAM_PAPER', 'http://digitool-b.lib.ucl.ac.uk:8881/R?func=search-advanced-go&LOCAL_BASE=1152&find_code1=WRD&request1=');

define('LIST_LENGTH', 5);

class block_library_resources_plus extends block_list {


    function init() {
        $this->title = get_string('pluginname', 'block_library_resources_plus');
    }


    function get_content() {
        global $CFG, $OUTPUT, $COURSE;

        if ($this->content !== NULL) {
            return $this->content;
        }

        $this->content = new stdClass();
        $this->content->items = array();
        $this->content->icons = array();
        $this->content->footer = '';
			   
	    if (empty($this->instance)) {
           return $this->content;
		}
        
		$courseid = urlencode(strtolower(substr($COURSE->idnumber, 0, 8)));
        
		// Add Reading lists
		for ($i=1; $i<= LIST_LENGTH; $i++) {
			switch ($i) {
				case 1:
					$type = $this->config->readinglistdropdown1;
					$code = $this->config->readinglistcode1;
					$display = $this->config->readinglistcheckbox1;
					break;
				case 2:
					$type = $this->config->readinglistdropdown2;
					$code = $this->config->readinglistcode2;
					$display = $this->config->readinglistcheckbox2;
					break;
				case 3:
					$type = $this->config->readinglistdropdown3;
					$code = $this->config->readinglistcode3;
					$display = $this->config->readinglistcheckbox3;
					break;
				case 4:
					$type = $this->config->readinglistdropdown4;
					$code = $this->config->readinglistcode4;
					$display = $this->config->readinglistcheckbox4;
					break;
				case 5:
					$type = $this->config->readinglistdropdown5;
					$code = $this->config->readinglistcode5;
					$display = $this->config->readinglistcheckbox5;
					break;
			}
			if ($code && $display) {
				if ($type == 'module'){
					$link = LIBRARY_RESOURCES_PLUS_URL_BASE_MODULES;
				} else {
					$link = LIBRARY_RESOURCES_PLUS_URL_BASE_PROGRAMMES;
				}
				$link .= $code;
				$this->content->icons[] = '<img src="' . $OUTPUT->pix_url( '/f/web').'" height="16" width="16" alt="" />&nbsp;';
				$this->content->items[] = '<a href="' . $link .' "> Reading List for '. $code .' </a> <br>';	
			}	
		}

		// Add past Exam Papers
		for ($i=1; $i<= LIST_LENGTH; $i++) {
			switch ($i) {
				case 1:					
					$code = $this->config->exampapercode1;
					$display = $this->config->exampapercheckbox1;
					break;
				case 2:
					$code = $this->config->exampapercode2;
					$display = $this->config->exampapercheckbox2;
					break;
				case 3:
					$code = $this->config->exampapercode3;
					$display = $this->config->exampapercheckbox3;
					break;
				case 4:
					$code = $this->config->exampapercode4;
					$display = $this->config->exampapercheckbox4;
					break;
				case 5:
					$code = $this->config->exampapercode5;
					$display = $this->config->exampapercheckbox5;
					break;
			}
			if ($code && $display) {
				$link = LIBRARY_RESOURCES_PLUS_URL_BASE_EXAM_PAPER;
				$link .= $code;
				$this->content->icons[] = '<img src="' . $OUTPUT->pix_url( '/f/web').'" height="16" width="16" alt="" />&nbsp;';
				$this->content->items[] = '<a href="' . $link .' "> Past UCL Exam Papers for '. $code .' </a> <br>';	
			}
				
		}
		
		 //Add the static links
        $static_items = array(
			array ($this->config->displayuclexplore , 'UCL Explore', LIBRARY_RESOURCES_PLUS_URL_UCL_EXPLORE),
			array($this->config->displaysubjectlib, 'UCL Subject Librarians', LIBRARY_RESOURCES_PLUS_URL_SUBJECT_LIBRARIANS),
			array($this->config->displaywiseinfo, 'WISE Information Skills', LIBRARY_RESOURCES_PLUS_URL_WISE_INFO_SKILLS),
		);
		
		foreach ( $static_items as $item) {
			//echo 'Item: '. $item[1] . 'enabled = ' . $item[0];
			if ($item[0] == 1) {
				//$this->content->text .= '<a href="' . $item[2] .' "> '. $item[1]  .' </a> <br>';
				$this->content->icons[] = '<img src="' . $OUTPUT->pix_url( '/f/web').'" height="16" width="16" alt="" />&nbsp;';
				$this->content->items[] =  '<a href="' . $item[2] .' "> '. $item[1]  .' </a> <br>';		
			}
		}
        return $this->content;
    }


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


    function has_config() {
    	return true;
	}

   
    public function cron() {
    	return false;
    }
   
}
