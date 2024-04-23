<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>To Do App</title>
</head>
<body>
    <div class="container">
        <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
            <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
                <span class="fs-4">To Do App</span>
            </a>
    
            <ul class="nav nav-pills">
                <li class="nav-item"><a href="/tasks" class="nav-link active" aria-current="page">Home</a></li>
                <li class="nav-item"><a href="/about" class="nav-link">About</a></li>
                @guest
                <li class="nav-item"><a href="/login" class="nav-link px-2 text-body-secondary">Login</a></li>
                <li class="nav-item"><a href="/register" class="nav-link px-2 text-body-secondary">Register</a></li>
                @endguest
                @auth
                  <form action="/logout" method="POST">
                      @csrf
                      <button type="submit" class="btn btn-danger">Logout</button>
                  </form>
                @endauth
            </ul>
        </header>
    </div>

    @yield('content')

    <div class="container">
        <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
          <p class="col-md-4 mb-0 text-body-secondary">© 2024 Learn Laravel, Inc</p>
      
          <div class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
            <a href="/change-lang/en" class="nav-link px-2 text-body-secondary">English</a>
            <a href="/change-lang/id" class="nav-link px-2 text-body-secondary">Indonesia</a>
          </div>

          
      
          <ul class="nav col-md-4 justify-content-end">
            <li class="nav-item"><a href="/tasks" class="nav-link px-2 text-body-secondary">Home</a></li>
            <li class="nav-item"><a href="/about" class="nav-link px-2 text-body-secondary">About</a></li>
            
          </ul>
        </footer>
      </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>