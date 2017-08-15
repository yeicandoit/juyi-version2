<?php
use yii\helpers\Html;
?>
<div>
    <table>
        <tr>
            <td style="width:100px; border: 1px groove #e8e8e8;">
                <b>&nbsp;&nbsp;所属分类:</b>
            </td>
            <td>
            <div style="height: 160px; width:200px; border: 1px groove #e8e8e8; overflow-y:scroll;">
                <?php
                    foreach ($idmap as $childId=>$parentId) {
                        if($parentId == 0) {
                            $checkbox = Html::checkbox("category", false, ['value'=>$childId]);
                            $categories = '';
                            echo "<div onclick='showChilds($childId)'>$checkbox$idname[$childId]</div>";
                        }
                    }
                ?>
            </div>
            </td>
            <td>
                <div id="subcats" style="height: 160px; width:200px; border: 1px groove #e8e8e8; overflow-y:scroll;">

                </div>
            </td>
        </tr>
    </table>
</div>
<script>
    idname = <?=json_encode($idname)?>;
    data = new Object();
    //Store all the category info into js object
    <?php foreach ($idmap as $childId=>$parentId) {
        if($parentId == 0) {
            $catInfo = array();
            foreach($idmap as $c => $p){
                if($p == $childId){
                    $checkbox = Html::checkbox("category", false, ['value'=>$c]);
                    $catInfo[$c] = "<div>$checkbox$idname[$c]</div>";
                }
            }?>
            data[<?=$childId?>] = <?=json_encode($catInfo)?>;
        <?php } //There have to be some blank between ?php and }, or this html will not display normally.
    }?>

    function showChilds(catId)
    {
        var cats = eval(data[catId]);
        var str = '';
        for(var key in cats){
            str += cats[key];
        }
        $("#subcats").html(str);
    }
</script>
