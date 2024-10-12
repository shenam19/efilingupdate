<x-app-layout>
    <x-header>
        མདུན་འཆར།
    </x-header>
    <section class="content">
        <div class="container-fluid">

            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$mailsSent}}</h3>
                            <p>གློག་འཕྲིན་བཏང་བ་ཁག</p>
                        </div>
                        <div class="icon">
                            <i class="far fa-paper-plane"></i>
                        </div>
                        <a href="{{route('sent')}}" class="small-box-footer">གནས་ཚུལ་རྒྱས་པ། <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$mailsReceived}}</h3>
                            <p>
                                གློག་འཕྲིན་འབྱོར་བ་ཁག
                            </p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <a href="{{route('inbox')}}" class="small-box-footer">གནས་ཚུལ་རྒྱས་པ། <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$userCount}}</h3>
                            <p>ངའི་ལས་ཁུངས་ནས་སྤྱོད་མཁན་གྲངས།</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        @can('manage account with staff role')                        
                        <a href="{{route('manage-staff.listMyStaff')}}" class="small-box-footer">གནས་ཚུལ་རྒྱས་པ། <i
                                class="fas fa-arrow-circle-right"></i></a>
                        @endcan
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{$memoryUsage}}</h3>
                            <p>ངས་སྤྱད་པའི་ཤོང་ཚད།</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-database"></i>
                        </div>
                        <a href="{{route('media.index')}}" class="small-box-footer">གནས་ཚུལ་རྒྱས་པ། <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->            
            <!-- <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Welcome to your e-filing app</h3>
                        </div>
                        
                        <div class="card-body">                            
                            <div id="accordion">
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                href="#collapseOne" aria-expanded="false" style="color: #54595f">
                                                Make your organization structure
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                        <div class="card-body">
                                        <p>
                                        If you are a front desk or an admin of an office, go to the Organization Structure tab. By default, the organization structure may only be a box of your root office. If so, please click on the box and a modal should show. At the bottom of the modal, there is an Add Child button. Click on Add Child and enter the section's name. Congratulations! you've just created a section. Keep going and create more sub-sections till you have the whole Organization Structure. 
                                        </p>
                                        <p>
                                        Note: If you delete a section, all the child sections of that section will also be deleted. 
                                        </p>                                        
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100 collapsed" data-toggle="collapse"
                                                href="#collapseTwo" aria-expanded="false" style="color: #54595f">
                                                Create accounts for your staff
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                        <p>
                                          Now you can move on the creating accounts for your staff. Go to the Manage Staff tab. By default, there should be no staff created. If you are a front desk or an admin, you can create staff accounts. To create one, click on the create-staff button and enter the staff name, email, and password. 
                                        </p>
                                        <p>
                                        Note: Since the admin or the front desk of your office is going to create accounts for everyone. Make sure you change your password the first time you log in. And it's also recommended to change your password once a month. 
                                        </p>                                                                              

                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseThree" style="color: #54595f"
                                                aria-expanded="true">
                                                Compose messages to CTA offices 
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                        On the left navigation bar, there is a compose button. This is where you will compose messages to different CTA offices in Ghankyi and your colleagues. To reach another office, send a message to the front desk of that office. 
                                        You can save the message as a draft or send it right away.
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseFour" style="color: #54595f"
                                                aria-expanded="true">
                                                Create Incoming and Outgoing records
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFour" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                          <p>
                                          When your office sends or receives communication from outside the Ghankyi CTA, you can go to the incoming and outgoing tabs on the top and click the blue button to add records. 
                                          </p>
                                        <p>
                                          Note: Please enter all the required fields and check before you submit. Once uploaded, the records can not be edited. 
                                        </p>                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="card card-primary">
                                    <div class="card-header">
                                        <h4 class="card-title w-100">
                                            <a class="d-block w-100" data-toggle="collapse" href="#collapseFive" style="color: #54595f"
                                                aria-expanded="true">
                                                Organize your records in folders. 
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseFive" class="collapse" data-parent="#accordion">
                                        <div class="card-body">
                                          <p>
                                          In the folder tab, you can create folders. By default, there are no folders. To get started click on add folder button and create multiple folders.
                                          Once you have your folder, click on the folder and records in the folder will show. You can add records in the folder with the plus button on the right.
                                          </p>
                                        <p>
                                          Note: If you delete a folder, all the sub-folders with the folder will also be deleted.  
                                        </p>                                          
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div> -->
        </div>
    </section>
</x-app-layout>