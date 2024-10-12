<x-documentation-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Create New Folder Manual</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li><br/>
                            <li class="breadcrumb-item active" aria-current="page">Create New Folder </li><br/>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">How to access Create New Folder page</div>
                <div class="card-body">
                   <p>User click on the ཡིག་ཁུག་ཏུ་བླུགས། button to access the Create New folder detail page. </p>
                   <img src="{{asset('documentation/img/createfolderaccess.png')}}"  class="img-fluid" alt="Responsive image">
                </div>
            </div>

            <div class="card">
                <div class="card-header">Create New Folder View</div>
                <div class="card-body">
                    <p><img src="{{asset('documentation/img/createfolder.png')}}"  class="img-fluid" alt="Responsive image"> </p>                  
                </div>
                <div class="card-header">Create New Folder Field Descriptions:</div>
                <ul class="card-text">   
                    <p><b>Any field name followed by red asterisk <span style="color:red;">*</span> means that the field is "required" to be filled and you won't be able to submit or save without filling that field.</b></p>
                    <li><b>Section Name (སྡེ་ཚན།) : </b>  User can select section (will display only the department’s section of logged in user). Different folder belongs to different section. So the user need to select suitable section from the drop down list when creating new file.</li><br/>
                    <li><b>Folder Creation Date (བཟོས་ཚེས) :</b> User need to enter date of folder creation.</li><br/>
                    <li><b>Folder Number (ཡིག་ཁུག་ཨང་།) : </b>User can enter the number that needs to assigned to the folder.</li><br/>
                    <li><b>Folder Name (ཡིག་ཁུག་མིང་།) :</b> User can enter the name to that folder.</li><br/>
                    <li><b>File Type (གནད་དོན་དབྱེ་བ།) :</b>The folder created can be General File (སྤྱི།) or can be Subject File (བྱེ་བྲག), for that user need to check the radio buttons accordingly.</li><br/>
                    <p style="text-align: center"><b> User can either close (ཁ་རྒྱོབས།) or submit (འགོད་འབུལ་ཞུས།) once done.</b></p>
                </ul>
    
            </div>

        </section>
    </div>
</x-documentation-layout>