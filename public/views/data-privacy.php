<?php 
    include __DIR__ . "/../views/fragments/header.php";?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms and Conditions, Data Privacy - NEECO II AREA 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    
    <style>
        :root {
            --neeco-green: #006837;
            --neeco-light-green: rgba(0, 104, 55, 0.1);
            --neeco-dark-green: #004d29;
        }
        
        body {
            color: #333;
            line-height: 1.6;
        }
        
        .text-neeco {
            color: var(--neeco-green);
        }
        
        .bg-neeco-light {
            background-color: var(--neeco-light-green);
        }
        
        .back-link {
            color: #000;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: color 0.3s ease;
        }
        
        .back-link:hover {
            color: var(--neeco-green);
        }
        
        .content-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }
        
        .section-heading {
            color: var(--neeco-green);
            font-weight: bold;
            margin-top: 2rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            border-bottom: 1px solid var(--neeco-light-green);
            padding-bottom: 0.5rem;
        }
        
        .section-heading i {
            font-size: 1.5rem;
            color: var(--neeco-green);
        }
        
        .list-custom {
            padding-left: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .list-custom li {
            margin-bottom: 0.5rem;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .list-custom li::before {
            /* content: "•"; */
            color: var(--neeco-green);
            font-weight: bold;
            position: absolute;
            left: 0;
        }

        a {
            text-decoration: none;
        }
        
        .tab-content {
            padding: 1.5rem;
            background-color: #fff;
            border-radius: 0 0 0.5rem 0.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .nav-tabs .nav-link {
            color: #555;
            font-weight: 500;
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .nav-tabs .nav-link.active {
            color: var(--neeco-green);
            border-bottom: 3px solid var(--neeco-green);
            background-color: transparent;
        }
        
        .nav-tabs .nav-link:hover:not(.active) {
            border-bottom: 3px solid #e9e9e9;
        }
        
        .card-header-custom {
            background-color: var(--neeco-light-green);
            color: var(--neeco-green);
            font-weight: 600;
        }
        
        .btn-neeco {
            background-color: var(--neeco-green);
            color: white;
            border: none;
        }
        
        .btn-neeco:hover {
            background-color: var(--neeco-dark-green);
            color: white;
        }
        
        .step-heading {
            font-weight: 600;
            color: var(--neeco-green);
            margin-top: 1rem;
            margin-bottom: 0.5rem;
        }
        
        .social-icon {
            font-size: 1.25rem;
            margin-right: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .section-heading {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }
            
            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>
</head>
<body>
    <div class="container py-4">
        <ul class="nav nav-tabs" id="legalTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="terms-tab" data-bs-toggle="tab" data-bs-target="#terms" type="button" role="tab" aria-controls="terms" aria-selected="true">
                    <i class="bi bi-file-text me-2"></i>Terms and Conditions
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="privacy-tab" data-bs-toggle="tab" data-bs-target="#privacy" type="button" role="tab" aria-controls="privacy" aria-selected="false">
                    <i class="bi bi-shield-lock me-2"></i>Privacy Policy
                </button>
            </li>
        </ul>
        
        <div class="tab-content" id="legalTabsContent">
            <div class="tab-pane fade show active" id="terms" role="tabpanel" aria-labelledby="terms-tab">
                <div class="content-section">
                    <h1 class="text-neeco display-5 fw-bold mb-4">Terms and Conditions</h1>
                    
                    <div class="card mb-4">
                        <div class="card-body bg-neeco-light">
                            <p class="fw-bold mb-2">Welcome to NEECO II - AREA 1!</p>
                            <p class="mb-0">These terms and conditions outline the rules and regulations for the use of NEECO II - AREA 1's Website, located at <a href="https://neeco2area1.com/" class="text-neeco">https://neeco2area1.com/</a>.</p>
                        </div>
                    </div>
                  
                    <p>By accessing this website we assume you accept these terms and conditions. Do not continue to use NEECO II - AREA 1 if you do not agree to take all of the terms and conditions stated on this page.</p>
                    
                    <p class="d-flex justify-content-between">The following terminology applies to these Terms and Conditions, Privacy Statement and Disclaimer Notice and all Agreements: "Client", "You" and "Your" refers to you, the person log on this website and compliant to the Company's terms and conditions. "The Company", "Ourselves", "We", "Our" and "Us", refers to our Company.</p>
                    
                    <p>All terms refer to the offer, acceptance and consideration of payment necessary to undertake the process of our assistance to the Client in the most appropriate manner for the express purpose of meeting the Client's needs in respect of provision of the Company's stated services, in accordance with and subject to, prevailing law of NEECO II AREA1. Any use of the above terminology or other words in the singular, plural, capitalization and/or he/she or they, are taken as interchangeable and therefore as referring to same.</p>
                    
                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-cookie"></i>
                            Cookies
                        </h2>
                        <p>We employ the use of cookies. By accessing NEECO II AREA 1, you agreed to use cookies in agreement with the NEECO II - AREA 1's Privacy Policy.</p>
                        <p>Most interactive websites use cookies to let us retrieve the user's details for each visit. Cookies are used by our website to enable the functionality of certain areas to make it easier for people visiting our website. Some of our affiliate/advertising partners may also use cookies.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-card-heading"></i>
                            License
                        </h2>
                        <p>Unless otherwise stated, NEECO II - AREA 1 and/or its licensors own the intellectual property rights for all materials on NEECO II - AREA 1. All intellectual property rights are reserved. You may access this from NEECO II - AREA 1 for your own personal use subjected to restrictions set in these terms and conditions.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-x-circle"></i>
                            You must not
                        </h2>
                        <ul class="list-custom">
                            <li>Republish material from NEECO II - AREA 1</li>
                            <li>Sell, rent or sub-license materials from NEECO II - AREA 1</li>
                            <li>Reproduce, duplicate or copy material from NEECO II - AREA 1</li>
                            <li>Redistribute content from NEECO II - AREA 1</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-chat"></i>
                            Comments
                        </h2>
                        <p>This Agreement shall begin on the date hereof. Our Terms and Conditions were created with the help of the <a href="https://www.termsandconditionsgenerator.com/" class="text-neeco">Terms and Conditions Generator</a>.</p>
                        <p>Parts of this website offer an opportunity for users to post and exchange opinions and information in certain areas of the website. NEECO II-AREA1 does not filter, edit, publish or review Comments prior to their presence on the website. Comments do not reflect the views and opinions of NEECO II-AREA1, its agents and/or affiliates. Comments reflect the views and opinions of the person who post their views and opinions.</p>
                        <p>To the extent permitted by applicable laws, NEECO II-AREA1 shall not be liable for the Comments or for any liability, damages or expenses caused and/or suffered as a result of any use of and/or posting of and/ or appearance of the Comments on this website.</p>
                        <p>NEECO II-AREA1 reserves the right to monitor all Comments and to remove any Comments which can be considered inappropriate, offensive or causes breach of these Terms and Conditions. You warrant and represent that:</p>

                        <ul class="list-custom">
                            <li>You are entitled to post the Comments on our website and have all necessary licenses and consents to do so</li>
                            <li>The Comments do not invade any intellectual property right, including without limitation copyright, patent or trademark of any third party</li>
                            <li>The Comments do not contain any defamatory, libelous, offensive, indecent or otherwise unlawful material which is an invasion of privacy</li>
                            <li>The Comments will not be used to solicit or promote business or custom or present commercial activities or unlawful activity</li>
                        </ul>
                        <p>You hereby grant NEECO II-AREA1 a non-exclusive license to use, reproduce, edit and authorize others to use, reproduce and edit any of your Comments in any and all forms, formats or media.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-link-45deg"></i>
                            Hyperlinking to our Content
                        </h2>
                        <p>The following organizations may link to our Website without prior written approval:</p>
                        <ul class="list-custom">
                            <li>Government agencies</li>
                            <li>Search engines</li>
                            <li>News organizations</li>
                            <li>Online directory distributions</li>
                            <li>System wide Accredited Business</li>
                        </ul>
                        <p>These organizations may link to our home page, to publications or to other Website information so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products and/or services; and (c) fits within the context of the linking party's site.</p>
                        <p>We may consider and approve other link requests from the following types of organizations:</p>
                        <ul class="list-custom">
                            <li>Commonly-known consumer and/or business information sources</li>
                            <li>dot.com community sites</li>
                            <li>Associations or other groups representing charities</li>
                            <li>Online directory distributors</li>
                            <li>Internet portals</li>
                            <li>Accounting, law and consulting firms</li>
                            <li>Educational institutions and trade associations</li>
                        </ul>
                        <p>We will approve link requests from these organizations if we decide that: (a) the link would not make us look unfavorably to ourselves or to our accredited businesses; (b) the organization does not have any negative records with us; (c) the benefit to us from the visibility of the hyperlink compensates the absence of NEECO II-AREA1; and (d) the link is in the context of general resource information.</p>
                        <p>These organizations may link to our home page so long as the link: (a) is not in any way deceptive; (b) does not falsely imply sponsorship, endorsement or approval of the linking party and its products or services; and (c) fits within the context of the linking party's site.</p>
                        <p>If you are one of the organizations listed in paragraph 2 above and are interested in linking to our website, you must inform us by sending an e-mail to NEECO II-AREA1. Please include your name, your organization name, contact information as well as the URL of your site, a list of any URLs from which you intend to link to our Website, and a list of the URLs on our site to which you would like to link. Wait 2-3 weeks for a response.</p>
                        <p>Approved organizations may hyperlink to our Website as follows:</p>
                        <ul class="list-custom">
                            <li>By use of our corporate name</li>
                            <li>By use of the uniform resource locator being linked to</li>
                            <li>By use of any other description of our Website being linked to that makes sense within the context and format of content on the linking party's site</li>
                        </ul>
                        <p>No use of NEECO II-AREA1's logo or other artwork will be allowed for linking absent a trademark license agreement.</p>
                    </div>
                    
                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-code-slash"></i>
                            iFrames
                        </h2>
                        <p>Without prior approval and written permission, you may not create frames around our Webpages that alter in any way the visual presentation or appearance of our Website.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-currency-dollar"></i>
                            Content Liability
                        </h2>
                        <p>We shall not be held responsible for any content that appears on your Website. You agree to protect and defend us against all claims that is rising on your Website. No link(s) should appear on any Website that may be interpreted as libelous, obscene or criminal, or which infringes, otherwise violates, or advocates the infringement or other violation of any third party rights.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-link-45deg"></i>
                            Reservation of Rights 
                        </h2>
                        <p>We reserve the right to request that you remove all links or any particular link to our Website. You approve to immediately remove all links to our Website upon request. We also reserve the right to amend these terms and conditions and its linking policy at any time. By continuously linking to our Website, you agree to be bound to and follow these linking terms and conditions.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-link-45deg"></i>
                            Removal of links from our website
                        </h2>
                        <p>If you find any link on our Website that is offensive for any reason, you are free to contact and inform us any moment. We will consider requests to remove links but we are not obligated to or so or to respond to you directly.</p>
                        <p>We do not ensure that the information on this website is correct, we do not warrant its completeness or accuracy; nor do we promise to ensure that the website remains available or that the material on the website is kept up to date.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-exclamation-circle"></i>
                            Disclaimer
                        </h2>
                        <p>To the maximum extent permitted by applicable law, we exclude all representations, warranties and conditions relating to our website and the use of this website.</p>
                        <p>Nothing in this disclaimer will:</p>
                        <ul class="list-custom">
                            <li>Limit or exclude our or your liability for death or personal injury</li>
                            <li>Limit or exclude our or your liability for fraud or fraudulent misrepresentation</li>
                            <li>Limit any of our or your liabilities in any way that what is not permitted under applicable law</li>
                            <li>Exclude any of our or your liabilities that may not be excluded under applicable law</li>
                        </ul>
                        <p>The limitations and prohibitions of liability set in this Section and elsewhere in this disclaimer: (a) are subject to the preceding paragraph; and (b) govern all liabilities arising under the disclaimer, including liabilities arising in contract, in tort and for breach of statutory duty. As long as the website and the information and services on the website are provided free of charge, we will not be liable for any loss or damage of any nature.</p>
                    </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="privacy-tab">
                <div class="content-section">
                    <h1 class="text-neeco display-5 fw-bold mb-4">Privacy Policy</h1>
                    
                    <div class="card mb-4">
                        <div class="card-body bg-neeco-light">
                            <p class="mb-0">Thank you for considering our electric cooperative as your energy provider. We are committed to protecting your privacy and providing you with transparency about how we collect and use your personal information.</p>
                        </div>
                    </div>
                    
                    <p class="mb-4">This privacy policy applies to all information collected on the website neeco2area1.com.ph. Thank you for considering our electric cooperative as your energy provider. We are committed to protecting your privacy and providing you with transparency about how we collect and use your personal information.</p>
                    
                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-shield-lock"></i>
                            Information Collection and Use
                        </h2>
                        <p>For a better experience, while using our Service, we may require you to provide us with certain personally identifiable information. The information that we request will be retained by us and used as described in this privacy policy.</p>
                        <ul class="list-custom">
                            <li>Information you fill out in our website, such as, when you wish to contact us to log your concerns, to register at our consumer portal, to avail of our on-line application, outage notifications, and billing and/or payment services including but not limited to <b>name, email address, mobile number</b> and <b>picture</b>.</li>
                            <li>When you use a third-party login provider to sign in to our platform such as Facebook or Google, we may collect certain personal data from the third-party provider, such as your name, email address, and profile picture. We may use this information to create and maintain your account, to provide you with our services, and to personalize your experience on our platform.</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-question-circle"></i>
                            How do we use your personal information?
                        </h2>
                        <p>We use your personal information to provide you with our services and to communicate with you about your account. Specifically, we use your <b>name</b> and <b>email address</b> to:</p>
                        <ul class="list-custom">
                            <li>Providing and continuously improving our electric services, as well as creating and managing your NEECO II-AREA1 Online account</li>
                            <li>Provide customer support</li>
                            <li>Responding to your inquiry, concern or complaint</li>
                            <li>Send you service-related emails, such as billing or outage notifications</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-database"></i>
                            Data Disclosure and Sharing
                        </h2>
                        <p>Access to your personal information is restricted to NEECO II-AREA1 employees and contractors on a need to know basis. We require our contractors to secure and keep your information confidential through a Non-Disclosure Agreement (NDA). Access to your personal information is restricted to NEECO II-AREA1 employees and contractors on a need to know basis to carry out their responsibilities with regard to the conduct of our business such as meter reading, bill delivery, field inspection, energization, and restoration of your electric service. We require our contractors, through a Non-Disclosure Agreement (NDA), to secure and keep your information confidential and we do not allow them to disclose your information to others, or to use it for their own purposes.</p>
                        <p>Your information may also be disclosed to government entities pursuant to and in compliance with applicable laws and regulations, subpoena or court order.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-trash"></i>
                            Personal Data Retention and Disposal/Deletion
                        </h2>
                        <p>We only retain personal data for as long as necessary to fulfill the purposes for which it was collected, unless a longer retention period is required by law. We will retain personal data for the following purposes:</p>
                        <ul class="list-custom">
                            <li>To provide services to our users</li>
                            <li>To comply with legal obligations</li>
                            <li>To resolve disputes</li>
                            <li>To enforce our agreements</li>
                            <li>To protect our rights</li>
                        </ul>
                        <p>When we no longer need personal data for any of the above purposes, we will delete it or discard it in a secure manner that would prevent further processing, unauthorized access, or disclosure to any other party or the public. When we dispose of personal data, we take appropriate measures to ensure that it is done securely and in compliance with applicable laws and regulations. This includes:</p>
                        <ul class="list-custom">
                            <li>Shredding physical documents containing personal data</li>
                            <li>Permanently deleting electronic records containing personal data</li>
                            <li>Overwriting or wiping hard drives and other storage media to ensure that personal data cannot be recovered</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-person-x"></i>
                            Personal Data Deletion Request for Users
                        </h2>
                        <div class="card mb-4">
                            <div class="card-header card-header-custom">
                                <i class="bi bi-info-circle me-2"></i>Users of NEECO II-AREA1 Online Portal or NEECO II-AREA1 Mobile App
                            </div>
                            <div class="card-body">
                                <p>Users have the right to request the deletion of their personal data collected through this platform. Users may request to delete their personal data by following the steps below:</p>
                                
                                <div class="mb-3">
                                    <p class="fw-bold mb-2">For users who registered using the email/password method:</p>
                                    
                                    <div class="step-heading">
                                        <i class="bi bi-1-circle me-2"></i>Step 1 - Submit a Request:
                                    </div>
                                    <ul class="list-custom">
                                        <li>For NEECO II-AREA1 Online website - Navigate to "<b>My Portal Account</b>" and click on "<b>Delete Portal Account"</b>. For NEECO II-AREA1 Mobile - Navigate to "<b>Settings</b>" > "<b>Account</b>" then select "<b>Delete Account</b>".</li>
                                        <li>Click "<b>Continue</b>". A verification code will be sent to your registered email.</li>
                                    </ul>
                                    
                                    <div class="step-heading">
                                        <i class="bi bi-2-circle me-2"></i>Step 2 - Verification
                                    </div>
                                    <p>To ensure that we are deleting the correct data, a verification code will be sent to the registered email and enter it into the app to proceed with your request. This is to protect your privacy and to prevent any unauthorized access to your data.</p>
                                    
                                    <div class="step-heading">
                                        <i class="bi bi-3-circle me-2"></i>Step 3 - Confirmation
                                    </div>
                                    <p>After successfully verifying the request, the user is required to enter their current password to authorize the deletion.</p>
                                    
                                    <div class="step-heading">
                                        <i class="bi bi-4-circle me-2"></i>Step 4 - Deletion
                                    </div>
                                    <p>Once the request is verified and the password is authorized, their personal data will be deleted, in accordance with applicable laws and regulations.</p>
                                </div>
                                
                                <div class="mb-3">
                                    <p class="fw-bold mb-2">For users who registered using Facebook/Google method:</p>
                                    <p>If the user did not allow us to access their email address upon authorizing the use of Facebook login, they won't be able to confirm their email address, so they may have to send an email request for deletion instead.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-trash3"></i>
                            Data Deletion Request
                        </h2>
                        <ol class="list-group list-group-numbered mb-4">
                            <li class="list-group-item">Contact us by sending an email to <a href="mailto:n2a1dpc@gmail.com" class="text-neeco">n2a1dpc@gmail.com</a> with a subject line <b>"Data Deletion Request."</b></li>
                            <li class="list-group-item">Clearly state in the body of the email that you are requesting the deletion of your personal data.</li>
                            <li class="list-group-item">Include relevant details to help us identify and locate your data, such as your name/username or any unique identifiers associated with your account.</li>
                        </ol>
                        
                        <div class="card mb-4">
                            <div class="card-header card-header-custom">
                                <i class="bi bi-shield-check me-2"></i>Verification
                            </div>
                            <div class="card-body">
                                <p class="mb-0">To ensure the security of your data, we may need to verify your identity before processing a deletion request. This may involve asking you to provide additional information or confirming certain details.</p>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header card-header-custom">
                                <i class="bi bi-bookmark-check me-2"></i>Response
                            </div>
                            <div class="card-body">
                                <p>We are committed to respecting your privacy and we will make reasonable efforts to respond to your data deletion request within 3 days from the date of receipt. Upon receiving a valid data deletion request, we will promptly cease the collection of user data and ensure that any stored user data collected before the request is securely and permanently deleted from our records.</p>
                            </div>
                        </div>
                        
                        <p>If the user allow us to access their email address upon authorizing the use of Facebook/Google login:</p>
                        
                        <div class="step-heading">
                            <i class="bi bi-1-circle me-2"></i>Step 1: (Deletion of Portal Account)
                        </div>
                        <ol class="list-group list-group-numbered mb-3">
                            <li class="list-group-item">Go to your Dashboard then click on "<b>My Portal Account</b>" on the menu.</li>
                            <li class="list-group-item">Click on "<b>Delete Portal Account</b>" and click "<b>Continue</b>".</li>
                            <li class="list-group-item">Enter the verification code that will be sent to your email.</li>
                            <li class="list-group-item">Confirm the deletion by pressing "<b>Continue Deletion</b>" button.</li>
                            <li class="list-group-item">All of your personal data are now deleted.</li>
                        </ol>
                        
                        <div class="step-heading">
                            <i class="bi bi-2-circle me-2"></i>Step 2: (Removing App Access in Facebook/Google)
                        </div>
                        
                        <div class="card mb-3">
                            <div class="card-header">
                                <i style="color: blue" class="bi bi-facebook social-icon"></i>Facebook
                            </div>
                            <div class="card-body">
                                <ol class="list-group list-group-numbered mb-0">
                                    <li class="list-group-item">Go to your Facebook Account's Setting & Privacy. Click "<b>Settings</b>"</li>
                                    <li class="list-group-item">Look for "Apps and Websites" and you will see all of the apps and websites you linked with your Facebook.</li>
                                    <li class="list-group-item">Search and click "<b>Official NEECO II-AREA1 Portal</b>" in the search bar.</li>
                                    <li class="list-group-item">Scroll and click "<b>Remove</b>".</li>
                                </ol>
                            </div>
                        </div>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i style="color: #4285F4" class="bi bi-google social-icon"></i>Google
                            </div>
                            <div class="card-body">
                                <ol class="list-group list-group-numbered mb-0">
                                    <li class="list-group-item">Go to the <a href="https://myaccount.google.com/security" class="text-neeco">Security section</a> of your Google Account.</li>
                                    <li class="list-group-item">Under "<b>Third-party apps with account access</b>," select "<b>Manage third-party access</b>".</li>
                                    <li class="list-group-item">Select NEECO II-AREA1 Portal or NEECO II-AREA1 Mobile or service you want to remove.</li>
                                    <li class="list-group-item">Select "<b>Remove Access</b>".</li>
                                </ol>
                            </div>
                        </div>
                        
                        <p>We may retain some personal data in backup systems for a limited period of time to ensure the integrity of our systems and to comply with legal or regulatory requirements. After the retention period has expired, we will securely dispose of the personal data.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-gear"></i>
                            Security
                        </h2>
                        <p>We take the security of your personal data seriously and have implemented technical and organizational measures to protect your personal data from unauthorized access, disclosure, alteration, or destruction. We use industry-standard encryption technology to protect your personal data during transmission and storage.</p>
                        <p>However, no method of transmission over the Internet or method of electronic storage is 100% secure, and we cannot guarantee the absolute security of your personal data. We encourage users to take steps to reduce the risk of fraud and to help protect the confidentiality and security of their NEECO II-AREA1 Online account and personal information, including but not limited to the following:</p>
                        <ul class="list-custom">
                            <li>Use strong passwords: A strong password should be at least 8 characters long, and contain a mix of uppercase and lowercase letters, numbers, and symbols. Avoid using common words or phrases, as they can be easily guessed.</li>
                            <li>Limit your personal information: Avoid sharing personal information on social media or other public forums, as this can make it easier for hackers to guess your security questions.</li>
                            <li>Use different passwords for each account: This way, if one account is compromised, your other accounts will still be secure.</li>
                            <li>Create strong usernames and passwords with 15 or more characters using both upper- and lower-case letters, numbers and special characters.</li>
                            <li>Be cautious of phishing scams: Phishing scams are attempts to trick you into revealing sensitive information by posing as a trustworthy source. Be wary of unsolicited emails or messages that ask for your login information or personal details.</li>
                            <li>Update your contact information when it changes so you can be contacted if there's a problem.</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-check-circle"></i>
                            Your Rights and Choices
                        </h2>
                        <p>You have the right to:</p>
                        <ul class="list-custom">
                            <li>Access and correct your personal information</li>
                            <li>Request that we delete your personal information</li>
                            <li>Object to or restrict the processing of your personal information</li>
                            <li>Request a copy of your personal information</li>
                        </ul>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-check-circle"></i>
                            Log Data
                        </h2>
                        <p>We want to inform you that whenever you use our Service, in a case of an error in the app we collect data and information (through third party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol ("IP") address, device name, operating system version, the configuration of the app when utilizing our Service, the time and date of your use of the Service, and other statistics.</p>
                    </div>

                    <div>
                        <h2 class="section-heading h4">
                            <i class="bi bi-telephone"></i>
                            Contact Information
                        </h2>
                        <p>For more information, please contact the Data Privacy officer at:</p>
                        <div class="card">
                            <div class="card-body">
                                <ul class="list-unstyled mb-0">
                                    <li><i class="bi bi-envelope-fill me-2 text-neeco"></i>Email: <a href="mailto:n2a1dpc@gmail.com" class="text-neeco">n2a1dpc@gmail.com</a></li>
                                    <li><i class="bi bi-telephone-fill me-2 text-neeco"></i>Landline: 044-958-0260 | 044-411-1007</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="position-fixed bottom-0 end-0 p-3">
        <button class="btn btn-neeco rounded-circle" id="backToTop" title="Back to Top">
            <i class="bi bi-arrow-up"></i>
        </button>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const backToTopButton = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopButton.style.display = 'block';
            } else {
                backToTopButton.style.display = 'none';
            }
        });
        
        backToTopButton.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });
        

        backToTopButton.style.display = 'none';

        document.addEventListener('DOMContentLoaded', function() {
            const emailLinks = document.querySelectorAll('a[href^="mailto:"]');
            emailLinks.forEach(link => {
                const email = link.getAttribute('href').replace('mailto:', '');
                link.setAttribute('data-email', email);
                link.setAttribute('href', '#');
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.location.href = 'mailto:' + this.getAttribute('data-email');
                });
            });
        });
    </script>
</body>
</html>

<?php include __DIR__ . "/../views/fragments/footer.php";?>

