<?php namespace Foostart\Acl\Library\Email;

/**
 * Swift mailer implementation of MailerInterface
 *
 * @author Foostart foostart.com@gmail.com
 */

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Swift_RfcComplianceException;
use Swift_TransportException;

class SwiftMailer implements MailerInterface
{
    /**
     * {@inheritdoc}
     */
    public function sendTo($to, $body, $subject, $template)
    {
        try {
            App::make('mailer')->send($template, ["body" => $body], function ($message) use ($to, $subject) {
                $message->to($to)->subject($subject)->from('ptnhuan@gmail.com', 'H? th?ng qu?n lı th?c t?p');
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
