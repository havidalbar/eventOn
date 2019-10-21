@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Progres Proyek | Aderim')

@section('content')

<div class="ui container" style="padding:65px 0px 65px 0px">
    <h2>Progres Pengerjaan Proyek</h2>
    <div class="ui divider" style="margin-bottom:20px"></div>
    <div class="ui stackable grid">
        <div class="ten wide column">
            <div class="ui stackable grid" style="height:100%">
                <?php
                $fotos = explode(" ", $acara->foto_acara);
                ?>
                <div class="twelve wide column">
                    <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img class="ui big image" src="{{asset($fotos[0])}}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="four wide column">
                    @for($j=0; $j < count($fotos); $j++)
                    <div class="ui one stackable cards">
                        <div class="card">
                            <div class="image">
                                <img src="{{asset($fotos[$j])}}"
                                    style="height:145px;object-fit:cover">
                            </div>
                        </div>
                    </div>
                    @endfor
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
                    <div style="font-size:22px;color:teal"><b>Detail Progres Proyek</b></div>
                    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(400)->generate(encrypt($acara->kode_pesanan))) }} ">                    >
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="four wide column">
                    <img class="ui circular image" src="{{asset($panitia->foto)}}"
                        style="width:80px;height:80px;object-fit:cover">
                </div>
                <div class="twelve wide middle aligned column">
                <div style="font-size:22px"><b>{{ucfirst($panitia->nama_panitia)}}</b></div>
                <div style="font-size:17px;margin-top:5px">{{$panitia->nohp}}</div>
                </div>
            </div>
            <div class="ui divider"></div>
            <div class="ui stackable grid">
                <div class="twelve wide middle aligned column">
                    <div style="font-size:22px">
                        <b>{{ucfirst($acara->nama_acara)}}</b>
                    </div>
                    <div style="margin-top:10px;display:flex;flex-direction:row;align-items: center">
                        <div><i class="map marker alternate teal icon"></i></div>
                        <div style="font-size:16px">{{ucfirst($acara->lokasi)}}</div>
                    </div>
                </div>
                <div class="four wide right aligned middle aligned column">
                    <span style="border:2px solid #d4d4d5;border-radius:4px;padding:5px 15px 5px 15px;font-size:17px">
                            {{ucfirst($acara->kategori)}}
                    </span>
                </div>
            </div>
            <div class="ui divider"></div>
            <div style="font-size:20px"><b>Progres Proyek</b></div>
            <div style="font-size:17px;margin-top:10px">
                <span>Bulan </span>
                <span>gggg</span>
            </div>
            <div style="font-size:20px;margin-top:15px"><b>Deskripsi Progres</b></div>
            <div style="font-size:17px;margin-top:10px;line-height:1.5">
                   hhh
            </div>
            <div class="ui divider"></div>
        </div>
    </div>

    <div style="margin-top:20px;padding:20px 40px 20px 40px;border-radius:5px;background-color:#F7EFD2">
        <div class="ui grid">
            <div class="one wide column middle aligned">
                <i class="info circle bi teal icon"></i>
            </div>
            <div class="fifteen wide column" style="font-size:16px;line-height:1.5">
                Pembayaran total biaya proyek dilakukan secara bertahap sebanyak 4 kali. Pembayaran dilakukan
                untuk progres pengerjaan proyek selama 6 bulan kedepan. Jika tidak melakukan pembayaran selanjutnya maka progres pengerjaan proyek akan dihentikan untuk sementara waktu.
            </div>
        </div>
    </div>
    <div class="ui divider" style="margin-top:30px"></div>
    <div class="ui pagination menu">
    </div>
</div>

@include('layouts.footer')
@endsection
