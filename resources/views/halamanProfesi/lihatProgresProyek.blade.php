@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Progres Proyek | Aderim')

@section('content')

<div class="ui container" style="padding:65px 0px 65px 0px">
    <h2>Progres Pembelian Tiket</h2>
    <div class="ui divider" style="margin-bottom:20px"></div>
    <div class="ui stackable grid">
        <div class="ten wide column">
            <div class="ui stackable grid" style="height:100%">
                
                <div class="twelve wide column">
                    <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img class="ui big image" src="/tur.jpg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    {{-- @for($j=0; $j < count($fotos); $j++) --}}
                    <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img src="/tur.jpg"
                                    style="height:145px;object-fit:cover">
                            </div>
                        </div>
                    </div>
                    {{-- @endfor --}}
                </div>
            </div>
        </div>
        <div class="six wide column">
            <div class="ui divider"></div>
            <div class="ui grid">
                <div class="one wide middle aligned column">
                    <i class="info circle large teal icon"></i>
                </div>
                <div class="fourteen wide middle aligned column" style="margin-left:5px">
                    <div style="font-size:22px;color:teal"><b>Detail Progres Penjualan</b></div>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="four wide column">
                    <img class="ui circular image" src="/tur.jpg"
                        style="width:80px;height:80px;object-fit:cover">
                </div>
                <div class="twelve wide middle aligned column">
                    <div style="font-size:22px"><b>Ibnurasgriz24</b></div>
                <div style="font-size:17px">jack.fast83@gmail.com</div>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="twelve wide middle aligned column">
                    <div style="font-size:22px">
                    <b>Tur Tulus</b>
                    </div>
                    <div style="margin-top:10px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div style="font-size:16px">Malang Ex-Bioskop Kelud</div>
                    </div>
                </div>
                <div class="four wide right aligned middle aligned column">
                    <span style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                        Konser
                    </span>
                </div>
            </div>
            <div class="ui divider"></div>
            <div style="font-size:20px"><b>Progres Proyek</b></div>
            <div style="font-size:17px;margin-top:10px">
                <span>Bulan </span>
            <span>Proses Penjualan Tiket</span>
            </div>
            <div style="font-size:20px;margin-top:15px"><b>Deskripsi Progres</b></div>
            <div style="font-size:17px;margin-top:10px;line-height:1.5">
                {{-- {{$orderProgres->pesan}} --}}
            </div>
            <div class="ui divider"></div>
            <button class="ui large button teal right floated" onclick="window.location.href='/halaman-profesi/tambah-progres'">Tambah Progres</button>
        </div>
    </div>

    <div class="ui divider" style="margin-top:20px"></div>
    <h3>Lihat Progres Pembelian Tiket Bulan Ke</h3>
    
    <div class="ui pagination menu">
    {{-- @for($j=1; $j<= $bulan; $j++) --}}
    <a class="item" onclick="window.location.href='/halaman-profesi/progres/'"></a>
    {{-- @endfor --}}
    </div>
</div>

@include('layouts.footer')
@endsection
