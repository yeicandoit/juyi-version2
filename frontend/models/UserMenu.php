<?php
namespace frontend\models;

class UserMenu
{
//菜单的配制数据
    public static $menu = array(
        "交易记录" => array(
             "我的订单" => "/index.php?r=site/userorder",
             "我的积分" => "/index.php?r=site/userscore",
             "我的代金券" => "/ucenter/redpacket",
        ),

        "服务中心" => array(
             "退款申请" => "/ucenter/refunds",
             "站点建议" => "/index.php?r=site/userrecom",
             "商品咨询" => "/ucenter/consult",
             "商品评价" => "/ucenter/evaluation",
        ),

        "应用" => array(
            "短信息" => "/ucenter/message" ,
            "收藏夹" => "/index.php?r=site/userfavorite",
        ),

        "账户资金" => array(
             "帐户余额" => "/index.php?r=site/useraccount",
             "在线充值" => "/index.php?r=site/userrecharge",
        ),

        "个人设置" => array(
             "地址管理" => "/index.php?r=site/useraddr",
            "个人资料" => "/index.php?r=site/userinfo",
             "修改密码" => "/index.php?r=site/userchpwd",
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