<!-- resources/views/routes/xml.blade.php -->

<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<routes>
    @foreach ($routes as $route)
        <route>
            <method>{{ $route['method'] }}</method>
            <uri>{{ $route['uri'] }}</uri>
        </route>
    @endforeach
</routes>
