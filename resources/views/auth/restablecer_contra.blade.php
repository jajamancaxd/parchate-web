<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Recuperar contraseña</title>
  <style>
    body {
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: url("{{ asset('img/bulevaro.png') }}") no-repeat center center fixed;
      background-size: cover;
    }

    .reset-container {
      width: 420px;
      height: 540px;
      background-color: white;
      margin: 60px auto;
      padding: 40px 25px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      text-align: center;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: flex-start;
    }

    .reset-container img {
      width: 130px;
      height: 130px;
      transform: scale(1.4);
      margin-bottom: 10px;
    }

    .reset-container h2 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 30px;
    }

    form {
      width: 100%;
    }

    label {
      display: block;
      font-weight: bold;
      color: #f35c0c;
      margin-bottom: 10px;
      text-align: left;
      margin-left: 15px;
    }

    input[type="email"] {
      width: 90%;
      padding: 10px;
      border: 2px solid #ccc;
      border-radius: 20px;
      margin-bottom: 30px;
      font-size: 16px;
      outline: none;
      box-sizing: border-box;
    }

    .button-wrapper {
      display: flex;
      gap: 20px;
      justify-content: center;
    }

    .button-wrapper button {
      width: 120px;
      padding: 10px;
      font-weight: bold;
      font-size: 15px;
      cursor: pointer;
      border-radius: 8px;
    }

    .accept-btn {
      background-color: #f35c0c;
      color: white;
      border: none;
    }

    .cancel-btn {
      background-color: white;
      color: #f35c0c;
      border: 2px solid #f35c0c;
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }

    .success {
      color: green;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>

  <div class="reset-container">
    <img src="{{ asset('img/parchatelogo.png') }}" alt="Logo" />
    <h2>Recuperar contraseña</h2>

    @if (session('success'))
      <div class="success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
      <div class="error">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('restablecer_contra') }}">
      @csrf
      <label for="email">Correo</label>
      <input type="email" name="email" id="email" placeholder="Ingresa tu correo" required>

      <div class="button-wrapper">
        <button type="submit" class="accept-btn">Aceptar</button>
        <a href="{{ route('login') }}"><button type="button" class="cancel-btn">Cancelar</button></a>
      </div>
    </form>
  </div>

</body>
</html>
