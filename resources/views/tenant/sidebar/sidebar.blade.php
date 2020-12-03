        <div class="sidebar-panel bg-white">
            <div class="gull-brand pr-3 text-center mt-4 mb-2 d-flex justify-content-center align-items-center"><img class="pl-3" src="{{ asset('theme/images/logo.png')}}" alt="alt" />
                <span class=" item-name text-20 text-primary font-weight-700">SISKUBIS</span>
                <div class="sidebar-compact-switch ml-auto"><span></span></div>
            </div>
            <!--  user -->
            <div class="scroll-nav ps ps--active-y" data-perfect-scrollbar="data-perfect-scrollbar" data-suppress-scroll-x="true">
                <div class="side-nav">
                    <div class="main-menu">
                        <ul class="metismenu" id="menu">
                            <li class="Ul_li--hover"><a class="active" href="{{ route('tenant.home')}}"><i class="i-Bar-Chart text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Dashboard</span></a>
                            </li>
                            <li class="Ul_li--hover"><a class="" href="{{route('tenant.detail-tenant')}}"><i class="i-Administrator text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Tenant</span></a>
                            </li>
                            <li class="Ul_li--hover"><a class="" href="{{ route('tenant.mentor') }}"><i class="i-Administrator text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Pendamping</span></a>


                            </li>
                            <li class="Ul_li--hover">
                                <a class="" href="{{route('tenant.produk')}}"><i class="i-Suitcase text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Produk</span></a>
                            </li>
                            <li class="Ul_li--hover"><a class="" href="#"><i class="i-Computer-Secure text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Aktifitas</span></a>
                            </li>
                            <!--  <p class="main-menu-title text-muted ml-3 font-weight-700 text-13 mt-4 mb-2">UI Elements</p> -->
                            <li class="Ul_li--hover"><a class="" href="{{route('tenant.keuangan')}}"><i class="i-Computer-Secure text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Keuangan</span></a>
                            </li>

                            <li class="Ul_li--hover"><a class="" href="#"><i class="i-File-Clipboard-File--Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Pencapaian</span></a>
                            </li>
                            <li class="Ul_li--hover"><a href="datatables.html"><i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Laporan</span></a></li>
                            <li class="Ul_li--hover"><a class="has-arrow" href="#"><i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Persuratan</span></a>

                                <ul class="mm-collapse">
                                    <li class="item-name"><a href="/tenant/suratmasuk"><i class="nav-icon i-Error-404-Window"></i><span class="item-name">Surat Masuk</span></a></li>
                                    <li class="item-name"><a href="/tenant/suratkeluar"><i class="nav-icon i-Male"></i><span class="item-name">Surat Keluar</span></a></li>
                                </ul>
                            </li>
                            <li class="Ul_li--hover"><a class="" href="{{route('tenant.event-list')}}"><i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Event</span></a></li>
                            <li class="Ul_li--hover"><a class="" href="#"><i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Beritas</span></a></li>
                            <li class="Ul_li--hover"><a class="" href="{{ route('tenant.pengumuman')}}"><i class="i-File-Horizontal-Text text-20 mr-2 text-muted"></i><span class="item-name text-15 text-muted">Pengumuman</span></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
                </div>
                <div class="ps__rail-x" style="left: 0px; bottom: 0px;">
                    <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                </div>
                <div class="ps__rail-y" style="top: 0px; height: 404px; right: 0px;">
                    <div class="ps__thumb-y" tabindex="0" style="top: 0px; height: 325px;"></div>
                </div>
            </div>
            <!--  side-nav-close -->
        </div>
