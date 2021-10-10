<?php
require_once 'libraries/Model.php';

class Notify extends Model
{

    /**
     *
     * This function is normally accessed by default in most of the notifications
     * This pass blank/empty/null notification
     * If you have no notification to call or pass on particular form use blank.
     * E.g when user first open contact form set notification blank
     * Then when submitting the form you can change to success or error
     */
    public function blank($value = null)
    {
        //Empty Notifiaction
        return '';
    }

    /**
     *
     * This pass success notification
     * When opratation is successful pass this notification
     * The variable value passed is the message you wish user to see, by default message is set to 'Activity was successful.'
     */
    public function success($value = null)
    {
        //Check Value
        $message = (!empty($value) && !is_null($value)) ? $value : 'Activity was successful.';

        //Message
        $notify = "

            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>Success!</strong> $message
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";

        return $notify;
    }

    /**
     *
     * This pass failed/error notification
     * When opratation is failed pass this notification
     * The variable value passed is the message you wish user to see, by default message is set to 'Change a few things up and try again.'
     */
    public function error($value = null)
    {

        //Check Value
        $message = (!is_null($value)) ? $value : 'Change a few things up and try again.';

        //Message
        $notify = "

            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>Error!</strong> $message
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
        ";

        return $notify;
    }
}
