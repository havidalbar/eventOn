@extends (\Session::has('username') ? 'layouts.navLogin' : 'layouts.nav')
@section('title', 'Pesan Proyek | Aderim')

@section('js')
<script type="text/javascript">
Dropzone.options.myDropzone = {
    addRemoveLinks: true,
    paramName: 'file',
    maxFilesize: 20, // MB
    maxFiles: 4,
    acceptedFiles: "image/*",
    init: function() {
        this.on("success", function(file, response) {
            let hasil = 'image/' + response;
            var forms = document.getElementById('tambah-order');
            var files = document.createElement("input");
            files.setAttribute('name', 'files[]');
            files.setAttribute("type", "hidden");
            files.setAttribute("value", hasil);
            forms.appendChild(files);
        });
        this.on("addedfile", function() {});
    },
    removedfile: function(file) {
        var _ref;
        return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;
    }
};
</script>
<script>
$(document)
    .ready(function() {
        $('.ui.form')
            .form({
                fields: {
                    pesan: {
                        identifier: 'pesan',
                        rules: [{
                            type: 'empty',
                            prompt: 'Silahkan masukkan deskripsi pesanan proyek anda terlebih dahulu'
                        }]
                    },
                    alamat: {
                        identifier: 'alamat',
                        rules: [{
                            type: 'empty',
                            prompt: 'Alamat pengerjaan proyek tidak boleh dikosongkan!'
                        }]
                    }
                }
            });
    });
</script>
@endsection

@section('content')
<div class="ui container" style="color:#4d4d4d;margin-top:50px">
    <div style="max-width:700px;margin: 0 auto;border:1px solid #e1e2e3;border-radius:6px;padding:40px 45px 40px 45px">
        <div style="font-size:28px"><b>Pesan Proyek</b></div>
        <div style="font-size:20px;margin-top:15px;line-height:1.5">
            Anda akan melakukan pemesanan proyek dari profesi :
        </div>
        <div class="ui stackable grid" style="margin-top:5px">
            <div class="three wide column">
                <img class="ui circular image" src="{{asset($profesi->foto)}}"
                    style="width:80px;height:80px;object-fit:cover">
            </div>
            <div class="thirteen wide column">
                <div style="font-size:22px"><b>{{ucfirst($profesi->nama_profesi)}}</b></div>
                <div style="margin-top:5px;display:flex;flex-direction:row;align-items: center">
                    <div><i class="map marker alternate teal icon"></i></div>
                    <div style="font-size:18px">{{ucfirst($desProject->daerah)}}</div>
                </div>
            </div>
        </div>
        <div class="ui divider"></div>
        <div class="ui container fluid" style="margin-top:20px">
            <div style="font-size:18px"><b>Gambar Desain</b></div>
            <form action="{{ url('/uploadFotoOrder') }}" enctype="multipart/form-data" class="dropzone" id="my-dropzone"
                style="margin-top:5px">
                {{csrf_field()}}
            </form>
            <button id="submit-all" type="submit" class="submitDropzone" style="display:none">Unggah</button>
            <!-- Cek data -->
            @if(\Session::has('alert'))
            <div class="ui negative message">
                <p>{{Session::get('alert')}}</p>
            </div>
            @endif
        </div>
        <form class="ui form" style="margin-top:15px" id="tambah-order" method='post'
            action="{{url('/tambah-orderproses')}}" enctype="multipart/form-data">
            <input type="hidden" name="id_project" value="{{$desProject->id}}" />
            <input type="hidden" name="id_user" value="{{Session::get('id')}}" />
            <input type="hidden" name="id_profesi" value="{{$desProject->id_profesi}}" />
            <div class="field">
                <label style="font-size:18px">Deskripsi Proyek</label>
                <textarea name="pesan" maxlength="500" rows="6" placeholder="Tuliskan deskripsi pesanan proyek anda..."></textarea>
            </div>
            <div class="field">
                <label style="font-size:18px">Alamat Pengerjaan Proyek</label>
                <input type="text" name="alamat">
            </div>
            <div class="field">
                <label style="font-size:18px">Total Biaya Proyek</label>
                <div class="ui labeled fluid input" style="font-size:18px">
                    <label class="ui label">Rp</label>
                    <input type="text" name="estimasi" value="{{number_format(($desProject->estimasi),0,",",".")}}"
                        readonly style="background-color:#e8e8e8;border:none">
                </div>
            </div>
            <div style="margin-top:20px;padding:20px 20px 20px 20px;border-radius:5px;background-color:#F7EFD2">
                <div class="ui grid">
                    <div class="one wide column middle aligned">
                        <i class="info circle large teal icon"></i>
                    </div>
                    <div class="fifteen wide column" style="font-size:14px;line-height:1.5">
                        Pembayaran total biaya proyek dilakukan secara bertahap sebanyak 4 kali. Pembayaran dilakukan untuk progres pengerjaan proyek selama 6 bulan kedepan.
                    </div>
                </div>
            </div>
            {{csrf_field()}}
            <button class="ui big teal button fluid" onclick="" type="submit" name="submit" style="margin-top:30px">
                Periksa Pesanan Proyek
            </button>
            <div class="ui error message">
                <ul class="list">
                </ul>
            </div>
        </form>
    </div>
</div>


@include('layouts.footer')
@endsection
