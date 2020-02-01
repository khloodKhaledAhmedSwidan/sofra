
<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="footer-desc">
                    <div class="who-us">
                        <i class="fa fa-pencil"></i>
                        <h3>من نحن</h3>
                    </div>
                    <p>{{$settings->about_us}}</p>
                    <ul class="list-unstyled links">
                        <li>
                            <a href="#" class="fa fa-facebook-square"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-twitter"></a>
                        </li>
                        <li>
                            <a href="#" class="fa fa-instagram"></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <a href="index.html" class="footer-logo">
                    <img src="{{asset('public/web/images/sofra logo-1.png')}}" alt="Footer-logo">
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
{{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"--}}
{{--        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"--}}
{{--        crossorigin="anonymous"></script>--}}
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script>
    @if(session()->exists('fail'))
    Swal.fire({
        title: 'Error!',
        text: '{{session('fail')}}',
        icon: 'error',
        confirmButtonText: 'Cool'
    })
    @elseif(session()->exists('success'))
    Swal.fire({
        title: 'success!',
        text: '{{session('success')}}',
        icon: 'success',
        confirmButtonText: 'Cool'
    })
    @endif
</script>
@stack('script')

</body>

</html>
