<html>
<head>
<title>DB_Pager example</title>
</head>
<body>
<?php
require 'DB/Pager.php';

$dataSource = 'mysql://apress:apress@localhost/apress';
if (DB::isError($connection = DB::connect($dataSource))){
    die (DB::errorMessage($connection));
}

$sql = "select * from mustsee";
if (DB::isError($result = $connection->query($sql))){
    die (DB::errorMessage($result));
}
$limit = 3;
if (isset($_GET['from'])) {
        $from = intval($_GET['from']);
} else {
        $from = 0;
}
$pager = new DB_Pager($result, $from, $limit);
$pagerData = $pager->build();
if (DB::isError($pagerData)){
    die (DB::errorMessage($pagerData));
}
?>
<p><strong>Found <?php echo $pagerData['numrows']; ?> results</strong></p>
<p><em>Displaying page <?php echo $pagerData['current']; ?> of 
<?php echo $pagerData['numpages']; ?> pages</em></p>
<table border="0">
 <tr>
  <td><strong>Rank</strong></td>
  <td><strong>Name</strong></td>
  <td><strong>Year</strong></td>
 </tr>
<?php
while ($dataRow = $pager->fetchRow(DB_FETCHMODE_ASSOC)){
?>
 <tr>
  <td><?php echo $dataRow['ms_rank']; ?></td>
  <td><?php echo $dataRow['ms_name']; ?></td>
  <td><?php echo $dataRow['ms_year']; ?></td>
 </tr>
<?php
}
?>
 <tr>
  <td colspan="3" align="center">
<?php
foreach ($pagerData['pages'] as $pageNumber => $startRow) {
?>
[ <a href="<?php echo $_SERVER['PHP_SELF']; ?>?from=<?php echo $startRow; ?>">
<?php echo $pageNumber; ?></a> ]
<?php
}
?>
  </td>
 </tr>
</table>
</body>
