<!DOCTYPE html>
<html>
<head>
    <title>YConverter</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{route('video.convert')}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="exampleInputEmail1">Video id</label>
                        <input type="text" class="form-control" name="video_id" id="video_id" aria-describedby="video_id" placeholder="Enter video id" value="0vbuGMlwKl8">
                    </div>
                    <button type="submit" class="btn btn-primary">Download</button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>