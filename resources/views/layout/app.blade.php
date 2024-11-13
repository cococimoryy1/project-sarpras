<!DOCTYPE html>
<html>
<head>
    <title>My Application</title>
    <!-- Include CSS files -->
</head>
<body>
    <div id="app">
        <!-- Sidebar -->
        <aside>
            @include('partials.sidebar')
        </aside>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Include JavaScript files -->
</body>
</html>
