@extends ('layouts.nav')
@section('title', 'Periksa Pesanan Event | EventOn')

@section('content')
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div class="ui stackable grid">
            <div class="ten wide middle aligned column">
                <div style="font-size:28px;line-height:1"><b>Periksa Pesanan Event</b></div>
            </div>
            <div class="six wide column">
                <button class="ui button red right floated" onclick="$('.ui.tiny.modal.batal').modal('show')">Batal
                    Pesan</button>
            </div>
        </div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Anda melakukan pemesanan event :
        </div>
        <div class="ui stackable grid" style="margin-top:5px">
            <div class="three wide column">
                <img class="ui circular image" src="/image/2019/04/2QQrg23806.jpg"
                    style="width:80px;height:80px;object-fit:cover">
            </div>
            <div class="thirteen wide column">
                <div style="font-size:22px"><b>tes</b></div>
                <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate teal icon"></i></div>
                    <div style="font-size:18px">Malang</div>
                </div>
            </div>
        </div>
        <?php
        
        ?>
        <div class="ui divider"></div>
        <div style="font-size:18px"><b>Event</b></div>
        <div class="ui container fluid" style="margin-top:40px">
            <div class="ui four stackable cards">
                {{-- @for($j=0; $j < count($fotos); $j++) <div class="card"> --}}
                    <div class="image">
                        <img src="/image/2019/04/2QQrg23806.jpg" style="height:100px;object-fit:cover">
                    </div>
            </div>
            {{-- @endfor --}}
        </div>
    </div>
    <form class="ui form" style="margin-top:15px" id="tambah-order" method='post' action="{{url('/transaksiorder')}}"
        enctype="multipart/form-data">
        <div class="field">
            <label style="font-size:18px">Deskripsi Event</label>
            <textarea name="pesan" rows="6" placeholder="Musik" required type="text" readonly
                style="background-color:#e8e8e8;border:none"></textarea>
        </div>
        <div class="field">
            <label style="font-size:18px">Total Biaya Tiket Event</label>
            <div class="ui labeled fluid input" style="font-size:18px">
                <label class="ui label">Rp</label>
                <input type="text" name="jumlah1" value="12222" readonly
                    style="background-color:#e8e8e8;border:none">
                <input type="hidden" name="jumlah" value="22222" />
            </div>
        </div>
        <div class="field">
            <label style="font-size:18px">Pembayaran Saat Ini</label>
            <div class="ui labeled fluid input" style="font-size:18px">
                <label class="ui label">Rp</label>
                <input type="text" name="bayar" value="122222" readonly
                    style="background-color:#e8e8e8;border:none">
            </div>
        </div>
        <div class="field">
            <label style="font-size:18px">Sisa Pembayaran</label>
            <div class="ui labeled fluid input" style="font-size:18px">
                <label class="ui label">Rp</label>
                <input type="text" name="sisaharga1"
                    value="{{11122}}" readonly
                    style="background-color:#e8e8e8;border:none">
                    <input type="hidden" name="sisaharga" value="{{122222}}" />
            </div>
        </div>
        {{csrf_field()}}
        <button class="ui big teal button fluid" onclick="" type="submit" name="submit" style="margin-top:40px">
            Pilih Metode Pembayaran
        </button>
    </form>
</div>
</div>

<!-- Dimmer Batal -->
<div class="ui tiny modal batal">
    <div class="header">
        Selesai
    </div>
    <div class="content">
        <div style="font-size:18px">Apa anda yakin ingin membatalkan pesanan tiket?</div>
    </div>
    <div class="actions">
        <div style="display:flex;flex-direction:row-reverse">
            <form action='/hapusorder?id=122' method="post">
                {{csrf_field()}}
                <button class="ui positive button">
                    Iya
                </button>
            </form>
            <button class="ui negative button" style="margin-right:10px">
                Tidak
            </button>
        </div>
    </div>
</div>

@include('layouts.footer')
@endsection
