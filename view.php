<?php
 
require_once('../../config.php');
require_once('myblock_form.php');
 
global $DB, $OUTPUT, $PAGE;

$settingsnode = $PAGE->settingsnav->add(get_string('myblocksettings', 'block_myblock'));
$editurl = new moodle_url('/blocks/myblock/view.php', array('id' => $id, 'courseid' => $courseid, 'blockid' => $blockid));
$editnode = $settingsnode->add(get_string('editpage', 'block_myblock'), $editurl);
$editnode->make_active();
 
// Check for all required variables.
$courseid = required_param('courseid', PARAM_INT);
 
$blockid = required_param('blockid', PARAM_INT);
 
// Next look for optional variables.
$id = optional_param('id', 0, PARAM_INT);
 
if (!$course = $DB->get_record('course', array('id' => $courseid))) {
    print_error('invalidcourse', 'block_myblock', $courseid);
}
 
require_login($course);

$PAGE->set_url('/blocks/myblock/view.php', array('id' => $courseid));
$PAGE->set_pagelayout('standard');
$PAGE->set_heading(get_string('edithtml', 'block_myblock'));
 
$myblock = new myblock_form();
 
if($myblock->is_cancelled()) {
    // Cancelled forms redirect to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $id));
    redirect($courseurl);
} else if ($myblock->get_data()) {
    // We need to add code to appropriately act on and store the submitted data
    // but for now we will just redirect back to the course main page.
    $courseurl = new moodle_url('/course/view.php', array('id' => $courseid));
    redirect($courseurl);
} else {
    // form didn't validate or this is the first display
    $site = get_site();
    echo $OUTPUT->header();
    $myblock->display();
    echo $OUTPUT->footer();
}

echo $OUTPUT->header();
$myblock->display();
echo $OUTPUT->footer();


$myblock->display();
?>