    <main class="py-4">
        <script src="{{asset('jquery-3.3.1.min.js')}}"></script>
        @yield('content')
        @if(Auth::user()->user_type == 1)
            <script>
                if(localStorage.getItem('sub_store') == 1){
                    $('#Home').addClass('active');
                    $('#mailbox').removeClass('active');
                }else{
                    $('#Home').removeClass('active');
                    $('#mailbox').addClass('active');
                }
                $('#mailbox ul li ').click(function () {
                    localStorage.setItem('sub_store',0);
                });
                $('#Home ul li ').click(function () {
                    localStorage.setItem('sub_store',1);
                });
            </script>
        @elseif(Auth::user()->user_type == 3)
            <script>
                if(localStorage.getItem('sub_store') == 0){

                    $('#Home').removeClass('active');
                    $('#mailbox').addClass('active');
                }else{
                    $('#Home').addClass('active');
                    $('#mailbox').removeClass('active');
                }
                $('#mailbox ul li ').click(function () {
                    localStorage.setItem('sub_store',0);
                });
            </script>
        @else
            <script>
                if(localStorage.getItem('sub_store') == 1){
                    $('#Home').removeClass('active');
                    $('#mailbox').addClass('active');
                }else{
                    $('#mailbox').removeClass('active');
                    $('#Home').addClass('active');
                }
                $('#mailbox ul li ').click(function () {
                    localStorage.setItem('sub_store',1);
                });
                $('#Home ul li ').click(function () {
                    localStorage.setItem('sub_store',0);
                });
            </script>
        @endif

    </main>

    <script src="{{asset('temp_js/vendor/jquery-1.12.4.min.js')}}"></script>
    <script src="{{asset('temp_js/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('temp_js/dropzone/dropzone.js')}}"></script>

    <!-- bootstrap JS
		============================================ -->
    <script src="{{asset('temp_js/bootstrap.min.js')}}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{asset('temp_js/wow.min.js')}}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{asset('temp_js/jquery-price-slider.js')}}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{asset('temp_js/owl.carousel.min.js')}}"></script>
    <!-- scrollUp JS
		============================================ -->
    <script src="{{asset('temp_js/jquery.scrollUp.min.js')}}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{asset('temp_js/meanmenu/jquery.meanmenu.js')}}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{asset('temp_js/counterup/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('temp_js/counterup/waypoints.min.js')}}"></script>
    <script src="{{asset('temp_js/counterup/counterup-active.js')}}"></script>
    <!-- mCustomScrollbar JS
		============================================ -->
    <script src="{{asset('temp_js/scrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <!-- sparkline JS
		============================================ -->
    <script src="{{asset('temp_js/sparkline/jquery.sparkline.min.js')}}"></script>
    <script src="{{asset('temp_js/sparkline/sparkline-active.js')}}"></script>
    <!-- flot JS
		============================================ -->
    <script src="{{asset('temp_js/flot/jquery.flot.js')}}"></script>
    <script src="{{asset('temp_js/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{asset('temp_js/flot/flot-active.js')}}"></script>
    <!-- knob JS
		============================================ -->
    <script src="{{asset('temp_js/knob/jquery.knob.js')}}"></script>
    <script src="{{asset('temp_js/knob/jquery.appear.js')}}"></script>
    <script src="{{asset('temp_js/knob/knob-active.js')}}"></script>
    <!--  Chat JS
		============================================ -->
    <script src="{{asset('temp_js/chat/jquery.chat.js')}}"></script>
    <!--  wave JS
		============================================ -->

    <script src="{{asset('temp_js/wave/waves.min.js')}}"></script>
    <script src="{{asset('temp_js/wave/wave-active.js')}}"></script>
    <!-- icheck JS
		============================================ -->
    <script src="{{asset('temp_js/icheck/icheck.min.js')}}"></script>
    <script src="{{asset('temp_js/icheck/icheck-active.js')}}"></script>
    <!--  todo JS
		============================================ -->
    <script src="{{asset('temp_js/todo/jquery.todo.js')}}"></script>
    <!-- Login JS
		============================================ -->
    <script src="{{asset('temp_js/login/login-action.js')}}"></script>
    <!-- plugins JS
		============================================ -->
    <script src="{{asset('temp_js/plugins.js')}}"></script>
    <!-- main JS
		============================================ -->
    <script src="{{asset('temp_js/main.js')}}"></script>

    <script src="{{asset('temp_js/dialog/sweetalert2.min.js')}}"></script>
    <!-- data tables -->
    <script src="{{asset('temp_js/data-table/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('temp_js/data-table/data-table-act.js')}}"></script>



    <script src="{{asset('temp_js/notification/bootstrap-growl.min.js')}}"></script>
    <script src="{{asset('temp_js/notification/notification-active.js')}}"></script>

</body>
</html>
