<html>
    <head>
        <title>New Mention</title>
        <style>
            @import url('https://fonts.googleapis.com/css?family=Roboto');
        </style>
    </head>
    <body>
        <table style="width: 600px; margin: 0px auto; cell-padding: 0px; ">
            <tr >
                <td style="padding: 20px 0px; background-color: #8EB0C4; text-align:center;">
                    <img  style= "height: 100px; " src="http://res.cloudinary.com/brannanatkinson/image/upload/v1529866795/AAC/aacom_noservices_white.png" alt="">
                </td>
            </tr>
            <tr >
                <td style="padding: 50px 0px;">
                    <ul>
                    @foreach( $stories as $story )
                        <li>{{ $story->story_url }}</li>
                    @endforeach
                    </ul>
                </td>
            </tr>
        </table>
    </body>
</html>