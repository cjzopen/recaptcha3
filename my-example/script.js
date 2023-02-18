var recaptcha ='';
$.getScript('https://www.google.com/recaptcha/api.js?render={site key}=zh-TW')
// $.getScript('https://recaptcha.net/recaptcha/api.js?render={site key}=zh-CN')
.done(function(){
  grecaptcha.ready(function() {
    grecaptcha.execute('{site key}', {action: 'homepage'})
    .then(function(token) {
      recaptcha = token;
    });
  });
}).fail(function(){
  console,log('loading recaptcha failed');
});