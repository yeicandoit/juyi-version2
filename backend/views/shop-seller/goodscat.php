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
                <!--TODO should use javascript to set parent category, or will some issues-->
                <?php
                    foreach ($idmap as $childId=>$parentId) {
                        if($parentId == 0) {
                            $checkboxId = 'gc'.$childId;
                            $divId = 'div_gc'.$childId;
                            if(isset($goodsCats[$childId])){
                                $checkbox = Html::checkbox("category", true, ['id'=>$checkboxId, 'value'=>$childId]);
                            } else {
                                $checkbox = Html::checkbox("category", false, ['id'=>$checkboxId, 'value'=>$childId]);
                            }

                            $categories = '';
                            echo "<div id='$divId' class='sParCat' onclick='showChilds($divId, $childId, $checkboxId)'>$checkbox$idname[$childId]</div>";
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
    goodsCats = <?=json_encode($goodsCats)?>;
    idmap = <?=json_encode($idmap)?>;

    //for(var i in goodsCats) {
    //    alert(i);
    //}

    data = new Object();
    //Store all the category info into js object
    <?php foreach ($idmap as $childId=>$parentId) {
        if($parentId == 0) {
            $catInfo = array();
            foreach($idmap as $c => $p){
                if($p == $childId){
                    if(isset($goodsCats[$c])) {
                        $checkbox = Html::checkbox("category", true, ['value'=>$c]);
                    } else {
                        $checkbox = Html::checkbox("category", false, ['value'=>$c]);
                    }

                    $catInfo[$c] = "<div>$checkbox$idname[$c]</div>";
                }
            }?>
            data[<?=$childId?>] = <?=json_encode($catInfo)?>;
        <?php } //There have to be some blank between ?php and }, or this html will not display normally.
    }?>

    function showChilds(divid, cid, checkboxId)
    {
        $(".sParCat").css("backgroundColor","");
        $(divid).css({"backgroundColor":"#00a1cb", "width":"120px"});
        if(true == $(checkboxId).is(':checked')) {
            //if goodsCats does not contain this cid
            var str = '';
            if(false == hasThisCat(cid)){
                goodsCats[cid] = 123;
                for(var c in idmap){
                    //if c's parent id equal to cid
                    if(idmap[c] == cid){
                        str += '<div onclick="verifyThisCat('+c+')"><input id ='+'gc'+c+' name="category" value='+c+' type="checkbox">'
                        + idname[c] + '</div>';
                    }
                }
            } else {
                //if goodsCats has contained this cid
                for(var c in idmap){
                    //if c's parent id equal to cid
                    if(idmap[c] == cid){
                        if(hasThisCat(c)){
                            str += '<div onclick="verifyThisCat('+c+')"><input id ='+'gc'+c+' name="category" value='+c+' type="checkbox" checked="checked">' + idname[c] + '</div>';
                        } else {
                            str += '<div onclick="verifyThisCat('+c+')"><input id ='+'gc'+c+' name="category" value='+c+' type="checkbox">'+idname[c]+'</div>';
                        }

                    }
                }
            }
            $("#subcats").html(str);
        } else {
            // Do not check this box
            var str = '';
            if(false == hasThisCat(cid)){
                for(var c in idmap){
                    //if c's parent id equal to cid
                    if(idmap[c] == cid){
                        str += '<div onclick="verifyThisCat('+c+')"><input id ='+'gc'+c+' name="category" value='+c+' type="checkbox">'
                            + idname[c] + '</div>';
                    }
                }
            } else {
                //if goodsCats has contained this cid
                delete goodsCats[cid];
                for(var c in idmap){
                    //if c's parent id equal to cid
                    if(idmap[c] == cid){
                        if(hasThisCat(c)){
                            delete goodsCats[c];
                        }
                        str += '<div onclick="verifyThisCat('+c+')"><input id ='+'gc'+c+' name="category" value='+c+' type="checkbox">'+ idname[c]+'</div>';
                    }
                }
            }
            $("#subcats").html(str);
        }
    }

    function verifyThisCat(cid)
    {
        var checkboxId = '#gc' + cid;
        //Selected this category
        if($(checkboxId).is(':checked') == true){
            if(false == hasThisCat(cid)){
                goodsCats[cid] = 123;
                //Has no parent id
                if(false == hasThisCat(idmap[cid])){
                    goodsCats[idmap[cid]] = 123;
                }
            }
        } else {
            //Do not select this category
            if(true == hasThisCat(cid)){
                delete goodsCats[cid];
            }
        }
    }

    function hasThisCat(cid)
    {
        for(var i in goodsCats) {
            if(i == cid){
                return true;
            }
        }
        return false;
    }

</script>
