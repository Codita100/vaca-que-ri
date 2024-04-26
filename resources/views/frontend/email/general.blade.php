<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta charset="utf-8">
    <!-- utf-8 works for most cases -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Forcing initial-scale shouldn't be necessary -->
    <meta http-equiv="x-ua-compatible" content="IE=edge">
    <!-- Use the latest (edge) version of IE rendering engine -->
    <title>Email</title>

    <style type="text/css">
        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        div[style*=margin:

        16
        px

        0
        ]
        {
            margin: 0 !important
        ;
        }
        table, td {
            mso-table-lspace: 0 !important;
            mso-table-rspace: 0 !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
        }

        html, body {
            margin: 0 !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        .ExternalClass {
            width: 100%;
        }

        div[style*=margin:

        16
        px

        0
        ]
        {
            margin: 0 !important
        ;
        }
        table, td {
            mso-table-lspace: 0 !important;
            mso-table-rspace: 0 !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        .yshortcuts a {
            border-bottom: none !important;
        }

        a[x-apple-data-detectors] {
            color: inherit !important;
        }

        .button-td, .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover, .button-a:hover {
            background: black !important;
            border-color: black !important;
        }

        @media screen and (max-width: 720px) {
            .space {
                height: 20px !important;
            }

        }

        @media screen and (max-width: 720px) {
            .me {
                padding: 10px 25px !important;
            }

        }

        @media screen and (max-width: 720px) {
            .nu {
                display: none !important;
            }

        }

        @media screen and (max-width: 700px) {
            .email-container {
                width: 100% !important;
            }

        }

        @media screen and (max-width: 720px) {
            .fluid, .fluid-centered {
                max-width: 100% !important;
                height: auto !important;
                margin-left: auto !important;
                margin-right: auto !important;
            }

        }

        @media screen and (max-width: 720px) {
            .fluid-centered {
                margin-left: auto !important;
                margin-right: auto !important;
            }

        }

        @media screen and (max-width: 720px) {
            .stack-column, .stack-column-center {
                display: block !important;
                width: 100% !important;
                max-width: 100% !important;
            }

        }

        @media screen and (max-width: 720px) {
            .stack-column-center {
                text-align: center !important;
            }

        }

        @media screen and (max-width: 720px) {
            .center-on-narrow {
                text-align: center !important;
                display: block !important;
                margin-left: auto !important;
                margin-right: auto !important;
                float: none !important;
            }

        }

        @media screen and (max-width: 520px) {
            table.center-on-narrow {
                display: inline-block !important;
            }

        }

        @media screen and (max-width: 420px) {
            .me {
                padding: 10px 30px !important;
            }

        }

        @media screen and (max-width: 420px) {
            .hide {
                height: 0 !important;
            }

        }

        @media screen and (max-width: 420px) {
            .verde {
                padding: 15px !important;
            }

        }

        @media screen and (max-width: 420px) {
            .lg {
                padding: 20px 0 0 !important;
            }

        }</style>
</head>
<body bgcolor="#e0e0e0" width="100%" style="margin: 0; padding: 0" yahoo="yahoo">
<table bgcolor="#e0e0e0" cellpadding="0" cellspacing="0" border="0" width="100%"
       style="height:100%;border-collapse:collapse;">
    <tr>
        <td>
            <center style="width:100%;">


                <!-- Email Header : BEGIN -->


                <table cellspacing="0" cellpadding="0" border="0" align="center" bgcolor="#ffffff" width="600"
                       class="email-container">

                    <tr>
                        <td class="full-width-image" align="center">

                            <a href="#"><img src="{{asset('images/mail/banner1.jpg')}}" width="600" alt="A Vaca che ri"
                                             border="0" style="width: 100%; max-width: 600px; height: auto;"></a>

                        </td>
                    </tr>
                    <tr>
                        <td height="20">

                        </td>
                    </tr>

                    <!-- Email Body : BEGIN -->
                    <tr>
                        <td style="padding:30px 62px 0px;text-align:left;font-family:Arial;font-size:16px;mso-height-rule:exactly;line-height:30px;color:#283055;"
                            class="me">
                            {!! $values !!}
                        </td>
                    </tr>

                    <tr>
                        <td height="60">

                        </td>
                    </tr>
                    <!-- Email Body : END -->
                    <!-- Email Footer : BEGIN -->
                    <tr>
                        <td  valign="middle"
                            style="background-position:center !important;background-size:cover !important;">
                            <div>
                                <table align="center" width="600px" class="email-container">
                                    <tr>
                                        <td style="width:100%;mso-height-rule:exactly;text-align:center;">
                                            <a href="#"><img src="{{asset('images/mail/banner2.png')}}" width="600" alt="A Vaca che ri"
                                                             border="0" style="width: 100%; max-width: 600px; height: auto;"></a>
                                            <br>
                                        </td>
                                    </tr>
                                </table>
                                <!-- Email Footer : END -->
                            </div>
                        </td>
                    </tr>
                </table>
            </center>
        </td>
    </tr>
</table>
</body>
</html>
