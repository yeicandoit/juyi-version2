<?php
namespace backend\models\admin;

class Menu
{
//菜单的配制数据
    public static $ArrGoods = array(
        "商品管理" => array(
             "商品列表" => "admin/goodslist",
             "商品添加" => "admin/goodsadd",
        ),
        "会员管理" => array(
            "会员列表" => "admin/userlist",
            "商家列表" => "admin/sellerlist",
            "专家列表" => "admin/expertlist",
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
        return self::$ArrGoods;
    }
}