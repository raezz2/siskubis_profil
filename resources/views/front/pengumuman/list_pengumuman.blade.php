@extends('layouts.front')
@section('content')
<section class="home">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{route('single')}}">
                                    <img src="{{asset('assets/images/news/img11.jpg')}}" alt="Sample Article">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Film</a>
                                    </div>
                                    <div class="time">December 19, 2016</div>
                                </div>
                                <h1><a href="{{route('single')}}">Donec consequat arcu at ultrices sodales quam erat aliquet diam</a></h1>
                                <p>
                                    Donec consequat, arcu at ultrices sodales, quam erat aliquet diam, sit amet interdum libero nunc accumsan nisi.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                        <div>273</div>
                                    </a>
                                    <a class="btn btn-primary more" href="{{route('single')}}">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <div class="badge">
                                Sponsored
                            </div>
                            <figure>
                                <a href="{{route('single')}}">
                                    <img src="{{asset('assets/images/news/img02.jpg')}}" alt="Sample Article">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Travel</a>
                                    </div>
                                    <div class="time">December 18, 2016</div>
                                </div>
                                <h1><a href="{{route('single')}}">Maecenas accumsan tortor ut velit pharetra mollis</a></h1>
                                <p>
                                    Maecenas accumsan tortor ut velit pharetra mollis. Proin eu nisl et arcu iaculis placerat sollicitudin ut est. In fringilla dui.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                        <div>4209</div>
                                    </a>
                                    <a class="btn btn-primary more" href="{{route('single')}}">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{route('single')}}">
                                    <img src="{{asset('assets/images/news/img03.jpg')}}" alt="Sample Article">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Travel</a>
                                    </div>
                                    <div class="time">December 16, 2016</div>
                                </div>
                                <h1><a href="{{route('single')}}">Nulla facilisis odio quis gravida vestibulum Proin venenatis pellentesque arcu</a></h1>
                                <p>
                                    Nulla facilisis odio quis gravida vestibulum. Proin venenatis pellentesque arcu, ut mattis nulla placerat et.
                                </p>
                                <footer>
                                    <a href="#" class="love active"><i class="ion-android-favorite"></i>
                                        <div>302</div>
                                    </a>
                                    <a class="btn btn-primary more" href="{{route('single')}}">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                    <article class="col-md-12 article-list">
                        <div class="inner">
                            <figure>
                                <a href="{{route('single')}}">
                                    <img src="{{asset('assets/images/news/img09.jpg')}}" alt="Sample Article">
                                </a>
                            </figure>
                            <div class="details">
                                <div class="detail">
                                    <div class="category">
                                        <a href="#">Healthy</a>
                                    </div>
                                    <div class="time">December 16, 2016</div>
                                </div>
                                <h1><a href="{{route('single')}}">Maecenas blandit ultricies lorem id tempor enim pulvinar at</a></h1>
                                <p>
                                    Maecenas blandit ultricies lorem, id tempor enim pulvinar at. Curabitur sit amet tortor eu ipsum lacinia malesuada.
                                </p>
                                <footer>
                                    <a href="#" class="love"><i class="ion-android-favorite-outline"></i>
                                        <div>783</div>
                                    </a>
                                    <a class="btn btn-primary more" href="{{route('single')}}">
                                        <div>More</div>
                                        <div><i class="ion-ios-arrow-thin-right"></i></div>
                                    </a>
                                </footer>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            <div class="col-xs-6 col-md-4 sidebar" id="sidebar">
                <div class="sidebar-title for-tablet">Sidebar</div>
                <aside>
                    <h1 class="aside-title">Popular <a href="#" class="all">See All <i class="ion-ios-arrow-right"></i></a></h1>
                    <div class="aside-body">
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img07.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">Fusce ullamcorper elit at felis cursus suscipit</a></h1>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img14.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">Duis aute irure dolor in reprehenderit in voluptate velit</a></h1>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img09.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">Aliquam et metus convallis tincidunt velit ut rhoncus dolor</a></h1>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img11.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">dui augue facilisis lacus fringilla pulvinar massa felis quis velit</a></h1>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img06.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">neque est semper nulla, ac elementum risus quam a enim</a></h1>
                                </div>
                            </div>
                        </article>
                        <article class="article-mini">
                            <div class="inner">
                                <figure>
                                    <a href="{{route('single')}}">
                                        <img src="{{asset('assets/images/news/img03.jpg')}}" alt="Sample Article">
                                    </a>
                                </figure>
                                <div class="padding">
                                    <h1><a href="{{route('single')}}">Morbi vitae nisl ac mi luctus aliquet a vitae libero</a></h1>
                                </div>
                            </div>
                        </article>
                    </div>
                </aside>
                <aside>
                    <div class="aside-body">
                        <form class="newsletter">
                            <div class="icon">
                                <i class="ion-ios-email-outline"></i>
                                <h1>Newsletter</h1>
                            </div>
                            <div class="input-group">
                                <input type="email" class="form-control email" placeholder="Your mail">
                                <div class="input-group-btn">
                                    <button class="btn btn-primary"><i class="ion-paper-airplane"></i></button>
                                </div>
                            </div>
                            <p>By subscribing you will receive new articles in your email.</p>
                        </form>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection