/**
 * Delete file by id
 *
 * @param id {string}
 * @param options {object}
 * @param options.success {function}
 * @param options.error {function}
 */
FileStorage.prototype.deleteFileUrlById=function(id,options){
    options=options||{};
    $.ajax({
        method: "DELETE",
        url: this._host + '/delete/public/'+id,
        success: options.success,
        error: options.error

    })
};

