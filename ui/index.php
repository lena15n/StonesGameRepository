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

    return $string[$identifier];
}

//TODO: в отдельном классе .php (т к безопасность) реализовываем логику, здесь же вызываем и в функциях js рисуем вершины
/*
 * В js создать метод конвертации рисованого дерева в "пхп-шное" (добавляются новые поля и прочее, но само дерево - js)
 *
 */

$position = "(7, 31)";

function get_position_summ($position_str)
{
    $spoils = preg_split("/[(\s, )]+/", $position_str, null, PREG_SPLIT_NO_EMPTY);
    $summ = 0;

    foreach ($spoils as $spoil) {
        $summ += $spoil;
    }

    return $summ;
}

$summ = get_position_summ($position);
$task3 = str_replace("N", $position, get_string('jstask3', 'qtype_stonesdebug'));

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


    <script type="application/javascript">
        var phptree = null;


        var nodes = null;
        var edges = null;
        var tree = null;

        var need = true;

        function addState() {
            if (tree !== null) {
                tree.addNodeMode();
            }
        }

        function editState() {

            //edges.
        }

        function deleteState() {
            if (tree !== null) {
                var id = tree.getSelectedNodes();
                var nextNodes = nodes.getConnectedNodes(id);

                nextNodes.forEach(function (node, i, nextNodes) {
                    if (node.id == id) {
                        nodes.delete(node);
                        //currEdges.push(edge);
                    }
                });


                tree.deleteSelected();
            }
        }


        function setWinStrategy() {

        }

        function markStateAsWin() {

        }

        function clearAll() {
           draw1();
        }

        function saveAll() {

        }



        function addNodeJs(data, callback) {
            /* if (!need) {
             need = true;
             tree.disableEditMode();
             return;
             }
             need = false;

             data.label = "(7, 31)\n38";
             data.color = "#FFFFFF";

             console.log("here");

             callback(data);
             tree.disableEditMode();*/
        }

        function addEdgeJs(id) {
            edges.add({id, from, to});
        }

        function drawnTreeToPHPTree(drawntree) {
            //logic

            phptree = drawntree;
        }


        function destroy() {
            if (tree !== null) {
                tree.destroy();
                tree = null;
            }
        }

        function draw1() {
            destroy();
            nodes = [];
            edges = [];
            var connectionCount = [];


            nodes.push({id: 0, label: "<?php echo $position;?>\n<?php echo $summ; ?>"});
            nodes[0]["level"] = 0;
            nodes[0].color = "#FFFFFF";
            nodes[0].shape = "box";

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
                        forceDirection: 'horizontal',
                        roundness: 0.4
                    }
                },
                layout: {
                    hierarchical: {
                        direction: 'LR'
                    }
                },
                manipulation: {
                    enabled: false,
                    addNode: function (data, callback) {
                        addNodeJs(data, callback);
                        addEdgeJS();
                    }
                },
                physics: false
            };
            tree = new vis.Network(container, data, options);

            // add event listeners
            tree.on('select', function (params) {
                document.getElementById('selection').innerHTML = 'Selection: ' + params.nodes;
            });

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
                        forceDirection: 'horizontal',
                        roundness: 0.4
                    }
                },
                layout: {
                    hierarchical: {
                        direction: 'LR'
                    }
                },
                manipulation: {
                    enabled: false,
                    addNode: function (data, callback) {
                        addNodeJs(data, callback);
                        addEdgeJS();
                    }
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
            $("#buttonEdit").click(editState);
            $("#buttonDelete").click(deleteState);
            $("#buttonMark").click(editState);
            $("#buttonEnd").click(editState);
            $("#buttonClearAll").click(clearAll);


        });

    </script>


</head>
<body>

<div id="outerbl" style="position: absolute; width: 850px; left: 20%;  ">
    <p class="maintext"><?php echo $task3 ?></p>

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

        <div>
            <p id="selection" class="maintext"></p>

            <table>
                <tr>
                    <td><p class="maintext"><?php echo get_string('jsquestionwinner', 'qtype_stonesdebug') ?></p></td>

                    <td><select name="winnernames[]">
                            <option
                                value="<?php echo get_string('jspet', 'qtype_stonesdebug') ?>"><?php echo get_string('jspet', 'qtype_stonesdebug') ?></option>
                            <option
                                value="<?php echo get_string('jsvan', 'qtype_stonesdebug') ?>"><?php echo get_string('jsvan', 'qtype_stonesdebug') ?></option>
                        </select></td>
                </tr>

                <tr>
                    <td><p class="maintext"><?php echo get_string('jsquestionmaxcount', 'qtype_stonesdebug') ?></p></td>
                    <td><p><input name="digit" required pattern="#[0-9]{2}" style="width: 50px"></p></p></td>
                </tr>
            </table>

        </div>


    </div>
</div>

</body>
</html>