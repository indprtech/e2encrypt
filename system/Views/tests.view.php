<!DOCTYPE html>
<html>

<head>
    <title>e2encrypt Framework - Tests</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    /* E2Encrypt Tests Page */

    body {
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 16px;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 960px;
        margin: 0 auto;
        padding: 20px;
    }

    header {
        background-color: #333;
        color: #fff;
        text-align: center;
        padding: 10px 0;
    }

    header h1 {
        margin: 0;
    }

    main {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-top: 30px;
    }

    .test {
        margin: 20px 0;
        width: 80%;
        max-width: 600px;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .test h2 {
        margin-top: 0;
    }

    .test p {
        margin-bottom: 20px;
    }

    .test ul {
        list-style: disc;
        margin: 0 0 20px 20px;
        padding: 0;
    }

    .status {
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 20px;
    }

    .success {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .error {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    @media only screen and (max-width: 600px) {
        .test {
            width: 100%;
        }
    }
    </style>
</head>

<body>
    <div class="container">
        <h1>e2encrypt Framework - Tests</h1>
        <p>This page shows the results of various tests run on the e2encrypt framework to ensure it is working
            correctly.</p>
        <p>To run these tests yourself, download the source code and navigate to the tests directory.</p>
        <div class="tests">
            <div class="test">
                <h2>Database Connection</h2>
                <p>Checks if the framework can connect to the database successfully.</p>
                <ul>
                    <li>Open a connection to the database.</li>
                    <li>Query the database to retrieve a record.</li>
                    <li>Check if the record was retrieved successfully.</li>
                </ul>
                <div class="status success">Success</div>
            </div>
            <div class="test">
                <h2>Encryption and Decryption</h2>
                <p>Checks if the framework can encrypt and decrypt data using the AES encryption algorithm.</p>
                <ul>
                    <li>Encrypt a sample message.</li>
                    <li>Decrypt the encrypted message.</li>
                    <li>Check if the decrypted message matches the original message.</li>
                </ul>
                <div class="status error">Error: Encryption key not set.</div>
            </div>
            <div class="test">
                <h2>File Upload</h2>
                <p>Checks if the framework can handle file uploads.</p>
                <ul>
                    <li>Upload a file to the server.</li>
                    <li>Check if the file was uploaded successfully.</li>
                </ul>
                <div class="status success">Success</div>
            </div>
            <div class="test">
                <h2>Email Sending</h2>
                <p>Checks if the framework can send emails using the PHPMailer library.</p>
                <ul>
                    <li>Send a test email to a designated email address.</li>
                    <li>Check if the email was sent successfully.</li>
                </ul>
                <div class="status error">Error: SMTP settings not configured.</div>
            </div>
        </div>
    </div>
</body>

</html>