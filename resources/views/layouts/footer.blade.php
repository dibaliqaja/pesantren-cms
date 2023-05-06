<footer class="main-footer">
    <div class="footer-left">
        Copyright &copy; {{ date('Y') }} 
        <div class="bullet"></div> Pondok Pesantren Ash-Shomadiyah Komplek Tengah | Template by <a href="https://getstisla.com/" target="_blank">Stisla</a>
    </div>
    <div class="footer-right">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</footer>
</div>
</div>

@yield('modal')

<!-- General JS Scripts -->
<script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
{{-- <script src="{{ asset('assets/modules/popper.js') }}"></script> --}}
{{-- <script src="{{ asset('assets/modules/tooltip.js') }}"></script> --}}
<script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('assets/modules/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/stisla.js') }}"></script>
<script src="{{ asset('assets/modules/select2/dist/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }}"></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }}"></script>

<!-- JS Libraies -->
<script src="{{ asset('assets/js/page/modules-datatables.js') }}"></script>

<!-- Page Specific JS File -->
@yield('script')

<script>
$('.alert').alert()
</script>

<!-- Template JS File -->
<script src="{{ asset('assets/js/scripts.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
</body>

</html>
