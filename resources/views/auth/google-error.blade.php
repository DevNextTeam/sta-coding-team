<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Google Connection Error</title>
</head>

<body>

<script>

    const message = @json(
        $message ?? 'Google authentication failed.'
    );


    if (window.opener && !window.opener.closed) {

        window.opener.postMessage(
            {
                type: 'google-login-error',
                message: message
            },
            window.location.origin
        );

        window.close();

    } else {

        document.body.innerHTML = `
            <div style="
                font-family: Arial, sans-serif;
                padding: 30px;
            ">

                <h2>Google Connection Error</h2>

                <p>${message}</p>

                <a href="{{ route('dashboard') }}">
                    Return to Dashboard
                </a>

            </div>
        `;

    }

</script>

</body>
</html>