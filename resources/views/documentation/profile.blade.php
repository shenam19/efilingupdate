<x-documentation-layout>
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Profile Manual</h3>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Profile </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-header">How to access profile page</div>
                <div class="card-body">
                   User Can Click on the profile menu button to access the profile detail page. 
                </div>
                <img src="{{asset('documentation/img/profilemenu.png')}}"  class="img-fluid" alt="Responsive image">                   

            </div>

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-header">Profile Information</h4>
                        <p class="card-body">
                            In this section, you can update your display name as and when needed .
                        Note: You cannot change the E-Filing User ID.

                        </p>
                    </div>
                    <img src="{{asset('documentation/img/profileinformation.png')}}"  class="img-fluid" alt="Responsive image">                   
                </div>
    
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-header">Update Password</h4>
                        <p class="card-body">
                            In this section, you can change or update your password by entering the current password followed by new password and then confirm the newly created password.
                        </p>
                    </div>
                    <img src="{{asset('documentation/img/updatepassword.png')}}"  class="img-fluid" alt="Responsive image">                   
                </div>
    
            </div>

            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-header">Browser Sessions</h4>
                        <p class="card-body">
                            In case you are logged in from other browser sessions across all of your devices and you may log out from those if necessary by clicking the ‘Log Out Other Browser Sessions’.                        
                        </p>
                    </div>
                    <img src="{{asset('documentation/img/browsersession.png')}}"  class="img-fluid" alt="Responsive image">                   
                </div>
    
            </div>

        </section>
    </div>
</x-documentation-layout>