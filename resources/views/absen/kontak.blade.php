<div id="kontak-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Detail Kontak</h5>
        <div class="uk-margin">
            @php
                $regex = '/[0-9]/';
                $result = [];
                preg_match_all($regex, $siswa->telp, $result);
                if (count($result[0]) > 0) {
                    if ($result[0][0] == '0') {
                        unset($result[0][0]);
                        $nope = '62'.implode('', $result[0]);
                    }else{
                        $nope = implode('', $result[0]);
                    }
                }else{
                    $nope = '-';
                }
                $text = 'Assalamualaikum Wr Wb, Mohon maaf mengganggu Bapak/Ibu Wali Santri. Kami dari Staff Tata Usaha SMA Islam Parlaungan ingin mengonfirmasi apakah benar nomor ini adalah nomor Wali Santri dari ananda ' .$siswa->nama_siswa. '? Jika benar mohon konfirmasinya dengan membalas pesan ini. Dan jika benar maka kami akan menghubungi Bapak/Ibu ketika ananda tidak hadir di sekolah guna mengkonfirmasi. Matur suwun';
            @endphp
            <p>
                @if ($nope === '-')
                    Belum mengisi nomor WA
                @else
                    <a href="https://wa.me/{{ $nope }}?text={{ $text }}">{{ $siswa->nama_siswa }}</a>
                @endif
            </p>
        </div>
    </div>
</div>