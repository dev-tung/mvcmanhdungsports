

var Functions = {
    numberToVND : function(value){
        value = value.toString().replace(/\./g, "");
        const formatted = new Intl.NumberFormat("it-IT", {
                style: "currency",
                currency: "VND",
            })
            .format(value)
            .replace("VND", "")
            .trim();
        
        return formatted;
    },
    
    deleteErrorMessage: function(selector, error){
        var element = document.querySelector(selector);
        if( error ){
            document.querySelector(error).innerText = '';
        }else{
            element.closest('.validate').querySelector('.error-message').innerText = '';
        }
        element.closest('.validate').classList.remove('invalid', 'valid');
        if( fileElement.value ){
            fileElement.value = '';
        }
    },
    displayNoteMessage: function(selector, extension, size){
        var fileNoteMsg = document.querySelector(selector).closest('.validate').querySelector('.note-message-file');
        if( fileNoteMsg ){
            fileNoteMsg.innerText = 'Allowable extension (' + extension.join(' | ') + ') and size <= '+ size +'MB';
        }
    },
    checkfile: function({element, required, extension, size}){
        if( required && !element.value.trim() ){
            return Validator.message.required;
        }

        // Check file extension
        if( extension && element.value.trim() ){
            var fileExtension = Functions.getFileExtension(element);
            if( !extension.includes(fileExtension) ){
                return Validator.message.extension + '(' + extension.join(' | ') + ')';
            }
        }

        // Check file size
        if( size && element.value.trim() ){
            var fileSize = element.files[0].size;
            var allowFileSize = size * 1000000;
            if( fileSize >=  allowFileSize){
                return Validator.message.size + '(' + size + 'MB)';                
            }
        }

        return undefined;
    },
    getFileExtension : function( element ){
        var fileName = element.files[0].name;
        return fileName.split('.').pop();
    },
    cbChecked : function(cbs){
        var checkedFlag = false;
        cbs.forEach(cb => {
            if (cb.checked) {
                checkedFlag = true;
            }
        });
        return checkedFlag;
    },
    rbChecked : function(rds){
        var checkedFlag = false;
        rds.forEach(rb => {
            if (rb.checked) {
                checkedFlag = true;
            }
        });
        return checkedFlag;
    },
    rbShowHide : function({rbClass, eID, status}){
        // Element show or hide by default
        var e = document.getElementById(eID);
        e.style.display = ( status ) ? 'block' : 'none';
    
        // Check
        var rbs = document.querySelectorAll('.' + rbClass);
        rbs.forEach(rb => {
            rb.addEventListener("click", function(){ 
                e.style.display = ( rb.value == 1 ) ? 'block' : 'none';
            });
        });
    
        e.scrollIntoView();
    },
    cbShowHide : function({cbClass, eID, status}){
        var e = document.getElementById(eID);
        // Element show or hide by default
        e.style.display = ( status ) ? 'block' : 'none';
    
        var cbs = document.querySelectorAll('.' + cbClass);
    
        cbs.forEach(cb => {
            cb.addEventListener("click", function(){ 
                e.style.display = Functions.cbChecked(cbs) ? 'block' : 'none';
            });
        });
    
        e.scrollIntoView();
    }
};

 