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


    function get_string($identifier, $langfile)
    {//взять аналог из мудла
        //$langfile = "qtype_stonesgame.php";
        $string = array();
        include($langfile . ".php");
        $strings[$langfile] = $string;
        $string = &$strings[$langfile];

        if (!isset ($string[$identifier])) {
            return false;
        }

        return "$string[$identifier]";
    }

    //TODO: в отдельном классе .php (т к безопасность) реализовываем логику, здесь же вызываем и в функциях js рисуем вершины
    ?>


    <script type="application/javascript">
/*
        <
        div
        class
        = "vis-network"
        tabindex = "900"
        style = "position: relative; overflow: hidden; touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;" > < canvas
        width = "800"
        height = "600"
        style = "position: relative; touch-action: none; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); width: 100%; height: 100%;" > < / canvas > < div
        class
        = "vis-manipulation"
        style = "display: block;" > < div
        class
        = "vis-button vis-add"
        style = "touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" > < div
        class
        = "vis-label" > Add
        Node < / div > < /
        div > < div
        class
        = "vis-separator-line" > < / div > < div
        class
        = "vis-button vis-connect"
        style = "touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" > < div
        class
        = "vis-label" > Add
        Edge < / div > < /
        div > < / div > < div
        class
        = "vis-edit-mode"
        style = "display: none;" > < / div > < div
        class
        = "vis-close"
        style = "display: block; touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);" > < / div > < /
        div >
*/

        function addState() {
            //alert("вышло!!11");


        }

        function editState() {


        }

        function deleteState() {

        }

        function setWinStrategy() {

        }

        function markStateAsWin() {

        }

        function clearAll() {

        }

        function saveAll() {

        }


        var nodes = null;
        var edges = null;
        var tree = null;

        function destroy() {
            if (tree !== null) {
                tree.destroy();
                tree = null;
            }
        }

        function draw() {
            destroy();
            nodes = [];
            edges = [];
            var connectionCount = [];

            // randomly create some nodes and edges
            for (var i = 0; i < 10; i++) {
                nodes.push({id: i, label: String(i)});
            }

            edges.push({from: 0, to: 1, arrows: 'to'});
            edges.push({from: 1, to: 2, arrows: 'to'});
            edges.push({from: 2, to: 3, arrows: 'to'});
            edges.push({from: 2, to: 4, arrows: 'to'});
            edges.push({from: 2, to: 5, arrows: 'to'});
            edges.push({from: 2, to: 6, arrows: 'to'});
            edges.push({from: 6, to: 7, arrows: 'to'});
            edges.push({from: 5, to: 8, arrows: 'to'});
            edges.push({from: 4, to: 9, arrows: 'to'});
            nodes[0]["level"] = 0;
            nodes[1]["level"] = 1;
            nodes[2]["level"] = 2;
            nodes[3]["level"] = 3;
            nodes[4]["level"] = 3;
            nodes[5]["level"] = 3;
            nodes[6]["level"] = 3;
            nodes[7]["level"] = 4;
            nodes[8]["level"] = 4;
            nodes[9]["level"] = 4;
            


            nodes[0].label = "(7, 31)\n38";
            nodes[0].color = "#FFFFFF";
            nodes[0].shape = "box";

            nodes[1].label = "(7, 32)\n39";

            nodes[2].label = "(8, 32)\n40";
            nodes[2].color = "#00FFFF";

            nodes[3].label = "(9, 32)\n41";

            nodes[4].label = "(8, 33)\n41";

            nodes[5].label = "(16, 32)\n48";

            nodes[6].label = "(8, 64)\n72";

            nodes[7].label = "(8, 128)\n136";
            nodes[7].color = "#00FFFF";
            nodes[7].borderWidth = "4";
            nodes[7].color.border = "#00FF00";

            nodes[8].label = "(16, 64)\n80";
            nodes[8].color = "#00FFFF";
            nodes[8].borderWidth = "4";
            $(nodes[8]).color = "red";

            nodes[9].label = "(8, 66)\n74";
            nodes[9].color = "#00FFFF";
            nodes[9].borderWidth = "4";
            nodes[9].color.border = "#00FF00";
            
            
            
            
            // create a tree
            var container = document.getElementById('tree');
            var data = {
                nodes: nodes,
                edges: edges
            };

            var options = {
                edges: {
                    smooth: {
                        type: 'cubicBezier',
                        forceDirection: 'horisontal',
                        roundness: 0.4
                    }
                },
                layout: {
                    hierarchical: {
                        direction: 'LR'
                    }
                },
                manipulation: {
                    enabled: true,
                    initiallyActive: true,
                    addNode: true,
                    addEdge: true,
                    editNode: undefined,
                    editEdge: true,
                    deleteNode: true,
                    deleteEdge: true
                },
                physics: false
            };

            tree = new vis.Network(container, data, options);

            // add event listeners
            tree.on('select', function (params) {
                document.getElementById('selection').innerHTML = 'Selection: ' + params.nodes;
            });

        }

        $(document).ready(function () {
            draw();


            $("#buttonAdd").click(addState);


        });

    </script>


</head>
<body>

<div id="outerbl" style="position: absolute; width: 850px; left: 20%;  ">
    <p class="maintext"><i>Текст задания C3</i></p>

    <div id="question" style="width: 100%; height: 100%;">
        <div id="treeAndButtons" style="width: 850px; height: 400px;  ">
            <div id="tree" class="tree">
            </div>


            <div id="buttons" class="right">
                <button id="buttonAdd" class="main"><?php echo get_string('jsadd', 'qtype_stonesdebug'); ?></button>
                <button id="buttonEdit" class="main"><?php echo get_string('jsedit', 'qtype_stonesdebug'); ?></button>
                <button id="buttonDelete"
                        class="main"><?php echo get_string('jsdelete', 'qtype_stonesdebug'); ?></button>
                <button id="buttonMark" class="main"><?php echo get_string('jsmark', 'qtype_stonesdebug'); ?></button>
                <button id="buttonEnd" class="main"><?php echo get_string('jsend', 'qtype_stonesdebug'); ?></button>
                <button id="buttonClearAll"
                        class="main"><?php echo get_string('jsclearall', 'qtype_stonesdebug'); ?></button>

                <br><br><br>

                <button id="buttonSave" class="main"><?php echo get_string('jssave', 'qtype_stonesdebug'); ?></button>
                <a href="help/stonesgame.html" class="main"
                   target="_blank"><?php echo get_string('jshelp', 'qtype_stonesdebug'); ?></a>
            </div>

        </div>
        <p id="selection" class="maintext"></p>

    </div>

</div>


</body>
</html>