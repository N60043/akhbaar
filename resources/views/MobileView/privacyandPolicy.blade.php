<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Privacy and Policy</title>
  <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('css_News_frontend_pages/mobileViewStyles.css')}}">
</head>
<body>
  <div class="col-12 d-flex mt-2 text-center" id="privacyandpolicy_Header">
    <a class="text-decoration-none " href="{{route('ViewSetting')}}">
      <div class="col-1 mt-1 ms-3">
        <i class="fa fa-arrow-left " aria-hidden="true"></i>
      </div>
    </a>
    <div class="col-10">
     <strong >Privacy Policy</strong>
   </div>
  </div>
  <div class="mt-4" id="privacyandpolicy_Content">
    <h3 class="font-weight-bolder mt-1" id="heading_privacyandpolicy">Privacy & Policy</h3>
      <h5>Welcome to Mobile Akhbaar!</h5>
      <p class="lh-sm" class="">
        At Mobile Akhbaar, accessible from https://mobileakhbaar.com/, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by Mobile Akhbaar and how we use it.
      </br>
        If you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.
       </br>
        This Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in Mobile Akhbaar. This policy is not applicable to any information collected offline or via channels other than this website.
      </p>
      <h5 class="mt-4">Consent</h5>
        <p class="lh-sm" class="">
          By using our website, you hereby consent to our Privacy Policy and agree to its terms.
        </p>
      <h5 class="mt-4">Information we collect</h5>
        <p class="lh-sm">
           The personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.
         </br>
          If you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.
        </br>
          When you register for an Account, we may ask for your contact information, including items such as name & telephone number.
        </p>
      <h5 class="mt-4">How we use your Information</h5>
        <p class="lh-sm" class="">
          We use the information we collect in various ways, including to:
        </br>
        Provide, operate, and maintain our websiteImprove, personalize, and expand our websiteUnderstand and analyze how you use our websiteDevelop new products, services, features, and functionality
        </br>
        Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the website, and for marketing and promotional purposes
        </br>
        Send you emails 
        </br>
        Find and prevent fraud
        </p>
         
      <h5 class="mt-4">Log Files</h5>
        <p class="lh-sm" class="">
         Mobile Akhbaar follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users' movement on the website, and gathering demographic information.
        </p>
      <h5 class="mt-4">Cokies and Web Beacons</h5>
        <p class="lh-sm" class="">
        Like any other website, Mobile Akhbaar uses 'cookies'. These cookies are used to store information including visitors' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users' experience by customizing our web page content based on visitors' browser type and/or other information.
        </p>
      <h5 class="mt-4">GDPR Data Protection Rights</h5>
        <p class="lh-sm" class="">
          We would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:
          </br>
          The right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.
          </br>
          The right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.
          </br>
          The right to erasure – You have the right to request that we erase your personal data, under certain conditions.
          The right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.
          </br>
          The right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.
          </br>
          The right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.
          </br>
          If you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.
          </br>
          Mobile Akhbaar does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.

        </p>
     
    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
<!--  CDN for jQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Custom JavascripT for Mobile View -->
<script src="{{asset('Js_News_frontend_pages/mobileViewScript.js')}}"></script>
@extends('Layouts.mobileFooter')
</body>
</html>