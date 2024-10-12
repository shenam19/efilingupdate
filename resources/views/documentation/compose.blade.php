<x-documentation-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Compose Manual</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Compose </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">How to access compose page</div>
                <div class="card-body">
                   <p>User Can Click on the compose menu button to access the compose detail page.
                   Compose (གནད་དོན་ཕྲིས།) allows the user to composer new outgoing letters within CTA Network.                    
                   </p>
                    <img src="{{asset('documentation/img/compose.png')}}"  class="img-fluid" alt="Responsive image">
                </div>
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="card-header">
                        Compose Detail view
                    </div>
                    <img src="{{asset('documentation/img/composedetail.png')}}"  class="img-fluid" alt="Responsive image">                   
                    
                </div>
                <div class="card-body">
                    <h4 class="card-title">Compose Field Descriptions:</h4>
                    <ul class="card-text"><b>Internal Destination Address (ནང་ཁུལ་གཏོང་ཡུལ།) :</b> This is the field for recipient account. You can enter userID/AccountID of the recipient by manually typing or by selecting between the two checkboxes. First Checkbox is for selecting all the recipient in CTA who has access to the database. Second checkbox is for selecting all the recipient or co-worker inside or within the office.
                    </ul>
                    <ul class="card-text"><b>Type (འཕྲིན་ཐུང་དབྱེ་བ།) :</b> All the outgoing letters have letter type and user can select from 
                        སྤྱིར་བཏང་། བཀའ་འཁྲོལ། བཀོད་ཁྱབ། གསལ་བསྒྲགས། རྩ་འཛིན། སྙན་ཞུ། drop down list.</ul>
                    <ul class="card-text"><b>Folder (ཡིག་སྣོད།) :</b> In here user may store and organize the compose Letters in the folder or sub-folders which can be easily accessed virtually any time. User can add new folders or sub-folder.
                    </ul>
                    <ul class="card-text"><b>Subject (ནང་དོན།) :</b> You may enter the short and specific subject line in this field.
                    </ul>
                    <ul class="card-text"><b>Outgoing Letter No. (ཕྱིར་བཏང་ཡི་གེའི་ཨང་གྲངས།) : </b>User may enter the compose letter number of their office. Note: Left Gray Area contains a number which are auto-incremented and generated automatically.
                    </ul>
                    <ul class="card-text"><b>Attachment (ཡིག་ཆ་མཉམ་སྦྱར་བྱོས།) :</b> User may attach any documents (if there is any) with the compose letter.
                    </ul>
                    <ul class="card-text"><b>Remarks / Noting (ཟུར་མཆན།) :</b> In here user may add any remarks related with the compose letter. 
                    </ul>
                    <ul class="card-text"><b>Urgency (གལ་འགངས།) : </b> This dropdown offers a list of options regarding level of urgency of compose letter. 
                    </ul>
                    <li><b>Language (སྐད་ཡིག) : </b> User can choose suitable language options from the dropdown. These options are Tibetan(བོད་ཡིག), English (ཨིན་ཡིག), Hindi (ཧིནྡི།), Other (གཞན།).</li><br/>

                </div>
                <p style="text-align: center"><b> User can click to close(དོར།) the compose page or can click to save as Draft(ཟིན་བྲིས་གསོག་འཇོག་བྱོས།) for later or can click send (ཐོངས།) to compose the letter.</b></p>

    
            </div>

            

        </section>
    </div>
</x-documentation-layout>