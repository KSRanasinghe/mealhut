<?php

include("config.php");
require "connection.php";
session_start();
date_default_timezone_set("Asia/Colombo");
$today = date("Y-m-d H:i:s");
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["m"])) {
    $member = $_SESSION["m"]["id"];
    $fname = $_SESSION["m"]["fname"];
    $address = $_SESSION["a"]["address_id"];
    $pickup = $_SESSION["p"];
    $token = $_POST["stripeToken"];
    $token_card_type = $_POST["stripeTokenType"];
    $email           = $_POST["stripeEmail"];
    $amount          = $_POST["amount"];
    $hname            = $_POST["hname"];

    if (!empty($hname) || (strlen($hname) > 5) && strlen($hname) < 45) {

        $uniqid = uniqid();
        $desc = $uniqid.$member;
        $charge = \Stripe\Charge::create([
            "amount" => str_replace(",", "", $amount) * 100,
            "currency" => 'lkr',
            "description" => $desc,
            "source" => $token,
        ]);

        if ($charge) {
            #cart update
            Database::push("UPDATE `cart_product` SET `confirmation_id` = '1', `order_id` = '".$desc."' 
            WHERE `cart_id` IN (SELECT `id` FROM `cart` WHERE `member_id` = '" . $member . "') AND `status_id` = '1' AND `confirmation_id` = '0'");
            #insert to invoice
            Database::push("INSERT INTO `invoice` (`member_id`,`address_id`,`datetime`,`unique_id`,`pickup_id`) VALUES(
                '" . $member . "','" . $address . "','" . $today . "','" . $desc . "','" . $pickup . "')");
            #select invoice id
            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `unique_id` = '" . $desc . "'");
            $invoice_data = $invoice_rs->fetch_assoc();
            $invoice_id = $invoice_data["id"];
            #search meal deatils and qty from car product
            $cart_rs = Database::search("SELECT
                `cart_product`.`meal_details_id`,
                `cart_product`.`qty`
            FROM
                `cart_product`
                INNER JOIN `cart` ON `cart_product`.`cart_id` = `cart`.`id`
            WHERE
                `cart`.`member_id` = '" . $member . "' 
                AND `cart_product`.`status_id` = '1' 
                AND `cart_product`.`confirmation_id` = '1' 
                AND `cart_product`.`order_id` = '".$desc."' ");
            #insert to invoice item
            $cart_num = $cart_rs->num_rows;
            for ($i = 0; $i < $cart_num; $i++) {
                $cart_data = $cart_rs->fetch_assoc();
                $meal_id = $cart_data["meal_details_id"];
                $qty = $cart_data["qty"];

                Database::push("INSERT INTO `invoice_item` (`meal_details_id`,`qty`,`invoice_id`) VALUES(
                    '" . $meal_id . "','" . $qty . "','" . $invoice_id . "')");
            }
            #insert to invoice payment
            Database::push("INSERT INTO `invoice_payment` (`payment`,`invoice_id`) VALUES(
                '" . $amount . "','" . $invoice_id . "')");
            #send email
            $paid = number_format($amount, 2);
            $paidTime = date("M d, Y, H:i:s A");
            $mail = new PHPMailer;
            $mail->IsSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'online.mealhut@gmail.com';
            $mail->Password = 'aoejeakehhtatibt';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('online.mealhut@gmail.com', 'MealHut Sri Lanka');
            $mail->addReplyTo('online.mealhut@gmail.com', 'MealHut Sri Lanka');
            $mail->addAddress($email, $fname);
            $mail->isHTML(true);
            $mail->Subject = 'Order Receipt - MealHut Sri Lanka';
            $bodyContent = '<!DOCTYPE HTML
            PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
          <html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
            xmlns:o="urn:schemas-microsoft-com:office:office">
          
          <head>
            <!--[if gte mso 9]>
          <xml>
            <o:OfficeDocumentSettings>
              <o:AllowPNG/>
              <o:PixelsPerInch>96</o:PixelsPerInch>
            </o:OfficeDocumentSettings>
          </xml>
          <![endif]-->
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta name="x-apple-disable-message-reformatting">
            <!--[if !mso]><!-->
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!--<![endif]-->
            <title></title>
          
            <style type="text/css">
              * {
                font-family: "Cabin", sans-serif;
              }
          
              @media only screen and (min-width: 620px) {
                .u-row {
                  width: 600px !important;
                }
          
                .u-row .u-col {
                  vertical-align: top;
                }
          
                .u-row .u-col-25p67 {
                  width: 154.02px !important;
                }
          
                .u-row .u-col-26p66 {
                  width: 159.96px !important;
                }
          
                .u-row .u-col-47p67 {
                  width: 286.02px !important;
                }
          
                .u-row .u-col-100 {
                  width: 600px !important;
                }
              }
          
              @media (max-width: 620px) {
                .u-row-container {
                  max-width: 100% !important;
                  padding-left: 0px !important;
                  padding-right: 0px !important;
                }
          
                .u-row .u-col {
                  min-width: 320px !important;
                  max-width: 100% !important;
                  display: block !important;
                }
          
                .u-row {
                  width: calc(100% - 40px) !important;
                }
          
                .u-col {
                  width: 100% !important;
                }
          
                .u-col>div {
                  margin: 0 auto;
                }
              }
          
              body {
                margin: 0;
                padding: 0;
              }
          
              table,
              tr,
              td {
                vertical-align: top;
                border-collapse: collapse;
              }
          
              p {
                margin: 0;
              }
          
              .ie-container table,
              .mso-container table {
                table-layout: fixed;
              }
          
              * {
                line-height: inherit;
              }
          
              a[x-apple-data-detectors="true"] {
                color: inherit !important;
                text-decoration: none !important;
              }
          
              table,
              td {
                color: #000000;
              }
            </style>
          
          
          
            <!--[if !mso]><!-->
            <link href="https://fonts.googleapis.com/css?family=Cabin:400,700" rel="stylesheet" type="text/css">
            <!--<![endif]-->
          
          </head>
          
          <body class="clean-body u_body"
            style="margin: 0;padding: 0;-webkit-text-size-adjust: 100%;background-color: #f9f9f9;color: #000000">
            <!--[if IE]><div class="ie-container"><![endif]-->
            <!--[if mso]><div class="mso-container"><![endif]-->
            <table
              style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;min-width: 320px;Margin: 0 auto;background-color: #f9f9f9;width:100%"
              cellpadding="0" cellspacing="0">
              <tbody>
                <tr style="vertical-align: top">
                  <td style="word-break: break-word;border-collapse: collapse !important;vertical-align: top">
                    <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #f9f9f9;"><![endif]-->
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div style="height: 100%;width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <h1
                                          style="margin: 0px; color: #188754; line-height: 100%; text-align: center; word-wrap: break-word; font-weight: normal;  font-size: 45px;">
                                          <strong>MealHut</strong>
                                        </h1>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div style="height: 100%;width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:6px;"
                                        >
          
                                        <h1
                                          style="margin: 0px; color: #222222; line-height: 130%; text-align: center; word-wrap: break-word; font-weight: normal;  font-size: 22px;">
                                          <strong>Receipt for your order</strong>
                                        </h1>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:8px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;">Order Id : '.$desc.'</p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div style="height: 100%;width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                          style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                          <tbody>
                                            <tr style="vertical-align: top">
                                              <td
                                                style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                <span>&#160;</span>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="160" style="width: 160px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-26p66"
                            style="max-width: 320px;min-width: 160px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <div style="color: #676b6b; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><strong><span
                                                style="font-size: 16px; line-height: 22.4px;">Amount Paid</span></strong></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:6px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><span
                                              style="font-size: 14px; line-height: 19.6px;">Rs.'.$paid.'</span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]><td align="center" width="286" style="width: 286px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-47p67"
                            style="max-width: 320px;min-width: 286px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <div style="color: #676b6b; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><strong><span
                                                style="font-size: 16px; line-height: 22.4px;">Date Paid</span></strong></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:6px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;">'.$paidTime.'</p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]><td align="center" width="154" style="width: 154px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-25p67"
                            style="max-width: 320px;min-width: 154px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <div style="color: #676b6b; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><strong><span
                                                style="font-size: 16px; line-height: 22.4px;">Payment Method</span></strong></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:6px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><span
                                              style="font-size: 14px; line-height: 19.6px;"><span
                                                style="line-height: 19.6px; font-size: 14px;">MOP-S</span></span>
                                          </p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <table height="0px" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                                          style="border-collapse: collapse;table-layout: fixed;border-spacing: 0;mso-table-lspace: 0pt;mso-table-rspace: 0pt;vertical-align: top;border-top: 1px solid #BBBBBB;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                          <tbody>
                                            <tr style="vertical-align: top">
                                              <td
                                                style="word-break: break-word;border-collapse: collapse !important;vertical-align: top;font-size: 0px;line-height: 0px;mso-line-height-rule: exactly;-ms-text-size-adjust: 100%;-webkit-text-size-adjust: 100%">
                                                <span>&#160;</span>
                                              </td>
                                            </tr>
                                          </tbody>
                                        </table>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <h1
                                          style="margin: 0px; color: #188754; line-height: 140%; text-align: center; word-wrap: break-word; font-weight: normal;  font-size: 22px;">
                                          <strong>Thank You for Visiting Us!</strong>
                                        </h1>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: transparent;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div
                              style="height: 100%;width: 100% !important;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:2px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;">Always choose good.
                                            We are MealHut Sri Lanka.</p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:16px;"
                                        >
          
                                        <div style="color: #222222; line-height: 140%; text-align: left; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 140%; text-align: center;"><span
                                              style="font-size: 12px; line-height: 16.8px;"><em><strong>Notice : Invoice was
                                                  created on a computer and is valid without the signature &amp;
                                                  seal.</strong></em></span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
          
                    <div class="u-row-container" style="padding: 0px;background-color: transparent">
                      <div class="u-row"
                        style="Margin: 0 auto;min-width: 320px;max-width: 600px;overflow-wrap: break-word;word-wrap: break-word;word-break: break-word;background-color: #198654;">
                        <div
                          style="border-collapse: collapse;display: table;width: 100%;height: 100%;background-color: transparent;">
                          <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #198654;"><![endif]-->
          
                          <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                          <div class="u-col u-col-100"
                            style="max-width: 320px;min-width: 600px;display: table-cell;vertical-align: top;">
                            <div style="height: 100%;width: 100% !important;">
                              <!--[if (!mso)&(!IE)]><!-->
                              <div
                                style="padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;">
                                <!--<![endif]-->
          
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" border="0">
                                  <tbody>
                                    <tr>
                                      <td
                                        style="overflow-wrap:break-word;word-break:break-word;padding:10px;"
                                        >
          
                                        <div
                                          style="color: #fafafa; line-height: 180%; text-align: center; word-wrap: break-word;">
                                          <p style="font-size: 14px; line-height: 180%;"><span
                                              style="font-size: 16px; line-height: 28.8px;">Copyrights © MealHut Sri Lanka. All
                                              Rights Reserved.</span></p>
                                        </div>
          
                                      </td>
                                    </tr>
                                  </tbody>
                                </table>
          
                                <!--[if (!mso)&(!IE)]><!-->
                              </div>
                              <!--<![endif]-->
                            </div>
                          </div>
                          <!--[if (mso)|(IE)]></td><![endif]-->
                          <!--[if (mso)|(IE)]></tr></table></td></tr></table><![endif]-->
                        </div>
                      </div>
                    </div>
          
          
                    <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                  </td>
                </tr>
              </tbody>
            </table>
            <!--[if mso]></div><![endif]-->
            <!--[if IE]></div><![endif]-->
          </body>
          
          </html>';
            $mail->Body    = $bodyContent;
            #re-direct to success page
            if ($mail->send()) {
                $_SESSION["a"] = null;
                header("Location:success.php");
            }
        } else {
            header("Location:cancel.php");
        }
    } else {
        header("Location:cancel.php");
    }
} else {
    header("Location:signIn.php");
}
