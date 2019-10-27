<html>
    <head>
        <title>Your Atkinson Media Reports login link</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto');
        </style>
    </head>
    <body>
        <table style="width: 600px; margin: 0px auto; cell-padding: 0px; ">
            <tr >
                <td style="padding: 20px 0px; background-color: #8EB0C4; text-align:center;">
                    <img  style= "height: 100px; " src="https://res.cloudinary.com/brannanatkinson/image/upload/v1529866795/AAC/aacom_noservices_white.png" alt="">
                </td>
            </tr>
            <tr >
                <td style="padding: 50px 0px;">
                    <h2 style="text-align: center;">Your Secure Login Link to Atkinson Media Reports</h2>
                    <p>Your secure login link for Atkinson Media Reports is:</p>
                    <pre><a href="{{ $user->signed_url }}">{{ $user->signed_url }}</a></pre>
                    <br>
                    <hr>
                    <p>This link doesn't expire. You can just save this email to log in at any time. Or, you can copy and paste to create a bookmark in your browser.</p>
                    <p>Recovering your link is easy. Go to atkinsonmediareports.com and follow the instructions.</a> </p>
                    <p>Please contact Brannan Atkinson at brannan@amyacommunications.com if you have any issues.</p>
                </td>
            </tr>
        </table>
    </body>
</html>