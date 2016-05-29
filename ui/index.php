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


    ?>


    <script type="application/javascript">
        $("#buttonAdd").click(addElementAcc);

        function addElementAcc() {
            alert("вышло!!11");
        }


        var nodes = null;
        var edges = null;
        var network = null;

        function destroy() {
            if (network !== null) {
                network.destroy();
                network = null;
            }
        }

        function draw() {
            destroy();
            nodes = [];
            edges = [];
            var connectionCount = [];

            // randomly create some nodes and edges
            for (var i = 0; i < 15; i++) {
                nodes.push({id: i, label: String(i)});
            }
            edges.push({from: 0, to: 1});
            edges.push({from: 0, to: 6});
            edges.push({from: 0, to: 13});
            edges.push({from: 0, to: 11});
            edges.push({from: 1, to: 2});
            edges.push({from: 2, to: 3});
            edges.push({from: 2, to: 4});
            edges.push({from: 3, to: 5});
            edges.push({from: 1, to: 10});
            edges.push({from: 1, to: 7});
            edges.push({from: 2, to: 8});
            edges.push({from: 2, to: 9});
            edges.push({from: 3, to: 14});
            edges.push({from: 1, to: 12});
            nodes[0]["level"] = 0;
            nodes[1]["level"] = 1;
            nodes[2]["level"] = 3;
            nodes[3]["level"] = 4;
            nodes[4]["level"] = 4;
            nodes[5]["level"] = 5;
            nodes[6]["level"] = 1;
            nodes[7]["level"] = 2;
            nodes[8]["level"] = 4;
            nodes[9]["level"] = 4;
            nodes[10]["level"] = 2;
            nodes[11]["level"] = 1;
            nodes[12]["level"] = 2;
            nodes[13]["level"] = 1;
            nodes[14]["level"] = 5;


            // create a network
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
                physics: false
            };
            network = new vis.Network(container, data, options);

            // add event listeners
            network.on('select', function (params) {
                document.getElementById('selection').innerHTML = 'Selection: ' + params.nodes;
            });

        }

        $(document).ready(function () {
            draw();
        });

    </script>


</head>
<body>

<div id="outerbl" style="position: absolute; width: 850px; left: 20%; border: solid; border-color: #f79646">
    <p class="maintext"><i>Текст задания C3</i></p>

    <div id="question" style="width: 100%; height: 100%;">
        <div id="treeAndButtons" style="width: 850px; height: 400px; border: solid; border-color: #00ff26">
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