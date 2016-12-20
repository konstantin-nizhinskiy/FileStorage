/**
 * Send file
 *
 * @param data {object}
 * @param options {object}
 * @param options.multiple {boolean}
 * @param options.success {function}
 * @param options.error {function}
 */
FileStorage.prototype.sendFile = function (data, options) {
    data = data || {};
    options = options || {};
    var $input,
        ajaxProperty,
    $form = $('<form/>', {
        method: 'post',
        enctype: 'multipart/form-data'
    });
    if (options.multiple) {
        $input = $('<input/>', {
            name: 'file[]',
            type: 'file',
            multiple: "multiple"
        });
    } else {
        $input = $('<input/>', {
            name: 'file',
            type: 'file'
        });
    }
    ajaxProperty = {
        url: this._host + '/fileLoad',
        method: 'POST',
        data: data,
        error:options.error,
        success:options.success
    };
    $form.append($input);
    $input.one('change', function () {
        $form.ajaxForm(ajaxProperty);
        $form.submit();
    });
    $input.click();
};