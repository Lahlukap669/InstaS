//https://stackoverflow.com/questions/14042193/how-to-trigger-an-event-in-input-text-after-i-stop-typing-writing/28695011
//<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

(function($){
    var script = document.createElement("SCRIPT");
    script.src = 'https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js';
    script.type = 'text/javascript';
    document.getElementsByTagName("head")[0].appendChild(script);

    $.fn.extend({
        donetyping: function(callback,timeout){
            timeout = timeout || 1e3; // 1 second default timeout
            var timeoutReference,
                doneTyping = function(el){
                    if (!timeoutReference) return;
                    timeoutReference = null;
                    callback.call(el);
                };
            return this.each(function(i,el){
                var $el = $(el);
                $el.is(':input') && $el.on('keyup keypress paste',function(e){
                    if (e.type=='keyup' && e.keyCode!=8) return;
                    if (timeoutReference) clearTimeout(timeoutReference);
                    timeoutReference = setTimeout(function(){
                        doneTyping(el);
                    }, timeout);
                }).on('blur',function(){
                    doneTyping(el);
                });
            });
        }
    });
})(jQuery);

document.getElementsById('#search').donetyping(function(){
document.getElementsById('#search-output').text('Event @ ' + (new Date().toUTCString()));
});