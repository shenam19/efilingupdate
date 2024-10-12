<x-documentation-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Pull Back Manual</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li><br/>
                            <li class="breadcrumb-item active" aria-current="page">བཏང་འཕྲིན།</li><br/>
                            <li class="breadcrumb-item active" aria-current="page">ཕྱིར་འཐེན་བྱོས།</li><br/>


                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">How to access Pull Back page</div>
                <div class="card-body">
                    <p>User can click on the three vertical dot menu and then click on ཕྱིར་འཐེན་བྱོས། button. 
                   The pull back feature allows senders to pull messages back if sent in error.</p>
                   <img src="{{asset('documentation/img/pullback2.png')}}"  class="img-fluid" alt="Responsive image">

                </div>

            </div>

            <div class="card">
                    <div class="card-header">Pull Back Detail view</div>
                    <div class="card-body">
                        <img src="{{asset('documentation/img/pullback.png')}}"  class="img-fluid" alt="Responsive image">                   
                    </div>
                    <div class="card-header">Pull Back Field Descriptions:</div>
                    <ul class="card-text">   
                        <li><b> Please mention the reason for the Pull Back (ཕྱིར་འཐེན་བྱེད་དགོས་པའི་རྒྱུ་མཚན་འགོད་རོགས།) :</b> User needs to mention the reason behind the pull back request. <p><b>Note :</b> Pull back request can be done within 1 week (བཏང་ཟིན་པའི་གནས་ཕྲིན་ཞིག་འགྲིག་མིན་བྱུང་བདུན་ཕྲག ༡ ནང་ཚུན་ཕྱིར་འཐེན་བྱ་འཐུས།*).</p></li><br/>
                        <li><b>Internal Destination Address (ནང་ཁུལ་གཏོང་ཡུལ།) :</b> This is the field for recipient account. You can enter userID/AccountID of the recipient by manually typing or by selecting between the two checkboxes. First Checkbox is for selecting all the recipient in CTA who has access to the database. Second checkbox is for selecting all the recipient or co-worker within the office.
                        </li><br/>
                        <li><b>Type (འཕྲིན་ཐུང་དབྱེ་བ།) :</b> All the sent letters have letter type and user can select from 
                            སྤྱིར་བཏང་། བཀའ་འཁྲོལ། བཀོད་ཁྱབ། གསལ་བསྒྲགས། རྩ་འཛིན། སྙན་ཞུ། drop down list.</li><br/>
                        <li><b>Folder (ཡིག་སྣོད།) :</b> In here user may store and organize the sent Letters in the folder or sub-folders which can be easily accessed virtually any time. User can add new folders or sub-folder.</a> 
                        </li><br/>
                        <li><b>Subject (ནང་དོན།) :</b> You may enter the short and specific subject line in this field.
                        </li><br/>
                        <li><b>Outgoing Letter No. (ཕྱིར་བཏང་ཡི་གེའི་ཨང་གྲངས།) : </b>User may enter the sent letter number of their office. Note: Left Gray Area contains a number which are auto-incremented and generated automatically.
                        </li><br/>
                        <li><b>Attachment (ཡིག་ཆ་མཉམ་སྦྱར་བྱོས།) :</b> User may attach any documents (if there is any) with the sent letter.
                        </li><br/>
                        <li><b>Remarks / Noting (ཟུར་མཆན།) :</b> In here user may add any remarks related with the sent letter. 
                        </li><br/>
                        <li><b>Urgency (གལ་འགངས།) : </b> This dropdown offers a list of options regarding level of urgency of letter letter. 
                        </li><br/>
                        <li><b>Language (སྐད་ཡིག) : </b> User can choose suitable language options from the dropdown. These options are Tibetan(བོད་ཡིག), English (ཨིན་ཡིག), Hindi (ཧིནྡི།), Other (གཞན།).</li><br/>
                
                        <p style="text-align: center"><b> User can click to close(དོར།) the pull back page or can click to save as Draft(ཟིན་བྲིས་གསོག་འཇོག་བྱོས།) for later or can click send (ཐོངས།) to sent the pulled back letter.</b></p>
                    </ul>
                </div>

        </section>
    </div>
</x-documentation-layout>