<?php
aws elb set-load-balancer-policies-of-listener --load-balancer-name itmo-444-et-lb --load-balancer-port 443 --policy-names my-app-cookie-policy
echo "Hi";
sesion_start();
var_dump($_POST);
if(!empty($_POST)){
  echo $_POST['email'];
  '
}

else
{
  echo "empty";
}

?>

ARN=' aws sns create-topic ...name et-mp2'

echo "This is the ARN: $ARN"

aws sns set topic attributes --topic arn $ARN --attribute name DisplayName --attribute value et-mp2

aws sns subscribe --topic-arn $ARN --protocol sms --notification-endpoint $email

aws sns publish --topic-arn arn:aws:sns:us-east-1:5032847113842:et-mp2 --message "Thank You for subscribing!"
