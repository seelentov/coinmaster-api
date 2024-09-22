<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="email" value="{{ $email }}">

    <div class="form-group">
        <label for="password">Новый пароль:</label>
        <input type="password" minlength="8" required class="form-control" id="password" name="password">
    </div>

    <div class="form-group">
        <label for="password_confirmation">Повторите пароль:</label>
        <input type="password" minlength="8" required class="form-control" id="password_confirmation" name="password_confirmation">

        @if(isset($message))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>

        @endif
    </div>

    <button type="submit" class="btn btn-primary">Сбросить пароль</button>
</form>
