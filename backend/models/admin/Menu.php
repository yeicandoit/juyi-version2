<?php
namespace backend\models\seller;

class Menu
{
//菜单的配制数据
    public static $ArrGoods = array(
        "商品管理" => array(
             "商品列表" => "shop-seller/sellerhome",
             "商品添加" => "shop-seller/account",
        ),

        "商品分类" => array(
             "分类列表" => "shop-seller/goodslist",
             "添加分类" => "shop-seller/goodsadd",
        ),
    );

    /**
     * @brief 根据权限初始化菜单
     * @param int $roleId 角色ID
     * @return array 菜单数组
     */
    public static function getMenu($roleId = "")
    {
        //菜单创建事件触发
        return self::$menu;
    }
}