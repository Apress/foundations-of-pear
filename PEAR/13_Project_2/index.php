<?php
require_once('connect.php');
require_once 'DB/Pager.php';
require_once 'HTML/QuickForm.php';
require_once 'HTML/Table.php';
require_once 'HTML/Crypt.php';
require_once 'Text/Wiki.php';
require_once 'HTML/BBCodeParser.php';
$form = new HTML_QuickForm('messageform', 'post', $_SERVER['REQUEST_URI']);
if ($form->isSubmitted()) {
            if ($form->validate()) {
                        $data = $form->getSubmitValues();
                        $sql = "INSERT INTO forum 
                                (forum_topic, forum_owner, forum_member,
                                forum_title, forum_format, forum_message) 
                                VALUES (" . $db->escapeSimple($data['topic']) . ",'" 
                                . $db->escapeSimple($auth->getUsername()) . "', " 
                                . (($data['members']==1)?$db->escapeSimple
                                  ($data['members']):0) 
                                . ", '" . $db->escapeSimple($data['title']) . "', '" 
                                . $db->escapeSimple($data['format']) . "', '" 
                                . $db->escapeSimple($data['message']) . "')";
                        $db->query($sql);
            }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
            "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo $settings['root']['conf']['Forum']['title']; ?></title>
<link rel="stylesheet" type="text/css" href="forum.css">
</head>
<body>
<h1><a href="index.php">
<?php echo $settings['root']['conf']['Forum']['heading']; ?></a></h1>
<a href="member.php"><?php
if ($auth->getAuth()) {
            echo "Log Out " . $prefmanager->getPref($auth->getUsername(), "name");
            $member_level = $prefmanager->getPref($auth->getUsername(), "level");
} else {
            echo "Log In";
            $member_level = 0;
}
?></a>
<hr />
<?php
$current = & $db->query('SELECT forum_id, forum_owner, forum_title, forum_date, 
                                forum_format, forum_message, pref_value from forum, 
                                preferences where forum_owner = user_id AND 
                                pref_id="name" AND forum_id='
                                .((isset($_GET['topic']))?$_GET['topic']:0));
if (PEAR::isError($current)) {
    die($current->getMessage());
}
$tableAttrs = array("width" => "600", "id" => "MainTopic", "cellspacing" => "0");
$table = new HTML_Table($tableAttrs);
$table -> setAutoGrow(true);
$table -> setAutoFill("");
$rowCount = 0;
while ($cRow = & $current->fetchRow(DB_FETCHMODE_ASSOC)) {
             $table->setCellContents($rowCount, 0, "<strong>" . $cRow['forum_title'] 
                                                  . "</strong>");
             $table->setCellContents($rowCount, 1, strftime("%A, %d %B, %H:%M",
                                                  strtotime($cRow['forum_date'])));
             $table->setRowAttributes($rowCount, array('class' => 'mHead'));
             $rowCount++;
             if ($auth->getAuth()) {
                          $crypt = new HTML_Crypt($cRow['forum_owner']);
                          $crypt->addMailTo();
                          $mail=$crypt->getScript();
                          $table->setCellContents($rowCount, 0, 
                          unserialize($cRow['pref_value']). ' ('. $mail .')');
             } else {
                          $table->setCellContents($rowCount, 0, 
                          unserialize($cRow['pref_value']));
             }
             $table->setRowAttributes($rowCount, array('class' => 'mInfo'));
             $rowCount++;
        switch($cRow['forum_format']) {
                case 'bbcode':
                        $bbcode = new HTML_BBCodeParser();
                        $bbcode->setText($cRow['forum_message']);
                        $bbcode->parse();
                        $message = $bbcode->getParsed();
                        break;
                case 'wiki':
                        $wiki = & Text_Wiki::factory();
                        $message = $wiki->transform($cRow['forum_message']);
                        break;
                case 'text':
                default:
                        $message = nl2br($cRow['forum_message']);
                        break;
        }
        $table->setCellContents($rowCount, 0, $message);
        $table->setCellAttributes($rowCount, 0, array('colspan' => '2'));
        $table->setRowAttributes($rowCount, array('class' => 'mBody'));
}
echo $table->toHTML();
?>
<p>
<?php
$from = (isset($_GET['from']))?$_GET['from']:0;
$limit = 2;
$sql = 'SELECT forum_id, forum_owner, forum_title, forum_date, forum_format, 
           forum_message, pref_value from forum, preferences 
           where forum_owner = user_id AND pref_id="name" 
           AND forum_topic='.((isset($_GET['topic']))?$_GET['topic']:0).' 
           AND forum_member <= ' . $member_level . ' 
          ORDER BY forum_date '.((isset($_GET['topic']))?'ASC':'DESC');
$cRes = & $db->query($sql);
$nRows = $cRes->numRows();
$res = & $db->limitQuery($sql, $from, $limit);
if (PEAR::isError($res)) {
    die($res->getMessage());
}
$tableAttrs = array("width" => "600", "id" => "topics", "cellspacing" => "0");
$table = new HTML_Table($tableAttrs);
$table -> setAutoGrow(true);
$table -> setAutoFill("");
$rowCount = 0;
while ($row = & $res->fetchRow(DB_FETCHMODE_ASSOC)) {
        if (isset($_GET['topic'])) {
                $table->setCellContents($rowCount, 0, $row['forum_title']);
        } else {
                $table->setCellContents($rowCount, 0, "<a href='index.php?topic=" 
                          . $row['forum_id'] . "'>" . $row['forum_title'] . "</a>");
        }
        $table->setCellContents($rowCount, 1, strftime
                           ("%A, %d %B, %H:%M",strtotime($row['forum_date'])));
        $table->setRowAttributes($rowCount, array('class' => 'sHead'));
        $rowCount++;
        if ($auth->getAuth()) {
                $crypt = new HTML_Crypt($row['forum_owner']);
                $crypt->addMailTo();
                $mail=$crypt->getScript();
                $table->setCellContents
                    ($rowCount, 0, unserialize($row['pref_value'])
                                                     . ' ('. $mail .')');
        } else {
                $table->setCellContents
                ($rowCount, 0, unserialize($row['pref_value']));
        }       
        if (!isset($_GET['topic'])) {
                $countResult = $db->query
                    ('SELECT * FROM forum WHERE forum_topic = ' . $row['forum_id']);
                $table->setCellContents($rowCount, 1, $countResult->numRows() 
                        . ' replies');
        }
        $table->setRowAttributes($rowCount, array('class' => 'sInfo'));
        $rowCount++;
        if (isset($_GET['topic'])) {
                switch($row['forum_format']) {
                        case 'bbcode':
                                $bbcode = new HTML_BBCodeParser();
                                $bbcode->setText($row['forum_message']);
                                $bbcode->parse();
                                $message = $bbcode->getParsed();
                                break;
                        case 'wiki':
                                $wiki = & Text_Wiki::factory();
                                $message = $wiki->transform($row['forum_message']);
                                break;
                        case 'text':
                        default:
                                $message = nl2br($row['forum_message']);
                                break;
                }
                $table->setCellContents($rowCount, 0, $message);
                $table->setCellAttributes($rowCount, 0, array('colspan' => '2'));
                $table->setRowAttributes($rowCount, array('class' => 'sBody'));
                $rowCount++;
        }
}
echo $table->toHTML();
?>
<?php
$data = DB_Pager::getData($from, $limit, $nRows);
$tableAttrs = array("width" => "600", "id" => "navigation", "cellspacing" => "0");
$table = new HTML_Table($tableAttrs);
$table -> setAutoGrow(true);
$table -> setAutoFill("");
foreach ($data['pages'] as $key => $value) {
             $qArray = $_GET;
             $qArray['from'] = $value;
             $qArrayTemp = array();
             foreach($qArray as $qKey => $qValue) {
                          $qArrayTemp[] = $qKey . '=' . $qValue;
             }
             $qString = implode('&', $qArrayTemp);
             if ($_GET['from'] == $value) {
                          $table->setCellContents(0, intval($key), "Page " . $key );
             } else {
                          $table->setCellContents(0, intval($key), "<a href='" 
                                       . $_SERVER['PHP_SELF'] . "?" 
                                       . $qString . "'>Page " . $key . "</a>");
             }
}
echo $table->toHTML();
?>
</p>
<hr />
<?php
if ($auth->getAuth()) {
?>
<h2>Post new</h2>
<?php
        $form->addElement('text', 'title', 'Title:');
        $form->addElement
             ('hidden', 'topic', (isset($_GET['topic'])?$_GET['topic']:0));
        $form->addElement('select', 'format', 'Message Format', array
             ('text' => 'Plain Text', 'bbcode' => 'BBCode', 'wiki' => 'Wiki'));
        $form->addElement('checkbox', 'members', 'Members Only:');
        $form->addElement('textarea', 'message', 'Message:');
        $form->addElement('submit', null, 'Submit');
        $form->applyFilter('title', 'trim');
        $form->applyFilter('email', 'trim');
        $form->addRule
             ('title', 'Please provide a title', 'required', null, 'client');
        $form->addRule
             ('message', 'Please enter a message', 'required', null, 'client');
        $form->display();?>
<?php
}
?>
</body>
</html>
