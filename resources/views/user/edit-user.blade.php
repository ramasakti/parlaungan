<div id="edit-user-{{ $user[0]->username }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <h5>Edit User</h5>
        <form method="POST" action="/user/update" enctype="multipart/form-data">
            @csrf
            <div class="uk-margin">
                <input class="uk-input" type="text" name="username" placeholder="Username" value="{{ $user[0]->username }}" readonly>
            </div>
            <div class="uk-margin">
                <div class="uk-inline uk-width-1-1">
                    <a class="uk-form-icon uk-form-icon-flip" id="iconNewPass-{{ $user[0]->username }}" href="#" uk-icon="icon: eye-slash" onclick="showhidePassword('{{ $user[0]->username }}')"></a>
                    <input class="uk-input" type="password" name="password" id="passwordBaru-{{ $user[0]->username }}" placeholder="Password Baru">
                </div>
            </div>
            @if ($user[0]->foto != '')
                <img class="image-wrapper uk-border-circle uk-align-center" src="data:image/png;base64,{{ $user[0]->foto }}" alt="" srcset="">
            @endif
            <div class="uk-margin">
                <label for="foto" class="form-label">Foto Profil</label>
                <input type="file" class="form-control" id="foto" name="foto" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
            </div>
            @if ($user[0]->status != 'Siswa' and $user[0]->status != 'Walmur')
                <div class="uk-margin">
                    <select class="uk-select" name="status" required>
                        <option value="Siswa" {{ ($user[0]->status === 'Siswa') ? 'selected' : '' }}>Siswa</option>
                        <option value="Guru" {{ ($user[0]->status === 'Guru') ? 'selected' : '' }}>Guru</option>
                        <option value="Bendahara" {{ ($user[0]->status === 'Bendahara') ? 'selected' : '' }}>Bendahara</option>
                        <option value="Kesiswaan" {{ ($user[0]->status === 'Kesiswaan') ? 'selected' : '' }}>Kesiswaan</option>
                        <option value="Kurikulum" {{ ($user[0]->status === 'Kurikulum') ? 'selected' : '' }}>Kurikulum</option>
                        <option value="Kepala Sekolah" {{ ($user[0]->status === 'Kepala Sekolah') ? 'selected' : '' }}>Kepala Sekolah</option>
                        <option value="Admin" {{ ($user[0]->status === 'Admin') ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            @endif
            @if ($user[0]->status == 'Siswa')
                <input type="hidden" name="status" value="Siswa">
            @endif
            <button type="submit" class="uk-button uk-button-primary uk-button-small">Simpan</button>
        </form>
    </div>
</div>
<script>
    const showhidePassword = (username) => {
        const passwordBaru = document.getElementById('passwordBaru-' + username)
        const iconNewPass = document.getElementById('iconNewPass-' + username)

        if (iconNewPass.getAttribute('uk-icon') == 'icon: eye-slash') {
            passwordBaru.setAttribute('type', 'text')
            iconNewPass.setAttribute('uk-icon', 'icon: eye')
        }else{
            passwordBaru.setAttribute('type', 'password')
            iconNewPass.setAttribute('uk-icon', 'icon: eye-slash')
        }
    }
    
    
</script>