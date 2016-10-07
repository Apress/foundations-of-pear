<?php
$structure = array(
        1       =>      array(
                'title' =>      'File',
                'url'   =>      '05_menu.php?nav=file',
                'sub'   =>      array(
                        11      =>      array(
                                'title' =>      'Open',
                                'url'   =>      '05_menu.php?nav=fileopen'
                        ),
                        12      =>      array(
                                'title' =>      'Save',
                                'url'   =>      '05_menu.php?nav=filesave'
                        ),
                        13      =>      array(
                                'title' =>      'Print',
                                'url'   =>      '05_menu.php?nav=fileprint'
                        )
                )
        ),
        2       =>      array(
                'title' =>      'Edit',
                'url'   =>      '05_menu.php?nav=edit',
                'sub'   =>      array(
                        21      =>      array(
                                'title' =>      'Cut',
                                'url'   =>      '05_menu.php?nav=editcut'
                        ),
                        22      =>      array(
                                'title' =>      'Copy',
                                'url'   =>      '05_menu.php?nav=editcopy'
                        ),
                        23      =>      array(
                                'title' =>      'Paste',
                                'url'   =>      '05_menu.php?nav=editpaste'
                        )
                )
        ),
        3       =>      array(
                'title' =>      'Help',
                'url'   =>      '05_menu.php?nav=help'
        )
);

require_once('HTML/Menu.php');

$menu =& new HTML_Menu($structure, 'prevnext');
$menu->setUrlPrefix('/Apress/');
$menu->forceCurrentUrl('/Apress/05_menu.php?nav='.$_GET['nav']);

$menu->show();
?>
