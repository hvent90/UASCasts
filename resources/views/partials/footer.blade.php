<footer id="footer" class="wrap">
    <div class="container">
        <div class="row">
                <div class="row center-dis">
                    <h4 class="logo">UASCasts</h4>


                    <p class="footer__site-description">
                        Learn from the best educational resource for the professional UAS developer.
                    </p>

                    <ul class="footer__connect">
                        <li><a href="http://facebook.com/uascasts"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="http://twitter.com/uascasts"><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>

            <div class="row center-dis footer-fungi">
                <div class="col-xs-2 col-xs-offset-3">
                    <h5>Learn</h5>

                    <ul class="zeroed">
                        <li><a href="/series">Series</a></li>
                        <li><a href="/videos">Videos</a></li>
                        <li><a href="/hardware">Hardware</a></li>
                    </ul>
                </div>

                <div class="col-xs-2">
                    <h5>Related</h5>
                    <ul class="zeroed">
                        <li><a href="http://px4.io">PX4</a></li>
                        <li><a href="http://percepto.co">Percepto</a></li>
                        <li><a href="http://3drobotics.com/">3D Robotics</a></li>
                        <li><a href="mailto:uascasts@helpful.io" data-helpful="uascasts" data-helpful-title="Have a question?" @if(Auth::check()) data-helpful-name="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" data-helpful-email="{{ Auth::user()->email }}" @endif>Customer Support</a></li>
                    </ul>
                </div>

                <div class="col-xs-2">
                    <h5>Join</h5>
                    <ul class="zeroed">
                        <li><a href="/plans">Sign Up</a>
                        </li><li><a href="/auth/login">Log In</a></li>
                    </ul>
                </div>
            </div>


        <div class="footer__bottom">
            <p class="pull-left">
                © UASCasts 2015. All rights reserved.
            </p>

            <div class="pull-right">
                Proudly hosted with <a href="https://forge.laravel.com">Laravel Forge</a> and <a href="https://www.digitalocean.com/">DigitalOcean</a> with inspiration from <a href="https://laracasts.com">Laracasts</a>.
            </div>
        </div>
    </div>
</footer>