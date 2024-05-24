<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Email Title</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #ffffff;
    }
    .logo {
      text-align: center;
    }
    .details {
      margin-top: 20px;
      padding: 10px;
      border: 1px solid #ccc;
    }
    .button {
      display: block;
      width: 100%;
      background-color: #3498db;
      color: #ffffff;
      text-align: center;
      text-decoration: none;
      padding: 10px 0;
      margin-top: 20px;
    }
    .footer {
      margin-top: 20px;
      text-align: center;
      color: #777;
    }

    h1,h2,h3,h4,h5,h6{
	font-family: 'Poppins', sans-serif;
	color: #000000;
	margin-top: 0;
	font-weight: 400;
}
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="{{ asset('images/pushi_drk.png') }}" alt="Company Logo" width="150">
    </div>
    <div class="details">
      <p>{!! $data['body'] !!}</p>
    </div>
    <a href="{{ $url ?? route('login') }}" class="button">{{ isset($url) ? 'View Details' : 'Login' }}</a>
    <div class="footer">
      <p>Thank you for using Pushiii!</p>
    </div>
  </div>
</body>
</html>
