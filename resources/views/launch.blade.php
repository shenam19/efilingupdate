<!-- This layout is for home page and documentations -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>e-filing</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/mystyle.css')}}">

<style>


.glow-on-hover {
    width: 220px;
    height: 50px;
    border: none;
    outline: none;
    color: #fff;
    background: #111;
    cursor: pointer;
    position: relative;
    z-index: 0;
    border-radius: 10px;
}

.glow-on-hover:before {
    content: '';
    background: linear-gradient(45deg, #ff0000, #ff7300, #fffb00, #48ff00, #00ffd5, #002bff, #7a00ff, #ff00c8, #ff0000);
    position: absolute;
    top: -2px;
    left:-2px;
    background-size: 400%;
    z-index: -1;
    filter: blur(5px);
    width: calc(100% + 4px);
    height: calc(100% + 4px);
    animation: glowing 20s linear infinite;
    opacity: 0;
    transition: opacity .3s ease-in-out;
    border-radius: 10px;
}

.glow-on-hover:active {
    color: #000
}

.glow-on-hover:active:after {
    background: transparent;
}

.glow-on-hover:hover:before {
    opacity: 1;
}

.glow-on-hover:after {
    z-index: -1;
    content: '';
    position: absolute;
    width: 100%;
    height: 100%;
    background: #447c9d;
    left: 0;
    top: 0;
    border-radius: 10px;
}

@keyframes glowing {
    0% { background-position: 0 0; }
    50% { background-position: 400% 0; }
    100% { background-position: 0 0; }
}
</style>
</head>

<body class="hold-transition layout-top-nav">

    <div class="wrapper" style="font-family:Ouchan2 !important">


        <!-- /.navbar -->


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper d-flex justify-content-center align-items-center" style="">
            <!-- Content Header (Page header) -->
            <div class="content-header-welcomepage">
                <div class="container">
                    <div class="row mb-2">
                        <!-- <div class="col-12" style="width:100%; height:100%;position:absolute;left:0;top:0;
                        background-image:url({{asset('img/cta_logo_red.png')}});
                        background-repeat: no-repeat;
                        background-size: 800px;
                        background-position: center; 
                        opacity:0.2; 
                        ">

                        </div> -->
                        <div class="col-12 d-flex justify-content-center align-items-center flex-column">
                          <!-- <div onclick="window.location.href='/'">    -->
                            <img src="{{asset('img/cta_logo_red.png')}}" class="text-center brand-image-welcome-logo2 mb-2">
                            <!-- <img src="{{asset('img/CTALogo.png')}}" class="text-center brand-image-welcome-logo2"> -->
                                <h1 class="welcoming" style="font-family:Ouchan2">
                                ༄༄། །བོད་མིའི་སྒྲིག་འཛུགས་ཀྱི་གློག་འཕྲུལ་ཡིག་ཚགས་དབུ་འབྱེད་མཛད་སྒོ་ལ་ཕེབས་པར་
                                </h1>
                                <h1 class="welcoming" style="font-family:Ouchan2">
                                དགའ་བསུ་ཞུ།
                                </h1>
                                <!-- <h1 class="welcoming" style="font-family:Ouchan2">
                                    དབུ་འབྱེད་མཛད་སྒོ་ལ་ཕེབས་པར་དགའ་བསུ་ཞུ།
                                </h1> -->
                            <!-- </div> -->
                            <!-- <a href="/" class="btn mr-md-2 mb-md-0 mb-2 btn-primary btn-lg">                                
                                launch
                            </a> -->
                            <button class="glow-on-hover h2 p-2" type="button" onclick="window.location.href='/'" >དབུ་འབྱེད།</button>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="{{asset('/vendor/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('/js/adminlte.min.js')}}"></script>
</body>

</html>