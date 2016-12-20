/**
 * Get url by id
 *
 * @param id {string}
 * @param options {object}
 * @param options.w {int}
 * @param options.h {int}
 */
FileStorage.prototype.getFileUrlById=function(id,options){
    if(options && options.w && options.h){
        return this._host+'/get/public/'+options.w+'x'+options.h+'/'+id;
    }
    if(options && options.w && options.h){
        return this._host+'/get/public/'+options.w+'x'+options.h+'/'+id;
    }
    return this._host+'/get/public/'+id;
};

