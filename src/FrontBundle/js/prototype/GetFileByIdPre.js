/**
 * Get url pre view by id
 *
 * @param id {string}
 */
FileStorage.prototype.getFileUrlByIdPre=function(id){
    return this._host+'/get/public/pre/'+id;
};