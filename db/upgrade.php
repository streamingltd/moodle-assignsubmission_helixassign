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
 * Upgrade code for install
 *
 * @package   assignsubmission_helixassign
 * @copyright Streaming LTD 2013
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

/**
 * Stub for upgrade code
 * @param int $oldversion
 * @return bool
 */
function xmldb_assignsubmission_helixassign_upgrade($oldversion) {
    global $DB;
    if ($oldversion < 2014050601) {
        $table = new xmldb_table('assignsubmission_helixassign');
        $field = new xmldb_field('submission');
        $field->set_attributes(XMLDB_TYPE_INTEGER, '10', true, true, false, "0", 'assignment');
        $DB->get_manager()->add_field($table, $field);

        $all = $DB->get_records('assignsubmission_helixassign', ["submission" => 0]);
        foreach ($all as $rec) {
            $allsubs = explode(",", $rec->submissions);
            $rec->submission = intval(end($allsubs));
            $DB->update_record('assignsubmission_helixassign', $rec);
        }
        upgrade_mod_savepoint(true, 2014050601, 'helixmedia');
    }

    if ($oldversion < 2014111710) {
        $table = new xmldb_table('assignsubmission_helixassign');
        $all = $DB->get_records('assignsubmission_helixassign');
        foreach ($all as $rec) {
            $first = $rec->submission;
            $allsubs = explode(",", $rec->submissions);
            foreach ($allsubs as $sub) {
                echo $sub . " " . $first;
                if ($sub != $first) {
                    $nrec = new stdClass();
                    $nrec->assignment = $rec->assignment;
                    $nrec->submission = $sub;
                    $nrec->submissions = $sub;
                    $nrec->preid = $rec->preid;
                    $nrec->servicesalt = $rec->servicesalt;
                    $DB->insert_record('assignsubmission_helixassign', $nrec);
                }
            }
        }
        upgrade_mod_savepoint(true, 2014111710, 'helixmedia');
    }

    if ($oldversion < 2025021401) {
        // Define field custom to be added to assignsubmission_helixassign.
        $table = new xmldb_table('assignsubmission_helixassign');
        $field = new xmldb_field('custom', XMLDB_TYPE_TEXT, null, null, null, null, null, 'servicesalt');

        $dbman = $DB->get_manager();
        // Conditionally launch add field custom.
        if (!$dbman->field_exists($table, $field)) {
            $dbman->add_field($table, $field);
        }

        // Helixassign savepoint reached.
        upgrade_plugin_savepoint(true, 2025021401, 'assignsubmission', 'helixassign');
    }

    return true;
}
