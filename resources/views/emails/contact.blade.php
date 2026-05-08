<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Message - Chikondi Organisation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F8FAFC;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .header {
            background-color: #1E293B;
            padding: 40px;
            text-align: center;
        }
        .header h1 {
            color: #DC2626;
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
            letter-spacing: 4px;
        }
        .header p {
            color: rgba(255,255,255,0.4);
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-top: 8px;
        }
        .body {
            padding: 40px;
        }
        .field {
            margin-bottom: 24px;
        }
        .field label {
            display: block;
            font-size: 10px;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 3px;
            color: #94a3b8;
            margin-bottom: 8px;
        }
        .field p {
            font-size: 15px;
            color: #1E293B;
            font-weight: 600;
            background-color: #F8FAFC;
            padding: 16px 20px;
            border-radius: 12px;
            margin: 0;
            line-height: 1.6;
        }
        .footer {
            background-color: #F8FAFC;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            font-size: 10px;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Chikondi Organisation</h1>
            <p>New message from website</p>
        </div>
        <div class="body">
            <div class="field">
                <label>From Email</label>
                <p>{{ $contact->email }}</p>
            </div>
            @if($contact->ideas)
            <div class="field">
                <label>Ideas / Participation</label>
                <p>{{ $contact->ideas }}</p>
            </div>
            @endif
            <div class="field">
                <label>Message</label>
                <p>{{ $contact->message }}</p>
            </div>
            <div class="field">
                <label>Received At</label>
                <p>{{ $contact->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>
        <div class="footer">
            <p>&copy; 2026 Chikondi Organisation &mdash; Limodzi Tingathe</p>
        </div>
    </div>
</body>
</html>