<?php

require "connection.php";
require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


$email = $_GET["e"];

if(!empty($email)){


    $resultset = Database::search("SELECT * FROM `member` WHERE `email`='".$email."'");
    $n = $resultset -> num_rows;

    if($n == 1){
        $mid = $resultset -> fetch_assoc();
        $fname = $mid["fname"];
        $vc = uniqid();
        $code = substr($vc,5);
        
        Database::push("UPDATE `member_account` SET `verify_code`='".$code."'
        WHERE `member_id`='".$mid["id"]."'");

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
            $mail->addAddress($email,$fname); 
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset - MealHut My Account'; 
            $bodyContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html
              xmlns="http://www.w3.org/1999/xhtml"
              xmlns:v="urn:schemas-microsoft-com:vml"
              xmlns:o="urn:schemas-microsoft-com:office:office"
            >
              <head>
                <!--[if gte mso 9]>
                  <xml>
                    <o:OfficeDocumentSettings>
                      <o:AllowPNG />
                      <o:PixelsPerInch>96</o:PixelsPerInch>
                    </o:OfficeDocumentSettings>
                  </xml>
                <![endif]-->
                <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                <meta name="viewport" content="width=device-width, initial-scale=1.0" />
                <meta name="x-apple-disable-message-reformatting" />
                <!--[if !mso]><!-->
                <meta http-equiv="X-UA-Compatible" content="IE=edge" />
                <!--<![endif]-->
                <title></title>
            
                <style type="text/css">
                  @media only screen and (min-width: 620px) {
                    .u-row {
                      width: 600px !important;
                    }
                    .u-row .u-col {
                      vertical-align: top;
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
                    .u-col > div {
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
                <link
                  href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap"
                  rel="stylesheet"
                  type="text/css"
                />
                <link
                  href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700&display=swap"
                  rel="stylesheet"
                  type="text/css"
                />
                <!--<![endif]-->
              </head>
            
              <body
                class="clean-body u_body"
                style="
                  margin: 0;
                  padding: 0;
                  -webkit-text-size-adjust: 100%;
                  background-color: #f9f9f9;
                  color: #000000;
                "
              >
                <!--[if IE]><div class="ie-container"><![endif]-->
                <!--[if mso]><div class="mso-container"><![endif]-->
                <table
                  style="
                    border-collapse: collapse;
                    table-layout: fixed;
                    border-spacing: 0;
                    mso-table-lspace: 0pt;
                    mso-table-rspace: 0pt;
                    vertical-align: top;
                    min-width: 320px;
                    margin: 0 auto;
                    background-color: #f9f9f9;
                    width: 100%;
                  "
                  cellpadding="0"
                  cellspacing="0"
                >
                  <tbody>
                    <tr style="vertical-align: top">
                      <td
                        style="
                          word-break: break-word;
                          border-collapse: collapse !important;
                          vertical-align: top;
                        "
                      >
                        <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color: #f9f9f9;"><![endif]-->
            
                        <div
                          class="u-row-container"
                          style="padding: 0px; background-color: transparent"
                        >
                          <div
                            class="u-row"
                            style="
                              margin: 0 auto;
                              min-width: 320px;
                              max-width: 600px;
                              overflow-wrap: break-word;
                              word-wrap: break-word;
                              word-break: break-word;
                              background-color: #ffffff;
                            "
                          >
                            <div
                              style="
                                border-collapse: collapse;
                                display: table;
                                width: 100%;
                                background-color: transparent;
                              "
                            >
                              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: #ffffff;"><![endif]-->
            
                              <!--[if (mso)|(IE)]><td align="center" width="600" style="width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;" valign="top"><![endif]-->
                              <div
                                class="u-col u-col-100"
                                style="
                                  max-width: 320px;
                                  min-width: 600px;
                                  display: table-cell;
                                  vertical-align: top;
                                "
                              >
                                <div style="width: 100% !important">
                                  <!--[if (!mso)&(!IE)]><!--><div
                                    style="
                                      padding: 0px;
                                      border-top: 0px solid transparent;
                                      border-left: 0px solid transparent;
                                      border-right: 0px solid transparent;
                                      border-bottom: 0px solid transparent;
                                    "
                                  ><!--<![endif]-->
                                    <table
                                      style="font-family: Lato, sans-serif"
                                      role="presentation"
                                      cellpadding="0"
                                      cellspacing="0"
                                      width="100%"
                                      border="0"
                                    >
                                      <tbody>
                                        <tr>
                                          <td
                                            style="
                                              overflow-wrap: break-word;
                                              word-break: break-word;
                                              padding: 40px 40px 5px;
                                              font-family: Lato, sans-serif;
                                            "
                                            align="left"
                                          >
                                            <div
                                              style="
                                                line-height: 120%;
                                                text-align: left;
                                                word-wrap: break-word;
                                              "
                                            >
                                              <p style="font-size: 14px; line-height: 120%">
                                                <span
                                                  style="
                                                    font-size: 18px;
                                                    line-height: 21.6px;
                                                    color: #666666;
                                                  "
                                                  >Hi,</span
                                                >
                                              </p>
                                              <p style="font-size: 14px; line-height: 120%">
                                                 
                                              </p>
                                              <p style="font-size: 14px; line-height: 120%">
                                                <span
                                                  style="
                                                    font-size: 18px;
                                                    line-height: 21.6px;
                                                    color: #666666;
                                                  "
                                                  >Your MealHut password reset code
                                                  is,</span
                                                >
                                              </p>
                                              <p style="font-size: 14px; line-height: 120%">
                                                 
                                              </p>
                                              <p style="font-size: 14px; line-height: 120%">
                                                <span
                                                  style="
                                                    font-size: 24px;
                                                    line-height: 28.8px;
                                                  "
                                                  ><strong
                                                    ><span
                                                      style="
                                                        line-height: 28.8px;
                                                        color: #666666;
                                                        font-size: 24px;
                                                      "
                                                      >'.$code.'</span
                                                    ></strong
                                                  ></span
                                                >
                                              </p>
                                            </div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
            
                                    <table
                                      style="font-family: Lato, sans-serif"
                                      role="presentation"
                                      cellpadding="0"
                                      cellspacing="0"
                                      width="100%"
                                      border="0"
                                    >
                                      <tbody>
                                        <tr>
                                          <td
                                            style="
                                              overflow-wrap: break-word;
                                              word-break: break-word;
                                              padding: 30px 40px 10px;
                                              font-family: Lato, sans-serif;
                                            "
                                            align="left"
                                          >
                                            <div
                                              style="
                                                line-height: 130%;
                                                text-align: left;
                                                word-wrap: break-word;
                                              "
                                            >
                                              <p style="line-height: 130%; font-size: 14px">
                                                <span
                                                  style="
                                                    color: #888888;
                                                    font-size: 14px;
                                                    line-height: 18.2px;
                                                  "
                                                  ><span
                                                    style="
                                                      font-size: 16px;
                                                      line-height: 20.8px;
                                                    "
                                                    ><em
                                                      >If you do not want to change your
                                                      password or did not request this,
                                                      please ignore &amp; delete this
                                                      message.</em
                                                    ></span
                                                  ></span
                                                >
                                              </p>
                                              <p style="line-height: 130%; font-size: 14px">
                                                 
                                              </p>
                                              <p style="line-height: 130%; font-size: 14px">
                                                <span
                                                  style="
                                                    font-size: 18px;
                                                    color: #888888;
                                                    line-height: 23.4px;
                                                  "
                                                  ><span
                                                    style="
                                                      line-height: 23.4px;
                                                      font-size: 18px;
                                                    "
                                                    >Thank you! </span
                                                  ></span
                                                >
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
            
                        <div
                          class="u-row-container"
                          style="padding: 0px; background-color: transparent"
                        >
                          <div
                            class="u-row"
                            style="
                              margin: 0 auto;
                              min-width: 320px;
                              max-width: 600px;
                              overflow-wrap: break-word;
                              word-wrap: break-word;
                              word-break: break-word;
                              background-color: transparent;
                            "
                          >
                            <div
                              style="
                                border-collapse: collapse;
                                display: table;
                                width: 100%;
                                background-color: transparent;
                              "
                            >
                              <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding: 0px;background-color: transparent;" align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:600px;"><tr style="background-color: transparent;"><![endif]-->
            
                              <!--[if (mso)|(IE)]><td align="center" width="600" style="background-color: #ffffff;width: 600px;padding: 0px;border-top: 0px solid transparent;border-left: 0px solid transparent;border-right: 0px solid transparent;border-bottom: 0px solid transparent;border-radius: 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;" valign="top"><![endif]-->
                              <div
                                class="u-col u-col-100"
                                style="
                                  max-width: 320px;
                                  min-width: 600px;
                                  display: table-cell;
                                  vertical-align: top;
                                "
                              >
                                <div
                                  style="
                                    background-color: #ffffff;
                                    width: 100% !important;
                                    border-radius: 0px;
                                    -webkit-border-radius: 0px;
                                    -moz-border-radius: 0px;
                                  "
                                >
                                  <!--[if (!mso)&(!IE)]><!--><div
                                    style="
                                      padding: 0px;
                                      border-top: 0px solid transparent;
                                      border-left: 0px solid transparent;
                                      border-right: 0px solid transparent;
                                      border-bottom: 0px solid transparent;
                                      border-radius: 0px;
                                      -webkit-border-radius: 0px;
                                      -moz-border-radius: 0px;
                                    "
                                  ><!--<![endif]-->
                                    <table
                                      style="font-family: Lato, sans-serif"
                                      role="presentation"
                                      cellpadding="0"
                                      cellspacing="0"
                                      width="100%"
                                      border="0"
                                    >
                                      <tbody>
                                        <tr>
                                          <td
                                            style="
                                              overflow-wrap: break-word;
                                              word-break: break-word;
                                              padding: 10px 10px 10px 40px;
                                              font-family: Lato, sans-serif;
                                            "
                                            align="left"
                                          >
                                            <div
                                              style="
                                                line-height: 140%;
                                                text-align: left;
                                                word-wrap: break-word;
                                              "
                                            >
                                              <p style="font-size: 14px; line-height: 140%">
                                                <span
                                                  style="
                                                    font-size: 48px;
                                                    line-height: 67.2px;
                                                    font-family: arial black,
                                                      avant garde, arial;
                                                  "
                                                  ><span
                                                    style="
                                                      color: #198754;
                                                      font-size: 48px;
                                                      line-height: 67.2px;
                                                    "
                                                    >M</span
                                                  >eal<span
                                                    style="
                                                      color: #198754;
                                                      font-size: 48px;
                                                      line-height: 67.2px;
                                                    "
                                                    >H</span
                                                  >ut<span
                                                    style="
                                                      color: #198754;
                                                      font-size: 48px;
                                                      line-height: 67.2px;
                                                    "
                                                    ><strong
                                                      ><span
                                                        style="
                                                          font-family: Source Sans Pro,
                                                            sans-serif;
                                                          line-height: 67.2px;
                                                          font-size: 48px;
                                                        "
                                                        >.</span
                                                      ></strong
                                                    ></span
                                                  ></span
                                                >
                                              </p>
                                              <p style="font-size: 14px; line-height: 140%">
                                                <span
                                                  style="
                                                    font-size: 16px;
                                                    line-height: 22.4px;
                                                    font-family: arial black,
                                                      avant garde, arial;
                                                  "
                                                  ><span
                                                    style="
                                                      color: #198754;
                                                      line-height: 22.4px;
                                                      font-size: 16px;
                                                    "
                                                    ><strong
                                                      ><span
                                                        style="
                                                          font-family: Source Sans Pro,
                                                            sans-serif;
                                                          line-height: 22.4px;
                                                          font-size: 16px;
                                                        "
                                                        ><span
                                                          style="
                                                            color: #7e8c8d;
                                                            font-size: 16px;
                                                            line-height: 22.4px;
                                                          "
                                                          >MealHut Sri Lanka</span
                                                        ></span
                                                      ></strong
                                                    ></span
                                                  ></span
                                                >
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
            
                        <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                      </td>
                    </tr>
                  </tbody>
                </table>
                <!--[if mso]></div><![endif]-->
                <!--[if IE]></div><![endif]-->
              </body>
            </html>
            '; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo "fail";
            } else {
                echo "success";
            }

    }else{
        echo "error";
    }

}else{
    echo "Email addres is empty.";
}

?>