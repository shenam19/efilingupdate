<x-documentation-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Add Incoming (ནང་འབྱོར་གསར་པ་སྣོན།) Manual</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">ཕྱིར།</li>
                            <li class="breadcrumb-item active" aria-current="page">ནང་འབྱོར་གསར་པ་སྣོན།</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">How to access Add Incoming page</div>
                <div class="card-body">
                   <p>User can click on the +སྣོན། button to access the Add Incoming page. </p>
                   <img src="{{asset('documentation/img/addincomingaccess.png')}}"  class="img-fluid" alt="Responsive image">
                </div>

            </div>

            <div class="card">
                    <div class="card-header">Add Incoming View</div>
                    <div class="card-body">    
                        <p>In This section, user can add new incoming letter from outside Central Tibetan Administration. <p><b>Note: This is for record keeping only. </b></p>
                        <img src="{{asset('documentation/img/addincoming.png')}}"  class="img-fluid" alt="Responsive image">                   
                    </div>

                    <div class="card-header">Add New Incoming Field Descriptions:</div>
                    <ul class="card-text">   
                        <p><b>Any field name followed by red asterisk <span style="color:red;">*</span> means that the field is "required" to be filled and you won't be able to submit or save without filling that field.</b></p>
                        <li><b>Incoming Letter No. (ནང་འབྱོར་ཡི་གེའི་ཨང་གྲངས།) :</b> User may enter the Incoming letter number of their office. 
                            <p><b>Note: </b> Gray Area contains a number which are auto-incremented and generated automatically.</p></li><br/>
                        <li><b>Letter No. (ཡི་གེའི་ཨང་གྲངས།) :</b> This is where user enters the letter number containing office name, section name followed by year and other stuff.</li><br/>
                        <li><b>Section (སྡེ་ཚན།) : </b>User needs to specify the section where the incoming letter is directed to.</li><br/>
                        <li><b>Letter Type (འཕྲིན་ཐུང་དབྱེ་བ།) :</b> All the incoming letters have letter type and user can select from སྤྱིར་བཏང་། བཀའ་འཁྲོལ། བཀོད་ཁྱབ། གསལ་བསྒྲགས། རྩ་འཛིན། སྙན་ཞུ། drop down list.</li><br/>
                        <li><b>Sent & Recieved Date (བཏང་ཚེས་དང་འབྱོར་ཚེས།) : </b>User need to enter the actual sent and received date of the incoming letter.</li><br/>
                        <li><b>Sender (གཏོང་མཁན།) :</b> User need to enter the sender’s Address (If the sender's address is already added) by selecting from the drop down. If the sender is new then user may click on the ཕྱིའི་སྒྲིག་འཛུགས་གསརཔ་ཆུགས། button to add the address of new sender in the contact list.</li><br/>
                        <li><b>Attachment (ཡིག་ཆ་མཉམ་སྦྱར་བྱོས།) : :</b> User may attach any documents (if there is any) with the incoming letter. </li><br/>
                        <li><b>Urgency (གལ་འགངས།) : </b> This dropdown offers a list of options regarding level of urgency of outgoing letter. </li><br/>
                        <li><b>Subject (ནང་དོན།) : </b> User may enter the short and specific subject line in this field. </li><br/>
                        <li><b>Remarks / Noting (ཟུར་མཆན།) : </b> In here user may add any remarks related to the incoming letter. </li><br/>
                        <li><b>Folder (ཡིག་སྣོད།) : </b> In here user may store and organize the incoming Letters in the folder or sub-folders which can be easily accessed virtually any time. User can add new folders or sub-folder.</li><br/>
                        <li><b>Incoming Mode (རྣམ་པ།) : </b> This dropdown offers a list of options regarding level of urgency of outgoing letter. </li><br/>
                        <li><b>Language (སྐད་ཡིག) : </b> User can choose suitable language options from the dropdown. These options are Tibetan(བོད་ཡིག), English (ཨིན་ཡིག), Hindi (ཧིནྡི།), Other (གཞན།).</li><br/>
                        <p style="text-align: center"><b> User can click save (གསོག་འཇོག་བྱོས།) to save the letter.</b></p>                
                    </ul>
            </div>

        </section>
    </div>
</x-documentation-layout>