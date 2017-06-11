<?php
namespace backend\models\admin;

class Menu
{
//菜单的配制数据
    public static $ArrGoods = array(
        "商品管理" => array(
             "商品列表" => "admin/goodslist",
             "商品添加" => "admin/goodsadd",
             "评论列表" => "admin/commentlist",
        ),
        "会员管理" => array(
            "会员列表" => "admin/memberlist",
            "商家列表" => "admin/sellerlist",
            "专家列表" => "admin/expertlist",
        ),
        "订单管理" => array(
            "销售统计" => "admin/account",
            "订单列表" => "admin/orderlist",
            "退款列表" => "admin/refundmentlist",
        ),
        "预约管理" => array(
            "预约列表" => "admin/appointlist",
            "设置预约" => "admin/setappointment",
        ),
        "网站管理" => array(
            "关于聚仪" => "xyf/updateaboutjuyi",
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
