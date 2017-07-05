yii.allowAction = function ($e) {
    var message = $e.data('confirm');
    return message === undefined || yii.confirm(message, $e);
};
// --- Delete action (bootbox) ---
yii.confirm = function (title, message, ok, cancel) {
 
    bootbox.confirm(
        {
            title: 'Confirm Delete?',
            message: message,
            buttons: {
                confirm: {
                    label: '<i class="fa fa-check"></i> Confirm'
                },
                cancel: {
                    label: '<i class="fa fa-times"></i> Cancel'
                }
            },
            callback: function (confirmed) {
                if (confirmed) {
                    !ok || ok();
                } else {
                    !cancel || cancel();
                }
            }
        }
    );
    // confirm will always return false on the first call
    // to cancel click handler
    return false;
}