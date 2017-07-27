<?php
/* *
 * 功能：支付宝手机网站退款接口(alipay.trade.refund)接口业务参数封装
 * 版本：2.0
 * 修改日期：2016-11-01
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 */


class AlipayFundTransferContentBuilder
{

    // 商户转账订单号.
    private $outBizNo;

    // 收款方账户类型
    private $payeeType;

    // 收款方账户
    private $payeeAccount;

    // 转账金额
    private $amount;

    // 付款方姓名
    private $payerShowName;

    // 收款方真实姓名
    private $payeeRealName;

    //转账备注
    private $remark;

    private $bizContentarr = array();

    private $bizContent = NULL;

    public function getBizContent()
    {
        if(!empty($this->bizContentarr)){
            $this->bizContent = json_encode($this->bizContentarr,JSON_UNESCAPED_UNICODE);
        }
        return $this->bizContent;
    }

    public function getOutBizNo()
    {
        return $this->outBizNo;
    }

    public function setOutBizNo($outBizNo)
    {
        $this->outBizNo = $outBizNo;
        $this->bizContentarr['out_biz_no'] = $outBizNo;
    }

    public function getPayeeType()
    {
        return $this->payeeType;
    }

    public function setPayeeType($payeeType)
    {
        $this->payeeType = $payeeType;
        $this->bizContentarr['payee_type'] = $payeeType;
    }

    public function getPayeeAccount()
    {
        return $this->payeeAccount;
    }

    public function setPayeeAccount($payeeAccount)
    {
        $this->payeeAccount = $payeeAccount;
        $this->bizContentarr['payee_account'] = $payeeAccount;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount = $amount;
        $this->bizContentarr['amount'] = $amount;
    }

    public function getPayerShowName()
    {
        return $this->payerShowName;
    }

    public function setPayerShowName($payerShowName)
    {
        $this->payerShowName = $payerShowName;
        $this->bizContentarr['payer_show_name'] = $payerShowName;
    }

    public function getPayeeRealName()
    {
        return $this->payeeRealName;
    }

    public function setPayeeRealName($payeeRealName)
    {
        $this->payeeRealName = $payeeRealName;
        $this->bizContentarr['payee_real_name'] = $payeeRealName;
    }

    public function getRemark()
    {
        return $this->remark;
    }

    public function setRemark($remark)
    {
        $this->remark = $remark;
        $this->bizContentarr['remark'] = $remark;
    }
}
?>