<footer class="footer py-5">
    <div class="container">
        <div class="row">
            @if (!auth()->user() || \Request::is('static-sign-up'))
            <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-twitter" aria-hidden="true"></span>
                </a>
                <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-instagram" aria-hidden="true"></span>
                </a>
                <a href="#" target="_blank" class="text-secondary me-xl-4 me-4">
                    <span class="text-lg fab fa-github" aria-hidden="true"></span>
                </a>
            </div>
            @endif
        </div>
        @if (!auth()->user() || \Request::is('static-sign-up'))
        <div class="row">
            <div class="col-8 mx-auto text-center mt-1">
                <p class="mb-0 text-secondary">
                    Copyright © <script>
                    document.write(new Date().getFullYear())

                    </script> NerdsterCRM
                </p>
            </div>
        </div>
        @endif
    </div>
</footer>
