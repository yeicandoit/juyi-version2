<?php
namespace frontend\models\seller;

class Menu
{
//菜单的配制数据
    public static $menu = array(
        "统计结算模块" => array(
             "管理首页" => "shop-seller/sellerhome",
             "销售额统计" => "shop-seller/account",
        ),

        "商品模块" => array(
             "商品列表" => "shop-seller/goodslist",
             "添加商品" => "shop-seller/goodsadd",
             "商品评价" => "shop-seller/comment",
             "商品退款" => "shop-seller/refundment",
        ),

        "订单模块" => array(
            "订单列表" => "shop-seller/order" ,
        ),

        "配置模块" => array(
            "物流配送" => "shop-seller/delivery",
            "消息通知" => "shop-seller/userrecharge",
            "资料修改" => "shop-seller/shopinfo",
            "QQ客服" => "shop-seller/userrecharge",
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