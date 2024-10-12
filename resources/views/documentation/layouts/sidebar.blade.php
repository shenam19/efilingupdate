<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                    <a href="{{ url('documentation/welcome')}}"><img src="{{asset('img/CTALogo.png')}}" class="text-center brand-image-welcome-logo2"></a>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
<div class="sidebar-menu">
<ul class="menu">
    <li class="sidebar-title">བེད་སྤྱོད་ལམ་སྟོན།</li>  
    <li
        class="sidebar-item">
        <a href="{{ url('documentation/welcome')}}" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>མདུན་ངོས།</span>
        </a>
    </li> 
    <li class="sidebar-item">
        <a href="{{ url('documentation/login')}}" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>ནང་འཛུལ་མདུན་ངོས།</span>
        </a>
    </li>
    <li class="sidebar-item">
        <a href="{{ url('documentation/dashboard')}}" class='sidebar-link'>
            <i class="bi bi-stack"></i>
            <span>མདུན་འཆར།</span>
        </a>
    </li> 
    <li class="sidebar-item">
    <a href="{{ url('documentation/profile')}}" class='sidebar-link'>
        <i class="bi bi-stack"></i>
        <span>ངོ་སྤྲོད་ཁ་སྐོང་།</span>
    </a>
</li>  
    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>དབུས་ལས་ཁུངས་ནང་ཁུལ།</span>
        </a>
        <ul class="submenu ">
           
            <li class="submenu-item has-sub">
                <a href="{{ url('documentation/compose')}}">གནད་དོན་བྲིས།</a>
                <ul class="subsubmenu">
                    <li class="submenu-item ">
                        <a href="{{ url('documentation/draft')}}">ཟིན་བྲིས།</a>
                    </li>
                </ul>    
            </li>
            <li class="submenu-item has-sub">
                <a href="{{ url('documentation/inbox')}}">འབྱོར་སྒམ།</a>
                <ul class="subsubmenu">
                    <li class="submenu-item ">
                        <a href="{{ url('documentation/addtofolderinbox')}}">ཡིག་ཁུག་ཏུ་བླུགས།</a>
                    </li>

                    <li class="submenu-item ">
                        <a href="{{ url('documentation/readletter')}}">གློག་འཕྲིན་ཀློགས།</a>
                    </li>
        
                    <li class="submenu-item ">
                        <a href="{{ url('documentation/forward')}}">བསྒྱུད་བསྐུར་ཐོངས།</a>
                    </li>
                </ul>
            </li>
         </ul>
    </li>
    
    <li class="sidebar-item  has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>ཕྱིར།</span>
        </a>
        <ul class="submenu ">

             <li class="submenu-item ">
                <a href="{{ url('documentation/incoming')}}">ནང་འབྱོར།</a>
                <ul class="subsubmenu">

            
                    <li class="submenu-item ">
                        <a href="{{url('documentation/incomingletterdetail')}}">གློག་འཕྲིན་ཀློགས།</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{ url('documentation/incomingforward')}}">བསྒྱུད་བསྐུར་ཐོངས།</a>
                    </li>
                    <li class="submenu-item ">
                        <a href="{{url('documentation/addincoming')}}">ནང་འབྱོར་གསར་པ་སྣོན།</a>
                    </li> 
                </ul>      
            </li>
            <li class="submenu-item has-sub">
                <a href="{{ url('documentation/outgoing')}}">ཕྱིར་བཏང་།</a>
                <ul class="subsubmenu">

                    <li class="submenu-item ">
                        <a href="{{url('documentation/outgoingletterdetail')}}">གློག་འཕྲིན་ཀློགས།</a>
                    </li>

                    <li class="submenu-item ">
                        <a href="{{url('documentation/outgoingforward')}}">བསྒྱུད་བསྐུར་ཐོངས།</a>
                    </li>
                    
                    <li class="submenu-item ">
                        <a href="{{url('documentation/addoutgoing')}}">ཕྱིར་བཏང་གསར་པ་སྣོན།</a>
                    </li>
                </ul>    
            </li>
        </ul>
        
    </li>

     <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>བཏང་ཕྲིན།</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/sent')}}">བཏང་ཕྲིནཟིན་ཐོ།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/addtofoldersent')}}">ཡིག་ཁུག་ཏུ་བླུགས།</a>
            </li>

            <li class="submenu-item has-sub">
                <a href="{{ url('documentation/readsentmail')}}">གློག་འཕྲིན་ཀློགས།</a>
                <ul class="subsubmenu">

                    <li class="submenu-item ">
                        <a href="{{ url('documentation/pullback')}}">ཕྱིར་འཐེན་བྱོས།</a>
                    </li>
        
                    <li class="submenu-item ">
                        <a href="{{ url('documentation/forward')}}">བསྒྱུད་བསྐུར་ཐོངས།</a>
                    </li>
                </ul>
            </li>
        </ul>

    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>འབྲེལ་གཏུགས།</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/contact')}}">འབྲེལ་གཏུགས་ཁ་བྱང་།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/addcontact')}}">འབྲེལ་གཏུགས་གསར་བཟོ་བྱོས།</a>
            </li>
        </ul>
    </li>

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>ཡིག་ཁུག</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/folder')}}">ཡིག་ཁུག་རེའུ་མིག</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/editfolder')}}">ཡིག་ཁུག་བཟོ་བཅོས།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/movetofolder')}}">ཡིག་ཁུག་ཏུ་ཆུགས།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/createfolder')}}">ཡིག་ཁུག་གསར་བཟོ།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/addsubfolder')}}">ཡིག་ཁུག་གི་ནང་གསེས་གསར་བཟོ།</a>
            </li>           
        </ul>
    </li>
   

    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>ཡིག་པར།</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/media')}}">media</a>
            </li>
        </ul>    
    </li>
    
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>ལས་བྱེད་བཀོད་བྱུས།</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/managestaff')}}">ལས་བྱེད་རེའུ་མིག</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/addstaff')}}">ལས་བྱེད་གསར་པ་ཆུགས།</a>
            </li>
            <li class="submenu-item ">
                <a href="{{ url('documentation/editstaff')}}">ལས་བྱེད་ནོར་བཅོས།</a>
            </li>
            
        </ul>
    </li>        
    
    <li class="sidebar-item has-sub">
        <a href="#" class='sidebar-link'>
            <i class="bi bi-hexagon-fill"></i>
            <span>སྒྲིག་འཛུགས་ཀྱི་སྒྲོམ་གཞི།</span>
        </a>
        <ul class="submenu ">
            <li class="submenu-item ">
                <a href="{{ url('documentation/organisationalstructure')}}">གནས་ཚུལ་ཞིབ་ཁྲ།</a>
            </li>
        </ul>
    </li> 
    
</ul>
</div>
<button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
</div>
</div>