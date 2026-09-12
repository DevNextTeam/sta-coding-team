<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Google Connection</title>
</head>

<body>

<script>

    if (window.opener && !window.opener.closed) {

        window.opener.postMessage(
            'google-login-success',
            window.location.origin
        );

        window.close();

    } else {

        window.location.href = "{{ route('dashboard') }}";

    }

</script>

</body>
</html>