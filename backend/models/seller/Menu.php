<?php
namespace backend\models\seller;

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
             "商品咨询" => "shop-seller/consult",
        ),

        "预约模块" => array(
            "预约列表"=>"shop-seller/appointinfo",
            "设置预约"=>"shop-seller/setappointment",
        ),

        "订单模块" => array(
            "订单列表" => "shop-seller/order" ,
            "退款记录" => "shop-seller/refundment",
        ),

        "配置模块" => array(
            "消息通知" => "#",
            "基本信息" => "shop-seller/shopinfo",
            "详细信息" => "shop-seller/shopdetail",
            "QQ客服" => "#",
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