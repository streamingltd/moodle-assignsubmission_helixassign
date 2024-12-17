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
 * This file contains the version information for the helixassign submission plugin
 *
 * @package    assignsubmission_helixassign
 * @copyright Streaming LTD 2013
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

$plugin->version   = 2024120901;
$plugin->requires  = 2022112800;
$plugin->component = 'assignsubmission_helixassign';
$plugin->maturity = MATURITY_STABLE;
$plugin->release = '8.5.19e';
$plugin->dependencies = array(
    'mod_helixmedia' => '2024120901'
);
$plugin->supported = [401, 405];
