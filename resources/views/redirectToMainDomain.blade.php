<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting...</title>
</head>
<body>
<script type="text/javascript">
    window.open("{{ $redirectUrl }}", '_blank');

    setTimeout(function() {
        window.history.back();
    }, 1000);
</script>

<p>Если новая вкладка не открылась автоматически, <a href="{{ $redirectUrl }}" target="_blank">нажмите здесь</a>.</p>
</body>
</html>
