<?php
// Reject anyone who's not GitHub
if (!in_array($_SERVER['REMOTE_ADDR'], array('207.97.227.253', '50.57.128.197', '108.171.174.178'))) {
        exit('Go away!');
}
require_once 'Class/postmark.php';
$postmark = new Postmark('postmark-app-key');
$postmark->setFrom('From you thoughts-go.top');
$postmark->addTo('a060116@163.com');
$postmark->addTo('fuxinyu@gmail.com');
$postmark->setTag('Deployment');
$project_name = 'Project warehouse';
$payload = json_decode($_POST['payload']);
$changes = $payload->commits;
$git_result = `git pull`;
if (strlen($git_result) == 20 || strstr($git_result, 'Updating')) {
        $postmark->setSubject($project_name.' successfully deployed');
        $htmlBody = '
        <h1>'.$project_name.' successfully deployed</h1><br />
        Date: '.date('d-m-Y H:i:s').'<br /><br />
        The following changes was made:<br /><br />
        <ul>
        ';
        foreach ($changes as $change) {
                $htmlBody .= '<li>'.$change->message.' ('.$change->committer->name.')
                ';
        }
        $htmlBody .= '</ul>';
        $textBody = strip_tags($htmlBody);
        $postmark->setBody($htmlBody, $textBody);
} else {
        $postmark->setSubject($project_name.' failed to deploy');
        $htmlBody = '
        <h1>Git failed with the following response</h1><br /><br />
        '.$git_result;
        $textBody = strip_tags($htmlBody);
        $postmark->setBody($htmlBody, $textBody);
}
$result = $postmark->send();
