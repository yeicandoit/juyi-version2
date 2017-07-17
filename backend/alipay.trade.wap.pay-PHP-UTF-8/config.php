<?php
$config = array (	
		//应用ID,您的APPID。
		'app_id' => "2016080601712404",

		//商户私钥
		
		'merchant_private_key' => "MIICXAIBAAKBgQCs16L2N4ZiEQyIEhoHz/cSMlZ4q6+eqkuIR59rINvVz4QYptVRPO1Mmf6wGksP5oM+RcEt84ZJX5ueUeRtCl+9wWHYSEIDY4tGeOHSoCWtLR+mB+5EdvhGMAXpqnatw3x+r8lIxV55WmaHk2YN8K+myPkcpM45wUxabzVmJzyVYQIDAQABAoGAAtyLESJ4MhVwLKyIC8sQnxeAQP0uqiTNnVL6O67OlOqbmEDi1TZ6A0OlaMr2pSu+zoAfI6Cdf4d6rxNSAdAjJ50cyimI5y1BvjRUBnxejXR9wbS5G6DPGuEWe7/JXCKhyN2cr0yHVbUn0SWkxVhgYxLHUMUlDdjcH5QcbS/IokUCQQDaCozNl9MsUe7NlXBngHZdcHDDrMBcfNyrOrhs+X5pKiyxXZ8LfvVHLH3af9heot9GaMZ05ePjIrRFd8fgFVUDAkEAyu603rCgfNi7dPoVNc4S7/V5GwJvmIodQ1n6M424M+GoQYjw7lbZIqzfJL7PIr9IiF7lD5/m/n58WHTgh19kywJAKpNWzSpxTL0u8SvWCA/YjQRQsJTB9w1WlYTg0D6jhWt70KJkVP1UbbJtXMYL/Oa2zGvXHKprJkX3h30NJV9k+wJARwLSzd42uplIt31PcL2EyO04DKiEjnc+GDRjJikgXR9Itm4KCQzg/I5Lo1sVto4C/p1eQGJu/X0bXATCEPzjkwJBAKIsZEwFcfv8BECsn4gKxwLZSZQD08vgX1tW2eD7ZWcocNg/jqpYH8A9ZwawmDHzhUE72p6YmZLrqDZFEcC0XSE=",
		//异步通知地址
		'notify_url' => "https://www.juyitest.com/alipay.trade.page.pay-PHP-UTF-8/notify_url.php",
		
		//同步跳转
		'return_url' => "https://www.juyitest.com/alipay.trade.page.pay-PHP-UTF-8/return_url.php",

		//编码格式
		'charset' => "UTF-8",

		//签名方式
		'sign_type'=>"RSA2",

		//支付宝网关
		'gatewayUrl' => "https://openapi.alipay.com/gateway.do",

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
		'alipay_public_key' => "MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQCs16L2N4ZiEQyIEhoHz/cSMlZ4q6+eqkuIR59rINvVz4QYptVRPO1Mmf6wGksP5oM+RcEt84ZJX5ueUeRtCl+9wWHYSEIDY4tGeOHSoCWtLR+mB+5EdvhGMAXpqnatw3x+r8lIxV55WmaHk2YN8K+myPkcpM45wUxabzVmJzyVYQIDAQAB",
		
);