<?php namespace Foostart\Acl\Library\Email;

/**
 * Swift mailer implementation of MailerInterface
 *
 * @author Foostart foostart.com@gmail.com
 */

use Swift_TransportException;
use Swift_RfcComplianceException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;

class SwiftMailer implements MailerInterface
{
    /**
     * {@inheritdoc}
     */
    public function sendTo($to, $body, $subject, $template)
    {
        try {
            App::make('mailer')->send($template, ["body" => $body], function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject)->from('tailieuweb.com@gmail.com', 'Account management');
            });
        } catch (Swift_TransportException $e) {
            Log::error('Cannot send the email:' . $e->getMessage());
            return false;
        } catch (Swift_RfcComplianceException $e) {
            Log::error('Cannot send the email:' . $e->getMessage());
            return false;
        }

        return true;
    }
}
