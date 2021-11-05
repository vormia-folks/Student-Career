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

    /*
    *
    * This function can help user to check if there is any notification set in the notification KEY
    * If there is it will return the notification method
    * Else it will return blank
    *  
    */
    public function notify()
    {
        //Auth Model
        require_once 'libraries/Auth.php';
        $this->auth = new Auth;

        //Check if there is any notification by using auth->auth_get_flash do not pass value
        $notify = $this->auth->auth_get_flash();

        //Check Inside Notification
        if (!empty($notify) || !is_null($notify)) {

            return $notify; //Notification Method
        } else {

            return 'blank'; //Notification Method
        }
    }

    /**
     *
     *  This function help you to set-up a notification session and the message you wish to be passed
     *  This can be used by advance users when they want to set/store a value inside session so it can be accessed later
     *  You can use this even to store user IP address/ User ID etc
     * 
     */
    public function set($type = 'blank')
    {
        //Auth Model
        require_once 'libraries/Auth.php';
        $this->auth = new Auth;

        //Set Message
        $this->auth->auth_set_flash(trim($type));
    }
}
