<div id="kontak-{{ $siswa->id_siswa }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Detail Kontak</h5>
        <div class="uk-margin">
            @php
                $detailSiswa = DB::table('detail_siswa')->where('siswa_id', $siswa->id_siswa)->first();
                $regex = '/[0-9]/';
                preg_match_all($regex, $siswa->telp, $result);
                preg_match_all($regex, $detailSiswa->telp_ayah, $resultAyah);
                preg_match_all($regex, $detailSiswa->telp_ibu, $resultIbu);
                $nope = '-';
                $nopeAyah = '-';
                $nopeIbu = '-';
                if (count($result[0]) > 0) {
                    $nope = implode('', $result[0]);
                    if (substr($nope, 0, 1) == '0') {
                        $nope = '62' . substr($nope, 1);
                    }
                }
                if (count($resultAyah[0]) > 0) {
                    $nopeAyah = implode('', $resultAyah[0]);
                    if (substr($nopeAyah, 0, 1) == '0') {
                        $nopeAyah = '62' . substr($nopeAyah, 1);
                    }
                }
                if (count($resultIbu[0]) > 0) {
                    $nopeIbu = implode('', $resultIbu[0]);
                    if (substr($nopeIbu, 0, 1) == '0') {
                        $nopeIbu = '62' . substr($nopeIbu, 1);
                    }
                }
                $text = 'Assalamualaikum Wr Wb, Mohon maaf mengganggu Bapak/Ibu Wali Santri. Saya dari SMA Islam Parlaungan yang bertugas piket hari ini. Berdasarkan sistem absensi dan hasil pemeriksaan di lapangan, ananda *' .$siswa->nama_siswa. '* tidak hadir di sekolah. Mohon Bapak/Ibu konfirmasi bagaimana keterangan untuk ananda dengan membalas pesan ini. Matur suwun.';
            @endphp
            <p>
                <a href="https://wa.me/{{ $nope }}?text={{ $text }}">{{ $siswa->nama_siswa }}</a>
                <p>Ayah {{ $siswa->nama_siswa }}: <a href="https://wa.me/{{ $nopeAyah }}">{{ $detailSiswa->ayah }}</a></p>
                <p>Ibu {{ $siswa->nama_siswa }}: <a href="https://wa.me/{{ $nopeIbu }}">{{ $detailSiswa->ibu }}</a></p>
            </p>
        </div>
    </div>
</div>