<?php
/**
 * Created by PhpStorm.
 * User: Lena
 * Date: 29.05.2016
 * Time: 22:02
 */




?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Игра с камнями</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <link type="text/css" rel="stylesheet" href="vis-folder/vis.css"/>
    <link type="text/css" rel="stylesheet" href="display-styles.css"/>
    <script type="text/javascript" src="vis-folder/vis.js"></script>
    <script type="text/javascript" src="jquery.js"></script>

    <?php


    function get_string($identifier, $langfile){//взять аналог из мудла
        //$langfile = "qtype_stonesgame.php";
        $string = array();
        include ($langfile.".php");
        $strings[$langfile] = $string;
        $string = &$strings[$langfile];

        if (!isset ($string[$identifier])) {
            return false;
        }

        return "$string[$identifier]";
    }



?>


    <script type="application/javascript">
        $("#buttonAdd").click(addElementAcc);

        function addElementAcc() {
            alert("вышло!!11");
        }


    </script>
</head>
<body>

<div id="outerbl" style="position: absolute; width: 800px; left: 20%; background-color: #0d9ffe;">
fff

<div id="question" style="width: 100%; height: 100%;">
    <div id="tree" class="tree">



    </div>

    <div id="buttons" class="right">
        <button id="buttonAdd" class="main"><?php echo get_string('jsadd','qtype_stonesdebug'); ?></button>
        <button id="buttonEdit" class="main"><?php echo get_string('jsedit','qtype_stonesdebug'); ?></button>
        <button id="buttonDelete" class="main"><?php echo get_string('jsdelete','qtype_stonesdebug'); ?></button>
        <button id="buttonMark" class="main"><?php echo get_string('jsmark','qtype_stonesdebug'); ?></button>
        <button id="buttonEnd" class="main"><?php echo get_string('jsend','qtype_stonesdebug'); ?></button>
        <button id="buttonClearAll" class="main"><?php echo get_string('jsclearall','qtype_stonesdebug'); ?></button>

        <br><br><br>

        <button id="buttonSave" class="main"><?php echo get_string('jssave','qtype_stonesdebug'); ?></button>
        <a href="help/stonesgame.html" class="main" target="_blank"><?php echo get_string('jshelp','qtype_stonesdebug'); ?></a>
    </div>


</div>

</div>


</body>
</html>