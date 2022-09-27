## API Documentation for email template
======================================

1) For sending an email
    url -> http://localhost/zerox-coding-test/public/api/send-email

    API Request Field
    ==========================
    field -> required|array
    value -> required|array
    template_key -> string|required
    receiving_email_address -> string|email|required

    Example
    ================
    field => [
        0 => 'username',
        1 => 'footer'
    ],
    value => [
        0 => 'Rubin Awale'
        1 => 'Victoria Road, NSW'
    ],
    template_key => 'birthday-wishes,
    receiving_email_address => 'rubinawale10@gmail.com'



    Note: For Sending Mail Credentials
    ================================================
     1) You can put mail gun credential in .env file
            MAIL_MAILER=smtp
            MAIL_HOST=smtp.mailgun.org
            MAIL_PORT=587
            MAIL_USERNAME="mailgun username"
            MAIL_PASSWORD="mailgun password"
            MAIL_ENCRYPTION=ssl
            MAIL_FROM_ADDRESS="hello@example.com"
            MAIL_FROM_NAME="${APP_NAME}"
    
    2) For AWS
        AWS_ACCESS_KEY_ID= "ID"
        AWS_SECRET_ACCESS_KEY= "Secred Key"