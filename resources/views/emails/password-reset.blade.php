<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Reset your DevNext password</title>
</head>

<body
    style="
        margin: 0;
        padding: 0;
        background-color: #F5F1E8;
        font-family: Arial, Helvetica, sans-serif;
        color: #29483D;
    "
>

    <div
        style="
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        "
    >

        <!-- Main Card -->
        <div
            style="
                background-color: #ffffff;
                border-radius: 20px;
                padding: 40px 30px;
                box-shadow: 0 8px 30px rgba(0,0,0,0.08);
            "
        >

            <!-- Logo / Brand -->
            <div
                style="
                    text-align: center;
                    margin-bottom: 30px;
                "
            >

                <div
                    style="
                        font-size: 28px;
                        font-weight: bold;
                        color: #0F3F4A;
                        letter-spacing: 1px;
                    "
                >
                    DEVNEXT
                </div>

                <div
                    style="
                        margin-top: 6px;
                        font-size: 13px;
                        color: #6B7C76;
                    "
                >
                    S.T.A Coding Team
                </div>

            </div>


            <!-- Title -->
            <h1
                style="
                    margin: 0 0 20px;
                    text-align: center;
                    font-size: 26px;
                    color: #29483D;
                "
            >
                Reset your password
            </h1>


            <!-- Greeting -->
            <p
                style="
                    font-size: 16px;
                    line-height: 1.7;
                    margin-bottom: 15px;
                "
            >
                Hi {{ $user->name }},
            </p>


            <!-- Introduction -->
            <p
                style="
                    font-size: 15px;
                    line-height: 1.7;
                    color: #52635D;
                    margin-bottom: 25px;
                "
            >
                We received a request to reset the password
                for your DevNext account. If you made this request,
                you can use either the button below or the
                verification code to continue.
            </p>


            <!-- Verification Code -->
            <div
                style="
                    margin: 30px 0;
                    padding: 25px;
                    text-align: center;
                    background-color: #F5F1E8;
                    border-radius: 16px;
                "
            >

                <div
                    style="
                        font-size: 13px;
                        color: #6B7C76;
                        margin-bottom: 10px;
                    "
                >
                    Your verification code
                </div>

                <div
                    style="
                        font-size: 32px;
                        font-weight: bold;
                        letter-spacing: 8px;
                        color: #0F3F4A;
                    "
                >
                    {{ $code }}
                </div>

                <div
                    style="
                        margin-top: 10px;
                        font-size: 12px;
                        color: #7A8580;
                    "
                >
                    This code expires in 10 minutes.
                </div>

            </div>


            <!-- Primary Reset Button -->
            <div
                style="
                    text-align: center;
                    margin: 30px 0 14px;
                "
            >

                <a
                    href="{{ $resetUrl }}"
                    style="
                        display: inline-block;
                        padding: 14px 30px;
                        background-color: #4F806D;
                        color: #ffffff;
                        text-decoration: none;
                        border-radius: 10px;
                        font-size: 15px;
                        font-weight: bold;
                    "
                >
                    Reset Password
                </a>

            </div>


            <!-- Code Alternative Button -->
            <div
                style="
                    text-align: center;
                    margin: 0 0 30px;
                "
            >

                <a
                    href="{{ url('/reset-code?email=' . urlencode($user->email)) }}"
                    style="
                        display: inline-block;
                        padding: 12px 24px;
                        background-color: #F5F1E8;
                        color: #29483D;
                        text-decoration: none;
                        border: 1px solid #D8DED9;
                        border-radius: 10px;
                        font-size: 14px;
                        font-weight: 600;
                    "
                >
                    Use Verification Code Instead
                </a>

            </div>


            <!-- Explanation -->
            <div
                style="
                    margin-top: 25px;
                    padding: 18px;
                    background-color: #F8FAF8;
                    border-left: 4px solid #4F806D;
                    border-radius: 8px;
                "
            >

                <p
                    style="
                        margin: 0;
                        font-size: 13px;
                        line-height: 1.7;
                        color: #52635D;
                    "
                >
                    <strong style="color: #29483D;">
                        Two ways to reset your password:
                    </strong>
                    <br><br>

                    <strong>Option 1:</strong>
                    Click <strong>Reset Password</strong> to
                    open the password reset page directly.
                    <br><br>

                    <strong>Option 2:</strong>
                    Click <strong>Use Verification Code Instead</strong>
                    and enter the 6-digit code shown above.
                </p>

            </div>


            <!-- Security Notice -->
            <p
                style="
                    margin-top: 25px;
                    font-size: 13px;
                    line-height: 1.7;
                    color: #7A8580;
                "
            >
                If you did not request a password reset, you can
                safely ignore this email. Your password will remain
                unchanged.
            </p>


            <!-- Expiration Notice -->
            <div
                style="
                    margin-top: 20px;
                    padding: 15px;
                    background-color: #FFF7ED;
                    border-radius: 10px;
                    font-size: 13px;
                    line-height: 1.6;
                    color: #7A624F;
                "
            >

                <strong>Security reminder:</strong>

                Never share your verification code with anyone.
                DevNext support will never ask you for this code.

            </div>


            <!-- Footer -->
            <div
                style="
                    margin-top: 35px;
                    padding-top: 20px;
                    border-top: 1px solid #E5E1D8;
                    text-align: center;
                    font-size: 12px;
                    color: #8A948F;
                "
            >

                <div>
                    DevNext · S.T.A Coding Team
                </div>

                <div style="margin-top: 5px;">
                    This is an automated security email.
                </div>

                <div style="margin-top: 5px;">
                    © {{ date('Y') }} DevNext
                </div>

            </div>

        </div>

    </div>

</body>

</html>
