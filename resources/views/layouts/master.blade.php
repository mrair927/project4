<!DOCTYPE html>
<html>
<head>
    <title>
        {{-- Yield the title if it exists, otherwise default to 'Foobooks' --}}
        @yield('title','My Great Task Manager')
    </title>

    <meta charset='utf-8'>

    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/lumen/bootstrap.min.css' rel='stylesheet'>

    <link href='/css/tasks.css' type='text/css' rel='stylesheet'>

    {{-- Yield any page specific CSS files or anything else you might want in the <head> --}}
    @yield('head')

</head>
<body>

    @if(Session::get('flash_message') != null)
        <div class='flash_message'>{{ Session::get('flash_message') }}</div>
    @endif

    <header>
        <a href='/'>
            <img
            src='https://lh5.ggpht.com/BggKi4WCYbq-VuWBK4U96scwxa2rNTiAe1amDkYTJcMLaPPJ2PHhJItWwSGwVhbjMw1c=w300'
            alt='Clipboard'
            class='logo'>
        </a>
    </header>

    <nav>
        <ul>
            @if(Auth::check())
                <li><a href='/tasks'>View All Tasks</a></li>
                <li><a href='/tasks/create'>Add a Task</a></li>
                <li><a href='/tasks/completed'>View Completed Tasks</a></li>
                <li><a href='/logout'>Logout</a></li>
            @else
                <li><a href='/login'>Login</a></li>
                <li><a href='/register'>Register</a></li>
            @endif
        </ul>
    </nav>


    <section>
        {{-- Main page content will be yielded here --}}
        @yield('content')
    </section>

</body>
</html>
