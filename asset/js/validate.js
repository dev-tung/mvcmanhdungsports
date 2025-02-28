
Validator.message = {
    'required'  : 'Trường bắt buộc!',
    'option'    : 'Chọn ít nhất một option!',
    'extension' : 'Đuôi mở rộng cho phép ',
    'size'      : 'Dung lượng không được vượt quá ',
    'email'     : 'Địa chỉ email không hợp lệ!'
}

function Validator( options ) {
    var formElement = document.querySelector(options.form);

    formElement.onsubmit = function(e){
        e.preventDefault();
        var flagSubmit = true;
        var viewInvalidElement = [];
        
        options.rules.forEach( rule => {
           var elements = formElement.querySelectorAll(rule.selector);
            elements.forEach( element => {
                if( element && rule.submit ){
                    var isFormValid = validate(element, customRules[rule.selector], rule.error);
                    if( isFormValid !== undefined ){
                        flagSubmit = false;
                        var scrollPosition = rule.error 
                                                ? document.querySelector(rule.error) 
                                                : element.closest('.validate').querySelector('.error-message');

                        viewInvalidElement.push(scrollPosition);
                    }
                }
            });
        });

        if( flagSubmit ){
            var responses = {};
            responses.form = formElement;
            var datas = formElement.querySelectorAll('input[name]');
            datas.forEach( data => {
                responses[data.name] = data.value;
            });
            options.onSubmit(responses);
        }else{
            viewInvalidElement[0].scrollIntoView({
                behavior: 'smooth',
                block: 'center',
                inline: 'center'
            });
        }
    }

    function validate(element, rule, error){
        var errMsg;

        for( var i = 0; i < rule.length; i++ ){
            errMsg = rule[i](element, formElement);
            if( errMsg !== undefined ) break;
        }

        var validateElement = element.closest('.validate');
        var errorMsgElement = error ? document.querySelector(error) : validateElement.querySelector('.error-message');

        if( errMsg){
            validateElement.classList.add('invalid');
            validateElement.classList.remove('valid');
            errorMsgElement.innerText = errMsg;
        }else{
            validateElement.classList.add('valid');
            validateElement.classList.remove('invalid');
            errorMsgElement.innerText = '';
        }

        return errMsg;
    }

    if( options.rules ){

        var customRules = [];
        options.rules.forEach( rule => {
            if(Array.isArray( customRules[rule.selector] )){
                customRules[rule.selector].push(rule.test);
            }else{
                customRules[rule.selector] = [rule.test];
            }
            
            var elements = formElement.querySelectorAll(rule.selector);
            elements.forEach( element => {

                switch(rule.type) {
                    case 'cb':
                        var cbs = element.querySelectorAll('input[type="checkbox"]');
                        cbs.forEach(cb => {
                            cb.addEventListener("click", function(){ 
                                validate(element, customRules[rule.selector], rule.error);
                            });
                        });
                      break;
                    case 'rb':
                        element.addEventListener("click", function(){ 
                            validate(element, customRules[rule.selector], rule.error);
                        });
                        break;
                    case 'slb':
                        element.onchange = function(){
                            validate(element, customRules[rule.selector], rule.error);
                        }
                        break;
                    case 'bd':
                        var slbs = element.querySelectorAll('select');
                        slbs.forEach(slb => {
                            slb.addEventListener("change", function(){ 
                                validate(element, customRules[rule.selector], rule.error);
                            });
                        });
                      break;
                    case 'fi' || 'slb':
                        element.onchange = function(){
                            validate(element, customRules[rule.selector], rule.error);
                        }
                        break;
                    case 'currency':
                        element.onblur = function(){
                            validate(element, customRules[rule.selector], rule.error);
                            element.value = Functions.numberToVND(element.value);
                        }
                        break;

                    default:
                        element.onblur = function(){
                            validate(element, customRules[rule.selector], rule.error);
                        }
                }

            });

        });
    }
}

Validator.email = function({selector, msg, submit}) {
    checkEmail = (email) => {
        return String(email)
            .toLowerCase()
            .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
    };

    return {
        type: 'tb',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return checkEmail(element.value) 
                    ? undefined 
                    : msg  
                    || Validator.message.email;
        }
    };
}

Validator.tbRequired = function({selector, msg, error, submit}) {
    return {
        type: 'tb',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            return element.value.trim()
                    ? undefined 
                    : msg 
                    || Validator.message.required;
        }
    };
}

Validator.tbRequiredWhenCbChecked = function({selector, checkbox, msg, error, submit}) {
    var checkboxes = document.querySelectorAll(checkbox);
    checkboxes.forEach( cb => {
        cb.addEventListener("click", function(){ 
            Functions.deleteErrorMessage(selector, error);
        });
    });

    return {
        type: 'tb',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            return Functions.cbChecked(checkboxes) && !element.value.trim()
                    ? msg 
                    || Validator.message.required 
                    : undefined;
        }
    };
}

Validator.tbRequiredWhenRbChecked = function({selector, radiobox, msg, error, submit}) {
    var radioboxes = document.querySelectorAll(radiobox);
    radioboxes.forEach( cb => {
        cb.addEventListener("click", function(){ 
            Functions.deleteErrorMessage(selector, error);
        });
    });

    return {
        type: 'tb',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            return Functions.rbChecked(radioboxes) && !element.value.trim()
                    ? msg 
                    || Validator.message.required 
                    : undefined;
        }
    };
}

Validator.fileRequiredWhenCbChecked = function({selector, required, size, extension, checkbox, error, submit}) {
    var checkboxes = document.querySelectorAll(checkbox);
    checkboxes.forEach( cb => {
        cb.addEventListener("click", function(){ 
            Functions.deleteErrorMessage(selector, error);
        });
    });

    Functions.displayNoteMessage(selector, extension, size);

    return {
        type: 'fi',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            if(  Functions.cbChecked(checkboxes)){
                return Functions.checkfile({element, required, extension, size});
            }
            return undefined;
        }
    };
}

Validator.fileRequiredWhenRbChecked = function({selector, required, size, extension, radiobox, error, submit}) {
    var radioboxes = document.querySelectorAll(radiobox);
    radioboxes.forEach( rb => {
        rb.addEventListener("click", function(){ 
            Functions.deleteErrorMessage(selector, error);
        });
    });

    Functions.displayNoteMessage(selector, extension, size);

    return {
        type: 'fi',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            if( Functions.rbChecked(radioboxes) ){
                return Functions.checkfile({element, required, extension, size});
            }
            return undefined;
        }
    };
}

Validator.file = function({selector, required, size, extension, submit}) {
    Functions.displayNoteMessage(selector, extension, size);

    return {
        type: 'fi',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return Functions.checkfile({element, required, extension, size});
        }
    };
}

Validator.signature = function({selector, required, size, extension, submit}) {
    Functions.displayNoteMessage(selector, extension, size);

    return {
        type: 'signature',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return Functions.checkfile({element, required, extension, size});
        }
    };
}

Validator.rbRequired = function({selector, msg, error, submit}) {
    return {
        type: 'rb',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            let rbElements = formElement.querySelectorAll(selector);
            let rbCheckFlag = false;
            rbElements.forEach( rbE => {
                if( rbE.checked == true )
                    rbCheckFlag = true;
            });

            return rbCheckFlag 
                    ? undefined 
                    : msg  
                    || Validator.message.required;
        }
    };
}

Validator.isPInt = function({selector, msg, submit}) {
    return {
        type: 'tb',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return parseInt(element.value) > 0 || !element.value.trim() 
                    ? undefined 
                    : msg 
                    || 'TSố phải lớn hơn 0!';
        }
    };
}

Validator.currency = function({selector, msg, submit}) {
    return {
        type: 'currency',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return !isNaN(element.value)
                    ? undefined 
                    : msg 
                    || 'Hãy nhập số tiền!';
        }
    };
}

Validator.cbChecked = function ({selector, msg, error, submit}) {
    return {
        type: 'cb',
        selector: selector,
        error: error,
        submit: submit,
        test: function( element, formElement ){
            var cbs = element.querySelectorAll('input[type="checkbox"]');
            return Functions.cbChecked(cbs) 
                    ? undefined 
                    : msg 
                    || Validator.message.required;
        }
    };
}

Validator.bdRequired = function ({selector, msg, submit}){
    return {
        type: 'bd',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            
            function isSelected(slbs){
                var checkedFlag = true;
                slbs.forEach(sl => {
                    if ( sl.value == null || sl.value == '' || sl.value == undefined ) {
                        checkedFlag = false;
                    }
                });
                return checkedFlag;
            }

            var slbs = element.querySelectorAll('select');
            return isSelected(slbs) 
                    ? undefined 
                    : msg 
                    || 'Please enter day/month/year / Vui lòng nhập ngày/tháng/năm!';
        }
    };
}

Validator.slbRequired = function ({selector, msg, submit}){
    return {
        type: 'slb',
        selector: selector,
        submit: submit,
        test: function( element, formElement ){
            return  element.value
                    ? undefined 
                    : msg 
                    || Validator.message.required;
        }
    };
}
