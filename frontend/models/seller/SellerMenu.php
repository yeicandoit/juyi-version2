<?php
namespace frontend\models\seller;

class SellerMenu
{
//菜单的配制数据
    public static $menu = array(
        "统计结算模块" => array(
             "管理首页" => "/index.php?r=shop-seller/sellerhome",
             "销售额统计" => "/index.php?r=shop-seller/account",
        ),

        "商品模块" => array(
             "商品列表" => "/index.php?r=shop-seller/goodslist",
             "添加商品" => "/index.php?r=shop-seller/goodsadd",
             "商品咨询" => "/ucenter/consult",
             "商品评价" => "/index.php?r=shop-seller/comment",
             "商品退款" => "/index.php?r=shop-seller/refundment",
             "规格列表" => "/index.php?r=shop-seller/speclist",
        ),

        "订单模块" => array(
            "订单列表" => "/index.php?r=shop-seller/order" ,
        ),

        "配置模块" => array(
            "物流配送" => "/index.php?r=shop-seller/delivery",
            "消息通知" => "/index.php?r=site/userrecharge",
            "发货地址" => "/index.php?r=shop-seller/merchship",
            "资料修改" => "/index.php?r=shop-seller/sellerinfo",
            "QQ客服" => "/index.php?r=site/userrecharge",
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