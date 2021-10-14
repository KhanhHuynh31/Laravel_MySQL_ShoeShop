<?php

return [
    // Cấu hình cho các cổng thanh toán tại hệ thống của bạn, các cổng không xài có thể xóa cho gọn hoặc không điền.
    // Các thông số trên có được khi bạn đăng ký tích hợp.

    'gateways' => [
        'MoMoAIO' => [
            'driver' => 'MoMo_AllInOne',
            'options' => [
                'accessKey' => 'ZoZzvI5G2CKfEaD9',
                'secretKey' => 'vioyjZQtAepxT58RcwC4ftjxZEhU90LJ',
                'partnerCode' => 'MOMOGIGV20211005',
                'testMode' => false,
            ],
        ],
        'MoMoQRCode' => [
            'driver' => 'MoMo_QRCode',
            'options' => [
                'accessKey' => 'ZoZzvI5G2CKfEaD9',
                'secretKey' => 'vioyjZQtAepxT58RcwC4ftjxZEhU90LJ',
                'partnerCode' => 'MOMOGIGV20211005',
                'testMode' => false,
            ],
        ],
        'MoMoAIA' => [
            'driver' => 'MoMo_AppInApp',
            'options' => [
                'accessKey' => 'ZoZzvI5G2CKfEaD9',
                'secretKey' => 'vioyjZQtAepxT58RcwC4ftjxZEhU90LJ',
                'partnerCode' => 'MOMOGIGV20211005',
                'testMode' => false,
            ],
        ],
        'MoMoPOS' => [
            'driver' => 'MoMo_POS',
            'options' => [
                'accessKey' => '',
                'secretKey' => '',
                'partnerCode' => '',
                'publicKey' => '',
                'testMode' => false,
            ],
        ],
        'OnePayDomestic' => [
            'driver' => 'OnePay_Domestic',
            'options' => [
                'vpcMerchant' => '',
                'vpcAccessCode' => '',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => '',
                'testMode' => false,
            ],
        ],
        'OnePayInternational' => [
            'driver' => 'OnePay_International',
            'options' => [
                'vpcMerchant' => '',
                'vpcAccessCode' => '',
                'vpcUser' => '',
                'vpcPassword' => '',
                'vpcHashKey' => '',
                'testMode' => false,
            ],
        ],
        'VTCPay' => [
            'driver' => 'VTCPay',
            'options' => [
                'websiteId' => '',
                'securityCode' => '',
                'testMode' => false,
            ],
        ],
        'VNPay' => [
            'driver' => 'VNPay',
            'options' => [
                'vnpTmnCode' => '',
                'vnpHashSecret' => '',
                'testMode' => false,
            ],
        ],
    ],
];
