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
 * @copyright  2013 onwards M O Faruque Sarker <ritefaruq@gmail.com>
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$settings->add(new admin_setting_heading('libraryresourcesplus',
                                         get_string('headerconfig', 'block_library_resources_plus'),
                                         get_string('descconfig', 'block_library_resources_plus')));

$settings->add(new admin_setting_configcheckbox('newblock/foo',
                                                get_string('labelfoo', 'block_library_resources_plus'),
                                                get_string('descfoo', 'block_library_resources_plus'),
                                                '0'));
