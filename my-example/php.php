<php
$secret = '{backend key}';
$gRecaptchaResponse = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : null;
$ip = $_SERVER['REMOTE_ADDR'];
$domainName = $_SERVER['HTTP_HOST'];

include_once ("/src/autoload.php");
$recaptcha = new \ReCaptcha\ReCaptcha($secret);
$resp = $recaptcha->setExpectedHostname($domainName)
                ->setExpectedAction('homepage')
                ->setScoreThreshold(0.5)
                ->verify($gRecaptchaResponse, $ip);
if ($resp->isSuccess()) {
  $msg['info']=$resp->toArray();
} else {
  $errors = $resp->getErrorCodes();
  $msg['ending']='recaptchaFail';
  $msg['info']=$errors;
  echo json_encode($msg);
  exit();
}
?>