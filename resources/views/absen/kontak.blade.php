<div id="kontak-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Detail Kontak</h5>
        <div class="uk-margin">
            @php
                $regex = '/[0-9]/';
                preg_match_all($regex, $siswa->telp, $result);
                $nope = '-';
                if (count($result[0]) > 0) {
                    $nope = implode('', $result[0]);
                    if (substr($nope, 0, 1) == '0') {
                        $nope = '62' . substr($nope, 1);
                    }
                }
                $text = 'Assalamualaikum Wr Wb, Mohon maaf mengganggu Bapak/Ibu Wali Santri. Saya dari SMA Islam Parlaungan yang bertugas piket hari ini. Berdasarkan sistem absensi dan hasil pemeriksaan di lapangan, ananda *' .$siswa->nama_siswa. '* tidak hadir di sekolah. Mohon Bapak/Ibu konfirmasi bagaimana keterangan untuk ananda dengan membalas pesan ini. Matur suwun.';
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