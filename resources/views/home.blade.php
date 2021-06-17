<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Encryption</title>
    <style>
      body {
        background-image: url('https://cdn.mos.cms.futurecdn.net/6mE6EkgxH8gEhHLdnuBLfR.jpg');
        background-size: cover;
        background-color: rgba(200, 200, 214, 0.97);
        background-blend-mode: lighten;
      }
      h1 {
      font-size: 3em;
      }
      h6 {
      font-size: .78em;
      color: red;
      }
      body{
        font-family:'Courier New';
        font-size: 1.2em;
      }
      </style>
</head>
<body>
<!-- <img src="https://cdn.mos.cms.futurecdn.net/6mE6EkgxH8gEhHLdnuBLfR.jpg" alt="movie collage" width="100%" class="img-fluid"> -->
<center><h1><b>ENCRYPTION</b></h1></center><br>
  <div class="container">
  <div class="row">
  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
  <center><h3><b>Caser Ciphering</b></h3></center>
  <b>
  <form action="/caser_encrypt" method="post">
  @csrf
    <table class="table table-borderless">
      <tr>
        <td>Enter the Message</td>
        <td><input class="form-control" type="text" name="msg1" value="<?php echo isset($_POST['msg1']) ? htmlspecialchars($_POST['msg1'], ENT_QUOTES) : ''; ?>" pattern="[a-zA-Z ]+" title="Enter Only Alphabets" required></td>
      </tr>
      <tr>
        <td>Choose the Key</td>
        <td><input class="form-control" type="number" placeholder="" name="key1" value="<?php echo isset($_POST['key1']) ? htmlspecialchars($_POST['key1'], ENT_QUOTES) : ''; ?>" min="1" max="25" required></td>
      </tr>
      <tr>
        <td style="text-align:right">
        <input class="btn btn-dark" type="submit" name="submit_1" value="ENCRYPT"/>
      </td>
      <tr>
          <td>Encrypted Message</td>
          <td><input class="form-control" type="text" id="lname" name="lname" value="{{$cipher}}" disabled></td>
      </tr>
      </tr>
  
    </form>
    <tr><td><hr></td><td><hr></td></tr>
    <form action="/caser_decrypt" method="post">
  @csrf
   
      <tr>
        <td>Enter the Encrypted Message</td>
        <td><input class="form-control" type="text" name="cip1" value="<?php echo isset($_POST['cip1']) ? htmlspecialchars($_POST['cip1'], ENT_QUOTES) : ''; ?>" pattern="[A-Za-z ]+" title="Only Alphabet And Space Is Allowed" required></td>
      </tr>
      <tr>
        <td>Choose the Key</td>
        <td><input class="form-control" type="number" placeholder="" name="ckey1" value="<?php echo isset($_POST['ckey1']) ? htmlspecialchars($_POST['ckey1'], ENT_QUOTES) : ''; ?>" id="" min="1" max="25" required></td>
      </tr>
      <tr>
        <td style="text-align:right">
        <input class="btn btn-dark" type="submit" name="submit_1" value="DECRYPT"/>
      </td>
      <tr>
          <td>Decrypted Message</td>
          <td><input class="form-control" type="text" id="lname" name="lname" value="{{$msg}}" disabled></td>
      </tr>
      </tr>
    </table>
    </form>
    </b>
  </div>
  <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6">
  <center><h3><b>Playfair Ciphering</b></h3></center>
  <b>
  <form action="/pf_encrypt" method="post">
  @csrf
    <table class="table table-borderless">
      <tr>
        <td>Enter the Message</td>
        <td><input class="form-control" type="text" name="pmsg1" value="<?php echo isset($_POST['pmsg1']) ? htmlspecialchars($_POST['pmsg1'], ENT_QUOTES) : ''; ?>" pattern="[A-Za-z ]+" title="Only Alphabet And Space Is Allowed" required></td>
      </tr>
      <tr>
        <td>Choose the Key</td>
        <td><input class="form-control" type="text" name="pkey1" value="<?php echo isset($_POST['pkey1']) ? htmlspecialchars($_POST['pkey1'], ENT_QUOTES) : ''; ?>" pattern="[A-Za-z ]+" title="Only Alphabet And Space Is Allowed, No Duplicates Letters" required>
        @if(Session::get('fail'))
        <h6>{{ Session::get('fail') }}</h6>
        @endif
        </td>
      </tr>
      <tr>
        <td style="text-align:right">
        <input class="btn btn-dark" type="submit" name="submit_1" value="ENCRYPT"/>
      </td>
      <tr>
          <td>Encrypted Message</td>
          <td><input class="form-control" type="text" id="lname" name="lname" value="{{$cip}}" disabled></td>
      </tr>
      </tr>
  
    </form>
    <tr><td><hr></td><td><hr></td></tr>
    <form action="/pf_decrypt" method="post">
  @csrf
   
      <tr>
        <td>Enter the Encrypted Message</td>
        <td><input class="form-control" type="text" name="pcip2" value="<?php echo isset($_POST['pcip2']) ? htmlspecialchars($_POST['pcip2'], ENT_QUOTES) : ''; ?>" pattern="[A-Za-z ]+" title="Only Alphabet And Space Is Allowed" required></td>
      </tr>
      <tr>
        <td>Choose the Key</td>
        <td><input class="form-control" type="text" name="pkey2" value="<?php echo isset($_POST['pkey2']) ? htmlspecialchars($_POST['pkey2'], ENT_QUOTES) : ''; ?>" pattern="[A-Za-z ]+" title="Only Alphabet And Space Is Allowed" required>
        @if(Session::get('fail1'))
        <h6>{{ Session::get('fail1') }}</h6>
        @endif
        </td>
      </tr>
      <tr>
        <td style="text-align:right">
        <input class="btn btn-dark" type="submit" name="submit_1" value="DECRYPT"/>
      </td>
      <tr>
          <td>Decrypted Message</td>
          <td><input class="form-control" type="text" id="lname" name="lname" value="{{$msg2}}" disabled></td>
      </tr>
      </tr>
    </table>
    </b>
    </form>
    
  </div>
  </div>
  </div> 
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>  
</body>
</html>