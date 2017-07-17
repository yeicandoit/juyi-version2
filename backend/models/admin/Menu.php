<?php
namespace backend\models\admin;

class Menu
{
//菜单的配制数据
    public static $ArrGoods = array(
        "网站管理" => array(
            "后台首页" => "admin/adminhome",
            "关于聚仪" => "xyf/updateaboutjuyi",
            "权限管理" => "sysadmin/",
        ),
        "商品管理" => array(
             "商品列表" => "admin/goodslist",
             "商品添加" => "admin/goodsadd",
             "评论列表" => "admin/commentlist",
             "咨询列表" => 'admin/consultlist',
        ),
        "会员管理" => array(
            "会员列表" => "admin/memberlist",
            "商家列表" => "admin/sellerlist",
            "专家列表" => "admin/expertlist",
        ),
        "订单管理" => array(
            "销售统计" => "admin/account",
            "订单列表" => "admin/orderlist",
            "完成订单" => "admin/orderok",
            "退款列表" => "admin/refundmentlist",
        ),
        "预约管理" => array(
            "预约列表" => "admin/appointlist",
            "设置预约" => "admin/setappointment",
        ),
        "新闻资讯" => array(
            "新闻发布" => "admin/announcenews",
            "新闻管理" => "admin/managenews",
            "资讯发布" => "admin/setinformation",
            "资讯管理" => "admin/manageinformation",
        ),
        "广告设置" => array(
            "热门设置" => "admin/hot",
        ),
    );

    public static $route2name = array(
        "admin/adminhome"           =>      "后台首页",
        "xyf/updateaboutjuyi"       =>      "关于聚仪",
        "admin/goodslist"           =>      "商品列表",
        "admin/goodsadd"            =>      "商品添加",
        "admin/commentlist"         =>      "评论列表",
        'admin/consultlist'         =>      "咨询列表",
        "admin/memberlist"          =>      "会员列表",
        "admin/sellerlist"          =>      "商家列表",
        "admin/expertlist"          =>      "专家列表",
        "admin/account"             =>      "销售统计",
        "admin/orderlist"           =>      "订单列表",
        "admin/orderok"             =>      "完成订单",
        "admin/refundmentlist"      =>      "退款列表",
        "admin/appointlist"         =>      "预约列表",
        "admin/setappointment"      =>      "设置预约",
        "admin/announcenews"        =>      "新闻发布",
        "admin/managenews"          =>      "新闻管理",
        "admin/setinformation"      =>      "资讯发布",
        "admin/manageinformation"   =>      "资讯管理",
        "admin/hot"                 =>      "热门设置",
        "admin/goodsedit"           =>      "商品编辑",
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

    public static function getRoute2name($route){
        $name = isset(self::$route2name[$route]) ? self::$route2name[$route] : '后台';
        return $name;
    }
}
