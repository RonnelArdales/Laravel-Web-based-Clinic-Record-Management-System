
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <style>
        *{
       margin: 0;
       padding: 0;
    }
    body{
       background-color: #EDDBC0;
    }

    </style>
</head>
<body>

       
    <div class="container">
        <div class="row">
          <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card border-0 shadow rounded-3 my-5">
              <div class="login d-flex align-items-center py-5">
                <div class="container">
                  <div class="row">
                    <div class="col-md-9 col-lg-8 mx-auto">
                   
              
                      @if(Session::has('success'))
                      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                          <span class="block sm:inline">{{Session::get('success')}}</span>
                        </div>
                      @endif
                      <h3 class="login-heading mb-4">Find your account</h3>
        
                      <!-- Sign In Form -->
                      <form action="/confirm" method="POST">
                        @csrf
                        <h6>Please enter your email for your account.</h6>
                        <div class="form-floating mb-3">
                            
                          <input  class="form-control"   name="email" value="" >
                          <label for="floatingInput">Email address</label>
                        </div>
                        @if(Session::has('error'))
                        <span  role="alert" class="block  text-danger">{{Session::get('error')}}</span>
                    @endif

                        <div class="d-grid">
                          <button class="btn btn-lg btn-primary btn-login text-uppercase fw-bold mt-2 mb-2" type="submit">Find email</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

</body>
</html>







