<?php
namespace backend\models\admin;

class Menu
{
//菜单的配制数据
    public static $ArrMenu = array(
        "系统" => array(
            "网站管理" => array(
                "后台首页" => "admin/adminhome",
                "关于聚仪" => "xyf/updateaboutjuyi",
                "品牌管理" => "admin/brandlist",
                "论坛管理" => "admin/forum",
            ),
            "广告设置" => array(
                "热门设置" => "admin/hot",
                "添加广告位" => "admin/adpos",
                "查看广告位" => "admin/adposlist",
                "添加广告" => "admin/ad",
                "查看广告" => "admin/adlist",
            ),
            "新闻资讯" => array(
                "新闻发布" => "admin/announcenews",
                "新闻管理" => "admin/managenews",
                "资讯发布" => "admin/setinformation",
                "资讯管理" => "admin/manageinformation",
            ),
            "消息管理" => array(
                "消息发布" => "admin/addmessage",
                "消息管理" => "admin/messagelist",
            ),
        ),
        "商品" => array(
            "商品管理" => array(
                 "商品列表" => "admin/goodslist",
                 "商品添加" => "admin/goodsadd",
                 "评论列表" => "admin/commentlist",
                 "咨询列表" => 'admin/consultlist',
            ),
        ),
        "会员" => array(
            "会员管理" => array(
                "会员列表" => "admin/memberlist",
                "检测中心" => "admin/sellerlist",
                "专家列表" => "admin/expertlist",
                "科研辅助" => "admin/researchlist",
                "数值模拟" => "admin/simulatelist",
            ),
        ),
        "订单" => array(
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
        ),
        "账户" => array(
            "账户管理" => array(
                "添加管理员" => "addadmin",
                "权限管理" => "sysadmin/",
            ),
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
        "admin/sellerlist"          =>      "检测中心",
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
        "admin/adpos"               =>      "添加广告位",
        "admin/adposlist"           =>      "查看广告位",
        "admin/ad"                  =>      "添加广告",
        "admin/adlist"              =>      "查看广告",
        "admin/goodsedit"           =>      "商品编辑",
        "admin/brandlist"           =>      "品牌管理",
        "admin/addmessage"          =>      "消息发布",
        "admin/messagelist"         =>      "消息管理",
        "admin/researchlist"        =>      "科研辅助",
        "admin/simulatelist"        =>      "数值模拟",
        "admin/forum"               =>      "论坛管理",
        "admin/addadmin"            =>      "添加管理员",

    );

    public static $Cate2Url = array(
        "系统" => "admin/adminhome",
        "商品" => "admin/goodslist",
        "会员" => "admin/memberlist",
        "订单" => "admin/account",
        "账户" => "admin/addadmin",
    );

    public static $Url2Cate = array(
        "admin/adminhome"   =>  "系统",
        "admin/goodslist"   =>  "商品",
        "admin/memberlist"  =>  "会员",
        "admin/account"     =>  "订单",
        "admin/addadmin"    =>  "账户",
    );

    public static $ArrPartMenu = array(
        'managenews' => array(
            "新闻资讯" => array(
                "新闻发布" => "admin/announcenews",
                "新闻管理" => "admin/managenews",
                "资讯发布" => "admin/setinformation",
                "资讯管理" => "admin/manageinformation",
            ),
        ),
    );

    public static $ArrPartShow = array(
        'mnews' => 'managenews',
    );

    public static function getMenu($cate=null)
    {
        //菜单创建事件触发
        if(isset($cate)) {
            $menu = isset(self::$ArrMenu[$cate]) ? self::$ArrMenu[$cate] : '系统';
            return $menu;
        } else {
            return self::$ArrMenu;
        }
    }

    public static function getCate2Url($cate=null)
    {
        if($cate) {
            $url = isset(self::$Cate2Url[$cate]) ? self::$Cate2Url[$cate] : "admin/adminhome";
            return $url;
        } else {
          return self::$Cate2Url;
        }
    }

    public static function getRoute2name($route){
        $name = isset(self::$route2name[$route]) ? self::$route2name[$route] : '后台';
        return $name;
    }

    public static function getUrl2Cate($route){
        $cate = isset(self::$Url2Cate[$route]) ? self::$Url2Cate[$route] : null;
        return $cate;
    }
}
