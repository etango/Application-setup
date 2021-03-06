ARN=' aws sns create-topic ...name et-mp2'

echo "This is the ARN: $ARN"

aws sns set topic attributes --topic arn $ARN --attribute name DisplayName --attribute value et-mp2

aws sns subscribe --topic-arn $ARN --protocol sms --notification-endpoint $email

aws sns publish --topic-arn $ARN --message "Thank You for subscribing!"
