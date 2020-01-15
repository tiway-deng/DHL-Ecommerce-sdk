<?php

namespace Tiway\DhlEcommerce\Core;


class ConstantManager
{
    //沙箱
    const SANDBOX_HOST = "https://sandbox.dhlecommerce.asia";
    //生产
    const PRO_HOST = "https://api.dhlecommerce.dhl.com";
    //URI
    const GET_TOKEN = "/rest/v1/OAuth/AccessToken";
    const GET_LABEL = "/rest/v2/Label";
    const SANDBOX_LABEL_REPRINT = "/rest/v2.Label.Reprint";
    const PRO_LABEL_REPRINT = "/rest/v2.Label/Reprint";
    const TRACKING = "/rest/v2/Tracking";
}