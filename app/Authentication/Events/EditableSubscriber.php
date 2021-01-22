<?php  namespace Foostart\Acl\Authentication\Events;
/**
 * Class EbitableSubscriber
 *
 * @author Foostart foostart.com@gmail.com
 */

use Foostart\Acl\Authentication\Exceptions\PermissionException;

class EditableSubscriber
{
    protected $editable_field = "protected";
    /**
     * Check if the object is editable
     */
    public function isEditable($object)
    {
        if($object->{$this->editable_field} == true) throw new PermissionException;
    }

    /**
     * Register the various event to the subscriber
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe($events)
    {
        $events->listen('repository.deleting', 'Foostart\Acl\Authentication\Events\EditableSubscriber@isEditable',10);
        $events->listen('repository.updating', 'Foostart\Acl\Authentication\Events\EditableSubscriber@isEditable',10);
    }

} 