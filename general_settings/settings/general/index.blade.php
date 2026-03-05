 @extends('theme.main')
 @section('css')
     <style>
         .card-box {
             padding: inherit;
         }

         .bdr-right {
             border-right: solid 1px;
             border-right-color: #e3e6ea;
         }

         #leftsidebar-menu>ul>li>a {
             color: #6e768e;
             display: block;
             padding: 3px 5px;
             position: relative;
             -webkit-transition: all .4s;
             transition: all .4s;
             font-size: 15.5px;
         }

         #leftsidebar-menu>ul>li {
             border-bottom: dotted 1px;
             border-bottom-color: #e3e6ea;
         }

         .mactive {
             font-weight: 500;
         }

         .setting-title {
             font-weight: 500;
         }
     </style>
 @endsection
 @section('content')
     <div class="content">
         <div class="container-fluid">
             <div class="page-title-box">
                 <div class="row">
                     <div class="col-md-3">
                         <h4 class="page-title"><i class="icon-present"></i>&nbsp;{{ translate('general_settings') }}</h4>
                     </div>

                     <div class="col-md-9">
                         <div class="page-title-left">
                             <div class="titlemenu">

                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="row">
                 <div class="col-md-12 col-xl-12">
                     <div class="card-box" id="filter_div" style="padding:inherit">
                         <div class="card-body row">
                             <div class="col-sm-2 bdr-right ">
                                @include('settings.settings_menu')
                             </div>
                             <div class="col-sm-10 ">
                                 @include('settings.general.form')
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     
 @endsection
