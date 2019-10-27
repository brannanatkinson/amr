<html>
    <head>
        <title>New Metnion</title>
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
                    <p style="font-family: 'Roboto';">A new mention was added to Atkinson Media Reports</p>
                    <a href="{{ $story->story_url }}"><p>Headline: {{ $story->headline() }}</p></a>
                </td>
            </tr>
        </table>
    </body>
</html>