function translate(transl){
    window.transl = transl;
};
(function(){
    var URL = 'http://localhost/isinlor/WordsTree/app/public/index.php/';

    function getScript(url,success){
      
      var head = document.getElementsByTagName('head')[0], done = false;
      var script = document.createElement('script');
      script.src = url;
      

      script.onload = script.onreadystatechange = function(){
        if ( !done && (!this.readyState ||
                this.readyState == 'loaded' || this.readyState == 'complete') ) {
            done = true;
            success();
        }
      };

    head.appendChild(script);

    }

    getScript('http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js',function(){ 
        $.shift = function(key, callback, args) {
            var isShift = false;
            $(document).keydown(function(e) {
                if(!args) args=[];
                
                if(e.shiftKey) isShift = true;
                if(e.keyCode == key.charCodeAt(0) && isShift) {
                    callback.apply(this, args);
                    return false;
                }
            }).keyup(function(e) {
                if(e.shiftKey) isShift = false;
            });        
        };

        $.shift('S', function() {
            var translateURL = 'http://glosbe.com/gapi/translate?from=eng&dest=pol&format=json&phrase='+window.getSelection().toString().toLowerCase()+'&callback=translate';
            getScript(translateURL, function(){
            var omegawiki = '';

            for(var i = 0; i < window.transl.tuc.length; i++)
            {
                console.log(i);
                if(typeof window.transl.tuc[i].meanings[0].text != 'undefined'){console.log(window.transl.tuc[i].meanings[0].text);}
                if(window.transl.tuc[i].hasOwnProperty('phrase')){console.log(window.transl.tuc[i].phrase[0].text);}
              if(window.transl.tuc[i].authors[0] == 60172)
              {
                console.log('hi hip');
                omegawiki = window.transl.tuc[i];
              }
            }
                alert('Opis:'+omegawiki.meanings[0].text);
            });
            getScript(URL+'api/save/'+window.getSelection().toString().toLowerCase(), function(){});
        });
    });


})();