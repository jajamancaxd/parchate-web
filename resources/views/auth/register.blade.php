<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url('{{ asset("img/bulevaro.png") }}') no-repeat center center fixed;
      background-size: cover;
    }

    .login-container {
      width: 420px;
      background-color: white;
      margin: 60px auto;
      padding: 40px 25px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      text-align: center;
    }

    .login-container img {
      width: 130px;
      height: 130px;
      transform: scale(1.4);
      margin-bottom: 5px;
    }

    .login-container h1 {
      font-size: 32px;
      font-weight: 800;
      margin-bottom: 20px;
      transform: scale(1.3);
    }

    .form-group {
      display: flex;
      align-items: center;
      margin-bottom: 18px;
    }

    .form-group label {
      width: 120px;
      text-align: left;
      color: #f35c0c;
      font-weight: bold;
    }

    .form-group input[type="email"],
    .form-group input[type="password"] {
      flex: 1;
      padding: 8px 12px;
      border: 1px solid #ccc;
      border-radius: 20px;
      outline: none;
      font-size: 14px;
    }

    .form-options {
      text-align: left;
      font-size: 14px;
      color: #f35c0c;
      margin: 10px 0;
      display: flex;
      justify-content: space-around;
      align-items: center;
    }

    .form-options input[type="radio"] {
      margin-right: 5px;
    }

    .terms {
      font-size: 13px;
      margin: 15px 0;
      color: #f35c0c;
      font-weight: bold;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }

    .login-container button {
      width: 220px;
      padding: 8px;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      border-radius: 8px;
      margin: 8px auto;
      display: block;
    }

    .login-btn {
      background-color: #f35c0c;
      color: white;
      border: none;
    }

    .login-container .links {
      margin-top: 10px;
      font-size: 13px;
    }

    .login-container .links a {
      color: gray;
      text-decoration: none;
    }

    .login-container .links a:hover {
      text-decoration: underline;
    }

    .error {
      color: red;
      font-size: 14px;
      text-align: left;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <img src="{{ asset('img/parchatelogo.png') }}" alt="Logo Parchate">
    <h1>Registro</h1>

    @if (session('success'))
      <p style="color: green;">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
      <div class="error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" id="correo" name="correo" required value="{{ old('correo') }}">
      </div>

      <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" id="password" name="password" required>
      </div>

      <div class="form-options">
        <label>
          <input type="radio" name="tipo_persona" value="usuario" {{ old('tipo_persona') == 'usuario' ? 'checked' : '' }}>
          Persona Natural
        </label>
        <label>
          <input type="radio" name="tipo_persona" value="negocio" {{ old('tipo_persona') == 'negocio' ? 'checked' : '' }}>
          Negocio
        </label>
      </div>

      <div class="terms">
        <input type="checkbox" id="terminos" name="terminos" {{ old('terminos') ? 'checked' : '' }} required>
        <label for="terminos">Acepto términos y condiciones</label>
      </div>

      <button type="submit" class="login-btn">Registrarme</button>
    </form>

    <div class="links">
      <a href="{{ route('login') }}">¿Ya tienes una cuenta? Inicia sesión aquí</a>
    </div>
  </div>

</body>
</html>
