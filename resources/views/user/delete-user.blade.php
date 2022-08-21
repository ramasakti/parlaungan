<div id="delete-user-{{ $user->username }}" class="uk-flex-top" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
        <h5>Delete User</h5>
        <p>Yakin delete akun dengan username <b>{{ $user->username }}</b> ?</p>
        <form action="/user/delete/" method="POST">
            @csrf
            <button class="uk-button uk-button-default uk-modal-close" type="button">Cancel</button>
            <input type="hidden" name="username" value="{{ $user->username }}">
            <input type="submit" class="uk-button uk-button-primary" value="Ya">
        </form>
    </div>
</div>