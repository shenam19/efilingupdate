<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Default - TCRC Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('documentation/css/bootstrap.min.css')}}">
    
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="{{ asset('documentation/css/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('documentation/css/app.min.css')}}">
    <link rel="stylesheet" href="{{ asset('documentation/css/mystyle.css')}}">

    <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
</head>
<body>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-12 order-md-1 order-last">
                    <h2 style="text-align: center; color:steelblue" >E-Filing Frequently Asked Questions (FAQs)</h2>
                </div>
            </div>
        </div>        
    
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      <h2 class="text-accordian">How can I avoid letter number conflict issues when making a new letter entry either from Compose or ཕྱིར་བཏང་། ? </h2>     
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                       <p class="text-para"> There is two way to avoid the Issue:</p>
                        <li class="text-para">Fill the form first and then write the same letter number to the scanned document(actual physical letter) after saving the outgoing record.</li>
                        <li class="text-para">Designate one person to send all the letters.</li>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                        <h2 class="text-accordian"> How should a user compose a Confidential Letter? </h2>               </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-para">A Confidential letter should be composed like any other letter. Sender and reciever, date and extra details should be entered in Remarks. However, keeping in mind the Privacy Policy, do not upload the actual letter.</p>               
                    
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFour">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                        <h2 class="text-accordian">User got new email (suppose Gmail), what is Next?   </h2>              
                    </button>
                </h2>
                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <ul>
                            <li class="text-para">Open the email (Gmail,Yahoo or any other email) received. Print the email as pdf (This will save the email recieved in PDF format).</li>
                            <li class="text-para">In the e-filing web application, Click on the "ནང་འབྱོར།" (Incoming) menu and then click on སྣོན། (Add) button to fill in the new
                                incoming details. Upload the pdf email you have saved. Lastly, save the record by clicking གསོག་འཇོག་བྱོས། (save). </li>
                            <li class="text-para">If a user wants to forward the incoming letter to someone in your office then user can forward by using the forward (བརྒྱུད་བསྐུར་ཐོངས།) feature.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                        <h2 class="text-accordian"> What is the difference between Inbox(འབྱོར་སྒམ།) and Incoming (ནང་འབྱོར།)</h2>?
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-para"><strong>Inbox (འབྱོར་སྒམ།) : </strong> All the letters coming from within or outside CTA will be listed in the Inbox. A user can also select and move the letter to a specific folder. Apart from this a user can select letter to either print or forward.</p>                 
                        <p class="text-para"><strong>Incoming (ནང་འབྱོར།) : </strong>Apart from the functionalities of Inbox, the ནང་འབྱོར། will allow users to Print Karchag, narrow-down search filter and Add new letter received from outside the CTA gangkyi to Incoming record by clicking སྣོན།</p>                 
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSix">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                        <h2 class="text-accordian"> What is the difference between Sent(བཏང་ཕྲིན།) and Outgoing (ཕྱིར་བཏང་།)?</h2>
                    </button>
                </h2>
                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-para"><strong>Sent(བཏང་ཕྲིན།) :</strong> All the letters to be send within or outside the CTA will be listed in the Sent(བཏང་ཕྲིན།). User can also select and move a letter to a specific folder. Apart from this a user can select letter to either print or forward the letter within your office.</p>                 
                        <p class="text-para"><strong>Outgoing (ཕྱིར་བཏང་།) : </strong>Apart from functionalities in Sent, The Outgoing (ཕྱིར་བཏང་།) allow a user to Print Karchag, narrow-down search filter and Add new letter to be send to outside the CTA to outgoing record by clicking སྣོན།</p>                 
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingSeven">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                        <h2 class="text-accordian"> What is the difference between Compose (གནད་དོན་ཕྲིས།) and Add (སྣོན།) button in Incoming (ནང་འབྱོར)?</h2>
                    </button>
                </h2>
                <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-para"><strong>Compose (གནད་དོན་ཕྲིས།) :</strong>The Compose(གནད་དོན་ཕྲིས།)<i class="nav-icon fas fa-edit align-middle"></i> is to be used for sending any letter within the CTA, Gangkyi premises. Entry for these letters will be automatically recorded in the Outgoing register of the sender and Incoming register of the destination. </p>                 
                        <p class="text-para"><strong>Add (སྣོན།) </strong>: However, for recording the entry of letters to be send outside the premises of the CTA, use the Add(སྣོན།) button at the top-right corner of the Outgoing workarea. </p>                 
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingEight">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEight" aria-expanded="false" aria-controls="collapseEight">
                        <h2 class="text-accordian"> Is there a Flowchart for incoming and outgoing?    </h2>
                    </button>
                </h2>
                <div id="collapseEight" class="accordion-collapse collapse" aria-labelledby="headingEight" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row gallery" data-bs-toggle="modal" data-bs-target="#galleryModal">
                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="{{asset('documentation/img/incomingflowchart.png')}}" target="_blank">
                                    <img class="w-100 active" src="{{asset('documentation/img/incomingflowchart.png')}}" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                </a>
                            </div>

                            <div class="col-6 col-sm-6 col-lg-3 mt-2 mt-md-0 mb-md-0 mb-2">
                                <a href="{{asset('documentation/img/outgoingflowchart.png')}}" target="_blank">
                                    <img class="w-100 active" src="{{asset('documentation/img/outgoingflowchart.png')}}" data-bs-target="#Gallerycarousel" data-bs-slide-to="0">
                                </a>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingNine">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseNine" aria-expanded="false" aria-controls="collapseNine">
                        <h2 class="text-accordian">  How secure it is using the Application? What are chances of loosing data?</h2>
                    </button>
                </h2>
                <div id="collapseNine" class="accordion-collapse collapse" aria-labelledby="headingNine" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <p class="text-para">In terms of security, all the credentials that we type on the portal and the communication happening between user and the server is encrypted using self-signed certificate. </p>
                        <p class="text-para">In Terms of backup, system is designed to take backup every 1 hour and entire application and the data is sync between the main and backup servers. However, we must admit that we can't assure you 100% security or data lost.</p>
                    </div>
                </div>
            </div>


            <div class="accordion-item">
                <h2 class="accordion-header" id="headingten">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseten" aria-expanded="false" aria-controls="collapseten">
                        <h2 class="text-accordian">  How many Account ID can be created?</h2>
                    </button>
                </h2>
                <div id="collapseten" class="accordion-collapse collapse" aria-labelledby="headingten" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                       <p class="text-para">Tibetan Computer Resource Center (TCRC) will give two account (Admin and Reception) already created to each Department. Admin and Reception at the departments can create any number of account ID as and when needed.</p>
                    </div>
                </div>
            </div>

            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        <h2 class="text-accordian">  How can I logout?</h2>
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                      <p class="text-para">  Click the logout Icon <i class="fas fa-sign-out-alt"></i> on the top right corner of the browser.</p>
                    </div>
                </div>
            </div>
            
        </div>
    </div>  
    
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{asset ('documentation/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset ('documentation/js/mazer.js')}}"></script>
</body>

</html>

    
    
     


