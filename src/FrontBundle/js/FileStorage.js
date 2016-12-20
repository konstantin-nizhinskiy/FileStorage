(function (root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery-form'], function () {
            return factory()
        })
    } else {
        root.fileStorage = factory();
    }
}(this, function () {
    /**
     *
     * @constructor
     */
    var FileStorage = function () {
        this._host='<%= hostName %>';
        if(!this._host){
            var scripts=document.getElementsByTagName('script'),
                thisScript;
            for(var i=0;i<scripts.length;i++){
                if(scripts[i].src.indexOf('/FileStorage.min.js')!==-1)
                    thisScript=scripts[i];
            }
            if(thisScript){
                var urlParser=document.createElement('a');
                urlParser.href=thisScript.getAttribute('src');
                this._host = urlParser.origin;
            }

        }
        if(!this._host){
            this._host = window.location.origin
        }
    };
    // <%= prototype %>
    return new FileStorage();
}));