<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="initial-scale=1.0"/>
    <meta name="format-detection" content="telephone=no"/>
    <title><?php echo $title; ?></title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css?family=Open+Sans:400,300,600&subset=latin,cyrillic');
        html,body {
            background-color: #fff;
            margin:0;
            padding:0;
        }
        html {
            width:100%;
        }
        body {
            margin:0;
            padding:0;
            -webkit-text-size-adjust:none;
            -ms-text-size-adjust:none;
        }
        table {
            border-spacing:0;
            border-collapse:collapse;
        }
        table td {
            border-collapse:collapse;
        }
        table tr {
            border-collapse:collapse;
        }
        img {
            display:block!important;
        }
        br,strong br,b br,em br,i br {
            line-height:100%;
        }
        a {
            color: inherit;
            text-decoration: underline;
        }
        a:hover {
            text-decoration: none;
        }
        .button a {
            font-size:14px;
            font-family: 'Open Sans', sans-serif;
            color:#fff;
            font-weight:300;
            background:transparent;
        }
        @media only screen and (max-width: 640px) {
            body {
                width:auto!important;
            }
            table[class="col1"] {
                width:29%;
            }
            table[class="col2"] {
                width:47%;
                text-align:left;
            }
            table[class="col3_one"] {
                width:64%;
                text-align:left;
            }
            table[class="col3"] {
                width:100%;
                text-align:center;
            }
            table[class="col-600"] {
                width:450px;
            }
            table[class="insider"] {
                width:90%;
            }
            img[class="images_style"] {
                width:60%;
                height:auto;
            }
            .margin{
                margin-left: 25px;
                margin-right: 25px;
            }
        }
        @media only screen and (max-width: 480px) {
            .text-size-20 {
                font-size: 20px !important;
            }
            .text-size-14 {
                font-size: 14px !important;
            }
            body {
                width:auto!important;
            }
            table[class="col1"] {
                width:100%;
            }
            table[class="col2"] {
                width:100%;
                text-align:left;
            }
            table[class="col3"] {
                width:100%;
                text-align:center;
            }
            table[class="col3_one"] {
                width:80%;
                text-align:center;
                margin: 0 20px 0 0;
            }
            table[class="col-600"] {
                width:280px;
                margin:0 !important;
            }
            table[class="insider"] {
                width:82%!important;
            }
            img[class="images-style"] {
                width:60%;
            }
            .button { width: 40%; display: block; }
            a.read-more { text-align: center; display: block;}

        }
        /* OUTLOOK CLASS*/
        .ExternalClass {
            background-color:#fff;
            width:100%;
        }
        .ExternalClass,.ExternalClass font,.ExternalClass td,.ExternalClass p,.ExternalClass span,.ExternalClass div {
            line-height:100%;
        }
        .ReadMsgBody {
            width:100%;
            background-color:#fff;
        }
        /* YAHOO MAIL CLASS */
        .yshortcuts,.yshortcuts a,.yshortcuts a:link,.yshortcuts a:visited,.yshortcuts a:hover,.yshortcuts a span {
            border-bottom:none!important;
        }
        /* MAILCHIMP CLASS */
        .default-edit-image {
            height:20px;
        }
    </style>
    <meta name="robots" content="noindex,follow" />
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
    <!-- START HEADER/BANNER -->
    <tr>
        <td align="center">
            <table class="col-600" width="600" height="70" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" style="font-size:16px; font-weight:800; color:#333; text-transform:uppercase; text-align:center;"><?php echo $text_welcome; ?></td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="col-600" width="600" h border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" valign="top" background="<?php echo $mail_background; ?>" bgcolor="<?php echo $color_background; ?>" style="color:<?php echo $color_text; ?>; background-size:cover; background-position:top;" height="200">
                        <table class="col-600" width="600" height="50" border="0" align="center" cellpadding="0" cellspacing="0">



                            <tr>
                                <td align="center" style="line-height: 0px; padding-top: 20px;">
                                    <img style="display:block; line-height:0px; font-size:0px; border:0px; width: 80px; height: auto;" src="<?php echo $mail_logo; ?>" alt="<?php echo $store_name; ?>" />
                                </td>
                            </tr>




                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- END HEADER/BANNER -->

    <!-- START SHOWCASE -->
    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="margin-left:20px; margin-right:20px; border-bottom:1px solid #e5e5e5;">
                <tbody>

                <tr>
                    <td align="center" style="font-family: 'Open Sans', sans-serif; font-size:18px; font-weight: bold; color:#ffcc00; text-transform:uppercase;"><?php echo $text_welcome_2; ?></td>
                </tr>

                <tr>
                    <td height="15"></td>
                </tr>

                <tr>
                    <td align="center" style="font-family: 'Open Sans', sans-serif; font-size:14px; color:#333; line-height:1.4; padding: 0 15px;"><?php echo $text_message; ?></td>
                </tr>
                <tr>
                    <td height="25"></td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="background: #fff; color:<?php echo $color_text; ?>;">
                <tbody>
                    <tr>
                        <td height="30"></td>
                    </tr>
                    <tr>
                    <td align="center" bgcolor="#ffffff">
                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                            <tbody>
                            <tr>
                                <td align="center" style="line-height:0px;">
                                    <img style="display:block; line-height:0px; font-size:0px; border:0px; background: url('<?php echo $store_url; ?>image/account.png');" class="images_style" src="<?php echo $store_url; ?>image/account.png" width="110" height="110">
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table width="600" border="0" align="center" cellpadding="0" cellspacing="0" class="col2">
                            <tbody>
                            <tr>
                                <td align="center">
                                    <table class="insider" width="450" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tbody>
                                            <tr>
                                                <td height="25"></td>
                                            </tr>
                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif; font-size:22px; color:#333; line-height:30px; font-weight: bold;"><?php echo $text_advantages_title; ?></td>
                                            </tr>

                                            <tr>
                                                <td height="15"></td>
                                            </tr>

                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif;font-size:14px;color:#333;line-height:24px;font-weight:400;"><?php echo $text_advantages_text; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0" style="border-bottom: 1px solid #e5e5e5; ">
                <tbody>
                <tr>
                    <td>
                        <table class="col3" width="299" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td height="50"></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table class="insider" width="180" border="0" align="center" cellpadding="0" cellspacing="0">

                                            <tbody><tr align="center" style="line-height:0px;">
                                                <td>
                                                    <img style="display:block; line-height:0px; font-size:0px; border:0px; background: url('<?php echo $store_url; ?>image/icon-about.png');" src="<?php echo $store_url; ?>image/icon-about.png" width="58" height="58" alt="icon">
                                                </td>
                                            </tr>


                                            <tr>
                                                <td height="15"></td>
                                            </tr>


                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;"><?php echo $text_title_1; ?></td>
                                            </tr>


                                            <tr>
                                                <td height="10"></td>
                                            </tr>


                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 400;"><?php echo $text_services_1; ?></td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="45"></td>
                                </tr>
                            </tbody>
                        </table>

                        <table width="2" height="50" border="0" cellpadding="0" cellspacing="0" align="left">
                            <tbody><tr>
                                <td height="50" style="font-size: 0;line-height: 0;border-collapse: collapse;">
                                    <p style="padding-left: 0px;">&nbsp;</p>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <table class="col3" width="299" border="0" align="left" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td height="50"></td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        <table class="insider" width="180" border="0" align="center" cellpadding="0" cellspacing="0">
                                            <tbody>
                                            <tr align="center" style="line-height:0px;">
                                                <td>
                                                    <img style="display:block; line-height:0px; font-size:0px; border:0px; background: url('<?php echo $store_url; ?>image/icon-team.png');" src="<?php echo $store_url; ?>image/icon-team.png" width="63" height="58" alt="icon">
                                                </td>
                                            </tr>

                                            <tr>
                                                <td height="15"></td>
                                            </tr>

                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif; font-size:20px; color:#2b3c4d; line-height:24px; font-weight: bold;"><?php echo $text_title_2; ?></td>
                                            </tr>

                                            <tr>
                                                <td height="10"></td>
                                            </tr>

                                            <tr align="center">
                                                <td style="font-family: 'Open Sans', sans-serif; font-size:14px; color:#757575; line-height:24px; font-weight: 300;"><?php echo $text_services_2; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="45"></td>
                                </tr>
                            </tbody>
                        </table>

                    </td>
                </tr>
                </tbody>
            </table>
        </td>
    </tr>
    <!-- END SHOWCASE -->

    <!-- START FOOTER -->
    <tr>
        <td align="center">
            <table class="col-600" width="600" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                    <td align="center" bgcolor="<?php echo $color_background; ?>" background="<?php echo $mail_background_footer; ?>" style="background-size: cover;background-position: top;">
                        <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                                <td height="40"></td>
                            </tr>

                            <tr>
                                <td align="center" class="text-size-14" style="font-family: 'Open Sans', sans-serif; font-size:20px; font-weight:600; color:#333; line-height:1.4;">
                                    <?php echo $text_footer; ?>
                                </td>
                            </tr>

                            <tr>
                                <td height="45"></td>
                            </tr>

                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
    <!-- END FOOTER -->
</body>
</html>
