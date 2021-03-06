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
            "消息通知" => "shop-seller/messagelist",
            "基本信息" => "shop-seller/shopinfo",
            "详细信息" => "shop-seller/shopdetail",
            "修改密码" => "shop-seller/changepw",
            "QQ客服" => "shop-seller/onlineservice",
            "二维码"=>"shop-seller/qrcode",
        ),
    );

    public static $route2name = array(
        "shop-seller/sellerhome"            =>      "管理首页",
        "shop-seller/account"               =>      "销售额统计",
        "shop-seller/goodslist"             =>      "商品列表",
        "shop-seller/goodsadd"              =>      "添加商品",
        "shop-seller/comment"               =>      "商品评价",
        "shop-seller/consult"               =>      "商品咨询",
        "shop-seller/appointinfo"           =>      "预约列表",
        "shop-seller/setappointment"        =>      "设置预约",
        "shop-seller/order"                 =>      "订单列表",
        "shop-seller/refundment"            =>      "退款记录",
        "shop-seller/shopinfo"              =>      "基本信息",
        "shop-seller/shopdetail"            =>      "详细信息",
        "shop-seller/onlineservice"         =>      "QQ客服",
        "shop-seller/changepw"              =>      "修改密码",
        "shop-seller/qrcode"                =>      "二维码",
    );
    /**
     * @brief 根据权限初始化菜单
     * @param int $roleId 角色ID
     * @return array 菜单数组
     */
    public static function getMenu($shopType = "seller")
    {
        //菜单创建事件触发
        $arr = self::$menu;
        if($shopType != 'seller') {
            unset($arr['预约模块']);
        }
        if($shopType != 'expert'){
            unset($arr['配置模块']['二维码']);
        }

        return $arr;
    }

    public static function getRoute2name($route){
        $name = isset(self::$route2name[$route]) ? self::$route2name[$route] : '后台';
        return $name;
    }
}
