<html>
<head>
    <title>e2encrypt - Hello</title>
    <style>
    body {
        background: black;
        color: white;
    }

    div {
        padding: 25px;
        margin: 25px;
        border-radius: 20px;
        border: 2px solid blue;
    }
    </style>
</head>
<body>
    <div>
        <h4>Welcome to e2encrypt</h4>
        <div>
            <h5>Tests</h5>
            <p>GET [hi] : <?php echo $this->get('hi'); ?></p>
            <p>GET md5 hash of value to set in url, for example hash of hi is ?<?=md5('hi')?>=hi</p>

            <form action="/api/test" method="post" enctype="multipart/form-data">
                Select image to upload:
                <input type="file" name="file" id="file">
                <input type="submit" value="Upload Image" name="submit">
            </form>
        </div>
    </div>
</body>
</html>