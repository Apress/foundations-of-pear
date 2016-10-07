<?php
require_once "HTML/Table.php";
$weekDays = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', $data = array();
$data['numDays'] = date('t');
$data['curDay'] = date('j');
$data['curMonth'] = date('F');
$data['firstDay'] = date('w', strtotime('1 ' . $data['curMonth']));
$tAttributes = array(
             'border'	=>	'0',
);
$dateTable = new HTML_Table($tAttributes);
$dateTable->setAutoGrow(true);
$dateTable->setAutoFill('');
for($i=0; $i < count($weekDays); $i++) {
            $dateTable->setHeaderContents(0, $i, $weekDays[$i]);
}
$row = 1;
$col = $data['firstDay'];
for ($i=1; $i<=$data['numDays']; $i++) {
            $dateTable->setCellContents($row, $col, $i);
            if ($i == $data['curDay']) {
$todayAttrs = array(
                               'bgcolor' => '#ff0000'
);
$dateTable->setCellAttributes($tRow, $tCol, $todayAttrs);
            }
        $col++;
        if ($col>6) {
                $row++;
                $col = 0;
        }
}
$weekendAttrs = array(
             'bgcolor' => '#cccccc'
);
$dateTable->setColAttributes(0, $weekendAttrs);
$dateTable->setColAttributes(6, $weekendAttrs);
$dateTable->setCaption($data['curMonth']);
echo $dateTable->toHTML();
?>
