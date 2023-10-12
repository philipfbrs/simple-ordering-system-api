<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <title>Purchase Complete!</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
        /**
   * Google webfonts. Recommended to include the .woff version for cross-client compatibility.
   */
        @media screen {
            @font-face {
                font-family: "Source Sans Pro";
                font-style: normal;
                font-weight: 400;
                src: local("Source Sans Pro Regular"), local("SourceSansPro-Regular"),
                    url(https://fonts.gstatic.com/s/sourcesanspro/v10/ODelI1aHBYDBqgeIAH2zlBM0YzuT7MdOe03otPbuUS0.woff) format("woff");
            }

            @font-face {
                font-family: "Source Sans Pro";
                font-style: normal;
                font-weight: 700;
                src: local("Source Sans Pro Bold"), local("SourceSansPro-Bold"),
                    url(https://fonts.gstatic.com/s/sourcesanspro/v10/toadOcfmlt9b38dHJxOBGFkQc6VGVFSmCnC_l7QZG60.woff) format("woff");
            }
        }

        /**
   * Avoid browser level font resizing.
   * 1. Windows Mobile
   * 2. iOS / OSX
   */
        body,
        table,
        td,
        a {
            -ms-text-size-adjust: 100%;
            /* 1 */
            -webkit-text-size-adjust: 100%;
            /* 2 */
        }

        /**
   * Remove extra space added to tables and cells in Outlook.
   */
        table,
        td {
            mso-table-rspace: 0pt;
            mso-table-lspace: 0pt;
        }

        /**
   * Better fluid images in Internet Explorer.
   */
        img {
            -ms-interpolation-mode: bicubic;
        }

        /**
   * Remove blue links for iOS devices.
   */
        a[x-apple-data-detectors] {
            font-family: inherit !important;
            font-size: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
            color: inherit !important;
            text-decoration: none !important;
        }

        /**
   * Fix centering issues in Android 4.4.
   */
        div[style*="margin: 16px 0;"] {
            margin: 0 !important;
        }

        body {
            width: 100% !important;
            height: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /**
   * Collapse table borders to avoid space between cells.
   */
        table {
            border-collapse: collapse !important;
        }

        a {
            color: #1a82e2;
        }

        img {
            height: auto;
            line-height: 100%;
            text-decoration: none;
            border: 0;
            outline: none;
        }
    </style>
</head>

<body style="background-color: #e9ecef;">
    <!-- start preheader -->
    <div class="preheader"
        style="
        display: none;
        max-width: 0;
        max-height: 0;
        overflow: hidden;
        font-size: 1px;
        line-height: 1px;
        color: #fff;
        opacity: 0;
      ">
        A preheader is the short summary text that follows the subject line when
        an email is viewed in the inbox.
    </div>
    <!-- end preheader -->

    <!-- start body -->
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- start logo -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 36px 24px;">
                            <a href="" target="_blank" style="display: inline-block;">
                                <img src="https://ik.imagekit.io/vz1eutxgsm/hris-logo1.png?updatedAt=1682430690170"
                                    alt="Logo" border="0" width="48"
                                    style="
                      display: block;
                      width: 48px;
                      max-width: 48px;
                      min-width: 48px;
                    " />
                            </a>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end logo -->

        <!-- start hero -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="
                  padding: 36px 24px 0;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  border-top: 3px solid #d4dadf;
                ">
                            <h1
                                style="
                    margin: 0;
                    font-size: 32px;
                    font-weight: 700;
                    letter-spacing: -1px;
                    line-height: 48px;
                  ">
                                Purchase Complete
                            </h1>
                        </td>
                    </tr>
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end hero -->

        <!-- start copy block -->
        <tr>
            <td align="center" bgcolor="#e9ecef">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <!-- start copy -->
                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="
                  padding: 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 16px;
                  line-height: 24px;
                ">
                            <p><b>{{ $data[0]->user->first_name }} {{ $data[0]->user->last_name }}</b> has ordered</p>
                            <div style="">
                                @if (count($data) > 0)
                                    @foreach ($data as $c)
                                        <br />
                                        <div
                                            style="display: flex; justify-content: space-between; height: 60px; overflow-y: auto; border-bottom: 1px solid #e5e7eb; padding: 1rem; justify-content: space-between;">
                                            <div style="display: flex;">
                                                <div style="width: 4rem; height: 4rem; display: flex;">
                                                    <img style="object-fit: cover; width: 100%; height: 100%;"
                                                        src="https://images.pexels.com/photos/4066288/pexels-photo-4066288.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" />
                                                </div>
                                                <div
                                                    style="display: grid; line-height: 1; margin-left: 0.625rem; justify-content: space-between; height: 100%; text-align: left;">

                                                    <span style="font-weight: 500; margin-bottom: 0.125rem;">
                                                        {{ $c['product']['name'] }}
                                                    </span>
                                                    <span>₱{{ $c['product']['price'] }}</span>

                                                    <div style="font-size: 0.75rem; font-weight: 600;">Qty:
                                                        {{ $c['quantity'] }}x</div>
                                                </div>
                                            </div>
                                            <span
                                                style="font-weight: 600; font-size: 1.25rem; width: 100%;text-align: end; ">
                                                ₱{{ $c['product']['price'] * $c['quantity'] }}
                                            </span>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td align="left" bgcolor="#ffffff"
                            style="
                  padding: 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 16px;
                  line-height: 24px;
                ">
                            <h2 style="margin: 0; font-weight: 700; font-size:32px; width: 100%; text-align: end; ">
                                <b> Total Amount: <u>₱{{ $total }}</u> </b>
                            </h2>
                            <br />
                            <br />
                            <p style="margin: 0;">

                            </p>
                            <p style="margin: 0;">

                            </p>
                    

                        </td>
                    </tr>
                    <!-- end copy -->

                    <!-- start copy -->
                 
                    <!-- end copy -->
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end copy block -->

        <!-- start footer -->
        <tr>
            <td align="center" bgcolor="#e9ecef" style="padding: 24px;">
                <!--[if (gte mso 9)|(IE)]>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="600">
        <tr>
        <td align="center" valign="top" width="600">
        <![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <!-- start permission -->
                    <tr>
                        <td align="center" bgcolor="#e9ecef"
                            style="
                  padding: 12px 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 14px;
                  line-height: 20px;
                  color: #666;
                ">
                            <p style="margin: 0;">
                                You received this email because someone purchase in your eccommerce website
                            </p>
                        </td>
                    </tr>
                    <!-- end permission -->

                    <!-- start unsubscribe -->
                    <!-- <tr>
              <td
                align="center"
                bgcolor="#e9ecef"
                style="
                  padding: 12px 24px;
                  font-family: 'Source Sans Pro', Helvetica, Arial, sans-serif;
                  font-size: 14px;
                  line-height: 20px;
                  color: #666;
                "
              >
                <p style="margin: 0;">
                  To stop receiving these emails, you can
                  <a href="https://www.blogdesire.com" target="_blank"
                    >unsubscribe</a
                  >
                  at any time.
                </p>
                <p style="margin: 0;">
                  Paste 1234 S. Broadway St. City, State 12345
                </p>
              </td>
            </tr> -->
                    <!-- end unsubscribe -->
                </table>
                <!--[if (gte mso 9)|(IE)]>
        </td>
        </tr>
        </table>
        <![endif]-->
            </td>
        </tr>
        <!-- end footer -->
    </table>
    <!-- end body -->
</body>

</html>
