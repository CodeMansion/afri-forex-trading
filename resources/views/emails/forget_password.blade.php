<!DOCTYPE html>
<html>
    <head>
        <title> Mail</title>
        <style type="text/css">
            @import url('http://fonts.googleapis.com/css?family=Nunito:300,600');
            body {
                height: 100% !important; 
                margin: 0 !important; 
                padding: 0 !important;
                width: 100% !important;
            }

            @media screen and (max-width: 640px) {
                table[class=devicewidth]{
                    width: 100% !important;
                }

                img[class=bigimage]{
                    width: 100% !important; 
                }

                .mobile_padding {
                    padding-left: 20px!important; 
                    padding-right: 20px!important;
                }

                .hide_for_mob {
                    display: none!important;
                }
            }

            @media only screen and (max-width: 480px){
                table[class=devicewidth]{
                    width: 100% !important;
                }

                img[class=bigimage] {
                    width: 100% !important; 
                }

                .mobile_padding {
                    padding-left: 10px!important; 
                    padding-right: 10px!important;
                }

                .hide_for_mob {
                    display: none!important;
                }
            }
        </style>
    </head>
    <body style="margin: 0 !important; padding: 0 !important; background-color: #f0f0f0;" bgcolor="#f0f0f0">
        <table border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
                <td align="center" style="padding: 15px 10px; background-color: #f0f0f0;" bgcolor="#f0f0f0">
                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="600" class="devicewidth">
                        
                    <!-- header -->
                        <tr>
                            <td align="center" valign="top" width="100%" bgcolor="#f0f0f0" style="background: white;">
                            <img src="{{ asset('images/logo.png') }}"  border="0" alt="Market Profits" 
                                style="width:200px!important;display: block; font-family: sans-serif; height:auto!important;" class="bigimage"></td>
                        </tr>

                        <!-- white block with heading -->
                        <tr>
                            <td align="center" style="padding:35px; background-color: #ffffff;" bgcolor="#ffffff" class="mobile_padding">
                                <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td align="left" style="font-family: Nunito, Helvetica, Arial,sans-serif; font-size: 14px; font-weight: normal; line-height: 24px;">
                                            <p style="font-size: 18px; line-height: 24px;font-weight: bold; color: #58595b; margin: 0;">Hello {{ $email }},</p>
                                            <p style="font-size: 14px; line-height: 24px; color: #72808e;">
                                                Find below your new generated password. Please ensure to reset your password after you login.<br><br>

                                                <span style="font-size:20px;">{{ $new_password }}</span>
                                            </p>
                                        </td>
                                    </tr>

                                </table>
                            </td>
                        </tr>

                        <!-- footer -->
                        <tr>
                            <td align="center" style="padding:10px 0">
                                <a target="_blank" style="text-decoration: none!important;"id="ct14_0" href="" width="24" height="24">
                                    <img align="none" height="24" height="24" src="{{ asset('images/facebook.png')}}" width="24" height="24" />
                                </a>
                                <a target="_blank" style="text-decoration: none!important;" id="ct12_0" href="" width="24" height="24">
                                    <img align="none" height="24" height="24" src="http://gallery.mailchimp.com/09bba7cf4ecd30379b5e88ae9/images/linkedin_4_24.png" width="24" height="24" />
                                </a>
                                <a target="_blank" style="text-decoration: none!important;" id="ct13_0" href="">
                                    <img align="none" height="24" height="24" src="{{ asset('images/twitter.png')}}" width="24" height="24" />
                                </a>
                                <a target="_blank" style="text-decoration: none!important;" id="ct13_0" href="">
                                    <img align="none" height="24" height="24" src="{{ asset('images/youtube.png')}}" width="24" height="24" />
                                </a>
                            </td>
                        </tr>

                        <!-- copyright -->
                        <tr>
                            <td align="center" style="font-family: Nunito, Helvetica, Arial, sans-serif; font-size: 11px; font-weight: normal; line-height: 16px;">
                                <p style="font-size: 11px; font-weight: normal; line-height: 16px; color: #8fa0ac;">
                                    <a style="color:#8fa0ac!important;text-decoration:none!important;" id="ct10_0" href="#">&copy; 2018 Market Profits.</a> 
                                    <a style="text-decoration: underline; color: #8fa0ac" target="_bl" id="ct4_0" href="#">
                                        <span color="#8fa0ac">About</span>
                                    </a> |  
                                    <a style="text-decoration: underline; color: #8fa0ac" target="_blank" id="ct5_0" href="#">
                                        <span color="#8fa0ac">Terms and Conditions</span>
                                    </a> | 
                                    <a style="text-decoration: underline; color: #8fa0ac" target="_blank" id="ct6_0" href="#">
                                        <span color="#8fa0ac">Privacy</span>
                                    </a>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>